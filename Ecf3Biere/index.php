<?php
require_once 'router.php';//inclut fichier "router.php", (gestion des routes de l'appli.contient fonctions pour analyser URL demandée et retourner les infos de la route qui correspond)
require_once 'controllers/ErrorController.php';//inclut fichier "ErrorController.php", (définition du contrôleur pour gérer erreurs de l'appli.(pour afficher pages d'erreur si problm)

$route = getRoute();//appel fonction 'getRoute()' (définie dans "router.php") pour avoir les infos de la route voulu.

$controllerName = $route['controller'];//sort nom contrôleur à partir de "$route" et le stocke dans varbl '$controllerName'
$actionName = $route['action'];//sort nom de action à exécut à partir de "$route" et "   "      "    "     '$actionName'

$controllerFile = 'controllers/' . $controllerName . '.php';//met bout a bt chemin relatif vers dossier "controllers" avec  nom contrôleur et".php". (pour construire chemin vers fichier du contrôleur qu'il faut.

if (file_exists($controllerFile)) {//vérif si fichier contrôleur existe avec "file_exists()" (Si oui, le code du bloc 'if' est exécut)
    require_once $controllerFile;//inclut fichier contrôleur avc 'require_once'(pour charger fichier contrôleur dans script)

    if (class_exists($controllerName)) {//vérif si classe contrôleur existe avec "class_exists()" (Si oui,code du bloc if est exécut
        $controller = new $controllerName();//crée instance du contrôleur avc nom de classe du contrôleur. (pour instance contrôleur et d'accéd à méthodes)

        if (method_exists($controller, $actionName)) {//vérif si méthode existe dans contrôleur avc 'method_exists()' (Si oui,code du bloc 'if's'exécute)
            $controller->$actionName();
        } else {
            // Si l'action spécifiée n'existe pas dans le contrôleur, afficher une erreur 404
            $errorController = new ErrorController();//appel méthode correspond sur instance contrôleur créée avnt.(exéc action dans reqt)
            $errorController->notFound();
        }
    } else {
        // Si contrôleur n'existe pas, affiche 'erreur 404'
        $errorController = new ErrorController();
        $errorController->notFound();
    }
} else {
    // Si fichier contrôleur n'existe pas, affiche 'erreur 404'
    $errorController = new ErrorController();
    $errorController->notFound();
}
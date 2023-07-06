<?php //'mappage'pour diriger demande vers parties de l'appli selon URL demandée )
function getRoute() {//récup contrôleur et action de URL
    $path = $_SERVER['REQUEST_URI'];//chemin URL demandée avc '$_SERVER['REQUEST_URI']' (varbl contient URI de demande HTTP)

    switch ($path) {//selon chemin URL,fonction utilise 'switch' pour choisir quel contrôleur et action doit être exécut 
        case '/'://si chemin est '/'(raiine site)fonction renvoie tableau avc contrôleur 'HomeController' et l'action 'index'. (qnd utilisateur accède à racine >contrôleur 'HomeController'utilisé et index()contrôleur appeler)
            return [
                'controller' => 'HomeController',
                'action' => 'index'
            ];
        case '/beers'://Si chemin '/beers'>>fonction renvoie tableau avec contrôleur 'BeerController' et l'action 'index'. (qnd utilisateur accède à URL /beers,contrôleur 'BeerController' sera utilisé et index()contrôleur appelé)
            return [
                'controller' => 'BeerController',
                'action' => 'index'
            ];
        case '/amber':
            return [
                'controller' => 'AmberController',//"" '/amber'  "" ""     "  "'AmberController'""  ""(""/amber ""  ""AmberController"  ""  ""index()"  "")
                'action' => 'index'
            ];
        default://renvoie tableau qui contient contrôleur et l'action de URL demandé, et sera utilisé plus tard dans code pour appeler contrôleur et action qu il faut
            return [
                'controller' => 'ErrorController',
                'action' => '404'
            ];
    }
}
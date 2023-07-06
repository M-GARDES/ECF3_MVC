<?php  // contrôle action de page d'erreur 404

class ErrorController {
    public function notFound() {
        // Affichage de la page d'erreur 404
        include 'views/error404.php';
    }
}
<?php //'action de page,utilise modèle 'BeerModel' pour avoir les données des bières.
// (ls dnns sont apres transmises à vue pour affichage)
class HomeController { //"HomeController" est définie avec une méthode publique index()
    public function index() {
        $beerModel = new BeerModel();// bières aléa stockées dans varbl '$randomBeers'
        $randomBeers = $beerModel->getAllBeers();//'getAllBeers()' de objet 'BeerModel' est appelée pour récup tts les bières.
        // Passe données bières aléa à la vue qu'il faut (ex:home.php)
        include 'views/home.php';
    }
}
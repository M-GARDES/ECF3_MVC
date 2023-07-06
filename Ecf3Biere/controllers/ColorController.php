<?php
require_once 'model/ColorModel.php';

class ColorsController {
    private $colorModel;//varbl privée '$colorModel' sera utilisée pour instancier modèle de couleur.

public function __construct() {//définit le constructeur de la classe. quand1 instance de la classe est créée,il est appelé. (il initialise '$colorModel' en instanciant classe 'ColorModel'
        $this->colorModel = new ColorModel();//définit méthode publique "index". (pour afficher liste des couleurs)
    }

    public function index() {
        $colors = $this->colorModel->getAllColors();//appelle 'getAllColors()' du modèle de couleur pour récup tts ls couleurs. (Le résult stocké dans '$colors'.
        // Passe données couleurs à vue appropriée (ex:colors.php)
        include 'views/colors.php';//inclut fichier "colors.php" pour afficher liste ds couleurs. (contenu de view sera  affiché ici)
    }

    public function create() {//méthode publique"create"pour afficher form de créa d'1 nouv couleur et traite  données du form
      
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {//vérif si le serv a reçu requête 'POST'.(permet de vérif si le form soumis)
            // Récup données du form de création
            $name = $_POST['name'];
            $code = $_POST['code'];

            // Validat° données 

            // Redirige vers page index couleurs
            header('Location: index.php?action=colors');
            exit();
        }

        // Affiche form de créa couleur (create_color.php)
        include 'views/create_color.php';
    }

    public function edit($id) {
        // Logique de modif d'1couleur existante
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récup données du form de modif
            $name = $_POST['name'];
            $code = $_POST['code'];

            // Valid données et effectue les opés nécessaires (ex, màj couleur en bdd)

            // Renvoi vers page index couleurs
            header('Location: index.php?action=colors');
            exit();
        }

        // Récup données de couleur à modif en fonction de l'ID
        $color = $this->colorModel->getColorById($id);

        // Affiche form de modif de couleur (ex:edit_color.php) en passant les données couleur à la vue
        include 'views/edit_color.php';
    }

    public function delete($id) {
        // Logique de suppress d'une couleur existante
        // Effectue ls opés nécessaires pour supprim la couleur en bdd

        // Redirige vers page index couleurs
        header('Location: index.php?action=colors');
        exit();
    }
}
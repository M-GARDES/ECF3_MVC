<?php
require_once 'database.php';

// Nbr bières /page
$biereParPage = 9;

try {
    // Reqt pour récup ls bières ambrées
    $query = "SELECT a.NOM_ARTICLE AS nom, a.VOLUME, m.NOM_MARQUE AS nom_marque, c.NOM_COULEUR AS couleur, tb.NOM_TYPE AS type
    FROM article AS a
    INNER JOIN marque AS m ON a.ID_MARQUE = m.ID_MARQUE # jointures (INNER JOIN) pour relier tables 'article' marque, couleur et typebiere 
    INNER JOIN couleur AS c ON a.ID_COULEUR = c.ID_COULEUR
    INNER JOIN typebiere AS tb ON a.ID_TYPE = tb.ID_TYPE
    WHERE c.ID_COULEUR = 4"; // Tts les bières "Ambrée" (4)

    $stmt = $db->query($query);//reqt SQL grace à connexion à bdd "$db".(renvoie 1 objet 'PDOStatement' qui représente le résult de reqt.
    $biereAmbrée = $stmt->fetchAll(PDO::FETCH_ASSOC);//récup tts lignes de résult de reqt en tableau (Chq élément sont 1 bière ambrée avec infos (nom,volume,marque,couleur,type)

    // Pagination
    $totalBieres = count($biereAmbrée);//nmbr total bières ambrées avec 'count()' pour compter nmbr éléments dans '$biereAmbrée'
    $totalPages = ceil($totalBieres / $biereParPage);//nmbr total pages qu il faut pour affich tts bières grace àpagination
    // (calcul en : nmbr ttl bières par page ($totalBieres)/ le nmbr bières par page ('ceil'arrondit résultat à entier sup)
    $page = isset($_GET['page']) ? $_GET['page'] : 1;//'$page'= page actu dans URL grace à 'GET page' (Si 'GET'pas présent >>valeur par défaut  1.(pour gérer pagination selon page actu
    $offset = ($page - 1) * $biereParPage;// '$offset'=index d'ou réslts des bières doivent être récup dns "$biereAmbrée" (calcul: - 1 de valeur de page actu($page) et x le résult / nmbr de bières par page ($biereParPage).
    $biere = array_slice($biereAmbrée, $offset, $biereParPage);//'$biere' utilise 'array_slice()' pour extraire partie de "$biereAmbrée" à partir de index ($offset) avec longueur = au nmbr de bières par page ($biereParPage).
    //(pour récup bières de la page actu pour affichage)
    
} catch (PDOException $e) {//capture exception 'PDOException'(exception ds erreurs liées à la bdd dans PHP)
    echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="PHP">
        <meta name="author" content="gardesmagali">
        <title>SDBM</title>
        <!-- Font Awesome icons -->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <!-- CSS (+ Bootstrap)-->
        <link href="../styles.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    </head>
    <body class="transparent-bg">
        <!-- Barre nav -->
        <nav class="navbar navbar-expand-lg navbar-dark nav-dark">
            <a class="navbar-brand" href="#"><img src="../assets/images/logo.png" alt="Logo" class="navbar-logo"> S.D.B.M.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end menu-dropdown" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                     <a class="nav-link" href="../home.php">HOME</a>
                    </li>
                    <li class="nav-item">
                     <a class="nav-link" href="beer.php">BEERS</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="blond.php">BLOND</a>
                    </li>
                    <li class="nav-item">
                     <a class="nav-link" href="white.php">WHITE</a>
                    </li>
                    <li class="nav-item">
                     <a class="nav-link" href="brown.php">BROWN</a>
                    </li>
                    <li class="nav-item">
                     <a class="nav-link" href="setting.php">SETTING</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container h-100">
            <div class="text-center">
              <h1>AMBER BEERS</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus et molestie ac feugiat sed.<br></p><br>
            </div><br>

            <div class="row">
                <?php foreach ($biere as $beer) { ?>
                    <div class="col-md-4">
                        <div class="beer-item">
                            <h3><?php echo $beer['nom']; ?></h3><!--affichage infos de la bière (boucle)-->
                                <p>Volume : <?php echo $beer['VOLUME']; ?></p>
                                <p>Marque : <?php echo $beer['nom_marque']; ?></p>
                                <p>Couleur : <?php echo $beer['couleur']; ?></p>
                                <p>Type de bière : <?php echo $beer['type']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>

             <!-- Pagination -->
            <div class="pagination">
                <?php if ($page > 1) : ?><!--vérif si page actu est sup à 1. Si oui, "Précédent" s'affiche avc valeur de page actu - 1 -->
                 <a href="amber.php?page=<?php echo $page - 1; ?>" class="page-link">Précédent</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++) : ?><!--affiche num de page. (boucle commence à 1 jusqu'au nmbr ttl de pages ($totalPages). (chaque num de page a un lien affiché avec valeur de page(paramètre URL) 
                 Si page actu a lenum de page en cours , "active" s'ajoute pour mettre en brillant-->
                   <a href="amber.php?page=<?php echo $i; ?>" class="page-link <?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages) : ?> <!--vérif si page actu est inf a nmbr ttl pages. Si oui, "Suivant" s'affiche grace à valeur de page actu + 1 comme paramètre dns URL.-->
                 <a href="amber.php?page=<?php echo $page + 1; ?>" class="page-link">Suivant</a>
                <?php endif; ?>
            </div>
        </div>

        <footer class="footer mt-auto py-3">
            <div class="container text-center">
             <span>Société de Distribution des Bières du Monde - GardèsMag © 2023</span>
            </div>
        </footer>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../script.js"></script>
  </body>
</html>
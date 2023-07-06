<?php
// Inclu fichier de config de la bdd
require_once 'database.php';

  // Reqt SQL pour sélec 5bières aléa
  $query = "SELECT * FROM article ORDER BY RAND() LIMIT 5";//reqt SQL pour récup données ds bières. (sélec tts ls clns de table "article" et avec "ORDER BY RAND()" obtient ordre aléa de résults.("LIMIT 5" limite nmbr de résults à 5.
  $stmt = $db->prepare($query);//prépare reqt SQL grace à connexion à la bdd stockée dns variable '$db'.(créer objet de reqt qui pourra être exécut plus tard)
  $stmt->execute();//exéc reqt préparée.(envoie reqt SQL à la bdd pour avoir les résults)
  $beers = $stmt->fetchAll(PDO::FETCH_ASSOC);//récup résultats de reqt dans  tableau . Elément du tableau représente 1 bière avc colns de table "article". "$beers" contient données des bières à afficher sur la page.
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
            <a class="nav-link" href="beer.php">BEERS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="blond.php">BLOND</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="amber.php">AMBER</a>
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
                
    <div class="container h-100 mx-auto">
      <div class="text-center">
        <h1>Welcome to Société de Distribution<br></h1>
        <h1> des Bières du Monde</h1>
        <br>
        <img src="../assets/images/angry.jpg" alt="Beer 1" class="custom-image">              
        <img src="../assets/images/Chimay.jpg" alt="Beer 2" class="custom-image">
        <img src="../assets/images/grimbe.jpg" alt="Beer 3" class="custom-image">               
        <img src="../assets/images/grimbe.jpg" alt="Beer 4" class="custom-image">
        <img src="../assets/images/mont.jpg" alt="Beer 5" class="custom-image">                           
        <br> 
      
               <!-- Affich  bières -->        
        <div class="beer-list">
          <h2>Some Beers</h2><br>
          <?php foreach ($beers as $beer) : ?><!--début boucle "foreach"(itère sur chq élmnt tableau '$beers' et assigne valeur de chq élmnt à varbl '$beer'-->
          <p><?php echo $beer['NOM_ARTICLE']; ?></p><!--affich nom chqu bière dans <p>. "echo" pour afficher valeur de clé 'NOM_ARTICLE' de élément actuel du tableau '$beer'-->
          <?php endforeach; ?><!--fin boucle "foreach"-->
        </div>
                  
        <div class="d-flex justify-content-center">
          <a href="beer.php" class="btn btn-warning btn-lg btn-block">Discover our beers</a>
        </div>
      </div>
    </div>   
      <br>

    <footer class="footer mt-auto py-3">
      <div class="container text-center">
        <span>Société de Distribution des Bières du Monde - GardèsMag © 2023</span>
      </div>
    </footer>
        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="../script.js"></script>
  </body>
</html>
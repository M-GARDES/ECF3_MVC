<?php
include '../views/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {//Vérif si reqt envoyée au serv est type 'POST'.(POST' quand on envoie données sensibles ou de  plusieur données) N'inclut pas ls données dns URL de reqt!!
    $beerName = $_POST['beerName'];//récup valeur champ 'beerName' du form soumis puis l'assigne à varbl '$beerName'. (quand form soumis avc méthode 'POST', ls données du form sont stockées dans superglobale "$_POST" 
    $volume = $_POST['volume'];//idem pour 'volume'
    $brandName = $_POST['brandName'];//idem pour 'brandName'
    $color = $_POST['color'];//idem pour 'color'
    $type = $_POST['type'];//idem pour 'type'

    try {
       //création nouvelle entrée dns table 'article' avec un ID_ARTICLE unique (+1 de valeur 'ID_ARTICLE' max de la bdd)
      $sql = "SELECT MAX(ID_ARTICLE) as lastID FROM article";//définit chaîne de carctrs contient reqt SQL qui sélectionne valeur max de 'ID_ARTICLE' dans la table article. (ma valeur max est renommée lastID pour utilisation plus tard)
      $reponse = $db->prepare($sql);//reqt SQL du dessus définie est préparée grace à objet 'PDO $db'(connex à la bdd) / méthode prepare() renvoie 1 objet de reqt préparé (utilisé pour exécut la reqt)
      $reponse->execute();//exécute la reqt SQL préparée.
      $result = $reponse->fetch(PDO::FETCH_ASSOC);//Après exéc de reqt,récupère ligne de résult en tableau associatif (récup le résltt de reqt SQL)
      $lastId = $result['lastID'];//valeur 'lastID' (valeur max de 'ID_ARTICLE' récup à partir de table article) est assignée à la varbl '$lastId'
      $newId = $lastId + 1;//ajout 1 à valeur '$lastId' et assigne résult à '$newId'. ('$newId' utilisé comme un nouv id unique pour une entrée dans la table 'article').

        // Prépa reqt SQL d'insertion
      $query = "INSERT INTO article (NOM_ARTICLE, VOLUME, ID_MARQUE, ID_COULEUR, ID_TYPE)
                  VALUES (:beerName, :volume, :brandName, :color, :type)";//crée nouv reqt SQL pour insérer données dans table 'article'. (beerName, :volume, etc.) dans reqt seront liés à  vraies valeurs à l'exéc de reqt pour éviter injections SQL

        // Prépa et exéc reqt avc valeurs fournies
        $stmt = $db->prepare($query);// prépar reqt pour l'exéc./ '$db' = objet 'représente connex à bdd/ '$query'=chaîne contient reqt/ 'prepare()' renvoie 1objet de décla ($stmt) pour exéc la reqt
        $stmt->bindParam(':beerName', $beerName);// lie varbl '$beerName' au paramètre ':beerName' dans reqt (Quand requête exéc >> ':beerName' sera remplacé par valeur de '$beerName'(pour eviter injections SQL)
        $stmt->bindParam(':volume', $volume);//  ""       ""      ""
        $stmt->bindParam(':brandName', $brandName);//""    ""   ""
        $stmt->bindParam(':color', $color);//  "        "       "
        $stmt->bindParam(':type', $type);//  "       "       "
        $stmt->execute();

        // Affiche message succès ou redirige vers autre page
        echo "Beer added successfully!";
    } catch (PDOException $e) {
        // Gére erreurs de bdd
        echo "Error adding beer: " . $e->getMessage();
    }
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
      <!-- CSS (+Bootstrap)-->
    <link href="../styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  </head>
  <body class="transparent-bg">
        <!-- Barre nav -->
    <nav class="navbar navbar-expand-lg navbar-dark nav-dark">
      <a class="navbar-brand" href="#"><img src="../assets/images/logo.png" alt="Logo" class="navbar-logo"> S.D.B.M. </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end menu-dropdown" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../home.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../views/beer.php">BEERS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../views/blond.php">BLOND</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../views/amber.php">AMBER</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../views/white.php">WHITE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../views/brown.php">BROWN</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../views/setting.php">SETTING</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container h-100">
      <div class="text-center">
        <h1>CREATE NEW BEERS</h1>

        <form action="createbeer.php" method="POST">
          <label for="NOM_ARTICLE">Name of beer:</label>
            <input type="text" id="NOM_ARTICLE" name="beerName" required>

          <label for="VOLUME">Volume:</label>
            <input type="text" id="VOLUME" name="volume" required>

          <label for="marque">Brand:</label>
            <input type="text" id="marque" name="brandName" required>

          <label for="ID_COULEUR">Color:</label>
            <input type="text" id="ID_COULEUR" name="color" required>

          <label for="typebiere">kind:</label>
            <input type="text" id="typebiere" name="type" required><br>
              <br>
            <input type="submit" value="ADD">
        </form>
      </div>

      <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {//vérif sirequête est "POST". (Si oui, {} sera exéc. (vérif si form soumis, "POST" pour envoi form)
        $beerName = $_POST['beerName'];
        $volume = $_POST['volume'];
        $brandName = $_POST['brandName'];
        $color = $_POST['color'];
        $type = $_POST['type'];
            //récupèrent champs du form(Quand form soumis avec "POST", données form envoyées dans '$_POST'.               
      }?>
    </div>  

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
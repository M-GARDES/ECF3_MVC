<?php
include '../views/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {//vérif si méthode est "POST". (Si oui,récup ID de bière ($beerId = $_POST['beerId'];) à partir du form ou on à choisi 1bière pour la supprim
    $beerId = $_POST['beerId'];//prépar reqt pour supprim bière avec ID de la bdd 

    try {
        // prépar et exéc reqt avec ID de bière avec objet PDO 
        $query = "DELETE FROM article WHERE ID_ARTICLE = :beerId";

        // Prépare et exéc reqt avc valeur fournie
        $stmt = $db->prepare($query);
        $stmt->bindParam(':beerId', $beerId);//'bindParam' lie valeur de varbl '$beerId' au paramètre ':beerId' dans reqt (empêche injections SQL)
        $stmt->execute();

        // Affiche message succès ou redirigez vers autre page
        echo "Beer deleted successfully!";
    } catch (PDOException $e) {
        // Gére erreurs de bdd
        echo "Error deleting beer: " . $e->getMessage();
    }
}

// Récup données ds bières pour afficher dns le form de suppress°
try {
    $query = "SELECT ID_ARTICLE, NOM_ARTICLE FROM article";//pour sélec 'ID' et 'nom' de chq bière dans table "article".
    $stmt = $db->query($query);//méthode 'query()' de objet '$db' (connexion bdd) exéc reqt donnée avant, résultt stocké dans objet '$stmt'
    $beers = $stmt->fetchAll(PDO::FETCH_ASSOC);//récup tts lignes renvoyée par reqt ( clé est le nom d'1colonne de table "article"/Chaque ligne = 1bière de  table "article")>> ensuite stocké dans varbl '$beers'
} catch (PDOException $e) {//attrape et gère exception 'PDOException' si une erreur à l'exéc de reqt . (Si exception affiche message d'erreur
    echo "Error retrieving beers: " . $e->getMessage();
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
        <h1>DELETE BEER</h1>

        <form action="deletebeer.php" method="POST">
            <label for="beerId">Select a beer:</label>
            <select id="beerId" name="beerId" required>
                <?php foreach ($beers as $beer) : ?>
                    <option value="<?php echo $beer['ID_ARTICLE']; ?>"><?php echo $beer['NOM_ARTICLE']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Delete">
        </form>
    </div>
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
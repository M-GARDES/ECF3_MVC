<?php include '../views/database.php';
// Connex à la bdd
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'sdbm_v2';

try {
    $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connexion à la base de données échouée : " . $e->getMessage();
    exit;
}

// Récup de ID de article à mettre àj
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];

    // Récup données article à partir de la bdd
    $query = "SELECT * FROM article WHERE ID_ARTICLE = :articleId";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':articleId', $articleId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement de la màj de l'article
            $newArticleName = $_POST['ArticleName'];

            $updateQuery = "UPDATE article SET NOM_ARTICLE = :articleName WHERE ID_ARTICLE = :articleId";
            $updateStmt = $db->prepare($updateQuery);
            $updateStmt->bindValue(':articleName', $newArticleName);
            $updateStmt->bindValue(':articleId', $articleId);
            $updateStmt->execute();

            header('Location: beer.php');
            exit;
        }
    } else {
        echo "Beer not found.";
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
                <h1>UPDATE BEER</h1>
                <?php if (isset($article)) : ?><!--vérif si $article est définie. Si oui, 'bière a été trouvée et on peut afficher le form de màj. Sinon '$article' pas définie,aucune bière n'a été trouvée et on affiche  message bière pas trouvée.-->
              <form action="updatebeer.php?id=<?php echo $articleId; ?>" method="POST"><!--action form définie comme "updatebeer.php" avec  GET "id" (ID de la bière à màj) >>ID récup à partir de '$articleId'-->
                <div class="form-group">
                    <label for="articleName">Article Name:</label>
                    <input type="text" id="articleName" name="ArticleName" value="<?php echo $article['NOM_ARTICLE']; ?>" required>
                </div>

                <input type="submit" value="Update">
              </form>
              <?php else : ?>
               <p>Beer not found.</p><!--Si '$article'pas défini,affiche message "Beer not found."-->
              <?php endif; ?>
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>      
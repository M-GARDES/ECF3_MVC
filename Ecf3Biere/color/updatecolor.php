<?php
include '../views/database.php';

// Vérif si form a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $colorId = $_POST['colorId'];
    $colorName = $_POST['colorName'];

    try {
        // Màj couleur dans la bdd
        $query = "UPDATE couleur SET NOM_COULEUR = :colorName WHERE ID_COULEUR = :colorId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':colorName', $colorName);
        $stmt->bindParam(':colorId', $colorId);
        $stmt->execute();

        // Redirige vers page de lecture des couleurs
        header("Location: readcolor.php");
        exit();
    } catch (PDOException $e) {
        echo "Error updating color: " . $e->getMessage();
    }
} else {
    // Vérifie si ID couleur est dans URL
    if (isset($_GET['id'])) {
        $colorId = $_GET['id'];

        try {
            // Récup info couleur à mettre à jour
            $query = "SELECT * FROM couleur WHERE ID_COULEUR = :colorId";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':colorId', $colorId);
            $stmt->execute();
            $color = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error retrieving color: " . $e->getMessage();
        }
    } else {
        // Redirige vers page lecture des couleurs si aucun ID donné
        header("Location: readcolor.php");
        exit();
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
                  <a class="nav-link" href="views/beer.php">BEERS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="views\blond.php">BLOND</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="views/amber.php">AMBER</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="views/white.php">WHITE</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="views/brown.php">BROWN</a>
                </li>
                <li class="nav-item">
                 <a class="nav-link" href="views/setting.php">SETTING</a>
                </li>
              </ul>
            </div>
        </nav>

<div class="container h-100">
    <div class="text-center">
        <h1>Update Color</h1>

        <?php if ($color) : ?>
            <form action="updatecolor.php" method="POST">
                <input type="hidden" name="colorId" value="<?php echo $color['ID_COULEUR']; ?>">

                <div class="form-group">
                    <label for="colorName">Color Name:</label>
                    <input type="text" id="colorName" name="colorName" value="<?php echo $color['NOM_COULEUR']; ?>" required>
                </div>

                <input type="submit" value="Update">
            </form>
        <?php else : ?>
            <p>Color not found.</p>
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
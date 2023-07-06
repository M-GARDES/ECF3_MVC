<?php
include '../views/database.php';

try {
    // Récup tts ls couleurs de la bdd
    $query = "SELECT * FROM couleur";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $colors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error retrieving colors: " . $e->getMessage();
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
                <h1> Read Colors</h1>

                <?php if (!empty($colors)) : ?>
                <table class="table">
                    <thead>
                        <tr>
                         <th>ID</th>
                         <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($colors as $color) : ?>
                        <tr>
                            <td><?php echo $color['ID_COULEUR']; ?></td>
                            <td><?php echo $color['NOM_COULEUR']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </table>
                    <?php else : ?>
                      <p>No colors found.</p>
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
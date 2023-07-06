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
    <nav class="navbar navbar-expand-lg navbar-dark nav-dark navbar-stop-collapse">
      <a class="navbar-brand" href="#"><img src="../assets/images/logo.png" alt="Logo" class="navbar-logo"> S.D.B.M.</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="home.php">HOME</a>
          </li>
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
        </ul>
      </div>
    </nav>
                
    <div class="container h-100">
      <div class="text-center">
        <h1>SDBM SETTING</h1><br>
        <br>
        <h2>Beer Settings</h2>
          <a class="btn btn-primary" href="../beers/createbeer.php">Create Beer</a>
          <a class="btn btn-danger" href="../beers/deletebeer.php">Delete Beer</a>
          <a class="btn btn-info" href="../beers/readbeer.php">Read Beer</a>
          <a class="btn btn-warning" href="../beers/updatebeer.php">Update Beer</a><br>
        
          <br>
        <h2>Color Settings</h2>
          <a class="btn btn-primary" href="../color/createcolor.php">Create Color</a>
          <a class="btn btn-danger" href="../color/deletecolor.php">Delete Color</a>
          <a class="btn btn-info" href="../color/readcolor.php">Read Color</a>
          <a class="btn btn-warning" href="../color/updatecolor.php">Update Color</a>
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
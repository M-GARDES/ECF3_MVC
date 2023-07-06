<?php
require_once '../views/database.php';
// Nombre de bières par page
$beersPerPage = 66;

try {
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;//vérif si 'page' est passé dans l'URL (pour navig vers page dans pagination). Si oui,assigne valeur à '$currentPage', sinon, définit '$currentPage' à 1 (1=1er page)
    $offset = ($currentPage - 1) * $beersPerPage;//calcule l'offset pour reqt qui va récup ls bières dans la bdd. Si je suis page1, l'offset est 0  Si je sui page2 et que j'affiche 10 bières/page>>l'offset est 10, donc je commence à partir de 11ème bière etc etc..

    // prépare et exéc requête pour récup les bières
    $query = "SELECT a.NOM_ARTICLE AS nom, a.VOLUME, m.NOM_MARQUE AS nom_marque, c.NOM_COULEUR AS couleur, tb.NOM_TYPE AS type_biere
              FROM article AS a
              INNER JOIN marque AS m ON a.ID_MARQUE = m.ID_MARQUE
              INNER JOIN couleur AS c ON a.ID_COULEUR = c.ID_COULEUR
              INNER JOIN typebiere AS tb ON a.ID_TYPE = tb.ID_TYPE
              ORDER BY a.NOM_ARTICLE
              LIMIT $offset, $beersPerPage";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $beers = $stmt->fetchAll(PDO::FETCH_ASSOC);//récup tts lignes renvoyées par reqt et les stocke dans varbl '$beers'

    // calcul nmbr ttl pages en divisant nmbr ttl de bières / nmbr de bières par page (arrondit à entier sup pour assurer que tous les bières s'affiches).
    $queryCount = "SELECT COUNT(*) AS total FROM article";
    $stmtCount = $db->query($queryCount);
    $totalBeers = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalBeers / $beersPerPage);

} catch (PDOException $e) {
    echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
    //fin de exécde = tableau '$beers' avc infos sur ls bières à afficher sur la page et variable '$totalPages' contient nmbr ttl de pages.
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
        <h1>READ BEERS</h1>
        <table class="table">
          <thead>
            <tr>
              <th>Beer Name</th>
              <th>Volume</th>
              <th>Brand Name</th>
              <th>Color</th>
              <th>Type</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($beers as $beer) : ?><!-- itére sur chq élément de '$beers' et >> à chq itération,assigne valeur de l'élément  à varbl '$beer'. (pour chq bière dans '$beers',je peux accéder à ses valeurs grace à varbl '$beer'-->
            <tr>
              <td><?php echo $beer['nom']; ?></td>
              <td><?php echo $beer['VOLUME']; ?></td>
              <td><?php echo $beer['nom_marque']; ?></td>
              <td><?php echo $beer['couleur']; ?></td>
              <td><?php echo $beer['type_biere']; ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

            <!-- Pagination -->
        <div class="pagination">
          <?php if ($currentPage > 1) : ?>
            <a href="readbeer.php?page=<?php echo $currentPage - 1; ?>" class="page-link">Précédent</a>
          <?php endif; ?>

          <?php
            $numPerPage = 80; // Nombre de numéros de page par ligne
            $numRows = ceil($totalPages / $numPerPage); // Nombre de lignes de numéros de page

            for ($row = 0; $row < $numRows; $row++) {
              echo '<div class="pagination-row">';

            for ($i = $row * $numPerPage + 1; $i <= min(($row + 1) * $numPerPage, $totalPages); $i++) {
            if ($i == $currentPage) {
              echo '<a href="readbeer.php?page=' . $i . '" class="page-link active">' . $i . '</a>';
            } 
            else {
              echo '<a href="readbeer.php?page=' . $i . '" class="page-link">' . $i . '</a>';
            }
            }
              echo '</div>';
            }
          ?>
          <?php if ($currentPage < $totalPages) : ?>
            <a href="readbeer.php?page=<?php echo $currentPage + 1; ?>" class="page-link">Suivant</a>
          <?php endif; ?>
        </div>
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
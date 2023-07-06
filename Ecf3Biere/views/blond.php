<?php
include 'header.php'; 
require_once 'database.php';
// Nmbr de bières / page
$biereParPage = 9;

try {
    // Reqt pour récup bières blondes
    $query = "SELECT a.NOM_ARTICLE AS nom, a.VOLUME, m.NOM_MARQUE AS nom_marque, c.NOM_COULEUR AS couleur, tb.NOM_TYPE AS type
    FROM article AS a
    INNER JOIN marque AS m ON a.ID_MARQUE = m.ID_MARQUE
    INNER JOIN couleur AS c ON a.ID_COULEUR = c.ID_COULEUR
    INNER JOIN typebiere AS tb ON a.ID_TYPE = tb.ID_TYPE
    WHERE c.ID_COULEUR = 1"; // tt ls biere "Blonde"(1)

    $stmt = $db->query($query);
    $biereBlonde = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Pagination
    $totalBieres = count($biereBlonde);
    $totalPages = ceil($totalBieres / $biereParPage);
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $biereParPage;
    $biere = array_slice($biereBlonde, $offset, $biereParPage);
    

} catch (PDOException $e) {
    echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
}
?>
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
          <a class="nav-link" href="home.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="beer.php">BEERS</a>
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
     
  <div class="container h-100">
    <div class="text-center">
      <h2>BLOND BEERS</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Faucibus et molestie ac feugiat sed.<br></p><br>
      <br>

      <div class="row">
        <?php foreach ($biere as $beer) { ?>
        <div class="col-md-4">
          <div class="beer-item">
            <h3><?php echo $beer['nom']; ?></h3>
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
        <?php if ($page > 1) : ?>
          <a href="blond.php?page=<?php echo $page - 1; ?>" class="page-link">Précédent</a>
        <?php endif; ?>

        <?php
        $numPerPage = 66; // Nmbre de num de page à affich/ligne
        $numRows = ceil($totalPages / $numPerPage); // Nmbr de lignes de num de page

        for ($row = 0; $row < $numRows; $row++) {
          echo '<div class="pagination-row">';

        for ($i = $row * $numPerPage + 1; $i <= min(($row + 1) * $numPerPage, $totalPages); $i++) {
        if ($i == $page) {
           echo '<a href="blond.php?page=' . $i . '" class="page-link active">' . $i . '</a>';
        } 
        else {
          echo '<a href="blond.php?page=' . $i . '" class="page-link">' . $i . '</a>';
        }
        }
          echo '</div>';
        }
        ?>
        <?php if ($page < $totalPages) : ?>
          <a href="blond.php?page=<?php echo $page + 1; ?>" class="page-link">Suivant</a>
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
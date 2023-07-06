<?php
require_once 'database.php';

try {
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $biereParPage = 400;
    $offset = ($page - 1) * $biereParPage;

    // Reqt pour récup nmbr total de bières
    $queryCount = "SELECT COUNT(*) AS total FROM article";
    $stmtCount = $db->query($queryCount);
    $resultCount = $stmtCount->fetch(PDO::FETCH_ASSOC);
    $totalBieres = $resultCount['total'];

    // Calcul du nmbr total de pages
    $totalPages = ceil($totalBieres / $biereParPage);

    // Rqt pour récup les articles
    $query = "SELECT a.NOM_ARTICLE AS nom, a.VOLUME, m.NOM_MARQUE AS nom_marque, c.NOM_COULEUR AS couleur, tb.NOM_TYPE AS type_biere/*définit chaîne caractères contient requête , pour sélectionner  info tables article, marque, couleur et typebiere.(infos sont renommées)*/
            FROM article AS a/*à partir de quelle table les infos doivent être récup.(renommées ex: 'article' >>'a') simplifie reqt*/ 
            INNER JOIN marque AS m ON a.ID_MARQUE = m.ID_MARQUE/*effectue jointures entre tables sur  base de leurs clés (ex 'a.ID_MARQUE = m.ID_MARQUE' lie table 'article' à table 'marque' sur base de id de la marque.*/ 
            INNER JOIN couleur AS c ON a.ID_COULEUR = c.ID_COULEUR/*  '  '  '  ''   ' '   ''    */
            INNER JOIN typebiere AS tb ON a.ID_TYPE = tb.ID_TYPE/*''        ''     ''       ''*/
            ORDER BY a.NOM_ARTICLE /*ordonne résults par nom article ordre alphab*/
            LIMIT $biereParPage/*limite nmbr résults renvoyés à valeur de '$biereParPage' et commence à afficher résults à partir d''index' spécifié par '$offset'. (pour pagination résults) */
            OFFSET $offset";

    $stmt = $db->query($query);
    $biere = $stmt->fetchAll(PDO::FETCH_ASSOC);/*récup tous résults de requête 'tableau associ' et stocke dans varbl'$biere'*/
} catch(PDOException $e) {/*instruction "catch"attrape tt excep 'PDOException' à l'exécà dans le "try". Si exception message erreur affiché*/ 
    echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
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
            <a class="nav-link" href="home.php">HOME</a>
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

    <div class="container h-100 beer-list-container">
      <div class="text-center">
        <h1>INDEX BEER</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mauris a diam maecenas sed enim ut. Faucibus et molestie ac feugiat sed. Purus viverra accumsan in nisl nisi scelerisque eu. Euismod lacinia at quis risus.<br></p><br>
      </div><br>
      <div class="row">
        <?php foreach ($biere as $index => $beer) { ?>
        <div class="col-md-4">
          <div class="beer-item">
            <h2><?php echo $beer['nom']; ?></h2>
              <p>Volume : <?php echo $beer['VOLUME']; ?></p>
              <p>Marque : <?php echo $beer['nom_marque']; ?></p>
              <p>Couleur : <?php echo $beer['couleur']; ?></p>
              <p>Type de bière : <?php echo $beer['type_biere']; ?></p>
          </div>
        </div>
        <?php } ?> 
      </div>

         <!-- Pagination -->
      <div class="pagination">
        <?php if ($page > 1) : ?>
         <a href="beer.php?page=<?php echo $page - 1; ?>" class="page-link">Back</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= min($totalPages, 4); $i++) : ?>
          <a href="beer.php?page=<?php echo $i; ?>" class="page-link <?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages) : ?>
          <a href="beer.php?page=<?php echo $page + 1; ?>" class="page-link">Next</a>
         <?php endif; ?>
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
 
<?php  //info connex à bdd :hôte (localhost),nom de bdd,nom utilisateur et mdp.
$dbHost = 'localhost';
$dbName = 'sdbm_v2';
$dbUser = 'root';
$dbPass = '';

try {//nouv instance de 'PDO' créée en passant infos de connex comme paramètres.(établit connex à la bdd)
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// pour définir mode gestion erreurs sur 'PDO::ERRMODE_EXCEPTION' (exceptions seront levées si erreur à l'exécution des reqte SQL.
    echo "Connex à bdd établie.";//si ok message
} catch(PDOException $e) {//si non
    echo "Erreur de connexion à bdd : " . $e->getMessage();
}
?>
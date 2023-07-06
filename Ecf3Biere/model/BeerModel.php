<?php
require_once 'database.php';
class BeerModel
{
    private $db;
    public function __construct()
    {
        global $db;// "$db" =vrbl privée
        $this->db = $db;//accé a bdd
    }
    public function getAllBeers()//récup tts bières de bdd
    {
        try {  // reqt exéc avc 'query()' de objet 'PDO' stocké dans '$this->db'.
            $query = "SELECT * FROM article";
            $stmt = $this->db->query($query);
            $beers = $stmt->fetchAll(PDO::FETCH_ASSOC);//résults de reqt récup grace à 'fetchAll()'avc mode 'PDO::FETCH_ASSOC' (renvoie tableau résultats)
            return $beers;
        } catch (PDOException $e) {//excep 'PDOException' >> bloc 'catch' exécuté et affiche message erreur. (renvoie 'false' pour échec dansrécup bières)
            echo "Erreur lors de la récupération des bières : " . $e->getMessage();
            return false;
        }
    }
    public function getBeerById($beerId)//récup 1 bière selon  identifiant - '$beerId' =identifiant bière qu'on veux récup  
    {
        try {
            $query = "SELECT * FROM article WHERE ID_ARTICLE = :beerId";// ":beerId" pour éviter injections SQL.(lié à valeur '$beerId' grace à 'bindParam()' qui assure exéc sécu de reqt.
            $stmt = $this->db->prepare($query);//reqt préparée est exéc ave 'execute()'
            $stmt->bindParam(':beerId', $beerId);
            $stmt->execute();
            $beer = $stmt->fetch(PDO::FETCH_ASSOC);//résult de reqt récup grace à 'fetch()' avec mode "PDO::FETCH_ASSOC" qui renvoie tableau données de la bière.
            return $beer;
        } catch (PDOException $e) {//si excep "PDOException" >> bloc 'catch' est exécut et affiche message erreur.(renvoie false pour échec dans récup de la bière.
            echo "Erreur lors de la récupération de la bière : " . $e->getMessage();
            return false;
        }
    }  
}
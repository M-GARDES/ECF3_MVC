<?php  /*manipulation données relatives à couleur interction avec bdD*/ 
require_once 'database.php';

class ColorModel
{
    private $db;
    public function __construct()
    {
        global $db;
        $this->db = $db;
    }
    public function getAllColors()// récup tts ls couleurs à partir table "colors"
    {
        try {//reqt exécut grace à 'query()' de objet 'PDO' associé à connexion à bdd
            $query = "SELECT * FROM colors";
            $stmt = $this->db->query($query);
            $colors = $stmt->fetchAll(PDO::FETCH_ASSOC);//résult de reqt récup grace à "fetchAll()" avec "PDO::FETCH_ASSOC" qui renvoie tableau de tts les couleurs et leurs données 
            return $colors;
        } catch (PDOException $e) {// si exception "PDOException" >> 'catch' est exéc et affiche message erreur. renvoie false pour échec dans récup des couleurs.
            echo "Erreur lors de la récupération des couleurs : " . $e->getMessage();
            return false;
        }
    }
    public function getColorById($id)//récup couleur à partir de son id.($id)
    {
        try {
            $query = "SELECT * FROM colors WHERE id = :id";//requête contient un paramètre nommé :id qui sera lié à la valeur de $id.
            $stmt = $this->db->prepare($query);//reqt est préparée grace à "prepare()" de objet 'PDO' associé à connex à la bdd
            $stmt->bindParam(':id', $id);//':id' lié à valeur de '$id' grace à 'bindParam()'
            $stmt->execute();//reqt executé
            $color = $stmt->fetch(PDO::FETCH_ASSOC);//résult de requête récupt grace à 'fetch()' avec mode 'PDO::FETCH_ASSOC' >> renvoie tableau avc données de couleur.
            return $color;
        } catch (PDOException $e) {//si exept >> erreur
            echo "Erreur lors de la récupération de la couleur : " . $e->getMessage();
            return false;
        }
    }
}
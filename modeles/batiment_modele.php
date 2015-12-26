<?php
/**
 *
 */
class Batiment_Modele extends Modele{
    public function __construct() {parent::__construct();}

    public function loadBatiments($idPlanete){
      $req = "SELECT id,nom,description,image,niveau FROM BATIMENTS B, CONSTRUIT C WHERE B.id = C.b_id AND C.p_id=".$idPlanete;
      $lesBatiments = array();

      $res = $this->db->query($req);
      foreach ($res as $row) {
        array_push($lesBatiments, new Batiment($row["id"],$row["nom"],$row["description"],$row["image"],$row["niveau"]));
      }
      return $lesBatiments;
    }

    public function initialiseBatiments($idPlanete){
      for($i=1;$i<21;$i++){
        $req = "INSERT INTO CONSTRUIT VALUES(".$idPlanete.",".$i.",0)";
        $this->db->query($req);
      }
    }

    public function loadOneBatiment($idPlanete, $idBatiment){
      $req = "SELECT id,nom,description,image,niveau FROM BATIMENTS B, CONSTRUIT C WHERE B.id = C.b_id AND C.p_id=".$idPlanete." AND C.b_id=".$idBatiment;
      $res = $this->db->query($req);
      foreach($res as $row){
        $leBatiment = new Batiment($row["id"],$row["nom"],$row["description"],$row["image"],$row["niveau"]);
      }
      return $leBatiment;
    }

    public function constructionBatiment($idPlanete,$batiment){
      if(!is_object($batiment)){
        $batiment = $this->loadOneBatiment($idPlanete,$batiment);
      }
      $temps = $batiment->getTempsConstruction();
      $fin = new DateTime();
      $fin->add(new DateInterval('P'.$temps.'I'));

      $req = "INSERT INTO FILE_BATIMENT(p_id,b_id,datefin) VALUES(".$idPlanete.",".$batiment->getId().",'".$fin->format("Y-m-d H:i:s")."')";
      // Datetime mysql = "Y-m-d H:i:s"
      $this->db->query($req);
    }

    //Augmente le batiment d'un niveau et le supprime de la file de recherche
    public function levelUpTechnologie($idPlanete,$idBatiment){
      $req = "UPDATE CONSTRUIT SET `niveau`=`niveau`+1 WHERE p_id=".$idPlanete." AND b_id=".$idBatiment;
      $this->db->query($req);
      $req = "DELETE FROM RECHERCHER WHERE j_id=".$idJoueur." AND t_id=".$idTech;
      $this->db->query($req);
    }
}

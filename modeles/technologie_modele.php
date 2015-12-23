<?php
class Technologie_Modele extends Modele{
  public function __construct() {parent::__construct();}

  //On charge les technologies du joueurs
  public function loadTechnologies($idJoueur){
    $technologies = array();
    $req = "SELECT T.id,nom,description,image,libelle,niveau FROM TECHNOLOGIE T, POSSEDER P, TYPE_TECHNOLOGIE E WHERE T.id = P.t_id AND T.t_id = E.id AND j_id=".$idJoueur;
    $res = $this->db->query($req);

    foreach ($res as $row) {
      array_push($technologies, new Technologie($row["id"],$row["nom"],$row["description"],$row["image"],$row["libelle"],$row["niveau"]));
    }

    return $technologies;
  }

  public function loadOneTechnologie($idJoueur,$idTech){
    $req = "SELECT T.id,nom,description,image,libelle,niveau FROM TECHNOLOGIE T, POSSEDER P, TYPE_TECHNOLOGIE E WHERE T.id = P.t_id AND T.t_id = E.id AND j_id=".$idJoueur." AND T.id=".$idTech;
    $res = $this->db->query($req);
    foreach ($res as $row) {
      $technologie = new Technologie($row["id"],$row["nom"],$row["description"],$row["image"],$row["libelle"],$row["niveau"]);
    }
    return $technologie;
  }

  //Initialise toutes les technologie lors de la 1ere connexion ou inscription
  public function initialisationTechnologies($idJoueur){
    for($i=1;$i<42;$i++){
      $req = "INSERT INTO POSSEDER(j_id,t_id,niveau) VALUES(".$idJoueur.",".$i.",0)";
      $this->db->query($req);
    }
  }

  //$tech est soit l'objet de la technologie soit l'id de la technologie à rechercher
  public function rechercheTechnologie($idJoueur,$tech){
    if(!is_object($tech)){
      $tech = $this->loadOneTechnologie($idJoueur,$tech);
    }
    $temps = $tech->getTempsRecherche();
    $fin = new DateTime();
    $fin->add(new DateInterval('P'.$temps.'I'));

    $req = "INSERT INTO RECHERCHER(j_id,t_id,datefin) VALUES(".$idJoueur.",".$tech->getId().",'".$fin->format("Y-m-d H:i:s")."')";
    // Datetime mysql = "Y-m-d H:i:s"
    $this->db->query($req);
  }

  //Augmente la tech d'un niveau et le supprime de la file de recherche
  public function levelUpTechnologie($idJoueur,$idTech){
    $req = "UPDATE POSSEDER SET `niveau`=`niveau`+1 WHERE j_id=".$idJoueur." AND t_id=".$idTech;
    $this->db->query($req);
    $req = "DELETE FROM RECHERCHER WHERE j_id=".$idJoueur." AND t_id=".$idTech;
    $this->db->query($req);
  }

}

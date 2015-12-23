<?php
class Technologie_Modele extends Modele{
  public function __construct() {parent::__construct();}

  //On charge le nom de toutes les technologies
  public loadTechnologies($array){
    $reqTechnologie = "SELECT T.id,nom,description,image,libelle FROM TECHNOLOGIE T, TYPE_TECHNOLOGIE Y WHERE T.T_id = Y.id";
    $res = $this-db->query($reqTechnologie);

    foreach ($res as $row) {
      $array[$res["nom"]] = new Technologie($res["id"],$res["nom"],$res["description"],$res["image"],$res["libelle"]);
    }
    return $array;
  }
}
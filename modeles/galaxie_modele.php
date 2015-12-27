<?php
/**
 *
 */
class Galaxie_Modele extends Modele{
    public function __construct() {parent::__construct();}

    public function getGalaxies(){
      $nomGalaxie = array();
      $req = "SELECT libelle FROM GALAXIES";
      $res = $this->db->query($req);
      foreach ($res as $row){
        array_push($nomGalaxie,$row["libelle"]);
      }
      return $nomGalaxie;
    }
}

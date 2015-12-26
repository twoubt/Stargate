<?php
/**
 *
 */
class Joueur_Modele extends Modele{
    public function __construct() {parent::__construct();}

    public function initialiseJoueur($unLogin,$unPassword,$unMail){
      $now = new DateTime()->format("Y-m-d H:i:s");
      //On va hacher le mot de passe pour le stocker
      $unPassword = $unPassword;

      //On va récuperer l'ip du joueur
      $unIp = 0;

      $req = "INSERT INTO JOUEUR(login,password,mail,ip,lastconnexion) VALUES('".$unLogin."','".$unPassword."','".$unMail."','".$unIp."','".$now."')";

      $this->db->query($req);
    }

    public function loadJoueur($unLogin){
      $req = "SELECT * FROM JOUEUR WHERE login='".$unLogin."'";
      $res = $this->db->query($req);
      foreach($res as $row){
        $joueur = new Joueur($row["id"],$row["login"],$row["lastconnexion"]);
      }
      return $joueur;
    }
}

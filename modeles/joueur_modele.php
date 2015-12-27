<?php
/**
 *
 */
class Joueur_Modele extends Modele{
    public function __construct() {parent::__construct();}

    public function initialiseJoueur($unLogin,$unPassword,$unMail){
      $now = new DateTime()->format("Y-m-d H:i:s");
      //On va hacher le mot de passe pour le stocker
      $options = ['cost' => 8,];
      $password = password_hash($unPassword, PASSWORD_BCRYPT, $options);

      //On va récuperer l'ip du joueur
      $ip = $_SERVER['REMOTE_ADDR'];
      $req = "INSERT INTO JOUEUR(login,password,mail,ip,lastconnexion) VALUES('".$unLogin."','".$password."','".$unMail."','".$ip."','".$now."')";
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

    public function getIdJoueur($unLogin){
      $req = "SELECT id FROM JOUEUR WHERE login='".$unLogin."'";
      $res = $this->db-query($req);
      foreach($res as $row){
        $id = $row["id"];
      }
      return $id;
    }

    public function deleteJoueur($idJoueur){

    }

    public function testConnexion($login,$motdepasse){
        $req = "SELECT password FROM JOUEUR WHERE login='".$login."'";
        $res = $this->db->query($req);
        foreach($res as $row){
          if(password_verify($motdepasse,$row["password"])){
            return true;
          }else{
            return false;
          }
        }
    }
}

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
      $res = $this->db->query($req)->fetchAll(PDO::FETCH_ASSOC);
      $joueur = new Joueur($res[0]["id"],$res[0]["login"],$res[0]["lastconnexion"]);
      return $joueur;
    }

    public function getIdJoueur($unLogin){
      $req = "SELECT id FROM JOUEUR WHERE login='".$unLogin."'";
      $res = $this->db-query($req)->fetchAll(PDO::FETCH_ASSOC);
      return $res[0]["id"];
    }

    public function deleteJoueur($idJoueur){

    }

    //Le nombre de joueurs connecté
    public function nbConnecte(){
      $req = "SELECT COUNT(*) as nbr FROM CONNECTER";
      $res = $this->db->query($res)->fetchAll(PDO::FETCH_ASSOC);
      return $res[0]["nbr"];
    }

    //Va gerer les joueurs connéctés
    public function estConnecte(){
      $req = "SELECT * FROM CONNECTER";
      $res = $this->db->query($res);
      $lc = new DateTime()->sub(new DateInterval('P5I'));
      foreach($res as $row){
        $dc = new DateTime($row["dateconnexion"]);
        if($dc < $lc){
          $reqDel = "DELETE FROM CONNECTER WHERE j_id=".$row['j_id'];
          $this->db->query($reqDel);
          $reqUpd = "UPDATE JOUEUR SET lastconnexion='".$row['dateconnexion']."' WHERE id=".$row['j_id'];
          $this->db->query($reqUpd);
        }
      }
    }

    public function connexionAJour($idJoueur){
      $reqNbrCo = "SELECT COUNT(*) AS nbr FROM CONNECTER WHERE j_id=".$idJoueur;
      $res = $this->db->query($reqNbrCo)->fetchAll(PDO::FETCH_ASSOC);
      if($res['nbr'] == 0){
        $now = new DateTime()->format('Y-m-d H:i:s');
        $req = "INSERT INTO CONNECTER VALUES (".$idJoueur.",'".$now."')";
        $res = $this->db->query($req);
      }else{
        $now = new DateTime()->format('Y-m-d H:i:s');
        $req = "UPDATE CONNECTER SET `dateconnexion`='".$now."' WHERE j_id=".$idJoueur;
        $res = $this->db->query($req);
      }
    }

    //Savoir si la personne entre les bonnes informations de connexion
    public function testConnexion($login,$motdepasse){
        $req = "SELECT password FROM JOUEUR WHERE login='".$login."'";
        $res = $this->db->query($req)->fetchAll(PDO::FETCH_ASSOC);
        if(password_verify($motdepasse,$res[0]["password"])){
          return true;
        }else{
          return false;
        }
    }
}

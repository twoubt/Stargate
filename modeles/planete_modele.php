<?php
/**
 * Planete_Modele
 * Va permettre de charger ou calculer toutes les données en rapport avec les planètes et leurs intéractions
 * @version 26/12/15 01:51
 * @method construct
 * @method createPlanete
 * @method renamePlanete
 * @method conquerirPlanete
 * @method loadPlanete
 * @method getDistanceBtw
 */
class Planete_Modele extends Modele{
  public function __construct() {parent::__construct();}

  /**
   * Créer une planete pour un nouveau joueur
   * @param int $idJoueur l'id du joueur qui va posséder la planète
   * @param int $idGalaxie l'id de la galaxie dans laquelle se situera la planète
   */
  public function createPlanete($idJoueur=1, $idGalaxie=1){
    $trouver = false; //Va nous permettre de savoir qu'on a trouver une planete
    while(!$trouver){
      $systeme = rand(0,400); //On va tester de manière aléatoire les id des systèmes
      $reqSysteme = "SELECT COUNT(*) AS nbr FROM SYSTEMES_SOLAIRE WHERE id=".$systeme;
      $resSysteme = $this->db->query($reqSysteme);
      $nbr = $resSysteme->fetch()['nbr'];
      //Si le système solaire n'existe pas on le créer et on insere la planete.
      if($nbr == "0"){
        /*   0 1 2 3 4 5 6 7 8 9 10 11 20 ssx
        0   | | | | | | | | | | |  |  |  |
        1   | | | | | | | | | | |  |  |  |
        2   | | | | | | | | | | |  |  |  |
        3   | | | | | | | | | | |  |  |  |
        4   | | | | | | | | | | |  |  |  |
        20  | | | | | | | | | | |  |  |  | id = 400
        ssy
        */
        $ssy = round($systeme/20, 0, PHP_ROUND_HALF_DOWN);
        $ssx = $systeme%20;
        $insSysteme = "INSERT INTO SYSTEMES_SOLAIRE(id,g_id,pos_x,pos_y) VALUES(".$systeme.",".$idGalaxie.",".$ssx.",".$ssy.")";
        $this->db->query($insSysteme);
        $positionPlanete = rand(1,12);
        $trouver = true;
      }else{
        //Sinon on va parcourir la liste des planète existante et dès qu'on trouve une planète vide on insere la nouvelle
        $numPlanete = array(1,2,3,4,5,6,7,8,9,10,11,12); //liste des positions possibles
        $posPrise = array(); //le tableau des positions utilisées
        $reqPlanete = "SELECT position FROM PLANETES WHERE s_id=".$systeme;
        $resPlanete = $this->db->query($reqPlanete);
        foreach ($resPlanete as $row) {
          array_push($posPrise, $row['position']);
        }
        $numPlanete = array_diff($numPlanete,$posPrise);
        if(count($numPlanete) != 0){
          $id = rand(0,(count($numPlanete)-1));
          $positionPlanete = $numPlanete[$id];
          $trouver = true;
        }
      }
    }
    $insPlanete = "INSERT INTO PLANETES(j_id,s_id,position,nom,naquadah,neutronium,fer,trinium) VALUES(".$idJoueur.",".$systeme.",".$positionPlanete.",'nouvelle planete',1000,1000,1000,1000)";
    $this->db->query($insPlanete);
   }

   /**
    * Change le nom de la planète
    * @param int $idPlanete l'id de la planète qui va changer de nom
    * @param string $nom le nouveau nom de la planète
    */
   public function renamePlanete($idPlanete,$nom){
	   $req = "UPDATE PLANETES SET nom='".$nom."' WHERE id=".$idPlanete;
	   $this->db->query($req);
   }

   /**
    * Attribue une planète conquéris à un joueur
    * @param int $idJoueur l'id du joueur
    * @param int $idSysteme l'id du système solaire
    * @param int $position la position de la planete dans le systeme solaire
    */
   public function conquerirPlanete($idJoueur,$idSysteme,$position){
     $req = "INSERT INTO PLANETES(j_id,s_id,position,nom,naquadah,neutronium,fer,trinium) VALUES(".$idJoueur.",".$idSysteme.",".$position.",'nouvelle planete',1000,1000,1000,1000)";
     $this->db->query($req);
   }

   /**
    * Charge la planète et retourne les données
    * @param int $idPlanete l'id de la planète
    * @return Planete objet avec les données de la planète demandées
    */
   public function loadPlanete($idPlanete){
     $req = "SELECT * FROM PLANETES WHERE id=".$idPlanete;
     $res = $this->db->query($req);
     foreach($res as $row){
       return new Planete($idPlanete,$row["position"],$row["nom"],$row["naquadah"],$row["neutronium"],$row["fer"],$row["trinium"]);
     }
   }

   /**
    * Calcul la distance entre deux planètes
    * @param int $idPlaneteA l'id de la planète de départ
    * @param int $idPlaneteB l'id de la planète d'arrivée
    * @return int $distance la distance entre les deux planètes (exprimé en nbr de planètes)
    */
   public function getDistanceBtw($idPlaneteA,$idPlaneteB){
     $req = "SELECT G.id,pos_x,pos_y,position FROM GALAXIES G, SYSTEMES_SOLAIRE S, PLANETES P WHERE P.s_id = S.id AND S.g_id = G.id AND P.id=".$idPlaneteA;
	   $res = $this->db->query($req);
     //On récupère les infos de la planète A
     foreach ($res as $row){
       $gA = $row["id"];
       $ssxA = $row["pos_x"];
       $ssyA = $row["pos_y"];
       $posA = $row["position"];
     }

     $req = "SELECT G.id,pos_x,pos_y,position FROM GALAXIES G, SYSTEMES_SOLAIRE S, PLANETES P WHERE P.s_id = S.id AND S.g_id = G.id AND P.id=".$idPlaneteB;
	   $res = $this->db->query($req);
     //On récupères les infos de la planète B
     foreach ($res as $row){
       $gB = $row["id"];
       $ssxB = $row["pos_x"];
       $ssyB = $row["pos_y"];
       $posB = $row["position"];
     }

     $distance = 0;
     //On commence par savoir si les deux planètes sont dans le même système solaire
     if($gA != $gB){
       $distance += 1500; //A modifier pour augmenter la distance entre toutes les galaxies
       $distance += ceil(sqrt(($ssxA**2)+($ssyA**2))); //distance pour sortir de sa galaxie
       $distance += ceil(sqrt(($ssxB**2)+($ssyB**2))); //distance pour rejoindre B dès l'entrée de la nouvelel galaxie
       $distance += $posA+$posB-2; //distance pour sortir de son système solaire
     }else{
       //Si ils sont dans la même galaxie
       $distance += ceil(sqrt((($ssxB-$ssxA)**2)+(($ssyB-$ssyA)**2)));
       $distance += $posA+$posB-2; //distance pour sortir de son système solaire
     }

     return $distance;
     //Formule : AB = racine( (xB-xA)² + (yB -yA)² )
   }

   public function calculRessourcesPlanetes($idJoueur){
     $niveauFer = array();
     $niveauTrinium = array();
     $niveauNaquadah = array();
     $niveauNeutronium = array();
     $idPlanetes = array();
     $req = "SELECT lastconnexion FROM JOUEUR WHERE id=".$idJoueur;
     $res = $this->db->query($req);
     $now = new DateTime();
     foreach($res as $row) {
       $lastconnexion = new DateTime($row["lastconnexion"]);
     }
     $connexion = $now->diff($lastconnexion);
     $connexion = $connexion->format('%h'); //Nombre d'heure entre les deux connexion
     $reqIdPlanete = "SELECT id FROM PLANETES WHERE j_id=".$idJoueur;
     $resIdPlanete = $this->db->query($reqIdPlanete);
     foreach($resIdPlanete as $row){
       $reqFer = "SELECT niveau FROM CONSTRUIT WHERE p_id=".$row["id"]." AND b_id=1";
       $reqTrinium = "SELECT niveau FROM CONSTRUIT WHERE p_id=".$row["id"]." AND b_id=2";
       $reqNaquadah = "SELECT niveau FROM CONSTRUIT WHERE p_id=".$row["id"]." AND b_id=3";
       $reqNeutronium = "SELECT niveau FROM CONSTRUIT WHERE p_id=".$row["id"]." AND b_id=4";
       /*$reqForFer = "SELECT niveau FROM CONSTRUIT WHERE p_id=".$row["id"]." AND b_id=12";
       $reqForTri = "SELECT niveau FROM CONSTRUIT WHERE p_id=".$row["id"]." AND b_id=13";
       $reqForExpl = "SELECT niveau FROM CONSTRUIT WHERE p_id=".$row["id"]." AND b_id=14";
       $reqForNeu = "SELECT niveau FROM CONSTRUIT WHERE p_id=".$row["id"]." AND b_id=15";*/
       array_push($idPlanetes,$row["id"]);

       foreach($this->db->query($reqFer) as $row){
         array_push($niveauFer,$row["niveau"]);
       }
       foreach($this->db->query($reqTrinium) as $row){
         array_push($niveauTrinium,$row["niveau"]);
       }
       foreach($this->db->query($reqNaquadah) as $row){
         array_push($niveauNaquadah,$row["niveau"]);
       }
       foreach($this->db->query($reqNeutronium) as $row){
         array_push($niveauNeutronium,$row["niveau"]);
       }
     }
     for($i=0;$i<count($niveauFer);$i++){
       $ressourcesNaquadah = $niveauNaquadah[$i]; //calcul des ressources en plus
       $ressourcesNeutronium = $niveauNeutronium[$i];
       $ressourcesFer = $niveauFer[$i];
       $ressourcesTrinium = $niveauTrinium[$i];
       $reqMAJRessource = "UPDATE PLANETES SET `naquadah`=`naquadah`+".$ressourcesNaquadah.",`neutronium`=`neutronium`+".$ressourcesNeutronium.", `fer`=`fer`+".$ressourcesFer.", `trinium`=`trinium`+".$ressourcesTrinium." WHERE id=".$idPlanetes[$i];
     }
   }
}

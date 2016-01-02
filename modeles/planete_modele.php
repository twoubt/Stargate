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
      $ssx = rand(0,20);
      $ssy = rand(0,20);
      $reqNbrSys = "SELECT COUNT(*) as nbr FROM `SYSTEMES_SOLAIRE` WHERE `g_id`=".$idGalaxie." AND `pos_x`=".$ssx." AND `pos_y`=".$ssy;
      $resNbr = $this->db->query($reqNbrSys)->fetchAll(PDO::FETCH_ASSOC);
      if($resNbr[0]['nbr']==0){
        $insSys = "INSERT INTO SYSTEMES_SOLAIRE(g_id,pos_x,pos_y) VALUES(".$idGalaxie.",".$ssx.",".$ssy.")"
        $this->db->query($insSys);
        $posPlanete = rand(1,10);
        $selIdSys = "SELECT id FROM SYSTEMES_SOLAIRE WHERE `g_id`=".$idGalaxie." AND `pos_x`=".$ssx." AND `pos_y`=".$ssy;
        $idSys = $this->db->query($selIdSys)->fetchAll(PDO::FETCH_ASSOC);
        $reqInsert = "INSERT INTO PLANETES(j_id,s_id,position,nom,naquadah,neutronium,fer,trinium) VALUES(".$idJoueur.",".$idSys[0]["id"].",".$posPlanete.",'nouvelle planete',1000,1000,1000,1000)";
        $trouver = true;
      }else{
        $selIdSys = "SELECT id FROM SYSTEMES_SOLAIRE WHERE `g_id`=".$idGalaxie." AND `pos_x`=".$ssx." AND `pos_y`=".$ssy;
        $idSys = $this->db->query($selIdSys)->fetchAll(PDO::FETCH_ASSOC);
        $reqPosPlanete = "SELECT position FROM PLANETES WHERE s_id=".$idSys[0]["id"];
        $resPosPlanete = $this->db->query($reqPosPlanete)->fetchAll(PDO::FETCH_ASSOC);
        $posPlanete = array();
        for($i=0;$i<count($resPosPlanete);$i++){
          array_push($posPlanete, $resPosPlanete[$i]['id']);
        }
        $listePos = array(1,2,3,4,5,6,7,8,9,10);
        $posDispo = array_diff($listePos,$posPlanete);
        if(count($posDispo) != 0){
          $id = rand(0,(count($posDispo)-1));
          $positionPlanete = $posDispo[$id];
          $reqInsert = "INSERT INTO PLANETES(j_id,s_id,position,nom,naquadah,neutronium,fer,trinium) VALUES(".$idJoueur.",".$idSys[0]["id"].",".$positionPlanete.",'nouvelle planete',1000,1000,1000,1000)";
          $trouver = true;
        }
      }

      $this->db->query($reqInsert);
    }
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
    * Retourne toutes les id des planète d'un joueur (forme [x]["id"])
    * @param int $idJoueur l'id du joueur pour lequel on veut les id des planètes
    * @return array liste des id des planètes
    */
   public function getIdPlanetes($idJoueur){
     $req = "SELECT id FROM PLANETE WHERE j_id=".$idJoueur;
     $res = $this->db->query($req)->fetchAll(PDO::FETCH_ASSOC);
     return $res;
   }

   /**
    * Charge la planète et retourne les données
    * @param int $idPlanete l'id de la planète
    * @return Planete objet avec les données de la planète demandées
    */
   public function loadPlanete($idPlanete){
     $req = "SELECT * FROM PLANETES WHERE id=".$idPlanete;
     $res = $this->db->query($req)->fetchAll(PDO::FETCH_ASSOC);
       return new Planete($idPlanete,$res[0]["position"],$res[0]["nom"],$res[0]["naquadah"],$res[0]["neutronium"],$res[0]["fer"],$res[0]["trinium"]);
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
	   $res = $this->db->query($req)->fetchAll(PDO::FETCH_ASSOC);
     //On récupère les infos de la planète A
     $gA = $res[0]["id"];
     $ssxA = $res[0]["pos_x"];
     $ssyA = $res[0]["pos_y"];
     $posA = $res[0]["position"];

     $req = "SELECT G.id,pos_x,pos_y,position FROM GALAXIES G, SYSTEMES_SOLAIRE S, PLANETES P WHERE P.s_id = S.id AND S.g_id = G.id AND P.id=".$idPlaneteB;
	   $res = $this->db->query($req)->fetchAll(PDO::FETCH_ASSOC);
     //On récupères les infos de la planète B
     $gB = $res[0]["id"];
     $ssxB = $res[0]["pos_x"];
     $ssyB = $res[0]["pos_y"];
     $posB = $res[0]["position"];

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

   /**
    * Calcul les ressources de toutes les planètes d'un joeur
    * @param int $idJoueur l'id du joueur pour lequel on veut calculer les ressources
    */
   public function calculRessourcesPlanetes($idJoueur){
     $tabBatiments = array(); //tableau qui va prendre le niveau des batiments des planètes
     $idPlanete = $this->getIdPlanetes($idJoueur); //on récupère la liste des id des planètes que le joueur possède
     $reqDateCon = "SELECT dateconnexion FROM CONNECTER WHERE j_id=".$idJoueur;
     $resDateCon = $this->db->query($reqDerCon)->fetchAll(PDO::FETCH_ASSOC);
     $now = new DateTime();
     //on test si le joueur est connecter
     if(count($resDerCon)==0){
       //s'il est pas connecté on prend la derniere connexion
       $reqDernConn = "SELECT lastconnexion FROM JOUEUR WHERE id=".$idJoueur;
       $resDernConn = $this->db->query($reqDernConn)->fetchAll(PDO::FETCH_ASSOC);
       $lastConn = new DateTime($resDernConn[0]["lastconnexion"]);
       //On met à jour sa derniere connexion pour ne pas recalculer les ressources
       $reqUpdConn = "UPDATE JOUEUR SET lastconnexion='".$now->format('Y-m-d H:i:s')."'";
       $this->db->query($reqUpdConn);
     }else{
       //Si il est connecté on prend la date de derniere connexion
       $lastConn = new DateTime($resDateCon[0]["dateconnexion"]);
       //On met à jour sa date de connection
       $reqUpdConn = "UPDATE CONNECTER SET dateconnexion='".$now->format('Y-m-d H:i:s')."'";
       $this->db->query($reqUpdConn);
     }
     //le temps entre le moment present et la derniere connexion
     $secondePassee = $now->getTimestamp() - $lastConn->getTimestamp();
     //On récupère les niveaux des batiments de ressources pour chaque planètes et on fait le calcul des ressources par secondes
     for($i=0;$i<count($idPlanete);$i++){
       $reqNiveau = "SELECT niveau FROM CONSTRUIT WHERE `p_id`=".$idPlanete[$i]["id"]." AND `b_id`=1 OR `b_id`=2 OR `b_id`=3 OR `b_id`=4 OR `b_id`=12 OR `b_id`=13 OR `b_id`=14 OR `b_id`=15";
       $res = $this->db->query($reqNiveau)->fetchAll(PDO::FETCH_ASSOC);
       //On remplis le tableau avec les informations concernant l'id de la planete et les ressources en plus
       $tabBatiments[$i]["id_planete"] = $idPlanete[$i]["id"];
       $resMineFer = (((40 * $res[0]["niveau"] * pow(1.1,$res[0]["niveau"]))/3600)*$secondePassee);
       $tabBatiments[$i]["mine_fer"] = round($resMineFer,2,PHP_ROUND_HALF_DOWN);
       $resMineTrinium = (((30 * $res[1]["niveau"] * pow(1.1,$res[1]["niveau"]))/3600)*$secondePassee);
       $tabBatiments[$i]["mine_trinium"] = round($resMineTrinium,2,PHP_ROUND_HALF_DOWN);
       $resMineNaq = (((20 * $res[2]["niveau"] * pow(1.1,$res[2]["niveau"]))/3600)*$secondePassee);
       $tabBatiments[$i]["mine_naq"] = round($resMineNaq,2,PHP_ROUND_HALF_DOWN);
       $resMineNeut = (((10 * $res[3]["niveau"] * pow(1.1,$res[3]["niveau"]))/3600)*$secondePassee);
       $tabBatiments[$i]["mine_neut"] = round($resMineNeut,2,PHP_ROUND_HALF_DOWN);
       /*
       $tabBatiments[$i]["for_fer"] = $res[4]["niveau"];
       $tabBatiments[$i]["for_tri"] = $res[5]["niveau"];
       $tabBatiments[$i]["exp_unas"] = $res[6]["niveau"];
       $tabBatiments[$i]["for_neut"] = $res[7]["niveau"];*/
     }

     //On va parcourir la liste des niveau des batiments
     for($i=0;$i<count($tabBatiments);$i++){
       $reqUpdate = "UPDATE `PLANETES` SET `naquadah`=`naquadah`+".$tabBatiments[$i]['mine_naq']." ,`neutronium`=`neutronium`+".$tabBatiments[$i]["mine_neut"]." ,`fer`=`fer`+".$tabBatiments[$i]["mine_fer"].", `trinium`=`trinium`+".$tabBatiments[$i]["mine_trinium"]." WHERE id=".$tabBatiments[$i]["id_planete"];
       $this->db->query($reqUpdate);
     }
   }
}

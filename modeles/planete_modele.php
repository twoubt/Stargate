<?php
class Planete_Modele extends Modele{
  public function __construct() {parent::__construct();}

  public function createPlanete($idJoueur=1, $idGalaxie=1){
    $trouverSysteme = false; //Va nous permettre de savoir qu'on a trouver une planete

    while(!$trouverSysteme){
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
        $trouverSysteme = true;
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
          $trouverSysteme = true;
        }
      }

    }
    $insPlanete = "INSERT INTO PLANETES(j_id,s_id,position,nom,naquadah,neutronium,fer,trinium) VALUES(".$idJoueur.",".$systeme.",".$positionPlanete.",'nouvelle planete',1000,1000,1000,1000)";
    $this->db->query($insPlanete);
   }

}

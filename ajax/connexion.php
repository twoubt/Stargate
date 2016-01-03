<?php
require_once "./modele/joueur_modele.php";
require_once "./modele/planete_modele.php";
require_once "./modele/batiment_modele.php";
require_once "./lib/joueur.php";
require_once "./lib/batiment.php";
require_once "./lib/planete.php";
$connexion = new Joueur_Modele();
$valider = $connexion->testConnexion($_POST["username"],$_POST["password"]);
if($valider){
  $planetes = new Planete_Modele();
  $batiment = new Batiment_Modele();
  //On va charger la session avec les informations de l'utilisateur
  $_SESSION["joueur"] = $connexion->loadJoueur($_POST["username"]);
  $id = $_SESSION["joueur"]->getId();
  $_SESSION["planete"] = $planetes->loadAllPlanetes($id);
  $_SESSION["planete_actuel"] = 0; //Indice sur laquelle le joueur va arriver lors de la connexion
  //On charge les batiments dans les planetes
  for($i=0;$i<count($_SESSION["planete"]);$i++){
    $idPlanete = $_SESSION["planete"][$i]->getId();
    $_SESSION["planete"][$i]->setBatiments($batiment->loadBatiments($idPlanete));
  }
  //On l'ajoute dans les joueurs connectés
  $connexion->connexionAJour($id);
  $planetes->calculRessourcesPlanetes($id);
  return true;
}else{
  return false;
}

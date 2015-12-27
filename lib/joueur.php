<?php
/**
 * Joueur
 * Objet qui correspond au joueur
 * @version 27/12/15 16:39
 * @method construct
 * @method getId
 * @method setId
 * @method getLogin
 * @method setLogin
 * @method getLastConnexion
 * @method setLastConnexion
 * @method getPlanetes
 * @method setPlanetes
 * @method addPlanete
 * @method getTechnologies
 * @method setTechnologies
 */
class Joueur{

  private $id;
  private $login;
  private $lastconnexion;
  private $lesPlanetes = array();
  private $lesTechnologies = array();

  function __construct($unId,$unLogin,$uneLastConnexion){
    $this->id = $unId;
    $this->login = $unLogin;
    $this->lastconnexion = $uneLastConnexion;
  }

  public function getId(){
    return $this->id;
  }

  public function setId($unId){
    $this->id = $unId;
  }

  public function getLogin(){
    return $this->login;
  }

  public function setLogin($unLogin){
    $this->login = $unLogin;
  }

  public function getLastConnexion(){
    return $this->lastconnexion;
  }

  public function setLastConnexion($uneLastConnexion){
    $this->lastconnexion = $uneLastConnexion;
  }

  public function getPlanetes(){
    return $this->lesPlanetes;
  }

  public function setPlanetes($desPlanetes){
    if(is_array($desPlanetes)){
      $this->lesPlanetes = $desPlanetes;
    }else{
      if(is_object($desPlanetes)){
        array_push($this->lesPlanetes, $desPlanetes);
      }else{
        return "Veuillez ajouter un/des objets en entré";
      }
    }
  }

  public function addPlanete($unePlanete){
    if(is_object($unePlanete)){
      array_push($this->lesPlanetes, $unePlanete);
    }else{
      return "Veuillez ajouter un objet en entrée";
    }
  }

  public function getTechnologies(){
    return $this->lesTechnologies;
  }

  public function setTechnologies($desTechnologies){
    if(is_array($desTechnologies)){
      $this->lesTechnologies = $desTechnologies;
    }else{
      if(is_object($desTechnologies)){
        array_push($this->lesTechnologies, $desTechnologies);
      }else{
        return "Veuillez ajouter un/des objets ou un tableau en entré";
      }
    }
  }
}

<?php
/**
 *
 */
class Systeme_Solaire{
  private $posX;
  private $posY;
  private $planetes = array();

  function __construct($unePosX,$unePosY,$desPlanetes){
    $this->posX = $unePosX;
    $this->posY = $unePosY;
    $this->planetes = $desPlanetes;
  }

  public function getPosX(){
    return $this->posX;
  }

  public function setPosX($unePosX){
    $this->posX = $unePosX;
  }

  public function getPosY(){
    return $this->posY;
  }

  public function setPosY($unePosY){
    $this->posY = $unePosY;
  }

  public function addPlanetes($unePlanete){
    array_push($this->planetes,$unePlanete);
  }

  public function searchPlanete($idPlanete){
    for($i=0;$i<count($this->planetes);$i++){
      if($this->planetes->getId() == $idPlanete){
        return $this->planetes[$i];
      }
    }
  }

}

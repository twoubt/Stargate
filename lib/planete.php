<?php
/**
 *
 */
class Planete{
  private $id;
  private $position;
  private $nom;
  private $naquadah;
  private $neutronium;
  private $fer;
  private $trinium;

  function __construct($unId,$unePosition,$unNom,$duNaquadah,$duNeutronium,$duFer,$duTrinium){
    $this->id = $unId;
    $this->position = $unePosition;
    $this->nom = $unNom;
    $this->naquadah = $duNaquadah;
    $this->neutronium = $duNeutronium;
    $this->fer = $duFer;
    $this->trinium = $duTrinium;
  }

  public function getId(){
    return $this->id;
  }

  public function setNaquadah($duNaquadah){
    $this->naquadah = $duNaquadah;
  }

  public function getNaquadah(){
    return $this->naquadah;
  }

  public function setNeutronium($duNeutronium){
    $this->neutronium = $duNeutronium;
  }

  public function getNeutronium(){
    return $this->neutronium;
  }

  public function setFer($duFer){
    $this->fer = $duFer;
  }

  public function getFer(){
    return $this->fer;
  }

  public function setTrinium($duTrinium){
    $this->trinium = $duTrinium;
  }

  public function getTrinium(){
    return $this->trinium;
  }

  public function getPosition(){
    return $this->position;
  }

}

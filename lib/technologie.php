<?php
/**
 *
 */
class Technologie{
  private $id;
  private $nom;
  private $description;
  private $image;
  private $type;

  function __construct($unId,$unNom,$uneDescription,$uneImage,$unType){
    $this->id = $unId;
    $this->nom = $unNom;
    $this->description = $uneDescription;
    $this->image = $uneImage;
    $this->type = $unType;
  }

  public function getId(){
    return $this->id;
  }

  public function getNom(){
    return $this->nom;
  }

  public function getDescription(){
    return $this->description;
  }

  public function getImage(){
    return $this->image;
  }

  public function getType(){
    return $this->type;
  }
}

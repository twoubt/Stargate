<?php
/**
 *
 */
class Batiment{
  private $id;
  private $nom;
  private $description;
  private $image;
  private $niveau;

  function __construct($unId,$unNom,$uneDescription,$uneImage,$unNiveau=0){
    $this->id = $unId;
    $this->nom = $unNom;
    $this->description = $uneDescription;
    $this->image = $uneImage;
    $this->niveau = $unNiveau;
  }

  public function getId(){
    return $this->id;
  }

  public function setId($unId){
    $this->id = $unId;
  }

  public function getNom(){
    return $this->nom;
  }

  public function setNom($unNom){
    $this->nom = $unNom;
  }

  public function getDescription(){
    return $this->description;
  }

  public function setDescription($uneDescription){
    $this->description = $uneDescription;
  }

  public function getImage(){
    return $this->image;
  }

  public function setImage($uneImage){
    $this->image = $uneImage;
  }

  public function getNiveau(){
    return $this->niveau;
  }

  public function setNiveau($unNiveau){
    $this->niveau = $unNiveau;
  }

  //Retourne le tableau des couts pour la construction du batiment
  public function getCoutConstruction(){
    $cout = array();
    $cout['fer'] = 1000 * pow(2,$this->getNiveau()-1);
    $cout['naquadah'] = 800 * pow(2,$this->getNiveau()-1);
    $cout['neutronium'] = 700 * pow(2,$this->getNiveau()-1);
    $cout['trinium'] = 900 * pow(2,$this->getNiveau()-1);
    return $cout;
  }

  //On retourne le temps en minute qu'il faut pour que la construction s'effectue
  public function getTempsConstruction(){
    $cout = $this->getCoutRecherche();
    $coutTotal = 0;
    foreach ($cout as $key => $value) {
      $coutTotal += $value;
    }
    return (($coutTotal) / 1000);
  }
}

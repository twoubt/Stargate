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
  private $niveau;

  function __construct($unId,$unNom,$uneDescription,$uneImage,$unType,$unNiveau=0){
    $this->id = $unId;
    $this->nom = $unNom;
    $this->description = $uneDescription;
    $this->image = $uneImage;
    $this->type = $unType;
    $this->niveau = $unNiveau;
  }

  public function getNiveau(){
    return $this->niveau;
  }

  public function setNiveau($unNiveau){
    $this->niveau = $unNiveau;
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

  //Retourne le tableau des couts pour la recherche
  public function getCoutRecherche(){
    $cout = array();
    $cout['fer'] = 1000 * pow(2,$this->getNiveau()-1);
    $cout['naquadah'] = 1000 * pow(2,$this->getNiveau()-1);
    $cout['neutronium'] = 1000 * pow(2,$this->getNiveau()-1);
    $cout['trinium'] = 1000 * pow(2,$this->getNiveau()-1);
    return $cout;
  }

  //On retourne le temps en minute qu'il faut pour que la recherche s'effectue, on prend le niveau du labo en entrée
  public function getTempsRecherche($niveauLabo){
    $cout = $this->getCoutRecherche();
    $coutTotal = 0;
    foreach ($cout as $key => $value) {
      $coutTotal += $value;
    }
    return (($coutTotal*2) / (1000 * ($niveauLabo)));//niv1:4min; niv2:8min; niv3:16min; niv4:64min; niv5:108min;
  }
}

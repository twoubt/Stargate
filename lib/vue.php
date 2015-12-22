<?php
class Vue{

  //Variable qui va stocker toutes les infos de la page
  private $donnees = array();
  private $vue;

  public function __construct(){
    $vue = null;
    $this->donnees['site_title'] = '';
    $this->donnees['site_icone'] = '';
    $this->donnees['bootstrap'] = '';
    $this->donnees['description'] = '';

    $this->donnees['style_css'] = '';
    $this->donnees['script_js'] = '';
  }

  public function getDonnees(){
    return $this->donnees;
  }

  public function assign($var = '', $val){
    if($var == ''){
      $this->donnees = $val;
    }else{
      $this->donnees[$var] = $val;
    }
  }

  public function setBootstrap(){
     $this->donnees['bootstrap'] = '<meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">';
  }

  public function setCharSet($var="UTF-8"){
    $this->donnees['charset'] = "<meta charset='$var'>";
  }

  public function setTitle($var){
    $this->donnees['site_title'] = "<title>$var</title>";
  }

  public function setIcone($filename){
    if(file_exists(WEBROOT.DS.'space'.DS.'public'.DS.'img'.DS.$filename)){
      $this->donnees['site_icone'] = "<link rel='icon' type='image/png' href='public".DS.'img'.DS.$filename."' />";
    }
  }

  public function setDescription($var){
    $this->donnees['description'] = '<meta name="description" content="'.$var.'" />';
  }

  public function setCSS($filename = 'style.css'){
    if(is_array($filename)){
      for($i = 0; $i < count($filename); $i++){
        $this->donnees['style_css'] .= "<link rel='stylesheet' href='public".DS.'css'.DS.$filename[$i]."'>";
      }
    }else{
      $this->donnees['style_css'] .= "<link rel='stylesheet' href='public".DS.'css'.DS.$filename."'>";
    }
  }

  public function setJS($filename){
    if(is_array($filename)){
      for($i = 0; $i < count($filename); $i++){
        $this->donnees['script_js'] .= "<script type='text/javascript' src='public".DS.'js'.DS.$filename[$i]."'></script>";
      }
    }else{
      $this->donnees['script_js'] .= "<script type='text/javascript' src='public".DS.'js'.DS.$filename."'></script>";
    }
  }

  public function render($view, $sortie_directe = true){
    //On va enregistrer dans file le chemin de la vue
    if(substr($view, -4) == ".php"){
			$fichier = $view;
		}else{
      $fichier = ROOT . DS . 'vues' . DS . strtolower($view) . '.php';
    }

    //On va tester si le fichier de la vue existe
    if(file_exists($fichier)){
      $this->vue = $fichier;
    }else{
      return "La vue n'existe pas";
    }


    if ($sortie_directe !== TRUE) {
        // Enclenche la temporisation de sortie, mise en tampon
      ob_start();
    }

    $donnees = $this->getDonnees();

    include($this->vue);

    if ($sortie_directe !== TRUE) {
        //Lit le contenu courant du tampon de sortie puis l'efface
      return ob_get_clean();
    }
  }

}

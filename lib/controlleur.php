<?php
  class Controlleur{
    protected $vue;
    protected $modele;

    public function __construct(){
      $this->vue = new Vue();
    }

    public function getVue(){
      return $this->vue;
    }

    public function index(){
		    $this->assign('contenu', "C'est la classe index avec la méthode index, cette méthode n'est pas encore définie");
	  }

    public function assign($var, $val){
      $this->vue->assign($var, $val);
    }

    public function loadModel($name){
      $modelName = $name . '_Modeles';
      $this->model = new $modelName();
    }

  }

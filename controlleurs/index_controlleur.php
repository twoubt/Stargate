<?php
/**
*
*/
class Index_Controlleur extends Controlleur{

    public function __construct() {
		parent::__construct();
	}

	function index(){
		//Mise en place des infos de la page
		$this->vue->setCharSet();
		$this->vue->setTitle(' ');
		$this->vue->setDescription(' ');
    $css = array('bootstrap.css','accueilStyle.css');
		$this->vue->setCSS($css);
		$this->vue->setBootstrap();

		$scriptJS = array('jquery.js','bootstrap.js');
		$this->vue->setJs($scriptJS);
		/*exemple d'insertion d'une partie
		$footer = new Vue();
		$this->vue->assign('footer', $footer->render('index'.DS.'footer', false));*/

    $header = new Vue();
    $this->vue->assign('header', $header->render('index'.DS.'header', false));

    $menu = new Vue();
<<<<<<< HEAD
=======
    $menu->assign('galaxies', new Batiment_Modele()->getGalaxies(), false);
>>>>>>> origin/master
    $this->vue->assign('menu', $menu->render('index'.DS.'accueilPage', false));

    $footer = new Vue();
    $this->vue->assign('footer', $footer->render('index'.DS.'footer', false));

		$this->vue->render('index'.DS.'index');
	}
}

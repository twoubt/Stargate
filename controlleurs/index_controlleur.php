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
		$this->vue->setTitle();
		$this->vue->setDescription();
		$this->vue->setCSS();
		$this->vue->setBootstrap();

		$scriptJS = array('Jquery.js');
		$this->vue->setJs($scriptJS);
		/*exemple d'insertion d'une partie
		$footer = new Vue();
		$this->vue->assign('footer', $footer->render('index'.DS.'footer', false));*/

		$this->vue->render('index'.DS.'index');
	}
}
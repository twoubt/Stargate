<?php
  class Routeur{
		static function chemin(){
      global $url;

      if(!isset($url)){
        $controlleur = DEFAULT_CONTROLLER;
        $action = DEFAULT_ACTION;
      }else{
        $urldecompose = array();
        $urldecompose = explode(DS, $url);
        $controlleur = $urldecompose[0];
        $action = (isset($urldecompose[1]) && $urldecompose[1] != '') ? $urldecompose[1] : DEFAULT_ACTION;
      }

      $classe = ucfirst($controlleur).'_Controlleur';

      if (class_exists($classe) && (int)method_exists($classe, $action)) {        
        $controlleur = new $classe;
        $controlleur->$action();
      }else{

        global $url;
        
        die('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
              <html><head>
                  <title>404 Not Found</title>
              </head><body>
              <h1>Not Found</h1>
              <p>The requested URL '.$url.' was not found on this server.</p>
              </body></html>');
      }
    }
  }

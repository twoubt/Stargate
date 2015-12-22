<?php
  class Autoloader{
    static function register(){
      spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class){
      if(file_exists(ROOT.DS.'controlleurs'.DS.strtolower($class).'.php')){
        require_once(ROOT.DS.'controlleurs'.DS.strtolower($class).'.php');
        
      }else if(file_exists(ROOT.DS.'lib'.DS.strtolower($class).'.php')){
        require_once(ROOT.DS.'lib'.DS.strtolower($class).'.php');

      }else if(file_exists(ROOT.DS.'modeles'.DS.strtolower($class).'.php')){
        require_once(ROOT.DS.'modeles'.DS.strtolower($class).'.php');

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

<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

$url = isset($_GET['url']) ? $_GET['url'] : null;

require_once(ROOT.DS.'config'.DS.'config.php');

require_once(ROOT.DS.'lib'.DS.'genplanete.php');

require_once(ROOT.DS.'lib'.DS.'autoloader.php');
Autoloader::register();

require_once(ROOT.DS.'lib'.DS.'routeur.php');
Routeur::chemin();

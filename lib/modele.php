<?php
  class Modele{
      private $dsn;
		  private $user;
		  private $pcw;
		  protected $db;

      public function __construct(){
        $this->dsn = "mysql:dbname=stargate;host=192.168.1.109";
        $this->user = "root";
        $this->pcw = "raspberry";
        $this->db = new PDO($this->dsn, $this->user, $this->pcw, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      }

      public function setConnexion($dsn, $user, $pcw){
        $this->db = new PDO($dsn, $user, $pcw, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      }

      public function getConnexion(){
        return $this->db;
      }
  }

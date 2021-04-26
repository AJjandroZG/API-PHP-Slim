<?php
class db{
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;

    public function __construct(){
      $this->dbHost = $_ENV['DB_HOST'];
      $this->dbUser = $_ENV['DB_USER'];
      $this->dbPass = $_ENV['DB_PASS'];
      $this->dbName = $_ENV['DB_NAME'];
    }
    //conección 
    public function conectDB(){
      try {
        $mysqlConnect = "mysql:host=$this->dbHost;dbname=$this->dbName";
        $dbConnecion = new PDO($mysqlConnect, $this->dbUser, $this->dbPass);
        $dbConnecion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnecion;
      } catch (PDOException $e) {
      }
    }
  }
?>
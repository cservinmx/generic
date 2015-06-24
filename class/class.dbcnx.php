<?php
/*
* @Credit: 		Carlos Servin 2015 
* @copyright	Copyright (C) 2015 Carlos Servin. http://www.servin.mx
*/

class Conexion{
	
    private static $instancia;
    private $dbh;
	
	private $bd_host='localhost';
	private $bd_user='root';
	private $bd_password='root';
	private $bd_data_base='test';
	
    private function __construct(){
        try {
        	$bd_host=$this->bd_host;
			$bd_user=$this->bd_user;
			$bd_password=$this->bd_password;
			$bd_data_base=$this->bd_data_base;
			$this->dbh = new PDO('mysql:host=localhost;dbname=test', 'root', 'root');
 			   
            $this->dbh->exec("SET CHARACTER SET utf8");
 
        } catch (PDOException $e) {
 
            print "Error!: " . $e->getMessage();
 
            die();
        }
    }
 
    public function prepare($sql){
 
        return $this->dbh->prepare($sql);
 
    }
	function get_last_id(){  
		return $this->dbh->lastInsertId();
	} 
	
    public static function singleton_conexion(){
 
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
 
        }
 
        return self::$instancia;
        
    }
 
 
     // Evita que el objeto se pueda clonar
    public function __clone(){
 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
 
    }/**/
}
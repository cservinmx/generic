<?php
/*
* @Credit: 		Carlos Servin 2015 
* @copyright	Copyright (C) 2015 Carlos Servin. http://www.servin.mx
*/

class Conexion{
	
    private static $instancia;
    private $db;
	/*private $bd_host='host';
	private $bd_user='user';
	private $bd_password='pass';
	private $bd_data_base='db_name';*/
	private $bd_host='localhost';
	private $bd_user='root';
	private $bd_password='root';
	private $bd_data_base='ps_prosa';
	
    private function __construct(){
        try {
        	$bd_host=$this->bd_host;
			$bd_user=$this->bd_user;
			$bd_password=$this->bd_password;
			$bd_data_base=$this->bd_data_base;
			$this->db = new PDO('mysql:host=localhost;dbname=ps_prosa', 'root', 'root');
 			//$this->db = new PDO("mysql:host=$bd_host;dbname=$bd_data_base, $bd_user, $bd_password");            
            $this->db->exec("SET CHARACTER SET utf8");
 
        } catch (PDOException $e) {
 
            print "Error!: " . $e->getMessage();
 
            die();
        }
    }
 
    public function prepare($sql){
 
        return $this->db->prepare($sql);
 
    }
	function get_last_id(){  
		return $this->db->lastInsertId();
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
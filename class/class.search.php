<?php 
/*
* @Credit: 		Carlos Servin 2015 
* @copyright	Copyright (C) 2015 Carlos Servin. http://www.servin.mx
*/

class  Search{
	private $dbh;
	
	public function __construct(){
		$this->dbh=Conexion::singleton_conexion();
	}
	public function query_search($buscar){
				
		try{
			$param=$buscar."%"; //Se agrega el comodin para busqueda trunca
			$sql = "SELECT * FROM users WHERE us_name LIKE ?";
				            		
            $query = $this->dbh->prepare($sql);
           	$query->bindParam(1,$param);
            $query->execute();		
                 
			  if ($query->rowCount() > 0) {
			  		return $query->fetchAll();    
			  }
			$this->dbh = null;
		}catch(PDOException $e){
            
            print "Error!: " . $e->getMessage();
            
        }   
	}
	
}
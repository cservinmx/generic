<?php 
/*
* @Credit: 		Carlos Servin 2015 
* @copyright	Copyright (C) 2015 Carlos Servin. http://www.servin.mx
*/
/*
CREATE TABLE `session` (
  `idsession` int(11) NOT NULL AUTO_INCREMENT,
  `us_iduser` int(11) DEFAULT NULL,
  `cookie` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idsession`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 CREATE TABLE `users` (
  `idsession` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `correo` varchar(200) DEFAULT NULL,
  `contrasenia` varchar(200) DEFAULT NULL,
  `userscol` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idsession`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 * 
 * 
 * * 
*/
//Ejercicio 4


class  Users{
	private $dbh;
	
	public function __construct($IDUSER=0){
		$this->dbh=Conexion::singleton_conexion();
		$SESSION=$_COOKIE["session"];
		if(isset($SESSION)){
			try{			
			$sql = "SELECT * FROM session WHERE cookie=?";
				            		
            $query = $this->dbh->prepare($sql);
           	$query->bindParam(1,$SESSION);
            $query->execute();		
                 
			  if ($query->rowCount() > 0) {
			  		$response=$query->fetchAll();
				  	$IDUSER=$response[0]['us_iduser'];    
			  }
			$this->dbh = null;
		}catch(PDOException $e){
            
            print "Error!: " . $e->getMessage();
            
        }   
		}
	}
	public function conectar($correo, $pass){
		try{		
			$sql = "SELECT * FROM users WHERE correo=?";
				            		
            $query = $this->dbh->prepare($sql);
           	$query->bindParam(1,$correo);
            $query->execute();		
                 
			  if ($query->rowCount() > 0) {
			  	$value = "";
   			   $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    			$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    			$codeAlphabet.= "0123456789";
			    for($i=0;$i<20;$i++){
			        $value .= $codeAlphabet[crypto_rand_secure(0,strlen($codeAlphabet))];
			    }
			    
			  		setcookie("session", $value, time()+3600);  /* expira en una hora */   
			  		 $response=$query->fetchAll();
				  	$IDUSER=$response[0]['us_iduser']; 
			  }
			$this->dbh = null;
		}catch(PDOException $e){
            
            print "Error!: " . $e->getMessage();
            
        } 
	}
	
	public function desconectar(){
		$SESSION=$_COOKIE["session"];
		if(isset($SESSION)){
			 session_unset(); 
 			session_destroy();  
 			try{			
				$sql = " DELETE FROM session WHERE us_iduser=?";
					            		
	            $query = $this->dbh->prepare($sql);
	           	$query->bindParam(1,$param);
	            $query->execute();
				$this->dbh = null;
				}catch(PDOException $e){
	            
	            print "Error!: " . $e->getMessage();
	            
        }   	
		}
	}
	public function recupera_datos(){
		$SESSION=$_COOKIE["session"];
			if(isset($SESSION)){
			try{
				
				$sql = "SELECT * FROM users WHERE idsession=?";
					            		
	            $query = $this->dbh->prepare($sql);
	           	$query->bindParam(1,$SESSION);
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
	
}
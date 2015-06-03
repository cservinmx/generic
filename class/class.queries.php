<?php 
/*
* @Credit: 		Carlos Servin 2015 
* @copyright	Copyright (C) 2015 Carlos Servin. http://www.servin.mx
*/

class  Queryes{
	public function __construct(){
		$this->db=Conexion::singleton_conexion();
	}
	public function query_select(){
		 global $db; 		
		try{
			$sql = "SELECT * FROM pra_response_code";			            		
            $query = $this->db->prepare($sql);
           // $query->bindParam(1,$user);
            $query->execute();		
            
			  //si hay un resultado en la consulta creamos las sesiones        
			  if ($query->rowCount() > 0) {
			  		return $query->fetchAll();    
			  }else{
			  		echo 'No existen Registros';        
			  }
			$this->db = null;
		}catch(PDOException $e){
            
            print "Error!: " . $e->getMessage();
            
        }   
	}
	
	public function query_insert() { 
		 global $db; 
		try{
			$inp_asunto=$this->inp_asunto;
			$inp_descripcion=$this->inp_descripcion;
			$inp_id_user=$this->inp_id_user;
			$inp_time=$this->inp_time;
			
			
			$sql = "INSERT INTO tabla".						
			" VALUES (?,?,?,?,?,?,?,?,?)";
		            		
            $query = $this->dbh->prepare($sql);
            $query->bindParam(1,$us_name);
            $query->bindParam(2,$us_second_name);
			$query->bindParam(3,$us_mail);
            $query->bindParam(4,$us_timestap);
			$query->bindParam(5,$us_pass);
            $query->bindParam(6,$us_token);		
			$query->bindParam(7,$us_status);		
			$query->bindParam(8,$us_id_profile);		
			$query->bindParam(9,$us_id_dealer);					
            $query->execute();		
            
			
			  return TRUE;
		}catch(PDOException $e){
            
            print "Error!: " . $e->getMessage();
            
        } 
		 
	 }
	
	public function query_update($id_answer){
		 global $dbh; 
		 
		try{
			$id_answer=$id_answer;
			
			$sql="UPDATE pra_response_code SET rc_response_code='0' WHERE id_response_code=?";			
			$query = $this->dbh->prepare($sql);
            $query->bindParam(1,$id_answer);
			$query->execute();	
			return TRUE;
		}catch(PDOException $e){
            
            print "Error!: " . $e->getMessage();
            
        } 
	}
	
	
	
}
?>

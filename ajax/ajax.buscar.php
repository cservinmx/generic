<?php 
session_start();
/*
* @Credit: 		Carlos Servin 2015 
* @copyright	Copyright (C) 2015 Carlos Servin. http://www.servin.mx
*/


if(isset($_POST['buscar'])){
	 require_once '../class/class.dbcnx.php';
 	 require_once '../class/class.search.php';
		$palabra=$_POST['buscar'];
	 $search=new Search();
 	 $resp=$search->query_search($palabra);
	if($resp!=FALSE){
		echo $resp[0]['us_name'];
	}else{
		echo "No hay registros para mostrar";
	}

}else{
	header('Location: e1.php?error=2');
}

?>
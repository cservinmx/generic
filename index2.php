<?php 
/*
* @Credit: 		Carlos Servin 2015 
* @copyright	Copyright (C) 2015 Carlos Servin. http://www.servin.mx
*/
require_once 'class/class.dbcnx.php';
require_once 'class/class.queries.php';

$queryes=new Queryes();
$select=$queryes->query_select();

?><code>
		if(count($select)>1){
	foreach ($select as $key => $selectrows) {
		$code=$selectrows['id_response_code'];
		$response=$selectrows['rc_response_code'];
		echo "<li>".$code." ".$response."</li>";
	}
	
}else{
	echo "<li> Sin registros</li>";
}
	  <code> <?php

echo "<ul>";
if(count($select)>1){
	foreach ($select as $key => $selectrows) {
		$code=$selectrows['id_response_code'];
		$response=$selectrows['rc_response_code'];
		echo "<li>".$code." ".$response."</li>";
	}
	
}else{
	echo "<li> Sin registros</li>";
}
echo "</ul>";

?>


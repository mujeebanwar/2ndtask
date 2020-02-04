<?php

$dsn="mysql:host=localhost; dbname=my_task;";
$db_user="root";
$db_password="";

try{

	$con=new PDO($dsn,$db_user,$db_password);
	$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e){
	echo "connection Failed".$e->getMassage();
}

?>
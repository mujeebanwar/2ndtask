<?php

		//-----------------------------------------------------
		// 					Add Connection File
		//-----------------------------------------------------

include_once 'config.php';

		//-----------------------------------------------------
		// 					Validate Form Function
		//-----------------------------------------------------

function validation($values){
	
	if (is_array($values)) {
		if (in_array("", $values)) {
		
		return true;
	}else{
		return false;
	}
	}
	
}

		//-----------------------------------------------------
		// 			Insert Values into Database Query Function
		//-----------------------------------------------------

function insert($table,$array){
try{
global $con; 
$values=array();
$columns=implode(',', array_keys($array));	
	
	
	foreach ($array as $value) {
		array_push($values, "'{$value}'");		
	}
	$value= implode(',',$values);
	
	$sql="INSERT INTO `$table` ($columns) VALUES ({$value})";
	$con->exec($sql);
	$id=$con->lastInsertId();
	return $id;
	
}catch(PDOException $e){
echo "Data Not Inserted".$e->getMassage();
}


}

		//-----------------------------------------------------
		// 			Select Values From Database Query Function
		//-----------------------------------------------------

function select($table,$array){

	try{
			global $con; 

				$columns=implode(',', array_keys($array));		
				$value= implode(',',$array);
				$sql="SELECT *from `$table`"; 
				if ($value==-1) {
					$sql=$sql;
				}else{
					$sql=$sql." WHERE {$columns}={$value}";
				}

				$result=array();
				$qry_run=$con->query($sql);
				if ($qry_run->rowCount()>0) {
					while ($row=$qry_run->fetch(PDO::FETCH_ASSOC)) {
						$result[]=$row;

					}
					return $result;
				}
	}catch(PDOException $e){
		echo $e->getMassage();
	}

	
}
	
		//-----------------------------------------------------
		// 			Update Values  Database Query Function
		//-----------------------------------------------------

function update($table,$values,$condition){
	try{
		global $con;

		$con_column=implode(',', array_keys($condition));
		$con_value= implode(',',$condition);	
		$update_col=array();
		foreach ($values as $key => $val) {
			$update_col[]="$key='$val'";

		}

 $sql = "UPDATE $table SET " . implode(', ', $update_col) . " WHERE {$con_column}={$con_value}";
 $qry=$con->exec($sql);
 	return true;
 
	}catch(PDOException $e){
		echo $e->getMassage();
	}

	
 
}

		//-----------------------------------------------------
		// 			Deletes Values From Database Query Function
		//-----------------------------------------------------

function delete($table,$condition){
	try{
		global $con;
	$columns=implode(',', array_keys($condition));		
	$value= implode(',',$condition);

	$sql="DELETE FROM `$table` WHERE {$columns}=$value";
	$qry=$con->exec($sql);
	if ($qry) {
		return true;
	}else{
		return die("Query Failed".mysqli_error($con));
		//return false;
	}
	}catch(PDOException $e){
		echo $e->getMassage();
	}
	
	

}
?>
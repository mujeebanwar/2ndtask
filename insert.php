<?php 
// include_once 'function.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="" method="POST">
		<input type="text" name="name"><br><br>
		<input type="text" name="roll"><br><br>
		<input type="text" name="phone"><br><br>
		<input type="submit" name="sub" value="Submit">
	</form>
<?php
if (isset($_POST['sub'])) {
	
	
	
	$table=array(
		'city'=>array(
			'id'=>'',
			'Name'=>''
		),
		'employees'=>array(
			'id'=>'',
			'Employee_Name'=>'',
			'Employee_Email'=>'',
			'Employee_Phone'=>''
		),
		'software_house'=>array(
			'id'=>'',
			'software_house_Name'=>''
		),
		'departments'=>array(
			'id'=>'',
			'department_name'=>''
		),
	// $condition=array(
	// 	'id'=>30,
	// );
	
	);

	join_on($table);
	// array_push($array, $name);
	// array_push($array, $rol);

	
}
function join_on($table){
	$col=array();
	$values=array();
	$val=array();
	// print_r($table);
		foreach ($table as $key => $val) {
			$col[]="$key";
		}
		foreach ($col as $key => $value) {
				$values[]="$value";
			}
			foreach ($values as $key => $value) {
				$val[]="$key";
				}	
			echo "<pre>";
   			print_r($col);
   			echo "</pre>";	

   			echo "<pre>";
   			print_r($values);
   			echo "</pre>";

   			echo "<pre>";
   			print_r($val);
   			echo "</pre>";	
   			// 
   			// array_push($key,implode(',',array_keys($table)));
   // 	$key=implode(',',array_values($col));
   // 	echo $key;
  	// print_r($table[array_values($col)]);
  	// echo implode(',', $table[$key]);		


				// $qry="SELECT  e.id As employee_id,e.Employee_Name,e.Employee_Email,
				// e.Employee_Phone,s.id As softwarehouse_id,
				// s.software_house_Name,d.id As department_id,
				// d.department_name,c.id As city_id,c.Name
				// FROM employees e 
				// LEFT JOIN software_house s ON e.software_house_id=s.id 
				// LEFT JOIN departments d ON e.department_id=d.id 
				// LEFT JOIN city c ON e.city_id=c.id";
}

// function select_id($table,$array){
// global $con; 

// 	$columns=implode(',', array_keys($array));		
// 	$value= implode(',',$array);
// 	$sql="SELECT *from `$table`"; 
// 	if ($value==-1) {
// 		$sql=$sql;
// 	}else{
// 		$sql=$sql." WHERE {$columns}={$value}";
// 	}

// 	$result=array();
// 	$qry_run=qry_run($con,$sql);
// 	if ($qry_run) {
// 		while ($row=fetch_rec($qry_run)) {
// 			$result[]=$row;

// 		}
// 		return $result;
// 	}

// }

// function update_id($table,$array,$condition){


// }
// function delete_id($table,$condition){
// 	global $con;
// 	$columns=implode(',', array_keys($condition));		
// 	$value= implode(',',$condition);

// 	$sql="DELETE FROM `$table` WHERE {$columns}=$value";
// 	$qry=qry_run($con,$sql);
// 	if ($qry) {
// 		return true;
// 	}else{
// 		die("Query Failed".mysqli_error($con));
// 		return false;
// 	}

// }


?>
</body>
</html>
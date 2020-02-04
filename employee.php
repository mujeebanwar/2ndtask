<?php

		//-----------------------------------------------------
		// 			 Include Header
		//-----------------------------------------------------

include_once 'include/header.php';
include_once 'bootstrap_modal.php';

		//-----------------------------------------------------
		// 			 Add Software House
		//-----------------------------------------------------

$table='software_house';
$id="-1";
$columns=array(
'id'=>$id
);
$soft_hse=select($table,$columns);

		//-----------------------------------------------------
		// 			 Add Departments
		//-----------------------------------------------------


$table='departments';
$id="-1";
$columns=array(
'id'=>$id
);
$dpt=select($table,$columns);

		//-----------------------------------------------------
		// 			 Add Cities
		//-----------------------------------------------------


$table='city';
$id="-1";
$columns=array(
'id'=>$id
);
$city=select($table,$columns);
$error="";
$validator=new validator;
$validation=$validator->check($_POST,[
				
				'employee_name'=>[
				'required'=>true,
				],

				'employee_mail'=>[
					'required'=>true,
					'email'=>true,
				],

				'employee_phone'=>[
					'required'=>true,
					'minlength'=>12,
					'maxlength'=>12,
					'phone'=>true
				]
			]);

//-----------------------------------------------------
// Validation
//-----------------------------------------------------

if (isset($_POST['employee_submit'])) {

	$name=$_POST['employee_name'];
	$mail=$_POST['employee_mail'];
	$phone=$_POST['employee_phone'];
	$software_house_id=$_POST['softwarehouse_name'];
	$department_id=$_POST['department_name'];
	$city_id=$_POST['city_name'];
	
	
	
	
	if ($validation->fails()) {
	 $error=$validation->all();
	 if (array_key_exists('employee_name',$error)) {
	 $name_error=implode("<br>", $error['employee_name']);
	}
	 if (array_key_exists('employee_mail',$error)) {
	 $email_error=implode("<br>", $error['employee_mail']);
	}
	 if (array_key_exists('employee_phone',$error)) {
	 $phone_error=implode("<br>", $error['employee_phone']);
	}
	}

	else{

		//-----------------------------------------------------
		// 					Insert  Data
		//-----------------------------------------------------

			$table='employees';
			$values=array(
			'Employee_Name'=>$name,
			'Employee_Email'=>$mail,
			'Employee_Phone'=>$phone,
			'department_id'=>$department_id,
			'software_house_id'=>$software_house_id,
			'city_id'=>$city_id

		);
		$id=insert($table,$values);
		if ($id>0) {
			?>
			<script type="text/javascript">
				let url="Employees";
    		 	let title='Save Employee';
    		 	let msg='Employee Added Successfully';
    		 	show(url,title,msg);	
				
 	 	</script>
			<?php
		}

	}
	


}


?>
	
		<!------------------------------------------------------- -->
		<!-- 	Update Form  -->
		<!------------------------------------------------------- -->

		<?php
	if (isset($_GET['edit_id']) && isset($_GET['s_id']) && isset($_GET['d_id']) && isset($_GET['c_id']))  {
			$id=$_GET['edit_id'];
			$table='employees';
			$columns=array(
				'id'=>$id
			);
		$result=select($table,$columns);
		if ($result>0) {
			foreach ($result as $rows) {
			$name=$rows['Employee_Name'];
			$email=$rows['Employee_Email'];
			$phone=$rows['Employee_Phone'];
			}
		}
	
	
	$s_id=$_GET['s_id'];
	$d_id=$_GET['d_id'];
	$c_id=$_GET['c_id'];
	$submit_name="employee_edit";
	$value="Edit";
	$hidden="hidden";
	$heading="Edit Employee";
	?>
	
	<?php
	}else{

		//-----------------------------------------------------
		// 					Add Form
		//-----------------------------------------------------

		$name="";
		$email="";
		$phone="";
		$s_id="";
		$d_id="";
		$c_id="";
		$submit_name="employee_submit";
		$value="Save";
		$hidden="";
		$heading="Add Employee";
		
	}

		//-----------------------------------------------------
		// 			 Update Employee
		//-----------------------------------------------------

if (isset($_POST['employee_edit'])) {
	 


	 $name=$_POST['employee_name'];
	 $mail=$_POST['employee_mail'];
	 $phone=$_POST['employee_phone'];
	 $software_house_id=$_POST['softwarehouse_name'];
	 $department_id=$_POST['department_name'];
	 $city_id=$_POST['city_name'];

	 if ($validation->fails()) {
	 $error=$validation->all();
	 if (array_key_exists('employee_name',$error)) {
	 $name_error=implode("<br>", $error['employee_name']);
	}
	 if (array_key_exists('employee_mail',$error)) {
	 $email_error=implode("<br>", $error['employee_mail']);
	}
	 if (array_key_exists('employee_phone',$error)) {
	 $phone_error=implode("<br>", $error['employee_phone']);
	}
	}else{
			$table='employees';
			$condition=array(
				'id'=>$_GET['edit_id'],
			);
			$columns=array(
			'Employee_Name'=>$name,
			'Employee_Email'=>$mail,
			'Employee_Phone'=>$phone,
			'department_id'=>$department_id,
			'software_house_id'=>$software_house_id,
			'city_id'=>$city_id
			);
			$result=update($table,$columns,$condition);


			if ($result) {
			?>
			<script type="text/javascript">
						let url="Employees";
					 	let title='Update Employee';
					 	let msg='Employee Details Update Successfully';
					 	show(url,title,msg);	

					</script>
			<?php	
			}

	}


	


}	 

	?>

	
		<!------------------------------------------------------- -->
		<!--  	Main Form -->
		<!-- ----------------------------------------------------- -->
	
	<div class="container-fluid">
	<?php include_once 'include/navigation.php'?><br><br><br>
	
	<h1 class="text-primary"><?php echo $heading;?></h1><br>
		
	<div class="row ">
	<div class="col-md-4">
	<form action="" method="POST">
	<div class="form-group">
	<h5 id="name">Name:</h5><br>
	<input id="name" class="form-control" type="text" name="employee_name" value="<?php echo $_POST['employee_name'] ?? $name;?>">
	<div class="text-danger"><?php echo $name_error ?? ''?></div>										
	</div>
	<div class="form-group">
	<h5 id="email">Email:</h5>
	<input id="email" class="form-control"  type="text" name="employee_mail" value="<?php echo $_POST['employee_mail'] ?? $email;?>">
	<div class="text-danger"><?php echo $email_error ?? ''?></div>			
							

	</div>
	<div class="form-group">
	<h5 id="phone">Phone:</h5>
	<input class="form-control" id="phone" type="text" name="employee_phone" value="<?php echo $_POST['employee_phone'] ?? $phone?>">
		<div class="text-danger"><?php echo $phone_error ?? ''?></div>
		</div>

		<div class="form-group">
					
		<h5 id="sf">Software House :</h5>
		<select class="form-control" id="sf" name="softwarehouse_name">
			
			<?php
			if ($soft_hse>0) {
				foreach ($soft_hse as $row) {
					
					?>
					<option value="<?php echo $row['id']?>" <?php
					if ($row['id']==$s_id) {
								echo "selected";
							}
						?>>
						<?php echo $row['software_house_Name']?></option>
							<?php
							
							}
					
				}
			
				?>
			</select>
					

			</div>
					
				<div class="form-group">
				<h5 id="dpt">Department:</h5><br>
				<select class="form-control" id="dpt" name="department_name">
				
				<?php
				if ($dpt>0) {
					foreach ($dpt as $row) {
					?>
				<option value="<?php echo $row['id']?>"  <?php
				if ($row['id']==$d_id) {
					echo "selected";
				}
				?>><?php echo $row['department_name']?></option>
				<?php
				
				}
				
					}
				
				?>
				
				</select>
				</div>
					
				<div class="form-group">
				<h5 id="city">City:</h5><br>
				<select class="form-control" id="city" name="city_name">
				
				<?php
				if ($city>0) {
					foreach($city as $row){
					?>
					<option value="<?php echo $row['id']?>"  <?php
				if ($row['id']==$c_id) {
					echo "selected";
				}
				?>><?php echo $row['Name']?></option>
				<?php
				
				}
				
					}
				
				?>
				
			</select>
			</div>
			

			<div class="form-group">
			<input class=" btn btn-primary" type="submit" 
			name="<?php echo $submit_name?>" value="<?php echo $value?>">
			</div>	
			</form>
			</div>
			<div class="col-md-8">
			<div class="table-responsive">
			<?php


			$employee="SELECT  e.id As employee_id,e.Employee_Name,e.Employee_Email,
			e.Employee_Phone,s.id As softwarehouse_id,
			s.software_house_Name,d.id As department_id,
			d.department_name,c.id As city_id,c.Name
			FROM employees e 
			LEFT JOIN software_house s ON e.software_house_id=s.id 
			LEFT JOIN departments d ON e.department_id=d.id 
			LEFT JOIN city c ON e.city_id=c.id";
			$employee_qry=$con->query($employee);
			$result=$employee_qry->rowCount();
			if ($result>0) {
				echo "<table id='table' class='table table-bordered table-hover'>
				<thead>
				<tr>
				<th>Sr#</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Software House</th>
				<th>Department</th>
				<th>City</th>
				<th>Edit</th>
				<th>Delete</th>
				</tr>	
				</thead>
				
				<tbody>";
					if ($employee_qry) {
						$i=0;
				while ($row=$employee_qry->fetch(PDO::FETCH_ASSOC)) {
					$i=$i+1;
				$id=$row['employee_id'];
				$software_id=$row['softwarehouse_id'];
				$department_id=$row['department_id'];
				$city_id=$row['city_id'];
			echo "<tr>";
			echo "<td>$i</td>";
			echo "<td>{$row['Employee_Name']}</td>";
			echo "<td>{$row['Employee_Email']}</td>";
			echo "<td>{$row['Employee_Phone']}</td>";
			echo "<td>{$row['software_house_Name']}</td>";
			echo "<td>{$row['department_name']}</td>";
			echo "<td>{$row['Name']}</td>";
			echo "<td><i class='fa fa-edit' style='font-size:16px;color:green'></i><a href='Employee/{$id}/{$software_id}/{$department_id}/{$city_id}'> Edit</a></td>";

			echo "<td><i class='fa fa-trash-o' style='font-size:16px;color:red'></i><a rel='$id' href='javascript:void(0)' class='delete_link' > Delete</a></td>";
			
			echo "</tr>";
				}
			}
			}
		
			?>
			
				</tbody>
				</table>

				</div>
			</div>
			</div>
		</div>

		<!------------------------------------------------------- -->
		<!--  	Delete Employee -->
		<!------------------------------------------------------- -->
<?php
if (isset($_GET['id'])) {
$table='employees';
	$condition=array(
		'id'=>$_GET['id'],
	);
	$result=delete($table,$condition);
	if ($result) {
		?>
		<script type="text/javascript">
			window.open('Employees','_self');
		</script>
		<?php
	}else{
		echo $result;
	}
		
}
		

 		//-----------------------------------------------------
		// 			Include Footer
		//-----------------------------------------------------

include_once 'include/footer.php';
?>
<script type="text/javascript">
	$url='Employees';
	delete_modal($url);

</script>
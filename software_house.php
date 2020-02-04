<?php
	
		//-----------------------------------------------------
		// 			 Include Header
		//-----------------------------------------------------

include_once 'include/header.php';
include_once 'bootstrap_modal.php';
?>

<?php

//-----------------------------------------------------
// Validation
//-----------------------------------------------------


$error="";
$select_option="";

$validator=new validator;
	
	$validation=$validator->check($_POST,[
				
				'softwarehouse_name'=>[
				'required'=>true,
				'alnum'=>true
				
				],

				'softwarehouse_email'=>[
					'required'=>true,
					'email'=>true,
				],

				'softwarehouse_phone'=>[
					'required'=>true,
					'minlength'=>12,
					'maxlength'=>12,
					'phone'=>true
				]
			]);

if (isset($_POST['softwarehouse_submit'])) {

	$name=$_POST['softwarehouse_name'];
	$mail=$_POST['softwarehouse_email'];
	$phone=$_POST['softwarehouse_phone'];
	$city_id=$_POST['softwarehouse_city'];

	if ($validation->fails()) {
	 $error=$validation->all();
	 if (array_key_exists('softwarehouse_name',$error)) {
	 $name_error=implode("<br>", $error['softwarehouse_name']);
	}
	 if (array_key_exists('softwarehouse_email',$error)) {
	 $email_error=implode("<br>", $error['softwarehouse_email']);
	}
	 if (array_key_exists('softwarehouse_phone',$error)) {
	 $phone_error=implode("<br>", $error['softwarehouse_phone']);
	}
	}
	else{	

		//-----------------------------------------------------
		// 					Insert  Data
		//-----------------------------------------------------

	
			$table='software_house';
    		$values=array(
    			'software_house_Name'=>$name,
    			'Email'=>$mail,
    			'Phone'=>$phone
    		);
    	$id=insert($table,$values);
    	$scn_table='software_cities';
    	$columns=array(
    		'city_id'=>$city_id,
    		'software_house_id'=>$id
    	);
    	$results=insert($scn_table,$columns);
    	if ($results) {
    		?>
    		<script type="text/javascript">
				let url="Software-House";
    		 	let title='Save Software House';
    		 	let msg='Software House Added Successfully';
    		 	show(url,title,msg);	
				
 	 	</script>
    		<?php
    	}

    		
	}

}
?>
		

	<?php

		//------------------------------------------------------- --
		// 				Update Form 
		//------------------------------------------------------- --


	if (isset($_GET['edit_id']) && isset($_GET['city_id'])) {
			
						$table='software_house';
						$id=$_GET['edit_id'];
						$columns=array(
						'id'=>$id
					);
						$result=select($table,$columns);
						if ($result>0) {
						foreach ($result as $rows) {
							$name=$rows['software_house_Name'];
							$email=$rows['Email'];
							$phone=$rows['Phone'];
							}
							}	


	$c_id=$_GET['city_id'];
	$submit_name="softwarehouse_edit";
	$value="Edit";
	$select=false;
	$heading="Edit software House"
?>
<?php
				
		
	}else{

		//-----------------------------------------------------
		// 					Add Form
		//-----------------------------------------------------


		$c_id="";
		$name="";
		$email="";
		$phone="";
		$submit_name="softwarehouse_submit";
		$value="Save";
		$select=true;
		$heading="Add software House";
		?>
		
		<?php
	}

		//-----------------------------------------------------
		// 			 Update Software House
		//-----------------------------------------------------

if (isset($_POST['softwarehouse_edit'])) {
	if ($validation->fails()) {
	 $error=$validation->all();
	 if (array_key_exists('softwarehouse_name',$error)) {
	 $name_error=implode("<br>", $error['softwarehouse_name']);
	}
	 if (array_key_exists('softwarehouse_email',$error)) {
	 $email_error=implode("<br>", $error['softwarehouse_email']);
	}
	 if (array_key_exists('softwarehouse_phone',$error)) {
	 $phone_error=implode("<br>", $error['softwarehouse_phone']);
	}
	}else{
		echo "hello";
	$table='software_house';
	$condition=array(
		'id'=>$_GET['edit_id'],
	);
	$columns=array(
	'software_house_Name'=>$_POST['softwarehouse_name'],
	'Email'=>$_POST['softwarehouse_email'],
	'Phone'=>$_POST['softwarehouse_phone']
	);
	$result=update($table,$columns,$condition);
	if ($result) {
		?>
		<script type="text/javascript">
				let url="Software-House";
    		 	let title='Update Software House';
    		 	let msg='Software House Details Update Successfully';
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
		
	
	<h1 class="text-primary"><?php echo $heading;?></h1>
	<div class="row ">
		
	<div class="col-md-4" >
	<form action="" method="POST">
	<div class="form-group">
	<label id="name">Name</label><br>
	<input type="text" class="form-control" name="softwarehouse_name" value="<?php echo $_POST['softwarehouse_name'] ?? $name ?>">
		<div class="text-danger"><?php echo $name_error ?? ''?></div>			
	</div>

	<div class="form-group">
	<label id="email">Email</label><br>
	<input type="text" class="form-control" id="email" name="softwarehouse_email" value="<?php  echo $_POST['softwarehouse_email'] ?? $email;?>">
	<div class="text-danger"><?php echo $email_error ?? ''?></div>
	</div>

	<div class="form-group">
	<label id="phone">Phone</label><br>
	<input id="phone" class="form-control" type="text" name="softwarehouse_phone" value="<?php echo $_POST['softwarehouse_phone'] ?? $phone;?>">
	<div class="text-danger"><?php echo $phone_error ?? ''?></div>
	</div>
	
					
	<div class="form-group">
	
	<?php
	
		$table='city';
		$id="-1";
		$columns=array(
		'id'=>$id
	);
	$result=select($table,$columns);
	
	
	?>
	<label id="city">City</label><br>
	
	<select id="city" class="form-control" name="softwarehouse_city">
	
	<?php
	if ($result>0) {
	foreach ($result as $row) {
		?>
<option value="<?php echo $row['id']?>"<?php
	if ($row['id']==$c_id) {
	echo "selected";
}

	?>>
	<?php echo $row['Name']?></option>
			<?php
		}
		
		
	
	
		}
		?>
	</select><br>


	</div>

		<div class="form-group">
		<input class="btn btn-primary" type="submit" name="<?php echo $submit_name?>" value="<?php echo $value;?>">
		</div>
		</form>
		</div>


		<div class="col-md-8">
	
		<div class="table-responsive">

				<?php

						$table='software_house';
						$id="-1";
						$columns=array(
						'id'=>$id
					);
				$result=select($table,$columns);		
			
			if ($result>0) {
				echo "<table class='table table-bordered table-hover' id='table'>
				<thead>
				<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Edit</th>
				<th>Delete</th>
				</tr>	
				</thead>
				<tbody>";

			
				foreach ($result as $row) {
					$id=$row['id'];

					$snd_table='software_cities';

					$snd_coulmns=array(
						'software_house_id'=>$id,
					);
					$city_id="";
					$cities=select($snd_table,$snd_coulmns);
					foreach ($cities as $city) {
						$city_id=$city['city_id'];
					}
					
					echo "<tr>";
					echo "<td>{$row['software_house_Name']}</td>";
					echo "<td>{$row['Email']}</td>";
					echo "<td>{$row['Phone']}</td>";
					echo "<td><i class='fa fa-edit' 
					style='font-size:20px;color:green'></i>
					<a href='Software-House/{$id}/{$city_id}'> 
					Edit</a></td>";
					echo "<td><i class='fa fa-trash-o' 
					style='font-size:20px;color:red'></i><a rel='$id' 
					href='javascript:void(0)' class='delete_link' > Delete</a></td>";	
	
	
					echo "</tr>";
				
				}
					
		
			}
			
			?>
				</tbody>
				</table>

	

			
				</div>
			</div>

		</div><br>
		
		
		
			
			
			
		</div>
		
		<!------------------------------------------------------- -->
		<!--  	Delete Software House -->
		<!------------------------------------------------------- -->

<?php
	

if (isset($_GET['id'])) {
		
		$table='software_house';
	$condition=array(
		'id'=>$_GET['id'],
	);
	$result=delete($table,$condition);
	if ($result) {
		?>
		<script type="text/javascript">
			window.open('Software-House','_self');
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

$url="software_house.php";
	delete_modal($url);

</script>

<?php 

		//-----------------------------------------------------
		// 			 Include Header
		//-----------------------------------------------------

include_once 'include/header.php';
include_once 'bootstrap_modal.php';

		//-----------------------------------------------------
		// Validation
		//-----------------------------------------------------

$error="";
	$validator=new validator;
	
	$validation=$validator->check($_POST,[
				
				'department_name'=>[
				'required'=>true,
				]]);

if (isset($_POST['department_submit'])) {
	
	
	if ($validation->fails()) {
	 $error=$validation->all();
	 if (array_key_exists('department_name',$error)) {
	 $name_error=implode("<br>", $error['department_name']);
	}
	}
	else{

		//-----------------------------------------------------
		// 					Insert  Data
		//-----------------------------------------------------


	$softwarehouse_id=$_POST['softwarehouse_name'];
	$name=$_POST['department_name'];

		$table='departments';
    		$values=array(
    			'department_name'=>$name,
    		
    		);
    	$id=insert($table,$values);
    	$scn_table='software_departments';
    	$columns=array(
    		'software_house_id'=>$softwarehouse_id,
    		'department_id'=>$id
    	);
    	$results=insert($scn_table,$columns);
    	if ($results) {
    		?>
    		<script type="text/javascript">
				let url="Departments";
    		 	let title='Save Department';
    		 	let msg='Department Added Successfully';
    		 	show(url,title,msg);	
				
 	 	</script>
    		<?php
    	}




	}

	

}


?>
	<div>
	<?php

			//-----------------------------------------------------
			// 			 Update Form
			//-----------------------------------------------------

 if (isset($_GET['edit_id']) &&isset($_GET['s_id'])) {
 		$id=$_GET['edit_id'];
	
			$table='departments';
			$id=$_GET['edit_id'];
			$columns=array(
			'id'=>$id
		);
			$result=select($table,$columns);
			if ($result>0) {
			foreach ($result as $row) {
					$name=$row['department_name'];
				}
}
	$s_id=$_GET['s_id'];
	$submit_name="department_edit";
	$value="Edit";
	$select=false;
 	$heading="Edit Department";
 }else{


		//-----------------------------------------------------
		// 					Add Form
		//-----------------------------------------------------


 	$s_id="";
 	$name="";
 	$submit_name="department_submit";
 	$value="Save";
 	$select=true;
 	$heading="Add Department";
 	?>
 	

 	<?php
 }

 		//-----------------------------------------------------
		// 			 Update Department
		//-----------------------------------------------------

if (isset($_POST['department_edit'])) {
	if ($validation->fails()) {
	 $error=$validation->all();
	 if (array_key_exists('department_name',$error)) {
	 $name_error=implode("<br>", $error['department_name']);
	}
	}
	else{
		$table='departments';
	$condition=array(
		'id'=>$_GET['edit_id'],
	);
	$columns=array(
	'department_name'=>$_POST['department_name'],
	);
	$result=update($table,$columns,$condition);


if ($result) {
	?>
	<script type="text/javascript">
				let url="Departments";
    		 	let title='Update Department';
    		 	let msg='Department Details Update Successfully';
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
		<div class="row">
			
		<div class="col-md-4">
				
		<form action="" method="POST">
		<div class="form-group">
		<label id="name">Name:</label><br>
		<input class="form-control" id="name" type="text" name="department_name" value="<?php echo $name;?>">
		<div class="text-danger"><?php echo $name_error ?? ''?></div>
		</div>

		<div class="form-group">
					<?php
				
					$table='software_house';
					$id="-1";
					$columns=array(
					'id'=>$id
				);
				$result=select($table,$columns);

				?>
		<label id="soft">Software House :</label><br><br>
		<select name="softwarehouse_name" class="form-control" id="soft">

	<?php
	if ($result>0) {
		foreach ($result as $row) {
		?>
		<option value="<?php echo $row['id']?>" <?php

		if ($row['id']==$s_id) {
			echo "selected";
		}
		?>><?php echo $row['software_house_Name']?></option>
		<?php
		}
	
	}
	?>
</select>
		</div>

		<div class="form-group">
		<input class="btn btn-primary" type="submit" name="<?php echo $submit_name?>" value="<?php echo $value?>">			
		</div>
		</form>
		</div>

			

				<div class="col-md-8">
				
				<div class="table-responsive">
					<?php
		
					
						$table='departments';
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
						<th>Edit</th>
						<th>Delete</th>
						</tr>	
						</thead>
						<tbody>";
										
						foreach ($result as $row) {
						$id=$row['id'];
						$snd_table='software_departments';
						$snd_coulmns=array(
						'department_id'=>$id,
					);
					$sft_id="";
					$sft=select($snd_table,$snd_coulmns);
					foreach ($sft as $value) {
						$sft_id=$value['software_house_id'];
					}


			echo "<tr>";
			echo "<td>{$row['department_name']}</td>";
			echo "<td><i class='fa fa-edit' 
			style='font-size:20px;color:green'></i>
			<a	href='Department/{$id}/{$sft_id}' > Edit</a></td>";

			echo "<td><i class='fa fa-trash-o' 
			style='font-size:20px;color:red'></i><a rel='$id' 
			href='javascript:void(0)' class='delete_link'> Delete</a></td>";
			
			echo "</tr>";	
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
		<!--  	Delete Department -->
		<!------------------------------------------------------- -->

<?php
	


if (isset($_GET['id'])) {
	$table='departments';
	$condition=array(
		'id'=>$_GET['id'],
	);
	$result=delete($table,$condition);
	if ($result) {
		?>
		<script type="text/javascript">
			window.open('Departments','_self');
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
	$url='Departments';
	delete_modal($url);

</script>
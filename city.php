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

$name="";
$value="";
$submit_name="";
$error="";
	$validator=new validator;
	$validation=$validator->check($_POST,[
				'city_name'=>[
				'required'=>true,
				
				]]);
if (isset($_POST['city_submit'])) {
	
	if ($validation->fails()) {
	 $error=$validation->all();
	 if (array_key_exists('city_name',$error)) {
	 $name_error=implode("<br>", $error['city_name']);
	}
	}
	else{
    	
    	//-----------------------------------------------------
		// 					Insert  Data
		//-----------------------------------------------------

    		$name=$_POST['city_name'];
    		$table='city';
    		$values=array(
    			'Name'=>$name
    		);
    		$result=insert($table,$values);
    		if ($result>0) {
    		?>
    		 <script type="text/javascript">
    		 	let url="city";
    		 	let title='Save City';
    		 	let msg='City Added Successfully';
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
				if (isset($_GET['edit_id'])) {
						
					$id=preg_replace('#[^0-9]#','', $_GET['edit_id']);
					
						$table='city';
						
						$columns=array(
						'id'=>$id
					);
						$result=select($table,$columns);
						if ($result>0) {
						foreach ($result as $row) {
								$name=$row['Name'];
							}
							}	
						$submit_name="city_update";
						$value="Edit";
						$heading="Edit City";
		

		//-----------------------------------------------------
		// 					Add Form
		//-----------------------------------------------------

	}else{
		$name="";
		$submit_name="city_submit";
		$value="Save";
		$heading="Add City";

	}


		//-----------------------------------------------------
		// 			 Update City
		//-----------------------------------------------------


if (isset($_POST['city_update'])) {
	if ($validation->fails()) {
	 $error=$validation->all();
	 if (array_key_exists('city_name',$error)) {
	 $name_error=implode("<br>", $error['city_name']);
	}
	}
	else{
		$table='city';
	$condition=array(
		'id'=>$_GET['edit_id'],
	);
	$columns=array(
	'Name'=>$_POST['city_name'],
	);
	$result=update($table,$columns,$condition);


if ($result) {
	?>
	<script type="text/javascript">
				let url="city";
    		 	let title='Update City';
    		 	let msg='City Details Update Successfully';
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
		
<?php include_once 'include/navigation.php'?><br><br>
<br>
	
		<div class="container">	
		<h1 class="text-dark"><?php echo $heading;?></h1>
		<div class="row">
		<div class="col-md-4">
		<form action="" method="POST">
		<label for="name">Name</label>
		<input id="name" class="form-control" type="text" name="city_name" value="<?php echo $name?>">
		<div class='text-danger'><?php echo $name_error ?? ''?></div><br>
		<input class="btn btn-primary" type="submit" name="<?php echo $submit_name?>" value="<?php echo $value?>">
		</form>
		</div>
		</div><br>

		<div class="row">
		<div class="col-md-12">
		<div class="table-responsive">
						<?php
						$table='city';
						$id="-1";
						$columns=array(
						'id'=>$id
					);
				$result=select($table,$columns);		
				if ($result>0) {
				?>
				<table class="table table-bordered table-hover" id="table">
				<thead>
				<tr>
				<th>Name</th>
				<th>Edit</th>
				<th>Delete</th>
				</tr>	
				</thead>
				<tbody>
				<?php
					

				foreach ($result as  $row) {
					$id=$row['id'];
				echo "<tr>";
				echo "<td>{$row['Name']}</td>";

				echo "<td><i class='fa fa-edit' style='color:green'><i><a 
				href='city/{$id}'> Edit</a></td>";
				
				echo "<td><i class='fa fa-edit' style='color:green'><i><a rel='$id' 
				href='javascript:void(0)' class='delete_link ' >Delete </a></td>";
			
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
		<!--  	Delete City -->
		<!------------------------------------------------------- -->

<?php

if (isset($_GET['id'])) {
	$table='city';
	$condition=array(
		'id'=>$_GET['id'],
	);
	$result=delete($table,$condition);
	if ($result) {
		?>
		<script type="text/javascript">
			window.open('city','_self');
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

	$url="city.php"
	delete_modal($url);
</script>
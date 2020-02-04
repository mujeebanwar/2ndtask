<?php
		//-----------------------------------------------------
		// 			 Include Header And Searching Files
		//-----------------------------------------------------


include_once "include/header.php";
include_once  'searching.php';


?>

<?php

		//-----------------------------------------------------
		// 			 Add Software House
		//-----------------------------------------------------
$table='software_house';
$id="-1";
$columns=[
'id'=>$id
];
$soft_hse=select($table,$columns);
		
		//-----------------------------------------------------
		// 			 Add Departments
		//-----------------------------------------------------


$table='departments';
$id="-1";
$columns=[
'id'=>$id
];
$dpt=select($table,$columns);

		//-----------------------------------------------------
		// 			 Add Cities
		//-----------------------------------------------------

$table='city';
$id="-1";
$columns=[
'id'=>$id
];
$city=select($table,$columns);
?>

		<!------------------------------------------------------- -->
		<!--  	Main Form -->
		<!-- ----------------------------------------------------- -->


		<div class="container-fluid">
		<?php include_once 'include/navigation.php'?><br><br><br>
  		<h2 class="text-primary">Search</h2>
 		<div class="row">
 		<div class="col-md-3">
 		<form action="" method="POST">
  		<label for="city">City :</label>
    	<div class="form-check" id="city">
      <label class="form-check-label" for="check1">
      	
      <?php
      if ($city>0) {
      foreach ($city as $row) {
      ?>
		<input class="form-check-input" type="checkbox" name="city[]" value="<?php 
		echo $row['id']?>"
				
		<?php
		if (isset($_POST['city'])) {
			foreach ($_POST['city'] as $value) {
				if ($row['id']==$value) {
					echo "checked";
				}
			}
		}
		?>><?php echo $row['Name'];?><br>
		<?php
		
		
}
}
	

		?>
		

      </label>
   	</div><br>
    	<div class="form-group">
    	<label for="softwarehouse">Software House</label><br>
    	<select name="softwarehouse" class="from-control" id="softwarehouse">
    		
		<option value="">--Select Software House--</option>
		<?php
		if ($soft_hse>0) {
		foreach ($soft_hse as $row) {
		?>
		<option value="<?php echo $row['id']?>" <?php 
		if (isset($_POST['softwarehouse'])) {
		if ($row['id']==$_POST['softwarehouse']) {
					
							echo "selected";
						}
					}
		?>>
		<?php echo $row['software_house_Name']?></option>			<?php
			}
		}
					?>
		
    	</select>
    	</div>

      <div class="form-group">
      <label for="dept">Software House</label><br>
    	<select name="department" class="from-control" id="dept">
		<option value="">--Select Department--</option>
		<?php
		if ($dpt>0) {
		foreach ($dpt as $row) {
		?>
		<option value="<?php echo $row['id']?>" <?php
		if (isset($_POST['department'])) {
		if ($row['id']==$_POST['department']) {
				echo "selected";
			}
		}
		?>><?php echo $row['department_name']?></option>	
			
			<?php
			}
		}
		
			?>
		</select>
    	</div>

   
   	<input type="submit" class="btn btn-primary search" name="search" value="Search"><br><br>
    
  		</form>

 		</div>

 		<div class="col-md-9">
 		<?php
		if (isset($_POST['search'])) {

			$softwarehouse=$_POST['softwarehouse'];	
			 $department=$_POST['department'];
			 if (isset($_POST['city'])) {
	
				$city=$_POST['city'];
			
			}
		
		if (!isset($_POST['city'])) {
		$city="";
		}
		$result=search($softwarehouse,$department,$city);
			?>
		<div class="table-responsive">          
		<table class="table table-bordered table-hover" id="table">
		<thead>
			
			<tr>
			<th>Employee Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Software House</th>
			<th>Department</th>
			<th>City</th>
			</tr>
		</thead>
		<tbody>
			
		
	<?php
	
	
		
	

	
		if ($result>0) {
		foreach ($result as $row) {
			echo "<tr>";
			echo "<td>{$row['Employee_Name']}</td>";
			echo "<td>{$row['Employee_Email']}</td>";
			echo "<td>{$row['Employee_Phone']}</td>";
			echo "<td>{$row['software_house_Name']}</td>";
			echo "<td>{$row['department_name']}</td>";
			echo "<td>{$row['Name']}</td>";
			
			echo "</tr>";

		}	
		}
	
}
?>
 	</div>
 	</div>
  
	</tbody>
	</table>
	</div>
	</div>
	
<?php
include_once 'include/footer.php';
?>

<script type="text/javascript">
	$(document).ready(function() {
		
 		let url="";
 		delete_modal(url);
});

</script>

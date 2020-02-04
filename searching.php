<?php
function search($softwarehouse,$department,$cities){
	global $con;
	$result=[];

 	  $qry="SELECT e.id As employee_id,e.Employee_Name,
	  e.Employee_Email, e.Employee_Phone,
	  s.id As softwarehouse_id,s.software_house_Name,
	  d.id As department_id,d.department_name,c.id As city_id,c.Name 
	  FROM employees e 
	  LEFT JOIN software_house s ON e.software_house_id=s.id 
	  LEFT JOIN departments d ON e.department_id=d.id 
	  LEFT JOIN city c ON e.city_id=c.id";
 
		if (!empty($cities)) {
	   	$cities=implode(',', $cities);
	  	$where[]="c.id IN(".$cities.")";
	 	 }
	  	if (!empty($department)) {
	  	$where[]= "d.id=".$department;
	  	}
	  	if (!empty($softwarehouse)) {
	  	$where[]="s.id=".$softwarehouse;
	 	}

	  if(isset($where) && !empty($where)){
	  	$where=" where ".implode(" And ", $where);
	  	$qry=$qry." ".$where;
	  }
	  	$query=$con->query($qry);
		if ($query->rowCount()>0) {
			while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
					$result[]=$row;
				}
				return $result;	
		}
}
?>
<?php 
	
	include  "db.php";
	extract($_POST);
	if(isset($checked)){
			foreach($checked  as $key => $x){

	       if($x){
	       		 $sql="INSERT INTO USERS (`name`, `email`) VALUES ('$name[$key]','$email[$key]')";
		  		 mysqli_query($db,$sql);
	       }


		}
	}


?>
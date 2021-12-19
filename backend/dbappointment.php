<?php
include("config.php");
include('session.php');

if(count($_POST)>0){
	if($_POST['type']==1){
		$branch_id=$_POST['branch_id'];
		$trainer_id=$_POST['trainer_id'];
		$user_id=$login_id ;
		$date=$_POST['date'];
		$sql = "INSERT INTO `appointment`( `branch_id`, `trainer_id`,`user_id`,`date`) 
		VALUES ('$branch_id','$trainer_id','$user_id','$date')";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$branch_id=$_POST['branch_id'];
		$trainer_id=$_POST['trainer_id'];
		$user_id=$login_id ;
		$date=$_POST['date'];
		$sql = "UPDATE `appointment` SET `branch_id`='$branch_id',`trainer_id`='$trainer_id',`user_id`='$user_id',`date`='$date' WHERE id=$id";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `appointment` WHERE id=$id ";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}


?>
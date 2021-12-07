<?php
if (file_exists("../.config/connect.php")) include_once("../.config/connect.php");

if(count($_POST)>0){
	if($_POST['type']==1){
		$imie=$_POST['imie'];
		$nazwisko=$_POST['nazwisko'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$haslo_hash = password_hash($password, PASSWORD_DEFAULT);
		$sql = "INSERT INTO users ( `imie`, `nazwisko`, `email`,`password`) 
		VALUES ('$imie', '$nazwisko', '$email', '$haslo_hash')";
		if (mysqli_query($link, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($link);
		}
		mysqli_close($link);
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$imie=$_POST['imie'];
		$nazwisko=$_POST['nazwisko'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$isAdmin=$_POST['isAdmin'];
		$isActive=$_POST['isActive'];
		$haslo_hash = password_hash($password, PASSWORD_DEFAULT);
		$sql = "UPDATE `users` SET `imie`='$imie',`nazwisko`='$nazwisko',`email`='$email',`password`='$haslo_hash',`isAdmin`='$isAdmin',`isActive`='$isActive' WHERE id=$id";
		if (mysqli_query($link, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($link);
		}
		mysqli_close($link);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `users` WHERE id=$id ";
		if (mysqli_query($link, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($link);
		}
		mysqli_close($link);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM users WHERE id in ($id)";
		if (mysqli_query($link, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($link);
		}
		mysqli_close($link);
	}
}

?>
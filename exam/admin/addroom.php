<?php
include "../db.php";
session_start();
if(isset($_POST['addroom'])){
	$roomcode = $_POST['roomcode'];
	$roomcode = mysqli_real_escape_string($conn, $roomcode);
	$roomcode = htmlentities($roomcode);
	$block = $_POST['block'];
	$block = mysqli_real_escape_string($conn, $block);
	$block = htmlentities($block);
	$capacity = $_POST['cap'];
	$capacity = mysqli_real_escape_string($conn, $capacity);
	$capacity = htmlentities($capacity);
	
	$insert = "insert into room (room_code, block_name, capacity)VALUE ('$roomcode','$block','$capacity')";
	$insert_query = mysqli_query($conn, $insert);
	if($insert_query){
		$_SESSION['room'] = "New room added successfully.";
	}
	else{
		$_SESSION['roomnot'] = "Error!! New room not added.";
	}
	header("Location: add_room.php");
}

?>
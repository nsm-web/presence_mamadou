<?php 

if (isset($_GET['id'])) {
	include "./../db_conn.php";

	function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

	$id = validate($_GET['id']);

	$sql = "SELECT * FROM partner WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    	$row = mysqli_fetch_assoc($result);
    }else {
    	header("Location: read.php");
    }


}else if(isset($_POST['update'])){
    include "../../db_conn.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

	$name = validate($_POST['name']);
	$activity_domain = validate($_POST['activity_domain']);
  $contact = validate($_POST['contact']);
  $training = validate($_POST['training']);
	$id = validate($_POST['id']);

	if (empty($name)) {
		header("Location: ../update.php?id=$id&error=Name is required");
	}else if (empty($activity_domain)) {
		header("Location: ../update.php?id=$id&error=Email is required");
  }else if (empty($contact)) {
    header("Location: ../update.php?id=$id&error=Email is required");
  }else if (empty($training)) {
    header("Location: ../update.php?id=$id&error=Email is required");
	}else {

       $sql = "UPDATE partner
               SET name='$name', activity_domain='$activity_domain', contact='$contact',  training='$training'
               WHERE id=$id ";
       $result = mysqli_query($conn, $sql);
       if ($result) {
       	  header("Location: ../read.php?success=successfully updated");
       }else {
          header("Location: ../update.php?id=$id&error=unknown error occurred&$user_data");
       }
	}
}else {
	header("Location: read.php");
}
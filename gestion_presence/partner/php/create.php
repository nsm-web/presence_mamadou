<?php 

if (isset($_POST['create'])) {
	include "./../db_conn.php";
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

	$user_data = 'name='.$name. '&activity_domain='.$activity_domain. '&contact='.$contact. '&training='.$training;

	if (empty($name)) {
		header("Location: ../index.php?error=Le nom est requis&$user_data");

	}else if (empty($activity_domain)) {
		header("Location: ../index.php?error=Le domaine est requis&$user_data");

	}else if (empty($contact)) {
		header("Location: ../index.php?error=Le contact est requis&$user_data");

	}else if (empty($training)) {
		header("Location: ../index.php?error=La formation est requise&$user_data");

	}else {

       $sql = "INSERT INTO partner(name, activity_domain,contact,training) 
               VALUES('$name', '$activity_domain', '$contact', '$training')";
       $result = mysqli_query($conn, $sql);
       if ($result) {
       	  header("Location: ../read.php?success=successfully created");
       }else {
          header("Location: ../index.php?error=unknown error occurred&$user_data");
       }
	}

}
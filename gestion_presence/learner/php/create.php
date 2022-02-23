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
	$email = validate($_POST['email']);
	$password = validate($_POST['password']);
	$role = validate($_POST['role']);

	$user_data = 'name='.$name. '&email='.$email. '&password='.$password. '&role='.$role;

	if (empty($name)) {
		header("Location: ../index.php?error=Name is required&$user_data");
	}else if (empty($email)) {
		header("Location: ../index.php?error=Email is required&$user_data");

	}else if (empty($password)) {
		header("Location: ../index.php?error=Password is required&$user_data");

	}else {

       $sql = "INSERT INTO users(name, email,password,role) 
               VALUES('$name', '$email', '$password', '$role')";
       $result = mysqli_query($conn, $sql);
       if ($result) {
       	  header("Location: ../read.php?success=successfully created");
       }else {
          header("Location: ../index.php?error=unknown error occurred&$user_data");
       }
	}

}
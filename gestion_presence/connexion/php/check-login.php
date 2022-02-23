<?php  
session_start();
include "./../../db_conn.php";

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$email = test_input($_POST['email']);
	$password = test_input($_POST['password']);
	$role = test_input($_POST['role']);

	if($_POST['ip'] != "105.235.111.211" ) {
		header("Location: ../index.php?error=Emargement impossible, vous n'êtes pas en salle de cours");

	}else if (empty($email)) {
		header("Location: ../index.php?error=Ajouter un nom utilisateur");
	}else if (empty($password)) {
		header("Location: ../index.php?error=Ajouter un mot de passe");
	}else {

		// Hashing the password
		// $password = md5($password);
        
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
        	// the user name must be unique
        	$row = mysqli_fetch_assoc($result);
        	if ($row['password'] === $password && $row['role'] == $role) {
        		$_SESSION['name'] = $row['name'];
        		$_SESSION['id'] = $row['id'];
        		$_SESSION['role'] = $row['role'];
        		$_SESSION['email'] = $row['email'];

        		header("Location: check-user.php");

        	}else {
        		header("Location: ../index.php?error=Adresse mail ou mot de passe incorrect");
        	}
        }else {
        	header("Location: ../index.php?error=Adresse mail ou mot de passe incorrect");
        }

	}
	
}else {
	header("Location: ../index.php");
}
<?php 
   session_start();
      // if (!isset($_SESSION['email']) && !isset($_SESSION['id'])) {   ?>
<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
      <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">

      <?php 

	        $json = file_get_contents('https://ip.seeip.org/jsonip');

	        //Decode JSON
	        $json_data = json_decode($json,true);
	        $ip= $json_data["ip"];
	        $ip = trim($ip);
       ?>

      	<form class="border shadow p-3 rounded"
      	      action="php/check-login.php" 
      	      method="post" 
      	      style="width: 450px;">
      	      <h1 class="text-center p-3">CONNEXION</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
		  <div class="mb-3">
		    <label for="email" 
		           class="form-label">Email</label>
		    <input type="email" 
		           class="form-control" 
		           name="email" 
		           id="email">
		  </div>
		  <div class="mb-3">
		    <label for="password" 
		           class="form-label">Password</label>
		    <input type="password" 
		           name="password" 
		           class="form-control" 
		           id="password">
		  </div>
		   <div class="mb-3" id="ip">
                   <input type="text"  name="ip"  class="form-control" value="<?=$ip; ?>" readonly >
           </div>

		  <div class="mb-1">
		    <label class="form-label">Select User Type:</label>
		  </div>
		  <select class="form-select mb-3"
		          name="role" 
		          aria-label="Default select example">
			  <option selected value="user">Apprenant</option>
			  <option value="admin">Admin</option>
		  </select>
		 
		  <button type="submit" 
		          class="btn btn-primary">SE CONNECTER</button>
		</form>
      </div>
</body>
</html>

	header("Location: home.php");

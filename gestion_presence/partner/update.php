<?php   include "./../navbar.php"?>
<?php include 'php/update.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<form action="php/update.php" 
		      method="post">
            
		   <h4 class="display-4 text-center">Editer</h4><hr><br>
		   <?php if (isset($_GET['error'])) { ?>
		   <div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
		    </div>
		   <?php } ?>
		   <div class="form-group">
		     <label for="name">Nom</label>
		     <input type="name" 
		           class="form-control" 
		           id="name" 
		           name="name" 
		           value="<?=$row['name'] ?>" >
		   </div>

		   <div class="form-group">
		     <label for="activity_domain">Domaine</label>
		     <input type="name" 
		           class="form-control" 
		           id="activity_domain" 
		           name="activity_domain" 
		           value="<?=$row['activity_domain'] ?>" >
		   </div>

		   <div class="form-group">
		     <label for="contact">Contact</label>
		     <input type="name" 
		           class="form-control" 
		           id="contact" 
		           name="contact" 
		           value="<?=$row['contact'] ?>" >
		   </div>

		   <div class="form-group">
		     <label for="training">Formation</label>
		     <input type="name" 
		           class="form-control" 
		           id="training" 
		           name="training" 
		           value="<?=$row['training'] ?>" >
		   </div>
		   

		   <input type="text" 
		          name="id"
		          value="<?=$row['id']?>"
		          hidden >

		   <button type="submit" 
		           class="btn btn-primary"
		           name="update">Update</button>
		    <a href="read.php" class="link-primary">View</a>
	    </form>
	</div>
</body>
</html>
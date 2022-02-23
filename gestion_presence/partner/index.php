<?php   include "./../navbar.php"?>
<!DOCTYPE html>
<html>
<head>
	<title>Create</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<form action="php/create.php" 
		      method="post">
            
		   <h4 class="display-4 text-center">Inscription</h4><hr><br>
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
		           value="<?php if(isset($_GET['name']))
		                           echo($_GET['name']); ?>" 
		           placeholder="Entrer le nom">
		   </div>
		   <div class="form-group">
		     <label for="activity_domain">Domaine</label>
		     <input type="name" 
		           class="form-control" 
		           id="activity_domain" 
		           name="activity_domain" 
		           value="<?php if(isset($_GET['activity_domain']))
		                           echo($_GET['activity_domain']); ?>" 
		           placeholder="Entrer le domaine d'activité">
		   </div>

		   <div class="form-group">
		     <label for="contact">Contact</label>
		     <input type="name" 
		           class="form-control" 
		           id="contact" 
		           name="contact" 
		           value="<?php if(isset($_GET['contact']))
		                           echo($_GET['contact']); ?>" 
		           placeholder="Entrer contact">
		   </div>

		   <div class="form-group">
		     <label for="name">Formation</label>
		     <input type="name" 
		           class="form-control" 
		           id="training" 
		           name="training" 
		           value="<?php if(isset($_GET['training']))
		                           echo($_GET['training']); ?>" 
		           placeholder="Entrer la formation">
		   </div>

		   <button type="submit" 
		          class="btn btn-primary"
		          name="create">Inscrire</button>
		    <a href="read.php" class="link-primary">Affichage</a>
	    </form>
	</div>
</body>
</html>

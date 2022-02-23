<?php   include "./../navbar.php"?>
<?php 
   session_start();
   include "./../db_conn.php";
   if (!isset($_SESSION['email']) && !isset($_SESSION['id'])){
        header('Location:index.php');
        die();
    }
   if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Show map -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
     
</head>
 <style>
    #map { 

      height: 380px; 
    }
</style>
<body>
<div class="container justify-content-center ">
      	<?php if ($_SESSION['role'] == 'admin') {?>
      		
      		<!-- For Admin -->
      		<div class="container">
    <h1 class="title mt-5 text-center mb-5 ">Liste de présence</h1>
    <div class="col-md-5 ">
    <form action="" method="GET">
        <div class="input-group mb-3 ">
            <input type="date" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Recherche">
            <button type="submit" class="btn btn-primary">Recherche</button>
        </div>
    </form>
    </div>
     <div class="table table-bordered table-responsive">
     <table id="table" class="table">
  <thead>
    <tr>
    <th scope="col">Date</th>
      <th scope="col">Nom et Prénom </th>
      <th scope="col">Heure d'arriver</th>
      <th scope="col">Heure de Départ</th>
    </tr>
  </thead>
  <tbody id="#body">
<?php 
    $con = mysqli_connect("localhost","root","","gestion_presence");

    if(isset($_GET['search']))
    {
        $filtervalues = $_GET['search'];
        $query = "SELECT * FROM register WHERE CONCAT(dayDate,pseudo,morningSignIn,eveningSignIn) LIKE '%$filtervalues%' ";
        $query_run = mysqli_query($con, $query);

        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $items)
            {
                ?>
                <tr>
                    <td><?= $items['dayDate']; ?></td>
                    <td><?= $items['pseudo']; ?></td>
                    <td><?= $items['morningSignIn']; ?></td>
                    <td><?= $items['eveningSignIn']; ?></td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
                <tr>
                    <td colspan="4">Aucun Résultat trouver pour cette date</td>
                </tr>
            <?php
        }
    }
?>

      	<?php }else { ?>




			    <?php

                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Super!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                          
                        <?php
                         unset($_SESSION['status']);
                    }
                    $ip_address=file_get_contents('http://checkip.dyndns.com/');
                    $ip_address = str_replace("Current IP Address: ","",$ip_address);
                    date_default_timezone_set('Africa/abidjan');
                    $now = date("Y-m-d H:i:s");
                ?>

                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Enregistrer mon heure d'arrivé</h4>
                    </div>
                    <div class="card-body">

                        <form action="sign_traitement.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Nom</label>
                                <input type="text" name="name" class="form-control" value="<?=$_SESSION['name']?>"
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Date et Heure d'arriver</label>
                                
                                <input type="datetime" name="event_dt"  value="<?=$now;?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="save_datetime"  class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>

                        <form action="sign_traitement.php" method="POST">
                            <div class="form-group mb-3" style="display: none;">
                                <label for="">Nom</label>
                                <input type="text" name="name" class="form-control" value="<?=$_SESSION['name']?>">
                            </div>
                            <div class="form-group mb-3" style="">
                                <label for="">Date et heure de Départ</label>
                                <input type="datetime" name="event_depart"  value="<?=$now;?>" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="save_datetime_depart" class="btn btn-primary">Enregistrer</button>
                            </div>
                            <div>
                            	<a href="logout.php" class="btn btn-dark">Deconnexion</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



			  </div>
			</div>
      	<?php } ?>
</div>
<?php }else{
	header("Location: index.php");
} ?>
<div id="map" class="container justify-content-center mb-3"></div>
<script type="text/javascript">
  var locate = [-4.010495560068697,5.351236295324883]
               mapboxgl.accessToken = 'pk.eyJ1IjoibWFtYWRvdTIzNSIsImEiOiJja3d3OTI3aWowMWdtMzFyMGhyYXB3bzJ0In0.qw36BC5oJ93-vxyhPrapgg';
               const map = new mapboxgl.Map({
               container: 'map', // container ID
               style: 'mapbox://styles/mapbox/outdoors-v11', // style URL
               center:locate, // starting position [lng, lat]
               zoom: 14 // starting zoom
              });
              const marker = new mapboxgl.Marker()
                .setLngLat(locate)
                .addTo(map);
</script>
</body>
</html>


<?php   include "./../navbar.php"?>
<?php 
   session_start();
   include "./../db_conn.php";
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <script src="Location.js"></script>

</head>
<body>
    
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
                                <label for="">Nom et prémon</label>
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




                        <div class="card mt-5">
                    <div class="card-header">
                        <h4>Enregistrer mon heure de départ</h4>
                    </div>
                    <div class="card-body">

                        <form action="sign_traitement.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Nom et prémon</label>
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
                                <a href="logout.php" class="btn btn-dark">Logout</a>
                            </div>
                        </form>
                          <style>
    #map { height: 380px; }
</style>
                    </div>
                </div>
            </div>



              </div>
            </div>
        <?php } ?>
      </div>
</body>
</html>


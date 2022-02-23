<?php 
    session_start();
    include "./../db_conn.php";

    // if(!isset($_SESSION['user'])){
    //     header('Location:./../connexion/index.php');
    //     die();
    // }

    // On récupere les données de l'utilisateur
    $req = $bdd->prepare('SELECT * FROM users WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();
   
?>
<!doctype html>
<html lang="fr">
  <head>
    <title>Espace arrive</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Show map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <script src="Location.js"></script>

  </head>
  <body  onload="init()">
        <div class="container">
            <div class="col-md-12">



                <div class="text-center">
                        <h1 class="p-5">Bienvenue <?php echo $data['name']; ?> !</h1>
                        <hr />
                        
                </div>
            </div>
        </div>    
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

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
                // ?>

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

                </div>
                </div>
            </div>
        </div>
        <br>
        <div class="text-center">
                        <a href="deconnexion.php" class="btn btn-info btn-lg">Déconnexion</a>
                       
    
        <div id="map"></div>
        <br><br><br><br><br><br><br><br><br>

                                
        
            
            <style>
    #map { height: 380px; }
</style>
  </body>
</html>

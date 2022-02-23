<?php   include "./../navbar.php"?>
<?php 
   session_start();
   include "./../db_conn.php";
   if (isset($_SESSION['email']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
   <link rel="stylesheet" type="text/css" href="style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 

</head>
<body>
      <div class="container justify-content-center "
      style="min-height: 100vh">
            
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

        }
</body>
</html>
<?php
session_start();
$con = mysqli_connect("localhost","root","","gestion_presence");

if(isset($_POST['save_datetime']))
{
    // $name = $_POST['name'];
    $event_date1 = $_POST['event_dt'];
    $event_date = substr("$event_date1",0,10);
    $event_dt= substr("$event_date1",11,19);
    $name= $_POST['name'];

    // constraint
    // $sql = "SELECT * FROM register WHERE pseudo='$name' AND dayDate = '$event_dt'";
    // $result = mysqli_query($con, $query);

    // $event_time = $_POST['event_time'];
    $query = "INSERT INTO register (morningSignIn,dayDate,pseudo) VALUES ('$event_dt','$event_date','$name')";
    // $query1 = "INSERT INTO register (dayDate) VALUES ('$event_dt')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Votre heure d'arrivée a été enregistré avec succès";
        header("Location: home.php");
    }
    else
    {
        $_SESSION['status'] = "Erreur d'incertion veuillez réssayer";
        header("Location: traitement.php");
    }
}
$now = date("Y-m-d H:i:s");
// $now= substr("$now",0,10);
// $now=substr("$now",10);

if(isset($_POST['save_datetime_depart']))
{
    $name = $_POST['name'];
    // $date_now = substr("$now",0,10);

    $event_depart= $_POST['event_depart'];
    $date_now =substr("$event_depart",0,10);
    $depart = substr("$event_depart",11,19);

    $query = "UPDATE register SET eveningSignIn='$depart' WHERE pseudo='$name' AND dayDate = '$date_now'";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Votre heure de départ a été enregistré avec succès";
        header("Location: home.php");
    }
    else
    {
        $_SESSION['status'] = "Erreur d'incertion veuillez réssayer";
        header("Location: traitement.php");
    }
}
?>

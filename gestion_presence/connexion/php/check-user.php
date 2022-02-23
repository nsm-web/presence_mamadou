<?php 
   session_start();
   include "./../../db_conn.php";

  if($_SESSION['role'] == 'admin' ){
  header("location:./../home.php");
  }else{
  header("location:./../../face/");
  }

?>
<?php include '../include/dbcon.php';?>

<?php

  session_start();



  if(!isset($_SESSION['hash']))

  {

    header('location:index.php');

  }



     $id = $_POST['id'];
     $email = $_POST['email'];

     $qry = "DELETE FROM attendance WHERE email = '$email'";

     $result = $mysqli->query($qry) or die($mysqli->error);


     $qry = "DELETE FROM graduates WHERE id = '$id'";

     $result = $mysqli->query($qry) or die($mysqli->error);

     if($result)

          header('location:dashboard.php');

?>

<?php include 'include/dbcon.php';?>
<?php
session_start();

  if(!isset($_SESSION['email']))
  {
    header('location:index.php');
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invitation Confirmation</title>
  <meta charset="utf-8">
  <link rel="icon" href="../image/rahul-fav.png" sizes="16x16" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-4 p-3">
  <h3 class="text-info text-center">Graduation Day 2019</h3><hr>
  <h5 class="text-info">Welcome , <strong><?php echo $_SESSION['name'];?></strong></h5>
  <hr>
  <form class="form-group" action="response.php" method="POST">
    <b>1. Are you attending Graduation Day Program ?</b><br>
    <input type="radio" id='yes' name="answer" value="yes" class="ml-4"> Yes<br>
    <input type="radio" name="answer" value="no" class="ml-4"> No<br>
    <div id="people" style='display:none'>
      <b>2. How many people are coming along with you ?</b>
      <select name="people">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
    </div>
    <input type="submit" name="submit" id ="submit" style="display:none;" value="Next" class="btn btn-info mt-2">
  </form>
  <br>
  <?php
    if(isset($_POST['submit']))
    {
      $name = $_SESSION['name'];
      $usn = $_SESSION['usn'];
      $email = $_SESSION['email'];
      $dept = $_SESSION['dept'];
      $mobile = $_SESSION['mobile'];
      $attending = $_POST['answer'];
      if($attending == 'no'){
        $people = 0;
      }
      else{
        $people = $_POST['people'];
      }

      $query = "DELETE from attendance WHERE email = '$email'";
      $res = $mysqli->query($query) or die($mysqli->error);

      $query = "INSERT into attendance(name, usn, dept, mobile, email, attending, people) values('$name','$usn','$dept','$mobile','$email','$attending','$people')";
      $res = $mysqli->query($query) or die($mysqli->error);
      header("location: feedback.php");

    }
  ?>
<script type="text/javascript">
$(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'yes') {
            $('#people').show(); 
            $('#submit').show();          
       }

       else {
            $('#people').hide(); 
            $('#submit').show();    
       }
   });
});
</script>
</body>
</html>

<?php include 'include/dbcon.php';?>
<?php

  $_SESSION=array();
  session_start();

  if(!isset($_SESSION['email']))
  {
    header('location:index.php');
  }
  require 'phpmailer/PHPMailerAutoload.php';
  $mail = new PHPMailer();
  $mail->isSMTP();

  $mail->Host='smtp.gmail.com';
  $mail->Port=587;
  $mail->SMTPAuth=true;
  $mail->SMTPSecure='tls';

  $mail->Username='graduationday2019@rvce.edu.in';

  $mail->Password='Graduationday@2019';

  $mail->setFrom('graduationday2019@rvce.edu.in','Graduation Day 2019');

  error_reporting(E_ALL ^ E_NOTICE);
  $displayqry = "SELECT * FROM questions";
  $result = $mysqli->query($displayqry) or die(error.__LINE__);

  $cnt = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Feedback</title>
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
<div class="container mt-3">
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-12 col-12 d-block m-auto">
<div class="card shadow p-4 mb-4 bg-white">
  <h3 class="text-info text-center">Graduation Day 2019</h3><hr>
  <h5 class="text-info">Welcome , <strong><?php echo $_SESSION['name'];?></strong></h5>
  <p class="text-secondary">Please give your feedback</p><hr>
  <form class="form-group" action="feedback.php" method="POST">
    <?php
      for($i=1;$i<=$cnt;$i=$i+1)
      {
        $row = $result->fetch_assoc();
        ?>
        <b><?php echo $i.". "; echo $row['question'];?></b>
        <input type="hidden" name="q<?php echo $i?>" value="<?php echo $row['question']?>"><br>
        <input type="radio" name="a<?php echo $i?>" value="<?php echo $row['opt1']?>" class="ml-4"> <?php echo $row['opt1']?><br>
        <input type="radio" name="a<?php echo $i?>" value="<?php echo $row['opt2']?>" class="ml-4"> <?php echo $row['opt2']?><br>
        <input type="radio" name="a<?php echo $i?>" value="<?php echo $row['opt3']?>" class="ml-4"> <?php echo $row['opt3']?><br>
        <input type="radio" name="a<?php echo $i?>" value="<?php echo $row['opt4']?>" class="ml-4"> <?php echo $row['opt4']?><hr>
      <?php
        }
    ?>
    <b>Feedback </b><i>(if any)</i>:<br><br>
    <textarea class="form-control" rows="4" name="feedback"><?php echo $_POST['feedback']?></textarea><br>
    <input type="submit" name="submit" value="Finish" id="finish" class="btn btn-info mt-2" onclick="process();">
    <button id="wait" style="display: none;" class="btn btn-success btn-block">Submitting your feedback, Please Wait...</button>
  </form>
  </form>
  <?php
    if(isset($_POST['submit']))
    {
      $email = $_SESSION['email'];
      $qry = "SELECT * FROM attendance WHERE email = '$email'";
      $res = $mysqli->query($qry) or die($mysqli->error);
      $row = $res->fetch_assoc();
      $cnt = (int)$row['id'];

      $name = $_SESSION['name'];
      $usn = $_SESSION['usn'];

      $id = 'RVCEGD-'.sprintf("%05d", $cnt);

      $q1 = $_POST['q1'];
      $a1 = $_POST['a1'];
      $q2 = $_POST['q2'];
      $a2 = $_POST['a2'];
      $q3 = $_POST['q3'];
      $a3 = $_POST['a3'];
      $q4 = $_POST['q4'];
      $a4 = $_POST['a4'];
      $q5 = $_POST['q5'];
      $a5 = $_POST['a5'];
      $feedback = $_POST['feedback'];

      if($a1 == '' || $a2 == '' || $a3 == '' || $a4 == '' || $a5 == '')
      {
        $alt = "Please fill all the questions";
        echo "<script type='text/javascript'>alert('$alt');</script>";
      }
      else
      {
        $query = "UPDATE attendance SET stud_id='$id', q1='$q1', a1='$a1', q2='$q2', a2='$a2', q3='$q3', a3='$a3', q4='$q4', a4='$a4', q5='$q5', a5='$a5', feedback='$feedback' WHERE email='$email'";
        $res = $mysqli->query($query) or die(error.__LINE__);

        $qry = "SELECT * FROM attendance WHERE email='$email'";
        $res = $mysqli->query($qry) or die(error.__LINE__);
        $row = $res->fetch_assoc();

        $mobile = $row['mobile'];
        $attending = $row['attending'];
        $people = $row['people'];
        $stud_id = $row['stud_id'];
        $pvt_email = $row['pvt_email'];

        $sub = "Registration Confirmed for ".$usn." !!";
        $body = '<p><b>Details Submitted:</b></p><p><b>Your Confirmation ID</b> : '.$stud_id.'</p><p><b>Name</b> : '.$name.'</p><p><p><b>Email</b> : '.$email.'</p><b>Private Email</b> : '.$pvt_email.'</p><p><b>Mobile</b> : '.$mobile.'</p><p><b>USN</b> : '.$usn.'</p><p><b>Attending</b> : '.$attending.'</p><p><b>No. of People Attending</b> : '.$people;
        $msg = '<h2>Thank You for giving your feedback & responding to our invite..</h2>'.'<br>'.$body;

        $mail->addAddress($email);
        $mail->addReplyTo('graduationday2019@rvce.edu.in');

        $mail->isHTML(true);
        $mail->Subject=$sub;
        $mail->Body=$msg;
        $mail->send();
        header("location: logout.php");
      }

    }
  ?>
</div>
</div>
</div>
</script>
<script type="text/javascript">
function process(){
  $('#finish').hide();
  $('#wait').show();
}
</script>
</body>
</html>

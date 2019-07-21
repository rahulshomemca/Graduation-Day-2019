<?php include '../include/dbcon.php';?>

<?php

  session_start();



  if(!isset($_SESSION['hash']))

  {

    header('location:index.php');

  }



  require '../phpmailer/PHPMailerAutoload.php';

  $mail = new PHPMailer();

  $mail->isSMTP();



  $mail->Host='smtp.gmail.com';

  $mail->Port=587;

  $mail->SMTPAuth=true;

  $mail->SMTPSecure='tls';



  $mail->Username='graduationday2019@rvce.edu.in';

  $mail->Password='xxxx';

  $mail->setFrom('graduationday2019@rvce.edu.in','Graduation Day 2019');
  

  $displayqry = "SELECT * FROM graduates";

  $result = $mysqli->query($displayqry) or die(error.__LINE__);



  $cnt = mysqli_num_rows($result);



?>

<!DOCTYPE html>

<html lang="en">

<head>

  <title>Update Student Details</title>

  <meta charset="utf-8">

  <link rel="icon" href="../image/rahul-fav.png" sizes="16x16" type="image/png">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>

<body>



<nav class="navbar navbar-expand-md mymenu navbar-dark bg-dark">

      <div class="container-fluid">

        <a href="index.php" class="navbar-brand">Admin Portal</a>



        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mymenu">

          <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse text-center" id="mymenu">

          <ul class="navbar-nav ml-auto">

            <li class="nav-item">

              <a class="nav-link" href="dashboard.php">Dashboard</a>

            </li>

            <li class="nav-item">

              <a class="nav-link" href="attendee.php">Attendee</a>

            </li>

            <li class="nav-item">

              <a class="nav-link" href="feedback.php">View Feedback</a>

            </li>

            <li class="nav-item">

              <a class="nav-link" href="settings.php">Change Password</a>

            </li>

            <li class="nav-item">

              <a class="nav-link" href="logout.php">Logout</a>

            </li>

          </ul>

        </div>

      </div>

</nav>



<br>

  

<div class="container">

  <h5 class="text-center text-info">Update Student's Details</h5><br>
  <p class="text-center text-danger">Note : If you press Update button below it will delete all records of the student and student has to re-response from newly received link</p>
  <div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-block m-auto">
          <div class="card shadow p-4 mb-4 bg-white">

              <form action="update.php" method="POST">

                Student Name:<input type="text" name="name" class="form-control" value="<?php echo $_POST['name']?>"><br>

                USN:<input type="text" name="usn" class="form-control" value="<?php echo $_POST['usn']?>"><br>

                Department:<input type="text" name="dept" class="form-control" value="<?php echo $_POST['dept']?>"><br>

                Email:<input type="email" name="email" class="form-control" value="<?php echo $_POST['email']?>"><br>

                <input type="hidden" name="id" value="<?php echo $_POST['id']?>">

                <input type="hidden" name="hash" value="<?php echo $_POST['hash']?>">

                <input type="submit" name="submit" value="Update and Resend Email" class = "btn btn-info btn-block">

              </form>

	<br>

        <?php

          if(isset($_POST['submit']))

          {

            $email = $_POST['email'];
	    $name = $_POST['name'];
            $id = $_POST['id'];
	    $dept = $_POST['dept'];
	    $usn = $_POST['usn'];

            if(filter_var($email, FILTER_VALIDATE_EMAIL))

            {

              $qry = "SELECT * FROM graduates WHERE email = '$email' AND id <> '$id';";

              $res = $mysqli->query($qry) or die(error.__LINE__);

              $row = mysqli_num_rows($res);

              if($row > 0){

                ?>

                  <p class="text-danger text-center">Email already registered</p>

                <?php

              }

              else

              {

                $qry = "UPDATE `graduates` SET `email` = '$email', `mobile` = NULL, `pvt_email` = NULL, `name` = '$name', `dept` = '$dept', `usn` = '$usn' WHERE `id` = '$id';";

                $result = $mysqli->query($qry) or die(error.__LINE__);

                if($result == true){

                  $hash = $_POST['hash'];

                  $sub = "Graduation Day Invitation";

                  $msg = "Click the given link to give your response \n http://gd.rvce.edu.in/valid.php?email=".$email."&hash=".$hash;

                  $mail->addAddress($email);

                  $mail->addReplyTo('graduationday2019@rvce.edu.in');



                  $mail->isHTML(true);

                  $mail->Subject=$sub;

                  $mail->Body=$msg;

                  if($mail->send()){

                    $qry = "DELETE FROM `attendance` WHERE usn = '$usn';";

                    $result = $mysqli->query($qry) or die(error.__LINE__);

                    ?>

                      <p class="text-success text-center">Student details updated and Email link sent</p>
		      <p class="text-danger text-center">All previous records of this student has been deleted</p>
		      <meta http-equiv="refresh" content="1; URL='dashboard.php'" />
                    <?php

                  }

                  $mail->ClearAllRecipients();

                }

                else

                {

                  ?>

                  <p class="text-danger text-center">Updated Failed</p>

                <?php

                }

              }

            } 

            else 

            {

              ?>

                <p class="text-danger text-center">Invalid Email</p>

              <?php

            }

          }

        ?>
</div>
</div>
</div>
</body>

</html>



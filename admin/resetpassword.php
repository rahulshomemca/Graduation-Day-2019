<?php include '../include/dbcon.php';?>

<?php

session_start();



  if(!isset($_SESSION['resethash']) && !isset($_SESSION['name_user']))

  {

    header('location:index.php');

  }

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <title>New Password</title>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="../image/rahul-fav.png" sizes="16x16" type="image/png">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>

<body>

<br>

<br>

<br>

<div class="container">

  <div class="col-lg-6 col-md-6 col-sm-10 col-10 d-block m-auto">

    <div class="card shadow p-4 mb-4 bg-white">

    <h3 class="text-center text-info">Enter New Password</h3>

    <p class="text-center text-secondary"><?php echo $_SESSION['name_user'] ?></p>

        <form action="" method="POST">

          New Password:<input type="password" name="npass" class="form-control" value="<?php echo $_POST['npass'] ?>" required><br>

          Confirm New Password:<input type="password" name="cnpass" class="form-control"  value="<?php echo $_POST['cnpass'] ?>" required><br> 

          <input type="submit" name="submit" value="Set Password" class = "btn btn-info btn-block">

        </form>

        <br>

        <?php



            if(isset($_POST['submit']))

            {

              $ses_hash = $_SESSION['resethash'];

              $qry = "SELECT * FROM admin WHERE hash = '$ses_hash';";

              $res = $mysqli->query($qry) or die(error.__LINE__);

              $row = mysqli_fetch_assoc($res);

              $nwpass = $_POST['npass'];

              $cnwpass = $_POST['cnpass'];

              if($nwpass != $cnwpass)

              {

                  echo "<p class='text-center text-danger'>Both password doesn't matched!!</p>";

              }

              else

              {

                $upass = md5($nwpass);

                $qry = "UPDATE `admin` SET `password` = '$upass' WHERE `hash` = '$ses_hash';";

                $result = $mysqli->query($qry) or die(error.__LINE__);

                if($result == true)

                {

                  echo "<p class='text-center text-success'>Password reseted successfully</p>";

                  header( "refresh:0.5;url=logout.php" );

                }

              }

            }

        ?>

        <p class="text-center text-info"><a href="index.php">Back to login page</a></p>

    </div>

  </div>

</div>

</body>

</html>



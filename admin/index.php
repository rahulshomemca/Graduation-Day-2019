<?php

include ('../include/dbcon.php');

session_start();

if(isset($_SESSION['hash']))

{

  header('location:dashboard.php');

}



?>



<!DOCTYPE html>

<html lang="en">

<head>

  <title>Admin Login</title>

  <meta charset="utf-8">

  <link rel="icon" href="../image/rahul-fav.png" sizes="16x16" type="image/png">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>

<body class="bg-info">



<br>

<br>

<br>

<div class="container">
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-block m-auto">

    <div class="card shadow p-4 mb-4 bg-white">

      <h2 class="text-center text-info">Admin Login</h2><br>



        <form action="index.php" method="POST">

          <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" value="<?php echo $_POST['username'] ?>" required><br>

          <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Enter Password" value="<?php echo $_POST['pwd'] ?>" required><br>

          <input type="submit" name="submit" id = "submit" value="Login" class="btn btn-info btn-block">

        </form>

	<br>

        <?php



          if(isset($_POST['submit']))

          {

            $username = $_POST['username'];

            $pass = $_POST['pwd'];



            $qry = "SELECT * FROM `admin` WHERE `username`='$username';";

            $res = $mysqli->query($qry) or die(error.__LINE__);

            $cnt = mysqli_num_rows($res);

            if($cnt == 0)

            {

              echo "<p class='text-center text-danger'>Account doesn't exist!!</p>";

            }

            else

            {



              $row = mysqli_fetch_assoc($res);

              if(md5($pass) == $row['password'])

              {

                

                $hash = $row['hash'];

                $_SESSION['hash'] = $hash;

                header('location:dashboard.php');

              }

              else

              {

                echo "<p class='text-center text-danger'>Wrong username or password!!</p>";

              }

            }

          }

        ?>

        <p class="text-center"><a href="verify.php" class="text-info">Forgot Password?</a></p>

    </div>

  </div>
</div>
</div>

</body>

</html>

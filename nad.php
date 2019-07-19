
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

  <title>National Academic Depository</title>

  <meta charset="utf-8">

  <link rel="icon" href="../image/rahul-fav.png" sizes="16x16" type="image/png">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>

<body class="bg-info">

<div class="container text-center mt-3">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12 col-12 d-block m-auto">
<div class="card shadow p-4 mb-4 bg-white">

<a href="http://nad.gov.in/"><h3 class="text-dark text-center">National Academic Depository</h3></a><hr>

  <p class="text-secondary">We are inviting you to join <a href="http://nad.gov.in/" target="_blank">National Academic Depository</a> by adding your Private Email Id</p>

      <form class="form-group" action="nad.php" method="POST">

        <input type="email" name="pvt_email" class="form-control" placeholder="Please enter your private email.." value="<?php echo $_POST['pvt_email']?>" required><br>

        <input type="submit" name="submit" value="Add Private Email" class="btn btn-info">

      </form>

  <br>

  <?php

    if(isset($_POST['submit']))

    {

      $email = $_SESSION['email'];

      $pvt_email = $_POST['pvt_email'];

      if(filter_var($pvt_email, FILTER_VALIDATE_EMAIL)){

      $whitelist = array("rvce.edu.in");

      function validateEmailDomain($email, $domains) {
        foreach ($domains as $domain) {
         $pos = strpos($email, $domain, strlen($email) - strlen($domain));

         if ($pos === false)
            continue;

         if ($pos == 0 || $email[(int) $pos - 1] == "@" || $email[(int) $pos - 1] == ".")
            return true;
         }

         return false;
      }

      if (validateEmailDomain($pvt_email, $whitelist))
      {
        ?>

          <p class="text-danger">Please give alternate email id, don't use rvce email</p>

        <?php

      }

      else

      {

        $qry = "SELECT * FROM graduates WHERE pvt_email = '$pvt_email' AND email <> '$email'";

        $res = $mysqli->query($qry) or die(error.__LINE__);

        $cnt = mysqli_num_rows($res);

        if($cnt > 0){

          ?>

            <p class="text-danger">Email already registered</p>

          <?php

        }

        else

        { 

          $qry = "UPDATE graduates SET pvt_email='$pvt_email' WHERE email = '$email'";

          $res = $mysqli->query($qry) or die(error.__LINE__);



          $_SESSION['pvt_email'] = $pvt_email;



          header("location: response.php");

        }

      }
     }
      else
     {
	$alt = "Invalid Email -> ".$pvt_email;

        echo "<script type='text/javascript'>alert('$alt');</script>";
     }

    }

  ?>
</div>
</div>
</div>
</body>

</html>



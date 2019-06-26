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

  $mail->Password='Graduationday@2019';

  $mail->setFrom('graduationday2019@rvce.edu.in','Graduation Day 2019');


  

  $displayqry = "SELECT * FROM graduates";

  $result = $mysqli->query($displayqry) or die(error.__LINE__);



  $cnt = mysqli_num_rows($result);



?>

<!DOCTYPE html>

<html lang="en">

<head>

  <title>Admin Dashboard</title>

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



<nav class="navbar navbar-expand-md mymenu navbar-dark bg-dark">

      <div class="container-fluid">

        <a href="index.php" class="navbar-brand">Admin Portal</a>



        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mymenu">

          <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse text-center" id="mymenu">

          <ul class="navbar-nav ml-auto">

            <li class="nav-item">

              <a class="nav-link active" href="dashboard.php">Dashboard</a>

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

  <h5>Welcome , <strong>Admin</strong></h5><br>



  <form class="form-inline" action="dashboard.php" method="POST" enctype="multipart/form-data">

    <label>Select CSV File : </label>

    <input type="file" name="file" class="ml-4">

    <br />

    <input type="submit" name="submit" value="Import" class="btn btn-info" id="import" onclick="process();">

    <button id="update" style="display: none;" class="btn btn-info">Please Wait , Processing...</button>

  </form>

  <br>



  <?php  

    $connect = mysqli_connect("localhost", "graduationday", "graduationday", "graduationday");

    if(isset($_POST["submit"]))

    {

     if($_FILES['file']['name'])

     {

      $filename = explode(".", $_FILES['file']['name']);

      if($filename[1] == 'csv')

      {

       $handle = fopen($_FILES['file']['tmp_name'], "r");

       while($data = fgetcsv($handle))

       {

          $name = mysqli_real_escape_string($connect, $data[0]);  

          $usn = mysqli_real_escape_string($connect, $data[1]);

          $dept = mysqli_real_escape_string($connect, $data[2]);  

          $email = mysqli_real_escape_string($connect, $data[3]);

          $hash = $mysqli->escape_string(md5(rand(0,10000)));



          $qry = "SELECT * FROM graduates WHERE usn='$usn' OR email='$email'";

          $res = mysqli_query($connect, $qry);

          $cnt = mysqli_num_rows($res);



          if($cnt == 0){

            $query = "INSERT into graduates(name, usn, dept, email, hash) values('$name','$usn','$dept','$email','$hash')";

            mysqli_query($connect, $query);



            $sub = "Graduation Day Invitation";

            $msg = "Click the given link to give your response \n http://gd.rvce.edu.in/valid.php?email=".$email."&hash=".$hash;



            $mail->addAddress($email);

            $mail->addReplyTo('rahulshomernp@gmail.com');



            $mail->isHTML(true);

            $mail->Subject=$sub;

            $mail->Body=$msg;

            $mail->send();

            $mail->ClearAllRecipients();

          }

       }



       fclose($handle);

       header("location: dashboard.php?fileupload=success");

      }

      else

      {

        ?>

        <p class="text-danger">Please choose only csv file!!</p>

        <?php

      }

     }

    }

  ?>

  <p>Type something in the input field to search:</p>

  <input class="form-control" id="myInput" type="text" placeholder="Search..">

  <br>

  <table class="table table-bordered table-striped table-responsive w-100 d-block d-md-table">

            <thead>

              <th class="text-center">SL.NO</th>

              <th class="text-center">Name</th>

              <th class="text-center">USN</th>

              <th class="text-center">Department</th>

              <th class="text-center">Email</th>

              <th class="text-center">Delete</th>

            </thead>

    <tbody id="myTable">

    <?php

      for($i=0;$i<$cnt;$i=$i+1)

      {

        $row = $result->fetch_assoc();

        ?>

      <tr>

        <td class="text-center"><?php echo $i+1 ?></td>

        <td class="text-center"><?php echo $row['name'] ?></td>

        <td class="text-center"><?php echo $row['usn'] ?></td>

        <td class="text-center"><?php echo $row['dept'] ?></td>

        <td class="text-center"><?php echo $row['email'] ?></td>

        <td class="text-center">

          <form action="delete.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

	    <input type="hidden" name="email" value="<?php echo $row['email'] ?>">

            <input type="submit" value="Delete" class="btn btn-danger">

          </form>

        </td>

      </tr>

      <?php

        }

    ?>

    </tbody>

  </table>

</div>

<script>

$(document).ready(function(){

  $("#myInput").on("keyup", function() {

    var value = $(this).val().toLowerCase();

    $("#myTable tr").filter(function() {

      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

    });

  });

});

</script>

<script type="text/javascript">

function process(){

  $('#import').hide();

  $('#update').show();

}

</script>

</body>

</html>



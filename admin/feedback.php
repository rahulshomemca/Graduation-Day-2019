<?php include '../include/dbcon.php';?>
<?php
session_start();

  if(!isset($_SESSION['hash']))
  {
    header('location:index.php');
  }

  $displayqry = "SELECT * FROM attendance";
  $result = $mysqli->query($displayqry) or die(error.__LINE__);

  $cnt = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Attendee</title>
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
              <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="attendee.php">Attendee</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="feedback.php">View Feedback</a>
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
  <h5>Welcome , <strong>Admin</strong></h5>
  <p>Type something in the input field to search:</p>
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <table class="table table-bordered table-striped table-responsive w-100 d-block d-md-table">
            <thead>
              <th class="text-center">S/N</th>
              <th class="text-center">Student Details</th>
              <th class="text-center">Feedback</th>
            </thead>
    <tbody id="myTable">
    <?php
      for($i=0;$i<$cnt;$i=$i+1)
      {
        $row = $result->fetch_assoc();
        ?>
      <tr>
        <td class="text-center"><?php echo $i+1 ?></td>
        <td class="text-left">
          Student Id : <b><?php echo $row['stud_id'] ?></b><br>
          Name : <b><?php echo $row['name'] ?></b><br>
          USN : <b><?php echo $row['usn'] ?></b><br>
          Email : <b><?php echo $row['email'] ?></b><br>
          Mobile : <b><?php echo $row['mobile'] ?></b><br>
          Department : <b><?php echo $row['dept'] ?></b><br>
        </td>
        <td class="text-left">
          <b>Q1. <?php echo $row['q1'] ?></b><br>
             Ans. <?php echo $row['a1'] ?><br>
          <b>Q2. <?php echo $row['q2'] ?></b><br>
             Ans. <?php echo $row['a2'] ?><br>
          <b>Q3. <?php echo $row['q3'] ?></b><br>
             Ans. <?php echo $row['a3'] ?><br>
          <b>Q4. <?php echo $row['q4'] ?></b><br>
             Ans. <?php echo $row['a4'] ?><br>
          <b>Q5. <?php echo $row['q5'] ?></b><br>
             Ans. <?php echo $row['a5'] ?><br>
          <b>Feedback : </b><br>
            <?php echo $row['feedback'] ?>
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
</body>
</html>

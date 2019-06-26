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
              <a class="nav-link active" href="attendee.php">Attendee</a>
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
  <h5>Welcome , <strong>Admin</strong></h5>
  <form method="post" action="export.php" align="right">  
       <input type="submit" name="export" value="CSV Export" class="btn btn-success" />  
  </form>
  <p>Type something in the input field to search:</p>
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <table class="table table-bordered table-striped table-responsive w-100 d-block d-md-table">
            <thead>
              <th class="text-center">SL.NO</th>
              <th class="text-center">Student ID</th>
              <th class="text-center">Name</th>
              <th class="text-center">USN</th>
              <th class="text-center">Department</th>
              <th class="text-center">Email</th>
              <th class="text-center">Mobile</th>
              <th class="text-center">People</th>
            </thead>
    <tbody id="myTable">
    <?php
      for($i=0;$i<$cnt;$i=$i+1)
      {
        $row = $result->fetch_assoc();
        ?>
      <tr>
        <td class="text-center"><?php echo $i+1 ?></td>
        <td class="text-center"><?php echo $row['stud_id'] ?></td>
        <td class="text-center"><?php echo $row['name'] ?></td>
        <td class="text-center"><?php echo $row['usn'] ?></td>
        <td class="text-center"><?php echo $row['dept'] ?></td>
        <td class="text-center"><?php echo $row['email'] ?></td>
        <td class="text-center"><?php echo $row['mobile'] ?></td>
        <td class="text-center"><?php echo $row['people'] ?></td>
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

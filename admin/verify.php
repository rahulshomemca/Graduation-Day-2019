<?php

include ('../include/dbcon.php');

session_start();

require('../textlocal.class.php');

require('../credential.php');

date_default_timezone_set('Asia/Kolkata');

?>



<!DOCTYPE html>

<html lang="en">

<head>

  <title>Reset Password</title>

  <meta charset="utf-8">

  <link rel="icon" href="../image/rahul-fav.png" sizes="16x16" type="image/png">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>

<body>



<br>

<br>

<br>

<div class="container testimonial-con">

  <div class="col-lg-6 col-md-6 col-sm-12 col-10 d-block m-auto">

    <div class="card shadow p-4 mb-4 bg-white">

      <h3 class="text-center text-info">Reset Password</h3>

      <p class="text-center text-secondary">Enter Registered Mobile No.</h3>

      <form action="" method="POST">

        <div id="mobile_no">

          <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile No." value="<?php echo $_POST['mobile'] ?>"><br>

          <input type="submit" name="submit" value="Send OTP" class="btn btn-info btn-block" id="mob_btn"><br>

        </div>

        <div id="otp_valid" style="display: none;">

          <input type="text" name="otp" class="form-control" placeholder="Enter OTP" value="<?php echo $_POST['otp'] ?>"><br>

          <input type="submit" name="otpverify" value="Verify OTP" class="btn btn-success btn-block">

        </div>

      </form>

      <?php

        if(isset($_POST['submit']))

        {

          $mobile = $_POST['mobile'];



          $match = preg_match('/^[0-9]{10}+$/', $mobile);



          if($match == 1)

          {

            $qry = "SELECT * FROM `admin` WHERE `mobile`='$mobile';";

            $res = $mysqli->query($qry) or die(error.__LINE__);

            $cnt = mysqli_num_rows($res);

            $row = mysqli_fetch_assoc($res);

            if($cnt == 0)

            {

              ?>  

                <br><p class="text-danger text-center">Mobile number not register!!</p>

              <?php

            }

            else

            {

              echo '<script type="text/javascript">

                      $(document).ready(function(){

                        $("#otp_valid").show();
			$("#mob_btn").attr("disabled", true);
                        $("#mobile_no").hide();

                      });

                    </script>';

              $textlocal = new Textlocal(false, false, API_KEY);

              $numbers = array($_POST['mobile']);

              $sender = 'RVCEGD';

              $otp = mt_rand(100000, 999999);

              $message = "Hello ".$row['username']." . This is your OTP: ".$otp;

              try {

                  $result = $textlocal->sendSms($numbers, $message, $sender);

                  $_SESSION['otp'] = $otp;

              } catch (Exception $e) {

                  die('Error: ' . $e->getMessage());

              }

              ?>  

             	<p class="text-success text-center mt-3">OTP sent to <?php echo $mobile?>!!</p>

              <?php        

              $_SESSION['mobile'] = $mobile;

            }

          }

          else

          {

            ?>  

              <br><p class="text-danger text-center">Invalid Mobile Number!!</p>

            <?php

          }

        }



        if(isset($_POST['otpverify'])){

          $otp = $_POST['otp'];

          if($_SESSION['otp'] == $otp)

          {

            $_SESSION['otp'] = '0';



            $mobile = $_SESSION['mobile'];

            $qry = "SELECT * FROM `admin` WHERE `mobile`='$mobile';";

            $res = $mysqli->query($qry) or die(error.__LINE__);

            $row = mysqli_fetch_assoc($res);

            $_SESSION['resethash'] = $row['hash'];

            $_SESSION['name_user'] = $row['username'];



            echo '<script type="text/javascript">

                      $(document).ready(function(){

                        $("#otp_valid").show();
			$("#mob_btn").attr("disabled", true);
                        $("#mobile_no").hide();

                      });

                    </script>';

            ?>

              <p class="text-success text-center mt-3">OTP verifed successfully , Redirecting ... !!</p>

              <meta http-equiv="refresh" content="0.1; URL='resetpassword.php'" />

            <?php

          }

          else

          {

            echo '<script type="text/javascript">

                      $(document).ready(function(){

                        $("#otp_valid").show();
			$("#mob_btn").attr("disabled", true);
                        $("#mobile_no").hide();

                      });

                    </script>';

            ?>  

              <p class="text-danger text-center mt-3">Invalid OTP!!</p>

            <?php

          }

        }

      ?>

    </div>

  </div>

</div>

</body>

</html>

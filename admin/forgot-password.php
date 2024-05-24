
<?php 

include_once './config/connect.php';
include_once './config/functions.php';
session_start();

?>

<?php include('partials/header.php'); ?>
<link rel="stylesheet" href="css/forgot-password.css">

<form action="forgot-password.php" method="post">
  <div class="forgot-container">
    <div class="forgot-pass">
      <div><h1>Forgot Password</h1></div>
    </div>
    <div class="forgotPass-form">
      <div>
        <p>Just need to confirm your email to send you instructions to reset your password.<p>
        <div id="emailNotif1" class="emailNotif">Your email has been sent</div>
        <div id="emailNotif2" class="triangle"></div>
        <div id="emailNotif3" class="emailNotif">Failed to generate reset token</div>
        <div id="emailNotif4" class="triangle"></div>
        <div id="emailNotif5" class="emailNotif">No account detected</div>
        <div id="emailNotif6" class="triangle"></div>
        <p>* indicates required field</p>
        <input type="email" placeholder="* Email" name="email" required autocomplete="off">
        <button type="submit" name="submit">Send</button>
      </div>
    </div>
  </div>
</form>

<?php 

if (isset($_POST['submit'])){
  $email = mysqli_escape_string($conn, $_POST['email']);
  $token = md5(rand());

  $check_email = "SELECT * FROM useraccounts WHERE email ='$email' LIMIT 1";
  $result = mysqli_query($conn, $check_email);

  if (mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
    $get_name = $row["username"];
    $get_email = $row["email"];

    $update_token = "UPDATE useraccounts SET token='$token' WHERE email='$email' LIMIT 1";
    $tokenResult = mysqli_query($conn, $update_token);

    if ($tokenResult){
      send_pass_reset($get_name, $get_email, $token);
      echo "<script>
              document.getElementById('emailNotif1').style.display = 'flex';
              document.getElementById('emailNotif2').style.display = 'block';
              document.addEventListener('click', function() {
                document.getElementById('emailNotif1').style.display = 'none';
                document.getElementById('emailNotif2').style.display = 'none';
              });
            </script>";
    } else {
      echo "<script>
              document.getElementById('emailNotif3').style.display = 'flex';
              document.getElementById('emailNotif4').style.display = 'block';
              document.addEventListener('click', function() {
                document.getElementById('emailNotif3').style.display = 'none';
                document.getElementById('emailNotif4').style.display = 'none';
              });
            </script>";
    }

  } else{
    echo "<script>
              document.getElementById('emailNotif5').style.display = 'flex';
              document.getElementById('emailNotif6').style.display = 'block';
              document.addEventListener('click', function() {
                document.getElementById('emailNotif5').style.display = 'none';
                document.getElementById('emailNotif6').style.display = 'none';
              });
            </script>";
  }
}

?>

<!-- Hide the nav buttons -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var nav = document.getElementById("mainNav");

        var listItems = nav.getElementsByTagName("li");

        for (var i = 0; i < listItems.length; i++) {
            listItems[i].style.display = "none";

            listItems[0].style.fontWeight = "bold";
            listItems[0].style.fontFamily = "League Spartan";
            listItems[0].style.fontSize = "30px";
        }

        document.getElementById('Cart').style.display = "none";
        document.getElementById('Sign-in').style.display = "none";
        document.getElementById('Sign-up').style.display = "none";
    });
</script>
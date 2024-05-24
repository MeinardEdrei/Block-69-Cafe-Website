<?php 

include('partials/header.php'); 
include_once('config/connect.php') 

?>

<link rel="stylesheet" href="css/sign-up.css">

<form action="sign-up.php" method="post">
  <div class="sign-up-container">
    <h1 h1>Create an account</h1>
    <div class="description">
      <h2 style="font-family: League Spartan; font-size: 19px;">BLOCK 69 CAFE LOYALTY CARD</h2>
      <p style="font-size: 18px">Join Block 69 Cafe Loyalty Cards to earn a free cup <br> of coffee of your choice on your 10th payment.</p>
    </div>

    <div class="form-container">
      <p>*indicates required field</p>
      <div id="success" class="success">
        Successfully signed up. 
      </div>
      <input type="text" name="username" placeholder="* Username" required autocomplete="off">
      <input type="text" name="email" placeholder="* Email Address" required autocomplete="off">
      <input type="text" name="password" placeholder="* Password" required autocomplete="off">

      <div id="emailNotif1" class="emailNotif">Thank you and continue to support us and claim your free drink on your 10th payment!</div>
      <div id="emailNotif2" class="triangle"></div>
      <div class="chk"> Already have a Loyalty Card? 
        <a onclick="detailsOnClick()" style="color: Black; text-decoration:underline; cursor:pointer; font-weight:bold;">Details</a>
        <a style="color: black; cursor:pointer;" id="detailsLink" class="emailNotifOkay">Got it</a>
      </div>

      <input type="submit" name="submit" value="Sign up">
    </div>
  </div>
</form>

<?php 

$conn = get_connection();

if ($_SERVER["REQUEST_METHOD"]=="POST"){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = "customer";

    if(!empty($username) && !empty($email) && !empty($password)){

      $query = "INSERT INTO useraccounts (status, username, email, password) VALUES ('$status', '$username', '$email', '$password')";

      mysqli_query($conn, $query);

      echo "<script>
              document.getElementById('success').style.display = 'flex';
              document.addEventListener('click', function() {
                document.getElementById('success').style.display = 'none';
              });
            </script>";
      
      include('partials/footer.php'); 
      die;

    }elseif(!empty($username) && empty($email) && !empty($password)){
      echo "Please enter email";
    }elseif(!empty($username) && !empty($email) && empty($password)){
      echo "Please enter password";
    }elseif(empty($username) && !empty($email) && !empty($password)){
      echo "Please enter username";
    }else{
      echo "Please enter username and email and password";
    }
  }
  
?>

<?php include('partials/footer.php'); ?>

<script>
  function detailsOnClick(){
    var emailNotif1 = document.getElementById('emailNotif1');
    var emailNotif2 = document.getElementById('emailNotif2');
    var emailNotifOkay = document.getElementById('detailsLink');

    // Toggle the display of the message box and triangle when the "Details" link is clicked
    if (emailNotif1.style.display === 'none' || emailNotif1.style.display === '') {
      emailNotif1.style.display = 'flex';
      emailNotif2.style.display = 'block';
      emailNotifOkay.style.display = 'block';
    } else {
      emailNotif1.style.display = 'none';
      emailNotif2.style.display = 'none';
      emailNotifOkay.style.display = 'none';
    }
  }

  // Add event listener to prevent the click event from bubbling up to the document
  document.getElementById('detailsLink').addEventListener('click', function(event) {
    var emailNotif1 = document.getElementById('emailNotif1');
    var emailNotif2 = document.getElementById('emailNotif2');
    var emailNotifOkay = document.getElementById('detailsLink');

    emailNotif1.style.display = 'none';
    emailNotif2.style.display = 'none';
    emailNotifOkay.style.display = 'none';
  });
  
</script>

<?php
include_once './config/connect.php';
include_once './config/functions.php';
include './partials/header.php'; 
?>

<link rel="stylesheet" href="css/sign-in.css">

<form action="sign-in.php" method="post">
  <div class="sign-in-container">
    <h1 h1>Sign in or create an account</h1>
    <div class="form-container">
      <p>*indicates required field</p>
      <input type="text" name="username" placeholder="* Username" required autocomplete="off">
      <input type="text" name="password" placeholder="* Password" required autocomplete="off">
      <a href="forgot-password.php" class="forgot-info">Forgot your password?</a>
      <input type="submit" name="submit" value="Sign in">
    </div>
  </div>
  <div class="join-container">
    <p style="font-size: 22px; font-weight: bold;">JOIN BLOCK 69 CAFE REWARDS</p>
    <p style="font-size: 20px;">Join Block 69 Cafe Loyalty Cards to earn a free cup <br> of coffee of your choice in
        your 10th payment.</p>
        <a style="font-size: 18px; text-decoration: none; padding:1em; background-color: transparent; border: 1px solid black; color: black;" href="sign-up.php" id="Sign-up">Join now</a>
  </div>
  
</form>

<?php 

session_start();

$conn = get_connection();

if ($_SERVER["REQUEST_METHOD"]=="POST"){
  $username = $_POST['username'];
  $password = $_POST['password'];

  if($username == "" && $password == ""){
    echo "Need user input";
    include('partials/footer.php');
    die;
  }elseif($username == "" && !($password == "")){
    echo "Enter an email/username";
    include('partials/footer.php');
    die;
  }elseif($password == "" && !($username == "")){
    echo "Enter a password";
    include('partials/footer.php');
    die;
  }

  $query1 = "SELECT * FROM useraccounts WHERE username='" .$username. "'";
  $query2 = "SELECT * FROM useraccounts WHERE password='" .$password. "'";

  $result1 = mysqli_query($conn, $query1);
  $result2 = mysqli_query($conn, $query2);

  if($result1 != "" || $result2 != ""){
      if(($result1 && mysqli_num_rows($result1)) && ($result2 && mysqli_num_rows($result2)) > 0){
  
        $userData1 = mysqli_fetch_assoc($result1);
        $userData2 = mysqli_fetch_assoc($result2);
  
        if(($userData1['username'] == $username && $userData1['password'] == $password) && $userData2['username'] == $username && $userData2['password'] == $password){
  
          $_SESSION['username'] = $username;
          header("Location: home.php");
          die;
  
        }
      }elseif(!($result1 && mysqli_num_rows($result1) > 0)){
        echo "incorrect username";
      }elseif(!($result2 && mysqli_num_rows($result2) > 0)){
        echo "incorrect password";
      }
    }
}
  include('partials/footer.php');
?>

<script type="text/javascript">
  window.addEventListener("beforeunload", function(event) {
    var checkbox = document.getElementById("KeepSession");
    
    if (!checkbox.checked) {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "sign-out.php", true);
      xhr.send();
    }
  });
</script>

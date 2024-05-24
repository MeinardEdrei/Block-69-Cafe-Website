<?php 

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function check_login($conn){
  return isset($_SESSION['username']);
}

function check_usertype($conn){
  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
  
    $query = "SELECT status FROM useraccounts WHERE username = '$username'";
  
    $result = mysqli_query($conn, $query);
    
    if($result && mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result); 
      $userStatus = $row['status'];
  
      return $userStatus;
    }
  }
}

function send_pass_reset($get_name, $get_email, $token){
  try {
    $mail = new PHPMailer(true);
    $mail->isSMTP(); 
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;
    $mail->Username   = 'block69cafe.team@gmail.com';                     
    $mail->Password   = 'srdh psza zlpd bmwq';                               
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          
    $mail->Port       = 587;                                    

    //Recipients
    $mail->setFrom('block69cafe.team@gmail.com', 'Block 69 Cafe');
    $mail->addAddress($get_email);  
    $mail->isHTML(true);
    $mail->Subject = "Reset Password Notification";

    $email_template = "
                      <h1>Hey ".$get_name."!</h1>
                      <p>You are receiving this email because we received a password reset request from your account.</p>
                      <br><br>
                      <a href='http://localhost/Block%2069/admin/password-reset.php?token=$token&email=$get_email' style='color: black;'>Password Recovery Link</a>
                      <br><br>
                      <p>Thanks,</p>
                      <p>The Block 69 Cafe Team</p>
    ";

    $mail->Body = $email_template;
    $mail->send();
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function cartcontents($conn){
  $query = "SELECT * FROM cartcontent";
  
  $result = mysqli_query($conn, $query);
  $cart_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $cart_content;
}

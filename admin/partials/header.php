
<?php 

  include_once './config/functions.php';
  include_once './config/connect.php';

  $conn = get_connection();
  $userActive = check_login($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BLOCK 69 Café</title>

  <!-- LINK -->
  <link rel="icon" href="icons/newlogo-light.png">
  <link rel="stylesheet" href="css/header.css">

  <!-- FONTS -->
  <link href="https://fonts.googleapis.com/css2?family=Yeseva+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- ICONS -->
  <link rel="stylesheet" href="https:stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- SCRIPT -->
  <script src="https://kit.fontawesome.com/266d743c96.js" crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
</head>

<body>
  <a href="#" class="to-top">
    <i class="fas fa-chevron-up"></i>
    <script>
      const toTop = document.querySelector(".to-top");
      window.addEventListener("scroll", () => {
        if (window.pageYOffset > 700) {
          toTop.classList.add("active");
        } else {
          toTop.classList.remove("active");
        }
      })
    </script>
  </a>
  <nav id="mainNav">
    <ul>
      <img src="Icons/newlogo.png" onclick="window.location.href='../admin/home.php'" style="cursor: pointer;" alt="">
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fa fa-bars"></i>
      </label>
      
      <li><a href="../admin/menu.php">MENU</a></li>
      <li><a href="../admin/blog.php">BLOG</a></li>
      <li><a href="../admin/services.php">SERVICES</a></li>
      <li><a href="../admin/about.php">ABOUT US</a></li>

    </ul>
    <div class="buttons">
      <?php

    if($userActive){
        echo '
        <a id="Cart" href="shopping-cart.php"><i class="fa-solid fa-cart-shopping" style="font-size: 25px;"><span>0</span></i></a>
        <a href="sign-out.php"  id="User"><i class="fa-sharp fa-solid fa-right-from-bracket" style="font-size: 25px; margin-right: 10px;"></i></a>
        </div>';
    }else{
        echo '<a href="sign-in.php" id="Sign-in">Login</a>
        <a href="sign-up.php" id="Sign-up">Join now</a>
        <a id="Cart" href="cart.php"><i class="fa-solid fa-cart-shopping" style="font-size: 25px;"></i></a>';
    }
    ?>
    </div>
  </nav>

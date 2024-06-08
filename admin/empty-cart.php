<?php 
session_start();
include("partials/header.php");
include_once './config/functions.php';
include_once './config/connect.php';
?>

<title>Shopping Cart</title>
<link rel="stylesheet" href="css/cart.css">

  <div class="cart-container">
    <div class="promptLogin">
      <i class="fa-solid fa-face-smile" style="color: #94989e;"></i>
      <h1>Your shopping cart is empty</h1>
      <a href="menu.php">Go Shopping Now</a>
    </div>
  </div>

<?php 
include("partials/footer.php");
?>

<!-- Hide the nav buttons -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var nav = document.getElementById("mainNav");

    var listItems = nav.getElementsByTagName("li");

    for (var i = 0; i < listItems.length; i++) {
        listItems[i].style.display = "none";

        listItems[0].style.display = "block";
        listItems[0].innerHTML = "<span style='font-weight: lighter;'>|</span>" + "<span style='margin-left: 1em;'>Shopping Cart</span>";
        listItems[0].style.fontWeight = "bold";
        listItems[0].style.fontFamily = "League Spartan";
        listItems[0].style.fontSize = "30px";
    }
    document.getElementById('Cart').style.display = "none";
  });
</script>
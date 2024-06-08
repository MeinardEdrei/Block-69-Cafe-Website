<?php 
   session_start();
   include('partials/header.php'); 
   include_once('config/functions.php');
   $conn = get_connection();

   $username = $_SESSION['username'];   
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["placeorder"])) {
    $shippingfee = $_POST['shippingfee'];
    $paymentmethod = $_POST['paymentmethod'];
    $totalpayment = $_POST['totalpayment'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $fulladdress = $_POST['SBH'].", ".$_POST['CB'].", ".$_POST['postal'].", "."Philippines";

    if ($paymentmethod == "Cash on Delivery") {
        $checkout_query = "INSERT INTO orderdetails (`username`, `shipping_fee`, `payment_method`, `total_payment`, `full_name`, `phone_number`, `address`)
                        VALUES ('$username', '$shippingfee', '$paymentmethod', '$totalpayment', '$fullname', '$phone', '$fulladdress')";
        $order_query = "INSERT INTO orderitems (username, item_id, item_category, item_image, item_name, item_customization, item_price, item_quantity, item_totalprice)
        SELECT username, item_id, item_category, item_image, item_name, item_customization, item_price, item_quantity, item_totalprice FROM checkoutcontent";
        if (mysqli_query($conn, $checkout_query) && mysqli_query($conn, $order_query)) {
            // If insertion is successful, clear the cart
            $clear_cart_query = "DELETE FROM cartcontent";
            if (mysqli_query($conn, $clear_cart_query)) {
                echo '<script>alert("Your order has been successfully submitted.");';
                echo 'window.location = "menu.php";</script>';
                exit();
            } else {
                echo "Error: " . $clear_cart_query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: " . $checkout_query . "<br>" . mysqli_error($conn);
        }
    } else if ($paymentmethod == "GCash") {
        // Redirect to payment page
        $_SESSION['shippingfee'] = $shippingfee;
        $_SESSION['paymentmethod'] = $paymentmethod;
        $_SESSION['totalpayment'] = $totalpayment;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['phone'] = $phone;
        $_SESSION['fulladdress'] = $fulladdress;
        echo '<script>window.location = "payment.php";</script>';
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm"])) {
    $shippingfee = $_SESSION['shippingfee'];
    $paymentmethod = $_SESSION['paymentmethod'];
    $totalpayment = $_SESSION['totalpayment'];
    $fullname = $_SESSION['fullname'];
    $phone = $_SESSION['phone'];
    $fulladdress = $_SESSION['fulladdress'];
    $receipt = $_FILES["receipt"]["name"];
    $gcash_num = $_POST["gcash-num"];
    $reference_num = $_POST["reference-num"];

    $receipt_tmp = $_FILES["receipt"]["tmp_name"];
    $receipt_folder = "receipts/" . $receipt;
    move_uploaded_file($receipt_tmp, $receipt_folder);

    $checkout_query = "INSERT INTO orderdetails (`username`, `shipping_fee`, `payment_method`, `total_payment`, `full_name`, `phone_number`, `address`, `receipt`, `gcash_number`, `reference_number`)
                    VALUES ('$username', '$shippingfee', '$paymentmethod', '$totalpayment', '$fullname', '$phone', '$fulladdress', '$receipt_folder', '$gcash_num', '$reference_num')";
    $order_query = "INSERT INTO orderitems (username, item_id, item_category, item_image, item_name, item_customization, item_price, item_quantity, item_totalprice)
    SELECT username, item_id, item_category, item_image, item_name, item_customization, item_price, item_quantity, item_totalprice FROM checkoutcontent";
  
      if (mysqli_query($conn, $checkout_query) && mysqli_query($conn, $order_query)) {
        // If insertion is successful, clear the cart
        $clear_cart_query = "DELETE FROM cartcontent";
        if (mysqli_query($conn, $clear_cart_query)) {
            echo '<script>alert("Your order has been successfully submitted.");';
            echo 'window.location = "menu.php";</script>';
            exit();
        } else {
            echo "Error: " . $clear_cart_query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $order_query . "<br>" . mysqli_error($conn);
    }
}
?>

<title>Payment</title>
<link href="css/payment.css" rel="stylesheet">

<form method="post" enctype="multipart/form-data">
  <div class="payment-container">
    <div class="gcash-info">
      <div class="qr-code">
        <p>Scan the QR Code</p>
        <img src="Images/QR Code.jpg">
      </div>
      <div class="receipt">
        <label for="receipt" id="uploadLabel">Upload Receipt</label>
        <input type="file" id="receipt" class="receipt" name="receipt" required>
        <span id="uploadedFileName"></span>
      </div>
      <div class="gcash-number">
        <label for="gcash-num">GCash number:</label>
        <input type="text" id="gcash-num" name="gcash-num" onchange="validatePhilippinePhone(this)" required>
      </div>
      <div class="reference-number">
        <label for="reference-num">Reference number:</label>
        <input type="text" id="reference-num" name="reference-num" required>
      </div>
      <div class="btn-confirm">
        <button type="submit" name="confirm">Confirm</button>
      </div>
    </div>
  </div>
</form>

<?php
  include('partials/footer.php'); 
?>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var nav = document.getElementById("mainNav");

    var listItems = nav.getElementsByTagName("li");

    for (var i = 0; i < listItems.length; i++) {
        listItems[i].style.display = "none";

        listItems[0].style.display = "block";
        listItems[0].innerHTML = "<span style='font-weight: lighter;'>|</span>" + "<span style='margin-left: 1em;'>Payment</span>";
        listItems[0].style.fontWeight = "bold";
        listItems[0].style.fontFamily = "League Spartan";
        listItems[0].style.fontSize = "30px";
    }
    document.getElementById('Cart').style.display = "none";
  });
  
  function validatePhilippinePhone(inputField) {
    const phoneRegex = /^0(?:9\d{9}|2\d{7}|3\d{7}|4\d{7}|5\d{7}|7\d{7}|8\d{8})$/;
    const phoneNumber = inputField.value.trim();

    if (!phoneRegex.test(phoneNumber)) {
      alert("Invalid phone number. Please enter a valid mobile number.");
      inputField.value = ""; // Clear the input field on error
      return false; // Indicate validation failure (optional)
    }
    
    // Optional: Extract the phone number without leading zero for processing (if needed)
    const extractedNumber = phoneNumber.substring(1);
    // ... (use extractedNumber for further processing)
    
    return true; // Indicate validation success (optional)
  }

  // Display uploaded file name
  document.getElementById('receipt').addEventListener('change', function() {
    document.getElementById('uploadedFileName').innerText = this.files[0].name;
  });
</script>
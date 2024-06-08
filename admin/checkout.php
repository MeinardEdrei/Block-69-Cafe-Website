<?php 
  session_start();
  include('partials/header.php'); 
  include_once('config/functions.php');
  $conn = get_connection();

  $username = $_SESSION['username'];   

  // Handle delete all operation 
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-all"])) {
    $delete_query = "DELETE FROM cartcontent";
    if(mysqli_query($conn, $delete_query)) {
      // Successfully deleted all, redirect to avoid form resubmission
      header("Location: shopping-cart.php");
      exit();
    } else {
      echo "Error: " . $delete_query . "<br>" . mysqli_error($conn);
    }
  }

  // Handle checkout operation
  if(isset($_POST["checkout"]) && isset($_POST["checkout"])) {
    $checkout_query = "INSERT INTO checkoutcontent (username, item_id, item_category, item_image, item_name, item_customization, item_price, item_quantity, item_totalprice)
                      SELECT username, item_id, item_category, item_image, item_name, item_customization, item_price, item_quantity, item_totalprice FROM cartcontent";
    if (mysqli_query($conn, $checkout_query)) {
      $_SESSION['checkout_in_progress'] = true;
      // echo '<script>alert("Checkout successful!");</script>';
      // // Successfully inserted into checkoutcontent, now clear the cart
      // $clear_cart_query = "DELETE FROM cartcontent";
      // if (mysqli_query($conn, $clear_cart_query)) {
      //     // Successfully cleared the cart, redirect to a confirmation page or the checkout page
      //     // header("Location: checkout.php");
      //     exit();
      // } else {
      //     echo "Error: " . $clear_cart_query . "<br>" . mysqli_error($conn);
      // }
    } else {
        echo "Error: " . $checkout_query . "<br>" . mysqli_error($conn);
    }
  }

  $checkoutCount_query = "SELECT COUNT(*) as checkout_count FROM checkoutcontent";
  $checkoutCountresult = mysqli_query($conn, $checkoutCount_query);
  $checkout_count = 0;
  //  Updates cart item count
  if(mysqli_num_rows($checkoutCountresult) > 0) {
    $row = mysqli_fetch_assoc($checkoutCountresult);
    $checkout_count = $row['checkout_count'];
  } else {
    $checkout_count = 0;
  }

  // Fetch all checkout items
  $query = "SELECT * FROM checkoutcontent";
  $result = mysqli_query($conn, $query);
  $checkoutItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<title>Checkout</title>
<link href="css/checkout.css" rel="stylesheet">

<form action="payment.php" method="post" enctype="multipart/form-data">
  <div class="checkout-container">
    <div class="address-container">
      <div class="address-text">
        <p><img src=""><i class="fa-solid fa-location-dot" style="font-size: 22px;"></i>&nbsp; Delivery Address</p>
      </div>
      <div class="address-info">
        <div class="full-name">
          <input type="text" name="fullname" placeholder="Full Name" required>
        </div>
        <div class="contact-number">
          <input type="tel" id="phone" name="phone" placeholder="Phone Number" required onchange="validatePhilippinePhone(this)">
        </div>
        <div class="address">
          <div class="CB"><input type="text" name="CB" placeholder="Barangay, City" required></div>
          <div class="postal"><input type="text" name="postal" placeholder="Postal Code" required></div>
          <div class="SBH"><input type="text" name="SBH" placeholder="Street Name, Building, House No." required></div>
        </div>
      </div>
    </div>

    <div class="products-ordered-container">
      <div class="products-summary-container">
        <div class="column products-ordered">
            <h3><i class="fa-solid fa-cart-shopping" style="font-size: 22px;"></i> &nbsp;Products Ordered</h3>
        </div>
        <div class="column empty"></div>
        <div class="column">
          <p>Customization</p>
        </div>
        <div class="column">
          <p>Price</p>
        </div>
        <div class="column">
          <p>Quantity</p>
        </div>
        <div class="column">
          <p>Item Subtotal</p>
        </div>
      </div>
      <div class="checkout-info">
      <?php if (!empty($checkoutItems)): ?>
        <?php foreach ($checkoutItems as $item): ?>
          <div class="orders" id="checkoutitem-<?php echo $item['item_id']; ?>">
            <div class="column item-image">
              <img src="<?php echo $item['item_image']; ?>">
            </div>
            <div class="column item-name">
              <h4><?php echo $item['item_name']; ?></h4>
            </div>
            <div class="column item-customization">
              <p><?php echo $item['item_customization']; ?></p>
            </div>
            <div class="column item-price">
              <p>₱<span><?php echo $item['item_price']; ?></span></p>
            </div>
            <div class="column item-quantity">
              <p><?php echo $item['item_quantity']; ?></p>
            </div>
            <div class="column item-subtotal">
              <p>₱<span><?php echo $item['item_totalprice']; ?></span></p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: 
        header("Location: empty-cart.php");
      endif; ?>

        <div class="shipping-container">
          <div class="txt-shipping-fee">
            <p>Shipping Fee:</p>
          </div>
          <div class="shipping-fee">
            <span>₱<?php $shippingfee = 38; echo $shippingfee; ?></span>
          </div>
        </div>
        <div class="order-total-container">
          <div class="txt-order-total">
            <p>Order Total (<?php echo $checkout_count ?> item<?php if($checkout_count > 1) echo "s"; ?>):</p>
          </div>
          <div class="order-total">
            <span>
              ₱<?php $subtotal = 0; foreach($checkoutItems as $item) $subtotal += $item["item_totalprice"]; echo number_format($subtotal, 0, '.', ','); ?>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="mod-container">
      <div class="txt-payment">
        <div>
          <p><i class="fa-solid fa-money-bill" style="font-size: 22px;"></i> &nbsp;Payment Method</p>
        </div>
        <div class="payment-method">
          <p>
            <select id="paymentmethod" class="paymentmethod" name="paymentmethod">
                <option value="Cash on Delivery">Cash on Delivery</option>
                <option value="GCash">GCash</option>
            </select>
          </p>
        </div>
      </div>
      <div class="payment-info">
        <div class="flex subtotal">
          <div>
            <p>Subtotal: </p>
          </div>
          <div class="row subtotal-price">
            <span>₱<?php echo number_format($subtotal, 0, '.', ','); ?></span>
          </div>
        </div>
        <div class="flex vat">
          <div>
            <p>VAT: </p>
          </div>
          <div class="row">
            <span><?php $VAT = 0.12; $percentageTax = $VAT * 100; echo $percentageTax."%"; ?></span>
          </div>
        </div>
        <div class="flex shipping-total">
          <div>
            <p>Shipping Fee: </p>
          </div>
          <div class="row">
            <span>₱<?php echo $shippingfee; ?></span>
            <input type="hidden" name="shippingfee" value="<?php echo $shippingfee; ?>">
          </div>
        </div>
        <div class="flex total-payment">
          <div class="txt-total-payment">
            <p>Total Payment: </p>
          </div>
          <div class="total-payment-price">
            <span>₱<?php $totalPayment = ($subtotal * (1 + $VAT)) + $shippingfee;echo number_format($totalPayment, 0, '.', ','); ?></span>
            <input type="hidden" name="totalpayment" value="<?php echo number_format($totalPayment, 0, '.', ','); ?>">
          </div>
        </div>
      </div>
      <div class="place-order">
        <button type="submit" name="placeorder">Place Order</button>
      </div>
    </div>
  </div>
</form>

<?php include('partials/footer.php'); ?>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var nav = document.getElementById("mainNav");

    var listItems = nav.getElementsByTagName("li");

    for (var i = 0; i < listItems.length; i++) {
        listItems[i].style.display = "none";

        listItems[0].style.display = "block";
        listItems[0].innerHTML = "<span style='font-weight: lighter;'>|</span>" + "<span style='margin-left: 1em;'>Checkout</span>";
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
</script>
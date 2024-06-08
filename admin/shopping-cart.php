<?php 
  session_start();
  include_once('config/functions.php');
  include_once('partials/header.php'); 
  $conn = get_connection();

  $username = $_SESSION['username'];  

  // Clear checkout content if the user navigates back from the checkout page
  if (isset($_SESSION['checkout_in_progress']) && $_SESSION['checkout_in_progress'] === true) {
    $clear_checkout_query = "DELETE FROM checkoutcontent";
    if (mysqli_query($conn, $clear_checkout_query)) {
        // Successfully cleared checkout content
        unset($_SESSION['checkout_in_progress']);
    } else {
        echo "Error: " . $clear_checkout_query . "<br>" . mysqli_error($conn);
    }
  }

  // Handle delete operation
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_item_id"])) {
    $delete_item_id = $_POST["delete_item_id"];
    $delete_query = "DELETE FROM cartcontent WHERE item_id='$delete_item_id'";
    if(mysqli_query($conn, $delete_query)) {
      // Successfully deleted, redirect to avoid form resubmission
      header("Location: shopping-cart.php");
      exit();
    } else {
      echo "Error: " . $delete_query . "<br>" . mysqli_error($conn);
    }
  }

  // Handle insert operation
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["itemid"])) {
    $itemid = $_POST["itemid"];
    $itemcategory = $_POST["itemcategory"];
    $itemimage = $_POST["itemimage"];
    $itemname = $_POST["itemname"];
    $itemcustomization = $_POST["itemcustomization"];
    $itemprice = $_POST["itemprice"];
    $itemquantity = $_POST["itemquantity"];
    $itemtotalprice = $_POST["itemtotalprice"];

    // Check if the item with the same id and customization already exists
    $check_query = "SELECT * FROM cartcontent WHERE item_id='$itemid' AND item_customization='$itemcustomization'";
    $result = mysqli_query($conn, $check_query);

    // if Buy Now
    if(isset($_POST["add-buy"]) && $_POST["add-buy"] == "Buy Now") {
      $insert_query = "INSERT INTO checkoutcontent (username, item_id, item_category, item_image, item_name, item_customization, item_price, item_quantity, item_totalprice) 
                       VALUES ('$username', '$itemid', '$itemcategory', '$itemimage', '$itemname', '$itemcustomization', '$itemprice', '$itemquantity', '$itemtotalprice')";
      if(mysqli_query($conn, $insert_query)) {
        $_SESSION['checkout_in_progress'] = true;
        header("Location: checkout.php");
        exit();
      } else {
        echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
      }
    } else { // if Add to Cart
      if (mysqli_num_rows($result) > 0) {
        // Item with the same id and customization exists, update it
        $existing_item = mysqli_fetch_assoc($result);
        $new_quantity = $existing_item['item_quantity'] + $itemquantity;
        $new_totalprice = $existing_item['item_totalprice'] + $itemtotalprice;
        $update_query = "UPDATE cartcontent SET item_quantity='$new_quantity', item_totalprice='$new_totalprice' WHERE item_id='$itemid' AND item_customization='$itemcustomization'";
        if (mysqli_query($conn, $update_query)) {
          echo '<script>if (window.history.replaceState) {window.history.replaceState(null, null, window.location.href);}</script>';
        } else {
          echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
        }
      } else {
        // Item does not exist, insert it
        $insert_query = "INSERT INTO cartcontent (username, item_id, item_category, item_image, item_name, item_customization, item_price, item_quantity, item_totalprice) 
                         VALUES ('$username', '$itemid', '$itemcategory', '$itemimage', '$itemname', '$itemcustomization', '$itemprice', '$itemquantity', '$itemtotalprice')";
        if (mysqli_query($conn, $insert_query)) {
          echo '<script>if (window.history.replaceState) {window.history.replaceState(null, null, window.location.href);}</script>';
        } else {
          echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
        }
      }
    }
  }
  
  // Fetch all cart items
  $query = "SELECT * FROM cartcontent";
  $result = mysqli_query($conn, $query);
  $cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<title>Shopping Cart</title>
<link href="css/shopping-cart.css" rel="stylesheet">
<script src="javascript/shopping-cart.js"></script>

<div class="cart-container">
  <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
    <div class="cart-summary">
      <!-- <div class="column select-all-container">
        <input type="checkbox" id="select-all" class="select select-all" value="products">
      </div> -->
      <div class="column summary-image"></div>
      <div class="column summary-product">
        <p>Product</p>
      </div>
      <div class="column customization">
        <p>Customization</p>
      </div>
      <div class="column summary-price">
        <p>Price</p>
      </div>
      <div class="column summary-quantity">
        <p>Quantity</p>
      </div>
      <div class="column summary-total-price">
        <p>Total Price</p>
      </div>
      <div class="column summary-actions">
        <p>Actions</p>
      </div>
    </div>
  </form>

  <div class="cart-items-container">
    <?php if (!empty($cartItems)): ?>
      <?php foreach ($cartItems as $item): ?>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
          <div class="cart-items" id="cartitem-<?php echo $item['item_id']; ?>">
            <!-- <div class="column select-container">
              <input type="checkbox" id="select" name="select" class="select select-item" a value="<?php echo $item['item_id']; ?>">
            </div> -->
            <div class="column product-image">
              <input type="hidden" name="item_image" value="<?php echo $item['item_image']; ?>">
              <img src="<?php echo $item['item_image']; ?>">
            </div>
            <div class="column product-name">
              <input type="hidden" name="item_name" value="<?php echo $item['item_name']; ?>">
              <h4><?php echo $item['item_name']; ?></h4>
            </div>
            <div class="column product-customization">
              <input type="hidden" name="item_customization" value="<?php echo $item['item_customization']; ?>">
              <p><?php echo $item['item_customization']; ?></p>
            </div>
            <div class="column product-price">
              <input type="hidden" name="item_price" value="<?php echo $item['item_price']; ?>">
              <p>₱<span><?php echo $item['item_price']; ?></span></p>
            </div>
            <div class="column quantity-counter">
              <input type="hidden" name="item_quantity" value="<?php echo $item['item_quantity']; ?>">
              <p><?php echo $item['item_quantity']; ?></p>
            </div>
            <div class="column total-price">
              <input type="hidden" class="item-totalprice" id="<?php echo $item['item_id']."-".$item['item_totalprice']; ?>" name="item_totalprice" value="<?php echo $item['item_totalprice']; ?>">
              <p>₱<span><?php echo $item['item_totalprice']; ?></span></p>
            </div>
            <div class="column delete-button">
                <input type="hidden" name="delete_item_id" value="<?php echo $item['item_id']; ?>">
                <button type="submit">Delete</button>
            </div>
          </div>
        </form>
      <?php endforeach; ?>
    <?php else: 
      header("Location: empty-cart.php");
    endif; ?>
  </div>
  
  <form action="checkout.php" method="POST" enctype="multipart/form-data">
    <div class="checkout-area">
      <!-- <div class="checkout select-all-checkout">
        <input type="checkbox" id="select-all-checkout" name="select-all-checkout" class="select select-all-checkout" value="select-all-checkout">
      </div> -->
      <div class="checkout delete-all">
        <button type="submit" name="delete-all">Delete All (<?php echo $cart_count ?>)</button>
      </div>
      <div class="checkout empty"></div>
      <div class="checkout empty"></div>
      <div class="checkout total-checkout">
        <p>
          Total (<?php echo $cart_count; ?> Item<?php if($cart_count > 1) echo "s";?>): 
          <span id="totalprice">
            ₱<?php $totalAmount = 0; foreach($cartItems as $item) $totalAmount += $item['item_totalprice']; echo number_format($totalAmount, 0, '.', ',');?>
          </span>
        </p>
      </div>
      <div class="checkout empty"></div>
      <div class="checkout checkout-button">
        <a href="checkout.php"><input type="submit" class="checkout-btn" name="checkout" value="Check Out"></a>
      </div>
    </div>
  </form>
</div>

<?php include('partials/footer.php'); ?>

<!-- <script>
    // Add event listeners to all checkboxes with class 'select-item'
    document.querySelectorAll('.select-item').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
      var total = 0;
      document.querySelectorAll('.select-item:checked').forEach(function(checkedBox) {
        // Get the corresponding total price element
        var itemId = checkedBox.value;
        var itemTotalPrice = document.querySelector('.item-totalprice[id^="' + itemId + '"]');
        if (itemTotalPrice) {
          total += parseFloat(itemTotalPrice.value);
        }
      });
      document.getElementById('totalprice').innerText = "₱" + total.toFixed(2);
    });
  });
</script> -->
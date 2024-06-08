<?php 
  session_start();
  include_once('config/functions.php');
  include_once('config/menu-cms.php'); 

  
  $conn = get_connection();
  $user_data = check_login($conn);
  $user_type = check_usertype($conn);
  
  // Clear checkout content if the user navigates back from the checkout page
  if (isset($_SESSION['checkout_in_progress']) && $_SESSION['checkout_in_progress'] === true) {
      $clear_checkout_query = "DELETE FROM checkoutcontent";
      if (mysqli_query($conn, $clear_checkout_query)) {
          unset($_SESSION['checkout_in_progress']);
      } else {
          echo "Error: " . $clear_checkout_query . "<br>" . mysqli_error($conn);
      }
  }

  // Fetch all categories and items
  $categories = get_all_categories($conn);
  $items = get_all_items($conn);

  if(!($user_type == 'admin' || $user_type == 'staff')){
    echo '<div id="preloader"></div>';
  }
  include_once('partials/header.php'); 
?>

<title>Menu</title>
<link href="css/menu.css" rel="stylesheet">
<script src="javascript/menu.js"></script>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
  <div id="notification">
    Item added to cart successfully!
  </div>

  <!-- Start of Category Add Modal -->
  <div class="bg-modal-add">
    <div class="modal-content-add">
      <div class="close"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
      <p class="modal-title">Category</p>
      <textarea class="edit-content" name="content_category"></textarea>
      <p class="modal-title">Name</p>
      <textarea class="edit-content" name="content_title"></textarea>
      <p class="modal-caption">Subname</p>
      <textarea class="edit-content" name="content_caption"></textarea>
      <div class="input-file">
        <input type="file" id="image" class="inputfile" name="content_image">
      </div>
      <input class="saveBtn" type="submit" name="add" value="Add">
    </div>
  </div>
  <!-- End of Modal -->

  <!-- Start of Item Add Modal -->
  <div class="bg-modal-add-item" style="display: none;">
    <div class="modal-content-add">
      <div class="close"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
      <p class="modal-title">Item Category</p>
      <textarea class="edit-content" name="item_category"></textarea>
      <p class="modal-title">Item Name</p>
      <textarea class="edit-content" name="item_name"></textarea>
      <p class="modal-caption">Item Subname</p>
      <textarea class="edit-content" name="item_subname"></textarea>
      <p class="modal-price1">Price Option 1</p>
      <textarea class="edit-content" name="item_priceoption1"></textarea>
      <p class="modal-price2">Price Option 2</p>
      <textarea class="edit-content" name="item_priceoption2"></textarea>
      <div class="input-file">
        <!-- <label for="image" class="custom-file-upload">Upload Image</label> -->
        <input type="file" id="image" class="inputfile3" name="item_image">
      </div>
      <input class="saveBtn" type="submit" name="add-item" value="Add-item">
    </div>
  </div>
  <!-- End of Modal -->

  <!-- Start of Edit Modal -->
  <div class="bg-modal-edit" style="display: none;">
    <div class="modal-edit-content">
      <div class="edit-close"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
      <input id="edit_id" type="hidden" name="edit_id">
      <p class="modal-title">Category</p>
      <textarea id="edit_category" class="edit-content" name="edit_category"></textarea>
      <p class="modal-title">Name</p>
      <textarea id="edit_name" class="edit-content" name="edit_name"></textarea>
      <p class="modal-caption">Subname</p>
      <textarea id="edit_subname" class="edit-content" name="edit_subname"></textarea>
      
      <p style="color: black; margin:1em 2em 0.5em 2em; font-family: league spartan; font-size: 18px; font-weight:bold;">Uploaded Image</p>
      <label id="edit_image" class="edit_image"></label>
      <div class="input-file">
        <input type="file" id="image" class="inputfile2" name="edit_image">
      </div>
      
      <input class="saveBtn" type="submit" name="edit" value="Edit">
    </div>
  </div>
  <!-- End of Modal -->

  <!-- Start of Edit Item Modal -->
<div class="bg-modal-edit-item" style="display: none;">
    <div class="modal-edit-content">
        <div class="edit-close"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
        <input id="edit_item_id" type="hidden" name="item_id">
        <p class="modal-title">Item Category</p>
        <textarea id="edit_item_category" class="edit-content" name="edit_item_category"></textarea>
        <p class="modal-title">Item Name</p>
        <textarea id="edit_item_name" class="edit-content" name="edit_item_name"></textarea>
        <p class="modal-caption">Item Subname</p>
        <textarea id="edit_item_subname" class="edit-content" name="edit_item_subname"></textarea>
        <p class="modal-price1">Price Option 1</p>
        <textarea id="edit_item_priceoption1" class="edit-content" name="edit_item_priceoption1"></textarea>
        <p class="modal-price2">Price Option 2</p>
        <textarea id="edit_item_priceoption2" class="edit-content" name="edit_item_priceoption2"></textarea>
        
        <p style="color: black; margin:1em 2em 0.5em 2em; font-family: league spartan; font-size: 18px; font-weight:bold;">Uploaded Image</p>
        
        <img id="edit_item_image" class="edit-item-image" src="">
        <label class="item_image"></label>
        <div class="input-file">
          <input type="file" id="edit_item_image" class="inputfile5" name="edit_item_image">
        </div>
        
        <input class="saveBtn" type="submit" name="edit-item" value="Edit">
    </div>
</div>
<!-- End of Modal -->

  <!-- Sidebar -->
  <div class="sidebarAndContent">
    <div class="sidebar" id="sidebar">
      <ul>
        <li class="header1"><a href="#menu" onclick="showCategory('menu')">Menu</a></li><br><br>
        <li class="header2">Drinks</li>
        <?php
        foreach($categories as $category) {
          if ($category['product_category'] == 'Drinks') {
            echo '<li class="choice"><a href="#'.strtolower(str_replace(' ', '', $category['product_name'])).'" onclick="showCategory(\''.strtolower(str_replace(' ', '', $category['product_name'])).'\')">'.$category['product_name'].'</a></li>';
          }
        }
        ?>
        <br><br>
        <li class="header2">Foods</li>
        <?php 
        foreach($categories as $category) {
          if ($category['product_category'] == 'Foods') {
            echo '<li class="choice"><a href="#'.strtolower(str_replace(' ', '', $category['product_name'])).'" onclick="showCategory(\''.strtolower(str_replace(' ', '', $category['product_name'])).'\')">'.$category['product_name'].'</a></li>';
          }        
        }
        ?>
      </ul>
    </div>

    <!-- Disabling click events -->
    <div class="overlay" id="overlay"></div>

    <div class="contents">
      <div id="menu" class="category">
        <!-- Display drinks options -->
        <div class="txtDrinks">
          <h2>Drinks</h2>
          <?php if($user_type == 'admin') echo '<div class="cms-add"><button class="add-cms" name="add-cms" value="drinks"><i class="fa-solid fa-plus"></i> Add category</button></div>'; ?>
        </div>
        <hr>
        <div class="drinksOptions" id="drinksNav">
          <?php 
            foreach($categories as $category) {
              if ($category['product_category'] == 'Drinks') {
                echo '
                <div class="options" id="'.$category['product_id'].'" name="'.$category['product_name'].'">
                  <div class="option">
                    <a href="#'.strtolower(str_replace(' ', '', $category['product_name'])).'" onclick="showCategory(\''.strtolower(str_replace(' ', '', $category['product_name'])).'\')"><img src="'.$category['product_image'].'"></a>
                    <a href="#'.strtolower(str_replace(' ', '', $category['product_name'])).'" onclick="showCategory(\''.strtolower(str_replace(' ', '', $category['product_name'])).'\')"><p>'.$category['product_name']."<br>".$category['product_subname'].'</p></a>';
                if($user_type == 'admin') echo '<div class="cms-edit-delete">
                                                  <button class="delete-cms" name="edit-btn" data-content-id="'.$category['product_id'].'"><i class="fa-regular fa-trash-can"></i>
                                                  </button> <button class="edit-cms" onclick="openEditModal(\''.$category['product_id'].'\')"><i class="fa-regular fa-pen-to-square"></i></button></button>
                                                 </div>';     
                echo '</div></div>';          
              }
            }
          ?>
        </div>
        <!-- Display foods options -->
        <div class="txtFoods">
          <h2>Foods</h2>
          <?php if($user_type == 'admin') echo '<div class="cms-add"><button class="add-cms" name="add-cms" value="drinks"><i class="fa-solid fa-plus"></i> Add category</button></div>'; ?>
        </div>
        <hr>
        <div class="foodsOptions" id="foodsNav">
          <?php
            foreach($categories as $category) {
              if ($category['product_category'] == 'Foods') {
                echo '
                <div class="options" id="'.$category['product_id'].'" name="'.$category['product_name'].'">
                  <div class="option">
                    <a href="#'.strtolower(str_replace(' ', '', $category['product_name'])).'" onclick="showCategory(\''.strtolower(str_replace(' ', '', $category['product_name'])).'\')"><img src="'.$category['product_image'].'"></a>
                    <a href="#'.strtolower(str_replace(' ', '', $category['product_name'])).'" onclick="showCategory(\''.strtolower(str_replace(' ', '', $category['product_name'])).'\')"><p>'.$category['product_name']."<br>".$category['product_subname'].'</p></a>';
                if($user_type == 'admin') echo '<div class="cms-edit-delete">
                                                  <button class="delete-cms" name="edit-btn" data-content-id="'.$category['product_id'].'"><i class="fa-regular fa-trash-can"></i></button> 
                                                  <button class="edit-cms" onclick="openEditModal(\''.$category['product_id'].'\')"><i class="fa-regular fa-pen-to-square"></i></button></button>
                                                </div>';     
                echo '</div></div>';
              }
            }
          ?>
        </div>
      </div>

      <!-- Other categories section -->
      <?php    
        // Group items by category
        $grouped_items = [];
        foreach ($items as $item) {
            $category_key = strtolower(str_replace(' ', '', $item['item_category']));
            $grouped_items[$category_key][] = $item;
        }

        // Create sections for each Category
        foreach($grouped_items as $category => $items) {
          echo '
            <div id="'.$category.'" class="category">
            <div id="'.$category.'-container">
              <div class="txt'.ucfirst($category).'" id="'.$category.'-text">
                <div class="column">
                  <h2>'.ucwords($category).'</h2>';
                  if($category == 'espresso' || $category == 'brew') echo '<p>Iced/Hot</p>';
                echo '</div>';
                if($user_type == 'admin') echo '<div class="column cms-add-item"><button class="add-cms" name="add-cms" value="drinks"><i class="fa-solid fa-plus"></i> Add item</button></div>';
              echo' 
              </div>
              <hr>
              <div class="menuContainer" id="'.$category.'MenuContainer">';
              // All items depends on Category
              foreach($items as $item) {
                echo '
                  <div class="menu-options" id="menu-'.$item['item_id'].'">
                    <div class="menu-option">';
                if($user_type == 'admin') echo '<div class="cms-edit-delete">
                                                  <button class="delete-item" name="edit-btn" data-content-id="'.$item['item_id'].'"><i class="fa-regular fa-trash-can"></i></button> 
                                                  <button class="edit-item-cms" onclick="openEditItemModal(\''.$item['item_id'].'\', \''.$item['item_category'].'\', \''.$item['item_name'].'\', \''.$item['item_subname'].'\', \''.$item['item_image'].'\', \''.$item['item_priceoption1'].'\', \''.$item['item_priceoption2'].'\')"><i class="fa-regular fa-pen-to-square"></i></button>
                                                </div>';    
                echo '
                      <img src="'.$item['item_image'].'" onclick="openPopup(\''.$item["item_name"].$item['item_id'].'\')">
                      <p onclick="openPopup(\''.$item["item_name"].$item['item_id'].'\')">'.$item['item_name'].'</p>
                    </div>
                  </div>';
              }
              echo '
                </div>
                  </div>'; 
      ?> 
      </form>
      <?php   // Popup for items
      if(isset($_SESSION['username']) && $user_type !== 'admin' && $user_type !== 'staff') {
        foreach($items as $item) {
          echo'
            <form method="POST" enctype="multipart/form-data">
              <div class="popup" id="popup-'.$item["item_name"].$item['item_id'].'">
                <input type="hidden" name="itemid" value="'.$item['item_name'].'-'.$item['item_id'].'-">
                <input type="hidden" name="itemcategory" value="'.$item['item_category'].'">
                <div class="popupImage">
                  <input type="hidden" name="itemimage" value="'.$item['item_image'].'">
                  <img src="'.$item['item_image'].'">
                </div>
                <div class="popupContent">
                  <div class="btnClose">
                    <button onclick="closePopup(\''.$item["item_name"].$item['item_id'].'\')"><img src="icons/x.png"></button>
                  </div>
                  <div class="productName">
                    <input type="hidden" name="itemcategory" value="'.$item['item_category'].'">
                    <input type="hidden" name="itemname" value="'.$item['item_name'].'">
                    <h1>'.$item['item_name'].'</h1>
                  </div>
                  <div class="description">
                    <p>Enjoy our creamy '.$item['item_name'].', made with premium espresso, sweetened condensed milk, and whole milk. Perfectly balanced for a smooth, sweet coffee experience.</p>
                  </div>
                  <div class="price">
                    <div class="txt-price"><p>Price:</p></div>
                    <div class="price-list">
                      <input type="hidden" name="itemcustomization" value=" ">
                      <p>'; 
                      // Drinks: 12oz/16oz customization | Foods: Solo/Savor customization 
                      if($item['item_category'] == 'All Day Breakfast' || $item['item_category'] == 'Silog' || $item['item_category'] == 'Pasta' || $item['item_category'] == 'Bargain Bites' ||
                        $item['item_category'] == 'Sides And Nibbles' || $item['item_category'] == 'Carbs And Caffeine') {
                        echo '
                          <input type="radio" name="itemprice" value="'.$item['item_priceoption1'].'" onclick="updateCustomization(this)" > Solo: <span>₱'.$item['item_priceoption1'].'</span> &nbsp | &nbsp 
                          <input type="radio" name="itemprice" value="'.$item['item_priceoption2'].'" onclick="updateCustomization(this)" > Savor: <span>₱'.$item['item_priceoption2'].'</span>';
                      } else {
                        echo '
                          <input type="radio" name="itemprice" value="'.$item['item_priceoption1'].'" onclick="updateCustomization(this)" > 12oz: <span>₱'.$item['item_priceoption1'].'</span> &nbsp | &nbsp 
                          <input type="radio" name="itemprice" value="'.$item['item_priceoption2'].'" onclick="updateCustomization(this)" > 16oz: <span>₱'.$item['item_priceoption2'].'</span>';
                      }   
                    echo '
                      </p>
                    </div>
                  </div>
                  <div class="quantity">
                    <div><p>Quantity:</p></div>
                    <div class="addMinus">
                      <button class="btnMinus" onclick="updateQuantity(-1, \'popup-'.$item["item_name"].$item['item_id'].'\')">-</button>
                      <input class="quantity-input" type="text" name="itemquantity" value="'.$item['item_quantity'].'" readonly>
                      <button class="btnAdd" onclick="updateQuantity(1, \'popup-'.$item["item_name"].$item['item_id'].'\')">+</button>
                    </div>
                  </div>
                  <div class="total">
                    <input type="hidden" class="total-price" name="itemtotalprice" value="0">
                    <p class="totalPrice">Total: <span></span></p>
                  </div>'; 
                  if(!($user_type == 'admin')) {
                    echo '
                    <div class="add-buy">
                      <input type="submit" class="addCart" onclick="closePopup(\''.$item["item_name"].$item['item_id'].'\')" name="add-buy" value="Add to Cart">
                      <input type="submit" class="buyNow" name="add-buy" value="Buy Now">
                    </div>'; 
                  }
          echo' </div>
              </div>
            </form>'; 
        }
      }
              echo '
                </div>';
        }
      ?>
    </div>
  </div>
<?php
  include('partials/footer.php');
?>

<script>
  var loader =document.getElementById('preloader');
  window.addEventListener("load", function(){
    setTimeout(function(){
      loader.style.display = "none";
    }, 1000)
  })

  function openEditModal(categoryId) {
    console.log("Edit button clicked for category:", categoryId);
    const category = <?php echo json_encode($categories); ?>.find(cat => cat.product_id === categoryId);
    if (category) {
        console.log("Category found:", category);
        document.getElementById('edit_category').value = category.product_category;
        document.getElementById('edit_name').value = category.product_name;
        document.getElementById('edit_subname').value = category.product_subname;
        document.getElementById('edit_id').value = category.product_id;

        const editImage = document.getElementById('edit_image');
        editImage.innerHTML = ''; 
        const img = document.createElement('img');
        img.src = category.product_image;
        img.style.maxWidth = '20%';
        editImage.appendChild(img);
    } else {
        console.log("Category not found for ID:", categoryId);
    }
  } 

  function openEditItemModal(itemId, itemCategory, itemName, itemSubName, itemImage, itemPriceoption1, itemPriceoption2) {
    console.log("Edit button clicked for item:", itemId);
    document.getElementById('edit_item_id').value = itemId;
    document.getElementById('edit_item_name').value = itemName;
    document.getElementById('edit_item_category').value = itemCategory;
    document.getElementById('edit_item_subname').value = itemSubName;
    document.getElementById('edit_item_priceoption1').value = itemPriceoption1;
    document.getElementById('edit_item_priceoption2').value = itemPriceoption2;

    // Set the src attribute of the edit_item_image img tag
    var imgElement = document.getElementById('edit_item_image');
    imgElement.src = itemImage;
}

  document.querySelectorAll('.cms-add').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        document.querySelector('.bg-modal-add').style.display = 'flex';
        handleAddButtonClick();
    });
  });
  document.querySelectorAll('.cms-add-item').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        document.querySelector('.bg-modal-add-item').style.display = 'flex';
        handleAddButtonClick();
    });
  });
  document.querySelectorAll('.edit-cms').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        document.querySelector('.bg-modal-edit').style.display = 'flex';
        handleAddButtonClick();
    });
  });
  document.querySelectorAll('.edit-item-cms').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        document.querySelector('.bg-modal-edit-item').style.display = 'flex';
        handleAddButtonClick();
    });
  });

  document.querySelectorAll('.close').forEach(function(element) {
    element.addEventListener('click', function() {
      document.querySelector('.bg-modal-add').style.display = 'none';
      document.querySelector('.bg-modal-add-item').style.display = 'none';
    });
  });
  document.querySelectorAll('.edit-close').forEach(function(element) {
    element.addEventListener('click', function() {
      document.querySelector('.bg-modal-edit').style.display = 'none';
      document.querySelector('.bg-modal-edit-item').style.display = 'none';
    });
  });
  
  document.querySelectorAll('.delete-cms').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        var contentId = button.getAttribute('data-content-id');
        if (confirm('Are you sure you want to delete this category?')) {
            var form = document.createElement('form');
            form.method = 'post';
            form.action = 'menu.php';
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_content_id';
            input.value = contentId;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    });
  });

  document.querySelectorAll('.delete-item').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        var contentId = button.getAttribute('data-content-id');
        if (confirm('Are you sure you want to delete this item?')) {
            var form = document.createElement('form');
            form.method = 'post';
            form.action = 'menu.php';
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_item_id';
            input.value = contentId;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    });
  });

  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.addCart').forEach(function(button) {
      button.addEventListener('click', function(event) {
        event.preventDefault();
        var form = this.closest('form');
        if (!isRadioButtonSelected(form)) {
          alert('Please select a price before adding to cart.');
          return;
        }
        var formData = new FormData(form);

        fetch('shopping-cart.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(data => {
          showNotification('Item added to cart successfully!');
          var itemId = form.querySelector('input[name="itemid"]').value;
          window.location.reload();
          closePopup(itemId);
        })
        .catch(error => {
          console.error('Error:', error);
        });
      });
    });

    document.querySelectorAll('.buyNow').forEach(function(button) {
      button.addEventListener('click', function(event) {
        var form = this.closest('form');
        if (!isRadioButtonSelected(form)) {
          alert('Please select a price before proceeding to buy.');
          event.preventDefault();
          return;
        }
        form.action = 'shopping-cart.php';
        form.submit();
      });
    });
  });

  function isRadioButtonSelected(form) {
    var radios = form.querySelectorAll('input[type="radio"][name="itemprice"]');
    for (var i = 0; i < radios.length; i++) {
      if (radios[i].checked) {
        return true;
      }
    }
    return false;
  }

  // Notify items are added to cart
  function showNotification(message) {
    var notification = document.getElementById('notification');
    notification.textContent = message;
    notification.style.display = 'block';
    setTimeout(function() {
      notification.style.display = 'none';
      
    }, 2000);
  }
  // const dialog = document.getElementById(`popup-${itemId}`);
  // const wrapper = document.querySelector(".wrapper");
  // const showPopup = (show) => show ? dialog.showModal() : dialog.close()
  // dialog.addEventListener('click', (e) => !wrapper.contains(e.target) && dialog.close())
</script>
<?php
  include_once('config/functions.php');
  include_once('config/connect.php');
  $conn = get_connection();

  function get_all_categories($conn) {
    $query = "SELECT * FROM menucategory";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $categories;
    } else {
        return [];
    }
  }

  function get_all_items($conn) {
      $query = "SELECT * FROM menuitems";
      $result = mysqli_query($conn, $query);
      if ($result) {
          $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
          mysqli_free_result($result);
          return $items;
      } else {
          return [];
      }
  }

    // Handle content deletion
    if (isset($_POST['delete_content_id'])) {
        $delete_content_id = mysqli_real_escape_string($conn, $_POST['delete_content_id']);
        $query = "DELETE FROM menucategory WHERE product_id = '$delete_content_id'";

        if (mysqli_query($conn, $query)) {
            echo '
            <script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location.reload();
            </script>
            ';
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else if(isset($_POST['delete_item_id'])) {
        $delete_item_id = mysqli_real_escape_string($conn, $_POST['delete_item_id']);
        $query = "DELETE FROM menuitems WHERE item_id = '$delete_item_id'";

        if (mysqli_query($conn, $query)) {
            echo '
            <script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location.reload();
            </script>
            ';
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }

  // Handle content addition/editing
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['add'])) {
      $content_category = mysqli_real_escape_string($conn, $_POST['content_category']);
      $content_name = mysqli_real_escape_string($conn, $_POST['content_title']);
      $content_subname = mysqli_real_escape_string($conn, $_POST['content_caption']);
      $content_image_name = 'content_image';
      $file_name = '';
      $folder = '';

        // Check if a new image is uploaded
        if (!empty($_FILES[$content_image_name]['name'])) {
            $file_name = $_FILES[$content_image_name]['name'];
            $temp_name = $_FILES[$content_image_name]['tmp_name'];
            $folder = './BLK/' . $file_name;
            move_uploaded_file($temp_name, $folder);
        }

      // Check if the category already exists
      $check_query = "SELECT * FROM menucategory WHERE LOWER(product_name) = LOWER('$content_name')";
      $check_result = mysqli_query($conn, $check_query);
      if (mysqli_num_rows($check_result) > 0) {
          echo "Error: Category already exists.";
          // $query = "UPDATE menucategory SET content_title = '$content_title', content_caption = '$content_caption', content_image = '$folder' WHERE content_id = '$content_id'";
      } else {
          // Insert new content
          $query = "INSERT INTO menucategory (product_category, product_name, product_subname, product_image) VALUES ('$content_category', '$content_name', '$content_subname', '$folder')";
          if (mysqli_query($conn, $query)) {
              echo '
              <script>
                  if (window.history.replaceState) {
                      window.history.replaceState(null, null, window.location.href);
                  }
                  window.location.reload();
              </script>
              ';
          } else {
              echo "Error: " . $query . "<br>" . mysqli_error($conn);
          }
      }
    } else if(isset($_POST["edit"])) {
        $edit_id = mysqli_real_escape_string($conn, $_POST['edit_id']);
        $edit_category = mysqli_real_escape_string($conn, $_POST['edit_category']);
        $edit_name = mysqli_real_escape_string($conn, $_POST['edit_name']);
        $edit_subname = mysqli_real_escape_string($conn, $_POST['edit_subname']);
        $edit_image = 'edit_image';
        $file_name = '';
        $folder = ''; 

        // Check if a new image is uploaded
        if (!empty($_FILES[$edit_image]['name'])) {
            $file_name = $_FILES[$edit_image]['name'];
            $temp_name = $_FILES[$edit_image]['tmp_name'];
            $folder = './BLK/' . $file_name;
            move_uploaded_file($temp_name, $folder);
        }

        // Check if the category exists
        $check_query = "SELECT * FROM menucategory WHERE product_id = '$edit_id'";
        $check_result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            // Update the category
            if($folder) {
                $query = "UPDATE menucategory SET product_category = '$edit_category', product_image = '$folder', product_name = '$edit_name', product_subname = '$edit_subname' WHERE product_id = '$edit_id'";
            } else {
                $query = "UPDATE menucategory SET product_category = '$edit_category', product_name = '$edit_name', product_subname = '$edit_subname' WHERE product_id = '$edit_id'";
            }
    
            if (mysqli_query($conn, $query)) {
                echo '
                <script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location.reload();
                </script>
                ';
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: Category not found.";
        }
    }
    if(isset($_POST['add-item'])) {
        $item_category = mysqli_real_escape_string($conn, $_POST['item_category']);
        $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
        $item_subname = mysqli_real_escape_string($conn, $_POST['item_subname']);
        $item_priceoption1 = mysqli_real_escape_string($conn, $_POST['item_priceoption1']);
        $item_priceoption2 = mysqli_real_escape_string($conn, $_POST['item_priceoption2']);
        $item_image_name = 'item_image';
        $file_name = '';
        $folder = '';

        // Check if a new image is uploaded
        if (!empty($_FILES[$item_image_name]['name'])) {
            $file_name = $_FILES[$item_image_name]['name'];
            $temp_name = $_FILES[$item_image_name]['tmp_name'];
            $folder = './BLK/' . $file_name;
            move_uploaded_file($temp_name, $folder);
        }

        // Check if the category already exists
        $query = "SELECT * FROM menuitems WHERE LOWER(item_name) = LOWER('$item_name')";
        $check_result = mysqli_query($conn, $query);
        if (mysqli_num_rows($check_result) > 0) {
            echo "Error: Item already exists.";
            // $query = "UPDATE menucategory SET content_title = '$content_title', content_caption = '$content_caption', content_image = '$folder' WHERE content_id = '$content_id'";
        } else {
            // Insert new content
            $query = "INSERT INTO menuitems (item_category, item_name, item_subname, item_image, item_priceoption1, item_priceoption2) VALUES ('$item_category', '$item_name', '$item_subname', '$folder', '$item_priceoption1', '$item_priceoption2')";
            if (mysqli_query($conn, $query)) {
                echo '
                <script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location.reload();
                </script>
                ';
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    } else if(isset($_POST["edit-item"])) {
        $edit_id = mysqli_real_escape_string($conn, $_POST['item_id']);
        $edit_category = mysqli_real_escape_string($conn, $_POST['edit_item_category']);
        $edit_name = mysqli_real_escape_string($conn, $_POST['edit_item_name']);
        $edit_subname = mysqli_real_escape_string($conn, $_POST['edit_item_subname']);
        $item_priceoption1 = mysqli_real_escape_string($conn, $_POST['edit_item_priceoption1']);
        $item_priceoption2 = mysqli_real_escape_string($conn, $_POST['edit_item_priceoption2']);
        $edit_image = 'edit_item_image';
        $file_name = '';
        $folder = ''; 

        // Check if a new image is uploaded
        if (!empty($_FILES[$edit_image]['name'])) {
            $file_name = $_FILES[$edit_image]['name'];
            $temp_name = $_FILES[$edit_image]['tmp_name'];
            $folder = './BLK/' . $file_name;
            move_uploaded_file($temp_name, $folder);
        }

        // Check if the category exists
        $check_query = "SELECT * FROM menuitems WHERE item_id = '$edit_id'";
        $check_result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            // Update the category
            if($folder) {
                $query = "UPDATE menuitems SET item_category = '$edit_category', item_image = '$folder', item_name = '$edit_name', item_subname = '$edit_subname', item_priceoption1 = '$item_priceoption1', item_priceoption2 = '$item_priceoption2' WHERE item_id = '$edit_id'";
            } else {
                $query = "UPDATE menuitems SET item_category = '$edit_category', item_name = '$edit_name', item_subname = '$edit_subname',  item_priceoption1 = '$item_priceoption1', item_priceoption2 = '$item_priceoption2' WHERE item_id = '$edit_id'";
            }
    
            if (mysqli_query($conn, $query)) {
                echo '
                <script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location.reload();
                </script>
                ';
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: Item not found.";
        }
    }
}

?>
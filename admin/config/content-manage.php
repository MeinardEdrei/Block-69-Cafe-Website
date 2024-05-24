
<?php 
include_once './config/connect.php';
$conn = get_connection();

// Handle content deletion
if (isset($_POST['delete_content_id'])) {
    $delete_content_id = mysqli_real_escape_string($conn, $_POST['delete_content_id']);
    $query = "DELETE FROM homecontent WHERE content_id = '$delete_content_id'";
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
if (isset($_POST['submit'])) {
    // Fetch Data
    $content_id = mysqli_real_escape_string($conn, $_POST['content_id']);
    $content_title = mysqli_real_escape_string($conn, $_POST['content_title'.$content_id]);
    $content_caption = mysqli_real_escape_string($conn, $_POST['content_caption'.$content_id]);
    $content_image_name = 'content_image'.$content_id;

    $file_name = '';
    $folder = '';

    // Check if a new image is uploaded
    if (!empty($_FILES[$content_image_name]['name'])) {
        $file_name = $_FILES[$content_image_name]['name'];
        $temp_name = $_FILES[$content_image_name]['tmp_name'];
        $folder = './Images/' . $file_name;
        move_uploaded_file($temp_name, $folder);
    }

    // Check Content Existence
    $check_query = "SELECT * FROM homecontent WHERE content_id = '$content_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Update existing content
        if ($file_name) {
            // Update with new image
            $query = "UPDATE homecontent SET content_title = '$content_title', content_caption = '$content_caption', content_image = '$folder' WHERE content_id = '$content_id'";
        } else {
            // Update without new image
            $query = "UPDATE homecontent SET content_title = '$content_title', content_caption = '$content_caption' WHERE content_id = '$content_id'";
        }
    } else {
        // Insert new content
        if ($file_name) {
            $query = "INSERT INTO homecontent (content_id, content_title, content_caption, content_image) VALUES ('$content_id', '$content_title', '$content_caption', '$folder')";
        } else {
            $query = "INSERT INTO homecontent (content_id, content_title, content_caption) VALUES ('$content_id', '$content_title', '$content_caption')";
        }
    }

    if (mysqli_query($conn, $query)) {
        echo '
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
        ';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// function get_content_by_id($conn, $content_id){
//   $query = "SELECT * FROM homecontent WHERE content_id = '$content_id' ";

//   $result = mysqli_query($conn, $query);
//   $content_data = mysqli_fetch_assoc($result);
//   return $content_data;
// }

function get_content($conn){
  $query = "SELECT * FROM homecontent";

  $result = mysqli_query($conn, $query);
  $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $all_content;
}

function get_gallerysection($conn){
    $query = "SELECT * FROM gallerysection";
  
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
  }

  function get_galleryimage($conn){
    $query = "SELECT * FROM galleryimage";
  
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
  }
  
  function get_galleryvideo($conn){
    $query = "SELECT * FROM galleryvideo";
  
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
  }

?>

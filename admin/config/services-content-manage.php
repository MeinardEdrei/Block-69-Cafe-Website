<?php 
include_once './config/connect.php';
$conn = get_connection();

function get_services_content($conn) {
    $query = "SELECT * FROM servicescontent";
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
}

// Handle content deletion
if (isset($_POST['delete_content_id'])) {
    $delete_content_id = mysqli_real_escape_string($conn, $_POST['delete_content_id']);

     // Fetch the content to get the image paths
     $query = "SELECT content_images FROM servicescontent WHERE content_id = '$delete_content_id'";
     $result = mysqli_query($conn, $query);
     $row = mysqli_fetch_assoc($result);
     $imagePaths = explode(",", $row['content_images']);
     
     // Delete each image file
     foreach ($imagePaths as $imagePath) {
         if (file_exists($imagePath)) {
             unlink($imagePath);
         }
     }

    $query = "DELETE FROM servicescontent WHERE content_id = '$delete_content_id'";
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
    $event_name = mysqli_real_escape_string($conn, $_POST['event_name'.$content_id]);
    $content_title = mysqli_real_escape_string($conn, $_POST['content_title'.$content_id]);
    $content_caption = mysqli_real_escape_string($conn, $_POST['content_caption'.$content_id]);
    $content_images_name = 'content_images';

    // print_r($_FILES['content_images']);
    $finalimage = array();

    $extension = array('jpeg', 'jpg', 'png', 'gif');
    if (!empty($_FILES[$content_images_name]['name'])) {
        foreach ($_FILES[$content_images_name]['tmp_name'] as $key => $value) {
            $file_name = $_FILES[$content_images_name]['name'][$key];
            $temp_name = $_FILES[$content_images_name]['tmp_name'][$key];
            $folder = './Events Images/' . $file_name;
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);

            if (in_array($ext, $extension)){
                if(!file_exists('./Events Images/'.$file_name)){
                    move_uploaded_file($temp_name, $folder);
                    $finalimage[]=$folder;
                }else{
                    $file_name = str_replace('.', '-', basename($file_name, $ext));
                    $newfilename= $file_name.time().".".$ext;
                    move_uploaded_file($temp_name, './Events Images/'.$newfilename);
                    $finalimage[] = './Events Images/'.$newfilename;
                }

            }else{
                // display error
            }
        }
    }
    // echo 'final image:';
    // print_r($finalimage);
    // Check Content Existence
    $check_query = "SELECT * FROM servicescontent WHERE content_id = '$content_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Update existing content
        if (!empty($finalimage)) {
            // Update with new image(s)
            $image_paths = implode(",", $finalimage);
            $query = "UPDATE servicescontent SET event_name = '$event_name', content_title = '$content_title', content_caption = '$content_caption', content_images = '$image_paths' WHERE content_id = '$content_id'";
            
            // Fetch the content to get the image paths
            $query = "SELECT content_images FROM servicescontent WHERE content_id = '$content_id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $imagePaths = explode(",", $row['content_images']);
            
            // Delete each image file
            foreach ($imagePaths as $imagePath) {
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

        } else {
            // Update without new image
            $query = "UPDATE servicescontent SET event_name = '$event_name', content_title = '$content_title', content_caption = '$content_caption' WHERE content_id = '$content_id'";
        }
    } else {
        // Insert new content
        if (!empty($finalimage)) {
            $image_paths = implode(",", $finalimage);
            $query = "INSERT INTO servicescontent (content_id, event_name, content_title, content_caption, content_images) VALUES ('$content_id', '$event_name', '$content_title', '$content_caption', '$image_paths')";
        } else {
            $query = "INSERT INTO servicescontent (content_id, event_name, content_title, content_caption) VALUES ('$event_name', '$content_id', '$content_title', '$content_caption')";
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

?>

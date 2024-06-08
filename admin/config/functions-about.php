<?php
include_once './config/connect.php';
$conn = get_connection();
$contentEdit = false;

if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $check_query = "SELECT * FROM aboutcontent WHERE id = '$id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
      
        $fields_to_update = array();

        if (isset($_POST['title_header' . $id])) {
            $fields_to_update[] = "title_header = '" . mysqli_real_escape_string($conn, $_POST['title_header' . $id]) . "'";
        }
        if (isset($_POST['title_caption' . $id])) {
            $fields_to_update[] = "title_caption = '" . mysqli_real_escape_string($conn, $_POST['title_caption' . $id]) . "'";
        }
        if (isset($_POST['content_caption' . $id])) {
            $fields_to_update[] = "content_caption = '" . mysqli_real_escape_string($conn, $_POST['content_caption' . $id]) . "'";
        }
        if (isset($_FILES['image_about' . $id]['name'])) {
            $file_name = $_FILES['image_about' . $id]['name'];
            $temp_name = $_FILES['image_about' . $id]['tmp_name'];
            $folder = './Images/' . $file_name;
            if (move_uploaded_file($temp_name, $folder)) {
                $fields_to_update[] = "image_about = '$folder'";
            }
        }

        if (isset($_POST['title_mission' . $id])) {
            $fields_to_update[] = "title_mission = '" . mysqli_real_escape_string($conn, $_POST['title_mission' . $id]) . "'";
        }
        if (isset($_POST['content_mission' . $id])) {
            $fields_to_update[] = "content_mission = '" . mysqli_real_escape_string($conn, $_POST['content_mission' . $id]) . "'";
        }
        if (isset($_POST['title_vision' . $id])) {
            $fields_to_update[] = "title_vision = '" . mysqli_real_escape_string($conn, $_POST['title_vision' . $id]) . "'";
        }
        if (isset($_POST['content_vision' . $id])) {
            $fields_to_update[] = "content_vision = '" . mysqli_real_escape_string($conn, $_POST['content_vision' . $id]) . "'";
        }
        if (isset($_FILES['image2_about' . $id]['name'])) {
            $file_name = $_FILES['image2_about' . $id]['name'];
            $temp_name = $_FILES['image2_about' . $id]['tmp_name'];
            $folder = './Images/' . $file_name;
            if (move_uploaded_file($temp_name, $folder)) {
                $fields_to_update[] = "image2_about = '$folder'";
            }
        }
        
        if (isset($_POST['title_competitive' . $id])) {
            $fields_to_update[] = "title_competitive = '" . mysqli_real_escape_string($conn, $_POST['title_competitive' . $id]) . "'";
        }
        if (isset($_POST['caption_competitive' . $id])) {
            $fields_to_update[] = "caption_competitive = '" . mysqli_real_escape_string($conn, $_POST['caption_competitive' . $id]) . "'";
        }
        if (isset($_POST['caption2nd_competitive' . $id])) {
            $fields_to_update[] = "caption2nd_competitive = '" . mysqli_real_escape_string($conn, $_POST['caption2nd_competitive' . $id]) . "'";
        }

        if (isset($_POST['title_landscape' . $id])) {
            $fields_to_update[] = "title_landscape = '" . mysqli_real_escape_string($conn, $_POST['title_landscape' . $id]) . "'";
        }
        if (isset($_POST['content_landscape' . $id])) {
            $fields_to_update[] = "content_landscape = '" . mysqli_real_escape_string($conn, $_POST['content_landscape' . $id]) . "'";
        }
        if (isset($_FILES['image3_about' . $id]['name'])) {
            $file_name = $_FILES['image3_about' . $id]['name'];
            $temp_name = $_FILES['image3_about' . $id]['tmp_name'];
            $folder = './Images/' . $file_name;
            if (move_uploaded_file($temp_name, $folder)) {
                $fields_to_update[] = "image3_about = '$folder'";
            }
        }
     
        $query = "UPDATE aboutcontent SET " . implode(', ', $fields_to_update) . " WHERE id = '$id'";

        if (mysqli_query($conn, $query)) {
            echo '<script>if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); }</script>';
            $contentEdit = true;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: Content with ID $id not found.";
    }
}


function get_content_by_id($conn, $id)
{
    $query = "SELECT * FROM aboutcontent WHERE id = '$id' ";
  
    $result = mysqli_query($conn, $query);
    $content_data = mysqli_fetch_assoc($result);
    return $content_data;
}

function get_content($conn)
{
    $query = "SELECT * FROM aboutcontent";
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
}

?>

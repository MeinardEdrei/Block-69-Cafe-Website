
<?php 
include_once './config/connect.php';
$conn = get_connection();
$newContentAdded = false;
$ContentDeleted = false;

// Handle content deletion
if (isset($_POST['delete_content_id'])) {
    $delete_content_id = mysqli_real_escape_string($conn, $_POST['delete_content_id']);
    $query = "DELETE FROM homecontent WHERE content_id = '$delete_content_id'";
    $ContentDeleted = true;
    if (mysqli_query($conn, $query)) {
        $ContentDeleted = true;
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
            $newContentAdded = true;
            $query = "INSERT INTO homecontent (content_id, content_title, content_caption, content_image) VALUES ('$content_id', '$content_title', '$content_caption', '$folder')";
        } else {
            $newContentAdded = true;
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






// FUNCTIONS NI AARON PLEASE DON'T TOUCH MY BIRDIE TY

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

  function get_packagesection($conn){
    $query = "SELECT * FROM packagesection";
  
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
  }

  function get_cafepackagecontent($conn){
    $query = "SELECT * FROM cafepackagescontents";
  
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
  }

  function get_cafepackagepaxandprice($conn){
    $query = "SELECT * FROM cafepackagespaxandprices";
  
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
  }

  function get_cafepackageshomecontent($conn){
    $query = "SELECT * FROM cafepackageshomecontent";
  
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
  }

  function get_cateringservicestable($conn){
    $query = "SELECT * FROM cateringservicestable";
  
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
  }

  function get_cateringservicescontent($conn){
    $query = "SELECT * FROM cateringservicescontent";
  
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
  }

  function get_packagecontactcontent($conn){
    $query = "SELECT * FROM packagecontactcontent";
  
    $result = mysqli_query($conn, $query);
    $all_content = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $all_content;
  }

  function update_image_when_submit($conn) {
    if(isset($_POST['img_ID']) && !empty($_FILES['file-img']['name'])) {
        $img_id = $_POST['img_ID'];
      
        $file_name = $_FILES['file-img']['name'];
        $temp_name = $_FILES['file-img']['tmp_name'];
        $img_url = './galleryImages/' . $file_name;
        move_uploaded_file($temp_name, $img_url);
      
        $conn->query("
          UPDATE galleryimage 
          SET img = '$img_url'
          WHERE img_ID = '$img_id'
        ");
        
        echo "<meta http-equiv='refresh' content='0'>";
    }
  }
  
    if(isset($_POST['img_ID1']) || isset($_POST['img_ID2']) || isset($_POST['img_ID3']) || isset($_POST['img_ID4'])) {
        for($i = 1; $i <= 4; $i++) {
            if(!empty($_FILES['file-img' . $i]['name'])) {
                $img_id = $_POST['img_ID' . $i];
                $file_name = $_FILES['file-img' . $i]['name'];
                $temp_name = $_FILES['file-img' . $i]['tmp_name'];
                $img_url = './galleryImages/' . $file_name;
                move_uploaded_file($temp_name, $img_url);
            
                $conn->query("
                  UPDATE galleryimage 
                  SET img = '$img_url'
                  WHERE img_ID = '$img_id'
                ");
            }
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }
    if(isset($_POST['img_ID5']) || isset($_POST['img_ID6']) || isset($_POST['img_ID7']) || isset($_POST['img_ID8'])) {
    for($i = 5; $i <= 8; $i++) {
        if(!empty($_FILES['file-img' . $i]['name'])) {
            $img_id = $_POST['img_ID' . $i];
            $file_name = $_FILES['file-img' . $i]['name'];
            $temp_name = $_FILES['file-img' . $i]['tmp_name'];
            $img_url = './galleryImages/' . $file_name;
            move_uploaded_file($temp_name, $img_url);
        
            $conn->query("
              UPDATE galleryimage 
              SET img = '$img_url'
              WHERE img_ID = '$img_id'
            ");
        }
    }
    echo "<meta http-equiv='refresh' content='0'>";
}

  function update_sectionContent_when_submit($conn) {
    if(isset($_POST['sectionID'])) {
        $section_id = $_POST['sectionID'];
      
        $title_name = $_POST['section1title'];
        $description_name = $_POST['section1description'];
      
        $conn->query("
          UPDATE gallerysection 
          SET title = '$title_name', description = '$description_name'
          WHERE sectionID = '$section_id'
        ");
        
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

function update_video_when_submit($conn) {
    if(isset($_POST['vid_ID']) && !empty($_FILES['file-vid']['name'])) {
        $vid_id = $_POST['vid_ID'];
      
        $file_name = $_FILES['file-vid']['name'];
        $temp_name = $_FILES['file-vid']['tmp_name'];
        $vid_url = './galleryImages/' . $file_name;
        move_uploaded_file($temp_name, $vid_url);
      
        $conn->query("
          UPDATE galleryvideo 
          SET video = '$vid_url'
          WHERE vidID = '$vid_id'
        ");
        
        echo "<meta http-equiv='refresh' content='0'>";
    }

    if(isset($_POST['vid_ID1']) || isset($_POST['vid_ID2']) || isset($_POST['vid_ID3']) || isset($_POST['vid_ID4']) || isset($_POST['vid_ID5']) ||  isset($_POST['vid_ID6'])) {
        for($i = 1; $i <= 6; $i++) {
            if(!empty($_FILES['file-vid' . $i]['name'])) {
                $vid_id = $_POST['vid_ID' . $i];
                $file_name = $_FILES['file-vid' . $i]['name'];
                $temp_name = $_FILES['file-vid' . $i]['tmp_name'];
                $vid_url = './galleryImages/' . $file_name;
                move_uploaded_file($temp_name, $vid_url);
            
                $conn->query("
                  UPDATE galleryvideo 
                  SET video = '$vid_url'
                  WHERE vidID = '$vid_id'
                ");
            }
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

function update_section_and_image_of_package($conn) {
    if (isset($_POST['sectionID'])) {
        $section_id = $_POST['sectionID'];
        
        // Update section content
        if (isset($_POST['section1title']) || isset($_POST['section1description'])) {
            $title_name = $conn->real_escape_string($_POST['section1title']);
            $description_name = $conn->real_escape_string($_POST['section1description']);
            
            $conn->query("
              UPDATE packagesection 
              SET packagetitle = '$title_name', packagedescription = '$description_name'
              WHERE packageid = '$section_id'
            ");
        }
        
        // Check if a new image is uploaded
        if (!empty($_FILES['file-img']['name'])) {
            $file_name = $_FILES['file-img']['name'];
            $temp_name = $_FILES['file-img']['tmp_name'];
            $img_url = './packagesImages/' . $file_name;
            if (move_uploaded_file($temp_name, $img_url)) {
                $conn->query("
                  UPDATE packagesection 
                  SET packageimage = '$img_url'
                  WHERE packageid = '$section_id'
                ");
            }
        }
        
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

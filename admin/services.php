
<?php 

session_start();
include('partials/header.php'); 
include_once './config/connect.php';
include_once './config/functions.php';
include_once './config/services-content-manage.php';

$conn = get_connection();
$user_data = check_login($conn);
$user_type = check_usertype($conn);

//fetching data
$content = get_services_content($conn);
$content_id = 0;

?>

<link rel="stylesheet" href="css/services.css">

  <div class="landing-page"> 
    <video autoplay loop muted plays-inline class="outsideblk-video" src="videos/outsideblk.mp4"></video>
    <div class="content">
        <h1>BLOCK 69 CAFÉ</h1>
        <p class="quote">Discover Coffee, Packages, and Services!</p>
    </div>
  </div>

  <div class="page-title-container">
    <div class="page-title">
    <h1>DISCOVER COFFEE, PACKAGES, AND SERVICES!</h1>
  </div>
  </div>

  <div class="exploreNav-container">
    <div class="explore-nav">
        <div class="container">
            <img src="Images/cafebooking.JPG" alt="">
            <div class="title">
            <h6>Cafe Booking Packages</h6>
            <p>Introducing our Cafe Booking Packages - your gateway to unforgettable moments! Our versatile packages fulfill your every need with premium amenities and ambiance. Let us transform your event dreams into reality. Book now and let the enchantment commence!</p>
                <a class="learn-more" href="cafe-booking-services.html">Learn More</a>
            </div>
        </div>
        <div class="container">
            <img src="Images/bar2.JPG" alt="">
            <div class="title">
            <h6>Coffee Bar Services</h6>
            <p>Sip, savor, and celebrate with our exquisite coffee bar and delightful souvenirs! 
                From lattes to non-coffee drinks, we've got your event covered. 
                Explore our packages at the button below and let the aroma of exceptional coffee elevate your experience. </p>
                <a class="learn-more" href="coffee-bar-services.html">Learn More</a>
            </div>
        </div>
    </div>
  </div>
    <form action="services.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="content_id">
    <?php

    if($user_type == 'admin'){
        echo '
        <div style="background-color: white; margin: 2em;">
        
            <button class="add-btn" name="edit-btn"><i class="fa-solid fa-plus"></i> Add Content</button>
        
        </div>
        ';
        echo '
        <!-- Start of Add Modal -->
        <div class="bg-modal-add">
        <div class="modal-content-add">
            <div class="close"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
            <p class="modal-title">EVENT NAME</p>
            <textarea class="edit-content" name="event_name"></textarea>
            <p class="modal-title">TITLE</p>
            <textarea class="edit-content" name="content_title"></textarea>
            <p class="modal-caption">CAPTION</p>
            <textarea class="edit-content" name="content_caption"></textarea>
            <div>
            <label for="image" id="file-upload-label" class="custom-file-upload">Upload 5 images</label>
            <input type="file" id="image" class="inputfile" name="content_images[]" multiple>
            </div>
            <input class="saveBtn" type="submit" name="submit">
        </div>
        </div>
        <!-- End of Modal -->';
    }

    foreach ($content as $row) {
    $modalClass = 'modal-'.$row['content_id'];
    $contentIdName= 'content_id'.$row['content_id'];
    $contentEventName = 'event_name'.$row['content_id'];
    $contentTitleName = 'content_title'.$row['content_id'];
    $contentCaptionName = 'content_caption'.$row['content_id'];
    $customFileUploadClass = 'custom-file-upload custom-file-upload'.$row['content_id'];
    $contentImageId = 'content_images[]'.$row['content_id'];

    echo '
    <!-- Start of Edit Modal -->
    <div class="bg-modal '.$modalClass.'">
      <div class="modal-content">
        <div class="close"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
            <p class="modal-title">EVENT NAME</p>
            <textarea class="edit-content" name="'.$contentEventName.'">'.$row['event_name'].'</textarea>
          <p class="modal-title">CONTENT TITLE</p>
          <textarea class="edit-content" name="'.$contentTitleName.'">'.$row['content_title'].'</textarea>
          <p class="modal-caption">CONTENT CAPTION</p>
          <textarea class="edit-content" name="'.$contentCaptionName.'">'.$row['content_caption'].'</textarea>

        <div>
        <p style="color: white; margin:1em 2em 0em 2em; font-family: league spartan; font-size: 20px; font-weight:bold;">UPLOADED IMAGE</p>

          <label for="image" class="custom-file-upload">Click to upload new 5 images</label>
          <input type="file" id="image" name="content_images[]" class="inputfile" multiple>

        </div>
        <input class="saveBtn" type="submit" name="submit">
      </div>
    </div>
    <!-- End of Modal -->';

    if($user_type == 'admin'){
        echo '
        
        <div><button class="edit-btn" name="edit-btn" data-content-id="'.$row['content_id'].'" data-content-event="'.$row['event_name'].'" data-content-title="'. $row['content_title'].'" data-content-caption="'. $row['content_caption'].'" data-content-image="'.$row['content_images'].'">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
        <button class="delete-btn" name="edit-btn" data-content-id="'.$row['content_id'].'">Delete Content <i class="fa-regular fa-trash-can"></i></button>

        ';
    }
        if ($row['content_id'] > 0) {
            $imagePaths = explode(",", $row['content_images']);
            echo '
                <div class="events" style="margin-top: 2em;">
                    <div class="container_color">
                        <div class="eventName">'.$row['event_name'].'</div>
                        <div class="container">
                            <div class="container_big_img">
                                <img class="pic1" src="'.$imagePaths[0].'" alt="">
                                    <div class="container_small_img">
                                        <img class="img_throw1" src="'.$imagePaths[1].'" alt="">
                                        <img class="img_throw1" src="'.$imagePaths[2].'" alt="">
                                        <img class="img_throw1" src="'.$imagePaths[3].'" alt="">
                                        <img class="img_throw1" src="'.$imagePaths[4].'" alt="">
                                    </div>
                            </div>
                            <div class="container_text">
                                <h4>'.$row['content_title'].'</h4>
                                <p>'.$row['content_caption'].'</p>
                            </div>
                        </div>
                    </div>
                ';
        }
    }
    ?>
    </form>

    <div class="announcement">
        <p>*Photos displayed above were taken with consent from the customers. We support the privacy and identity of our clients.</p>
      </div>

<?php include('partials/footer.php'); ?>

<script>
var modalClass = "modal-1";
var contentTitle = "";
var contentId = 1;
var contentCaption = "";
var contentImage ="";
var contentImageId = 'content_images'+contentId;

document.querySelectorAll('.edit-btn').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        //fetch data
        eventName = button.getAttribute('data-content-event');
        contentTitle = button.getAttribute('data-content-title');
        contentCaption = button.getAttribute('data-content-caption');
        contentImage = button.getAttribute('data-content-image');
        contentId = button.getAttribute('data-content-id');
        contentImageId = 'content_image'+contentId;
        
        handleEditButtonClick(contentId);
    });
});

document.querySelectorAll('.add-btn').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        document.querySelector('.bg-modal-add').style.display = 'flex';
        handleAddButtonClick();
    });
});

//Function to handle edit button clicks
function handleEditButtonClick(contentId) {
  modalClass = "modal-"+contentId;
  document.querySelector('input[name="content_id"]').value = contentId;
  document.querySelector('.bg-modal.'+modalClass).style.display = 'flex';
}

//Function to handle add button clicks
function handleAddButtonClick() {
  document.querySelector('.bg-modal-add.').style.display = 'flex';
}

document.querySelectorAll('.close').forEach(function(element) {
  element.addEventListener('click', function() {
    document.querySelector('.bg-modal').style.display = 'none';
    document.querySelector('.bg-modal-add').style.display = 'none';
  });
});

document.querySelectorAll('.delete-btn').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        var contentId = button.getAttribute('data-content-id');
        if (confirm('Are you sure you want to delete this content?')) {
            var form = document.createElement('form');
            form.method = 'post';
            form.action = 'services.php';
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

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.edit-content').forEach(function(textarea) {
    ClassicEditor
      .create(textarea)
      .catch(function(error) {
        console.error(error);
      });
  });
});

document.getElementById('content_images[]'+contentId).addEventListener('change', function() {
  var fileName = this.files[0].name;
  var label = document.querySelector('.custom-file-upload.custom-file-upload'+contentId);
  label.textContent = fileName;
});
document.getElementById('image').addEventListener('change', function() {
    var fileList = this.files;
    var fileName = Array.from(fileList).map(file => file.name).join(', ');
    var label = document.getElementById('file-upload-label');
    label.textContent = fileName;
});

if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>
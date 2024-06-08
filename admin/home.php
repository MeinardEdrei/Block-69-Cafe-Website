<?php 

  include_once './config/connect.php';
  include_once './config/functions.php';
  include_once './config/content-manage.php';

  session_start(); 
  $conn = get_connection();
  $user_data = check_login($conn);
  $user_type = check_usertype($conn);
  //GETTING content
  $content_id = 0;
  $contents = get_content($conn);

  if(!($user_type == 'admin' || $user_type == 'staff')){
    echo '<div id="preloader"></div>';
  }
?>

<title>BLOCK 69 Café</title>
<?php include('partials/header.php'); ?>
<link rel="stylesheet" href="css/home.css">
<link rel="icon" href="icons/newlogo-light.png">
<?php 
if ($newContentAdded) {
  echo '
        <div id="notifAddContent">
          Added Content Successfully
        </div>
  ';
}else if ($ContentDeleted){
  echo '
        <div id="notifDeletedContent">
          Deleted Content Successfully
        </div>
  ';
}
?>

<div id="deleteModal" class="deleteModal">
  <div class="modal-content">
    <p>Are you sure you want to delete this content?</p>
    <button id="cancelBtn">Cancel</button>
    <button id="confirmDeleteBtn">Delete</button>
  </div>
</div>

<form action="home.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="content_id">
  <?php 
  
  if($user_type == 'staff'){
  echo '
    <div style="background-color: white; margin: 3em;">

      <a href="dashboard.php" class="dashboard-btn"><i class="fa-solid fa-users-gear"></i> Dashboard</a>

    </div>';
  }
  
  if ($user_type == 'admin') {
    echo '
    <div style="background-color: white; margin: 2em;">

      <a href="dashboard.php" class="dashboard-btn"><i class="fa-solid fa-users-gear"></i> Dashboard</a>

      <button class="add-btn" name="edit-btn"><i class="fa-solid fa-plus"></i> Add Content</button>

    </div>';
  }

  echo '
    <!-- Start of Add Modal -->
    <div class="bg-modal-add">
      <div class="modal-content-add">
        <div class="close"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
        <p class="modal-title">TITLE</p>
        <textarea class="edit-content" name="content_title"></textarea>
        <p class="modal-caption">CAPTION</p>
        <textarea class="edit-content" name="content_caption"></textarea>
        <div>
          <label for="image" class="custom-file-upload">Upload Image</label>
          <input type="file" id="image" class="inputfile" name="content_image">
        </div>
        <input class="saveBtn" type="submit" name="submit">
      </div>
    </div>
    <!-- End of Modal -->';

  foreach($contents as $content) {
    $modalClass = 'modal-'.$content['content_id'];
    $contentIdName= 'content_id'.$content['content_id'];
    $contentTitleName = 'content_title'.$content['content_id'];
    $contentCaptionName = 'content_caption'.$content['content_id'];
    $contentImageId = 'content_image'.$content['content_id'];
    $customFileUploadClass = 'custom-file-upload custom-file-upload'.$content['content_id'];

    echo '
    <!-- Start of Edit Modal -->
    <div class="bg-modal '.$modalClass.'">
      <div class="modal-content">
        <div class="close"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>

          <p class="modal-title">CONTENT TITLE</p>
          <textarea class="edit-content" name="'.$contentTitleName.'">'.$content['content_title'].'</textarea>
          <p class="modal-caption">CONTENT CAPTION</p>
          <textarea class="edit-content" name="'.$contentCaptionName.'">'.$content['content_caption'].'</textarea>

        <div>
        <p style="color: black; margin:1em 2em 0em 2em; font-family: league spartan; font-size: 20px; font-weight:bold;">UPLOADED IMAGE</p>

          <label for="'.$contentImageId.'" class="'.$customFileUploadClass.'">'.basename($content['content_image']).'</label>
          <input type="file" id="'.$contentImageId.'" name="'.$contentImageId.'" class="inputfile">

        </div>
        <input class="saveBtn" type="submit" name="submit">
      </div>
    </div>
    <!-- End of Modal -->';

    if($user_type == 'admin'){
      echo '

      <div><button class="edit-btn" name="edit-btn" data-content-id="'.$content['content_id'].'" data-content-title="'. $content['content_title'].'" data-content-caption="'. $content['content_caption'].'" data-content-image="'.$content['content_image'].'">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>

      <button class="delete-btn" name="edit-btn" data-content-id="'.$content['content_id'].'">Delete Content <i class="fa-regular fa-trash-can"></i></button>
      ';
    }

    echo '
    <div class="container"> 
            <div class="content">
                <div class="title"> ' .$content['content_title']. ' </div>
                <div class="caption"> ' .$content['content_caption']. ' </div>
                <a class="view-menu" href="menu.php">VIEW MENU</a>
            </div>
            <img src="' .$content['content_image']. '" alt="Image">
          </div>';

  }
?>
  <div class="announcement">
    <div class="announcement-container">
      <p class="caption">We have a new schedule!
      Starting February 19, 2024, we will operate from 8 AM to 12 AM.
      Will accept dine-ins, take-outs, and deliveries</p>
    </div>
  </div>
</form>

<?php include('partials/footer.php'); ?>

<script>
var modalClass = "modal-1";
var contentTitle = "";
var contentId = 1;
var contentCaption = "";
var contentImage ="";
var contentImageId = 'content_image'+contentId;
var loader =document.getElementById('preloader');

document.addEventListener('click', function() {
  document.getElementById('notifAddContent').style.display = 'none';
});
document.addEventListener('click', function() {
  document.getElementById('notifDeletedContent').style.display = 'none';
});

window.addEventListener("load", function(){
  setTimeout(function(){
    loader.style.display = "none";
  }, 1000)
})

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.edit-content').forEach(function(textarea) {
    ClassicEditor
      .create(textarea)
      .catch(function(error) {
        console.error(error);
      });
  });
});

document.querySelectorAll('.edit-btn').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        //fetch data
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
  // console.log('contentID: ', contentId);
  // console.log('content_id: ', content_id);
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
    document.querySelector('.bg-modal.'+modalClass).style.display = 'none';
    document.querySelector('.bg-modal-add').style.display = 'none';
  });
});

document.getElementById('content_image'+contentId).addEventListener('change', function() {
  var fileName = this.files[0].name;
  var label = document.querySelector('.custom-file-upload.custom-file-upload'+contentId);
  label.textContent = fileName;
});

document.querySelectorAll('.delete-btn').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        var contentId = button.getAttribute('data-content-id');
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.style.display = 'block';
        
        document.getElementById('cancelBtn').addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });
        
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            var form = document.createElement('form');
            form.method = 'post';
            form.action = 'home.php';

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_content_id';
            input.value = contentId;
            
            form.appendChild(input);
            
            document.body.appendChild(form);
            
            form.submit();
            
            deleteModal.style.display = 'none';
        });
    });
});

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

</script>
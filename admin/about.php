<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=League+Spartan:wght@100;200;300;400;500;600;700;800;900&display=swap');

    .edit-message {
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border: 2px solid #000;
        border-radius: 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        z-index: 1;
        width: 220px;
        height: 50px;
        font-family: 'League Spartan';
        font-size: 20px;
    }
</style>

<?php
include_once './config/connect.php';
include_once './config/functions.php';
include_once './config/functions-about.php';

session_start();
$conn = get_connection();
$user_data = check_login($conn);
$user_type = check_usertype($conn);

$id = 0;
$contents = get_content($conn);
?>

<title>About Us</title>
<?php include('partials/header.php'); ?>
<link rel="stylesheet" href="css/about.css">

<form action="about.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id">
    <?php
    foreach ($contents as $content) {
        $modalClass = 'modal-' . $content['id'];
        $modalClass2 = 'modal-2' . $content['id'];
        $modalClass3 = 'modal-3' . $content['id'];
        $modalClass4 = 'modal-4' . $content['id'];

        $contentIdName = 'content_id' . $content['id'];

        $contentHeading = 'title_header' . $content['id'];
        $contentContentH = 'content_caption' . $content['id'];
        $contentImage1 = 'image_about' . $content['id'];
        $customFileUploadClass = 'custom-file-upload custom-file-upload' . $content['id'];

        $contentTitleM = 'title_mission' . $content['id'];
        $contentCaptionM = 'content_mission' . $content['id'];
        $contentTitleV = 'title_vision' . $content['id'];
        $contentCaptionV = 'content_vision' . $content['id'];
        $contentImage2 = 'image2_about' . $content['id'];
        $customFileUploadClass = 'custom-file-upload custom-file-upload' . $content['id'];

        $contentTitleCA = 'title_competitive' . $content['id'];
        $contentCaption1CA = 'caption_competitive' . $content['id'];
        $contentCaption2CA = 'caption2nd_competitive' . $content['id'];

        $contentTitleLS = 'title_landscape' . $content['id'];
        $contentCaptionLS = 'content_landscape' . $content['id'];
        $contentImage3 = 'image3_about' . $content['id'];
        $customFileUploadClass = 'custom-file-upload custom-file-upload' . $content['id'];

        if ($contentEdit) {
            echo '
                  <div class="edit-message" id="notifAddContent">
                    Edit Content Successfully!
                  </div>
            ';
        }

        echo '
    
        <!-- Start of 1st Modal -->
        <div class="bg-modal ' . $modalClass . '">
          <div class="modal-content">
            <div class="close"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
            <p class="modal-title">TITLE</p>
            <textarea class="edit-content" name="' . $contentHeading . '">' . $content['title_header'] . '</textarea>
            <p class="modal-caption">CAPTION</p>
            <textarea class="edit-content" name="' . $contentContentH . '">' . $content['content_caption'] . '</textarea>
            <div>
              <label for="' . $contentImage1 . '" class="' . $customFileUploadClass . '">' . $content['image_about'] . '</label>
              <input type="file" id="' . $contentImage1 . '" name="' . $contentImage1 . '" class="inputfile">
            </div>
            <input class="saveBtn" type="submit" name="submit">
          </div>
        </div>
        <!-- End of 1st Modal -->';



        echo '
        <div class="container-heading">';
            if ($user_type == 'admin') {
                echo '
                <div><button class="edit-btn" name="edit-btn" content-id="' . $content['id'] . '" title-header="
                ' . $content['title_header'] . '" caption-header="' . $content['content_caption'] . '
                " header-image=" ' . $content['image_about'] . '">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
                ';
            }
            echo '
            <div class="image1">
                <img src="' . $content['image_about'] . '" alt="Image">
            </div>
        
            <div class="content1">
                <div class="header">' . $content['title_header'] . '</div>
        
                <div class="contents-heading">
                ' . $content['content_caption'] . '
                </div>
            </div>
        </div>';
        

        echo '
        <!-- Start of 2nd Modal -->
        <div class="bg-modal2 ' . $modalClass2 . '">
          <div class="modal-content2">
            <div class="close2"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
            <p class="modal-title2">TITLE</p>
            <textarea class="edit-content" name="' . $contentTitleM . '">' . $content['title_mission'] . '</textarea>
            <p class="modal-caption2">CAPTION</p>
            <textarea class="edit-content" name="' . $contentCaptionM . '">' . $content['content_mission'] . '</textarea>
            <p class="modal-caption2">TITLE</p>
            <textarea class="edit-content" name="' . $contentTitleV . '">' . $content['title_vision'] . '</textarea>
            <p class="modal-caption2">CAPTION</p>
            <textarea class="edit-content" name="' . $contentCaptionV . '">' . $content['content_vision'] . '</textarea>
            <div>
              <label for="' . $contentImage2 . '" class="' . $customFileUploadClass . '">' . $content['image2_about'] . '</label>
              <input type="file" id="' . $contentImage2 . '" name="' . $contentImage2 . '" class="inputfile">
            </div>
            <input class="saveBtn" type="submit" name="submit">
          </div>
        </div>
        <!-- End of 2nd Modal -->';

        echo '
        <div class="section">';
        if ($user_type == 'admin') {
            echo '
            <div><button class="edit-btn2nd" name="edit-btn" content-id="' . $content['id'] . '" title-mission="
            ' . $content['title_mission'] . '" caption_mission="' . $content['content_mission'] . '" title_vision="' . $content['title_vision'] . '"
            caption_vision="' . $content['content_vision'] . '" section2-image=" ' . $content['image2_about'] . '">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
            ';
        }
        echo '
            <div class="container">
                <div class="content-section">
                    <div class="title-mission">' . $content['title_mission'] . '</div>
                    <div class="content-mission">' . $content['content_mission'] . '</div>
                <hr style="margin-left: 50px; margin-top: 50px; width: 70%; margin-right: 15px;">
                    <div class="title-vision">' . $content['title_vision'] . '</div>
                    <div class="content-vision">' . $content['content_vision'] . '</div>
                </div>
                
                <div class="container-image">
                    <div class="image2">
                        <img src="' . $content['image2_about'] . '" alt="Image">
                    </div>
                </div>
            </div>
        </div>';

        echo '
        <!-- Start of 3rd Modal -->
        <div class="bg-modal3 ' . $modalClass3 . '">
          <div class="modal-content3">
            <div class="close3"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
            <p class="modal-title">TITLE</p>
            <textarea class="edit-content" name="' . $contentTitleCA . '">' . $content['title_competitive'] . '</textarea>
            <p class="modal-caption">CAPTION</p>
            <textarea class="edit-content" name="' . $contentCaption1CA . '">' . $content['caption_competitive'] . '</textarea>
            <p class="modal-caption">CAPTION</p>
            <textarea class="edit-content" name="' . $contentCaption2CA . '">' . $content['caption2nd_competitive'] . '</textarea>
            <input class="saveBtn" type="submit" name="submit">
          </div>
        </div>
        <!-- End of 3rd Modal -->';


        echo '
        <div class="section2">';
        if ($user_type == 'admin') {
            echo '
            <div><button class="edit-btn3rd" name="edit-btn" content-id="' . $content['id'] . '" title-compa="
            ' . $content['title_competitive'] . '" caption1_compa="' . $content['caption_competitive'] . '" caption2_compa="
            ' . $content['caption2nd_competitive'] . '">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
            ';
        }
        echo '
            <div class="container2">
                <div class="content-section2">
                    <div class="title-compadv">' . $content['title_competitive'] . '</div>
                </div>
            </div>

            <div class="content-1st">
            ' . $content['caption_competitive'] . '
            </div>

            <div class="content-2nd">
            ' . $content['caption2nd_competitive'] . '
            </div>
        </div>';

        echo '
        <!-- Start of 4th Modal -->
        <div class="bg-modal4 ' . $modalClass4 . '">
          <div class="modal-content4">
            <div class="close4"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
            <p class="modal-title">TITLE</p>
            <textarea class="edit-content" name="' . $contentTitleLS . '">' . $content['title_landscape'] . '</textarea>
            <p class="modal-caption">CAPTION</p>
            <textarea class="edit-content" name="' . $contentCaptionLS . '">' . $content['content_landscape'] . '</textarea>
            <div>
                <label for="' . $contentImage3 . '" class="' . $customFileUploadClass . '">' . $content['image3_about'] . '</label>
                <input type="file" id="' . $contentImage3 . '" name="' . $contentImage3 . '" class="inputfile">
             </div>
            <input class="saveBtn" type="submit" name="submit">
          </div>
        </div>
        <!-- End of 4th Modal -->';

        echo '
        <div class="section3">';
        if ($user_type == 'admin') {
            echo '
            <div><button class="edit-btn4th" name="edit-btn" content-id="' . $content['id'] . '" title-compls="
            ' . $content['title_landscape'] . '" caption_compls="' . $content['content_landscape'] . '" 
            section3-image=" ' . $content['image3_about'] . '" >Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
            ';
        }
        echo '
            <div class="container3">
                <div class="content-section3">
                    <div class="title-compland">
                    ' . $content['title_landscape'] . '
                    </div>

                    <div class="content-compl">
                    ' . $content['content_landscape'] . '
                    </div>
                    
                </div>
                
                <div class="image3">
                    <img src="' . $content['image3_about'] . '" alt="Image">
                </div>
            </div>
        </div>';
    }

    ?>
</form>

<?php include('partials/footer.php'); ?>

<script>
    var Id = 1;
    var modalClass = "modal-1";
    var modalClass2 = "modal-2";
    var modalClass3 = "modal-3";
    var modalClass4 = "modal-4";

    var contentTitleHeader = "";
    var contentTitleCaption = "";
    var contentCaptionHeader = "";
    var contentImage1 = "";
    var contentImage1Id = 'image_about' + Id;

    var contentTitleM = "";
    var contentCaptionM = "";
    var contentTitleV = "";
    var contentCaptionV = "";
    var contentImage2 = "";
    var contentImage2Id = 'image2_about' + Id;

    var contentTitleCA = "";
    var contentCaptionCA = "";
    var contentCaption2ndCA = "";

    var contentTitleLS = "";
    var contentCaptionLS = "";
    var contentImage3 = "";
    var contentImage3Id = 'image3_about' + Id;

    document.addEventListener('DOMContentLoaded', function() {
        var editMessage = document.getElementById('notifAddContent');

        // Start the timer to close the dialog after 3 seconds
        setTimeout(function() {
            editMessage.style.display = 'none';
        }, 2000);
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

    /* 1st Modal */
    document.querySelectorAll('.edit-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            //fetch data
            contentTitleHeader = button.getAttribute('title-header');
            contentCaptionHeader = button.getAttribute('content-header');
            contentImage1 = button.getAttribute('header-image');
            Id = button.getAttribute('content-id');
            contentImage1Id = 'image_about' + Id;

            handleEditButtonClick(Id);
        });
    });

    function handleEditButtonClick(Id) {
        modalClass = "modal-" + Id;
        document.querySelector('input[name="id"]').value = Id;
        document.querySelector('.bg-modal.' + modalClass).style.display = 'flex';
    }

    document.querySelectorAll('.close').forEach(function(element) {
        element.addEventListener('click', function() {
            document.querySelector('.bg-modal.' + modalClass).style.display = 'none';
        });
    });

    document.getElementById('image_about' + Id).addEventListener('change', function() {
        var fileName = this.files[0].name;
        var label = document.querySelector('.custom-file-upload.custom-file-upload' + Id);
        label.textContent = fileName;
    });
    /* 1st Modal */

    /* 2nd Modal */
    document.querySelectorAll('.edit-btn2nd').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            //fetch data
            contentTitleM = button.getAttribute('title-mission');
            contentCaptionM = button.getAttribute('caption_mission');
            contentTitleV = button.getAttribute('title_vision');
            contentCaptionV = button.getAttribute('caption_vision');
            contentImage2 = button.getAttribute('section2-image');
            Id = button.getAttribute('content-id');
            contentImage2Id = 'image2_about' + Id;

            handleEditButton2ndClick(Id);
        });
    });

    function handleEditButton2ndClick(Id) {
        modalClass = "modal-2" + Id;
        document.querySelector('input[name="id"]').value = Id;
        document.querySelector('.bg-modal2.' + modalClass).style.display = 'flex';
    }

    document.querySelectorAll('.close2').forEach(function(element) {
        element.addEventListener('click', function() {
            document.querySelector('.bg-modal2.' + modalClass).style.display = 'none';
        });
    });

    document.getElementById('image2_about' + Id).addEventListener('change', function() {
        var fileName = this.files[0].name;
        var label2 = document.querySelector('.custom-file-upload.custom-file-upload' + Id);
        label2.textContent = fileName;
    });
    /* 2nd Modal */

    /* 3rd Modal */
    document.querySelectorAll('.edit-btn3rd').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            //fetch data
            contentTitleCA = button.getAttribute('title-compa');
            contentCaptionCA = button.getAttribute('caption1_compa');
            contentCaption2ndCA = button.getAttribute('caption2_compa');
            Id = button.getAttribute('content-id');

            handleEditButton3rdClick(Id);
        });
    });

    function handleEditButton3rdClick(Id) {
        modalClass = "modal-3" + Id;
        document.querySelector('input[name="id"]').value = Id;
        document.querySelector('.bg-modal3.' + modalClass).style.display = 'flex';
    }

    document.querySelectorAll('.close3').forEach(function(element) {
        element.addEventListener('click', function() {
            document.querySelector('.bg-modal3.' + modalClass).style.display = 'none';
        });
    });
    /* 3rd Modal */

    /* 4th Modal */
    document.querySelectorAll('.edit-btn4th').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            //fetch data
            contentTitleLS = button.getAttribute('title-compLS');
            contentCaptionLS = button.getAttribute('caption_compLS');
            contentImage3 = button.getAttribute('section3-image');
            Id = button.getAttribute('content-id');
            contentImage3Id = 'image3_about' + Id;

            Id = button.getAttribute('content-id');

            handleEditButton4thClick(Id);
        });
    });

    function handleEditButton4thClick(contentId) {
        modalClass = "modal-4" + Id;
        document.querySelector('input[name="id"]').value = Id;
        document.querySelector('.bg-modal4.' + modalClass).style.display = 'flex';
    }

    document.querySelectorAll('.close4').forEach(function(element) {
        element.addEventListener('click', function() {
            document.querySelector('.bg-modal4.' + modalClass).style.display = 'none';
        });
    });
    /* 4th Modal */

    document.addEventListener('DOMContentLoaded', function() {
        var popup = document.querySelector('.popup');
        var closeBtn = document.querySelector('.close-message');

        closeBtn.addEventListener('click', function() {
            popup.style.display = 'none';
        });
    });

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
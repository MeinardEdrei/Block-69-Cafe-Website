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
    }
</style>
<?php

include './config/connect.php';
include './config/functions.php';
include './config/functions-services.php';

session_start();

$conn = get_connection();
$user_data = check_login($conn);
$user_type = check_usertype($conn);
$id = 0;
$contents = get_content($conn);

?>

<?php include_once('partials/header.php'); ?>

<link rel="stylesheet" href="css/servicesbar.css">
<form action="barservices.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id">
    <?php


    foreach ($contents as $content) {
        $modalClass = 'modal-' . $content['id'];
        $modalClass2 = 'modal-2' . $content['id'];
        $modalClass3 = 'modal-3' . $content['id'];
        $modalClass4 = 'modal-4' . $content['id'];
        $modalClass5 = 'modal-5' . $content['id'];
        $modalClass6 = 'modal-6' . $content['id'];
        $modalClass7 = 'modal-7' . $content['id'];

        $contentIdName = 'content_id' . $content['id'];
        $contentTitleBarServices = 'title_barservices' . $content['id'];
        $contentCaptionBarServices = 'content_barservices' . $content['id'];
        $contentImageId = 'image_barservices' . $content['id'];
        $customFileUploadClass = 'custom-file-upload custom-file-upload' . $content['id'];

        $titleBooking = 'title_booking' . $content['id'];
        $contentBooking = 'content_booking' . $content['id'];
        $listInclusion = 'list_inclusion' . $content['id'];
        $listAdditional = 'list_additional' . $content['id'];
        $contentRequest = 'content_request' . $content['id'];
        $contentForEvents = 'content_forevents' . $content['id'];
        $contentAddons = 'content_addons' . $content['id'];

        $contentTitleFlavors = 'title_flavors' . $content['id'];
        $contentTitlePremium = 'title_premium' . $content['id'];
        $contentTitleBasic = 'title_basic' . $content['id'];
        $contentPremiumCoffee = 'premium_coffee' . $content['id'];
        $contentPremiumNonCoffee = 'premium_noncoffee' . $content['id'];
        $contentBasicCoffee = 'basic_coffee' . $content['id'];
        $contentBasicNonCoffee = 'basic_noncoffee' . $content['id'];

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
            <textarea class="edit-content" name="' . $contentTitleBarServices . '">' . $content['title_barservices'] . '</textarea>
            <p class="modal-caption">CAPTION</p>
            <textarea class="edit-content" name="' . $contentCaptionBarServices . '">' . $content['content_barservices'] . '</textarea>
            <div>
              <label for="' . $contentImageId . '" class="' . $customFileUploadClass . '">' . $content['image_barservices'] . '</label>
              <input type="file" id="' . $contentImageId . '" name="' . $contentImageId . '" class="inputfile">
            </div>
            <input class="saveBtn" type="submit" name="submit">
          </div>
        </div>
        <!-- End of 1st Modal -->';

        echo '
        <div class="container-heading">';

        if ($user_type == 'admin') {
            echo '
        <div><button class="edit-btn" name="edit-btn" data-content-id="' . $content['id'] . '" data-content-titleservices="' .
                $content['title_barservices'] . '"  data-content-captionservices="' . $content['content_barservices'] . '" 
        data-content-image="' . $content['image_barservices'] . '">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
        ';
        }
        echo '
            <div class="first-image">
            <img src="BLK/banner-barservices.png" alt="Image">
            </div>
    
            <div class="first-content">
                <div class="title-barservices">
                    ' . $content['title_barservices'] . '
                </div>
                <div class="caption-barservices">
                    ' . $content['content_barservices'] . '
                </div>
            </div>
        </div>';

        echo '
        <!-- Start of Modal2 -->
        <div class="bg-modal2 ' . $modalClass2 . '">
          <div class="modal-content2">
            <div class="close2"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
            <!-- Content for modal2 -->
            <p class="modal-title2">TITLE</p>
            <textarea class="edit-content" name="' . $titleBooking . '">' . $content['title_booking'] . '</textarea>
            <p class="modal-caption2">CAPTION</p>
            <textarea class="edit-content" name="' . $contentBooking . '">' . $content['content_booking'] . '</textarea>
            <p class="modal-caption2">INCLUSION LIST</p>
            <textarea class="edit-content" name="' . $listInclusion . '">' . $content['list_inclusion'] . '</textarea>
            <p class="modal-caption2">ADDITIONAL LIST</p>
            <textarea class="edit-content" name="' . $listAdditional . '">' . $content['list_additional'] . '</textarea>
            <input class="saveBtn" type="submit" name="submit">
          </div>
        </div>
        <!-- End of Modal2 -->';


        echo '
        <div class="container-inclusion">';

        if ($user_type == 'admin') {
            echo '
        <div><button class="edit-btnIN" name="edit-btnIN" data-content-id="' . $content['id'] . '" data-content-titlebooking="' .
                $content['title_booking'] . '"  data-content-captionbooking="' . $content['content_booking'] . '" 
        data-content-inclusion="' . $content['list_inclusion'] . '"  data-content-additional="' . $content['list_additional'] . '">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
        ';
        }
        echo '
        <div class="content1-inclusion">
        <div class="title-booking" style="margin-top: 30px;">
        ' . $content['title_booking'] . '
        </div>
        <div class="content-booking">
        ' . $content['content_booking'] . '
        </div>
        </div>
        <div class="title-for-inclusion">
            <p>Coffee Bar Inclusion</p>
        </div>
        <div class="container-list-inclusion">
            <div class="first-content-wrapper">
                <div class="first-content-list">
                    <ul>
                    ' . $content['list_inclusion'] . '
                    </ul>
                </div>
                <div class="additional-list">
                    <div class="additional-listTitle">
                        <p>Additional :</p>
                    </div>
                    <ul>
                    ' . $content['list_additional'] . '
                    </ul>
                </div>
            </div>
            <div class="second-content-wrapper">
                <div class="how-to-book">
                    <p>How to book</p>
                </div>
                <div class="book-request"><p>BOOK / QUOTATION REQUEST THROUGH</p> </div>
                <div class="content-request"> ' . $content['content_request'] . ' </div>
                <div class="book-anyevents"><p>AVAILABLE FOR ANY EVENTS</p></div>
                <div class="content-anyevents"> ' . $content['content_forevents'] . '</div>
                <div class="add-ons"><p>W/ ADD ONS & CUSTOMIZATIONS</p></div>
                <div class="content-addons"> ' . $content['content_addons'] . '</div>
            </div>
        </div>
    </div>';


        echo '
    <!-- Start of Modal3 -->
    <div class="bg-modal3 ' . $modalClass3 . '">
      <div class="modal-content3">
        <div class="close3"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
        <!-- Content for modal3 -->
        <p class="modal-title3">TITLE</p>
        <textarea class="edit-content" name="' . $contentTitleFlavors . '">' . $content['title_flavors'] . '</textarea>
        <p class="modal-title3">TITLE</p>
        <textarea class="edit-content" name="' . $contentTitlePremium . '">' . $content['title_premium'] . '</textarea>
        <p class="modal-title3">TITLE</p>
        <textarea class="edit-content" name="' . $contentTitleBasic . '">' . $content['title_basic'] . '</textarea>
        <input class="saveBtn" type="submit" name="submit">
      </div>
    </div>
    <!-- End of Modal3 -->';

        echo '
    <!-- Start of Modal4 -->
    <div class="bg-modal4 ' . $modalClass4 . '">
      <div class="modal-content4">
        <div class="close4"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
        <!-- Content for modal4 -->
        <p class="modal-title2">CONTENT</p>
        <textarea class="edit-content" name="' . $contentPremiumCoffee . '">' . $content['premium_coffee'] . '</textarea>
        <input class="saveBtn" type="submit" name="submit">
      </div>
    </div>
    <!-- End of Modal4 -->';

        echo '
    <!-- Start of Modal5 -->
    <div class="bg-modal5 ' . $modalClass5 . '">
      <div class="modal-content5">
        <div class="close5"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
        <!-- Content for modal5 -->
        <p class="modal-title2">CONTENT</p>
        <textarea class="edit-content" name="' . $contentPremiumNonCoffee . '">' . $content['premium_noncoffee'] . '</textarea>
        <input class="saveBtn" type="submit" name="submit">
      </div>
    </div>
    <!-- End of Modal5 -->';

        echo '
    <!-- Start of Modal6 -->
    <div class="bg-modal6 ' . $modalClass6 . '">
      <div class="modal-content6">
        <div class="close6"><i class="fa-solid fa-square-xmark" style="color: black;"></i></div>
        <!-- Content for modal6 -->
        <p class="modal-title2">CONTENT</p>
        <textarea class="edit-content" name="' . $contentBasicCoffee . '">' . $content['basic_coffee'] . '</textarea>
        <input class="saveBtn" type="submit" name="submit">
      </div>
    </div>
    <!-- End of Modal6 -->';

        echo '
    <!-- Start of Modal7 -->
    <div class="bg-modal7 ' . $modalClass7 . '">
      <div class="modal-content7">
        <div class="close7"><i class="fa-solid fa-square-xmark" style="color: #ffffff;"></i></div>
        <!-- Content for modal7 -->
        <p class="modal-title2">CONTENT</p>
        <textarea class="edit-content" name="' . $contentBasicNonCoffee . '">' . $content['basic_noncoffee'] . '</textarea>
        <input class="saveBtn" type="submit" name="submit">
      </div>
    </div>
    <!-- End of Modal7 -->';


        echo '
    <div class="container-flavors">';

        if ($user_type == 'admin') {
            echo '
        <div><button class="edit-btnFL" name="edit-btnFL" data-content-id="' . $content['id'] . '" data-content-titleFlavors="' .
                $content['title_flavors'] . '"  data-content-titlepremium="' . $content['title_premium'] . '" 
        data-content-titlebasic="' . $content['title_basic'] . '">Edit Content  <i class="fa-regular fa-pen-to-square"></i></button></div>
        ';
        }
        echo '
    
        <div class="our-flavors" style="margin-top: 30px";> ' . $content['title_flavors'] . '</div>
        <div class="title-premium">' . $content['title_premium'] . '</div>';
        echo '
        <table class="styled-table">
            <tr>
                <td>Coffee Based</td>
                <td>
                    <ul>' . $content['premium_coffee'] . '</ul>
                </td>
                <td' . ($user_type != 'admin' ? ' style="display:none;"' : '') . '>
                    <div>
                        <button class="edit-btnP" name="edit-btP" data-content-id="' . $content['id'] . '" data-content-premiumcoffee="' . $content['premium_coffee'] . '">Edit Content  <i class="fa-regular fa-pen-to-square"></i></button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Non Coffee Based</td>
                <td>
                    <ul>' . $content['premium_noncoffee'] . '</ul>
                </td>
                <td' . ($user_type != 'admin' ? ' style="display:none;"' : '') . '>
                    <div>
                        <button class="edit-btnNP" name="edit-btNP" data-content-id="' . $content['id'] . '" data-content-premiumnoncoffee="' . $content['premium_noncoffee'] . '">Edit Content <i class="fa-regular fa-pen-to-square"></i></button>
                    </div>
                </td>
            </tr>
        </table>';

        echo '<div class="title-premium">' . $content['title_basic'] . '</div>';

        echo '
        <table class="styled-table">
            <tr>
                <td>Coffee Based</td>
                <td>
                    <ul>' . $content['basic_coffee'] . '</ul>
                </td>
                <td' . ($user_type != 'admin' ? ' style="display:none;"' : '') . '>
                    <div>
                        <button class="edit-btnB" name="edit-btB" data-content-id="' . $content['id'] . '" data-content-basiccoffee="' . $content['basic_coffee'] . '">Edit Content  <i class="fa-regular fa-pen-to-square"></i></button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Non Coffee Based</td>
                <td>
                    <ul>' . $content['basic_noncoffee'] . '</ul>
                </td>
                <td' . ($user_type != 'admin' ? ' style="display:none;"' : '') . '>
                    <div>
                        <button class="edit-btnNB" name="edit-btNB" data-content-id="' . $content['id'] . '" data-content-basicnoncoffee="' . $content['basic_noncoffee'] . '">Edit Content  <i class="fa-regular fa-pen-to-square"></i></button>
                    </div>
                </td>
            </tr>
        </table>
        </div>';
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        var Id = 1;
        var modalClass = "modal-1";
        var modalClass2 = "modal-2";
        var modalClass3 = "modal-3";
        var modalClass4 = "modal-4";
        var modalClass5 = "modal-5";
        var modalClass6 = "modal-6";
        var modalClass7 = "modal-7";
        var modalTable = 'modalTable';

        var contentTitleBarServices = "";
        var contentCaptionBarServices = "";
        var contentImage = "";
        var contentImageId = 'image_barservices' + Id;

        var contentTitleBooking = "";
        var contentCaptionBooking = "";
        var contentListInclusion = "";
        var contentListAdditional = "";

        var contentTitleFlavors = "";
        var contentTitlePremium = "";
        var contentTitleBasic = "";

        var contentCaptionPremiumCoffee = "";
        var contentCaptionNonPremiumCoffee = "";

        var contentCaptionBasicCoffee = "";
        var contentCaptionNonBasicCoffee = "";

        document.addEventListener('DOMContentLoaded', function() {
            var editMessage = document.getElementById('notifAddContent');

            setTimeout(function() {
                editMessage.style.display = 'none';
            }, 2000);
        });

        function handleEditButtonClick(Id) {
            modalClass = "modal-" + Id;
            document.querySelector('input[name="id"]').value = Id;
            document.querySelector('.bg-modal.' + modalClass).style.display = 'flex';
        }

        function handleEditButtonInclusionClick(Id) {
            modalClass = "modal-2" + Id;
            document.querySelector('input[name="id"]').value = Id;
            document.querySelector('.bg-modal2.' + modalClass).style.display = 'flex';
        }

        function handleEditButtonFlavorsClick(Id) {
            modalClass = "modal-3" + Id;
            document.querySelector('input[name="id"]').value = Id;
            document.querySelector('.bg-modal3.' + modalClass).style.display = 'flex';
        }

        function handleEditButtonPremiumClick(Id) {
            modalClass = "modal-4" + Id;
            document.querySelector('input[name="id"]').value = Id;
            document.querySelector('.bg-modal4.' + modalClass).style.display = 'flex';
        }

        function handleEditButtonNonPremiumClick(Id) {
            modalClass = "modal-5" + Id;
            document.querySelector('input[name="id"]').value = Id;
            document.querySelector('.bg-modal5.' + modalClass).style.display = 'flex';
        }

        function handleEditButtonBasicClick(Id) {
            modalClass = "modal-6" + Id;
            document.querySelector('input[name="id"]').value = Id;
            document.querySelector('.bg-modal6.' + modalClass).style.display = 'flex';
        }

        function handleEditButtonNonBasicClick(Id) {
            modalClass = "modal-7" + Id;
            document.querySelector('input[name="id"]').value = Id;
            document.querySelector('.bg-modal7.' + modalClass).style.display = 'flex';
        }

        function handleEditButtonFirstTableClick(Id) {
            modalClass = "modalTable" + Id;
            document.querySelector('input[name="id"]').value = Id;
            document.querySelector('.modalTable.' + modalClass).style.display = 'flex';
        }

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
                contentTitleBarServices = button.getAttribute('data-content-titleservices');
                contentCaptionBarServices = button.getAttribute('data-content-captionservices');
                contentImage = button.getAttribute('data-content-image');
                Id = button.getAttribute('data-content-id');
                contentImageId = 'image_barservices' + Id;

                handleEditButtonClick(Id);
            });
        });

        document.querySelectorAll('.edit-btnIN').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                //fetch data
                contentTitleBooking = button.getAttribute('data-content-titlebooking');
                contentCaptionBooking = button.getAttribute('data-content-booking');
                contentListInclusion = button.getAttribute('data-content-inclusion');
                contentListAdditional = button.getAttribute('data-content-additional');

                Id = button.getAttribute('data-content-id');


                handleEditButtonInclusionClick(Id);
            });
        });

        document.querySelectorAll('.edit-btnFL').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                //fetch data
                contentTitleFlavors = button.getAttribute('data-content-titleFlavors');
                contentTitlePremium = button.getAttribute('data-content-titlepremium');
                contentTitleBasic = button.getAttribute('data-content-titlebasic');

                Id = button.getAttribute('data-content-id');


                handleEditButtonFlavorsClick(Id);
            });
        });

        document.querySelectorAll('.edit-btnP').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                //fetch data
                contentCaptionPremiumCoffee = button.getAttribute('data-content-premiumcoffee');

                Id = button.getAttribute('data-content-id');


                handleEditButtonPremiumClick(Id);
            });
        });

        document.querySelectorAll('.edit-btnNP').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                //fetch data
                contentCaptionNonPremiumCoffee = button.getAttribute('data-content-nonpremiumcoffee');

                Id = button.getAttribute('data-content-id');


                handleEditButtonNonPremiumClick(Id);
            });
        });

        document.querySelectorAll('.edit-btnB').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                //fetch data
                contentCaptionBasicCoffee = button.getAttribute('data-content-basiccoffee');

                Id = button.getAttribute('data-content-id');


                handleEditButtonBasicClick(Id);
            });
        });

        document.querySelectorAll('.edit-btnNB').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                //fetch data
                contentCaptionNonBasicCoffee = button.getAttribute('data-content-basicnoncoffee');

                Id = button.getAttribute('data-content-id');


                handleEditButtonNonBasicClick(Id);
            });
        });

        document.querySelectorAll('.close').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelector('.bg-modal.' + modalClass).style.display = 'none';
            });
        });

        document.querySelectorAll('.close2').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelector('.bg-modal2.' + modalClass).style.display = 'none';
            });
        });

        document.querySelectorAll('.close3').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelector('.bg-modal3.' + modalClass).style.display = 'none';
            });
        });

        document.querySelectorAll('.close4').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelector('.bg-modal4.' + modalClass).style.display = 'none';
            });
        });

        document.querySelectorAll('.close5').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelector('.bg-modal5.' + modalClass).style.display = 'none';
            });
        });

        document.querySelectorAll('.close6').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelector('.bg-modal6.' + modalClass).style.display = 'none';
            });
        });

        document.querySelectorAll('.close7').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelector('.bg-modal7.' + modalClass).style.display = 'none';
            });
        });

        document.querySelectorAll('.inputfile').forEach(function(input) {
            input.addEventListener('change', function() {
                var fileName = this.files[0].name;
                var label = document.querySelector('.custom-file-upload.custom-file-upload' + Id);
                label.textContent = fileName;
            });
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</form>
<link rel="stylesheet" href="css/blog-toedit-slider.css">
<?php
session_start();
include_once('partials/header.php');

$host = $_ENV["DB_HOST"];
$user = $_ENV["DB_USERNAME"];
$password = $_ENV["DB_PASSWORD"];
$database = $_ENV["DB_NAME"];

$data = mysqli_connect($host, $user, $password, $database);

// Function for notification
if (!$data) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['blogSliderID'])) {
    $blogSliderID = intval($_GET['blogSliderID']); // Use intval to sanitize input
    $querySlider = "DELETE FROM blogslider WHERE blogIDNum = ?";
    
    $stmt = mysqli_prepare($data, $querySlider);
    mysqli_stmt_bind_param($stmt, 'i', $blogSliderID);
    $resultSlider = mysqli_stmt_execute($stmt);
    
    if ($resultSlider) {
        $_SESSION['blogUploadStatus'] = 'You Deleted an Image <b>Successfully!</b>';
    } else {
        $_SESSION['blogUploadStatus'] = 'ERROR: NOT DELETED';
    }
    mysqli_stmt_close($stmt);
    header("Location: blog-toedit-slider.php");
    exit();
}

$query = "SELECT * FROM blogslider";
$result = mysqli_query($data, $query);
?>

<!-- NOTIFICATION: CONTENT (EDIT AND DELETE)-->
    <?php
    if (isset($_SESSION['blogUploadStatus'])) {
        echo '
        <div class="blogMessageSuccess" id="blogMessageSuccess">
            <div class="blogAlertMsg" role="alert">
                <strong>
                    <h3>Hey There!</h3>
                </strong> 
                <p>' . $_SESSION['blogUploadStatus'] . '</p>
                <img src="Icons/close-button-white.png" class="blogCloseAlertBtn" alt="CLOSE">
            </div>
        </div>
        ';
        unset($_SESSION['blogUploadStatus']);
    }
    ?>
<!-- NOTIFICATION: CONTENT (EDIT AND DELETE) -->

<!-- NOTIFICATION EFFECT -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let blogMessageSuccess = document.getElementById("blogMessageSuccess");
        if (blogMessageSuccess) {
            document.querySelector(".blogCloseAlertBtn").addEventListener("click", function() {
                blogMessageSuccess.classList.add("hidden"); // Add hidden class for transition effect
                setTimeout(() => blogMessageSuccess.style.display = "none", 500); // Ensure element is removed after transition
            });
        }
    });
    </script>
<!-- NOTIFICATION EFFECT -->

<!-- CONTENT: TABLE -->
    <div class="tablecontainer">
        <table class="tableclass">
            <tr>
                <th class="th_id">ID</th>
                <th class="th_img">IMAGES</th>
                <th class="th_edit">EDIT</th>
                <th class="th_delete">DELETE</th>
            </tr>

            <?php
            while ($blogImageContent = $result->fetch_assoc()) {
                echo '
                <tr>
                    <td>
                        <h4>' . $blogImageContent['blogIDNum'] . '</h4>
                    </td>
                    <td>
                        <img src="' . $blogImageContent['blogSliderImage'] . '" alt="">
                    </td>
                    <td class="sliderEditBtn">
                        <button type="button" class="add_blog_btn" onclick="openEditModal(' . $blogImageContent['blogIDNum'] . ', \'' . addslashes($blogImageContent['blogSliderImage']) . '\')">EDIT</button>
                    </td>
                    <td class="sliderDeleteBtn">
                        <input type="hidden" name="blogSliderID" value="' . $blogImageContent['blogIDNum'] . '">
                        <a href="?action=delete&blogSliderID=' . ($blogImageContent['blogIDNum']) . '">DELETE</a>
                    </td>
                </tr>';
            }
            ?>
        </table>
    </div>
    <!-- CONTENT: TABLE -->

    <!-- START: POPUP and BACKDROP -->
    <div id="blogBackdrop" class="blogBackdrop"></div>
    <div class="blog_PopUp" id="blog_PopUp">
        <img src="Icons/close-button.png" alt="CLOSE" class="blogClosePopupbtn">
        <form id="editForm" action="" method="post" enctype="multipart/form-data">
            <div class="editSliderContainer">
                <input type="hidden" name="sliderImgID" id="sliderImgID">

                <div class="editTitle">
                    <h1>UPDATE IMAGE</h1>
                </div>
                <div class="sliderPrevImg">
                    <label>Previous Image</label>
                    <br>
                    <img src="" id="previousImage" alt="Previous Image">
                </div>

                <div class="sliderNewImg">
                    <label>New Image:</label>
                    <br>
                    <input type="file" name="sliderUpdatedImg" required>
                </div>

                <div class="submitBtn">
                    <input type="submit" name="update" value="SAVE">
                </div>
            </div>
        </form>
    </div>
    <!-- END: POPUP and BACKDROP -->
<!-- CONTENT: TABLE -->

<!-- START: FUNCTION FOR TO EDIT BUTTON -->
    <script>
        let blog_PopUp = document.getElementById("blog_PopUp");
        let blogBackdrop = document.getElementById("blogBackdrop");

        function openEditModal(id, imageUrl) {
            document.getElementById("sliderImgID").value = id;
            document.getElementById("previousImage").src = imageUrl;
            blog_PopUp.classList.add("blog-open-popup");
            blogBackdrop.classList.add('blogBackdrop-active');
        }

        function closeEditModal() {
            blog_PopUp.classList.remove("blog-open-popup");
            blogBackdrop.classList.remove('blogBackdrop-active');
        }

        document.querySelector(".blogClosePopupbtn").addEventListener("click", closeEditModal);

        blogBackdrop.addEventListener("click", closeEditModal);
    </script>

    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $sliderImgID = intval($_POST['sliderImgID']);

        if ($_FILES['sliderUpdatedImg']['error'] == UPLOAD_ERR_OK) {
            $file = $_FILES['sliderUpdatedImg']['name'];
            $targetDir = "blog_db_sliderImages/";
            $dst = $targetDir . basename($file);

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            //Function for the EDIT NOTIFICATION
            if (move_uploaded_file($_FILES['sliderUpdatedImg']['tmp_name'], $dst)) {
                $updatedImgSql = $data->prepare("UPDATE blogslider SET blogSliderImage=? WHERE blogIDNum=?");
                $updatedImgSql->bind_param("si", $dst, $sliderImgID);
                $updatedResult = $updatedImgSql->execute();

                if ($updatedResult) {
                    $_SESSION['blogUploadStatus'] = 'You updated an Image <b>Successfully!</b>';
                    exit();
                } else {
                    $_SESSION['blogUploadStatus'] = 'ERROR: NOT UPDATED';
                }
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "File upload error: " . $_FILES['sliderUpdatedImg']['error'];
        }
    }
    ?>
<!-- END: FUNCTION FOR TO EDIT BUTTON -->

<?php
mysqli_close($data);
include_once('partials/footer.php');
?>
    
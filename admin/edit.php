<!-- FOR: EDIT THE IMAGE BLOG SLIDER -->

<?php
session_start();
include_once('partials/header.php');

// Database connection
$host = $_ENV["DB_HOST"];
$user = $_ENV["DB_USERNAME"];
$password = $_ENV["DB_PASSWORD"];
$database = $_ENV["DB_NAME"];

$data = new mysqli($host, $user, $password, $database);

if ($data->connect_error) {
    die("Connection failed: " . $data->connect_error);
}

$sliderimgID = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = $data->prepare("SELECT * FROM blogslider WHERE blogIDNum = ?");
$sql->bind_param("i", $sliderimgID);
$sql->execute();
$result = $sql->get_result();

if ($result && $result->num_rows > 0) {
    $info = $result->fetch_assoc();
} else {
    echo "No image found with the provided ID.";
    exit;
}
?>

<?php
if (isset($_SESSION['blogUploadStatus'])) {
    echo '
    <div class="blogMessageSuccess" id="blogMessageSuccess">
        <div class="blogAlertMsg" role="alert">
            <strong>
                <h3>Congratulations!</h3>
            </strong>
            <p>You have <b>successfully</b> updated your image.</p>
            <img src="Icons/close-button-white.png" class="blogCloseAlertBtn" alt="CLOSE">
        </div>
    </div>
    ';
    unset($_SESSION['blogUploadStatus']);
}
?>


<link rel="stylesheet" href="css/blog-toedit-slider.css">

<form action="edit.php?id=<?php echo htmlspecialchars($sliderimgID); ?>" method="post" enctype="multipart/form-data">
    <div class="editSliderContainer">
        <input type="hidden" name="sliderImgID" value="<?php echo htmlspecialchars($info['blogIDNum']); ?>">

        <div class="editTitle">
            <h1>UPDATE IMAGE</h1>
        </div>
        <div class="sliderPrevImg">
            <label>Previous Image</label>
            <br>
            <img src="<?php echo htmlspecialchars($info['blogSliderImage']); ?>" alt="Previous Image">
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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $sliderImgID = intval($_POST['sliderImgID']);

    if ($_FILES['sliderUpdatedImg']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['sliderUpdatedImg']['name'];
        $targetDir = "blog_db_sliderImages/";
        $dst = $targetDir . basename($file);

        // Check if the target directory exists, create if not
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($_FILES['sliderUpdatedImg']['tmp_name'], $dst)) {
            $updatedImgSql = $data->prepare("UPDATE blogslider SET blogSliderImage=? WHERE blogIDNum=?");
            $updatedImgSql->bind_param("si", $dst, $sliderImgID);
            $updatedResult = $updatedImgSql->execute();

            if ($updatedResult) {
                $_SESSION['blogUploadStatus'] = 'BLOG CONTENT INSERTED SUCCESSFULLY!';
            } else {
                $_SESSION['blogUploadStatus'] = 'ERROR';
            }
            header("Location: edit.php?id=" . $sliderImgID);
            exit();
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "File upload error: " . $_FILES['sliderUpdatedImg']['error'];
    }
}
?>

<?php
//FOOTER
include_once('partials/footer.php');
?>
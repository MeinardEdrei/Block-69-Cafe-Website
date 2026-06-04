<link rel="stylesheet" href="css/blog-allpost.css">

<?php
$host = $_ENV["DB_HOST"];
$user = $_ENV["DB_USERNAME"];
$password = $_ENV["DB_PASSWORD"];
$database = $_ENV["DB_NAME"];
$data = mysqli_connect($host, $user, $password, $database);

if (isset($_GET['blogSliderID'])) {
    $blogSliderID = intval($_GET['blogSliderID']); // Use intval to sanitize input
    $querySlider = "DELETE FROM blogslider WHERE blogIDNum = ?";
    
    $stmt = mysqli_prepare($data, $querySlider);
    mysqli_stmt_bind_param($stmt, 'i', $blogSliderID);
    $resultSlider = mysqli_stmt_execute($stmt);
    
    if ($resultSlider) {
        echo "
        <div class='mainContainerToDelete'>
            <div class='blogToDelete'>
                <img src='icons/check-mark.png' alt='check mark' class='blogCheckMark'>
                <h2>DELETED SUCCESSFULLY!</h2>
            </div>
        </div>
        ";
    } else {
        echo "ERROR: NOT DELETED";
    }
    mysqli_stmt_close($stmt);
} else {
    echo "ERROR: INVALID ID";
}

mysqli_close($data);
?>

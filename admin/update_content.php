<?php
include_once './config/connect.php';
$conn = get_connection();
$newContentAdded = false;
$ContentDeleted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];

    $query = "UPDATE packagecontactcontent SET title = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $title, $description, $id);
    $stmt->execute();

    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $query = "UPDATE packagecontactcontent SET img = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $target_file, $id);
            $stmt->execute();
        }
    }

    $stmt->close();
    $conn->close();
    
    header("Location: cafePackages.php");  // Redirect back to the page
    exit();
}
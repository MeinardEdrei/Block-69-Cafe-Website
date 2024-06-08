<?php
  include_once './config/connect.php';
  include_once './config/functions.php';

  $conn = get_connection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['item_id']) && isset($_POST['action'])) {
        $item_id = $_POST['item_id'];
        $action = $_POST['action'];
        
        if ($action === 'Approve Order') {
            $status = 'Shipping';
        } elseif ($action === 'To Receive') {
            $status = 'Receiving';
        } elseif ($action === 'Cancel Order') {
            $status = 'Cancelled';
        }
        
        if ($action === 'Approve Order') {
            $stmt_delete = $conn->prepare("DELETE FROM orderitems WHERE status = 'Cancelled'");
            $stmt_delete->execute();
            $stmt_delete->close();
        }

        $stmt = $conn->prepare("UPDATE orderitems SET status = ? WHERE item_id = ?");
        $stmt->bind_param("si", $status, $item_id);
        $stmt->execute();
        $stmt->close();
        
        header("Location: dashboard.php");
        exit();
    }
    }
?>
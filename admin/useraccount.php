<?php 

  include_once './config/connect.php';
  include_once './config/functions.php';

  session_start(); 
  $conn = get_connection();
  $user_data = check_login($conn);
  $user_type = check_usertype($conn);
  $user_accounts = useraccounts($conn);
  $order_details = orderdetails($conn);
  $order_items = orderitems($conn);
  $shippingOrders = shippingOrders($conn);
  $receivingOrders = receivingOrders($conn);
  $completedOrders = completedOrders($conn);
  $cancelledOrders = cancelledOrders($conn);
?>

<title>Account</title>
<?php include('partials/header.php'); ?>
<link rel="stylesheet" href="css/useraccount.css">

<?php 

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}

?>

<div class="userheader">
    <div class="container">
        <div class="sidebar">
            <div class="buttons">
                <div><button><i class="fa-solid fa-store"></i> My Purchase</button></div>
                <!-- <div><button><i class="fa-regular fa-face-smile"></i> My Account</button></div> -->
                <div><a href="contact.php"><i class="fa-solid fa-envelope"></i> Support</a></div>
            </div>
        </div>
        <div class="account">

        </div>
        <div class="purchases">
            <div class="navigationbar">
                <button id="all" class="active">All</button>    
                <button id="to-ship">To Ship</button>
                <button id="to-receive">To Receive</button>
                <!-- <button id="completed">Completed</button> -->
                <button id="cancelled">Cancelled</button>
            </div>
            <?php 
            foreach($order_items as $orderInfo) {
                echo '
                <div class="all">
                    <div class="orderContainer">
                        <img src="'.$orderInfo['item_image'].'" alt="">
                        <div>
                            <h1>'.$orderInfo['item_name'].'</h1>
                            <p>'.$orderInfo['item_category'].'</p>
                            <p style="margin: 1em 0 0 0; font-size: 14px"> Quantity: '.$orderInfo['item_quantity'].'</p>
                        </div>
                    </div>
                </div>
                ';
            }
            foreach($shippingOrders as $shippingOrder) {
                echo '
                <div class="to-ship">
                    <div class="orderContainer">
                        <img src="'.$shippingOrder['item_image'].'" alt="">
                        <div>
                            <h1>'.$shippingOrder['item_name'].'</h1>
                            <p>'.$shippingOrder['item_category'].'</p>
                            <p style="margin: 1em 0 0 0; font-size: 14px"> Quantity: '.$shippingOrder['item_quantity'].'</p>
                            <form action="cancel.php" method="post">
                            <input type="hidden" name="item_id" value="'.$shippingOrder['item_id'].'"> 
                            <input type="submit" name="action" value="Cancel Order">
                            </form>
                        </div>
                    </div>
                </div>
                ';
            }
            foreach($receivingOrders as $receivingOrder) {
                echo '
                <form action="useraccount.php" method="post">
                <div class="to-receive">
                    <div class="orderContainer">
                        <img src="'.$receivingOrder['item_image'].'" alt="">
                        <div>
                            <h1>'.$receivingOrder['item_name'].'</h1>
                            <p>'.$receivingOrder['item_category'].'</p>
                            <p style="margin: 1em 0 0 0; font-size: 14px"> Quantity: '.$receivingOrder['item_quantity'].'</p>
                            <div><input type="submit" name="received" value="Order Received"></div>
                        </div>
                    </div>
                </div>
                </form>
                ';
            }
            foreach($completedOrders as $completedOrder) {
                echo '
                <form action="useraccount.php" method="post">
                <div class="completed">
                    <div class="orderContainer">
                        <img src="'.$completedOrder['item_image'].'" alt="">
                        <div>
                            <h1>'.$completedOrder['item_name'].'</h1>
                            <p>'.$completedOrder['item_category'].'</p>
                            <p style="margin: 1em 0 0 0; font-size: 14px"> Quantity: '.$completedOrder['item_quantity'].'</p>
                        </div>
                    </div>
                </div>
                </form>
                ';
            }
            foreach($cancelledOrders as $cancelledOrder) {
                echo '
                <form action="useraccount.php" method="post">
                <div class="cancelled">
                    <div class="orderContainer">
                        <img src="'.$cancelledOrder['item_image'].'" alt="">
                        <div>
                            <h1>'.$cancelledOrder['item_name'].'</h1>
                            <p>'.$cancelledOrder['item_category'].'</p>
                            <p style="margin: 1em 0 0 0; font-size: 14px"> Quantity: '.$cancelledOrder['item_quantity'].'</p>
                        </div>
                    </div>
                </div>
                </form>
                ';
            }
            ?>
            <div class="refund">
                <div class="container">

                </div>
            </div>
        </div>
    </div>
</div>

<?php 

if(isset($_POST['received']) && !empty($receivingOrder['item_id'])) {
    $item_id = $receivingOrder['item_id']; 
    updateOrderStatus($conn, $item_id, 'Completed'); 

    $query = "DELETE FROM orderitems WHERE status = 'Completed'";
    if (mysqli_query($conn, $query)) {
        echo '<script>
            setTimeout(function() {
                window.location.href = "useraccount.php";
            }, 60000);
            </script>';
    } else {
        echo "Error deleting old completed orders: " . mysqli_error($conn);
    }

    mysqli_close($conn);

}

?>

<script>
var buttons = document.querySelectorAll('.navigationbar button');

document.addEventListener('DOMContentLoaded', function() {
    var toShipItems = document.querySelectorAll('.to-ship');
    toShipItems.forEach(function(item) {
        item.style.display = "none";
    });
    var toReceiveItems = document.querySelectorAll('.to-receive');
    toReceiveItems.forEach(function(toReceiveItems) {
        toReceiveItems.style.display = "none";
    });
    var Completed = document.querySelectorAll('.completed');
    Completed.forEach(function(Completed) {
        Completed.style.display = "none";
    });
    var Cancelled = document.querySelectorAll('.cancelled');
    Cancelled.forEach(function(Cancelled) {
        Cancelled.style.display = "none";
    });
});

buttons.forEach(function(button) {
    button.addEventListener('click', function() {
        buttons.forEach(function(btn) {
            btn.classList.remove('active');
        });

        button.classList.add('active');

        var summary = document.querySelectorAll('.all');
        var toShip = document.querySelectorAll('.to-ship');
        var toReceive = document.querySelectorAll('.to-receive');
        var completed = document.querySelectorAll('.completed');
        var cancelled = document.querySelectorAll('.cancelled');
        var refund = document.querySelectorAll('.refund');
        
        if(button.id === 'all'){
            summary.forEach(function(summary) {
                summary.style.display = "flex";
            });
            toShip.forEach(function(toShip) {
                toShip.style.display = "none";
            });
            toReceive.forEach(function(toReceive) {
                toReceive.style.display = "none";
            });
            completed.forEach(function(completed) {
                completed.style.display = "none";
            });
            cancelled.forEach(function(cancelled) {
                cancelled.style.display = "none";
            });
        }else if(button.id === 'to-ship') {
            summary.forEach(function(summary) {
                summary.style.display = "none";
            });
            toReceive.forEach(function(toReceive) {
                toReceive.style.display = "none";
            });
            toShip.forEach(function(toShip) {
                toShip.style.display = "flex";
            });
            completed.forEach(function(completed) {
                completed.style.display = "none";
            });
            cancelled.forEach(function(cancelled) {
                cancelled.style.display = "none";
            });
        } else if(button.id === 'to-receive') {
            summary.forEach(function(summary) {
                summary.style.display = "none";
            });
            toShip.forEach(function(toShip) {
                toShip.style.display = "none";
            });
            toReceive.forEach(function(toReceive) {
                toReceive.style.display = "flex";
            });
            completed.forEach(function(completed) {
                completed.style.display = "none";
            });
            cancelled.forEach(function(cancelled) {
                cancelled.style.display = "none";
            });
        } else if(button.id === 'completed') {
            summary.forEach(function(summary) {
                summary.style.display = "none";
            });
            toShip.forEach(function(toShip) {
                toShip.style.display = "none";
            });
            toReceive.forEach(function(toReceive) {
                toReceive.style.display = "none";
            });
            completed.forEach(function(completed) {
                completed.style.display = "flex";
            });
            cancelled.forEach(function(cancelled) {
                cancelled.style.display = "none";
            });
        } else if(button.id === 'cancelled') {
            summary.forEach(function(summary) {
                summary.style.display = "none";
            });
            toShip.forEach(function(toShip) {
                toShip.style.display = "none";
            });
            toReceive.forEach(function(toReceive) {
                toReceive.style.display = "none";
            });
            completed.forEach(function(completed) {
                completed.style.display = "none";
            });
            cancelled.forEach(function(cancelled) {
                cancelled.style.display = "flex";
            });
        } else if(button.id === 'refund') {
            summary.forEach(function(summary) {
                summary.style.display = "none";
            });
            toShip.forEach(function(toShip) {
                toShip.style.display = "none";
            });
            toReceive.forEach(function(toReceive) {
                toReceive.style.display = "none";
            });
            completed.forEach(function(completed) {
                completed.style.display = "none";
            });
            cancelled.forEach(function(cancelled) {
                cancelled.style.display = "none";
            });
            refund.forEach(function(refund) {
                refund.style.display = "flex";
            });
        } else {
            var summary = document.querySelectorAll('.all');
            summary.forEach(function(summary) {
                summary.style.display = "block";
            });
        }
    });
});
</script>
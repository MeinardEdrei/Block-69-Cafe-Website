<?php 

  include_once './config/connect.php';
  include_once './config/functions.php';

  session_start(); 
  $conn = get_connection();
  $user_data = check_login($conn);
  $user_type = check_usertype($conn);
  $order_details = adminOrderDetails($conn);
  $order_items = adminOrderItems($conn);

  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
  }

  
?>

<title>Dashboard</title>
<?php include('partials/header.php'); ?>
<link rel="stylesheet" href="css/dashboard.css">

<div class="adminDashboard">
    <div class="navigationPanel">
    <div class="container">
        <img id="logoButton" src="Icons/newlogo.png" onclick="window.location.href='../admin/home.php'" style="cursor: pointer;" alt="">
        <div class="backgroundDesign"></div>
        <button id="dashboardButton" class="active"><i class="fa-solid fa-gauge-simple-high"></i> Dashboard</button>
        <button id="ordersButton"><i class="fa-solid fa-truck"></i> Orders</button>
        <?php if ($user_type == "admin"){
            echo '<button id="usersButton"><i class="fa-solid fa-address-card"></i> Users</button>';
        }?>
        <button id="logoutButton"><i class="fa-solid fa-right-from-bracket"></i><a id="logoutButton" href="sign-out.php"> Logout</a></button>
</div>
    </div>
    <div class="dashboard">
        <div class="container">
            <h3>Hello, <?php echo ucfirst($_SESSION['username']); ?>!</h3>
            <div><h1>Dashboard</h1></div>
            <div class="revenue">
                <div><p>Revenue</p></div>
                <div><h2>PHP 50,000.00</h2></div>
                <div class="percentIncrease"><p>↑ 3.14% vs last week</p></div>
            </div>
            <div>
            <div class="canvas-container">
                <canvas id="myChart1"></canvas>
                <canvas id="myChart2"></canvas>
            </div>
            </div>
        </div>
    </div>
    
    <div class="orders">
        <div class="container">
            <div><h1>Orders</h1></div>
            <div class="order-form">
                <div class="order-container">
                <?php 
                if(empty($order_items)){
                    echo '
                    <div class="emptyOrders">
                    <h1>Theres no orders right now.</h1>
                    </div>
                    ';
                }
                foreach($order_items as $orderInfo) {
                    $buttonLabel = ($orderInfo['status'] === 'Shipping') ? 'To Receive' : 'Approve Order';
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
                        <form action="orders.php" method="post"> 
                            <input type="hidden" name="item_id" value="'.$orderInfo['item_id'].'"> 
                            <input type="submit" name="action" value="'.$buttonLabel.'"> 
                            
                        </form>
                    </div>
                    ';
                }
                ?>
                </div>
                <!-- <input type="submit" name="action" value="Cancel Order"> -->
            </div>
        </div>
    </div>
    
    <form action="dashboard.php" method="post">
    <div id="success" class="success">
        Successfully added user. 
    </div>
    <div id="userdetected" class="success">
        Username is already in use. 
    </div>
    <div class="users">
        <div class="container">
        <div><h1>Users</h1></div>
            <div class="staff">
            <div>
                <canvas id="myChart3"></canvas>
            </div>
            <div class="inputFIeld">
                <div>
                    <select name="status">
                        <option value="staff" selected>Staff</option>
                        <option value="admin">Admin</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>
                <div>
                    <input type="text" name="email" placeholder="Email" autocomplete="off">
                </div>
                <div>
                    <input type="text" name="username" placeholder="Username" autocomplete="off">
                </div>
                <div>
                    <input type="text" name="password" placeholder="Password" autocomplete="off">
                </div>
                <div>
                    <input type="submit" name="submit" value="Create Account">
                </div>
            </div>
            </div>
        </div>
    </div>
    </form>
</div>

<?php 

$conn = get_connection();

if ($_SERVER["REQUEST_METHOD"]=="POST"){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    if(!empty($username) && !empty($email) && !empty($password)){
      $querySelect = "SELECT * FROM useraccounts WHERE username='$username' AND status='$status'";
      $result = mysqli_query($conn, $querySelect);

      if (mysqli_num_rows($result) > 0) {
        echo "<script>
                document.getElementById('userdetected').style.display = 'flex';
                document.addEventListener('click', function() {
                  document.getElementById('userdetected').style.display = 'none';
                });
              </script>";
      }else{
        $query = "INSERT INTO useraccounts (status, username, email, password) VALUES ('$status', '$username', '$email', '$password')";

        mysqli_query($conn, $query);

        echo "<script>
                document.getElementById('success').style.display = 'flex';
                document.addEventListener('click', function() {
                  document.getElementById('success').style.display = 'none';
                });
              </script>";
      }

    }elseif(!empty($username) && empty($email) && !empty($password)){
      echo "Please enter email";
    }elseif(!empty($username) && !empty($email) && empty($password)){
      echo "Please enter password";
    }elseif(empty($username) && !empty($email) && !empty($password)){
      echo "Please enter username";
    }else{
      echo "Please enter username and email and password";
    }
  }
  
?>

<script>
    var buttons = document.querySelectorAll('.navigationPanel button');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            buttons.forEach(function(btn) {
                btn.classList.remove('active');
            });

            if (button.id !== 'logoutButton') {
                button.classList.add('active');
            }

            if(button.id === 'ordersButton') {
                var dashboards = document.querySelectorAll('.dashboard');
                var users = document.querySelectorAll('.users');
                var orders = document.querySelectorAll('.orders');
                dashboards.forEach(function(dashboard) {
                    dashboard.style.display = "none";
                });
                orders.forEach(function(orders) {
                    orders.style.display = "flex";
                });
                users.forEach(function(users) {
                    users.style.display = "none";
                });
            } else if(button.id === 'usersButton') {
                var dashboards = document.querySelectorAll('.dashboard');
                var users = document.querySelectorAll('.users');
                var orders = document.querySelectorAll('.orders');
                dashboards.forEach(function(dashboard) {
                    dashboard.style.display = "none";
                });
                orders.forEach(function(orders) {
                    orders.style.display = "none";
                });
                users.forEach(function(users) {
                    users.style.display = "flex";
                });
            } else if ((button.id === 'logoutButton')){
                var dashboards = document.querySelectorAll('.dashboard');
                var navPanel = document.querySelectorAll('.navigationPanel');
                dashboards.forEach(function(dashboard) {
                    dashboard.style.display = "none";
                });
                navPanel.forEach(function(navPanel) {
                    navPanel.style.display = "none";
                });
            } else {
                var dashboards = document.querySelectorAll('.dashboard');
                dashboards.forEach(function(dashboard) {
                    dashboard.style.display = "block";
                });
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        var nav = document.getElementById("mainNav");

        var listItems = nav.getElementsByTagName("li");

        for (var i = 0; i < listItems.length; i++) {
            listItems[i].style.display = "none";
        }

        document.getElementById('Cart').style.display = "none";
        document.getElementById('Sign-out').style.display = "none";
        document.getElementById('logoButton').style.display = "none";
        
        nav.style.boxSizing = "border-box"; 
        nav.style.boxShadow = "none"; 
        nav.style.width = "0"; 
        nav.style.height = "0"; 
    });


    let chart1 = document.getElementById('myChart1').getContext('2d');
    let popChart1 = new Chart(chart1, {
        type: 'bar',
        data:{
            labels: ['May 26', 'May 27', 'May 28', 'May 29', 'Latest May 29 2024'],
            datasets:[{
                label: 'Sales from 26-29 May, 2024', 
                data: [
                    20000,
                    25000,
                    30000,
                    25000,
                    30500
                ],
                backgroundColor:"black",
                borderColor: "rgba(0,0,255,0.1)",
            }],
            options: {
                legend: {display: false},
                scales: {
                yAxes: [{ticks: {min: 6, max:16}}],
                }
            }
        }
    });

    let chart2 = document.getElementById('myChart2').getContext('2d');
    let popChart2 = new Chart(chart2, {
        type: 'bar',
        data:{
            labels: ['May 26', 'May 27', 'May 28', 'May 29', 'Latest May 29 2024'],
            datasets:[{
                label: 'Blog engagement from 26-29 May, 2024', 
                data: [
                    20000,
                    300000,
                    40000,
                    50000,
                    60000
                ],
                backgroundColor:"black",
                borderColor: "rgba(0,0,255,0.1)",
            }],
            options: {
                legend: {display: false},
                scales: {
                yAxes: [{ticks: {min: 6, max:16}}],
                }
            }
        }
    });

    let chart3 = document.getElementById('myChart3').getContext('2d');
    let popChart3 = new Chart(chart3, {
        type: 'doughnut',
        data:{
            labels: ['Admin', 'Staff', 'Customer'], // Updated labels
            datasets:[
                {
                    label: 'Blog engagement for Admin, Customer, and Staff',
                    data: [
                        2, // Admin data
                        10, // Staff data
                        20 // Cutomer data
                    ],
                    backgroundColor:["#6a040f", "#370617", "#03071e"], 
                    borderColor: "white",
                }
            ],
            options: {
                legend: {display: true}, 
                scales: {
                    yAxes: [{
                        ticks: {min: 0, max: 350000}, 
                        scaleLabel: {
                            display: true,
                            labelString: 'Engagement' 
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'User Type' 
                        }
                    }]
                }
            }
        }
    });

    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
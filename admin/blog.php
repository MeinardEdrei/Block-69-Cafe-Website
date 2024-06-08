<?php 

session_start();
include_once './config/connect.php';
include_once './config/functions.php';

$conn = get_connection();
$user_data = check_login($conn);
$user_type = check_usertype($conn);

if(!($user_type == 'admin' || $user_type == 'staff')){
    echo '<div id="preloader"></div>';
}

include_once('partials/header.php');

?>
<!-- ############################################################################################### -->
<title>Blog</title>
<!--START: ADDING OF BLOG CONTENT-->
    <?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "block69cafe";

    $data = mysqli_connect($host, $user, $password, $database);

    if ($data === false) {
        die("CONNECTION ERROR");
    }

    if (isset($_POST['submit'])) {
        $slider_image_blog = $_FILES['image_blog']['name'];
        $dst = "./blog_db_sliderImages/" . $slider_image_blog;
        $dbSliderImages = "blog_db_sliderImages/" . $slider_image_blog;

        if (move_uploaded_file($_FILES['image_blog']['tmp_name'], $dst)) {
            $query = "INSERT INTO blogslider (blogSliderImage) VALUES ('$dbSliderImages')";
            $result = mysqli_query($data, $query);
            
            if ($result) {
                $_SESSION['blogUploadStatus'] = 'BLOG CONTENT INSERTED SUCCESSFULLY!';
                // Get the last inserted ID
                $blog_last_id = mysqli_insert_id($data);
                $_SESSION['last_inserted_id'] = $blog_last_id;
            } else {
                $_SESSION['blogUploadStatus'] = 'ERROR';
            }
        } else {
            $_SESSION['blogUploadStatus'] = 'ERROR UPLOADING IMAGE';
        }
        header("Location: blog.php");
        exit();
    }
    ?>
<!--END: ADDING OF BLOG CONTENT-->

<!--START: MESSAGE OF UPLOAD SUCCESS-->
    <?php
    if (isset($_SESSION['blogUploadStatus'])) {
        echo '
        <div class="blogMessageSuccess" id="blogMessageSuccess">
            <div class="blogAlertMsg" role="alert">
                <strong><h3>Congratulations!</h3></strong>
                <p>You inserted a new image <b>Successfully!</b></p>
                <img src="Icons/close-button-white.png" class="blogCloseAlertBtn" alt="CLOSE">
            </div>
        </div>
        ';
        unset($_SESSION['blogUploadStatus']);
    }
    ?>
<!--END: MESSAGE OF UPLOAD SUCCESS-->

<div class="BlogAddContainer" id="BlogAddContainer">
    <div class="ToAddContainer">
        <div class="ButtonContainer">
            <?php
            if($user_type == 'admin')
            {
            ?>
            <button type="submit" class="add_blog_btn" onclick="blog_openPopUp()"><i class="fa-solid fa-plus"></i></button>
            <form action="blog-toedit-slider.php" method="post">
                <button type="submit" class="edit_blog_btn"><i class="fa-regular fa-pen-to-square"></i></button>
            </form>
            <?php
            }
            ?>
        </div>

            <!-- START: POPUP and BACKDROP -->
            <div id="blogBackdrop" class="blogBackdrop"></div>
            <div class="blog_PopUp" id="blog_PopUp">
                <form action="blog.php" method="post" enctype="multipart/form-data">
                    <img src="Icons/close-button.png" alt="CLOSE" class="blogClosePopupbtn">
                    <h2>ADD AN IMAGE</h2>
                    <div class="blog-to-add-input">
                        <label for="image_blog">INSERT IMAGE</label>
                        <br>
                        <input type="file" name="image_blog" id="image_blog" required>
                    </div>
                    <div class="submitBtn">
                        <input type="submit" name="submit" value="Upload Data" onclick="blog_closePopUp()">
                    </div>
                </form>
            </div>
            <!-- END: POPUP and BACKDROP -->
    </div>
</div>

<!--START: BACKDROP EFFECT-->
<script>
    let blog_PopUp = document.getElementById("blog_PopUp");
    let blogBackdrop = document.getElementById("blogBackdrop");

    document.addEventListener("DOMContentLoaded", function() {
        let blogMessageSuccess = document.getElementById("blogMessageSuccess");
        if (blogMessageSuccess) {
            document.querySelector(".blogCloseAlertBtn").addEventListener("click", function() {
                blogMessageSuccess.classList.add("hidden"); // Add hidden class for transition effect
                setTimeout(() => blogMessageSuccess.style.display = "none", 500); // Ensure element is removed after transition
            });
        }
    });

    function blog_openPopUp() {
        blog_PopUp.classList.add("blog-open-popup");
        blogBackdrop.classList.add('blogBackdrop-active');
    }

    function blog_closePopUp() {
        blog_PopUp.classList.remove("blog-open-popup");
        blogBackdrop.classList.remove('blogBackdrop-active');
    }

    document.querySelector(".blogClosePopupbtn").addEventListener("click", function() {
        blog_PopUp.classList.remove("blog-open-popup");
        blogBackdrop.classList.remove('blogBackdrop-active');
    });
</script>
<!--END: BACKDROP EFFECT-->

<!--START: IMAGE SLIDER-->
    <?php
    $query = "SELECT * FROM blogslider ORDER BY blogIdNum ASC";
    $result = mysqli_query($data, $query);

    if ($result) {
        echo '
        <section aria-label="Newest Photos">
            <div class="carousel" data-carousel>
                <div class="container">
                    <button class="carousel-button prev" data-carousel-button="prev">&#8249;</button>
                    <button class="carousel-button next" data-carousel-button="next">&#8250;</button>
                    <ul data-slides>
        ';
        
        $firstSlide = true; // Initialize a flag for the first slide

        while ($content = $result->fetch_assoc()) {
            // Check if it's the first slide
            $dataActive = $firstSlide ? 'data-active' : '';
            $firstSlide = false; // After the first iteration, set this to false

            echo '
                <li class="slide" ' . $dataActive . '>
                    <img src="' . $content["blogSliderImage"] . '" alt="Blog Image">
                </li>
            ';
        }
        echo '
                    </ul>
                </div>
            </div>
        </section>
        ';
    } else {
        echo "Error: " . mysqli_error($data);
    }
    mysqli_close($data);
    ?>
<!--END: IMAGE SLIDER-->



<!-- ############################################################################################### -->
<link rel="stylesheet" href="css/blog.css">
<script src="javascript/blog.js" defer></script>


<!--START: DESIGN SLIDER-->
        <!-- <section aria-label="Newest Photos">
            <div class="carousel" data-carousel>
                <div class="container">
                    <button class="carousel-button prev" data-carousel-button = "prev">&#8249;</button>
                    <button class="carousel-button next" data-carousel-button = "next">&#8250;</button>
                        <ul data-slides>
                            <li class="slide" data-active>
                                <img src="images/blog/images (slider)/0.jpg" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/1.png" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/2.png" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/3.png" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/4.jpg" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/5.png" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/6.jpg" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/7.png" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/8.jpg" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/9.jpg" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/10.jpg" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/11.jpg" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/12.jpg" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/13.jpg" alt="">
                            </li>
                            <li class="slide">
                                <img src="images/blog/images (slider)/14.jpg" alt="">
                            </li>
                        </ul>    
                </div>
            </div>
        </section> -->
<!--END: SLIDER-->

<!--START: BLOG CONTENT-->
<div class="BlogMainContainer">
    <div class="BlogDivider">
        <div class="TextContainer blog">
            <h1>Recent Post</h1>
        </div>
        <div class="ButtonContainer">
            <button onclick="window.open('blog-allpost.php', '_self')">SEE ALL</button>
        </div>
        <hr>
    </div>
    
    <div class="BlogContainer">
        <?php
        // Fetch the 6 most recent blog posts
        $query = "SELECT * FROM blogcontents ORDER BY blogIDNum desc LIMIT 6";
        $result = mysqli_query($conn, $query);

        if ($result) {
            while ($content = $result->fetch_assoc()) {
                echo 
                "<div class='indivblog'>
                    <div class='blog-group'>
                        <img height='150' width='150' src='{$content['blogImage']}' alt='Blog Image'>
                        <h2>{$content['blogTitle']}</h2>
                        <form method='post' action='blog-article.php'>
                            <input type='hidden' name='blogID' value='{$content['blogIDNum']}'>
                            <button class='blogReadMore' name='blogIndivArticle'>Read More</button>
                        </form>
                    </div>
                </div>";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        ?>
    </div>
</div>


<!-- HTML FORM OF THE BLOG CONTENT -->
    <!-- <div class="BlogMainContainer">
        <div class="BlogDivider">
            <div class="TextContainer blog">
                <h1>Recent Post</h1>
            </div>
            <div class="ButtonContainer">
                <button onclick="window.open('blog-allpost.php', '_self')">SEE ALL</button>
            </div>
            <hr>
        </div>
        

        <div class="BlogContainer">
            <div class="indivblog">
                <div class="blog-group">
                    <img src="images/blog/images (blog)/1_workshop.png" alt="">
                    <h2>Cafe’s First Workshop: Polymer</h2>
                    <button class='blogReadMore' onclick="window.open('blog-article1.php', '_blank')">Read More</button>    
                </div>
            </div>
            <div class="indivblog">
                <div class="blog-group">
                    <img src="images/blog/images (blog)/2_boardgames.jpg" alt="">
                    <h2>Block 69 Cafe: Board Games</h2>
                    <button class='blogReadMore' onclick="window.open('blog-article2.php', '_blank')">Read More</button>    
                </div>
            </div>
            <div class="indivblog">
                <div class="blog-group">
                    <img src="images/blog/images (blog)/3_newfeatures.png">
                    <h2>Block 69 Cafe: New Features</h2>
                    <button class='blogReadMore' onclick="window.open('blog-article3.php', '_blank')">Read More</button>    
                </div>
            </div>
            

            <div class="indivblog">
                <div class="blog-group">
                    <img src="images/blog/images (blog)/1_workshop.png" alt="">
                    <h2>Cafe’s First Workshop: Polymer</h2>
                    <button class='blogReadMore' onclick="window.open('blog-article1.php', '_blank')">Read More</button>    
                </div>
            </div>
            <div class="indivblog">
                <div class="blog-group">
                    <img src="images/blog/images (blog)/2_boardgames.jpg" alt="">
                    <h2>Block 69 Cafe: Board Games</h2>
                    <button class='blogReadMore' onclick="window.open('blog-article2.php', '_blank')">Read More</button>    
                </div>
            </div>
            <div class="indivblog">
                <div class="blog-group">
                    <img src="images/blog/images (blog)/3_newfeatures.png">
                    <h2>Block 69 Cafe: New Features</h2>
                    <button class='blogReadMore' onclick="window.open('blog-article3.php', '_blank')">Read More</button>    
                </div>
            </div>
        </div>     
	</div> -->
<!-- HTML FORM OF THE BLOG CONTENT -->



<!--END: BLOG CONTENT-->

<?php
//FOOTER
include_once('partials/footer.php');
?>

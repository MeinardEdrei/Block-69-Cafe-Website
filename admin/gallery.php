<?php
include_once './config/connect.php';
include_once './config/functions.php';
include_once './config/content-manage.php';

session_start();
$conn = get_connection();
$user_data = check_login($conn);
$user_type = check_usertype($conn);

//GETTING content
$content_id = 0;
$contentsimages = get_galleryimage($conn);
$contentssection = get_gallerysection($conn);
$contentsvideos1 = get_galleryvideo($conn);

update_image_when_submit($conn);
update_sectionContent_when_submit($conn);
update_video_when_submit($conn);


include_once('partials/header.php');
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="../admin/css/gallery.css">
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<?php
if($user_type == 'admin'){
    echo '
        <div><button class="edit-btnWhite edit-open" data-modal="modal-1" name="edit-btn">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
    ';
}
?>

<section class="bg-white w-full h-full flex flex-col pb-24">
    <div class="flex flex-col gap-8 text-center">
        <div class="w-full h-64 md:h-96 ">
        <?php 

            $img0 = $contentsimages[0]["img"];
            $img0_id = $contentsimages[0]["img_ID"];

            $title0 = $contentssection[0]["title"];
            $desc0 = $contentssection[0]["description"];
            $section0_ID = $contentssection[0]["sectionID"];

            echo '

            <img src="'.$img0.'" alt="Home image" class="w-full h-64 object-cover md:h-96">

            ';
        ?>
        </div>
        <div class="px-16 flex gap-2 flex-col md:px-40">
            <h1 class="text-xl md:text-3xl">
                <?php echo $title0;?>
            </h1>
            <h3 class="font-light text-xs md:text-base">
                <?php echo $desc0;?>
            </h3>
        </div>
    </div>
    <form method='POST' action='./gallery.php' enctype='multipart/form-data'>
        <input hidden name='img_ID' value='<?php echo $img0_id ?>' />
        <input hidden name='sectionID' value='<?php echo $section0_ID ?>' />
        <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50" id="modal-1">
    <div class="bg-stone-800 rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
        <div class="flex justify-end p-4">
            <button class="text-stone-400 hover:text-stone-200" id="close-modal">
                <i class="fa-solid fa-square-xmark" style="color: #ffffff;"></i>
            </button>
        </div>
        <div class="p-6 space-y-6">
            <div class="space-y-4">
                <label class="block text-stone-300 font-medium" for="section1title">Title</label>
                <textarea id="section1title" name="section1title" class="w-full border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-200" rows="3"><?php echo $contentssection[0]["title"]; ?></textarea>
            </div>
            <div class="space-y-4">
                <label class="block text-stone-300 font-medium" for="section1description">Description</label>
                <textarea id="section1description" name="section1description" class="w-full border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-200" rows="5"><?php echo $contentssection[0]["description"]; ?></textarea>
            </div>
            <div class="space-y-4">
                <h1 class="text-stone-300 font-medium">Image displayed:</h1>
                <label class="block text-center text-stone-300 border border-stone-600 p-2 rounded-lg bg-stone-700">
                    <?php echo $img0 ?>
                </label>
                <input type="file" class="block w-full text-stone-300 border border-stone-600 rounded-lg cursor-pointer p-2 bg-stone-700" id="image1" name="file-img">
            </div>
        </div>
        <div class="p-4 bg-stone-700 flex justify-end">
            <button type="submit" class="bg-zinc-500 text-white px-4 py-2 rounded-lg hover:bg-zinc-600">Submit</button>
        </div>
    </div>
</div>
    </form>
</section>
<?php
if($user_type == 'admin'){
    echo '
        <div class="bg-black lg:bg-current"><button class="edit-btnBlack edit-open" data-modal="modal-2" name="edit-btn">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
    ';
}
?>
<section class="bg-black w-full flex items-center flex-col justify-center py-40">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-2/4">
        <?php 
        $img1 = $contentsimages[1]["img"];
        $img1_id = $contentsimages[1]["img_ID"];
        $img2 = $contentsimages[2]["img"];
        $img2_id = $contentsimages[2]["img_ID"];
        $img3 = $contentsimages[3]["img"];
        $img3_id = $contentsimages[3]["img_ID"];
        $img4 = $contentsimages[4]["img"];
        $img4_id = $contentsimages[4]["img_ID"];
        
        echo '
            <img src="'.$img1.'" class="object-cover h-full max-h-60 w-full" alt="">
            <img src="'.$img2.'" class="object-cover h-full max-h-60 md:col-span-2 w-full" alt="">
            <img src="'.$img3.'" class="object-cover h-full max-h-60 md:col-span-2 w-full" alt="">
            <img src="'.$img4.'" class="object-cover h-full max-h-60 w-full" alt="">
        ';
        ?>
    </div>
    <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 overflow-y-auto" id="modal-2">
    <div class="bg-stone-800 rounded-lg overflow-hidden shadow-xl transform transition-all max-w-3xl w-full mx-4 my-8">
        <div class="flex justify-end p-4">
            <button class="text-stone-400 hover:text-stone-200" id="close-modal-2">
                <i class="fa-solid fa-square-xmark" style="color: #ffffff;"></i>
            </button>
        </div>
        <form method='POST' action='./gallery.php' enctype='multipart/form-data'>
            <input hidden name='img_ID1' value='<?php echo $img1_id ?>' />
            <input hidden name='img_ID2' value='<?php echo $img2_id ?>' />
            <input hidden name='img_ID3' value='<?php echo $img3_id ?>' />
            <input hidden name='img_ID4' value='<?php echo $img4_id ?>' />
            <div class="flex flex-col gap-6 py-8 px-12 md:px-16 lg:px-24">
                <h1 class="text-stone-300 font-medium">Images displayed:</h1>
                <div class="flex gap-4 flex-col">
                    <div class="flex gap-4 items-center">
                        <label class="block text-center text-stone-300 border border-stone-600 p-3 rounded-lg bg-stone-700 w-full overflow-hidden">
                            <?php echo $img1 ?>
                        </label>
                        <input type="file" class="block w-full text-stone-300 border border-stone-600 rounded-lg cursor-pointer p-3 bg-stone-700" id="image2" name="file-img1">
                    </div>
                    <div class="flex gap-4 items-center">
                        <label class="block text-center text-stone-300 border border-stone-600 p-3 rounded-lg bg-stone-700 w-full overflow-hidden">
                            <?php echo $img2 ?>
                        </label>
                        <input type="file" class="block w-full text-stone-300 border border-stone-600 rounded-lg cursor-pointer p-3 bg-stone-700" id="image3" name="file-img2">
                    </div>
                    <div class="flex gap-4 items-center">
                        <label class="block text-center text-stone-300 border border-stone-600 p-3 rounded-lg bg-stone-700 w-full overflow-hidden">
                            <?php echo $img3 ?>
                        </label>
                        <input type="file" class="block w-full text-stone-300 border border-stone-600 rounded-lg cursor-pointer p-3 bg-stone-700" id="image4" name="file-img3">
                    </div>
                    <div class="flex gap-4 items-center">
                        <label class="block text-center text-stone-300 border border-stone-600 p-3 rounded-lg bg-stone-700 w-full overflow-hidden">
                            <?php echo $img4 ?>
                        </label>
                        <input type="file" class="block w-full text-stone-300 border border-stone-600 rounded-lg cursor-pointer p-3 bg-stone-700" id="image5" name="file-img4">
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type='submit' class="bg-zinc-500 text-white px-5 py-2 rounded-lg hover:bg-zinc-600">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

</section>

<?php
if($user_type == 'admin'){
    echo '
        <div><button class="edit-btnWhite edit-open" data-modal="modal-3" name="edit-btn">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
    ';
}
?>
<section class="bg-white w-full flex items-center justify-center py-40">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-2/4">
    <?php 

    $img5 = $contentsimages[5]["img"];
    $img5_id = $contentsimages[5]["img_ID"];
    $img6 = $contentsimages[6]["img"];
    $img6_id = $contentsimages[6]["img_ID"];
    $img7 = $contentsimages[7]["img"];
    $img7_id = $contentsimages[7]["img_ID"];
    $img8 = $contentsimages[8]["img"];
    $img8_id = $contentsimages[8]["img_ID"];

    echo '
    
        <img src="'.$img5. '" class="object-cover h-full max-h-60 w-full" alt="">
        <img src="'.$img6. '" class="object-cover h-full max-h-60 md:col-span-2 w-full" alt="">
        <img src="'.$img7. '" class="object-cover h-full max-h-60 md:col-span-2 w-full" alt="">
        <img src="'.$img8. '" class="object-cover h-full max-h-60 w-full" alt="">
    
    ';
    ?>
    <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 overflow-y-auto" id="modal-3">
    <div class="bg-stone-800 rounded-lg overflow-hidden shadow-xl transform transition-all max-w-3xl w-full mx-4 my-8">
        <div class="flex justify-end p-4">
            <button class="text-stone-400 hover:text-stone-200" id="close-modal-3">
                <i class="fa-solid fa-square-xmark" style="color: #ffffff;"></i>
            </button>
        </div>
        <form method='POST' action='./gallery.php' enctype='multipart/form-data'>
            <input hidden name='img_ID5' value='<?php echo $img5_id ?>' />
            <input hidden name='img_ID6' value='<?php echo $img6_id ?>' />
            <input hidden name='img_ID7' value='<?php echo $img7_id ?>' />
            <input hidden name='img_ID8' value='<?php echo $img8_id ?>' />
            <div class="flex flex-col gap-6 py-8 px-12 md:px-16 lg:px-24">
                <h1 class="text-stone-300 font-medium">Images displayed:</h1>
                <div class="flex gap-4 flex-col">
                    <div class="flex gap-4 items-center">
                        <label class="block text-center text-stone-300 border border-stone-600 p-3 rounded-lg bg-stone-700 w-full overflow-hidden">
                            <?php echo $img5 ?>
                        </label>
                        <input type="file" class="block w-full text-stone-300 border border-stone-600 rounded-lg cursor-pointer p-3 bg-stone-700" id="image6" name="file-img5">
                    </div>
                    <div class="flex gap-4 items-center">
                        <label class="block text-center text-stone-300 border border-stone-600 p-3 rounded-lg bg-stone-700 w-full overflow-hidden">
                            <?php echo $img6 ?>
                        </label>
                        <input type="file" class="block w-full text-stone-300 border border-stone-600 rounded-lg cursor-pointer p-3 bg-stone-700" id="image7" name="file-img6">
                    </div>
                    <div class="flex gap-4 items-center">
                        <label class="block text-center text-stone-300 border border-stone-600 p-3 rounded-lg bg-stone-700 w-full overflow-hidden">
                            <?php echo $img7 ?>
                        </label>
                        <input type="file" class="block w-full text-stone-300 border border-stone-600 rounded-lg cursor-pointer p-3 bg-stone-700" id="image8" name="file-img7">
                    </div>
                    <div class="flex gap-4 items-center">
                        <label class="block text-center text-stone-300 border border-stone-600 p-3 rounded-lg bg-stone-700 w-full overflow-hidden">
                            <?php echo $img8 ?>
                        </label>
                        <input type="file" class="block w-full text-stone-300 border border-stone-600 rounded-lg cursor-pointer p-3 bg-stone-700" id="image9" name="file-img8">
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type='submit' class="bg-zinc-500 text-white px-5 py-2 rounded-lg hover:bg-zinc-600">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>


</section>

<?php
if($user_type == 'admin'){
    echo '
        <div class="bg-black lg:bg-current"><button class="edit-btnBlack edit-open" data-modal="modal-4" name="edit-btn">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
    ';
}
?>
<section class="bg-black w-full flex items-center justify-center py-40">
    <div class="flex flex-col items-center justify-center md:flex-row">
        <div class="hidden items-center justify-center p-10 md:block">
        <?php

            $vid1 = $contentsvideos1[0]["video"];
            $vid0_id = $contentsvideos1[0]["vidID"];
            $section1_ID = $contentssection[1]["sectionID"];

            echo '
                <video src="'.$vid1.'" muted controls></video>
            ';

        ?>
        </div>
        <div class="flex flex-col items-center justify-center p-10">
            <div class="lg:px-16">
                <h1 class="text-white text-center text-2xl py-3 px-7 md:text-3xl">
                    <?php
                        echo $contentssection[1]["title"];
                    ?>
                </h1>
            </div>
            <h3 class="text-white  font-light text-sm text-center md:text-base md:text-justify">
                <?php
                    echo $contentssection[1]["description"];
                ?>
            </h3>
        </div>
        <div class="flex block items-center justify-center p-10 md:hidden">
            <?php

            echo '
                <video src="'.$vid1.'" muted controls></video>
            ';

            ?>
        </div>
    </div>
    <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 overflow-y-auto" id="modal-4">
    <div class="bg-stone-800 rounded-lg overflow-hidden shadow-xl transform transition-all max-w-3xl w-full mx-4 my-8">
        <div class="flex justify-end p-4">
            <button class="text-stone-400 hover:text-stone-200" id="close-modal-4">
                <i class="fa-solid fa-square-xmark" style="color: #ffffff;"></i>
            </button>
        </div>
        <form method='POST' action='./gallery.php' enctype='multipart/form-data'>
            <input hidden name='vid_ID' value='<?php echo $vid0_id ?>' />
            <input hidden name='sectionID' value='<?php echo $section1_ID ?>' />
            <div class="flex flex-col gap-4 py-10 px-10 md:px-20 lg:px-40">
                <div class="flex gap-4">
                    <label class="text-stone-300 custom-file-upload" for="section1title">Title</label>
                    <input type="text" id="section2title" name="section1title" value="<?php echo $contentssection[1]["title"]; ?>" class="border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-300">
                </div>
                <div class="flex gap-4">
                    <label class="text-stone-300 custom-file-upload" for="section1description">Description</label>
                    <textarea id="section2description" name="section1description" class="border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-300"><?php echo $contentssection[1]["description"]; ?></textarea>
                </div>
                <div class="flex gap-4 flex-col">
                    <label class="text-center text-stone-300 custom-file-upload border border-stone-600 p-3 rounded-lg bg-stone-700 w-full overflow-hidden"><?php echo $vid1 ?></label>
                    <input type="file" class="block w-full text-stone-300 border border-stone-600 rounded-lg cursor-pointer p-3 bg-stone-700" id="video1" name="file-vid">
                </div>
                <div class="flex justify-end mt-6">
                    <button type='submit' class="bg-zinc-500 text-white px-5 py-2 rounded-lg hover:bg-zinc-600">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

</section>

<?php
if($user_type == 'admin'){
    echo '
        <div><button class="edit-btnWhite edit-open" data-modal="modal-5" name="edit-btn">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
    ';
}
?>
<section class="bg-white w-full flex items-center justify-center py-20">
    <div class="flex flex-col items-center justify-center gap-10 px-20">
        <div class="">
            <h1 class="text-black text-center text-2xl pb-3">
                <?php
                    echo $contentssection[2]["title"];
                ?>
            </h1>
            <h3 class="text-black text-center font-light pb-3">
                <?php
                    echo $contentssection[2]["description"];
                ?>
            </h3>
        </div>
        <div class="grid grid-cols-1 auto-rows-auto grid-flow-cols gap-5 md:grid-cols-3 md:grid-row-2 grid-flow-cols md:gap-4">
            <?php
                $vid2 = $contentsvideos1[1]["video"];
                $vid1_id = $contentsvideos1[1]["vidID"];
                $vid3 = $contentsvideos1[2]["video"];
                $vid2_id = $contentsvideos1[2]["vidID"];
                $vid4 = $contentsvideos1[3]["video"];
                $vid3_id = $contentsvideos1[3]["vidID"];
                $vid5 = $contentsvideos1[4]["video"];
                $vid4_id = $contentsvideos1[4]["vidID"];
                $vid6 = $contentsvideos1[5]["video"];
                $vid5_id = $contentsvideos1[5]["vidID"];
                $vid7 = $contentsvideos1[6]["video"];
                $vid6_id = $contentsvideos1[6]["vidID"];
                $section2_ID = $contentssection[2]["sectionID"];

                echo '
                <div class="w-56 md:w-40 lg:w-56">
                    <video src="'.$vid2.'" loop autoplay muted controls></video>
                </div>
                <div class="w-56 md:w-40 lg:w-56">
                    <video src="'.$vid3.'" loop autoplay muted controls></video>
                </div>
                <div class="w-56 md:w-40 lg:w-56">
                    <video src="'.$vid4.'" loop autoplay muted controls></video>
                </div>
                <div class="w-56 md:w-40 lg:w-56">
                    <video src="'.$vid5.'" loop autoplay muted controls></video>
                </div>
                <div class="w-56 md:w-40 lg:w-56">
                    <video src="'.$vid6.'" loop autoplay muted controls></video>
                </div>
                <div class="w-56 md:w-40 lg:w-56">
                    <video src="'.$vid7.'" loop autoplay muted controls></video>
                </div>
                ';
            ?>
        </div>
    </div>
    <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 overflow-y-auto" id="modal-5">
    <div class="bg-stone-800 rounded-lg overflow-hidden shadow-xl transform transition-all max-w-3xl w-full mx-4 my-8">
        <div class="flex justify-end p-4">
            <button class="text-stone-400 hover:text-stone-200" id="close-modal-5">
                <i class="fa-solid fa-square-xmark" style="color: #ffffff;"></i>
            </button>
        </div>
        <form method='POST' action='./gallery.php' enctype='multipart/form-data'>
            <input hidden name='sectionID' value='<?php echo $section2_ID ?>' />
            <input hidden name='vid_ID1' value='<?php echo $vid1_id ?>' />
            <input hidden name='vid_ID2' value='<?php echo $vid2_id ?>' />
            <input hidden name='vid_ID3' value='<?php echo $vid3_id ?>' />
            <input hidden name='vid_ID4' value='<?php echo $vid4_id ?>' />
            <input hidden name='vid_ID5' value='<?php echo $vid5_id ?>' />
            <input hidden name='vid_ID6' value='<?php echo $vid6_id ?>' />
            <div class="flex flex-col gap-4 py-10 px-10 md:px-20 lg:px-40">
                <div class="flex gap-2">
                    <label class="text-stone-300 custom-file-upload text-xs" for="section1title">Title</label>
                    <input type="text" id="section1title text-xs" name="section1title" value="<?php echo $contentssection[2]["title"]; ?>" class="border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-300">
                </div>
                <div class="flex gap-2">
                    <label class="text-stone-300 custom-file-upload text-xs" for="section1description">Description</label>
                    <textarea id="section1description text-xs" name="section1description" style="height: 50px;" class="border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-300"><?php echo $contentssection[2]["description"]; ?></textarea>
                </div>
                <div class="flex gap-2 flex-col">
                    <label class="text-left text-stone-300 custom-file-upload border border-stone-600 p-1 text-xs" for="vid1"><?php echo $vid2 ?></label>
                    <input type="file" class="inputfile text-stone-300 text-xs" id="vid2" name="file-vid1">
                </div>
                <div class="flex gap-2 flex-col">
                    <label class="text-left text-stone-300 custom-file-upload border border-stone-600 p-1 text-xs" for="vid1"><?php echo $vid3 ?></label>
                    <input type="file" class="inputfile text-stone-300 text-xs" id="vid3" name="file-vid2">
                </div>
                <div class="flex gap-2 flex-col">
                    <label class="text-left text-stone-300 custom-file-upload border border-stone-600 p-1 text-xs" for="vid1"><?php echo $vid4 ?></label>
                    <input type="file" class="inputfile text-stone-300 text-xs" id="vid4" name="file-vid3">
                </div>
                <div class="flex gap-2 flex-col">
                    <label class="text-left text-stone-300 custom-file-upload border border-stone-600 p-1 text-xs" for="vid1"><?php echo $vid5 ?></label>
                    <input type="file" class="inputfile text-stone-300 text-xs" id="vid5" name="file-vid4">
                </div>
                <div class="flex gap-2 flex-col">
                    <label class="text-left text-stone-300 custom-file-upload border border-stone-600 p-1 text-xs" for="vid1"><?php echo $vid6 ?></label>
                    <input type="file" class="inputfile text-stone-300 text-xs" id="vid6" name="file-vid5">
                </div>
                <div class="flex gap-2 flex-col">
                    <label class="text-left text-stone-300 custom-file-upload border border-stone-600 p-1 text-xs" for="vid1"><?php echo $vid7 ?></label>
                    <input type="file" class="inputfile text-stone-300 text-xs" id="vid7" name="file-vid6">
                </div>
                <div class="flex justify-end mt-6">
                    <button type='submit' class="bg-zinc-500 text-white px-5 py-2 rounded-lg hover:bg-zinc-600">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

</section>

<?php include('partials/footer.php'); ?>

<script>
document.querySelectorAll('.edit-open').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        var modalId = this.getAttribute('data-modal');
        document.getElementById(modalId).style.display = 'flex';
    });
});

document.getElementById('close-modal-2').addEventListener('click', function() {
    this.closest('.fixed').style.display = 'none';
});

document.getElementById('close-modal-3').addEventListener('click', function() {
    this.closest('.fixed').style.display = 'none';
});

document.getElementById('close-modal-4').addEventListener('click', function() {
    this.closest('.fixed').style.display = 'none';
});

document.getElementById('close-modal-5').addEventListener('click', function() {
    this.closest('.fixed').style.display = 'none';
});
</script>


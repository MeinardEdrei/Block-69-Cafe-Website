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
$packagesection = get_packagesection($conn);

update_section_and_image_of_package($conn);

include_once('partials/header.php');
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../admin/css/gallery.css">
<script src="https://cdn.tailwindcss.com"></script>

<?php
if($user_type == 'admin'){
    echo '
        <div><button class="edit-btnWhite edit-open" data-modal="modal-1" name="edit-btn">Edit Content <i class="fa-regular fa-pen-to-square"></i></button></div>
    ';
}
?>

<section class="bg-white w-full h-full flex flex-col pb-24">
    <div class="flex flex-col gap-7 text-center">
        <div class="w-full h-64 md:h-96">
            <?php 
                $img0 = $packagesection[0]["packageimage"];
                $title0 = $packagesection[0]["packagetitle"];
                $desc0 = $packagesection[0]["packagedescription"];
                $id0 = $packagesection[0]["packageid"];
                

                echo '<img src="' . $img0 . '" alt="Home image" class="w-full h-64 object-cover md:h-96">';
            ?>
        </div>
        <div class="px-10 flex flex-col gap-3 md:px-20">
            <h1 class="text-xl font-semibold md:text-3xl">
            <?php echo $title0; ?>
            </h1>
            <h3 class="text-xs font-normal md:text-base">
            <?php echo $desc0; ?> 
            </h3>
        </div>
    </div>
    <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 overflow-y-auto" id="modal-1">
    <div class="bg-stone-800 rounded-lg overflow-hidden shadow-xl transform transition-all max-w-3xl w-full mx-4 my-8">
        <div class="flex justify-end p-4">
            <button class="text-stone-400 hover:text-stone-200" id="close-modal-1">
                <i class="fa-solid fa-square-xmark" style="color: #ffffff;"></i>
            </button>
        </div>
        <form method='POST' action='./packages.php' enctype='multipart/form-data'>
            <input hidden name='sectionID' value='<?php echo $id0 ?>' />
            <div class="flex flex-col gap-4 bg-black py-10 px-10 md:px-20 lg:px-40">
                <div class="flex flex-col gap-4">
                    <label class="text-stone-300 custom-file-upload" for="section1title">Title</label>
                    <textarea id="section1title" name="section1title" class="border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-300"><?php echo $packagesection[0]["packagetitle"]; ?></textarea>
                </div>
                <div class="flex flex-col gap-4">
                    <label class="text-stone-300 custom-file-upload" for="section1description">Description</label>
                    <textarea id="section1description" name="section1description" class="border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-300"><?php echo $packagesection[0]["packagedescription"]; ?></textarea>
                </div>
                <div class="flex gap-4 flex-col">
                    <h1 class="text-stone-300">Image displayed:</h1>
                    <div class="overflow-hidden">
                        <label class="text-left text-stone-300 custom-file-upload border border-stone-600 p-1">
                            <?php echo $img0 ?>
                        </label>
                    </div>
                    <input type="file" class="inputfile text-stone-300" id="image1" name="file-img">
                </div>
                <div class="flex justify-end mt-6">
                    <button type='submit' class="bg-zinc-500 text-white px-5 py-2 rounded-lg hover:bg-zinc-600">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

</section>

<section class="flex justify-center w-full h-full flex pb-24">
    <div class="flex justify-center">
        <div class="flex flex-col w-4/5 gap-5 pt-1 md:flex-row md:pt-24">
            <div class="relative flex flex-col w-auto h-auto border-black border-2 rounded-lg text-center items-center p-5">
                <?php 
                    $img1 = $packagesection[1]["packageimage"];
                    $title1 = $packagesection[1]["packagetitle"];
                    $desc1 = $packagesection[1]["packagedescription"];
                    $id1 = $packagesection[1]["packageid"];
                    echo '<img src="' . $img1 . '" alt="Home image" class="w-1/5 mb-5">'; 
                ?>
                <h1 class="text-xl mb-4 font-semibold md:text-3xl md:text-3xl">
                    <?php echo $title1; ?>
                </h1>
                <h3 class="font-light px-6 text-xs md:text-normal lg:px-11 md:text-base">
                    <?php echo $desc1; ?>
                </h3>
                <a href="cafePackages.php" class="w-1/5 bg-white text-black border-black border-2 rounded p-1 mt-3 hover:bg-black lg:p-3 hover:text-white">More</a>
                <?php
                if($user_type == 'admin'){
                    echo '
                    <button data-modal="modal-2" name="edit-btn" class="edit-open px-5 border-white border-2 absolute top-2 right-2 bg-black text-white rounded p-2 hover:bg-white hover:text-black hover:border-2 hover:border-black">Edit</button>
                    ';
                }
                ?>
            </div>

            <div class="relative flex flex-col w-auto h-auto border-black border-2 rounded-lg text-center items-center p-5">
                <?php 
                    $img2 = $packagesection[2]["packageimage"];
                    $title2 = $packagesection[2]["packagetitle"];
                    $desc2 = $packagesection[2]["packagedescription"];
                    $id2 = $packagesection[2]["packageid"];
                    echo '<img src="' . $img2 . '" alt="Home image" class="w-1/5 mb-5">'; 
                ?>
                <h1 class="text-xl mb-4 font-semibold md:text-3xl">
                    <?php echo $title2; ?>
                </h1>
                <h3 class="font-light px-6 text-xs md:text-normal lg:px-11 md:text-base">
                    <?php echo $desc2; ?>
                </h3>
                <a href="cateringServices.php" class="w-1/5 bg-white text-black border-black border-2 rounded p-1 mt-3 hover:bg-black lg:p-3 hover:text-white">More</a>
                <?php
                if($user_type == 'admin'){
                    echo '
                    <button data-modal="modal-3" name="edit-btn" class="edit-open px-5 border-white border-2 absolute top-2 right-2 bg-black text-white rounded p-2 hover:bg-white hover:text-black hover:border-2 hover:border-black">Edit</button>
                    ';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<div class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 overflow-y-auto" id="modal-2">
    <div class="bg-stone-800 rounded-lg overflow-hidden shadow-xl transform transition-all max-w-3xl w-full mx-4 my-8">
        <div class="flex justify-end p-4">
            <button class="text-stone-400 hover:text-stone-200" id="close-modal-2">
                <i class="fa-solid fa-square-xmark" style="color: #ffffff;"></i>
            </button>
        </div>
        <form method='POST' action='./packages.php' enctype='multipart/form-data'>
            <input hidden name='sectionID' value='<?php echo $id1 ?>' />
            <div class="flex flex-col gap-4 bg-black py-10 px-10 md:px-20 lg:px-40">
                <div class="flex flex-col gap-4">
                    <label class="text-stone-300 custom-file-upload" for="section1title">Title</label>
                    <textarea id="section2title" name="section1title" class="border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-300"><?php echo $packagesection[1]["packagetitle"]; ?></textarea>
                </div>
                <div class="flex flex-col gap-4">
                    <label class="text-stone-300 custom-file-upload" for="section1description">Description</label>
                    <textarea id="section2description" name="section1description" class="border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-300"><?php echo $packagesection[1]["packagedescription"]; ?></textarea>
                </div>
                <div class="flex gap-4 flex-col">
                    <h1 class="text-stone-300">Image displayed:</h1>
                    <label class="text-center text-stone-300 custom-file-upload border border-stone-600 p-1">
                        <?php echo $img1 ?>
                    </label>
                    <input type="file" class="inputfile text-stone-300" id="image1" name="file-img">
                </div>
                <div class="flex justify-end mt-6">
                    <button type='submit' class="bg-zinc-500 text-white px-5 py-2 rounded-lg hover:bg-zinc-600">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 overflow-y-auto" id="modal-3">
    <div class="bg-stone-800 rounded-lg overflow-hidden shadow-xl transform transition-all max-w-3xl w-full mx-4 my-8">
        <div class="flex justify-end p-4">
            <button class="text-stone-400 hover:text-stone-200" id="close-modal-3">
                <i class="fa-solid fa-square-xmark" style="color: #ffffff;"></i>
            </button>
        </div>
        <form method='POST' action='./packages.php' enctype='multipart/form-data'>
            <input hidden name='sectionID' value='<?php echo $id2 ?>' />
            <div class="flex flex-col gap-4 bg-black py-10 px-10 md:px-20 lg:px-40">
                <div class="flex flex-col gap-4">
                    <label class="text-stone-300 custom-file-upload" for="section1title">Title</label>
                    <textarea id="section3title" name="section1title" class="border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-300"><?php echo $packagesection[2]["packagetitle"]; ?></textarea>
                </div>
                <div class="flex flex-col gap-4">
                    <label class="text-stone-300 custom-file-upload" for="section1description">Description</label>
                    <textarea id="section3description" name="section1description" class="border border-stone-600 rounded-lg p-2 bg-stone-700 text-stone-300"><?php echo $packagesection[2]["packagedescription"]; ?></textarea>
                </div>
                <div class="flex gap-4 flex-col">
                    <h1 class="text-stone-300">Image displayed:</h1>
                    <label class="text-center text-stone-300 custom-file-upload border border-stone-600 p-1">
                        <?php echo $img2 ?>
                    </label>
                    <input type="file" class="inputfile text-stone-300" id="image1" name="file-img">
                </div>
                <div class="flex justify-end mt-6">
                    <button type='submit' class="bg-zinc-500 text-white px-5 py-2 rounded-lg hover:bg-zinc-600">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>

<script>
document.querySelectorAll('.edit-open').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        var modalId = this.getAttribute('data-modal');
        document.getElementById(modalId).style.display = 'flex';
    });
});

document.querySelectorAll('.close').forEach(function(element) {
    element.addEventListener('click', function() {
        this.closest('.bg-modal').style.display = 'none';
    });
});

document.getElementById('close-modal-2').addEventListener('click', function() {
    this.closest('.fixed').style.display = 'none';
});

document.getElementById('close-modal-3').addEventListener('click', function() {
    this.closest('.fixed').style.display = 'none';
});
</script>

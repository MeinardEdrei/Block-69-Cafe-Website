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
$cateringservicestable = get_cateringservicestable($conn);
$cateringservicescontent = get_cateringservicescontent($conn);
$packagecontactcontent = get_packagecontactcontent($conn);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_row'])) {
    $id = $_POST['id'];
    $pax = $_POST['pax'];
    $cps = $_POST['cps'];
    $ct = $_POST['ct'];
    $ck = $_POST['ck'];
    $pt = $_POST['pt'];
    $pk = $_POST['pk'];
    $silog = $_POST['silog'];
    $pasta = $_POST['pasta'];

    $query = "UPDATE cateringservicestable SET pax='$pax', cps='$cps', ct='$ct', ck='$ck', pt='$pt', pk='$pk', silog='$silog', pasta='$pasta' WHERE id='$id'";
    mysqli_query($conn, $query);
    exit;
}

if (isset($_POST['update_title_description'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $query = "UPDATE cateringservicescontent SET title='$title', description='$description' WHERE id='$id'";
    mysqli_query($conn, $query);
    exit;
}

include_once('partials/header.php');
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.8);
    }

    .modal-content {
        background-color: #000;
        color: #fff;
        margin: 10% auto;
        padding: 30px;
        border-radius: 10px;
        max-width: 500px;
        width: 90%;
    }

    .close {
        color: #999;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .close:hover, .close:focus {
        color: #fff;
        text-decoration: none;
    }

    .modal form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .modal label {
        font-size: 18px;
        font-weight: bold;
    }

    .modal input[type="text"], .modal textarea {
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        resize: none;
    }

    .modal input[type="file"] {
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
        cursor: pointer;
    }

    .modal button[type="submit"] {
        background-color: #555;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 12px 20px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        align-self: flex-start;
    }

    .modal button[type="submit"]:hover {
        background-color: #777;
    }
</style>

<section class="flex flex-col gap-16 items-center">
    <div class="flex flex-col gap-3 items-center">
        <div class="flex flex-col gap-3 text-center items-center" <?php if ($user_type == 'admin') echo 'contenteditable="true"'; ?>>
            <h1 class="text-3xl font-bold">
                <?php echo $cateringservicescontent[0]["title"]; ?>
            </h1>
            <h3 class="font-light">
                <?php echo $cateringservicescontent[0]["description"]; ?>
            </h3>
        </div>
        <div class="">
            <?php if ($user_type == 'admin') { ?>
                    <button class="saveTitleDescription bg-black text-white px-4 py-2 rounded-lg">Save Title & Description</button>
            <?php } ?>
        </div>
    </div>
    <div class="flex flex-col justify-center items-center">
        <table class="w-1/5 text-center md:w-4/5">
            <thead>
                <tr>
                    <th class="border-black border-2 text-sm p-[2px] md:text-base md:p-5"><h1>Pax</h1></th>
                    <th class="border-black border-2 text-sm p-[2px] md:text-base md:p-5"><h1>Chicken Poppers savor + Bottled water</h1></th>
                    <th class="border-black border-2 text-sm p-[2px] md:text-base md:p-5"><h1>Chicken Teriyaki + Bottled water</h1></th>
                    <th class="border-black border-2 text-sm p-[2px] md:text-base md:p-5"><h1>Chicken Katsudon + Bottled water</h1></th>
                    <th class="border-black border-2 text-sm p-[2px] md:text-base md:p-5"><h1>Pork Teriyaki + Bottled water</h1></th>
                    <th class="border-black border-2 text-sm p-[2px] md:text-base md:p-5"><h1>Pork Katsudon + Bottled water</h1></th>
                    <th class="border-black border-2 text-sm p-[2px] md:text-base md:p-5"><h1>Silog + Bottled water</h1></th>
                    <th class="border-black border-2 text-sm p-[2px] md:text-base md:p-5"><h1>Pasta + Garlic Bread + Bottled water</h1></th>
                    <?php if ($user_type == 'admin') { ?>
                        <th class="border-black border-2 text-sm p-[2px] md:text-base md:p-5">Edit Content</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cateringservicestable as $row) { ?>
                    <tr data-id="<?php echo $row['id']; ?>">
                        <td class="border-black border-2 text-sm p-[2px] md:text-base md:p-5" <?php if ($user_type == 'admin') echo 'contenteditable="true"'; ?>><?php echo $row["pax"]; ?></td>
                        <td class="border-black border-2 text-sm p-[2px] md:text-base md:p-5" <?php if ($user_type == 'admin') echo 'contenteditable="true"'; ?>><?php echo $row["cps"]; ?></td>
                        <td class="border-black border-2 text-sm p-[2px] md:text-base md:p-5" <?php if ($user_type == 'admin') echo 'contenteditable="true"'; ?>><?php echo $row["ct"]; ?></td>
                        <td class="border-black border-2 text-sm p-[2px] md:text-base md:p-5" <?php if ($user_type == 'admin') echo 'contenteditable="true"'; ?>><?php echo $row["ck"]; ?></td>
                        <td class="border-black border-2 text-sm p-[2px] md:text-base md:p-5" <?php if ($user_type == 'admin') echo 'contenteditable="true"'; ?>><?php echo $row["pt"]; ?></td>
                        <td class="border-black border-2 text-sm p-[2px] md:text-base md:p-5" <?php if ($user_type == 'admin') echo 'contenteditable="true"'; ?>><?php echo $row["pk"]; ?></td>
                        <td class="border-black border-2 text-sm p-[2px] md:text-base md:p-5" <?php if ($user_type == 'admin') echo 'contenteditable="true"'; ?>><?php echo $row["silog"]; ?></td>
                        <td class="border-black border-2 text-sm p-[2px] md:text-base md:p-5" <?php if ($user_type == 'admin') echo 'contenteditable="true"'; ?>><?php echo $row["pasta"]; ?></td>
                        <?php if ($user_type == 'admin') { ?>
                            <td class="border-black border-2 text-sm p-[2px] md:text-base md:p-5">
                                <button class="saveRow bg-black text-white px-2 py-1 rounded-lg md:px-4 md:py-2">Save</button>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="flex flex-col justify-center items-center mt-36">
    <div class="flex items-center justify-center">
        <h1 class="text-4xl font-bold">
            <?php echo $packagecontactcontent[3]["title"]; ?>
        </h1>
    </div>
    <div class="flex flex-col justify-center items-center gap-1 w-2/4 md:flex-row">
        <div class="flex flex-col justify-center items-center p-8">
            <?php 
            $img1 = $packagecontactcontent[0]["img"];
            $title1 = $packagecontactcontent[0]["title"];
            $desc1 = $packagecontactcontent[0]["description"];
            ?>
            <div class="flex flex-row justify-center items-center">
                <img src="<?php echo $img1?>" alt="" class="w-2/5 mb-5">
            </div>
            <div class="">
                <h1 class="text-3xl font-bold text-center">
                    <?php echo $title1 ?>
                </h1>
            </div>
            <div class="">
                <h3 class="text-center">
                    <?php echo $desc1 ?>
                </h3>
            </div>
            <div>
                <?php
                if($user_type == 'admin'){
                    echo '<button class="bg-black text-white px-4 py-2 rounded-lg" data-model="modal-1">Edit</button>';
                }
                ?>
            </div>
        </div>
        <div class="flex flex-col justify-center items-center p-8">
            <?php 
            $img2 = $packagecontactcontent[1]["img"];
            $title2 = $packagecontactcontent[1]["title"];
            $desc2 = $packagecontactcontent[1]["description"];
            ?>
            <div class="flex flex-row justify-center items-center">
                <img src="<?php echo $img2?>" alt="" class="w-2/5 mb-5">
            </div>
            <div class="">
                <h1 class="text-3xl font-bold text-center">
                    <?php echo $title2 ?>
                </h1>
            </div>
            <div class="">
                <h3 class=" text-center">
                    <?php echo $desc2 ?>
                </h3>
            </div>
            <div>
                <?php
                if($user_type == 'admin'){
                    echo '<button class="bg-black text-white px-4 py-2 rounded-lg" data-model="modal-2">Edit</button>';
                }
                ?>
            </div>
        </div>
        <div class="flex flex-col justify-center items-center p-8">
            <?php 
            $img3 = $packagecontactcontent[2]["img"];
            $title3 = $packagecontactcontent[2]["title"];
            $desc3 = $packagecontactcontent[2]["description"];
            ?>
            <div class="flex flex-row justify-center items-center">
                <img src="<?php echo $img3 ?>" alt="" class="w-2/5 mb-5">
            </div>
            <div class="">
                <h1 class="text-3xl font-bold text-center">
                    <?php echo $title3 ?>
                </h1>
            </div>
            <div class="">
                <h3 class=" text-center">
                    <?php echo $desc3 ?>
                </h3>
            </div>
            <div>
                <?php
                if($user_type == 'admin'){
                    echo '<button class="bg-black text-white px-4 py-2 rounded-lg" data-model="modal-3">Edit</button>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
    <div id="modal-1" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="update_content.php" method="post">
            <input type="hidden" name="id" value="<?php echo $packagecontactcontent[0]['id']; ?>">
            <label for="title1">Title:</label>
            <input type="text" id="title1" name="title" value="<?php echo $title1; ?>" required>
            
            <label for="desc1">Description:</label>
            <textarea id="desc1" name="description" required><?php echo $desc1; ?></textarea>
            
            <button type="submit">Update</button>
        </form>
    </div>
</div>

<div id="modal-2" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="update_content.php" method="post">
            <input type="hidden" name="id" value="<?php echo $packagecontactcontent[1]['id']; ?>">
            <label for="title2">Title:</label>
            <input type="text" id="title2" name="title" value="<?php echo $title2; ?>" required>
            
            <label for="desc2">Description:</label>
            <textarea id="desc2" name="description" required><?php echo $desc2; ?></textarea>
            
            <button type="submit">Update</button>
        </form>
    </div>
</div>

<div id="modal-3" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="update_content.php" method="post">
            <input type="hidden" name="id" value="<?php echo $packagecontactcontent[2]['id']; ?>">
            <label for="title3">Title:</label>
            <input type="text" id="title3" name="title" value="<?php echo $title3; ?>" required>
            
            <label for="desc3">Description:</label>
            <textarea id="desc3" name="description" required><?php echo $desc3; ?></textarea>
            
            <button type="submit">Update</button>
        </form>
    </div>
</div>
</section>
<?php include('partials/footer.php'); ?>

<script>
    // Get the modals
    var modal1 = document.getElementById("modal-1");
    var modal2 = document.getElementById("modal-2");
    var modal3 = document.getElementById("modal-3");

    // Get the buttons that open the modals
    var btn1 = document.querySelector('[data-model="modal-1"]');
    var btn2 = document.querySelector('[data-model="modal-2"]');
    var btn3 = document.querySelector('[data-model="modal-3"]');

    // Get the <span> elements that close the modals
    var spans = document.getElementsByClassName("close");

    // When the user clicks on the button, open the modal
    btn1.onclick = function() { modal1.style.display = "block"; }
    btn2.onclick = function() { modal2.style.display = "block"; }
    btn3.onclick = function() { modal3.style.display = "block"; }

    // When the user clicks on <span> (x), close the modal
    for (var i = 0; i < spans.length; i++) {
        spans[i].onclick = function() {
            this.parentElement.parentElement.style.display = "none";
        }
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target.className === "modal") {
            event.target.style.display = "none";
        }
    }
</script>



<?php if ($user_type == 'admin') { ?>
<script>
document.querySelectorAll('.saveRow').forEach(button => {
    button.addEventListener('click', function() {
        const row = this.closest('tr');
        const id = row.getAttribute('data-id');
        const pax = row.cells[0].innerText;
        const cps = row.cells[1].innerText;
        const ct = row.cells[2].innerText;
        const ck = row.cells[3].innerText;
        const pt = row.cells[4].innerText;
        const pk = row.cells[5].innerText;
        const silog = row.cells[6].innerText;
        const pasta = row.cells[7].innerText;

        const data = new FormData();
        data.append('update_row', true);
        data.append('id', id);
        data.append('pax', pax);
        data.append('cps', cps);
        data.append('ct', ct);
        data.append('ck', ck);
        data.append('pt', pt);
        data.append('pk', pk);
        data.append('silog', silog);
        data.append('pasta', pasta);

        fetch('', {
            method: 'POST',
            body: data
        });
    });
});
document.querySelector('.saveTitleDescription').addEventListener('click', function() {
    const title = document.querySelector('.text-3xl').innerText;
    const description = document.querySelector('.font-light').innerText;
    const id = <?php echo $cateringservicescontent[0]["id"]; ?>;

    const data = new FormData();
    data.append('update_title_description', true);
    data.append('id', id);
    data.append('title', title);
    data.append('description', description);

    fetch('', {
        method: 'POST',
        body: data
    });
});
</script>
<?php } ?>

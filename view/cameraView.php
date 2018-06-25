<?php ob_start(); ?>
	<h2>Camera</h2>
    <hr id="hr_title"/>

    <div id="camera">
        <div id='div_video'>
            <div id='overlay'>
                <img id='id_sticker' style="width:100%;" src="" />
            </div>
            <video id='video'></video>
        </div>
        <div id='div_stickers'>
            <?php
            while ($sticker = $stickers->fetch())
            {
                echo "<img src='".$sticker['img_stickers']."' alt='".$sticker['id_stickers']."'>";
            }
            echo "<img src='".$day['img_stickers']."' alt='".$sticker['id_stickers']."'>";
            ?>
        </div>
        </br>
        <form method="POST" enctype="multipart/form-data" id="picture_take"> 
            <input type="text" name="sticker" value="" id="sticker_id" style="display: none">
            <input type="text" name="src" value="" style="display: none;">
            <input type="submit" id="take_btn" value="">
        </form>
        <form method="POST" enctype="multipart/form-data" id="picture_up" style="display:none">
            <input type="file" name="webcam_upload" >
			<input type="text" name="webcam" value="" >
            <input type="text" name="sticker_id" value="" id="sticker_id">
            <input type="submit" value="Upload" id="uploadbutton" name="submit" disabled>
        </form>
        </br>
        <canvas id="canvas"></canvas>
        <div id='camera_gallery'>
            <img style="display:none" src="http://placekitten.com/g/320/261" id="photo" alt="photo">

        </div>
    </div>


<script src="./public/js/camera.js"></script>

<script>
</script>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>


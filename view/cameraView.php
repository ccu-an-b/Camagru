<?php ob_start(); ?>
	<h2>Camera</h2>
    <hr id="hr_title"/>

    <div id="camera">
        <div id='div_video'>
            <video id='video'></video>
        </div>
        <div id='overlay'>
        <img id='id_sticker' style="width:100%;" src="" />
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
        <button id="startbutton"></button>
        <form action="#" method="POST" enctype="multipart/form-data" id="picture"> 
            <input type="file" name="uploadPic" id="uploadPic">
					<input type="text" name="webcam" value="" id="webcam" style="display: none;">
					<input type="text" name="layer_id" value="" id="layer_id" style="display: none">
					<input type="submit" value="Upload" id="uploadbutton" name="submit" disabled>
        <input type="text" name="sticker_id" value="" id="sticker_id" style="display: none">
        </form>
        </br>
        <canvas id="canvas"></canvas>
        <div id='camera_gallery'>
            <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
            <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
            <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
            <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
            <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
            <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
            <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
            <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
            <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
        </div>
    </div>


<script src="./public/js/camera.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>


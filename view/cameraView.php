<?php ob_start(); ?>
	<h2>Camera</h2>
    <hr id="hr_title"/>

    <div id="camera">
        <div id='div_video'>
            <video id='video'></video>
        </div>
        <div id='div_stickers'>
            <?php
            while ($sticker = $data->fetch())
            {
                echo "<img src=".$sticker['img_stickers'].">";
            }
            echo "<img src=".$day['img_stickers'].">";
            ?>
        </div>
        </br>
        <button id="startbutton"></button>
        <button id="uploadbutton">Upload une photo</button>
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


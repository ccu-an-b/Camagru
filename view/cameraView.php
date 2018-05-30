<?php ob_start(); ?>
	<h2>Camera</h2>
    <hr id="hr_title"/>

    <div id="camera">
        <video id="video"></video>
        <button id="startbutton">Prendre une photo</button>
        <canvas id="canvas"></canvas>
        <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
    </div>

<script src="./public/js/camera.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>
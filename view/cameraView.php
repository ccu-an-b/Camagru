<?php ob_start(); ?>
	<h2>Camera</h2>
    <hr id="hr_title"/>

    <div id="camera">
        <div id='div_video'>
            <div id='overlay'>
                <p id="overlay_msg">T&eacute;l&eacute;chargez une photo &agrave; traiter</p>
                <img id='id_sticker' style="width:100%"  />
            </div>
            <video id='video'></video>
            <img id='camera_img'/>
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
        <form method="POST" enctype="multipart/form-data" id="picture_up">
            <label for="fileToUpload" >Choisir une photo</label>
            <input style="display: none" type="file" name="fileToUpload" id="fileToUpload" accept="image/*" onchange="loadFile(event)">
			<input type="text" name="sticker" value="" id="sticker_id" style="display: none">
            <input type="text" name="src" value="coucou" style="display: none;">
            <input type="submit" value="Valider" id="uploadbutton" name="submit" >
        </form>
        </br>
        <canvas id="canvas"></canvas>
        <div id='camera_gallery'>
            <img style="display:none" id="photo" alt="photo">
        </div>
    </div>
 

<script src="./public/js/camera.js"></script>

<script>
    var loadFile = function(event) {
    var output = document.getElementById('camera_img');
    output.src = URL.createObjectURL(event.target.files[0]);
    document.querySelector('#overlay_msg').style.display="none";
    document.querySelector('#video').style.display="none";
    output.style.display="block";
  };
</script>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>


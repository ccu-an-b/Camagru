var video = document.getElementById("video"),
	canvas = document.getElementById('canvas'),
	apercu = document.getElementById('apercu'),
	button = document.getElementById('pic'),
	photo = document.getElementById('photo'),
	previous = document.getElementById('previousPic'),
	uploadButton = document.getElementById('uploadButton'),
	streaming = false,
	width = 320,
	height = 0
button.disabled = true

	navigator.mediaDevices.getUserMedia({ audio:false, video: {width: 320, height: 240} }).then(stream => {
											if (navigator.mozGetUserMedia)
											{
												video.mozSrcObject = stream;
											}
											else
											{
												var vendorURL = window.URL || window.webkitURL
												video.src = vendorURL.createObjectURL(stream)
											}
											video.play()
										}).catch(err => {
											document.getElementById("pic").style.display = 'none'
										})
video.addEventListener('canplay', function (e) {
	if (!streaming)
	{
		height = video.videoHeight / (video.videoWidth / width)
		video.setAttribute('width', width)
		video.setAttribute('height', height)
		canvas.setAttribute('width', width)
		canvas.setAttribute('height', height)
		streaming = true
	}
}, false)
button.addEventListener('click', function (e) {
	e.preventDefault()
	apercu.width = width
	apercu.height = height
	button.disabled = true
	uploadButton.disabled = true
	apercu.getContext('2d').drawImage(video, 0, 0, width, height)
	var data = apercu.toDataURL('image/png')
	document.getElementById('webcam').value = data
	uploadButton.disabled = false
})
//getLastPics()

var getHttpRequest = function () {
	var httpRequest = false;

	if (window.XMLHttpRequest) { // Mozilla, Safari,...
		httpRequest = new XMLHttpRequest();
		if (httpRequest.overrideMimeType) {
			httpRequest.overrideMimeType('text/xml');
		}
	}
	else if (window.ActiveXObject) { // IE
		try {
			httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try {
				httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {}
		}
	}

	if (!httpRequest) {
		alert('Abandon :( Impossible de créer une instance XMLHTTP');
		return false;
	}

	return httpRequest
}  

// var form = document.getElementById('picture')
 var xhr = getHttpRequest()
// form.addEventListener("submit", function (e) {
// 	e.preventDefault()
// 	var data = new FormData(form)
// 	uploadButton.disabled = true
// 	button.disabled = true
// 	xhr.open('POST', '/functions/upload_img_wl.php', true)
// 	xhr.send(data)
// })
xhr.onreadystatechange = function () {
	var res = document.getElementById("res")
	if (xhr.readyState === 4 && xhr.status === 204) {
		res.innerHTML = xhr.responseText
		document.getElementById('webcam').value = null
		getLastPics()
	}
	else if (xhr.status >= 400)
		res.innerHTML = "Impossible de joindre le serveur !"
}
var layersCont = document.getElementById('layouts').getElementsByTagName('img')
Array.prototype.forEach.call(layersCont, function (e) {
	e.addEventListener('click', function () {
		var layer_id = document.getElementById('layer_id')
		layer_id.value = e.alt
		Array.prototype.forEach.call(layersCont, function (el) {
			el.style.border = 'none'
			canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
		})
		canvas.getContext('2d').drawImage(e, 0, 0, width, height)
		e.style.border = 'solid 5px #FF0000'
		button.disabled = false
		uploadButton.disabled = false
	})
})



<div class="container">
		<div class="assembly">
			<div class="main">
				<video id="video"></video>
				<button id="pic">Take a pic</button>
				<canvas id="canvas"></canvas>
				<canvas id="apercu" style="display: none"></canvas>
				<form action="#" method="POST" enctype="multipart/form-data" id="picture">
					Choisir une image:
					<input type="file" name="uploadPic" id="uploadPic">
					<input type="text" name="webcam" value="" id="webcam" style="display: none;">
					<input type="text" name="token" value="<?= $_SESSION['token'] ?>" style="display: none">
					<input type="text" name="layer_id" value="" id="layer_id" style="display: none">
					<input type="submit" value="Upload" id="uploadButton" name="submit" disabled>
				</form>
				<div class="res" id="res"></div>
				<div class="layouts" id="layouts">
					<?php $layers = $layers->getLayers();
					for ($i = 0; $i < count($layers); $i++)
					{
						echo "<img src=\"" . $layers[$i]['path'] . "\" alt=\"" . $layers[$i]['id'] . "\" width=\"255px\" height=\"200px\">";
					}
					?>
				</div>
			</div>
			<br><br>
			<div class="side">
				<h3>Previous pics</h3>
				<div id="previousPic"></div>
			</div>
		</div>
	</div>
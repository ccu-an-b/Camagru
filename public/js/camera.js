function callback_webcam(data)
{
  var gallery = document.getElementById("camera_gallery")

  var new_picture = document.createElement("img")
  new_picture.setAttribute("id", "photo")
  new_picture.setAttribute("src", data)
  gallery.appendChild(new_picture)
}

(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      upload       = document.querySelector('#camera_img'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#take_btn');
      uploadbutton  = document.querySelector('#uploadbutton');

  navigator.mediaDevices.getUserMedia({ audio:false, video: {width: 640, height: 480}   }).then(stream => {
      var vendorURL = window.URL || window.webkitURL
      video.src = vendorURL.createObjectURL(stream)
      video.play()
    }).catch(err => {
      document.querySelector('#overlay_msg').style.display="block"
      document.querySelector('#picture_take').style.display="none"
      document.querySelector('#picture_up').style.display="flex"
      console.log("Erreur: " + err);
  }) 
                        

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
    var data = canvas.toDataURL('image/png')
    var layer_id = document.getElementById('id_sticker')
    photo.setAttribute('src', data)
    document.getElementsByName("sticker")[0].value = layer_id.src
    document.getElementsByName("src")[0].value = data

    var form = document.getElementById("picture_take")
    var data = new FormData(form)

    ajax_form("webcam", data, "model/addWebcam.php");
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

  function uploadpicture() {

    var layer_id = document.getElementById('id_sticker')
    document.getElementsByName("sticker")[1].value = layer_id.src

    var form = document.getElementById('picture_up');
    var files = document.getElementById('fileToUpload').files;
    var data = new FormData(form);
    data.append('fileToUpload', files[0], files[0].name);

		ajax_form("webcam", data, "model/addWebcam.php");
  }

  uploadbutton.addEventListener('click', function(ev){
    uploadpicture();
  ev.preventDefault();
  }, false);

  var layersCont = document.getElementById('div_stickers').getElementsByTagName('img');
  Array.prototype.forEach.call(layersCont, function (e) {
    e.addEventListener('click', function () {
      var layer_id = document.getElementById('id_sticker')
      var tmp = e.src.split(".png");
      layer_id.src = tmp[0]+"_1.png";
      Array.prototype.forEach.call(layersCont, function (el) {
        el.style.border = 'none'
      })
      e.style.border = 'solid 1px #EF626C'
    })
  })


})();


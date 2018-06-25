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

    ajax_file("webcam", data, "model/addWebcam.php");
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
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
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
      })
      var width = 320 ; 
      var height=  240;
      canvas.getContext('2d').drawImage(e, 0, 0, width, height)
      e.style.border = 'solid 1px #EF626C'
      startbutton.disabled = false
      uploadbutton.disabled = false
    })
  })


})();


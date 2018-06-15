(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton');
      uploadbutton  = document.querySelector('#uploadbutton');


  navigator.mediaDevices.getUserMedia({ audio:false, video: {width: 320, height: 240}   }).then(stream => {
      var vendorURL = window.URL || window.webkitURL
      video.src = vendorURL.createObjectURL(stream)
      video.play()
    }).catch(err => {
    console.log("An error occured! " + err);
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
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

  var layersCont = document.getElementById('div_stickers').getElementsByTagName('img')
  Array.prototype.forEach.call(layersCont, function (e) {
    e.addEventListener('click', function () {
      var layer_id = document.getElementById('layer_id')
      layer_id.value = e.alt
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


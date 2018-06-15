(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton');



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

})();


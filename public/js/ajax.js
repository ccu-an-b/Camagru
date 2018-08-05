function ajax(url, callback, cb = undefined) {

	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }  
    else {
    // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200 && callback != "") {
            var data = JSON.parse(this.responseText);
            switch (callback) {
                case "modal":
                    callback_modal(data);
                    break;
                case "gallery":
                    callback_gallery(data);
                    break;
                case "header":
                    callback_header(data);
                    break;
                case "add":
                    callback_add(data);
                    break;
                case "account":
                    callback_account(data);
                    break;
                case "connect":
                    callback_connect(data);
                    break;
                }
            if (cb) {
                cb()
            }
        }
        else
            this.readyState == 4 && this.status == 200 ;
    };
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

function ajax_form(callback, form, url) {
    
        if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }  
        else {
        // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                switch (callback) {
                    case "account":
                        callback_account(data);
                        break;
                    case "webcam":
                        callback_webcam(data);
                        break;
                }
            }
        };
        xmlhttp.open("POST",url,true);
        xmlhttp.send(form);
    }
function ajax(url, callback) {

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
            }
        }
        else
            this.readyState == 4 && this.status == 200 ;
    };
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}
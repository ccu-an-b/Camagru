function like(){
		var id_img = document.getElementById('id_like').value;
		console.log(id_img);
		ajax_add("img", "", id_img);
		ajax_modal(id_img);
    }
    
	var input = document.getElementById("new_com");
	input.addEventListener("keyup", function(event) {
    	event.preventDefault();
    	if (event.keyCode === 13 && input.value != "") {
        	document.getElementById("submit").click();
   		 }
	});

	function comment() {
		var id_img = document.getElementById('id_like').value;
		var comment = document.getElementById('new_com').value;
		console.log(id_img);
		console.log(comment);
        ajax_add("com",comment, id_img);
        document.getElementById('new_com').value = "";
        ajax_modal(id_img);
        
	}

	function ajax_add(item, comment, id_img) {

	if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }  
    else {
    // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        this.readyState == 4 && this.status == 200 ;
    };
    xmlhttp.open("GET","model/addlike.php?"+item+"="+id_img+"&comment="+comment,true);
    xmlhttp.send();
}
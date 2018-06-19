function like(){
    var id_img = document.getElementById('id_img').value;
	ajax("model/addlike.php?img="+id_img, "");
    ajax("model/getmodal.php?img="+id_img, "modal");
}

function comment() {
	var id_img = document.getElementById('id_img').value;
	var comment = document.getElementById('new_com').value;
	ajax("model/addlike.php?com="+id_img+"&comment="+comment, "");
    ajax("model/getmodal.php?img="+id_img, "modal");
    document.getElementById('new_com').value = "";
}

function notLog() {
	alert ("Vous devez vous connectez");
}

var input = document.getElementById("new_com");
input.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13 && input.value != "") {
       	document.getElementById("submit").click();
   	}
});
function like(){
    var id_img = document.getElementById('id_img').value;
	ajax("model/addlike.php?img="+id_img, "add");
    ajax("model/getmodal.php?img="+id_img, "modal");
}

function comment() {
	var id_img = document.getElementById('id_img').value;
	var comment = document.getElementById('new_com').value;
	ajax("model/addlike.php?com="+id_img+"&comment="+comment, "add");
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

function callback_add(data) {

	var update = document.querySelector('[title="'+data[0].id_img+'"]');

	if (update)
	{
		update.innerHTML = "<div id='info'> <p>"+data[0].count_like+" <img style='width:30px;height:30px' src='"+data[0].like_src+"'/> "+data[0].count_com+" <img style='width:38px;height:38px' src='public/icons/comment.png'/> </p> </div><img src='"+data[0].img+"' /> ";
	}
	
	var count_like = document.getElementById("count_like");
	var count_com = document.getElementById("count_com");

	if (count_like && count_com)
	{
		count_like.innerHTML = "<b>"+data[1].like+"</b> Likes</td>";
		count_com.innerHTML = "<b>"+data[1].comment+"</b> Commentaires</td>";
	}
}
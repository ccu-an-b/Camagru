function callback_account(page){
    if (page == 'logout')
        logout();

    else
        document.location.href="modify_profile.php?page="+page;
}
function modify_profile(){
    var bio = document.getElementsByName('bio')[0].value;
    var login = document.getElementsByName('login')[0].value;
    var mail = document.getElementsByName('mail')[0].value;

    ajax("model/modifyAccount.php?page=1&bio="+bio+"&login="+login+"&mail="+mail, "account");
}

function modify_notification(){
    var notif_com = document.getElementById("notif_cmt"); 
    var notif_like = document.getElementById("notif_like");

    var like = 'false';
    var comment = 'false';

    if (notif_com.checked)
        comment = 'true';
    if (notif_like.checked)
        like = 'true';
    
    ajax("model/modifyAccount.php?page=3&like="+like+"&com="+comment, "account");
}

function modify_passwd(){
    var old_pass = document.getElementsByName('old_pass')[0].value; 
    var new_pass = document.getElementsByName('new_pass')[0].value;
    var new_pass_2 = document.getElementsByName('new_pass_2')[0].value;

    ajax("model/modifyAccount.php?page=2&old_pass="+old_pass+"&new_pass="+new_pass+"&new_pass_2="+new_pass_2, "account");
}

function modify_picture() {
    var img = document.getElementsByClassName("del_img");
    var img_del;
    var i;

    for(i = 0 ; i < img.length ; i++)
    {    
		if (img[i].value == 1)
		{
            if (img_del == null)
                img_del = img[i].alt;
            else
			    img_del +="-"+img[i].alt;
		}	
    }
    ajax("model/modifyAccount.php?page=4&picture="+img_del, "account");
}

function modify_delete() {
    var passwd = document.getElementsByName('pass')[0].value;
    ajax("model/modifyAccount.php?page=5&pass="+passwd, "account");
}

function fileName(){
    var x = document.getElementById("fileToUpload");
    var txt = "";
    if ('files' in x) {
        if (x.files.length != 0) {
			var file = x.files[0];
            if ('name' in file) {
                txt = "</br>"+file.name;
			}
		}
		document.getElementById("file_name").innerHTML = txt;
	} 
}


var inputs = document.getElementsByClassName('input');
for(var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
               document.getElementById("submit_form").click();
           }
    });
}

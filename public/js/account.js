function modify_notification()
{
    var notif_com = document.getElementById("notif_cmt"); 
    var notif_like = document.getElementById("notif_like");

    var like = 'false';
    var comment = 'false';

    if (notif_com.checked)
        comment = 'true';
    if (notif_like.checked)
        like = 'true';
    
    ajax("model/modifyAccount.php?like="+like+"&com="+comment, "account");
}

function modify_passwd()
{
    var old_pass = document.getElementsByName('old_pass')[0].value; 
    var new_pass = document.getElementsByName('new_pass')[0].value;
    var new_pass_2 = document.getElementsByName('new_pass_2')[0].value;

    ajax("model/modifyAccount.php?old_pass="+old_pass+"&new_pass="+new_pass+"&new_pass_2="+new_pass_2, "account");

}
function callback_account(data)
{
    if (data[0] == "notification")
    {
        document.location.href="modify_profile.php";
    }
}


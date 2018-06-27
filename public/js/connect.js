function callback_connect(page){

    if (page == 'reload')
        document.location.reload(true)
    else
        document.location.href=page
}

function retrieve_pass()
{
    var mail = document.getElementsByName('mail')[0].value
    ajax("model/connect.php?page=password&mail="+mail, "connect")
}

function new_pass() 
{
    var login = document.getElementsByName('login')[0].value
    var new_pass = document.getElementsByName('pass')[0].value
    var new_pass_2 = document.getElementsByName('pass_2')[0].value

    ajax("model/connect.php?page=new_password&login="+login+"&new_pass="+new_pass+"&new_pass_2="+new_pass_2, "connect")
}

var inputs = document.getElementsByClassName('input')
for(var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener("keyup", function(event) {
        event.preventDefault()
        if (event.keyCode === 13) {
               document.getElementById("submit_form").click();
           }
    })
}
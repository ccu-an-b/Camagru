function dropdown()
{
	var menu = document.getElementById("dropdown-content");
    var bubble = document.getElementById("notify-bubble");
    
	if (menu.style.display == "block")						
		menu.style.display="none";
    else 
    {
        menu.style.display="block";
        bubble.style.display="none";
    }
}

function callback_notif(data){

    var i;
    console.log(data.length);
    for(i = 0 ; i < data.length ; i++)
    {
        console.log(i);
        var notif = document.createElement("a");
        notif.innerHTML ="<img id='notif-logo' src='./public/icons/profile.png'><p>Chloe a test votre photo</br><span id='notif-date'></span></p><img id='notif-img' src='https://images.unsplash.com/photo-1485921198582-a55119c97421?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=c6d9cabdc7f046b490c67663caa3754e&auto=format&fit=crop&w=1000&q=80'>";
        var element = document.getElementById("dropdown-content");
        element.appendChild(notif);
    }
    console.log(data);
}

function ajax_notification() {
    
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
            callback_notif(data);
        }
    };
    xmlhttp.open("GET","notification.php?",true);
    xmlhttp.send();
}

ajax_notification();



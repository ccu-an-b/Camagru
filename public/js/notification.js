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

    if (data[0].length == '0')
    {
        var notif = document.createElement("p");
        notif.innerHTML ="<p style='font-size:18px;color: grey;font-style: italic;text-align:center;width:100%'>Vous n'avez pas de notifications</p>";
        var element = document.getElementById("dropdown-content");
        element.appendChild(notif);

    }
    else 
    {
        for(i = 0 ; i < data[0].length ; i++)
        {
            var notif = document.createElement("a");
            if(data[0][i].text == null)
                var item = 'lik&eacute';
            else
                var item = 'comment&eacute';
        
        notif.innerHTML ="<img id='notif-logo' src='"+data[0][i].profile+"'><p>"+data[0][i].login+" a "+item+" votre photo</br><span id='notif-date'>"+date(data[0][i].date)+"</span></p><img id='notif-img' src='"+data[0][i].img+"'>";
        var element = document.getElementById("dropdown-content");
        element.appendChild(notif);
        }
        document.getElementById('notify-bubble').innerHTML = data[1];
    }
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
            if (data != null)
            {
                callback_notif(data);
            }
            console.log(data);
        }
    };
    xmlhttp.open("GET","notification.php?",true);
    xmlhttp.send();
}

ajax_notification();



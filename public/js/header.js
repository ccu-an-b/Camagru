function dropdown()
{
	var menu = document.getElementById("dropdown-content");
    var bubble = document.getElementById("notify-bubble");
    
	if (menu.style.display == "block")						
		menu.style.display="none";
    else 
    {
        menu.style.display="block";
        ajax_header("notif");
        bubble.style.display="none";
    }
}

function date(date)
{
	date = date.split("-");

	var day = date[2].split(" ");

	var month = {"01": 'Janvier', "02": 'Fevrier', "03": 'Mars', "04": 'Avril', "05": 'Mai', "06": 'Juin', "07": 'Juillet', "08": 'Août', "09": 'Septembre', "10": 'Octobre', "11": 'Novembre', "12": 'Decembre'};
	var res = day[0]+" "+month[date[1]]+" "+date[0];
	return res; 
}

function callback_notif(data){

    var i;
    var notif_menu = document.getElementById("dropdown-content");
    var profile_menu = document.getElementById("profile_menu");
    if (data[0] == 0)
    {   
        profile_menu.href = 'connexion.php';
    }
    else if (data[0] == 1)
    {
        document.getElementById("logout").style.display = "inline-block";
        document.getElementById("dropdown").style.display = "inline-block";
        profile_menu.href = 'profile.php';
        if (data[1].length == '0')
        {
            var notif = document.createElement("p");
            notif.innerHTML ="<p style='font-size:18px;color: grey;font-style: italic;text-align:center;width:100%'>Vous n'avez pas de notifications</p>";
            notif_menu.appendChild(notif);
        }
        else 
        {
            for(i = 0 ; i < data[1].length ; i++)
            {
                var notif = document.createElement("a");
                if(data[1][i].text == null)
                    var item = 'lik&eacute';
                else
                    var item = 'comment&eacute';
        
                notif.innerHTML ="<img id='notif-logo' src='"+data[1][i].profile+"'><p>"+data[1][i].login+" a "+item+" votre photo</br><span id='notif-date'>"+date(data[1][i].date)+"</span></p><img id='notif-img' src='"+data[1][i].img+"'>";
                notif_menu.appendChild(notif);
            }
            if (data[2] != '0')
            {
                var bubble = document.getElementById('notify-bubble');
                bubble.innerHTML = data[2];
                bubble.style.display = 'block';
            }
        }
    }
}

function ajax_header(item) {
    
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
    xmlhttp.open("GET","header.php?id="+item,true);
    xmlhttp.send();
}

ajax_header('h');




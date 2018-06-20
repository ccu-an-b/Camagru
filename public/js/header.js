function dropdown()
{
	var menu = document.getElementById("dropdown-content");
    var bubble = document.getElementById("notify-bubble");
    
	if (menu.style.display == "block")						
        menu.style.display="none";
    else 
    {
        menu.style.display="block";
        ajax('model/getheader.php?action=notif', 'header');
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

function logout()
{
    ajax('model/getheader.php?action=logout', 'header');
}

function callback_header(data){

    var i;
    var notif_menu = document.getElementById("dropdown-content");
    var profile_menu = document.getElementById("profile_menu");
    if (data[0] == 0)
    {   
        profile_menu.href = 'connexion.php';
    }
    else if (data[0] == 3)
    {
        document.location.href="index.php";
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
                notif.setAttribute("class", "notification");
                notif.setAttribute("alt", data[1][i].id_img);
                if(data[1][i].text == null)
                    var item = 'lik&eacute';
                else
                    var item = 'comment&eacute';
                notif.innerHTML ="<img id='notif-logo' src='"+data[1][i].profile+"'><p><b>"+data[1][i].login+"</b> a "+item+" votre photo</br><span id='notif-date'>"+date(data[1][i].date)+"</span></p><img id='notif-img' src='"+data[1][i].img+"'>"; 
                notif_menu.appendChild(notif);
            }
            if (data[2] != '0')
            {
                var bubble = document.getElementById('notify-bubble');
                bubble.innerHTML = data[2];
                bubble.style.display = 'block';
            }
            var notif_link = document.getElementsByClassName("notification");
            
                var i;
                for(i = 0 ; i < notif_link.length ; i++)
                {
                    var modalImg = document.getElementById("imgModal");
                
                        notif_link[i].onclick = function() {
                        
                        modal.style.display = "block";
                        var id = this.getAttribute('alt');
                        ajax("model/getmodal.php?img="+id, 'modal');		
                    }
                }
        }
    }
}

ajax('model/getheader.php?action=header', 'header');
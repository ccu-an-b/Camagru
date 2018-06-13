function date(date)
{
	date = date.split("-");

	var day = date[2].split(" ");

	var month = {"01": 'Janvier', "02": 'Fevrier', "03": 'Mars', "04": 'Avril', "05": 'Mai', "06": 'Juin', "07": 'Juillet', "08": 'Août', "09": 'Septembre', "10": 'Octobre', "11": 'Novembre', "12": 'Decembre'};
	var res = day[0]+" "+month[date[1]]+" "+date[0];
	return res;
}

function callback(data)
{
	var res = date(data[0].date)
	document.getElementById('div_imgModal').innerHTML = "<img id='imgModal' src='"+data[0].img+"' />";
	document.getElementById('like').innerHTML = data[1][0];
	document.getElementById('date').innerHTML = res;
	document.getElementById('img_log').src = data[0].profile;
	document.getElementById('name_log').innerHTML = data[0].login;
	document.getElementById('id_com').value = data[0].id_img;
	document.getElementById('id_like').value = data[0].id_img;

	if (data[3] == '1')
	{
		document.getElementById('like_img_2').src ="./public/icons/like_on_2.png";
	}
	else
	{
		document.getElementById('like_img_2').src ="./public/icons/like_on.png";
	}


	var insert = document.getElementById("div_comment");
	var remove = document.getElementsByClassName("comment");
	if (remove.length != 0)
	{
		while (remove.length > 0)
		{
			remove[0].remove();
		}
	}
	for (i = 0 ; i < data[2].length ; i++)
	{

		var new_row = insert.parentNode.insertRow( insert.rowIndex + 1 );
		new_row.setAttribute("class", "comment");
		var cell = new_row.insertCell(0);
		cell.innerHTML = "<b>"+data[2][i].login+" </b> "+data[2][i].text;
		cell.colSpan = 3 ;
	}
}

function ajax_modal(id) {

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
			callback(data);
        }
    };
    xmlhttp.open("GET","modal.php?img="+id,true);
    xmlhttp.send();
}

var modal = document.getElementById('myModal');

var btn = document.getElementsByClassName("img");
var i;
for(i = 0 ; i < btn.length ; i++)
{
	var modalImg = document.getElementById("imgModal");
	var exit = document.getElementsByClassName("close")[0];

	btn[i].onclick = function() {
   		modal.style.display = "block";
   		var id = this.title;
		ajax_modal(id);		
	}

	exit.onclick = function() {
		modal.style.display = "none";
	}

	window.onclick = function(event) {
    	if (event.target == modal) {
       		modal.style.display = "none";
    	}
	}
}




<?php ob_start(); ?>
<?php $profile = $profile->fetch(); ?>

	<table id="profile">
		<tr>
			<td rowspan="3" style="width:40%"><img src='<?= $profile['profile'] ?>' /></td>
			<td colspan="2" class="login"><?= $profile['login'] ?></td>
			<td><input onclick="window.location.href='./modify_profile.php'" type="button" value="Modifier le profil"></td>
		</tr>
		<tr>
			<td style="width:20%" ><b><?= $count_picture ?></b> Publications</td>
			<td style="width:20%; margin-left: 10px"><b><?= $count_like ?></b> Likes</td>
			<td style="width:20%"><b><?= $count_comment ?></b> Commentaires</td>
		</tr>
		<tr>
			<td colspan="3"><i><?= $profile['bio'] ?></i></td>
		</tr>
	</table>
	<br/>
	<hr id="hr_title"/>
	<br/>
	<div id="gallery">
	<?php
	while ($data = $picture->fetch())
	{
	?>
		<div class="img" id= "img" title=<?= $data['id_img'] ?> >
			<div id='info'> <p> <?= $data['like'] ?> <img style="width:30px;height:30px" src="public/icons/like.png"/><?= $data['comment'] ?> <img style="width:38px;height:38px" src="public/icons/comment.png"/> </p> </div>
			<img src='<?= $data['img'] ?>' />
		</div>
	<?php
	}
	$picture->closeCursor();
	?>
	</div>


<div id="myModal" class="modal">

	<span class="close">&times;</span>
  <div class="modal-content">
    <div class="modal-body">
    <span id="div_imgModal"></span>
	<table id ="modal_info">
    	<tr>
      		<td rowspan="2" colspan="2" style="width:20%"><img id="img_log" src='<?= $profile['profile'] ?>' /></td>
			<td rowspan="2" class="login"><?= $profile['login'] ?></td>
      	</tr>
      	<tr><td></td></tr>
		<tr>
      		<td colspan="3"><hr></td>
      	</tr>
      	<span id="comment">
      		<tr>
      			<td colspan="3"><b>login </b> commentaire</td>
      		</tr>
      		<tr>
      			<td colspan="3"><b>login </b> commentaire</td>
      		</tr>
      	</span>
      	<tr><td></td></tr>
		<tr>
      		<td colspan="3"><hr></td>
      	</tr>
      	<tr>
      		<td id="like" style="width:10px; text-align:center" ></td>
      		<td id="like_img" ><img src="./public/icons/like_on.png"></td>
      		<td id="date">3 novembre 2017</td>
      		
      	</tr>
		<tr>
      		<td colspan="3"><hr></td>
      	</tr>
      	<tr>
      		<td colspan="3"><input type="text" placeholder="Ajouter un commentaire..."></td>
      	</tr>
    </table>
    </div>
  </div>

</div>

<script>


function callback(data, item, date)
{
	function date(date)
	{
		var date = data.date
		date = date.split("-");

		var day = date[2].split(" ");

		var month = {"01": 'Janvier', "02": 'Fevrier', "03": 'Mars', "04": 'Avril', "05": 'Mai', "06": 'Juin', "07": 'Juillet', "08": 'Août', "09": 'Septembre', "10": 'Octobre', "11": 'Novembre', "12": 'Decembre'};
		var res = day[0]+" "+month[date[1]]+" "+date[0];
		return res;
	}

	var res = date(data.date)
	document.getElementById('div_imgModal').innerHTML = "<img id='imgModal' src='"+data.img+"' />";
	document.getElementById('like').innerHTML = data.like;
	document.getElementById('date').innerHTML = res;
}

function showImg(id) {
	var xmlhttp;
			if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                callback(data, "img");
            }
        };
        xmlhttp.open("GET","get_img.php?q="+id,true);
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
		showImg(id);		
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


</script>



<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

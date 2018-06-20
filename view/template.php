<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Camagru</title>

		<link rel="stylesheet" href="public/css/style.css" />

		<link href="https://fonts.googleapis.com/css?family=Advent+Pro|Amatic+SC|Lekton|Pompiere|Happy+Monkey" rel="stylesheet">

		<link rel="icon" href="public/icons/favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" href="public/icons/favicon.ico" type="image/x-icon"/>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="./public/js/ajax.js"></script>
	</head>

	<body>
		
		<header>
		<!-- Navigation Header -->				
			<table class="header"><tr>
			 	<td style="width:70px">
					<a href="camera.php"><img style="width:60px; height: 60px" src="public/icons/logo.png"/></a>
				</td>
				<td style="width:15px"><h1>|</h1>
				</td>
				<td style="width:110px">
					<h1>CAMAGRU</h1>
				</td>
				<td id='logout'>
					<a href="javascript:void(0)" onclick="logout()" ><img src="public/icons/logout.png"/></a>
				</td>
				<td style="width: 80%">
				</td>
				<td id="dropdown">
				<span id="notify-bubble"></span>
				<a href="javascript:void(0)" class="dropbtn"><img onclick="dropdown()" src="public/icons/notification.png"/></a>
   				<div id="dropdown-content">
    			</div>
				</td>
				<td style="width:50px">
					<a href="index.php">
					<img style="width:40px; height: 40px" src="public/icons/gallery.png"/></a>
				</td>
				<td style="width:50px">
					<a id="profile_menu" href="">
					<img src="public/icons/account.png"/></a>
				</td>
			</tr></table>
		</header>
		<div id="main">

		<?= $content ?>

		<!-- Picture Modal -->	
			<div id="myModal" class="modal">
				<span class="close">&times;</span>
				<div class="modal-content">
					<div class="modal-body">
						<span id="div_imgModal"></span>
						<table id ="modal_info">
							<tr>
      							<td rowspan="2" colspan="2" style="width:20%"><a href="#" id="link_log" ><img id="img_log" src=""/></a></td>
								<td rowspan="2" class="login" id="name_log"></td>
      						</tr>
      						<tr><td></td></tr>
							<tr id="div_comment">
      							<td colspan="3"><hr></td>
      						</tr>
      						<tr><td></td></tr>
							<tr>
      							<td colspan="3"><hr></td>
      						</tr>
							<tr>
		  						<input type='hidden' name='id' id='id_img' value="0">
      							<td id="like"></td>
      							<td id="like_img" onclick="<?php if (isset($_SESSION['login'])) echo "like()"; else echo "notLog()";?>" ><img id="like_img_2" src="./public/icons/like_on.png"></td>
      							<td id="date"></td>
      						</tr>
							<tr>
      							<td colspan="3"><hr></td>
      						</tr>
      						<tr>
      							<td colspan="3"><input type="text" id="new_com" name="comment" placeholder="Ajouter un commentaire..."></td>
							</tr>
							<tr>
								<td><input style="opacity:0" type="submit" name="submit" id="submit" onclick="<?php if (isset($_SESSION['login'])) echo "comment()"; else echo "notLog()";?>" value="valider"></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<h4>Camagru 2018 &#64;ccu-an-b</h4>
		</footer>
	</body>
</html>
<script src="./public/js/gallery.js"></script>
<script src="./public/js/modal.js"></script>
<script src="./public/js/addModal.js"></script>
<script src="./public/js/header.js"></script>
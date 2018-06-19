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
		</div>
		<footer>
			<h4>Camagru 2018 &#64ccu-an-b</h4>
		</footer>
	</body>
</html>
<script src="./public/js/header.js"></script>
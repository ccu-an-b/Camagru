<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Camagru</title>
		<link rel="stylesheet" href="public/css/style.css" />
		<link href="https://fonts.googleapis.com/css?family=Advent+Pro|Amatic+SC|Lekton|Pompiere|Happy+Monkey" rel="stylesheet">
		<link rel="icon" href="public/icons/favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" href="public/icons/favicon.ico" type="image/x-icon"/>
	</head>

	<body>
		<header>
			<table class="header"><tr>
			 	<td style="width:70px">
					<img style="width:60px; height: 60px" src="public/icons/logo.png"/>
				</td>
				<td style="width:140px">
					<h1>| CAMAGRU</h1>
				</td>
				<td style="width:60px">
					<img style="width:33px; height: 33px; margin-top: 5px" src="public/icons/logout.png"/>
				</td>
				<td>
				</td>
				<td style="width:60px">
					<img style="width:45px; height: 45px; margin-top: 2px" src="public/icons/notification.png"/>
				</td>
				<td style="width:50px">
					<a href="index.php">
					<img style="width:40px; height: 40px" src="public/icons/gallery.png"/></a>
				</td>
				<td style="width:50px">
					<a href="connexion.php">
					<img style="width:40px; height: 40px; margin-top: 2px" src="public/icons/account.png"/></a>
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
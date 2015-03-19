<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<link href="css/main.css" rel="stylesheet"/>
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Viga' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<title>Doio - <?php echo $title ?></title>
</head>
<body>
	<div id="header">
		<img id="menu-icon" alt="Menu" src="img/icon_menu_24.png">
		<div id="logo-container">DOIO</div>
		<div id="menu-container">
		
		</div>
		
	</div>

	<div id="content" class="board">
		<div id="centered-content" class="register">
			<h1><?php echo $title; ?></h1>
			<?php echo $error; ?>
			<form id="register-form" method="post">
		 	<p>
				<input type="text" name="first-name">
				<label>First Name</label>
			</p>
			<p>
				<input type="text" name="last-name">
				<label>Last Name</label>
			</p>
			<p>
				<input type="email" name="email" value="<?php echo $email ?>">
				<label>Email</label>
			</p>
			<p>
				<input type="text" name="username">
				<label>Username</label>
			</p>
			<p>
				<input type="password" name="password1">
				<label>Password</label>
			</p>
			<p>
				<input type="password" name="password2">
				<label>Password Again</label>
			</p>
			<p>
				<input type="submit" value="Register">
			</p>
		</form> 
		</div>
		
			 
	</div>
</body>
</html>

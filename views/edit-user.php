<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<link href="css/main.css" rel="stylesheet"/>
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Viga' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<title>Doio</title>
</head>
<body>
	<div id="header">
		<div id="menu-icon-container">
			<img id="menu-icon" alt="Menu" src="img/icon_menu_24.png">
		</div>
		<div id="logo-container">DOIO</div>
		<nav id="main-menu-container">
			<ul>
				<li><a href="portal">Portal</a></li>
				<li><a href="board">Board</a></li>
			</ul>
		</nav>
		

		<div id="user-container">
			<img class="user-thumbnail" alt="" src="img/users/<?php echo strlen($userImageThumb)>7 ? $userImageThumb : 'icon_user_64.png' ?>">
			<p class="user-name"><?php echo $user ?></p>
			<div class="menu-arrow-container">
				<img class="menu-arrow" alt="" src="img/icon_left_32.png">
				<img id="logout-icon" alt="" src="img/icon_logout_32.png">
				<img id="settings-icon" alt="" src="img/icon_settings_32_2.png">
			</div>
		</div>

		<nav id="user-menu-container">
			<ul>
				<li><a id="settings" href="edit_user">Settings</a></li>
				<li><a id="logout" href="login?logout">Logout</a></li>
			</ul>
		</nav>

	</div>

	<div id="content" class="board">
		<div id="centered-content" class="new-task">
			<h1><?php echo $title; ?></h1>
			<?php echo $error; ?>
			<a class="change-password-btn" href="edit_user/password">Change Password</a>
			<div class="change-image-container">
				<img alt="" src="img/users/<?php echo strlen($userImage)>1 ? $userImage : 'icon_user_64.png' ?>">
				<a class="change-image-btn" href="edit_user/image">Change Image</a>
			</div>
			<form id="new-task-form" method="post">
		 	<p>
				<input type="text" name="first-name" value="<?php echo $firstName ?>">
				<label>First Name</label>
			</p>
			<p>
				<input type="text" name="last-name" value="<?php echo $lastName ?>">
				<label>Last Name</label>
			</p>
			<p>
				<input type="email" name="email" value="<?php echo $email ?>">
				<label>Email</label>
			</p>
			<p>
				<input type="text" name="title" value="<?php echo $userTitle ?>">
				<label>Title</label>
			</p>
			<p>
				<input type="submit" value="Save">
			</p>
		</form> 
		</div>
		
			 
	</div>

<script>
$( "#user-container" ).click(function() {
	$( "#user-menu-container" ).toggle( "slide", { direction: "right" } );
	$( ".menu-arrow" ).toggle( "slide", { direction: "left" } );
});

$( "#logout" ).hover(function() {
	$( "#logout-icon" ).show();
}, function() {
	$( "#logout-icon" ).hide();
});

$( "#settings" ).hover(function() {
	$( "#settings-icon" ).show();
}, function() {
	$( "#settings-icon" ).hide();
});

$( "#menu-icon-container" ).click(function() {
	$( "#main-menu-container" ).toggle( "slide", { direction: "left" } );
	$( "#menu-icon" ).toggle( "slide", { direction: "right" } );
});
</script>
</body>
</html>

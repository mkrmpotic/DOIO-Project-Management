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
	<title>Doio - <?php echo $title ?></title>
</head>
<body>
	<div id="header">
		<img id="menu-icon" alt="Menu" src="img/icon_menu_24.png">
		<div id="logo-container">DOIO</div>

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
				<li><a id="logout" href="login?logout">Logout</a></li>
			</ul>
		</nav>

	</div>

	<div id="content" class="board">
		<div id="centered-content" class="invalid-invitation">
			<h1><?php echo $title; ?></h1>
			<?php echo $error; ?>
			<div class="btns-container">
				<a class="delete-task-btn" href="?id=<?php echo $invitationToDeleteId ?>&delete-invitation">Yes</a>
				<a class="delete-task-btn" href="portal">No</a>
			</div>
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
</script>
</body>
</html>

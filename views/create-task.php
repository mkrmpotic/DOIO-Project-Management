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
			<form id="new-task-form" method="post">
		 	<p>
				<input type="text" name="task-title" autofocus>
				<label>Title</label>
			</p>
			<p class="textarea-p">
				<textarea name="task-description" cols="30" rows="4"></textarea>
				<label>Description</label>
			</p>
			<p>
				<select name="task-type">
					<option value="Bugfix">Bugfix</option>
					<option value="Improvement">Improvement</option>
					<option value="New Feature">New Feature</option>
				</select>
				<label>Type</label> 
			</p>
			<p>
				<select name="task-project">
					<?php foreach($projects as $project) { ?>
			 			<option value="<?php echo $project->id ?>"><?php echo $project->name ?></option>
					<?php } ?>
				</select>
				<label>Project</label>  
			</p>
			<p>
				<select name="task-assignee">
					<?php foreach($users as $user) { ?>
			 			<option value="<?php echo $user->id ?>"><?php echo $user->firstname, ' ', $user->lastname ?></option>
					<?php } ?>
				</select>
				<label>Assignee</label>  
			</p>
			<p>
				<input type="submit" value="Create">
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

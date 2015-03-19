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
			 <div id="portal-column" class="portal">
			 	<div class="projects-column-header col1">
				 	<h5><?php echo $col1Title ?></h5>
				 	<span class="col-count"><?php echo $numberOfProjects ?></span>
			 	</div>
			 	<?php echo $noProjects ?>

			 	<?php foreach($projects as $project) { ?>
			 	<div class="project-item-outline">
			 		<a href="board?project=<?php echo $project->id ?>" class="project-item">
			 			<h6><?php echo $project->name ?></h6>
			 			<p class="board-item-description Bug"><?php echo $project->description ?></p>
			 			<img class="settings-icon" alt="" src="img/icon_settings_32.png">
			 		</a>
			 	</div>
				<?php } ?>

				<?php if(!$noProjects && $admin) { ?>
				<div class="project-item-outline">
			 		<a class="add-board-item" href="create_project">
			 			<h6>Create New Project</h6>
			 			<img class="add-board-item-icon" alt="" src="img/icon_add_32.png">
			 		</a>
			 	</div>
			 	<?php } ?>

			 </div>
			 <div id="portal-column" class="portal">
			 	<div class="projects-column-header col2">
				 	<h5><?php echo $col2Title ?></h5>
				 	<span class="col-count"><?php echo $numberOfUsers ?></span>
			 	</div>
			 	<?php echo $noUsers ?>

			 	<?php foreach($users as $user) { ?>
			 	<div class="user-item-outline">
			 		<div class="user-item">
			 			<?php if ($admin) { ?>
			 			<a class="delete-user" href="delete_user?id=<?php echo $user->id ?>"></a>	
			 			<?php } ?>
			 			<img class="user-thumb" alt="" src="img/users/<?php echo strlen($user->img)>1 ? $user->img : 'icon_user_64.png' ?>">
			 			<h6><?php echo $user->firstname, ' ', $user->lastname ?></h6>
			 			<p class="user-item-title"><?php echo $user->title ?></p>
			 		</div>
			 	</div>
				<?php } ?>
				<?php foreach($invitations as $invitedUser) { ?>
			 	<div class="user-item-outline">
			 		<div class="user-item">
			 			<?php if ($admin) { ?>
			 			<a class="delete-user" href="delete_invitation?id=<?php echo $invitedUser->id ?>"></a>
			 			<?php } ?>
			 			<img class="user-thumb" alt="" src="img/users/icon_user_64.png">
			 			<h6><?php echo (strlen($invitedUser->email) > 16) ? substr($invitedUser->email,0,13).'...' : $invitedUser->email ?></h6>
			 			<p class="user-item-pending">Pending</p>
			 		</div>
			 	</div>
				<?php } ?>
				<?php if($admin) { ?>
				<div class="user-item-outline">
			 		<a class="add-user-item" href="invite">
			 			<img class="user-thumb" alt="" src="img/icon_add_64.png">
			 			<h6>Invite someone</h6>
			 		</a>
			 	</div>
			 	<?php } ?>

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

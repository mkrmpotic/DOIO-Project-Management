<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<link href="../css/main.css" rel="stylesheet"/>
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Viga' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../css/jquery.simpleimagecrop.css" media="all">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script src="../js/jquery.simpleimagecrop.js"></script>
	<script type="text/javascript">
    $(window).load(function() {
        $('#crop_container').simpleImageCrop({
            maxPreviewImageWidth: 480,
            maxPreviewImageHeight: 480,
            newImageHeight: 128,
            newImageWidth: 128,
            imageDestination: '../img/users/' + '<?php echo $userImage ?>',
            imageDestination2: '../img/users/' + '<?php echo $userImageThumb ?>',
            phpScriptLocation: '../includes/simpleImageCrop.php',
            successMessage: 'The image has been cropped!',
            warningMessage: 'Warning: Selected area is too small. The image will be blurry.'
        })         
    });  
	</script>
	<title>Doio</title>
</head>
<body>
	<div id="header">
		<div id="menu-icon-container">
			<img id="menu-icon" alt="Menu" src="../img/icon_menu_24.png">
		</div>
		<div id="logo-container">DOIO</div>
		<nav id="main-menu-container">
			<ul>
				<li><a href="portal">Portal</a></li>
				<li><a href="board">Board</a></li>
			</ul>
		</nav>
		

		<div id="user-container">
			<img class="user-thumbnail" alt="" src="../img/users/<?php echo strlen($userImageThumb)>7 ? $userImageThumb : 'icon_user_64.png' ?>">
			<p class="user-name"><?php echo $user ?></p>
			<div class="menu-arrow-container">
				<img class="menu-arrow" alt="" src="../img/icon_left_32.png">
				<img id="logout-icon" alt="" src="../img/icon_logout_32.png">
				<img id="settings-icon" alt="" src="../img/icon_settings_32_2.png">
			</div>
		</div>

		<nav id="user-menu-container">
			<ul>
				<li><a id="settings" href="../edit_user">Settings</a></li>
				<li><a id="logout" href="login?logout">Logout</a></li>
			</ul>
		</nav>

	</div>

	<div id="content" class="board">
		<div id="centered-content" class="register-portal">
			<h1><?php echo $title; ?></h1>
			<?php echo $error; ?>
			<?php if ($success) { ?>
			<noscript>Please enable JavaScript to use the Simple Image Crop plugin.</noscript>
			<div id="crop-wrapper">
				<div id="crop_container" class="hidden">
				    <div id="crop_box">
				        <div id="resize_icon"></div>
				    </div>
				    <div id="crop_message">Leave this text here</div>
				    <img id="image_to_crop" src="../img/users/<?php echo $userImage ?>" alt="">   
				    <div id="crop_button">
				        <img src="../img/cut_icon.png" alt="Crop">
				    </div>
				</div>
				 
				<!-- div below can be put apart from the crop container -->
				<div id="crop_preview" class="hidden">
				    <div id="preview_message">Preview</div>
				    <img id="image_preview" alt="Crop Preview">  
				</div>
			</div>

			<?php } else { ?>

			<form id="register-portal-form" method="post" enctype="multipart/form-data">
			<div class="change-image-container">
				<img alt="" src="../img/users/<?php echo strlen($userImage)>1 ? $userImage : 'icon_user_64.png' ?>">
				<p>
			   	<input type="file" name="image" />
		   		</p>
			</div>
			<p>
				<input type="submit" value="Update">
			</p>
		</form> 

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

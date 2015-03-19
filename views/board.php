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
		<div id="filter-container">
			<form class="filter-form" name="filter-form" method="get">
				<select class="text-right" name="project" onchange="this.form.submit();">
					<option value="">All Projects</option>
					<?php foreach($projects as $project) { ?>
			 			<option value="<?php echo $project->id ?>" <?php echo ($project->id == $currentProject) ? 'selected="selected"' : '' ?>><?php echo $project->name ?></option>
					<?php } ?>             
				</select>
				<h1>Project Board for</h1>
				<select class="text-left" name="assignee" onchange="this.form.submit();">
					<option value="">All Assignees</option>
					<?php foreach($users as $userItem) { ?>
			 			<option value="<?php echo $userItem->id ?>" <?php echo ($userItem->id == $currentAssignee) ? 'selected="selected"' : '' ?>><?php echo $userItem->firstname, ' ', $userItem->lastname ?></option>
					<?php } ?>             
				</select>
			</form>
			

		</div>
		

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
			 <div id="board-col1" class="board-column" data-column="0">
			 	<div class="board-column-header col1">
				 	<h5><?php echo $col1Title ?></h5>
				 	<span class="col-count"><?php echo $numberOfBacklog ?></span>
			 	</div>
			 	<?php echo $noBacklog ?>
			 	<?php foreach($tasksBacklog as $taskBacklog) { ?>
			 	<div class="project-item-outline" data-id="<?php echo $taskBacklog->id ?>" data-portal="<?php echo $taskBacklog->portal ?>">
			 		<a class="board-item" href="task?id=<?php echo $taskBacklog->id ?>">
			 			<h6><?php echo $taskBacklog->title ?></h6>
			 			<p class="board-item-project"><?php echo $taskBacklog->projectName ?></p><p class="board-item-type <?php echo mb_substr($taskBacklog->type, 0, 3); ?>"><?php echo $taskBacklog->type ?></p><p class="board-item-assignee">| <?php echo $taskBacklog->firstname, ' ', $taskBacklog->lastname ?></p>
			 			<img class="settings-icon" alt="" src="img/users/<?php echo strlen($taskBacklog->img)>1 ? $taskBacklog->img : 'icon_user_64.png' ?>">
			 		</a>
			 	</div>
				<?php } ?>
				<?php if ($admin) { ?>
				<div class="board-item-outline">
			 		<a class="add-board-item" href="create_task">
			 			<h6>Add New Task</h6>
			 			<img class="add-board-item-icon" alt="" src="img/icon_add_32.png">
			 		</a>
			 	</div>
			 	<?php } ?>
			 </div>
			 <div id="board-col2" class="board-column" data-column="1">
			 	<div class="board-column-header col2">
				 	<h5><?php echo $col2Title ?></h5>
				 	<span class="col-count"><?php echo $numberOfReady ?></span>
			 	</div>
			 	<?php echo $noReady ?>
			 	<?php foreach($tasksReady as $taskReady) { ?>
			 	<div class="project-item-outline" data-id="<?php echo $taskReady->id ?>" data-portal="<?php echo $taskReady->portal ?>">
			 		<a class="board-item" href="task?id=<?php echo $taskReady->id ?>">
			 			<h6><?php echo $taskReady->title ?></h6>
			 			<p class="board-item-project"><?php echo $taskReady->projectName ?></p><p class="board-item-type <?php echo mb_substr($taskReady->type, 0, 3); ?>"><?php echo $taskReady->type ?></p><p class="board-item-assignee">| <?php echo $taskReady->firstname, ' ', $taskReady->lastname ?></p>
			 			<img class="settings-icon" alt="" src="img/users/<?php echo strlen($taskReady->img)>1 ? $taskReady->img : 'icon_user_64.png' ?>">
			 		</a>
			 	</div>
				<?php } ?>
			 </div>
			 <div id="board-col3" class="board-column" data-column="2">
			 	<div class="board-column-header col3">
				 	<h5><?php echo $col3Title ?></h5>
				 	<span class="col-count"><?php echo $numberOfResolved ?></span>
			 	</div>
			 	<?php echo $noResolved ?>
			 	<?php foreach($tasksResolved as $taskResolved) { ?>
			 	<div class="project-item-outline" data-id="<?php echo $taskResolved->id ?>" data-portal="<?php echo $taskResolved->portal ?>">
			 		<a class="board-item" href="task?id=<?php echo $taskResolved->id ?>">
			 			<h6><?php echo $taskResolved->title ?></h6>
			 			<p class="board-item-project"><?php echo $taskResolved->projectName ?></p><p class="board-item-type <?php echo mb_substr($taskResolved->type, 0, 3); ?>"><?php echo $taskResolved->type ?></p><p class="board-item-assignee">| <?php echo $taskResolved->firstname, ' ', $taskResolved->lastname ?></p>
			 			<img class="settings-icon" alt="" src="img/users/<?php echo strlen($taskResolved->img)>1 ? $taskResolved->img : 'icon_user_64.png' ?>">
			 		</a>
			 	</div>
				<?php } ?>
			 </div>
			 <div id="board-col4" class="board-column" data-column="3">
			 	<div class="board-column-header col4">
				 	<h5><?php echo $col4Title ?></h5>
				 	<span class="col-count"><?php echo $numberOfRelease ?></span>
			 	</div>
			 	<?php echo $noRelease ?>
			 	<?php foreach($tasksRelease as $taskRelease) { ?>
			 	<div class="project-item-outline" data-id="<?php echo $taskRelease->id ?>" data-portal="<?php echo $taskRelease->portal ?>">
			 		<a class="board-item" href="task?id=<?php echo $taskRelease->id ?>">
			 			<h6><?php echo $taskRelease->title ?></h6>
			 			<p class="board-item-project"><?php echo $taskRelease->projectName ?></p><p class="board-item-type <?php echo mb_substr($taskRelease->type, 0, 3); ?>"><?php echo $taskRelease->type ?></p><p class="board-item-assignee">| <?php echo $taskRelease->firstname, ' ', $taskRelease->lastname ?></p>
			 			<img class="settings-icon" alt="" src="img/users/<?php echo strlen($taskRelease->img)>1 ? $taskRelease->img : 'icon_user_64.png' ?>">
			 		</a>
			 	</div>
				<?php } ?>
			 </div>
	</div>

<script>
    $(function () {

		// jQuery UI Draggable
		$(".project-item-outline").draggable({

  			
		
			// brings the item back to its place when dragging is over
			revert:true,
		
			// once the dragging starts, we decrease the opactiy of other items
			// Appending a class as we do that with CSS
			drag:function () {
				$(this).addClass("active");
				$(this).closest("#content").addClass("active");
			},
		
			// removing the CSS classes once dragging is over.
			stop:function () {
				$(this).removeClass("active").closest("#content").removeClass("active");
			}
		});

        // jQuery Ui Droppable
		$(".board-column").droppable({
		
			// The class that will be appended to the to-be-dropped-element (basket)
			activeClass:"active",
		
			// The class that will be appended once we are hovering the to-be-dropped-element (basket)
			hoverClass:"hover",
		
			// The acceptance of the item once it touches the to-be-dropped-element basket
			// For different values http://api.jqueryui.com/droppable/#option-tolerance
			tolerance:"touch",
			drop:function (event, ui) {
		
				var basket = $(this),
						move = ui.draggable,
						itemId = basket.find("ul li[data-id='" + move.attr("data-id") + "']");
		

			
						        $.ajax({
					  url: 'includes/moveTask.php',
					  type: 'POST',
					  dataType: 'html',
					  data: { 
					        'task-id': move.attr("data-id"),
					        'new-col': basket.attr("data-column"),
					    },
					}).done(function ( data ) {
					  basket.append(data);
					  basket.find(".error-bar").remove();
					  move.remove();
					});

		
					
		
			}


		});



    });
</script>
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

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
	<script src="js/menu.js"></script>
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
				<?php if($admin) { ?>
				<li class ="green"><a href="edit_task?id=<?php echo $task->id ?>">Edit Task</a></li>
				<li class ="red"><a href="delete_task?id=<?php echo $task->id ?>">Delete Task</a></li>
				<?php } ?>
			</ul>
		</nav>
		
		<div id="filter-container">
			<form class="filter-form" name="filter-form" method="post">
				<h2>Status:</h2>
				<select class="text-left" name="status" onchange="this.form.submit();">
					<option value="0" <?php echo ($task->status == "Backlog") ? 'selected="selected"' : '' ?>>Backlog</option>
					<option value="1" <?php echo ($task->status == "Ready for Development") ? 'selected="selected"' : '' ?>>Ready for Development</option>
					<option value="2" <?php echo ($task->status == "Resolved") ? 'selected="selected"' : '' ?>>Resolved</option>
					<option value="3" <?php echo ($task->status == "Release") ? 'selected="selected"' : '' ?>>Release</option>           
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
			 <div id="portal-column" class="portal">
			 	<div class="projects-column-header col1">
				 	<h5><?php echo $title ?></h5>
				 	<img class="task-assignee-img" alt="" src="img/users/<?php echo strlen($assignee->img)>1 ? $assignee->img : 'icon_user_64.png' ?>">
				 	
			 	</div>
			 	<?php echo $error ?>

			 	<p class="task-type"><?php echo $task->type; ?></p>
				<h4>Created by:</h4><p class="task-info"><?php echo $task->firstname, ' ', $task->lastname ?></p>
				<h4>Assigned to:</h4><p class="task-info"><?php echo $assignee->firstname, ' ', $assignee->lastname ?></p>
				<h4>Project:</h4><p class="task-info"><?php echo $task->projectName ?></p>
				<h4 class="left-align">Description:</h4>
				<p class="task-desc"><?php echo $task->description; ?></p>

			 </div>
			 <div id="portal-column" class="portal">
			 	<div class="projects-column-header col2">
				 	<h5><?php echo $commentsTitle ?></h5>
				 	<span class="col-count"><?php echo $numOfcomments ?></span>
			 	</div>
			 	<?php echo $noComments ?>
			 	<?php foreach($comments as $comment) { ?>
			 	<div class="comment-item-outline">
			 		<div class="comment-item">
			 			<p class="message"><?php echo $comment->getMessage() ?></p>
			 			<p class="comment-author"><?php echo $comment->getAuthorsFirstName(), ' ', $comment->getAuthorsLastName() ?></p>
			 			<img class="settings-icon" alt="" src="img/users/<?php echo strlen($comment->getAuthorsImg())>1 ? $comment->getAuthorsImg() : 'icon_user_64.png' ?>">
			 		</div>
			 	</div>
				<?php } ?>

				<form id="new-comment-form" method="post">
					<p class="textarea-p">
						<textarea name="comment" cols="30" rows="4"></textarea>
						<label>Comment</label>
					</p>
					<p>
						<input type="submit" value="Post">
					</p>
				</form> 


			 </div>
	</div>

</body>
</html>

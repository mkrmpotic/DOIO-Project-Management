<?php
include('../model/db.class.php');
include('../model/task.class.php');
include('../model/user.class.php');
include('../model/project.class.php');

// ONLY FOR AJAX CALLS
if (isset($_POST["task-id"]) && isset($_POST["new-col"])) {
    $db = db::getInstance();

    $task = Task::getTaskById($db, $_POST["task-id"]);
    
    $taskObj = new Task($db, $task->title, $task->description, $task->type, 
                    $task->creator, -1, $task->project, $_POST["new-col"], $task->assignee, $_POST['task-id']); // change this when implementing estimation

    $taskObj->updateTask();

    $assignee = new User($db, $task->assignee);
    $project = Project::getProjectById($db, $task->project);

?>

    <div class="project-item-outline" data-id="<?php echo $task->id ?>">
		<a class="board-item" href="task?id=<?php echo $task->id ?>">
		<h6><?php echo $task->title ?></h6>
		<p class="board-item-project"><?php echo $project->name ?></p><p class="board-item-type <?php echo mb_substr($task->type, 0, 3); ?>"><?php echo $task->type ?></p><p class="board-item-assignee">| <?php echo $assignee->getFirstName(), ' ', $assignee->getLastName() ?></p>
		<img class="settings-icon" alt="" src="img/users/<?php echo strlen($assignee->getImage())>1 ? $assignee->getImage() : 'icon_user_64.png' ?>">
		</a>
	</div>


<?php
}

?>
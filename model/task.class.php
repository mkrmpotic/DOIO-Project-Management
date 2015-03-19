<?php

Class Task {

private $db;
private $id;
private $title;
private $description;
private $type;
private $creator;
private $estimation;
private $status;
private $assignee;
private $project;

public function __construct() {
    $args = func_get_args();
    $i = func_num_args();
    if (method_exists($this,$f='__construct'.$i)) {
    	call_user_func_array(array($this,$f),$args);
    }
}

private function __construct10($db, $title, $description, $type, $creator, $estimation, $project, $status, $assignee, $id) {
        $this->db = $db;
		$this->title = $title;
		$this->description = $description;
		$this->type = $type;
		$this->creator = $creator;
		$this->project = $project;
		$this->status = $status;
		$this->assignee = $assignee;
		$this->estimation = $estimation;
		$this->id = $id;
}
   
private function __construct9($db, $title, $description, $type, $creator, $estimation, $project, $status, $assignee) {
    $this->db = $db;
	$this->title = $title;	
	$this->description = $description;	
	$this->type = $type;	
	$this->creator = $creator;
	$this->estimation = $estimation;
	$this->project = $project;
	$this->status = $status;
	$this->assignee = $assignee;
}

private function __construct8($db, $title, $description, $type, $creator, $project, $status, $assignee) {
        $this->db = $db;
		$this->title = $title;
		$this->description = $description;
		$this->type = $type;
		$this->creator = $creator;
		$this->project = $project;
		$this->status = $status;
		$this->assignee = $assignee;
}


public function insertTask() {

		$query = $this->db->prepare(
	            "INSERT INTO tasks "
	            . "(title, description, type, creator, estimation, project, status, assignee) "
	            . "VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
	        );

	    $query->execute(array($this->title, $this->description, $this->type, $this->creator, isset($this->estimation) ? $this->estimation : -1, 
	    	$this->project, $this->status, $this->assignee));
	    return 1;
}

public function updateTask() {

	$query = $this->db->prepare(
	        "UPDATE tasks SET "
	        . "title=?, description=?, type=?, project=?, status=?, assignee=? "
	        . "WHERE id=?"
	    );

	$query->execute(array($this->title, $this->description, $this->type, $this->project, $this->status, $this->assignee, $this->id));
	    
	return 1;

}

public static function getTasksByProjectAndStatus($db, $projectId, $status) {

	$query = $db->prepare("SELECT tasks.id, tasks.title, tasks.description, 
	tasks.type, tasks.creator, tasks.estimation, tasks.project, tasks.status, 
	tasks.assignee, users.id as userId, users.img, users.firstname, users.lastname, projects.name as projectName FROM tasks INNER JOIN users INNER JOIN projects WHERE tasks.assignee=users.id AND tasks.project=projects.id AND project=? AND status=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($projectId, $status));

	return $query;

}

public static function getTasksByPortalAndStatus($db, $portalId, $status) {

	$query = $db->prepare("SELECT tasks.id, tasks.title, tasks.description, 
	tasks.type, tasks.creator, tasks.estimation, tasks.project, tasks.status, 
	tasks.assignee, users.id as userId, users.img, users.firstname, users.lastname, projects.name as projectName FROM tasks INNER JOIN users INNER JOIN projects WHERE tasks.assignee=users.id AND tasks.project=projects.id AND users.portal=? AND status=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($portalId, $status));

	return $query;

}

public static function getTasksByProjectStatusAndUser($db, $projectId, $status, $userId) {

	$query = $db->prepare("SELECT tasks.id, tasks.title, tasks.description, 
	tasks.type, tasks.creator, tasks.estimation, tasks.project, tasks.status, 
	tasks.assignee, users.id as userId, users.img, users.firstname, users.lastname, projects.name as projectName FROM tasks INNER JOIN users INNER JOIN projects ON tasks.project=projects.id WHERE users.id=? AND tasks.assignee=? AND project=? AND status=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($userId, $userId, $projectId, $status));

	return $query;

}

public static function getTasksByPortalStatusAndUser($db, $portalId, $status, $userId) {

	$query = $db->prepare("SELECT tasks.id, tasks.title, tasks.description, 
	tasks.type, tasks.creator, tasks.estimation, tasks.project, tasks.status, 
	tasks.assignee, users.id as userId, users.img, users.firstname, users.lastname, projects.name as projectName FROM tasks INNER JOIN users INNER JOIN projects ON tasks.project=projects.id WHERE users.id=? AND tasks.assignee=? AND users.portal=? AND status=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($userId, $userId, $portalId, $status));

	return $query;

}

public static function getTaskByIdAndPortal($db, $taskId, $portalId) {
	$query = $db->prepare("SELECT tasks.id, tasks.title, tasks.description, 
	tasks.type, tasks.creator, tasks.estimation, tasks.project, tasks.status, 
	tasks.assignee, users.id as userId, users.img, users.firstname, users.lastname, projects.name as projectName FROM tasks INNER JOIN users INNER JOIN projects WHERE tasks.creator=users.id AND tasks.project=projects.id AND users.portal=? AND tasks.id=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($portalId, $taskId));

	return self::getStatusByCode($query->fetch());
}

public static function getAssigneeByTaskId($db, $taskId) {
	$query = $db->prepare("SELECT * FROM tasks INNER JOIN users WHERE tasks.assignee=users.id AND tasks.id=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($taskId));

	return $query->fetch();
}

public static function getTaskById($db, $taskId) {

	$query = $db->prepare("SELECT * FROM tasks WHERE id=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($taskId));

	return $query->fetch();
}

public static function deleteTaskById($db, $taskId) {

	$query = $db->prepare("DELETE FROM tasks WHERE id=?");
	$query->execute(array($taskId));

}

public function updateTaskStatus() {

	$query = $this->db->prepare(
	        "UPDATE tasks SET "
	        . "status=? "
	        . "WHERE id=?"
	    );

	$query->execute(array($this->status, $this->id));
	    
	return 1;

}

public static function getStatusByCode($task) {
	switch ($task->status) {
	    case 0:
	        $task->status = "Backlog";
	        return $task;
	    case 1:
	        $task->status = "Ready for Development";
	        return $task;
	    case 2:
	        $task->status = "Resolved";
	        return $task;
	    case 3:
	        $task->status = "Release";
	        return $task;
	}
}

public function setStatus($status) {
	$this->status = $status;
}

}




?>

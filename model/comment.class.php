<?php

Class Comment {

private $db;
private $id;
private $message;
private $firstname;
private $lastname;
private $img;
private $task;

public function __construct() {
	$author = new User();
    $args = func_get_args();
    $i = func_num_args();
    if (method_exists($this,$f='__construct'.$i)) {
    	call_user_func_array(array($this,$f),$args);
    }
}

private function __construct4($db, $message, $author, $task) {
        $this->db = $db;
		$this->message = $message;
		$this->author = $author;
		$this->task = $task;
}

public function insertComment() {

		$query = $this->db->prepare(
	            "INSERT INTO comments "
	            . "(message, author, task) "
	            . "VALUES (?, ?, ?)"
	        );

	    $query->execute(array($this->message, $this->author, $this->task));
	    return 1;
}

public static function getCommentsByTask($db, $taskId) {
	$query = $db->prepare("SELECT * FROM comments INNER JOIN users ON comments.author=users.id WHERE task=?");
	$query->setFetchMode(PDO::FETCH_CLASS, 'Comment');
	$query->execute(array($taskId));

	return $query;
}

public function getId() {
	return $this->id;
}

public function getMessage() {
	return $this->message;
}

public function getAuthorsFirstName() {
	return $this->firstname;
}

public function getAuthorsLastName() {
	return $this->lastname;
}

public function getAuthorsImg() {
	return $this->img;
}

public function getTask() {
	return $this->task;
}


}




?>

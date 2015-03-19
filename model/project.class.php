<?php

Class Project {

private $db;
private $projectName;
private $description;
private $portalId;


public function __construct($db, $projectName, $description, $portalId) {
	$this->db = $db;
	$this->projectName = $projectName;	
	$this->description = $description;
	$this->portalId = $portalId;	
}

public function InsertProject() {

		$query = $this->db->prepare(
	            "INSERT INTO projects "
	            . "(name, description, portal) "
	            . "VALUES (?, ?, ?)"
	        );

	    $query->execute(array($this->projectName, $this->description, $this->portalId));
	    return 1;
}

public static function getProjects($db, $portalId) {

	$query = $db->prepare("SELECT * FROM projects WHERE portal=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($portalId));

	return $query;
}

public static function getProjectById($db, $projectId) {

	$query = $db->prepare("SELECT * FROM projects WHERE id=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($projectId));

	return $query->fetch();
}

}




?>

<?php

Class Portal {

private $db;
private $id;
private $portalName;
private $ownerId;


public function __construct($db, $portalName, $ownerId) {
	$this->db = $db;
	$this->portalName = $portalName;	
	$this->ownerId = $ownerId;	
}

public function InsertPortal() {

		$query = $this->db->prepare(
	            "INSERT INTO portals "
	            . "(name, owner) "
	            . "VALUES (?, ?)"
	        );

	    $query->execute(array($this->portalName, $this->ownerId));
	    $this->id = $this->getPortalId();
	    return 1;
}

public static function getPortalById($db, $portalId) {

	$query = $db->prepare("SELECT * FROM portals WHERE id=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($portalId));
	if ($query->rowCount() > 0) {
		return $query -> fetch();
	} else {
		return 0;
	}
}

private function getPortalId() {
	$query = $this->db->prepare("SELECT * FROM portals WHERE owner=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($this->ownerId));

	if ($query->rowCount() > 0) {
		return $query -> fetch() -> id;
	} else {
		return -1;
	}

}

public static function getPortalOwnerById($db, $id) {
	$query = $db->prepare("SELECT * FROM portals WHERE id=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($id));

	if ($query->rowCount() > 0) {
		return $query -> fetch() -> owner;
	} else {
		return -1;
	}

}

public function getId() {
	return $this->id;
}

}




?>

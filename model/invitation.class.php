<?php

Class Invitation {

private $id;
private $db;
private $email;
private $hash;
private $portalId;
private $title;


public function __construct($db, $email, $portalId, $title) {
	$this->db = $db;
	$this->email = $email;	
	$this->portalId = $portalId;	
	$this->title = $title;	
	$this->hash = $this->generateHash();
}

public function InsertInvitation() {

		$query = $this->db->prepare(
	            "INSERT INTO invitations "
	            . "(email, hash, portal, title) "
	            . "VALUES (?, ?, ?, ?)"
	        );

	    $query->execute(array($this->email, $this->hash, $this->portalId, $this->title));
	    return 1;
}

private function generateHash() {

		return substr(str_shuffle(MD5(microtime())), 0, 32);
}

public static function getPendingInvitations($db, $portalId) {

	$query = $db->prepare("SELECT * FROM invitations WHERE portal=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($portalId));

	return $query;
}

public static function getInvitationByHash($db, $hash) {

	$query = $db->prepare("SELECT * FROM invitations WHERE hash=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($hash));
	if ($query->rowCount() > 0) {
		return $query -> fetch();
	} else {
		return 0;
	}

}

public static function getInvitationById($db, $id) {

	$query = $db->prepare("SELECT * FROM invitations WHERE id=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($id));
	if ($query->rowCount() > 0) {
		return $query -> fetch();
	} else {
		return 0;
	}

}

public static function deleteInvitationByHash($db, $hash) {

	$query = $db->prepare("DELETE FROM invitations WHERE hash=?");
	$query->execute(array($hash));

}

public static function deleteInvitationById($db, $id) {

	$query = $db->prepare("DELETE FROM invitations WHERE id=?");
	$query->execute(array($id));

}

}




?>

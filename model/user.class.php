<?php

Class User {

private $db;
private $id;
private $firstName;
private $lastName;
private $username;
private $email;
private $password;
private $img;
private $portal;
private $title;


public function __construct() {
    $args = func_get_args();
    $i = func_num_args();
    if (method_exists($this,$f='__construct'.$i)) {
    	call_user_func_array(array($this,$f),$args);
    }
}
   
private function __construct2($db, $userId) {
        $this->db = $db;
		$this->id = $userId;
		$user = $this->getUserById($userId);
		if ($user !== 0) {
			$this->firstName = $user->firstname;
			$this->lastName = $user->lastname;
			$this->username = $user->username;
			$this->email = $user->email;
			$this->password = $user->password;
			$this->img = $user->img;
			$this->portal = $user->portal;
			$this->title = $user->title;
		}	
}

private function __construct6($db, $firstName, $lastName, $username, $email, $password) {
        $this->db = $db;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
}
   
private function __construct8($db, $firstName, $lastName, $username, $email, $password, $portal, $title) {
        $this->db = $db;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
		$this->portal = $portal;
		$this->title = $title;	
} 


private function usernameValidation($username) {
	$query = $this->db->prepare(
            "SELECT * "
            . "FROM users "
            . "WHERE username = ?"
        );

    $query->execute(array($username));

    if ($query->rowCount()) {
            return 0;
    } else { 
        	return 1;
    }
}

private function emailValidation($email) {
	$query = $this->db->prepare(
            "SELECT * "
            . "FROM users "
            . "WHERE email = ?"
        );

    $query->execute(array($email));

    if ($query->rowCount()) {
            return 0;
    } else { 
        	return 1;
    }
}

public function InsertUser() {
	$usernameOk = $this->usernameValidation($this->username);
	$emailOk = $this->emailValidation($this->email);
	if ($usernameOk && $emailOk) {
		$salt = "Fkč3Woć2";
		$query = $this->db->prepare(
	            "INSERT INTO users "
	            . "(firstname, lastname, email, username, password, portal, title) "
	            . "VALUES (?, ?, ?, ?, SHA1(?), ?, ?)"
	        );

	    $query->execute(array($this->firstName, $this->lastName, $this->email, $this->username, $salt . $this->password, isset($this->portal) ? $this->portal : -1, isset($this->title) ? $this->title : ''));
	    $this->id = $this->getUserIdByUsername();
	    return 1;
	} else {
		if (!$usernameOk) $error = 'The username you entered already exists. Please choose another one.';
		if (!$emailOk) $error = 'A user with the email you specified already exists.';
		return $error;
	}

}

public function updateUserInfo() {
	$this->id = $this->getUserIdByUsername();

	$query = $this->db->prepare(
	        "UPDATE users SET "
	        . "firstname=?, lastname=?, portal=?, email=?, title=? "
	        . "WHERE id=?"
	    );

	$query->execute(array($this->firstName, $this->lastName, isset($this->portal) ? $this->portal : -1, $this->email, isset($this->title) ? $this->title : '', $this->id));
	    
	return 1;

}

public function updateUserPassword() {
	$this->id = $this->getUserIdByUsername();
	$salt = "Fkč3Woć2";
	$query = $this->db->prepare(
	        "UPDATE users SET "
	        . "password=SHA(?) "
	        . "WHERE id=?"
	    );

	$query->execute(array($salt . $this->password, $this->id));
	    
	return 1;

}

public function updateUserImage() {
	$this->id = $this->getUserIdByUsername();

	$query = $this->db->prepare(
	        "UPDATE users SET "
	        . "img=? "
	        . "WHERE id=?"
	    );

	$query->execute(array($this->img, $this->id));
	    
	return 1;

}

public function getFirstName() {
	return $this->firstName;
}

public function getLastName() {
	return $this->lastName;
}

public function getPortal() {
	return $this->portal;
}

public function getId() {
	return $this->id;
}

public function getEmail() {
	return $this->email;
}

public function getTitle() {
	return $this->title;
}

public function getUsername() {
	return $this->username;
}

public function getImage() {
	return $this->img;
}

public function setImage($img) {
	$this->img = $img;
}

public function setPortal($portal) {
	$this->portal = $portal;
}

public function setFirstName($firstName) {
	$this->firstName = $firstName;
}

public function setLastName($lastName) {
	$this->lastName = $lastName;
}

public function setEmail($email) {
	$this->email = $email;
}

public function setTitle($title) {
	$this->title = $title;
}

public function setPassword($password) {
	$this->password = $password;
}

public static function getUsersByPortal($db, $portalId) {

	$query = $db->prepare("SELECT * FROM users WHERE portal=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($portalId));

	return $query;
}

private function getUserById($userId) {

	$query = $this->db->prepare("SELECT * FROM users WHERE id=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($userId));

	if ($query->rowCount() > 0) {
		return $query -> fetch();
	} else {
		return 0;
	}

}

public static function getUserIdOnLogin($db, $username, $password) {
	$salt = "Fkč3Woć2";
	$query = $db->prepare("SELECT * FROM users WHERE username=? AND password=SHA1(?)");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($username, $salt . $password));

	if ($query->rowCount() > 0) {
		return $query -> fetch() -> id;
	} else {
		return -1;
	}

}

private function getUserIdByUsername() {
	$query = $this->db->prepare("SELECT * FROM users WHERE username=?");
	$query->setFetchMode(PDO::FETCH_OBJ);
	$query->execute(array($this->username));

	if ($query->rowCount() > 0) {
		return $query -> fetch() -> id;
	} else {
		return -1;
	}

}

public static function deleteUserById($db, $userId) {

	$query = $db->prepare("DELETE FROM users WHERE id=?");
	$query->execute(array($userId));

	$query = $db->prepare("DELETE FROM tasks WHERE assignee=?");
	$query->execute(array($userId));

}

}




?>

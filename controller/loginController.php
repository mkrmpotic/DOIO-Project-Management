<?php

Class loginController Extends baseController {

public function index() {
    
    $this->registry->template->error = '';

    if ($_POST) {
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {

            $userId = User::getUserIdOnLogin($this->registry->db, $_POST['username'], $_POST['password']);
            if ($userId !== -1){
                $_SESSION['user'] = $userId;
                header("Location: portal");
                exit();
            } else {
                $this->registry->template->error = '<p class="error-bar">Invalid username/password combination. Please try again.</p>';
            };

          

        } else {
            $this->registry->template->error = '<p class="error-bar">All fields are mandatory.</p>';
        }
    }


	if (isset($_GET['logout'])) {
		unset($_SESSION['user']);
	}

	
	

	/*** set a template variable ***/
        $this->registry->template->title = 'Log in and get to work!';
	/*** load the register template ***/
        $this->registry->template->show('login');
}

}



?>

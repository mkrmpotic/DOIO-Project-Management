<?php

Class registerController Extends baseController {

public function index() {
    $this->registry->template->error = '';

    if ($_POST) {
        if (isset($_POST['first-name']) && !empty($_POST['first-name']) && isset($_POST['last-name']) && !empty($_POST['last-name']) 
        && isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['email']) && !empty($_POST['email']) 
        && isset($_POST['password1']) && !empty($_POST['password1']) && isset($_POST['password2']) && !empty($_POST['password2'])) {

        if ($this->passwordValidation($_POST['password1'], $_POST['password2'])) {
            $user = new User($this->registry->db, $_POST['first-name'], $_POST['last-name'], $_POST['username'], $_POST['email'], $_POST['password1']);
            $registrationStatus = $user->insertUser();
            if ($registrationStatus != 1){
                $this->registry->template->error = '<p class="error-bar">' . $registrationStatus . '</p>';
            } else {
                $_SESSION['user'] = $user->getId();
                header("Location: register/portal");
                exit();
            };

        } else {
            $this->registry->template->error = '<p class="error-bar">The passwords you entered do not match.</p>';
        }        

        } else {
            $this->registry->template->error = '<p class="error-bar">All fields are mandatory.</p>';
        }
    }

	
	

	/*** set a template variable ***/
        $this->registry->template->title = 'Register New User';
	/*** load the register template ***/
        $this->registry->template->show('register');
}

public function portal() {

    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: ../login");
        exit();
    }

    $this->registry->template->error = '';
    if ($_POST) {
        if (isset($_POST['portal-name']) && !empty($_POST['portal-name'])) {

            $portal = new Portal($this->registry->db, $_POST['portal-name'], $user->getId());
            $portalStatus = $portal->insertPortal();
            if ($portalStatus != 1){
                $this->registry->template->error = '<p class="error-bar">' . $portalStatus . '</p>';
            } else {
                $user->setPortal($portal->getId());
                $user->updateUserInfo();
                header("Location: ../portal");
                exit();
            };

              

        } else {
            $this->registry->template->error = '<p class="error-bar">All fields are mandatory.</p>';
        }
    }


        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
    /*** set a template variable ***/
        $this->registry->template->title = 'Create a Portal for Your Team';
    /*** load the register template ***/
        $this->registry->template->show('register_portal');
}

private function passwordValidation($password1, $password2) {
    if ($password1 === $password2) {
            return 1;
    } else { 
            return 0;
    }
}

}



?>

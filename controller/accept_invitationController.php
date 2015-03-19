<?php

Class accept_invitationController Extends baseController {

public function index() {
    $this->registry->template->error = '';

    if (isset($_GET['invitation']) && !empty($_GET['invitation'])) {
        $invitation = Invitation::getInvitationByHash($this->registry->db, $_GET['invitation']);

        if ($invitation !== 0) {
            if ($_POST) {
            if (isset($_POST['first-name']) && !empty($_POST['first-name']) && isset($_POST['last-name']) && !empty($_POST['last-name']) 
            && isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['email']) && !empty($_POST['email']) 
            && isset($_POST['password1']) && !empty($_POST['password1']) && isset($_POST['password2']) && !empty($_POST['password2'])) {

            if ($this->passwordValidation($_POST['password1'], $_POST['password2'])) {
                $user = new User($this->registry->db, $_POST['first-name'], $_POST['last-name'], $_POST['username'], $_POST['email'], $_POST['password1'], 
                    $invitation->portal, $invitation->title);
                $registrationStatus = $user->insertUser();
                if ($registrationStatus != 1){
                    $this->registry->template->error = '<p class="error-bar">' . $registrationStatus . '</p>';
                } else {
                    Invitation::deleteInvitationByHash($this->registry->db, $_GET['invitation']);
                    header("Location: portal");
                    exit();
                };

            } else {
                $this->registry->template->error = '<p class="error-bar">The passwords you entered do not match.</p>';
            }        

            } else {
                $this->registry->template->error = '<p class="error-bar">All fields are mandatory.</p>';
            }
        }

        } else {
            header("Location: invalid_invitation");
            exit();
        }



    } else {
        header("Location: invalid_invitation");
        exit();
    }


	$portal = Portal::getPortalById($this->registry->db, $invitation->portal);
	

	/*** set a template variable ***/
        $this->registry->template->title = 'Accept Invitation to ' . $portal->name . ' as ' . $invitation->title;
        $this->registry->template->email = $invitation->email;
	/*** load the register template ***/
        $this->registry->template->show('accept-invitation');
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

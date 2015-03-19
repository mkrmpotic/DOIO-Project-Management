<?php

Class inviteController Extends baseController {

public function index() {
    
    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: login");
        exit();
    }

    $this->registry->template->error = '';

    if ($_POST) {
        if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['title']) && !empty($_POST['title'])) {

            $invitation = new Invitation($this->registry->db, $_POST['email'], $user->getPortal(), $_POST['title']);
            $invitationStatus = $invitation->insertInvitation();
            if ($invitationStatus != 1){
                $this->registry->template->error = '<p class="error-bar">' . $invitationStatus . '</p>';
            } else {
                header("Location: portal");
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
        $this->registry->template->title = "Send an Invitation to the Employee's E-Mail";
    /*** load the register template ***/
        $this->registry->template->show('invite');
}


}



?>

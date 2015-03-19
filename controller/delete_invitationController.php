<?php

Class delete_invitationController Extends baseController {

public function index() {
    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: login");
        exit();
    }

    $this->registry->template->error = '';

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $invitationToDelete = Invitation::getInvitationById($this->registry->db, $_GET['id']);

        if ($invitationToDelete->portal != $user->getPortal()) {
            header("Location: 404");
            exit();
        }

                if (isset($_GET['delete-invitation'])) {
                    Invitation::deleteInvitationById($this->registry->db, $_GET['id']);
                    header("Location: portal");
                    exit();
                }
   

        } else {
            $this->registry->template->error = "<p class='error-bar'>That invitation doesn't exist.</p>";
        }

    
        $this->registry->template->invitationToDeleteId = $_GET['id'];

        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
    /*** set a template variable ***/
        $this->registry->template->title = 'Withdraw invitation to ' . $invitationToDelete->email . '?';
    /*** load the register template ***/
        $this->registry->template->show('delete-invitation');
}


}



?>

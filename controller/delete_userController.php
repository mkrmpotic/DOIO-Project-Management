<?php

Class delete_userController Extends baseController {

public function index() {
    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: login");
        exit();
    }

    $this->registry->template->error = '';

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $userToDelete = new User($this->registry->db, $_GET['id']);

        if ($userToDelete->getPortal() != $user->getPortal()) {
            header("Location: 404");
            exit();
        }



            

                if (isset($_GET['delete-user'])) {
                    User::deleteUserById($this->registry->db, $_GET['id']);
                    header("Location: portal");
                    exit();
                }
   

        } else {
            $this->registry->template->error = "<p class='error-bar'>That user doesn't exist.</p>";
        }

    
        $this->registry->template->userToDeleteId = $_GET['id'];

        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
    /*** set a template variable ***/
        $this->registry->template->title = 'Delete user ' . $userToDelete->getUsername() . '?';
    /*** load the register template ***/
        $this->registry->template->show('delete-user');
}


}



?>

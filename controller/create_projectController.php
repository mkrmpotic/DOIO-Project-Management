<?php

Class create_projectController Extends baseController {

public function index() {
    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: login");
        exit();
    }

    $this->registry->template->error = '';

    if ($_POST) {
        if (isset($_POST['project-name']) && !empty($_POST['project-name']) && isset($_POST['project-description']) && !empty($_POST['project-description'])) {

            $project = new Project($this->registry->db, $_POST['project-name'], $_POST['project-description'], $user->getPortal());
            $projectStatus = $project->insertProject();
            if ($projectStatus != 1){
                $this->registry->template->error = '<p class="error-bar">' . $projectStatus . '</p>';
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
        $this->registry->template->title = 'Create a New Project';
    /*** load the register template ***/
        $this->registry->template->show('create-project');
}


}



?>

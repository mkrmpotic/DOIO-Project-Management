<?php

Class delete_taskController Extends baseController {

public function index() {
    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: login");
        exit();
    }

    $this->registry->template->error = '';

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $task = Task::getTaskById($this->registry->db, $_GET['id']);
        if (Project::getProjectByID($this->registry->db, $task->project)->portal != $user->getPortal()) {
            header("Location: 404");
            exit();
        }



            $task = Task::getTaskByIdAndPortal($this->registry->db, $_GET['id'], $user->getPortal());
            $this->registry->template->task = $task;

                if (isset($_GET['delete-task'])) {
                    Task::deleteTaskById($this->registry->db, $_GET['id']);
                        header("Location: board");
                        exit();
                    }
   

        } else {
            $this->registry->template->error = "<p class='error-bar'>That task doesn't exist.</p>";
        }

    

        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
    /*** set a template variable ***/
        $this->registry->template->title = 'Delete task "' . $task->title . '"?';
    /*** load the register template ***/
        $this->registry->template->show('delete-task');
}


}



?>

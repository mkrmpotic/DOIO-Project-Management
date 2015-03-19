<?php

Class create_taskController Extends baseController {

public function index() {
    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: login");
        exit();
    }

    $this->registry->template->error = '';

    $projects = Project::getProjects($this->registry->db, $user->getPortal());
    $this->registry->template->projects = $projects;

    $users = User::getUsersByPortal($this->registry->db, $user->getPortal());
    $this->registry->template->users = $users;

    if ($_POST) {
        if (isset($_POST['task-title']) && !empty($_POST['task-title']) && isset($_POST['task-project']) && !empty($_POST['task-project']) 
            && isset($_POST['task-type']) && !empty($_POST['task-type']) && isset($_POST['task-assignee']) && !empty($_POST['task-assignee'])) {

            $task = new Task($this->registry->db, $_POST['task-title'], isset($_POST['task-description']) ? $_POST['task-description'] : '', $_POST['task-type'], 
                $user->getId(), $_POST['task-project'], 0, $_POST['task-assignee']);
            $taskStatus = $task->insertTask();
            if ($taskStatus != 1){
                $this->registry->template->error = '<p class="error-bar">' . $taskStatus . '</p>';
            } else {
                header("Location: board?project=" . $_POST['task-project']);
                exit();
            };

              

        } else {
            $this->registry->template->error = '<p class="error-bar">Title field is mandatory.</p>';
        }
    }

        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
    /*** set a template variable ***/
        $this->registry->template->title = 'Create a New Task';
    /*** load the register template ***/
        $this->registry->template->show('create-task');
}


}



?>

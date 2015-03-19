<?php

Class edit_taskController Extends baseController {

public function index() {
    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: login");
        exit();
    }

    $this->registry->template->error = '';

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $projectId = Task::getTaskById($this->registry->db, $_GET['id'])->project;
        if (Project::getProjectByID($this->registry->db, $projectId)->portal != $user->getPortal()) {
            header("Location: 404");
            exit();
        }


            $projects = Project::getProjects($this->registry->db, $user->getPortal());
            $this->registry->template->projects = $projects;

            $users = User::getUsersByPortal($this->registry->db, $user->getPortal());
            $this->registry->template->users = $users;

            $task = Task::getTaskByIdAndPortal($this->registry->db, $_GET['id'], $user->getPortal());
            $this->registry->template->task = $task;
            $this->registry->template->assignee = Task::getAssigneeByTaskId($this->registry->db, $_GET['id']);

            if ($_POST) {
                if (isset($_POST['task-title']) && !empty($_POST['task-title']) && isset($_POST['task-project']) && !empty($_POST['task-project']) 
                && isset($_POST['task-type']) && !empty($_POST['task-type']) && isset($_POST['task-assignee']) && !empty($_POST['task-assignee']) 
                && isset($_POST['task-status'])) {

                    $task = new Task($this->registry->db, $_POST['task-title'], isset($_POST['task-description']) ? $_POST['task-description'] : '', $_POST['task-type'], 
                    $task->creator, -1, $_POST['task-project'], $_POST['task-status'], $_POST['task-assignee'], $_GET['id']); // change this when implementing estimation

                    $taskStatus = $task->updateTask();

                    if ($taskStatus){
                        header("Location: board");
                        exit();
                    } else {
                        $this->registry->template->error = '<p class="error-bar">' . $taskStatus . '</p>';
                    };

              

                } else {
                    $this->registry->template->error = '<p class="error-bar">All fields except Title are mandatory.</p>';
                }
            }

            

        } else {
            $this->registry->template->error = "<p class='error-bar'>That task doesn't exist.</p>";
        }

    

        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
    /*** set a template variable ***/
        $this->registry->template->title = 'Edit Existing Task';
    /*** load the register template ***/
        $this->registry->template->show('edit-task');
}


}



?>

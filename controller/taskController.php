<?php

Class taskController Extends baseController {

public function index() {
    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: login");
        exit();
    }

    if ($user->getId() == Portal::getPortalOwnerById($this->registry->db, $user->getPortal())) {
        $this->registry->template->admin = true;
    } else {
        $this->registry->template->admin = false;
    }

    $this->registry->template->error = '';


    if ($_GET) {
        if (isset($_GET['id']) && !empty($_GET['id'])) {

            $task = Task::getTaskByIdAndPortal($this->registry->db, $_GET['id'], $user->getPortal());

            if (isset($_POST['status']) && !empty($_POST['status'])) {
                $changedTask = new Task($this->registry->db, $task->title, $task->description, $task->type, $task->creator, $task->estimation, $task->project, $_POST['status'], $task->assignee, $_GET['id']);
                $changedTask->updateTaskStatus();
                $task->status = $_POST['status'];
                $task = Task::getStatusByCode($task);
            }

            if (isset($_POST['comment']) && !empty($_POST['comment'])) {
                $newComment = new Comment($this->registry->db, $_POST['comment'], $user->getId(), $_GET['id']);
                $newComment->insertComment();
            }

            
            $this->registry->template->task = $task;

            $this->registry->template->assignee = Task::getAssigneeByTaskId($this->registry->db, $_GET['id']);
            $this->registry->template->title = 'Task: ' . $task->title;
            $this->registry->template->commentsTitle = 'Comments';

            $comments = Comment::getCommentsByTask($this->registry->db, $_GET['id']);
            $this->registry->template->comments = $comments;
            $numOfcomments = $comments->rowCount();
            $this->registry->template->numOfcomments = $numOfcomments;

            if ($numOfcomments > 0) {
                $this->registry->template->noComments = "";
            } else {
                $this->registry->template->noComments = "<p class='error-bar'>No comments.</p>";
            }
            

        } else {
            $this->registry->template->error = "<p class='error-bar'>That task doesn't exist.</p>";
            $this->registry->template->title = 'Task Not Found';
        }

    }

        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
    /*** load the register template ***/
        $this->registry->template->show('task');
}


}



?>

<?php

Class boardController Extends baseController {

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

    $this->registry->template->noBacklog = '';
    $this->registry->template->noReady = '';
    $this->registry->template->noResolved = '';
    $this->registry->template->noRelease = '';

    $projects = Project::getProjects($this->registry->db, $user->getPortal());
    $this->registry->template->projects = $projects;

    $users = User::getUsersByPortal($this->registry->db, $user->getPortal());
    $this->registry->template->users = $users;

    if (isset($_GET['project']) && !empty($_GET['project'])) {
        if (Project::getProjectByID($this->registry->db, $_GET['project'])->portal != $user->getPortal()) {
            header("Location: 404");
            exit();
        }

        if (isset($_GET['assignee']) && !empty($_GET['assignee'])) {
            $this->registry->template->currentAssignee = $_GET['assignee'];
            $this->registry->template->currentProject = $_GET['project'];
        
            $tasksBacklog = Task::getTasksByProjectStatusAndUser($this->registry->db, $_GET['project'], 0, $_GET['assignee']);
            $tasksReady = Task::getTasksByProjectStatusAndUser($this->registry->db, $_GET['project'], 1, $_GET['assignee']);
            $tasksResolved = Task::getTasksByProjectStatusAndUser($this->registry->db, $_GET['project'], 2, $_GET['assignee']);
            $tasksRelease = Task::getTasksByProjectStatusAndUser($this->registry->db, $_GET['project'], 3, $_GET['assignee']);

        } else {
            $this->registry->template->currentAssignee = -1;
            $this->registry->template->currentProject = $_GET['project'];
        
            $tasksBacklog = Task::getTasksByProjectAndStatus($this->registry->db, $_GET['project'], 0);
            $tasksReady = Task::getTasksByProjectAndStatus($this->registry->db, $_GET['project'], 1);
            $tasksResolved = Task::getTasksByProjectAndStatus($this->registry->db, $_GET['project'], 2);
            $tasksRelease = Task::getTasksByProjectAndStatus($this->registry->db, $_GET['project'], 3);   
        }

        

    } else {
        if (isset($_GET['assignee']) && !empty($_GET['assignee'])) {
            $this->registry->template->currentProject = -1;
            $this->registry->template->currentAssignee = $_GET['assignee'];
        
            $tasksBacklog = Task::getTasksByPortalStatusAndUser($this->registry->db, $user->getPortal(), 0, $_GET['assignee']);
            $tasksReady = Task::getTasksByPortalStatusAndUser($this->registry->db, $user->getPortal(), 1, $_GET['assignee']);
            $tasksResolved = Task::getTasksByPortalStatusAndUser($this->registry->db, $user->getPortal(), 2, $_GET['assignee']);
            $tasksRelease = Task::getTasksByPortalStatusAndUser($this->registry->db, $user->getPortal(), 3, $_GET['assignee']);

        } else {
            $this->registry->template->currentProject = -1;
            $this->registry->template->currentAssignee = -1;

            $tasksBacklog = Task::getTasksByPortalAndStatus($this->registry->db, $user->getPortal(), 0);
            $tasksReady = Task::getTasksByPortalAndStatus($this->registry->db, $user->getPortal(), 1);
            $tasksResolved = Task::getTasksByPortalAndStatus($this->registry->db, $user->getPortal(), 2);
            $tasksRelease = Task::getTasksByPortalAndStatus($this->registry->db, $user->getPortal(), 3); 
        }

        
    }

    $this->registry->template->numberOfBacklog = $tasksBacklog->rowCount();
    $this->registry->template->numberOfReady = $tasksReady->rowCount();
    $this->registry->template->numberOfResolved = $tasksResolved->rowCount();
    $this->registry->template->numberOfRelease = $tasksRelease->rowCount();

    $this->registry->template->tasksBacklog = $tasksBacklog;
    $this->registry->template->tasksReady = $tasksReady;
    $this->registry->template->tasksResolved = $tasksResolved;
    $this->registry->template->tasksRelease = $tasksRelease;

    if ($tasksBacklog->rowCount() == 0)
        $this->registry->template->noBacklog = '<p class="error-bar blue">No tasks on hold.</p>';

    if ($tasksReady->rowCount() == 0)
        $this->registry->template->noReady = '<p class="error-bar yellow">No task here at the moment. Enjoy your free time :)</p>';

    if ($tasksResolved->rowCount() == 0)
        $this->registry->template->noResolved = "<p class='error-bar green'>No resolved tasks.</p>";

    if ($tasksRelease->rowCount() == 0)
        $this->registry->template->noRelease = '<p class="error-bar red">Nothing here.</p>';


	

	/*** set a template variable ***/
        $this->registry->template->col1Title = 'Backlog';
        $this->registry->template->col2Title = 'Ready for Development';
        $this->registry->template->col3Title = 'Resolved';
        $this->registry->template->col4Title = 'Release';


        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
        $this->registry->template->title = 'Project Board';
	/*** load the register template ***/
        $this->registry->template->show('board');
}

}



?>

<?php

Class portalController Extends baseController {

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

    $this->registry->template->noProjects = '';
    $this->registry->template->noUsers = '';
    
    $projects = Project::getProjects($this->registry->db, $user->getPortal());
    $this->registry->template->projects = $projects;
    $this->registry->template->numberOfProjects = $projects->rowCount();

    if ($projects->rowCount() == 0) {
        $this->registry->template->noProjects = '<div class="no-projects-message"><p>No projects here :(</p><a class="new-project-btn" href="create_project">Create a New Project</a></div>';
    }

    $users = User::getUsersByPortal($this->registry->db, $user->getPortal());
    $this->registry->template->users = $users;
    $this->registry->template->numberOfUsers = $users->rowCount();

    $invitations = Invitation::getPendingInvitations($this->registry->db, $user->getPortal());
    $this->registry->template->invitations = $invitations;

    if ($users->rowCount() == 0 && $invitations->rowCount() == 0) {
        $this->registry->template->noUsers = '<div class="no-users-message"><p>No users here :(</p><a class="invite-user-btn" href="invite">Invite Someone</a></div>';
    }
	

	/*** set a template variable ***/
        $this->registry->template->col1Title = 'Projects';
        $this->registry->template->col2Title = 'Users';

        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
	/*** load the register template ***/
        $this->registry->template->title = 'Portal';
        $this->registry->template->show('portal');
}

}



?>

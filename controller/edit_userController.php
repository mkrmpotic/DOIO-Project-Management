<?php

Class edit_userController Extends baseController {

public function index() {
    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: login");
        exit();
    }

    $this->registry->template->error = '';

    $this->registry->template->firstName = $user->getFirstName();
    $this->registry->template->lastName = $user->getLastName();
    $this->registry->template->email = $user->getEmail();
    $this->registry->template->userTitle = $user->getTitle();
    

    if ($_POST) {
        if (isset($_POST['first-name']) && !empty($_POST['first-name']) && isset($_POST['last-name']) && !empty($_POST['last-name']) 
            && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['title'])) {

            $user->setFirstName($_POST['first-name']);
            $user->setLastName($_POST['last-name']);
            $user->setEmail($_POST['email']);
            $user->setTitle($_POST['title']);

            $userStatus = $user->updateUserInfo();

            if ($userStatus){
                header("Location: portal");
                exit();
            } else {
                $this->registry->template->error = '<p class="error-bar">' . $userStatus . '</p>';
            };
  

              

        } else {
            $this->registry->template->error = '<p class="error-bar">All fields except Title are mandatory.</p>';
        }
    }

        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
    /*** set a template variable ***/
        $this->registry->template->title = 'Edit Your User Profile';
    /*** load the register template ***/
        $this->registry->template->show('edit-user');
}

public function password() {

    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: ../login");
        exit();
    }

    $this->registry->template->error = '';

    if ($_POST) {
        if (isset($_POST['password1']) && !empty($_POST['password1']) && isset($_POST['password2']) && !empty($_POST['password2'])) {

            if ($this->passwordValidation($_POST['password1'], $_POST['password2'])) {
                $user->setPassword($_POST['password1']);
                $changePasswordStatus = $user->updateUserPassword();
            if ($changePasswordStatus != 1){
                $this->registry->template->error = '<p class="error-bar">' . $changePasswordStatus . '</p>';
            } else {
                header("Location: ../edit_user");
                exit();
            };

        } else {
            $this->registry->template->error = '<p class="error-bar">The passwords you entered do not match.</p>';
        }  
              

        } else {
            $this->registry->template->error = '<p class="error-bar">Both fields are mandatory.</p>';
        }
    }

        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
    /*** set a template variable ***/
        $this->registry->template->title = 'Edit Your Password';
    /*** load the register template ***/
        $this->registry->template->show('edit-user_password');
}

public function image() {

    if (isset($_SESSION['user'])) {
        $user = new User($this->registry->db, $_SESSION['user']);
    } else {
        header("Location: ../login");
        exit();
    }

    $this->registry->template->success = false;
    $this->registry->template->error = '';

    if (!empty($_FILES)) {
        if ($_FILES["image"]["size"] > 1) {
            $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
            if (in_array($this->getExtension($_FILES["image"]["name"]), $allowedExts)) {
                if ($_FILES["image"]["error"] > 0) {
                    $this->registry->template->error = "Error. Return Code: " . $_FILES["image"]["error"] . "<br>";
                } else { 
                    if ($user->getImage() != '') {
                        unlink(__SITE_PATH . '/img/users/' . $user->getImage());
                    }

                    $extension = $this->getExtension($_FILES["image"]["name"]);
                    $imageName=(time() . '.' . $extension);
                    


                    move_uploaded_file($_FILES["image"]["tmp_name"], __SITE_PATH . "/img/users/" . $imageName);
                    
                    $user->setImage($imageName);
                    $user->updateUserImage();
                    $this->registry->template->success = true;
           
                }
            } else {
                    $this->registry->template->error = 'Unsupported file format.';
                
            }

                    
            } else {

                    $this->registry->template->error = 'Unsupported file format.';

            }

        }

        $this->registry->template->userImage = $user->getImage();
        $this->registry->template->userImageThumb = 'thumb_' . $user->getImage();
        $this->registry->template->user = $user->getFirstName() . ' ' . $user->getLastName();
    /*** set a template variable ***/
        $this->registry->template->title = 'Update Your Image';
    /*** load the register template ***/
        $this->registry->template->show('edit-user_image');
}

private function passwordValidation($password1, $password2) {
    if ($password1 === $password2) {
            return 1;
    } else { 
            return 0;
    }
}

private function getExtension($str) {
     $i = strrpos($str,".");
     if (!$i) { return ""; }
     $l = strlen($str) - $i;
     $ext = substr($str,$i+1,$l);
     return $ext;
}


}



?>

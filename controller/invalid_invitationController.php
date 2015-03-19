<?php

Class invalid_invitationController Extends baseController {

public function index() {


    /*** set a template variable ***/
        $this->registry->template->title = 'Invalid Invitation';
        $this->registry->template->error = 'It seems that the concerned invitation is not valid or has expired.';
    /*** load the register template ***/
        $this->registry->template->show('invalid-invitation');
}


}



?>

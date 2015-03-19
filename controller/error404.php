<?php

Class error404Controller Extends baseController {

public function index() 
{
		$this->registry->template->title = '404';
        $this->registry->template->heading = 'This is the 404. Sorry :(';
        $this->registry->template->show('error404');
}


}
?>

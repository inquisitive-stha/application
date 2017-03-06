<?php


class Admin_IndexController extends Admin_Controller_Action_Abstract


{
	public function indexAction()
	{
            //echo '---in abstract';
            //print_r($this->access_array);exit;
            $this->view->access_array = $this->access_array;
	} 
}
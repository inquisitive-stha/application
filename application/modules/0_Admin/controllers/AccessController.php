<?php
class Admin_AccessController extends Admin_Controller_Action_Abstract
{
    public function preDispatch()
    {
    	$this->view->render('_header.phtml');
    	$this->view->render('_navigation.phtml');
    	$this->view->render('_footer.phtml');
    }

    public function accessAction(){

   }

}
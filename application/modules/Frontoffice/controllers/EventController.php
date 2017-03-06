<?php

class EventController extends FrontController 
{

	public function preDispatch()
        {  	
            $this->view->footer_logo = $this->getMedia("FOOTER_LOGO");
            $this->view->header_logo = $this->getMedia("HEADER_LOGO");
            $this->view->copyright_text = $this->getSettings("COPYRIGHT_TEXT");
            
            $this->view->fb_link = $this->getSettings("FACEBOOK_LINK");
            $this->view->soundcloud_link = $this->getSettings("SOUNDCLOUD_LINK");
            
            $this->view->render('_stcfooter.phtml');
            $this->view->render('_stcheader.phtml');
            parent::preDispatch();
            
        }    

	public function indexAction()
	{
            $dao_event = new Admin_Model_DbTable_Stcevent();
            $this->view->previous = $dao_event->fetchAll('is_previous = 1');
            $this->view->upcoming = $dao_event->fetchAll('is_previous = 0');
            
            
            $this->view->banner = $dao_event->fetchAll('show_in_slider = 1');
	}
        
        public function upcomingAction()
	{
            $dao_event = new Admin_Model_DbTable_Stcevent();
            $this->view->upcoming = $dao_event->fetchAll('is_previous = 0');
            
            
            $this->view->banner = $dao_event->fetchAll('show_in_slider = 1');
	}
        
        public function previousAction()
	{
            $dao_event = new Admin_Model_DbTable_Stcevent();
            $this->view->previous = $dao_event->fetchAll('is_previous = 1');
            
            
            $this->view->banner = $dao_event->fetchAll('show_in_slider = 1');
	}
}
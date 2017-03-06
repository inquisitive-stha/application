<?php

class StclabController extends FrontController 
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
            $dao_stclab = new Admin_Model_DbTable_Stclab();
            $this->view->stclab = $dao_stclab->fetchAll();
            
            $this->view->banner = $dao_stclab->fetchAll('publish_to_banner = 1');

		
	}
}
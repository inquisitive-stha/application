<?php

class ContentController extends FrontController 
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
            $id = $this->_getParam('id', 0); 
            
            $dao_cms = new Admin_Model_DbTable_Stccms();
            $this->view->content = $dao_cms->fetchRow('id = ' . $id);            
            
	}
}
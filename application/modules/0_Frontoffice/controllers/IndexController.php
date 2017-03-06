<?php

class IndexController extends FrontController 
{

	public function preDispatch()
        {  		
            
            $this->view->footer_logo = $this->getMedia("FOOTER_LOGO");
            $this->view->header_logo = $this->getMedia("HEADER_LOGO");
            
            $this->view->sound_file = $this->getMedia("SOUND_FILE");
            
            $this->view->video_file = $this->getMedia("HOMEPAGE_VIDEO_FILE");
            $this->view->homepage_bg = $this->getMedia("HOMEPAGE_BACKGROUND");            
            $this->view->copyright_text = $this->getSettings("COPYRIGHT_TEXT");
            
            $this->view->fb_link = $this->getSettings("FACEBOOK_LINK");
            $this->view->soundcloud_link = $this->getSettings("SOUNDCLOUD_LINK");
            
            $this->view->IMAGE_CHANGE_TIMEOUT = $this->getSettings("IMAGE_CHANGE_TIMEOUT");
            
            $this->view->render('_stcfooter.phtml');
            $this->view->render('_stcheader.phtml');
            parent::preDispatch();
            
        }    

	public function indexAction()
	{
            $dao_cms = new Admin_Model_DbTable_Stccms();
            $id = 1;
            $this->view->about = $dao_cms->fetchRow('id = ' . $id);
            
            $dao_event = new Admin_Model_DbTable_Stcevent();
            $this->view->events = $dao_event->fetchAll('publish_to_homepage = 1'); 
            
            $dao_artist = new Admin_Model_DbTable_Stcartist();
            $this->view->artist = $dao_artist->fetchAll('show_in_homepage = 1');
            
            $dao_stclab = new Admin_Model_DbTable_Stclab();
            $this->view->stclab = $dao_stclab->fetchAll('show_in_homepage = 1');
	}
}
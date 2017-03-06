<?php

class ArtistController extends FrontController 
{

	public function preDispatch()
        {  
            $this->view->footer_logo = $this->getMedia("FOOTER_LOGO");
            $this->view->header_logo = $this->getMedia("HEADER_LOGO");
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
	    $dao_artist = new Admin_Model_DbTable_Stcartist();
            $select = $dao_artist->select()->order('ordering ASC');
            $this->view->artist = $dao_artist->fetchAll($select);
             $this->view->banner = $dao_artist->fetchAll('publish_to_banner = 1');
	}
        
        public function singleAction()
	{
            $id = $this->_getParam('id', 0); 
            
	    $dao_artist = new Admin_Model_DbTable_Stcartist();
            $this->view->artist = $dao_artist->fetchRow('id = '.$id);
	}
}

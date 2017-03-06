<?php

class BookingController extends FrontController 
{
        var $form;
        
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
            $form = new Frontoffice_Form_Booking();   
            $dao_booking = new Admin_Model_DbTable_Stcbooking();
            
            $id = $this->_getParam('id', 0); 
            
            
            $dao_artist = new Admin_Model_DbTable_Stcartist();
            $artist_list = $dao_artist->fetchAll();
            
            $c = array();
            $c[""] = '---- Select Artist ----';
            foreach ($artist_list as $s) 
            {
                $c[$s->id] = $s->title ;
            }		
            $form->artist->setMultiOptions($c);
            
            $form->artist->setValue($id);
            
            if($this->getRequest()->isPost())
            {
                $formData = $this->getRequest()->getPost();            
                if ($form->isValid($formData))
                { 
                    // insert into booking...........
                     $data = array(
                    'artist' => $formData['artist'],
                    'name' => $formData['name'],
                    'email' => $formData['email'],
                    'message' => $formData['message']
                     );

                    $dao_booking->insert($data);                
                    $this->_helper->redirector('index');
                    echo 'Your Booking is Submitted';
                }
                else
                {
                    $form->populate($formData);
                }
            }
            
            
            
            
            $this->view->form = $form;
            
	}
}


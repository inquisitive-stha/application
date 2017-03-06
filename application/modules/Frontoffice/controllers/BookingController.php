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
                    'message' => $formData['message'],
                    'c_date' => date('Y-m-d')
                     );

                    $dao_booking->insert($data);                
                    
                    $from_email = $formData['email'];
                    $from_name = $formData['name'];
                    
                    $strx = '<table>';
                    foreach($data as $ka => $ca)
                    {
                        if(strstr($ka, 'artist'))
                        {
                            $ca = $c[$ca];
                        }
                        if(strstr($ka, 'c_date'))
                        {
                            $ka = 'Date';
                        }
                        $strx .= '<tr>';
                        $strx .= '<td>'.$ka.'</td>';
                        $strx .= '<td>'.$ca.'</td>';
                        $strx .= '</tr>';
                    }
                    $strx .= '</table>';
                    
                    
                    $headers[] = 'MIME-Version: 1.0\r\n';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1\r\n';
                    $headers[] = 'From: '.$from_name.' <'.$from_email.'>';
                    
                    //print_r($headers); exit();

                    $to = $this->getSettings("SITE_EMAIL");
                    $site_name = $this->getSettings("SITE_NAME");
                    $subject = $site_name." : Booking Email";
                    mail($to, $subject, $strx, implode("\r\n", $headers));
                    
                    $this->view->message = 'Email Sent !';
                    $form->populate(array());
                    
                }
                else
                {
                    $form->populate($formData);
                }
            }
            
            
            
            
            $this->view->form = $form;
            
	}
}


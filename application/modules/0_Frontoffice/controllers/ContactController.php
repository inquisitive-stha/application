<?php

class ContactController extends FrontController 
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
            $form = new Frontoffice_Form_Contactus();           
             if($this->getRequest()->isPost())
            {
                $formData = $this->getRequest()->getPost();            
                if ($form->isValid($formData))
                { 
                    $data = array(
                    'First Name' => $formData['firstname'],
                    'Last Name' => $formData['lastname'],
                    'Email' => $formData['email'],
                    'Phone or Mobile' => $formData['yourphoneormobile'],
                    'Message' => $formData['yourmessage']);
                    
                   
                    
                    $from_email = $formData['email'];
                    $from_name = $formData['firstname']." ".$formData['lastname'];
                    
                    $strx = '<table>';
                    foreach($data as $k => $c)
                    {
                        $strx .= '<tr>';
                        $strx .= '<td>'.$k.'</td>';
                        $strx .= '<td>'.$c.'</td>';
                        $strx .= '</tr>';
                    }
                    $strx .= '</table>';
                    
                    $headers[] = 'MIME-Version: 1.0\r\n';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1\r\n';
                    $headers[] = 'From: '.$from_name.' <'.$from_email.'>';
                    
                    //print_r($headers); exit();

                    $to = $this->getSettings("SITE_EMAIL");
                    $site_name = $this->getSettings("SITE_NAME");
                    $subject = $site_name." : Contact Email";
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


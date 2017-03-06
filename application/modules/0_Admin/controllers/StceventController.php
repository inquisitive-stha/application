<?php
class Admin_StceventController extends Admin_Controller_Action_Abstract
{
    var $dao; 
    var $form;
    
    public function preDispatch()
    {
        $this->dao = new Admin_Model_DbTable_Stcevent();
        $this->form = new Admin_Form_Stcevent(); 
        parent::preDispatch();
    }
    
    public function addAction() {
                
        if($this->getRequest()->isPost()) 
        {
            $formData = $this->getRequest()->getPost();            
            if ($this->form->isValid($formData))
            {
                $data = array(
                    'title'=>$formData['title'],
                    'description'=>$formData['description'],
                    'teaser_link'=>$formData['teaser_link'],
                    'ticket_link'=>$formData['ticket_link'],
                    'after_movie_link'=>$formData['after_movie_link'],
                    'show_page_link'=>$formData['show_page_link'],
                    'is_previous'=>$formData['is_previous'],
                    'c_date' => $formData['c_date'],
                    'publish_to_homepage' => $formData['publish_to_homepage'],
                    'show_in_slider' => $formData['show_in_slider']
                        );
                
                
                 if(trim($_FILES['slider_image']['name']) != '')
                {
                        
                    $ext = pathinfo($_FILES['slider_image']['name'], PATHINFO_EXTENSION);
                    $f_name = uniqid().".".$ext;                        
                    move_uploaded_file($_FILES['slider_image']['tmp_name'], 
                            'public/uploads/stcevent/'.$f_name);
                    
                    $data['slider_image'] = $f_name;
                }
                    
                 if(trim($_FILES['homepage_image']['name']) != '')
                {
                        
                    $ext = pathinfo($_FILES['homepage_image']['name'], PATHINFO_EXTENSION);
                    $f_name = uniqid().".".$ext;                        
                    move_uploaded_file($_FILES['homepage_image']['tmp_name'], 
                            'public/uploads/stcevent/'.$f_name);
                    
                    $data['homepage_image'] = $f_name;
                }
                  if(trim($_FILES['event_page_image']['name'])!= '')
                {
                        
                    $ext = pathinfo($_FILES['event_page_image']['name'], PATHINFO_EXTENSION);
                    $f_name = uniqid().".".$ext;                        
                    move_uploaded_file($_FILES['event_page_image']['tmp_name'], 
                            'public/uploads/stcevent/'.$f_name);
                    
                    $data['event_page_image'] = $f_name;
                }

                $this->dao->insert($data);                
                $this->_helper->redirector('list');
                
            }
            else
            {
                
                
                
                $this->form->populate($formData);
                $this->view->form = $this->form;
            }           
            
        }   
        
        $this->form->homepage_image_pic->src = $this->view->baseUrl().'/images/no-image.png';
        $this->form->event_page_image_pic->src = $this->view->baseUrl().'/images/no-image.png';
        $this->form->slider_image_pic->src = $this->view->baseUrl().'/images/no-image.png';
        
        $this->view->form = $this->form;
    }

                    
     public function editAction() {        
        $id = $this->_getParam('id', 0);        
        
        $this->form->submit->setLabel('Save');   
        
        if ($this->getRequest()->isPost()) 
        {
            $formData = $this->getRequest()->getPost();
            if ($this->form->isValid($formData))
            {
                
                
                $data = array(
                    'title'=>$formData['title'],
                    'description'=>$formData['description'],
                    'is_previous'=>$formData['is_previous'],
                    'c_date'=>$formData['c_date'],
                    'publish_to_homepage'=>$formData['publish_to_homepage'],
                    'teaser_link'=>$formData['teaser_link'],
                    'ticket_link'=>$formData['ticket_link'],
                    'show_page_link'=>$formData['show_page_link'],
                    'after_movie_link'=>$formData['after_movie_link'],
                    'show_in_slider' => $formData['show_in_slider']
                );
                
                if(trim($_FILES['slider_image']['name'])!= '')
                {
                    $row = $this->dao->fetchRow('id = ' . $id);
                    @unlink('public/uploads/stcevent/'.$row->slider_image);
                
                    $ext = pathinfo($_FILES['slider_image']['name'], PATHINFO_EXTENSION);
                    $f_name = uniqid().".".$ext;                        
                    move_uploaded_file($_FILES['slider_image']['tmp_name'], 
                            'public/uploads/stcevent/'.$f_name);
                    
                    $data['slider_image'] = $f_name;
                }
                
                if(trim($_FILES['homepage_image']['name'])!= '')
                {
                    $row = $this->dao->fetchRow('id = ' . $id);
                    @unlink('public/uploads/stcevent/'.$row->homepage_image);
                
                    $ext = pathinfo($_FILES['homepage_image']['name'], PATHINFO_EXTENSION);
                    $f_name = uniqid().".".$ext;                        
                    move_uploaded_file($_FILES['homepage_image']['tmp_name'], 
                            'public/uploads/stcevent/'.$f_name);
                    
                    $data['homepage_image'] = $f_name;
                }
                
                if(trim($_FILES['event_page_image']['name'])!= '')
                {
                    $row = $this->dao->fetchRow('id = ' . $id);
                    @unlink('public/uploads/stcevent/'.$row->event_page_image);
                
                    $ext = pathinfo($_FILES['event_page_image']['name'], PATHINFO_EXTENSION);
                    $f_name = uniqid().".".$ext;                        
                    move_uploaded_file($_FILES['event_page_image']['tmp_name'], 
                            'public/uploads/stcevent/'.$f_name);
                    
                    $data['event_page_image'] = $f_name;
                }

                    
                $this->dao->update($data, 'id = ' . $id);               
                $this->_helper->redirector('list');
            }
            else
            {
                $row = $this->dao->fetchRow('id = ' . $id);
                $this->form->homepage_image_pic->src = $this->view->baseUrl().'/public/uploads/stcevent/'.$row['homepage_image'];
                $this->form->event_page_image_pic->src = $this->view->baseUrl().'/public/uploads/stcevent/'.$row['event_page_image'];
                $this->form->slider_image_pic->src = $this->view->baseUrl().'/public/uploads/stcevent/'.$row['slider_image'];
                $this->form->populate($formData);
                $this->view->form = $this->form;
            }  
        }
        else 
        {
            $row = $this->dao->fetchRow('id = ' . $id);
            if(trim($row['homepage_image']) == '')
            {
                $this->form->homepage_image_pic->src = $this->view->baseUrl().'/images/no-image.png';
            }
            else
            {
                $this->form->homepage_image_pic->src = $this->view->baseUrl().'/public/uploads/stcevent/'.$row['homepage_image'];
            }
            
            if(trim($row['event_page_image']) == '')
            {
                $this->form->event_page_image_pic->src = $this->view->baseUrl().'/images/no-image.png';
            }
            else
            {
                $this->form->event_page_image_pic->src = $this->view->baseUrl().'/public/uploads/stcevent/'.$row['event_page_image'];
            }
            
            if(trim($row['slider_image']) == '')
            {
                $this->form->slider_image_pic->src = $this->view->baseUrl().'/images/no-image.png';
            }
            else
            {
                $this->form->slider_image_pic->src = $this->view->baseUrl().'/public/uploads/stcevent/'.$row['slider_image'];
            }
            $this->form->populate($row->toArray());
        }
        
        $this->view->form = $this->form;
    }

    public function listAction() {        
        
        
        $publish = $this->_getParam('publish', '-1');
        $unpublish = $this->_getParam('unpublish', '-1');
        
        if ($publish != -1) 
        {
            $data = array('is_previous' => '1');
            $this->dao->update($data, 'id = ' . $publish);
        } 
        
        if ($unpublish != -1) {
            $data = array('is_previous' => '0');
             $this->dao->update($data, 'id = ' . $unpublish);
        }
       

        $publish = $this->_getParam('publishbanner', '-1');
        $unpublish = $this->_getParam('unpublishbanner', '-1');        
        if ($publish != -1) 
        {
            $data = array('publish_to_homepage' => '1');
            $this->dao->update($data, 'id = ' . $publish);
        }         
        if ($unpublish != -1) {
            $data = array('publish_to_homepage' => '0');
            $this->dao->update($data, 'id = ' . $unpublish);
        }
        
        $publish = $this->_getParam('publishslider', '-1');
        $unpublish = $this->_getParam('unpublishslider', '-1');        
        if ($publish != -1) 
        {
            $data = array('show_in_slider' => '1');
            $this->dao->update($data, 'id = ' . $publish);
        }         
        if ($unpublish != -1) {
            $data = array('show_in_slider' => '0');
            $this->dao->update($data, 'id = ' . $unpublish);
        }

       
        $list = $this->dao->select()->order("title ASC"); 
       // $list = $this->dao->select()->order("department ASC");        
        $this->view->paginator = Zend_Paginator::factory($list);
        $this->view->paginator->setCurrentPageNumber($this->_getParam('page', 1));

    }

    public function deleteAction() {
        $id = $this->_getParam('id', 0);        
        
        if ($this->getRequest()->isPost()) 
        {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') 
            {    
                $row = $this->dao->fetchRow('id = ' . $id);
                @unlink('public/uploads/stcevent/'.$row->homepage_image);
                @unlink('public/uploads/stcevent/'.$row->event_page_image);
                @unlink('public/uploads/stcevent/'.$row->slider_image);

                $this->dao->delete('id = ' . $id);
            }
            $this->_helper->redirector('list');
        }
        else
        {
            $row = $this->dao->fetchRow('id = ' . $id);
            $this->view->data = $row->toArray();
        }       
        
    }


}
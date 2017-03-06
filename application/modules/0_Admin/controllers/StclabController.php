<?php
class Admin_StclabController extends Admin_Controller_Action_Abstract
{
    var $dao; 
    var $form;
    
    public function preDispatch()
    {
        $this->dao = new Admin_Model_DbTable_Stclab();
        $this->form = new Admin_Form_Stclab(); 
        parent::preDispatch();
    }
    
    public function addAction() {
                
        if($this->getRequest()->isPost()) 
        {
            $formData = $this->getRequest()->getPost();            
            if ($this->form->isValid($formData))
            {
                $data = array(
                    'title' => $formData['title'],
                    'description' => $formData['description'],
                    'video_link' => $formData['video_link'],
                    'watch_it_link' => $formData['watch_it_link'],
                    'c_date' => $formData['c_date'],
                    'publish_to_banner' => $formData['publish_to_banner'],
                    'show_in_homepage' => $formData['show_in_homepage']
                        );
                
                if(trim($_FILES['banner_image_file']['name']) != '')
                {
                        
                    $ext = pathinfo($_FILES['banner_image_file']['name'], PATHINFO_EXTENSION);
                    $f_name = uniqid().".".$ext;                        
                    move_uploaded_file($_FILES['banner_image_file']['tmp_name'], 
                            'public/uploads/stclab/'.$f_name);
                    
                    $data['banner_image_file'] = $f_name;
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
         
         $this->form->banner_image_file_pic->src = $this->view->baseUrl().'/images/no-image.png';
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
                    'title' => $formData['title'],
                    'description' => $formData['description'],
                    'video_link' => $formData['video_link'],
                    'watch_it_link' => $formData['watch_it_link'],
                    'c_date' => $formData['c_date'],
                    'publish_to_banner' => $formData['publish_to_banner'],
                    'show_in_homepage' => $formData['show_in_homepage']
                );
                
                
                
                if(trim($_FILES['banner_image_file']['name']) != '')
                {
                    $row = $this->dao->fetchRow('id = ' . $id);
                    @unlink('public/uploads/stclab/'.$row->banner_image_file);
                
                    $ext = pathinfo($_FILES['banner_image_file']['name'], PATHINFO_EXTENSION);
                    $f_name = uniqid().".".$ext;                        
                    move_uploaded_file($_FILES['banner_image_file']['tmp_name'], 
                            'public/uploads/stclab/'.$f_name);
                    
                    $data['banner_image_file'] = $f_name;
                }
                
                
                
                $this->dao->update($data, 'id = ' . $id);               
                $this->_helper->redirector('list');
            }
            else
            {
                $row = $this->dao->fetchRow('id = ' . $id);
                $this->form->banner_image_file_pic->src = $this->view->baseUrl().'/public/uploads/stclab/'.$row['banner_image_file'];
                $this->form->populate($formData);
                $this->view->form = $this->form;
            }  
        }
        else 
        {
            $row = $this->dao->fetchRow('id = ' . $id);
            if(trim($row['banner_image_file']) == '')
            {
                $this->form->banner_image_file_pic->src = $this->view->baseUrl().'/images/no-image.png';
            }
            else
            {
                $this->form->banner_image_file_pic->src = $this->view->baseUrl().'/public/uploads/stclab/'.$row['banner_image_file'];
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
            $data = array('publish_to_banner' => '1');
            $this->dao->update($data, 'id = ' . $publish);
        } 
        
        if ($unpublish != -1) {
            $data = array('publish_to_banner' => '0');
            $this->dao->update($data, 'id = ' . $unpublish);
        }
        
        
        $publish = $this->_getParam('publishhomepage', '-1');
        $unpublish = $this->_getParam('unpublishhomepage', '-1');
        if ($publish != -1) 
        {
            $data = array('show_in_homepage' => '1');
            $this->dao->update($data, 'id = ' . $publish);
        } 
        
        if ($unpublish != -1) {
            $data = array('show_in_homepage' => '0');
            $this->dao->update($data, 'id = ' . $unpublish);
        }
        
        
        $list = $this->dao->select()->order("title ASC");        
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
                @unlink('images/uploads/stclab/'.$row->banner_image_file);
                
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
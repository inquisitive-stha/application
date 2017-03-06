<?php
class Admin_StcartistController extends Admin_Controller_Action_Abstract
{
    var $dao; 
    var $form;
    
    public function preDispatch()
    {
        $this->dao = new Admin_Model_DbTable_Stcartist();
        $this->form = new Admin_Form_Stcartist(); 
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
                    'ordering' => $formData['ordering'],
                    'description' => $formData['description'],
                    'long_description' => $formData['long_description'],
                    'publish_to_banner' => $formData['publish_to_banner'],
                    'show_in_homepage' => $formData['show_in_homepage']
                   );

                 if(trim($_FILES['image_file']['name']) != '')
                {
                        
                    $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
                    $f_name = time().".".$ext;                        
                    move_uploaded_file($_FILES['image_file']['tmp_name'], 
                            'public/uploads/stcartist/'.$f_name);
                    
                    $data['image_file'] = $f_name;
                    sleep(1);
                }
                
                if(trim($_FILES['image_file_2']['name']) != '')
                {
                        
                    $ext = pathinfo($_FILES['image_file_2']['name'], PATHINFO_EXTENSION);
                    $f_name = time().".".$ext;                        
                    move_uploaded_file($_FILES['image_file_2']['tmp_name'], 
                            'public/uploads/stcartist/'.$f_name);
                    
                    $data['image_file_2'] = $f_name;
                    sleep(1);
                }
                if(trim($_FILES['image_file_3']['name']) != '')
                {
                        
                    $ext = pathinfo($_FILES['image_file_3']['name'], PATHINFO_EXTENSION);
                    $f_name = time().".".$ext;                        
                    move_uploaded_file($_FILES['image_file_3']['tmp_name'], 
                            'public/uploads/stcartist/'.$f_name);
                    
                    $data['image_file_3'] = $f_name;
                    sleep(1);
                }
                
                
                if(trim($_FILES['banner_image_file']['name']) != '')
                {
                        
                    $ext = pathinfo($_FILES['banner_image_file']['name'], PATHINFO_EXTENSION);
                    $f_name = time().".".$ext;                        
                    move_uploaded_file($_FILES['banner_image_file']['tmp_name'], 
                            'public/uploads/stcartist/'.$f_name);
                    
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
        
            $this->form->image_file_pic->src = $this->view->baseUrl().'/images/no-image.png';
            $this->form->image_file_2_pic->src = $this->view->baseUrl().'/images/no-image.png';
            $this->form->image_file_3_pic->src = $this->view->baseUrl().'/images/no-image.png';
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
                    'ordering' => $formData['ordering'],
                    'description' => $formData['description'],
                    'long_description' => $formData['long_description'],
                    'publish_to_banner' => $formData['publish_to_banner'],
                    'show_in_homepage' => $formData['show_in_homepage']
                   );
                
                 if(trim($_FILES['image_file']['name'])!='')
                {
                    $row = $this->dao->fetchRow('id = ' . $id);
                    @unlink('public/uploads/stcartist/'.$row->image_file);
                
                    $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
                    $f_name = time().".".$ext;                        
                    move_uploaded_file($_FILES['image_file']['tmp_name'], 
                            'public/uploads/stcartist/'.$f_name);
                    
                    $data['image_file'] = $f_name;
                    sleep(1);
                }
                
                
                if(trim($_FILES['image_file_2']['name'])!='')
                {
                    $row = $this->dao->fetchRow('id = ' . $id);
                    @unlink('public/uploads/stcartist/'.$row->image_file_2);
                
                    $ext = pathinfo($_FILES['image_file_2']['name'], PATHINFO_EXTENSION);
                    $f_name = time().".".$ext;                        
                    move_uploaded_file($_FILES['image_file_2']['tmp_name'], 
                            'public/uploads/stcartist/'.$f_name);
                    
                    $data['image_file_2'] = $f_name;
                    sleep(1);
                }
                if(trim($_FILES['image_file_3']['name'])!='')
                {
                    $row = $this->dao->fetchRow('id = ' . $id);
                    @unlink('public/uploads/stcartist/'.$row->image_file_3);
                
                    $ext = pathinfo($_FILES['image_file_3']['name'], PATHINFO_EXTENSION);
                    $f_name = time().".".$ext;                        
                    move_uploaded_file($_FILES['image_file_3']['tmp_name'], 
                            'public/uploads/stcartist/'.$f_name);
                    
                    $data['image_file_3'] = $f_name;
                    sleep(1);
                }
                
                
                
                
                
                
                if(trim($_FILES['banner_image_file']['name'])!='')
                {
                    $row = $this->dao->fetchRow('id = ' . $id);
                    @unlink('public/uploads/stcartist/'.$row->banner_image_file);
                
                    $ext = pathinfo($_FILES['banner_image_file']['name'], PATHINFO_EXTENSION);
                    $f_name = uniqid().".".$ext;                        
                    move_uploaded_file($_FILES['banner_image_file']['tmp_name'], 
                            'public/uploads/stcartist/'.$f_name);
                    
                    $data['banner_image_file'] = $f_name;
                }
              
                
                $this->dao->update($data, 'id = ' . $id);               
                $this->_helper->redirector('list');
            }
            else
            {
                $row = $this->dao->fetchRow('id = ' . $id);
                $this->form->banner_image_file_pic->src = $this->view->baseUrl().'/public/uploads/stcartist/'.$row['banner_image_file'];
                $this->form->image_file_pic->src = $this->view->baseUrl().'/public/uploads/stcartist/'.$row['image_file'];
                
                $this->form->image_file_2_pic->src = $this->view->baseUrl().'/public/uploads/stcartist/'.$row['image_file_2'];
                $this->form->image_file_3_pic->src = $this->view->baseUrl().'/public/uploads/stcartist/'.$row['image_file_3'];
                
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
                $this->form->banner_image_file_pic->src = $this->view->baseUrl().'/public/uploads/stcartist/'.$row['banner_image_file'];
            }
            
            if(trim($row['image_file']) == '')
            {
                $this->form->image_file_pic->src = $this->view->baseUrl().'/images/no-image.png';
            }
            else
            {
                $this->form->image_file_pic->src = $this->view->baseUrl().'/public/uploads/stcartist/'.$row['image_file'];
            }
            
            
            
            if(trim($row['image_file_2']) == '')
            {
                $this->form->image_file_2_pic->src = $this->view->baseUrl().'/images/no-image.png';
            }
            else
            {
                $this->form->image_file_2_pic->src = $this->view->baseUrl().'/public/uploads/stcartist/'.$row['image_file_2'];
            }
            if(trim($row['image_file_3']) == '')
            {
                $this->form->image_file_3_pic->src = $this->view->baseUrl().'/images/no-image.png';
            }
            else
            {
                $this->form->image_file_3_pic->src = $this->view->baseUrl().'/public/uploads/stcartist/'.$row['image_file_3'];
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
        
        
        $publish = $this->_getParam('publishhome', '-1');
        $unpublish = $this->_getParam('unpublishhome', '-1');        
        if ($publish != -1) 
        {
            $data = array('show_in_homepage' => '1');
            $this->dao->update($data, 'id = ' . $publish);
        } 
        
        if ($unpublish != -1) {
            $data = array('show_in_homepage' => '0');
            $this->dao->update($data, 'id = ' . $unpublish);
        }
        
        
        
        $list = $this->dao->select()->order("ordering ASC");        
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
                @unlink('images/uploads/stcartist/'.$row->banner_image_file);
                @unlink('images/uploads/stcartist/'.$row->image_file);
                @unlink('images/uploads/stcartist/'.$row->image_file_2);
                @unlink('images/uploads/stcartist/'.$row->image_file_3);
                
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
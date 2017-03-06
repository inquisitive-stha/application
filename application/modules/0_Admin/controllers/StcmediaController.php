<?php
class Admin_StcmediaController extends Admin_Controller_Action_Abstract
{
    var $dao; 
    var $form;
    
    public function preDispatch()
    {
        $this->dao = new Admin_Model_DbTable_Stcmedia();
        $this->form = new Admin_Form_Stcmedia(); 
        parent::preDispatch();
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
                    
                );
                
                if(trim($_FILES['media_path']['name']) != '')
                {
                        
                    $ext = pathinfo($_FILES['media_path']['name'], PATHINFO_EXTENSION);
                    $f_name = uniqid().".".$ext;                        
                    move_uploaded_file($_FILES['media_path']['tmp_name'], 
                            'public/uploads/stcmedia/'.$f_name);                    
                    $data['media_path'] = $f_name;
                }
                
                $this->dao->update($data, 'id = ' . $id);               
                $this->_helper->redirector('list');
            }
            else
            {
                $this->form->populate($formData);
                $this->view->form = $this->form;
            }  
        }
        else 
        {
            $row = $this->dao->fetchRow('id = ' . $id);
            $this->form->populate($row->toArray());
        }
        
        $this->view->form = $this->form;
    }

    public function listAction() {
       
        $list = $this->dao->select()->order("key ASC");        
        $this->view->paginator = Zend_Paginator::factory($list);
        $this->view->paginator->setCurrentPageNumber($this->_getParam('page', 1));
        
    }


}
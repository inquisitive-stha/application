<?php
class Admin_StcbookingController extends Admin_Controller_Action_Abstract
{
    var $dao; 
    var $form;
    
    public function preDispatch()
    {
        $this->dao = new Admin_Model_DbTable_Stcbooking();
        $this->form = new Admin_Form_Stcbooking(); 
        parent::preDispatch();
    }
    
    
    public function addAction() {
                
        if($this->getRequest()->isPost()) 
        {
            $formData = $this->getRequest()->getPost();            
            if ($this->form->isValid($formData))
            {
                $data = array(
                    'artist' => $formData['artist'],
                    'name' => $formData['name'],
                    'email' => $formData['email'],
                    'message' => $formData['message'],
                    'c_date' => $formData['c_date'],
                   ); 
                 $this->dao->insert($data);                
                $this->_helper->redirector('list');
            }
            else
            {
                 $this->form->populate($formData);
                $this->view->form = $this->form; 
            }
            
        }   
         
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
                    'artist' => $formData['artist'],
                    'name' => $formData['name'],
                    'email' => $formData['email'],
                    'message' => $formData['message'],
                    'c_date' => $formData['c_date'],
                    
                    
                );
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
       
        $list = $this->dao->select()->order("artist ASC");        
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
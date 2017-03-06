<?php
class Admin_Form_Stcbooking extends Zend_Form {
    public function init() {
        $this->setMethod('post');
        
        
        
        $this->addElement('text', 'artist', array(
            'label' => 'Artist :',
            'required' => true
        ));
        $this->artist->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('text', 'name', array(
            'label' => 'Name :',
            'required' => true
        ));
        $this->name->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('text', 'email', array(
            'label' => 'Email :',
            'required' => true
        ));
        $this->email->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('textarea', 'message', array(
            'label' => 'Message :',
            'required' => true
        ));
        $this->message->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('text', 'c_date', array(
            'label' => 'Date :',
            'required' => true
        ));
        $this->c_date->setAttrib('class', 'txt')->addValidator('NotEmpty');
       
        
        
        
       
        

       
		
           
       
        
        
        
        
	   $this->addElement('submit', 'submit', array(
          'ignore'   => true,
            'label'    => 'Add',
        ));


         $this->submit->setAttrib('class', 'button altbutton');





        $this->addElement('button', 'cancel', array(
          'ignore'   => true,
            'label'    => 'Cancel',
        ));


        $this->cancel->setAttrib('class', 'button altbutton');
        $this->cancel->setAttrib('onclick', 'history.go(-1);');


          $this->setDecorators(array(
                    'FormElements',
         			array(array('e' => 'HtmlTag'), array('tag' => 'dl')),
         			array(array('e1' => 'HtmlTag'), array('tag' => 'div', 'class' => 'inner-form')),
         			'Form'
        ));


        $this->setAttrib('class', 'basic');


	}


}
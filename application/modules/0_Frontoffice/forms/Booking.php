<?php
class Frontoffice_Form_Booking extends Zend_Form {
    public function init() {
        $this->setMethod('post');
        
        
        
        $this->addElement('select', 'artist', array(
            'label' => 'Artist :',
            'required' => true
        ));
        $this->artist->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('text', 'name', array(
                                                'label' => 'Name :',
                                                'required' => true)
                );
        $this->name->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        $this->addElement('text', 'email', array(
            'label' => 'Email :',
            'required' => true,            
            'validators' => array(
                                    array( 
                                            'name' => 'EmailAddress',
                                            'options' => array( 
                                                            'messages' => array(
                                                                Zend_Validate_EmailAddress::INVALID_FORMAT => 'Invalid Email Address' 
                                                            )             
                                                        )                   
                                        )             
                                )         
                        )
                );
        $this->email->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
        
        
        
        
        $this->addElement('textarea', 'message', array(
            'label' => 'Message :',
            'required' => true
        ));
        $this->message->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
	   $this->addElement('submit', 'submit', array(
          'ignore'   => true,
            'label'    => 'Book Now',
        ));


         $this->submit->setAttrib('class', 'button grey');



          $this->setDecorators(array(
                    'FormElements',
         			array(array('e' => 'HtmlTag'), array('tag' => 'dl')),
         			array(array('e1' => 'HtmlTag'), array('tag' => 'div', 'class' => 'inner-form')),
         			'Form'
        ));


        $this->setAttrib('class', 'basic');


	}


}
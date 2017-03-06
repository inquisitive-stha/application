<?php
class Frontoffice_Form_Contactus extends Zend_Form {
    public function init() {
        $this->setMethod('post');
         $this->addElement('text', 'firstname', array(
            'label' => 'FirstName:',
            'required' => true
        ));
        $this->firstname->setAttrib('class', 'txt')->addValidator('NotEmpty');
        $this->addElement('text', 'lastname', array(
            'label' => 'LastName :',
            'required' => true
        ));
        $this->lastname->setAttrib('class', 'txt')->addValidator('NotEmpty');
        
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
        $this->email->setAttrib('class', 'txt')->addValidator('NotEmpty');;
        $this->addElement('text', 'yourphoneormobile', array(
            'label' => ' Your Phone or Mobile:',
            'required' => true
        ));
        $this->yourphoneormobile->setAttrib('class', 'txt')->addValidator('NotEmpty');
         
        $this->addElement('textarea', 'yourmessage', array(
            'label' => 'Your Message :',
            'required' => true
        ));
        $this->yourmessage->setAttrib('class', 'txt')->addValidator('NotEmpty');
         
         
         
        $this->addElement('submit', 'submit', array(
          'ignore'   => true,
            'label'    => 'Send',
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
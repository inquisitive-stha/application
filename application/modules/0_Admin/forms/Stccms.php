<?php
class Admin_Form_Stccms extends Zend_Form {
    public function init() {
        $this->setMethod('post');
         $this->addElement('text', 'title', array(
            'label' => 'Title:',
            'required' => true
        ));
        $this->title->setAttrib('class', 'txt')->addValidator('NotEmpty');
        $this->addElement('textarea', 'description', array(
            'label' => 'Description :',
            'required' => true
        ));
        $this->description->setAttrib('class', 'txt')->addValidator('NotEmpty');
         
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
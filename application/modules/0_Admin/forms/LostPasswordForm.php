<?php
class Admin_Form_LostPasswordForm extends Zend_Form
{
	public function addMyDecorator($elm)
	{
		$elm->setDecorators(array(
		    'ViewHelper',
		    'Description',
		    array('Errors', array('class' => 'error')),
		    array(array('e' => 'HtmlTag'), array('tag' => 'td')),
		    array('Label', array('tag' => 'th')),
		    array(array('e1' => 'HtmlTag'), array('tag' => 'tr'))
		));
	}
	
    public function init()
    {
    	$this->setMethod('post');
    	
        $email = $this->createElement('text','email');
        $email->setLabel('Email:* ')->setRequired(true);
        $this->addMyDecorator($email);
        $email->setAttrib('class', 'txt');
                
               
        $signin = $this->createElement('submit','signin');
        $signin->setLabel('Send Password')->setIgnore(true);
        $signin->setAttrib('class', 'button');
        $signin->setDecorators(array(
		    'ViewHelper',
		    'Description',
		    'Errors',
		    array(array('e' => 'HtmlTag'), array('tag' => 'td', 'class' => 'tr proceed')),
		    array(array('e1' => 'HtmlTag'), array('tag' => 'td')),
		    array(array('e2' => 'HtmlTag'), array('tag' => 'tr'))
		));
                
        $this->addElements(array(
                        $email,
                        $signin,
        ));
        
        $this->setDecorators(array(
        			'FormErrors',
        			array(array('e1' => 'HtmlTag'), array('tag' => 'div')),
                    'FormElements',
         			array('HtmlTag', array('tag' => 'table')),
         			'Form'
        ));
        //$this->getDecorator('Errors')->setElement('p');
        
    }
}
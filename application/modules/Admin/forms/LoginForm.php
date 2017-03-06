<?php
class Admin_Form_LoginForm extends Zend_Form
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
    	
        $username = $this->createElement('text','username');
        $username->setLabel('Username:* ')->setRequired(true);
        $this->addMyDecorator($username);
        $username->setAttrib('class', 'txt');
                
        $password = $this->createElement('password','password');
        $password->setLabel('Password: *')->setRequired(true);
        $this->addMyDecorator($password);
        $password->setAttrib('class', 'txt');
                
        $signin = $this->createElement('submit','signin');
        $signin->setLabel('Sign in')->setIgnore(true);
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
                        $username,
                        $password,
                        $signin,
        ));
        
        $this->setDecorators(array(
        			//'FormErrors',
        			//array(array('e1' => 'HtmlTag'), array('tag' => 'div')),
        			//array(array('e2' => 'HtmlTag'), array('tag' => 'div', 'class' => 'msg msg-error')),
                    'FormElements',
         			array('HtmlTag', array('tag' => 'table')),
         			'Form'
        ));
        //$this->getDecorator('Errors')->setElement('p');
        
    }
}
<?php
class Admin_Form_Users extends Zend_Form
{
	
	public function init()
	{
        $this->setMethod('post');
         $this->addElement('text', 'username', array(
            'label'      => 'User Name:',
            'required'   => true
        ));
        $this->username->setAttrib('class', 'txt');
        $this->addElement('text', 'email', array(
            'label'      => 'E-mail:',
            'required'   => true
        ));
        $this->email->setAttrib('class', 'txt');
        $this->addElement('password', 'oldpassword', array(
            'label'      => 'Old Password:',
            'required'   => true
        ));
        $this->oldpassword->setAttrib('class', 'txt');
        $this->addElement('password', 'password', array(
            'label'      => 'Password:',
            'required'   => true
        ));
        $this->password->setAttrib('class', 'txt')->addValidator('StringLength', true, array(6,50));
        $this->addElement('password', 'npassword', array(
            'label'      => 'New Password:',
            'required'   => true
        ));
        $this->npassword->setAttrib('class', 'txt')->addValidator('StringLength', true, array(6,50));

         $this->addElement('password', 'cpassword', array(
            'label'      => 'Confirm Password:',
            'required'   => true
        ));
        $this->cpassword->setAttrib('class', 'txt')->addValidator('StringLength', false, array(6,50))
->addValidator(new Zend_Validate_Identical($_POST['npassword']));
        $this->addElement('text', 'firstname', array(
            'label'      => 'First Name:',
            'required'   => true
        ));
        $this->firstname->setAttrib('class', 'txt');

        $this->addElement('text', 'lastname', array(
            'label'      => 'Last Name:',
            'required'   => true
        ));
        $this->lastname->setAttrib('class', 'txt');

        $this->addElement('text', 'phone', array(
            'label'      => 'Phone No:',
            'required'   => true
        ));
        $this->phone->setAttrib('class', 'txt');

        $this->addElement('text', 'gsm', array(
            'label'      => 'Gsm:',
            'required'   => true
        ));
        $this->gsm->setAttrib('class', 'txt');

        $this->addElement('text', 'company', array(
            'label'      => 'Company:',
            'required'   => true
        ));
        $this->company->setAttrib('class', 'txt');

//         $this->addElement('text', 'regdate', array(
//            'label'      => 'Regdate:',
//            'required'   => true
//        ));
//        $this->regdate->setAttrib('class', 'txt');

        $this->addElement('checkbox', 'status', array(
            'label'      => 'Status:',
            'required'   => true
        ));
        $this->status->setAttrib('class', 'txt');

        $this->addElement('select', 'usertype', array(
            'label'      => 'User Type:',
            'required'   => true
        ));
        $this->usertype->setAttrib('class', 'txt');

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
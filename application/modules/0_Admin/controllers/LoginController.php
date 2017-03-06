<?php 
class Admin_LoginController extends Admin_Controller_Action_Abstract
{
	public function preDispatch()
    {
    }
    function generatePassword($length=9, $strength=0)
    {
    $vowels = 'aeuy';
    $consonants = 'bdghjmnpqrstvz';
    if ($strength & 1) {
        $consonants .= 'BDGHJLMNPQRSTVWXZ';
    }
    if ($strength & 2) {
        $vowels .= "AEUY";
    }
    if ($strength & 4) {
        $consonants .= '23456789';
    }
    if ($strength & 8) {
        $consonants .= '@#$%';
    }
    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
    }
	public function indexAction()
	{
            $this->_helper->_layout->setLayout('login_layout');
            $form = new Admin_Form_LoginForm();
            $form_lost_password = new Admin_Form_LostPasswordForm();
            //$form->setAction($action)
        //print_r($_POST);exit();
        if($this->getRequest()->isPost())
        {
            if(isset($_POST['email']))
            {
                if($form_lost_password->isValid($_POST)){
                $data = $form_lost_password->getValues();
                $to      = $_POST['email'];
                $subject = 'New Password';
                $password = $this->generatePassword();
                $message = 'Your new password is...<br/>'.$password;
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: finecurry@co.uk' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                $mailsend = mail($to, $subject, $message, $headers);
                $pcux = new Admin_Model_DbTable_Users();
                $pdata = array('password' => $password);
                $emailsx = $pcux->update($pdata, 'email = "' . $_POST['email'].'"');
                if($mailsend == true)
                {
                    $form_lost_password->clearDecorators();
                    $form_lost_password->setDecorators(array(
			        			'FormErrors',
			        			array(array('e1' => 'HtmlTag'), array('tag' => 'div')),
			        			array(array('e2' => 'HtmlTag'), array('tag' => 'div', 'class' => 'msg1 msg-error1')),
                                                        'FormElements',
			         			array('HtmlTag', array('tag' => 'table')),
			         			'Form'
			        ));
                    $form_lost_password->addError("Please check your mail to see password !!!");
                } else {
                	$form_lost_password->clearDecorators();
                	$form_lost_password->setDecorators(array(
			        			'FormErrors',
			        			array(array('e1' => 'HtmlTag'), array('tag' => 'div')),
			        			array(array('e2' => 'HtmlTag'), array('tag' => 'div', 'class' => 'msg msg-error')),
                                                        'FormElements',
			         			array('HtmlTag', array('tag' => 'table')),
			         			'Form'
			        ));
                    $form_lost_password->addError("Invalid Email. Please try again.");
                }
            }
            }
            else
            {
            if($form->isValid($_POST)){
                //echo md5($data['password']);exit();
                $data = $form->getValues();
                $password = md5($data['password']);
                //echo $password;exit();
                $pcuser = new Admin_Model_DbTable_Users();
                $users = $pcuser->fetchAll('status = 1 AND username = "' . $data['username'] . '" AND password = "' . $password . '"');
                //echo '<pre>';print_r($users);echo '</pre>';exit();
                //echo $users[0]['username'];exit();
                if(count($users) > 0)
                {
                    //echo $users[0]->id;exit();
                    $storage = new Zend_Auth_Storage_Session();
                    $data['admin_user_id'] = $users[0]->id;
                    $data['user_type'] = $users[0]->usertype;
                    $storage->write($data);
                    //print_r($data);exit();
                    //echo $data['login_id'];exit();
                    $this->_redirect('Admin/index');
                } else {
                	$form->clearDecorators();
                	$form->setDecorators(array(
			        			'FormErrors',
			        			array(array('e1' => 'HtmlTag'), array('tag' => 'div')),
			        			array(array('e2' => 'HtmlTag'), array('tag' => 'div', 'class' => 'msg msg-error')),
                                                        'FormElements',
			         			array('HtmlTag', array('tag' => 'table')),
			         			'Form'
			        ));
                    $form->addError("Invalid username or password. Please try again.");
                }
            }
            }
        }
        $this->view->form = $form;
        $this->view->form_lost_password = $form_lost_password;
	//}
        }
//    public function lostpasswordAction()
//    {
//        $form_lost_password = new Admin_Form_LostPasswordForm();
//        print_r($_POST);exit();
//    }
	public function logoutAction()
    {
        $storage = new Zend_Auth_Storage_Session();
        $storage->clear();
        $this->_redirect('Admin/login');
    }
}
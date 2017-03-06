<?phpclass Admin_UsersController extends Admin_Controller_Action_Abstract {    public function addAction() {        $form = new Admin_Form_Users();        $usertypeList = array();        $usertypeList[""] = '---- Select User Type ----';        $usertypeList[1] = 'Super Admin';        $usertypeList[2] = 'General';        $form->usertype->setMultiOptions($usertypeList);        $form->removeElement('oldpassword');        $form->removeElement('npassword');        $form->removeElement('cpassword');        if ($this->getRequest()->isPost()) {            $formData = $this->getRequest()->getPost();            if ($form->isValid($formData)) {                $username = $form->getValue('username');                $email = $form->getValue('email');                $password1 = $form->getValue('password');                $password = md5($password1);                $firstname = $form->getValue('firstname');                $lastname = $form->getValue('lastname');                $phone = $form->getValue('phone');                $gsm = $form->getValue('gsm');                $company = $form->getValue('company');//$regdate = $form->getValue('regdate');                $datesx = Zend_Date::now();                $original = time($datesx);//echo $original;exit();                $regdate = date("Y-m-d H:i:s", $original);                $status = $form->getValue('status');                $usertype = $form->getValue('usertype');                $pc = new Admin_Model_DbTable_Users();                $data = array('username' => $username, 'email' => $email, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'phone' => $phone,                    'gsm' => $gsm, 'company' => $company, 'regdate' => $regdate, 'status' => $status, 'usertype' => $usertype);                $pc->insert($data);                $this->_helper->redirector('list');            } else {                $form->populate($formData);            }        }        $this->view->form = $form;    }    public function editAction() {        $form = new Admin_Form_Users();        $form->submit->setLabel('Save');        $this->view->form = $form;        $id = $this->_getParam('id', 0);        $pc = new Admin_Model_DbTable_Users();        $usertypeList = array();        $usertypeList[""] = '---- Select User Type ----';        $usertypeList[1] = 'Super Admin';        $usertypeList[2] = 'General';        $form->usertype->setMultiOptions($usertypeList);        $form->removeElement('password');        if ($this->getRequest()->isPost()) {            $formData = $this->getRequest()->getPost();            if ($form->isValid($formData)) {                $username = $form->getValue('username');                $email = $form->getValue('email');                $oldpassword1 = $form->getValue('oldpassword');                $oldpassword = md5($oldpassword1);                $password1 = $form->getValue('npassword');                $password = md5($password1);                $firstname = $form->getValue('firstname');                $lastname = $form->getValue('lastname');                $phone = $form->getValue('phone');                $gsm = $form->getValue('gsm');                $company = $form->getValue('company');//$regdate = $form->getValue('regdate');                $datesx = Zend_Date::now();                $original = time($datesx);//echo $original;exit();                $regdate = date("Y-m-d H:i:s", $original);                $status = $form->getValue('status');                $usertype = $form->getValue('usertype');                $pc = new Admin_Model_DbTable_Users();                $data = array('username' => $username, 'email' => $email, 'password' => $password, 'firstname' => $firstname, 'lastname' => $lastname, 'phone' => $phone,                    'gsm' => $gsm, 'company' => $company, 'regdate' => $regdate, 'status' => $status, 'usertype' => $usertype);//echo '====='.$id;exit();//echo 'aaaaa';exit();//echo $oldpassword;exit();                $passx = $pc->fetchRow('id = ' . $id);//echo '<pre>';print_r($passx);echo '</pre>';exit();//echo count($passx);exit();                if ($oldpassword != $passx->password) {//echo 'aaaaa';exit();                    $this->view->message = "Error !!! Old Password does not match !!!";                    $form->populate($formData);                } else {//echo 'vvvv';exit();                    $pc->update($data, 'id = ' . $id);                    $this->_helper->redirector('list');                }            } else {                $form->populate($formData);            }        } else {            $row = $pc->fetchRow('id = ' . $id);            if (!$row) {                throw new Exception("Could not find row $id");            }            $form->populate($row->toArray());        }    }    public function listAction() {        $pc = new Admin_Model_DbTable_Users();        $storage = new Zend_Auth_Storage_Session();        $data = $storage->read();//echo '<pre>';print_r($data);echo '<pre>';exit();        $user_id = $data['admin_user_id'];        $profile = $pc->fetchRow('id = ' . $user_id);        $publish = $this->_getParam('publish', '-1');        $unpublish = $this->_getParam('unpublish', '-1');        if ($publish != -1) {            $data = array('status' => '1');            $pc->update($data, 'id = ' . $publish);        }        if ($unpublish != -1) {            $data = array('status' => '0');            $pc->update($data, 'id = ' . $unpublish);        }        $sf = $this->_getParam('sf', 'id');        $sd = $this->_getParam('sd', 'asc');        $this->view->title_sort_order = ($sd == 'asc') ? 'desc' : 'asc';        if ($profile->usertype == 1) {            $categories = $pc->select()->order("$sf $sd");        } else {            $where = 'usertype = ' . $profile->usertype;//echo $where;exit();            $categories = $pc->select()->where($where)->order("$sf $sd");        }        $this->view->paginator = Zend_Paginator::factory($categories);        $this->view->paginator->setCurrentPageNumber($this->_getParam('page', 1));    }    public function deleteAction() {        $pc = new Admin_Model_DbTable_Users();        $id = $this->_getParam('id', -1);        if ($this->getRequest()->isPost()) {            $del = $this->getRequest()->getPost('del');            if ($del == 'Yes') {                $id = $this->getRequest()->getPost('id');                $pc->delete('id = ' . $id);            }            $this->_helper->redirector('list');        } else {            $id = $this->_getParam('id', 0);            $row = $pc->fetchRow('id = ' . $id);            $this->view->users = $row->toArray();        }    }}
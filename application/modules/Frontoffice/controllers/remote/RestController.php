<?php

class RestController extends Frontoffice_Controller_Action_Abstract
{
	public function preDispatch()
    {
    	$this->view->render('_header.phtml');
    	//$this->view->render('_topmenu.phtml');
    	//$this->view->render('_search.phtml');
    	//$this->view->render('_mainmenu.phtml');
    	
    	$this->view->render('_footer.phtml');
    	$this->view->render('_right_bar.phtml');
        //$this->view->render('_form1.phtml');

    }
    	
	public function indexAction()
	{
		$this->_helper->_layout->setLayout('two-column');
                $pc = new Frontoffice_Model_DbTable_Rest();
                $sf = $this->_getParam('sf', 'id');
                $sd = $this->_getParam('sd', 'asc');
                $this->view->title_sort_order = ($sd == 'asc')?'desc':'asc';
               

                if ($this->getRequest()->isPost())
                {

                    $formData = $this->getRequest()->getPost();
                    //print_r($formData);
                    //exit();
                    $service = 0;
                    if(isset($_POST['pickup']) && isset($_POST['delivery']))
                    {
                        $service = 3;
                    }
                    else if(isset($_POST['delivery']))
                    {

                        $service = 2;
                    }
                    else if(isset($_POST['pickup']))
                    {
                        $service = 1;
                    }
                    else
                    {
                         $service = 5;

                    }
                    $postcode_str = "";
                    $where = ' status = 1';
                    if(trim($_POST['zip']) != "")
                    {
                        $where .= ' AND LOWER(REPLACE(post_code, " ", "")) LIKE "%'.str_replace(" ", "", strtolower($formData['zip'])).'%"';
                    }
                    $service_str = "";
                    if($service != 0)
                    {
                        $where .= ' AND serviceid ='.$service;
                    }

                    $addr_str = "";
                    //print_r($_POST);
                    
                    if(trim($_POST['address']) != "")
                    {
                        //echo '-----';
                        //exit();
                        $city = $formData['address'];
                        $citiesx = new Admin_Model_DbTable_Cities();
                        $citydatax = $citiesx->fetchRow(' city LIKE "%'.$city.'%" AND status = 1');
                        
                        if(isset($citydatax->id))
                        {
                            $where .= ' AND cityid ='.$citydatax->id;
                        }
                        //print_r($addr_str);
                        //exit();
                      
                    }
                     

                     //echo $postcode_str.$service_str.$addr_str;
                     //echo $where;
                     //exit();
                    $this->view->rests = $pc->fetchAll($where);
                    //print_r($this->view->rests);
                   
                }
                else
                {
                     $this->view->rests = $pc->fetchAll('status = 1');
                }
	}


	
       

        
}
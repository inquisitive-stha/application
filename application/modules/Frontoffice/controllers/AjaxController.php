<?php
class AjaxController extends Frontoffice_Controller_Action_Abstract
{
    public function preDispatch()
    {
       
    }
    public function printxAction()
    {
        $this->_helper->_layout->setLayout('ajax');
    }
   

    public function postcodeAction()
    {

        $this->_helper->_layout->setLayout('ajax');
        $q = $this->_getParam('q', 0);
        
        $pc = new Frontoffice_Model_DbTable_Postcodes();
        //$this->view->pp = $pc->fetchAll('code like %'.strtoupper(trim($q)).'%');
        $this->view->pp = $pc->fetchAll('code like "'.strtoupper(trim($q)).'%"', '' , 15);
     }

     public function checkdistanceAction()
    {

        $this->_helper->_layout->setLayout('ajax');
      
        $givenpostcode = $_POST['pcode_f'];
        $resid = $_POST['resid'];
        $pc = new Frontoffice_Model_DbTable_Postcodes();
        
        $pcode1 = $pc->fetchRow('code = "'. $givenpostcode .'"');
       
        $lat11 = $pcode1->latitude;
        $long11 = $pcode1->longitude;
        $lat1 = deg2rad($lat11);
        $long1= deg2rad($long11);
        $pcrr = new Frontoffice_Model_DbTable_Rest();
        $postcode21 = $pcrr->fetchRow('id = '. $resid);
        
        $pcode2 = $pc->fetchRow('id = '. $postcode21->postcodeid);
       
         #$earth = 6371; #km change accordingly
         $earth = 3960; #miles
         $long21 =  $pcode2->longitude;

         $lat21 =  $pcode2->latitude;
         $lat2 = deg2rad($lat21);
         $long2= deg2rad($long21);

         #Haversine Formula
        $dlong=$long2-$long1;
        $dlat=$lat2-$lat1;

        $sinlat=sin($dlat/2);
        $sinlong=sin($dlong/2);

        $a=($sinlat*$sinlat)+cos($lat1)*cos($lat2)*($sinlong*$sinlong);

        $c=2*asin(min(1,sqrt($a)));

        $d=round($earth*$c,3);
       
        if($d < 3)
        {

            $value= array('success'=>1, 'd' => $d, 'code2' => $pcode2->code);
            echo json_encode($value);

        }
        else
        {

             $value= array('success'=>0, 'd' => $d, 'code2' => $pcode2->code);
             echo json_encode($value);
        }

        
       
     }
}
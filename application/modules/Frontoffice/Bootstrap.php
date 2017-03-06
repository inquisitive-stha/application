<?php
class Frontoffice_Bootstrap extends Zend_Application_Module_Bootstrap 
{ 
	protected function _initPage()
    {

    }
}

class FrontController extends Frontoffice_Controller_Action_Abstract

{

	public function preDispatch()
        {
			
			
			parent::preDispatch();

        }
		
		
	public function setup($lang)

        {
			$pc = new Admin_Model_DbTable_Languages();
			$languages = $pc->fetchAll();
			
			$default_flag = array();
			$other_flags = array();
			$lang = $this->_getParam('lang', 0);

                        $storage = new Zend_Auth_Storage_Session();
			$data = ($storage->read());
                        if($lang == 0 && isset($data['flag'])){
                            $lang = $data['flag'];
                        }
			
			foreach($languages as $language){
				if($lang == $language->id){
					$default_flag = $language;
				}
				else
				if($language->is_default == 1 && $lang == 0){
					$default_flag = $language;
				}
				else{
					$other_flags[] = $language;
				}
			}
			
			$this->view->languages = $other_flags;
			$this->view->default_flag = $default_flag;
			
			
			$storage = new Zend_Auth_Storage_Session();
			$data = ($storage->read());
			$data['flag'] = $default_flag->id;
			$storage->write($data);
			
			
			$controller = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
			$this->view->controller = $controller;
			
			$action = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
			$this->view->action = $action;
        }
		
		public function getText($code){
			$storage = new Zend_Auth_Storage_Session();
			$arr = $storage->read();
			
			$pc = new Admin_Model_DbTable_Label();
			$row = $pc->fetchRow($pc->select()->where('TRIM(label_code) = "'.trim($code).'"'));
			
			$pc = new Admin_Model_DbTable_Translation();
			$trans = $pc->fetchRow($pc->select()->where('label_id ='.$row->id.' AND language_id = '.$arr['flag']));
			//p($trans);
			
			
			//p($arr);
			 return urldecode($trans->m_text);
			
		}
                
                
                
                
                
                
                public function getMedia($code){			
			
			$dao = new Admin_Model_DbTable_Stcmedia();
			$row = $dao->fetchRow($dao->select()->where('TRIM(`key`) = "'.trim($code).'"'));
			return urldecode($row->media_path);
			
		}
                
                
                 public function getSettings($code){			
			
			$dao = new Admin_Model_DbTable_Stcsettings();
			$row = $dao->fetchRow($dao->select()->where('TRIM(`key`) = "'.trim($code).'"'));
			return urldecode($row->value);
			
		}
                
                
                
                
                
                
                
                public function wrapwithP($str)
                {
                   
                    $str = strip_tags($str, "<br>");
                    
                    //echo '===='.$str;
                    
                    $str = str_replace(array("<br>", "<br/>"), "</p><p>", $str);
                    
                    $str = '<p>'.$str.'</p>';
                    return $str;
                }

    
}
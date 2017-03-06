<?php
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap 
{ 
	function _initialize()
	{
		
	}
	
	protected function _initAppSettings()
    {
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('_page_control.phtml');
        Zend_Paginator::setDefaultItemCountPerPage(12);
    }
}
<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	function _initViewHelpers(){
		
	
		
		$this->bootstrap('layout');
		$layout=$this->getResource('layout');
		$view = $layout->getView();
		
		
		Zend_Dojo::enableView($view);
		
		$view->doctype('XHTML1_STRICT');
		//Meta
		$view->headMeta()->appendName('keywords', 'framework, PHP')
		->appendHttpEquiv('Content-Type','text/html;charset=utf-8');
		// Set the initial title and separator:
		$view->headTitle('OS Site')
		->setSeparator(' :: ');
		// Set the initial stylesheet
		//$view->headLink()->prependStylesheet('/css/style.css');
		// Set the initial JS to load:
		//$view->headScript()->prependFile('/js/site.js'); 
	
	
	
	
	
	}
	
	

}


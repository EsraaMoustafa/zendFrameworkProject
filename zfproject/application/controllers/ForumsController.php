<?php

class ForumsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {

    	if(Zend_Auth::getInstance()->hasIdentity()){
  
    	
    		$userdata=Zend_Auth::getInstance()->getIdentity();
    		$uid=$userdata->uid;
    	
    		if($userdata->role !='admin'){
    			$this->redirect('/authentiction/login');
    		}
    	
    	
    	}
    	else
    	{
    		$this->redirect('/authentiction/login');
    	}
    	
    	
    	
    	
	$forums_model=new Application_Model_Forums();
        $this->view->forums=$forums_model->listForums();
     
    }


}




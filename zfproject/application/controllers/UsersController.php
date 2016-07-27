<?php

class UsersController extends Zend_Controller_Action
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
    	
        // action body
    	$user_model = new Application_Model_User();
    	$this->view->users  = $user_model->listUsers();
    }


}




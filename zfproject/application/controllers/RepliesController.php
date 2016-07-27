<?php

class RepliesController extends Zend_Controller_Action
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
    		 
    		if($userdata->role =='admin'){
    			$reply_model=new Application_Model_Reply();
    			$this->view->reply=$reply_model->listReplies();
    		}
    		else {
    			
    			$reply_model=new Application_Model_Reply();
    			$this->view->reply=$reply_model->listRepliesbyuid($uid);
    			
    		}
    		 
    		 
    	}
    	else
    	{
    		$this->redirect('/authentiction/login');
    	}
    	
    	
    	
    	
    	
 
    }


}




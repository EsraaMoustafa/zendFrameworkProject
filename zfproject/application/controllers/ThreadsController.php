<?php

class ThreadsController extends Zend_Controller_Action
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
    	
    	$uid;
    	$role;
    	if(Zend_Auth::getInstance()->hasIdentity()){
    		 
    		$userdata=Zend_Auth::getInstance()->getIdentity();
    		$uid=$userdata->uid;
    		$role=$userdata->role;
    		 
    		 
    		 
    	}
    	else
    	{
    		$this->redirect('/authentiction/login');
    	}
    	
        
    	if($role=='admin'){
    	
	        $thread_model=new Application_Model_Thread();
	        $this->view->threads=$thread_model->listThreads();
    	}
    	else 
    	{
    		$thread_model=new Application_Model_Thread();
    		$this->view->threads=$thread_model->listThreadsbyId($uid);
    	}
        
        
    }

    public function listAllWithStickyAction()
    {
        // action body
        
    	$thread_model=new Application_Model_Thread();
    	$this->view->stickyThreads=$thread_model->liststickyThreads();
    	

    	$thread_model=new Application_Model_Thread();
    	$this->view->threads=$thread_model->listThreads();
    	
    	
    	
    }


}






<?php

class CategoriesController extends Zend_Controller_Action
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
    	
    	/* Initialize action controller here */
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
    	
    	
	$categories_model=new Application_Model_Categories();
        $this->view->categories=$categories_model->listCategories();
     
    }


}




<?php

class CategoryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	if(Zend_Auth::getInstance()->hasIdentity()){
    		 
    		//$this->redirect('/users/list');
    		
    		//echo "<pre>";
    		//print_r(Zend_Auth::getInstance()->getIdentity());
    		//echo "</pre>";
    		//exit;
    		
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
    	
    	
    
    	
    	
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {

    	$uid;
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
    	 
    	
	$cat_form = new Application_Form_Category();
        if($this->getRequest()->isPost()){
            if($cat_form->isValid($this->getRequest()->getParams())){
                $cat_model = new Application_Model_Category();
          $cat_model->addCategory($cat_form->getValues(),$uid);
               // $this->_redirect("/post/list/msg/1");
            }
        }
        $this->view->cat_form = $cat_form;	

    }

    public function editAction()
    {
    	$uid;
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
    	 
    	
    	
    	
    	
    	
        $cid = $this->getRequest()->getParam('id');
        $cat_model = new Application_Model_Category();
        $name=$cat_model->getCategoryById($cid);
        $cat_form = new Application_Form_Edit();
        $c=$cat_form->getElement('category');
        $c->setValue($name[0]['cname']);
        
        
        
              
        if($this->getRequest()->isPost()){
            
            if($cat_form->isValid($this->getRequest()->getParams())){
                $cat_model = new Application_Model_Category();
                
                $cat_model->editCategory($cid, $cat_form->getValues(),$uid);
                $this->_redirect("categories/list/");
            }
        }
        
        
        
        $this->view->cat_form = $cat_form;
        
        
        
        
    }

    public function deleteAction()
    {
    	
    	
    	$uid;
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
    	
    	
    	
    	
    	
    	
        $id = $this->_request->getParam('id');
	if(!empty($id)){
            $cat_model = new Application_Model_Category();
            $cat_model->deleteCategory($id);
	}
	$this->redirect('/categories/list/');
    }


}








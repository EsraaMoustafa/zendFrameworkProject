<?php

class ForumController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	
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
    	
    	
    	
    	
        
        $forum_form = new Application_Form_Forum();
        
        $catmodle= new Application_Model_Categories();
        
        $catTitle = $forum_form->getElement('catid');
        
        $catTitles=array();
        
        
        foreach ($catmodle->listCategories() as $value) {
            $title="";
            $id="";
            foreach ($value as $name) {
              $title=$value['cname'];
              $id=$value['cid'];
            }
            
            $catTitles["$id"] = $title;
            
        }
       
        
        //print_r($catTitles);
        //exit();
        $catTitle->addMultiOptions($catTitles);
        
        
        if($this->getRequest()->isPost()){
            if($forum_form->isValid($this->getRequest()->getParams())){
                $forum_model = new Application_Model_Forum();
                  
                /*
                echo "<pre>";
                print_r($forum_form->getValues());
                echo "</pre>";
                
                exit();
                */
                
                
                $forum_model->addForum($forum_form->getValues(),$uid);
               // $this->_redirect("/post/list/msg/1");
            }
        }
        $this->view->forum_form = $forum_form;	

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
    	
    	
    	
    	
    	
    	
    	
        
        $catmodle = new Application_Model_Categories();
        
        $forum_form = new Application_Form_EditForum();
        
        $catTitle = $forum_form->getElement('catid');
    
        
        
        
        
        
        $catTitles=array();
            
        foreach ($catmodle->listCategories() as $value) {
            $title="";
            $id="";
            foreach ($value as $name) {
              $title=$value['cname'];
              $id=$value['cid'];
            }
            
            $catTitles["$id"] = $title;
            
        }
       
        $catTitle->addMultiOptions($catTitles);
        
        //echo "$catTitle";
      
        $fid = $this->getRequest()->getParam('id');
        $forum_model = new Application_Model_Forum();
        $name=$forum_model->getForumById($fid);
       
        $f=$forum_form->getElement('forum');
        $f->setValue($name[0]['title']);
        $catTitle->setValue($name[0]['cid']);
        
        $l=$forum_form->getElement('locked');
        $l->setValue($name[0]['status']);
        
        
        if($this->getRequest()->isPost()){
            
            if($forum_form->isValid($this->getRequest()->getParams())){
                $forum_model = new Application_Model_Forum();
                $forum_model->editForum($fid, $forum_form->getValues(),$uid);
                $this->_redirect("forums/list/");
            }
        }
        
        
        
        $this->view->forum_form = $forum_form;
        
    }

    public function deleteAction()
    {
        $id = $this->_request->getParam('id');
	if(!empty($id)){
            $forum_model = new Application_Model_Forum();
            $forum_model->deleteForum($id);
	}
	$this->redirect('/forums/list/');
    }


}








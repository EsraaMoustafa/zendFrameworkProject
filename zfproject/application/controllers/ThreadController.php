<?php

class ThreadController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
	
    	
    	
    	
    }

    public function indexAction()
    {
       // $this->_redirect("/threads/list");
    }

    public function addAction()
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
    	
    	
    	$thread_form = new Application_Form_Thread();

    	$forum_modele = new Application_Model_Forums();
    	
    	
    	$fid = $thread_form->getElement('fid');
    	
    	$fids=array();
    	
    	
    	foreach ($forum_modele->listForums()   as $value) {
    		$title="";
    		$id="";
    		foreach ($value as $name) {
    			$title=$value['title'];
    			$id=$value['fid'];
    		}
    	
    		$fids["$id"] = $title;
    	
    	}
    	 
    	
    	//print_r($catTitles);
    	//exit();
    	$fid->addMultiOptions($fids);
    	
    	
    	
    	
    	
    	
    	
 
        if($this->getRequest()->isPost()){
            
            if($thread_form->isValid($this->getRequest()->getParams())){
                $thread_model = new Application_Model_Thread();

                $mod=new Application_Model_Forum();
                $name= $mod->getForumById($thread_form->getValues('fid'));
                if($name[0]['status']=='lock'){
                $this->view->err=":( it is locked";
                }
                else{
                
                
                
                $thread_model->addThread($thread_form->getValues(),$uid);
                $this->_redirect("/threads/list");
                }
            }
        }
        $this->view->thread_form = $thread_form;
       
    }

    public function editAction()
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
    	
    	
    	
    	
    	
    	

        $tid = $this->getRequest()->getParam('id');
        $thread_model = new Application_Model_Thread();
        $namee=$thread_model->getThreadById($tid);
        
        
        
        $thread_form = new Application_Form_ThreadEdit();

        
        $forum_modele = new Application_Model_Forums();
         
         
        $fid = $thread_form->getElement('fid');
         
        $fids=array();
         
         
        foreach ($forum_modele->listForums()   as $value) {
        	$title="";
        	$id="";
        	foreach ($value as $name) {
        		$title=$value['title'];
        		$id=$value['fid'];
        	}
        	 
        	$fids["$id"] = $title;
        	 
        }
        
         
        //print_r($catTitles);
        //exit();
        $fid->addMultiOptions($fids);
        
        
        
        $th = $thread_form->getElement('title');
        $th->setValue($namee[0]['title']);
        
        $th=$thread_form->getElement('body');
        $th->setValue($namee[0]['body']); 
            
        $th=$thread_form->getElement('fid');
        $th->setValue($namee[0]['fid']);
        $th=$thread_form->getElement('type');
        $th->setValue($namee[0]['type']);
        $th=$thread_form->getElement('locked');
        $th->setValue($namee[0]['status']);
        
        
        
              
        if($this->getRequest()->isPost()){
            
            if($thread_form->isValid($this->getRequest()->getParams())){
                $thread_model = new Application_Model_Thread();
                $thread_model->editThread($tid, $thread_form->getValues(),$uid);
                $this->_redirect("threads/list/");
            }
        }
        
        $this->view->thread_form = $thread_form;  
        
    }

     public function deleteAction()
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
    	
    	
    	
    	
      	$tid = $this->_request->getParam ( 'id' );
      	
        $thread_model = new Application_Model_Thread();
                
        $thread_model->deleteThread($tid);
        $this->redirect('/threads/list');
				
    }

    public function displayAction()
    {
    	
    	
    	
    	
    	
    	
    	
    	
        $tid = $this->getRequest()->getParam('id');
     
        
 
        $thread_model = new Application_Model_Thread();
        
        
        $thread = $thread_model->getThreadById($tid);
		
      /*  echo "<pre>";
        print_r($thread);
        echo "</pre>";
        
        */
        
        $this->view->title= $thread[0]['title'];
        $this->view->body= $thread[0]['body'];
        
        
       
        
        
        //var_dump($thread);
        //exit();
        
        if($thread[0]['status']=='lock'){
        	$this->view->reerro="): can not add reply";
        }
        
        else{
        
        $reply_form=new Application_Form_Reply();
        
       //echo $reply_form;
        
        $id=new Zend_Form_Element_Hidden('tid');
        $id->setValue($tid);
        
        $reply_form->addElement($id);
        }
        
        
        
        
        
        $rep_modle =new Application_Model_Reply();
        $this->view->replies= $rep_modle->getReplyByThreadId($tid);
                  
        
        if($this->getRequest()->isPost()){
        
        	if($reply_form->isValid($this->getRequest()->getParams())){
        		$reply_model = new Application_Model_Reply();
        		$reply_model->addReply($reply_form->getValues());
        		$this->_redirect("/thread/display/id/".$tid."");
        	}
        }
        
        
        
        
        //$reply_model = new Application_Model_Reply();
        //$replies= $reply_model->getRepliesByThreadId($tid);
        
        //$this->view->replies = $replies;
        //$this->view->thread = $thread;
        $this->view->form= $reply_form;
                
        
    }


}










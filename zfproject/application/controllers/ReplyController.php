<?php

class ReplyController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
    	$reply_form = new Application_Form_Reply();
    	if(Zend_Auth::getInstance()->hasIdentity()){
    		 
    		$userdata=Zend_Auth::getInstance()->getIdentity();
    		$uid=$userdata->uid;
    		 

    	
    		if($this->getRequest()->isPost()){
    		
    			if($reply_form->isValid($this->getRequest()->getParams())){
    				$reply_model = new Application_Model_Reply();
    				$reply_model->addReply($reply_form->getValues(),$this->view->identity->id);
    				$this->_redirect("/replies/list");
    			}
    		}
    		 
    		 
    	}
    	else
    	{
    		$this->redirect('/authentiction/login');
    	}
    	 
    	
    	
    	

        $this->view->reply_form = $reply_form;
    }

    public function editAction()
    {
    	if(Zend_Auth::getInstance()->hasIdentity()){
    	
    		$userdata=Zend_Auth::getInstance()->getIdentity();
    		$uid=$userdata->uid;

    			$this->redirect('/authentiction/login');

    	}
    	else
    	{
    		$this->redirect('/authentiction/login');
    	}
    	
    	
    	
        $rid = $this->getRequest()->getParam('id');
        $reply_model = new Application_Model_Reply();
        $name=$reply_model->getReplyById($rid);
        $reply_form = new Application_Form_Reply();
        $r=$reply_form->getElement('body');
        $r->setValue($name[0]['body']);     
        
              
        if($this->getRequest()->isPost()){
            
            if($reply_form->isValid($this->getRequest()->getParams())){
                $reply_model = new Application_Model_Reply();
                $id = new Zend_Form_Element_Hidden('id');
                $id->setValue($rid);
                $reply_form->addElement($id);
                $reply_model->editReply($rid, $reply_form->getValues());
                $this->_redirect("threads/list/");
            }
        }
        
        $this->view->reply_form = $reply_form;  
    }

    public function deleteAction()
    {
    	if(Zend_Auth::getInstance()->hasIdentity()){
    		 
    		$userdata=Zend_Auth::getInstance()->getIdentity();
    		$uid=$userdata->uid;
    	
    		$this->redirect('/authentiction/login');
    	
    	}
    	else
    	{
    		$this->redirect('/authentiction/login');
    	}
    	 
    	
    	
       	$rid = $this->_request->getParam ( 'id' );
      	
        $reply_model = new Application_Model_Reply();
                
        $reply_model->deleteReply($rid);
        $this->redirect('/replies/list');
    }


}








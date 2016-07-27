<?php

class AuthentictionController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        // action body
        

    	if(Zend_Auth::getInstance()->hasIdentity()){
    		
    		//$this->redirect('/users/list');
    	}
    	
    	$form = new Application_Form_LoginForm();
    	
    	
    	
    	$request=$this->getRequest();
    	 
    	if ($request ->isPost())
    	{
    		if($form->isValid($this->_request->getPost())){
    			$authAdapter=$this->getAuthAdapter();
    			 
    			 
    			$username=$form->getValue('email');
    			$password=$form->getValue('password');
    			 
    			$authAdapter->setIdentity($username)
    			->setCredential(md5($password));
    			 
    			$auth=Zend_Auth::getInstance();
    			$result=$auth->authenticate($authAdapter);
    			 
    	
    			 
    			if($result->isValid())
    			{
    				$identity = $authAdapter->getResultRowObject();
    					
    				$uid=$identity->uid;
    				$authStorage=$auth->getStorage();
    				$authStorage->write($identity);
    				if($identity->status==0){
    					$this->view->band="): ban----------------------------";
    					Zend_Auth::getInstance()->clearIdentity();
    				}
    				else{
    				
    				
    				$this->redirect('user/profile/id/'.$uid);
    				}
    					
    			}
    			else
    			{
    				$this->view->errormsg='username or password is wrong.';
    			}
    	
    		}
    	}
    	 
    	 
    	
    	
    	$this->view->form = $form;
    	
    	
    	
    	
    	
    	
    }

    public function logoutAction()
    {
        // action body
        
    	
    	Zend_Auth::getInstance()->clearIdentity();
    	$this->redirect('threads/list-all-with-sticky');
    }


    private function getAuthAdapter(){
    	$authAdapter=new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
    	$authAdapter->setTableName('user')
    	->setIdentityColumn('email')
    	->setCredentialColumn('password');
    	return  $authAdapter;
    
    }
    
    

}






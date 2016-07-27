<?php

class Application_Form_LoginForm extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$email =new Zend_Form_Element_Text('email');
    	
    	$email->setLabel("Email:")
    			->setRequired(true);
 
    	$password =new Zend_Form_Element_Password("password");
    	$password->setLabel("Password:")
    			->setRequired(true);
    	
    	$submit=new Zend_Form_Element_Submit("Login");
    	
    	
    	$this->addElements(array($email,
    			$password,
    			$submit
    			
    	)
    			);
    	
    }


}


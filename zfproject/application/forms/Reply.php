<?php

class Application_Form_Reply extends Zend_Form
{

    public function init()
    {
      $this->setMethod('POST');
      
       $this->addElement('textarea','body', array('label'=> 'your comment:','required'=> true
  
        ));

    
       $this->addElement('submit', 'submit', array('ignore'=> true,'label'=> 'add comment'));
      

    }


}


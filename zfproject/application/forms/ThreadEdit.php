<?php

class Application_Form_ThreadEdit extends Zend_Form
{

    public function init()
    {
       $this->setMethod('post');
      
       
       
       $fid = new Zend_Form_Element_Select("fid");
       $fid->setLabel('Forum: ');
       $this->addElement($fid);
       
       
       $this->addElement('text','title', array(
       'label'=> 'Your title:','required'=> true,'filters'=> array('StringTrim'),

       ));
      
       $this->addElement('textarea','body', array('label'=> 'your thread:','required'=> true,
          ));

     

       $lock= new Zend_Form_Element_Radio('locked');
       $lock->setLabel('Status: ');
       $lock->setMultiOptions(array("lock"=>"lock","unlock"=>"unlock"));
       $this->addElement($lock);
        
       $lock= new Zend_Form_Element_Radio('type');
       $lock->setLabel('Type: ');
       $lock->setMultiOptions(array("sticky"=>"sticky","normal"=>"normal"));
       $this->addElement($lock);
        
       
       
       $this->addElement('submit', 'submit', array('ignore'=> true,'label'=> 'Sign thread',
       ));
    }


}


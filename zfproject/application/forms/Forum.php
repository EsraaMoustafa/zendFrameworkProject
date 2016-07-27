<?php

class Application_Form_Forum extends Zend_Form
{

    public function init()
    {
        $this->setMethod("POST");
        
        $catTitle = new Zend_Form_Element_Select("catid");
        $catTitle->setLabel('Catagrey: ');
        $this->addElement($catTitle);
        
        $lock= new Zend_Form_Element_Radio('locked');
        $lock->setLabel('Status: ');
        $lock->setMultiOptions(array("lock"=>"lock","unlock"=>"unlock"));
        $lock->setValue("unlock");
        $this->addElement($lock);

	$this->addElement('text','forum',array(
		'label' => 'Forum',
		'required' => true,	
		'filters' => array('StringTrim'),
		)
	);
	$this->addElement('submit','submit',array(
		'ignore' => true,
		'label' => 'Add',	
		)
	);

        
        
    }


}


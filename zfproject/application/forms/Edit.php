<?php

class Application_Form_Edit extends Zend_Form
{

    public function init()
    {
        $this->setMethod("POST");

	$this->addElement('text','category',array(
		'label' => 'Category',
		'required' => true,	
		'filters' => array('StringTrim'),
		)
	);
	$this->addElement('submit','edit',array(
		'ignore' => true,
		'label' => 'edit',	
		)
	); 
    }


}


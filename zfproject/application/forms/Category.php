<?php

class Application_Form_Category extends Zend_Form
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
	$this->addElement('submit','submit',array(
		'ignore' => true,
		'label' => 'Add',	
		)
	);
    }


}


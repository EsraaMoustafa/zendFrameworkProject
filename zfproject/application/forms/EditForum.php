<?php
class Application_Form_EditForum extends Zend_Form
{

    public function init()
    {
        $this->setMethod("POST");
        
        $catTitle = new Zend_Form_Element_Select("catid");
        $catTitle->setLabel('Catagrey: ');
        $this->addElement($catTitle);

	$this->addElement('text','forum',array(
		'label' => 'Forum',
		'required' => true,	
		'filters' => array('StringTrim'),
		)
	);
	
	
	$lock= new Zend_Form_Element_Radio('locked');
	$lock->setLabel('Status: ');
	$lock->setMultiOptions(array("lock"=>"lock","unlock"=>"unlock"));
	$this->addElement($lock);
	
	$this->addElement('submit','edit',array(
		'ignore' => true,
		'label' => 'edit',	
		)
	); 
    }


}

<?php

class Application_Model_Categories extends Zend_Db_Table_Abstract
{
	protected $_name= 'category' ;
	function listCategories(){
		return $this->fetchAll()->toArray();
	}

}


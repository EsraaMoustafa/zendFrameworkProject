<?php

class Application_Model_Forums extends Zend_Db_Table_Abstract
{
	protected $_name= 'forum' ;
	function listForums(){
		return $this->fetchAll()->toArray();
	}

}


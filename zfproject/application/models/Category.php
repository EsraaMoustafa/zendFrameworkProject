<?php

class Application_Model_Category extends Zend_Db_Table_Abstract
{
	protected $_name= 'category' ;
	
	function addCategory($cat_data,$id){
		$row = $this->createRow();
		$row->cname =$cat_data['category'];
		$row->uid=$id;
		return $row->save();
	}

	function editCategory($id, $cat_data,$uid){
            
           $data =array(
	'cname'=>$cat_data['category'],
           		'uid'=>$uid
           );
		$this->update($data, "cid=$id");
	}

	function getCategoryById($id){
            return $this->find($id)->toArray();
	}
        
        
        
        
	function deleteCategory($id){
		$this->delete("cid=$id");
	}

}


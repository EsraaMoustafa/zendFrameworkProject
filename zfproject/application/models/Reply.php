<?php

class Application_Model_Reply extends Zend_Db_Table_Abstract
{
protected $_name= 'replies' ;

function addReply($reply_date){
	
	/*
	echo "<pre>";
	print_r($reply_date);
	echo "</pre>";
	*/
		$row = $this->createRow();
		$row->body = $reply_date['body'];
		$row->tid = $reply_date['tid'];
		
		return $row->save();
	}
	function listReplies(){
		return $this->fetchAll()->toArray();
	}
	function getReplyById($id){
		return $this->find($id)->toArray();
	}
	
	
	function editReply($id, $reply_data){
            
		
                $data=array('body'=>$reply_data['body']);
                 $this->update($data, "rid = ".$id);
	}
	
	

	function deleteReply($id){
		$this->delete("rid=".$id);
	}
	
	
	function getReplyByThreadId($id){
		
		return $this->fetchAll("tid=".$id)->toArray();
	}
	
	
		function listRepliesbyuid($uid){
			return $this->fetchAll("uid=".$uid)->toArray();
			
		}

}


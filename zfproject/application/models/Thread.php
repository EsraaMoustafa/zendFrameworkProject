<?php

class Application_Model_Thread extends Zend_Db_Table_Abstract
{
protected $_name= 'thread' ;

function addThread($thread_date,$uid){
	

	
	
	
	
	
	$row = $this->createRow();
		$row->title = $thread_date['title'];
		$row->body = $thread_date['body'];
		$row->fid=$thread_date['fid'];
		$row->uid=$uid;
		$row->type=$thread_date['type'];
		$row->status=$thread_date['locked'];
		
		return $row->save();
	}
	function listThreads(){
		return $this->fetchAll()->toArray();
	}
	function getThreadById($id){
		return $this->find($id)->toArray();
	}
	
	
	function editThread($id, $thread_data,$uid){
//             echo "<pre>";
//             print_r($thread_data);
//             echo "</pre>";
// 		exit();

                $data=
                array( 'title'=> $thread_data['title'],
                		 'body'=>$thread_data['body'],
                		'status'=>$thread_data['locked'],
                		'type'=>$thread_data['type'],
                		'fid'=>$thread_data['fid'],
                		'uid'=>$uid
                		
                );
                $this->update($data, "tid = ".$id);
	}
	
	

	function deleteThread($id){
		$this->delete("tid=".$id);
	}
	
	function listThreadsbyId($uid){
		return $this->fetchAll('uid='.$uid)->toArray();
	}
function liststickyThreads (){
	return $this->fetchAll("type ="."'sticky'")->toArray();;
}
	
	
}


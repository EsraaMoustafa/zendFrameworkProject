<?php

class Application_Model_Forum extends Zend_Db_Table_Abstract
{
    	protected $_name= 'forum' ;
	
	function addForum($forum_data,$uid){

		/* echo "<pre>";
		print_r($forum_data);
		$forum_data['locked']
		echo "</pre>";
		exit(); */
		$row = $this->createRow();
		$row->title =$forum_data['forum'];
		
        $row->status=$forum_data['locked'];
		$row->cid=$forum_data['catid'];
                $row->uid=$uid;
                
		return $row->save();
	}

	function editForum($id, $forum_data,$uid){
           /* 
            
            echo "<pre>";
            print_r($forum_data);
            echo "</pre>";
            exit();
            * 
            * 
            */
           $data =array(
	'title'=>$forum_data['forum'],
     'cid'=> $forum_data['catid'],
      'status'=>$forum_data['locked'],
     'uid'=>$uid      		         
                   );
           
		$this->update($data, "fid=$id");
	}

	function getForumById($id){
            return $this->find($id)->toArray();
	}

	function deleteForum($id){
		$this->delete("fid=$id");
	}


}


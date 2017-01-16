<?php
class user_todo_tasks_model extends CI_Model {

	function user_todo_tasks_model() {
		parent::__construct();
		$this->load->database();
	}

	function getUserTodoTasks($user_id)
	{
		$this->db->select('*');
	    $this->db->from('user_todo_tasks')
		 ->where('todo_task_user_id',$user_id)
		 ->where('todo_task_deleted',0);
        $query=$this->db->get(); //echo $this->db->last_query();exit;
	   	if($query->num_rows()){
   	     	return $query->result();
	   	}
		else {
			return false;
	   }
 	}

 	function addTodoTask($data){
		$this->db->insert('user_todo_tasks', $data); 
		return $this->db->insert_id();	
	}
	
	function updateTodoTask($data){
		$this->db->where('todo_task_id',$data['todo_task_id']);
		$this->db->update('user_todo_tasks',$data);
		return $data['todo_task_id'];
	}
	
	function getUserTaskByTaskId($todo_task_id){
		$this->db->select('*');
	    $this->db->from('users')
		 ->where('user_todo_tasks',$todo_task_id)
		 ->where('todo_task_deleted',0);
        $query=$this->db->get(); //echo $this->db->last_query();exit;
	   	if($query->num_rows()){
   	     	return $query->row();
	   	}
		else {
			return false;
	   }
 	}
}
?>
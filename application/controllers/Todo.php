<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('user_todo_tasks_model'));
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		echo 'dsfdsaf';
		$this->load->view('welcome_message');
	}

	public function login()
	{
		$this->load->view('login');
	}	

	public function todoList()
	{
		$userTodoList = $this->user_todo_tasks_model->getUserTodoTasks(1);
		$data['userTodoList'] = ($userTodoList)?$userTodoList:false;
		$this->load->view('list',$data);
	}

	public function addTodoList()
	{
		$retMsg = array('result'=>'failure', 'msg'=>'Error occurred while adding todo task to the list!');
		if ($this->input->post('todo_task_name',TRUE) != '') {
			$todoData = array(
				'todo_task_user_id'	=> 1,
				'todo_task_name'	=> $this->input->post('todo_task_name',TRUE),
				'todo_task_added'	=> time()
			);
			$result = $this->user_todo_tasks_model->addTodoTask($todoData);
			if($result){
				$retMsg = array('result'=>'success', 'msg'=>'Todo Task has bee added successfully!', 'todo_task_id'=> $result);
			} else {
				$retMsg = array('result'=>'failure', 'msg'=>'Error occurred while adding todo task to the list!');
			}
		} else {
			$retMsg = array('result'=>'failure', 'msg'=>'Please add todo task name!');
		}
		echo json_encode($retMsg);exit;
	}

	public function updateTodoItem()
	{
		//echo '<pre>';print_r($_POST);exit;
		$retMsg = array('result'=>'failure', 'msg'=>'Error occurred while updating todo task item!');
		if($this->input->post('todo_task_id') != '' || $this->input->post('todo_task_id') != 0){
			$todoData = array(
				'todo_task_id'	=> $this->input->post('todo_task_id')
			);
			if($this->input->post('todo_task_completed') == 'yes'){
				$todoData['todo_task_completed'] = time();
			} else if($this->input->post('todo_task_completed') == 'no'){
				$todoData['todo_task_completed'] = 0;
			}
			if($this->input->post('todo_task_deleted') == 'yes'){
				$todoData['todo_task_deleted'] = time();
			}
			$result = $this->user_todo_tasks_model->updateTodoTask($todoData);
			if($result){
				$retMsg = array('result'=>'success', 'msg'=>'Todo Task list has been updated successfully!');
			} else {
				$retMsg = array('result'=>'failure', 'msg'=>'Error occurred while updating todo task item in list!');
			}
		} else {
			$retMsg = array('result'=>'failure', 'msg'=>'Error occurred while updating todo task item in list!');
		}
		echo json_encode($retMsg);exit;
	}
}

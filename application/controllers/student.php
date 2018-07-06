<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class student extends My_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('departmentModel');
		$this->load->model('studentModel');
	}

	public function add_student()
	{
		$data['title'] = "Add Student";
		$deptdata =$this->departmentModel->departmentList();

		$this->load->view('templates/header',$data); 
        $this->load->view('templates/sidebar'); 
		$this->load->view('student/add_student',compact('deptdata'));
		$this->load->view('templates/footer');
	}

	public function insertStudent()
	{
		$result = $this->studentModel->addStudent();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result)
		{
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	public function studentListDisplay()
	{
		$data['title'] = "Student List";
		$deptdata=$this->departmentModel->departmentList();

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar');
		$this->load->view('Student/student_list',compact('deptdata'));
		$this->load->view('templates/footer');
	}

	public function student_list()
	{
		$result = $this->studentModel->studentList();
		echo json_encode($result);
	}

	public function delete_Student()
	{
		$result = $this->studentModel->deleteStudent();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
	
	public function fetch_student()
	{
		$result = $this->studentModel->fetchStudent();
		echo json_encode($result);
	}	

	public function update_student()
	{
		$result = $this->studentModel->updateStudent();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
}
?>
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
		$config=[
			'upload_path' => 'application/Uploads/',
			'allowed_types' => 'gif|jpg|png'
		];

		$this->load->library('upload',$config);

		$this->upload->initialize($config);

		if($this->upload->do_upload('pic'))
		{
			$postdata = $this->input->post();

			$data = $this->upload->data();

			$image_path = base_url("application/Uploads/" .time().$data['raw_name'] . $data['file_ext']);
			$postdata['image_path'] = $image_path;
			if($result = $this->studentModel->addStudent($postdata))
			{
				$data['msg_code'] = 1;
		        $data['msg_data'] = 'Student added successfully.';
		        //echo "Student added successfully.";
			}
			else
			{
				$data['msg_code'] = 2;
		        $data['msg_data'] = 'Student not added. Error occured.';
		        //echo "Student not added. Error occured.";

			}
		}
		else
		{
			//$upload_error = $this->upload->display_errors();
			//$this->load->view('Admin/add_article',compact('upload_error'));
			$data['msg_code'] = 3;
			$data['msg_data'] = 'Image upload error.';
			//echo $upload_error;
		}
		header("Access-Control-Allow-Origin: *");
		header('Content-Type: application/json');

		echo json_encode($data);
		exit;


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
<?php
class department extends My_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('departmentModel');
	}

	public function department_list()
	{
		$data['title'] = "Department List";
		$departments=$this->departmentModel->departmentList();

		$this->load->view('templates/header',$data); 
        $this->load->view('templates/sidebar'); 
		$this->load->view('Department/department_list',compact('departments'));
		$this->load->view('templates/footer');
	}

/////////////*******Add Department View************///////////////////////////////////
	public function add_department()
	{
		$data['title'] = "Add Department";
		$this->load->view('templates/header',$data); 
        $this->load->view('templates/sidebar'); 
		$this->load->view('Department/add_department');
		$this->load->view('templates/footer');
	}
/////////////*******/Add Department View/************/////////////////////////////////

/////////////*******Insert Department************/////////////////////////////////////
	public function insertDepartment()
	{
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissible'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>","</div>");
		if($this->form_validation->run('department_validations'))
		{
			$postdata = $this->input->post();

			if($this->departmentModel->addNewDepartment($postdata))
			{
				$this->session->set_flashdata('msg','Department added successful.');
				$this->session->set_flashdata('msg_class','alert-success');
			}
			else
			{
				$this->session->set_flashdata('msg','Add new department failed. Please try again later.');
				$this->session->set_flashdata('msg_class','alert-danger');

			}
			redirect('department/add_department');
		}
		else
		{
			$this->load->view('templates/header'); 
            $this->load->view('templates/sidebar'); 
		    $this->load->view('Department/add_department');
		    $this->load->view('templates/footer');
		}
	}
/////////////*******/Insert Department************/////////////////////////////////////

////////////********Fetch the department to edit***////////////////////////////////////
	public function fetch_Department($id)
	{
		$dpt=$this->departmentModel->fetchDepartment($id);

        $this->load->view('templates/header'); 
        $this->load->view('templates/sidebar'); 
		$this->load->view('Department/edit_department',['dpt'=>$dpt]);
	    $this->load->view('templates/footer');
	}
////////////********/Fetch the department to edit***////////////////////////////////////

////////*****Update the fetched department on clicking submit button in edit_department***//////		
	public function update_department($id)
	{
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger alert-dismissible'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>","</div>");
		$this->load->model('departmentModel');
		if($this->form_validation->run('department_validations'))
		{
			$postdata = $this->input->post();

			//echo "<pre>".print_r($postdata)."</pre>";
			//echo $id;

			if($this->departmentModel->updateDepartment($id,$postdata))
			{
				$this->session->set_flashdata('msg','Department Updated Successful.');
				$this->session->set_flashdata('msg_class','alert-success');
			}
			else
			{
				$this->session->set_flashdata('msg','Department Not Updated.');
				$this->session->set_flashdata('msg_class','alert-danger');
			}
			redirect('department/department_list');
		}
		else
		{
		    $dpt=$this->departmentModel->fetchDepartment($id);
		   $this->load->view('Department/edit_department',['dpt'=>$dpt]);
		}
	}
////////*****/Update the fetched department on clicking submit button in edit_department***/////
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class author extends My_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('authorModel');
	}

	public function addEdit_author()
	{
		$data['title'] = "Add Author";

		$this->load->view('templates/header',$data); 
		$this->load->view('templates/sidebar'); 
		$this->load->view('author/add_edit_author');
		$this->load->view('templates/footer');
	}

	public function insertUpdateAuthor()
	{
		$authorData = $this->input->post();

		if($authorData['authorId'] != 0)
		{

		}
		else
		{
			$result = $this->authorModel->addAuthor($authorData);
			$msg['success'] = false;
			$msg['type'] = 'add';
			if($result)
			{
				$msg['success'] = true;
			}
			echo json_encode($msg);
		}
		
	}
}
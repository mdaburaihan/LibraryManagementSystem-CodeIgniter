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
		$this->load->view('Author/add_edit_author');
		$this->load->view('templates/footer');
	}

	public function insertUpdateAuthor()
	{
		$authorData = $this->input->post();

		if($authorData['authorId'] != 0)
		{
			$result = $this->authorModel->updateAuthor($authorData);
			$msg['success'] = false;
			$msg['type'] = 'update';
		}
		else
		{
			$result = $this->authorModel->addAuthor($authorData);
			$msg['success'] = false;
			$msg['type'] = 'add';
		}

		if($result)
		{
			$msg['success'] = true;
		}
		echo json_encode($msg);
		
	}

	public function authorListDisplay()
	{
		$data['title'] = "Author List";

		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar');
		$this->load->view('Author/author_list');
		$this->load->view('templates/footer');
	}

	public function author_list()
	{
		$result = $this->authorModel->authorList();
		echo json_encode($result);
	}

	public function fetch_author($id)
	{
		$data['title'] = "Edit Author";
		$athr=$this->authorModel->fetchAuthor($id);

        $this->load->view('templates/header',$data); 
        $this->load->view('templates/sidebar'); 
		$this->load->view('Author/add_edit_author',['athr'=>$athr]);
	    $this->load->view('templates/footer');
	}

	public function delete_author()
	{
		$result = $this->authorModel->deleteAuthor();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

}
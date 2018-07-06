<?php
class admin extends My_Controller
{
	public function index()
	{
		$data['title'] = "Admin Dashboard";

		$this->load->view('templates/header',$data); 
        $this->load->view('templates/sidebar'); 
		$this->load->view('Admin/dashboard.php');
		$this->load->view('templates/footer'); 
	}
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class studentModel extends CI_Model
{
	public function addStudent()
	{
		$insertdata = array(
			'sname'=>$this->input->post('studentname'),
			'department_id'=>$this->input->post('dept'),
			'roll'=>$this->input->post('roll'),
			'regno'=>$this->input->post('regno'),
			'phone'=>$this->input->post('phone'),
			'email'=>$this->input->post('email')
			//'created_at'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('students', $insertdata);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}


	public function studentList()
	{
		//$this->db->order_by('entry_date', 'desc');
		$this->db->select('*');
		$this->db->from('students');
		$this->db->join('departments', 'departments.department_id = students.department_id','left');
		$query = $this->db->get();

		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function deleteStudent(){
		$id = $this->input->get('id');
		$this->db->where('student_id', $id);
		$this->db->delete('students');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function fetchStudent(){
		$id = $this->input->get('id');
		$this->db->where('student_id', $id);
		$query = $this->db->get('students');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function updateStudent()
	{
		$id = $this->input->post('txtId');
		$updatedata = array(
		    'sname'=>$this->input->post('txtStudentName'),
			'department_id'=>$this->input->post('dept'),
			'roll'=>$this->input->post('txtRollNo'),
			'regno'=>$this->input->post('txtRegNo'),
			'phone'=>$this->input->post('txtPhone'),
			'email'=>$this->input->post('txtEmail')
		    //'updated_at'=>date('Y-m-d H:i:s')
		);
		$this->db->where('student_id', $id);
		$this->db->update('students', $updatedata);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}
?>
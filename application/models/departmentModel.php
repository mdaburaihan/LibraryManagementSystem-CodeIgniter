<?php
class departmentModel extends CI_Model
{
	public function departmentList()
	{
		$qry=$this->db->select()->from('departments')->get();

		return $qry->result();
	}

	public function addNewDepartment($data)
	{
		$insertdata = array(
			'department_name' => $data['dept']
		);

		$insertedrow=$this->db->insert('departments',$insertdata);
		return $insertedrow;
	}

	public function fetchDepartment($deptId)
	{
		$q=$this->db->select()->where('department_id',$deptId)->get('departments');
		return $q->row();
	}

	public function updateDepartment($deptId,Array $data)
	{
		$updatedata = array(
			'department_name' => $data['dept'],
		);
		return $this->db->where('department_id',$deptId)->update('departments',$updatedata);
	}
}
?>
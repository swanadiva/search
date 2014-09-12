<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_admin extends CI_Model {

	public function take_unit()
	{
		$q = $this->db->query("SELECT * FROM tbl_unit")->result_array();
		return $q;
	}

	public function take_category()
	{
		$q = $this->db->query("SELECT * FROM tbl_category")->result_array();
		return $q;
	}

	public function save_post(){
		
	}
	
	public function list_post($num,$offset){ //getAll Content
		$this->db->limit($num,$offset);
		$this->db->from('tbl_content');
		$this->db->join('tbl_unit','tbl_content.unit = tbl_unit.id','left');
		return $this->db->get()->result_array();
	}
	
	public function num(){ 
		return $this->db->get('tbl_content')->num_rows();
	}
	
	public function selectById($table,$param){
		$this->db->get_where($table,$param)->result_array();
	}
}

/* End of file mdl_admin.php */
/* Location: ./application/models/mdl_admin.php */
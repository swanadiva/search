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
}

/* End of file mdl_admin.php */
/* Location: ./application/models/mdl_admin.php */
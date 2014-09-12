<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_welcome extends CI_Model {

	public function search($num,$offset,$simpan)
	{
		$q = $this->db->query("SELECT * FROM tbl_content WHERE CONCAT(judul, content, keyword) REGEXP '$simpan' order by id desc limit $offset, $num")->result_array();
		return $q;
	}

	public function hitung($simpan)
	{		
		$query = $this->db->query("SELECT * FROM tbl_content WHERE CONCAT(judul, content, keyword) REGEXP '$simpan'")->num_rows();
		return $query;
	}
}

/* End of file mdl_admin.php */
/* Location: ./application/models/mdl_admin.php */
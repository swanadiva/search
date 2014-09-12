<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_login extends CI_Model {

	public function take_user($offset, $num)
	{
		$q = $this->db->query("SELECT * FROM aauth_users order by id desc limit $offset, $num")->result_array();
		return $q;
	}
}

/* End of file mdl_admin.php */
/* Location: ./application/models/mdl_admin.php */
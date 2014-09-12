<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('mdl_login');
    }

	public function index(){
		$this->load->view('login_page');
	}

	public function proses_login(){
		$username = trim(strip_tags($this->input->post('username')));
		$password = trim(strip_tags($this->input->post('password')));
		if ($this->aauth->login($username, $password)){
            redirect('admin/index');
		}else{
            redirect('login/index');
		}
	}

	public function list_user(){
        $data['list_user'] = $this->aauth->list_users();

        $data['user']=$this->session->userdata('user');  
		$config['base_url'] = site_url("login/list_user/");
		$config['total_rows'] = $this->db->count_all('aauth_users');
		$config['per_page'] = '10';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$offset=$this->uri->segment(3);
		if ($offset == '' || $offset == NULL) {
			$offset = 0;
		}else{
			$offset = $this->uri->segment(3);
		}
		$data['hasil'] = $this->mdl_login->take_user($offset, $config['per_page']);
		$this->pagination->initialize($config);
		$data['menu'] = 'menu';
		$data['content'] = 'list_user';
		$this->load->view('template', $data);
	}

	public function logout(){
		$this->aauth->logout();
		redirect('welcome/index');
	}

	public function add_user(){
		$data['menu'] = 'menu';
		$data['content'] = 'add_user';
		$this->load->view('template', $data);
	}

	public function save_new_user(){
		$username = trim(strip_tags($this->input->post('username')));
		$password = trim(strip_tags($this->input->post('password')));
		$nama = trim(strip_tags($this->input->post('nama')));

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() == FALSE){
			$data['menu'] = 'menu';
			$data['content'] = 'add_user';
			$this->load->view('template', $data);
		}
		else
		{
			if ($this->aauth->create_user($username, $password, $nama)) {
				$this->session->set_flashdata('hasil', 'Berhasil buat pengguna baru.');
			}else{
				$this->session->set_flashdata('hasil', 'Gagal membuat pengguna baru.');
			}

			redirect('login/add_user');
		}
	}
}

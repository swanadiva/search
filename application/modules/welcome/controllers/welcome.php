<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		$this->load->model("mdl_welcome");
		$this->load->library('pagination');
    }

	public function index(){
		$data['menu'] = 'menu_welcome';
		$data['content'] = 'welcome_content';
		$this->load->view('template', $data);
	}

	public function search(){	
		$isi = trim($this->input->post('txt_cari'));
		$this->session->set_flashdata('isi', $isi);

		$pecah = explode(" ", $isi);
		$simpan = '';
		for ($i=0; $i < sizeof($pecah); $i++) { 
			if ($i == 0) {
				$simpan = $pecah[$i];
			}else{
				$simpan = $simpan."|".$pecah[$i];
			}			
		}

		$atas = str_replace("|", "-", $simpan);
		$config['base_url'] = site_url("welcome/next/$atas");
		$config['total_rows'] = $this->mdl_welcome->hitung($simpan);
		$config['per_page'] = '3';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$offset=$this->uri->segment(4);
		if ($offset == '' || $offset == NULL) {
			$offset = 0;
		}
		$data['hasil'] = $this->mdl_welcome->search($config['per_page'],$offset, $simpan);
		$this->pagination->initialize($config);      
		$data['menu'] = 'menu';
		$data['content'] = 'welcome_content';
		$this->load->view('welcome_message', $data);
	}

	public function next(){		
		// $simpan = str_replace("-", "|", $this->uri->segment(4));
		// $atas = str_replace("|", "-", $simpan);
		// echo $simpan;die();


		$isi = trim(str_replace("-", " ", $this->uri->segment(3)));
		$this->session->set_flashdata('isi', $isi);

		$pecah = explode(" ", $isi);
		$simpan = '';
		for ($i=0; $i < sizeof($pecah); $i++) { 
			if ($i == 0) {
				$simpan = $pecah[$i];
			}else{
				$simpan = $simpan."|".$pecah[$i];
			}			
		}

		$config['base_url'] = site_url("welcome/next/".$this->uri->segment(3));
		$config['total_rows'] = $this->mdl_welcome->hitung($simpan);
		$config['per_page'] = '3';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['uri_segment'] = 4;

		$offset=$this->uri->segment(4);

		if ($offset == '' || $offset == NULL) {
			$offset = 0;
		}

		$data['hasil'] = $this->mdl_welcome->search($config['per_page'],$offset, str_replace("-", "|", $this->uri->segment(3)));
		$this->pagination->initialize($config);
		$data['menu'] = 'menu';
		$data['content'] = 'welcome_content';
		$this->load->view('welcome_message', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
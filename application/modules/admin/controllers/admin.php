<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/admin
	 *	- or -  
	 * 		http://example.com/index.php/admin/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/admin/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
			parent::__construct();
			$this->load->model("mdl_admin");
			$this->load->helper('form');
    }

	public function index(){
		$data['unit'] = $this->mdl_admin->take_unit();
		$data['category'] = $this->mdl_admin->take_category();
		$data['menu'] = 'menu';
		$data['content'] = 'add';
		$this->load->view('template', $data);
	}

	public function save_post(){
		$judul = trim(strip_tags($this->input->post('judul')));		
		$userfile = trim(strip_tags($this->input->post('userfile')));
		$content = trim(strip_tags($this->input->post('content')));
		$unit = trim(strip_tags($this->input->post('unit')));
		$category = trim(strip_tags($this->input->post('category')));
		$keyword = trim(strip_tags($this->input->post('keyword')));

		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('unit', 'Unit', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		$this->form_validation->set_rules('keyword', 'Keyword', 'required');

		if ($this->form_validation->run() == FALSE){
			$data['unit'] = $this->mdl_admin->take_unit();
			$data['category'] = $this->mdl_admin->take_category();
			$this->load->view('add', $data);
		}
		else
		{
			$now = date('Ymd');
			$cek_direktori = scandir('./uploads/');	
			if (!in_array($now, $cek_direktori)) {		
				mkdir("./uploads/".$now, 0700);
			}

			$config['upload_path'] = './uploads/'.$now;
			$config['allowed_types'] = 'pdf';
			$config['max_size']	= '0';
			$config['max_width']  = '0';
			$config['max_height']  = '0';
			$config['remove_spaces'] = TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				if ($userfile != '' || $userfile != NULL || $userfile != "") {
					$error = array('error' => $this->upload->display_errors());
					print_r($error);die();
				}else{
					$image_data = $this->upload->data();
					$_POST['nm_file'] = $image_data['file_name'];
					$nama_file = $_POST['nm_file'];

					$isi_data = array(
						"judul"		=>	$judul,
						"content"	=>	$content,
						"nama_file"	=>	$nama_file,
						"unit"		=>	$unit,
						"category"	=>	$category,
						"keyword"	=>	$keyword,
						"tgl_create"=>	date('Y-m-d H:i:s'),
						"creator"	=>	'diva'
					);

					$this->db->trans_start();
					$this->db->insert('tbl_content', $isi_data);
					$this->db->trans_complete();

					if ($this->db->trans_status() === FALSE){
					    $this->session->set_flashdata('hasil', 'Gagal save post.');
					}else{
						$this->session->set_flashdata('hasil', 'Berhasil save post.');
					}
				}
				
			}
			else
			{
				$image_data = $this->upload->data();
				$_POST['nm_file'] = $image_data['file_name'];
				$nama_file = $_POST['nm_file'];

				$isi_data = array(
					"judul"		=>	$judul,
					"content"	=>	$content,
					"nama_file"	=>	$nama_file,
					"unit"		=>	$unit,
					"category"	=>	$category,
					"keyword"	=>	$keyword,
					"tgl_create"=>	date('Y-m-d H:i:s'),
					"creator"	=>	'diva'
				);

				$this->db->trans_start();
				$this->db->insert('tbl_content', $isi_data);
				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE){
				    $this->session->set_flashdata('hasil', 'Gagal save post.');
				}else{
					$this->session->set_flashdata('hasil', 'Berhasil save post.');
				}				
			}
			redirect('admin/index');
		}
	}

	public function aauth(){
		$this->aauth->create_user('swanadiva','kita292390','Swana Diva Borneos');
	}
	
	public function list_post(){ //SHOW ALL POST
		$num = $this->mdl_admin->num();		
		$config['base_url'] = base_url().'/admin/next';
		$config['total_rows'] = $num;
		$config['per_page'] = 15; 
		$this->pagination->initialize($config); 
		$data['menu'] = 'menu';
		$data['post'] = $this->mdl_admin->list_post($config['per_page'],0);						
		$this->load->view('list',$data);		
	}
	
	public function next(){ //pagination
		$num = $this->mdl_admin->num();		
		$config['base_url'] = base_url().'/admin/next';
		$config['total_rows'] = $num;
		$config['per_page'] = 15; 
		$this->pagination->initialize($config); 
		$data['menu'] = 'menu';
		$data['post'] = $this->mdl_admin->list_post($config['per_page'],$this->uri->segment(3));						
		$this->load->view('list',$data);		
	}
	
	public function view($param){
		$id = array('id' => $param);
		$data['menu'] = 'menu';
		$data['ID'] = $this->mdl_admin->selectById('tbl_content',$id);
		print_r($data['ID']);
		//print $id;
		die();
		//$this->load->view('view',$data);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
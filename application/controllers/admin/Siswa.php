<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mymodel');
		$this->model = $this->mymodel;
		$this->model->table = 'siswa';
		if (!$this->session->userdata('isLogin')) {
			redirect('page/login');
		}
	}

	public function index(){
		$data['title']	= 'Category | PT Leoputra';
		$data['body']	= 'category/list';
		$data['query']	= $this->model->read('no_induk');

		$this->load->view('admin/content',$data);
	}

	public function add(){
		$data['title']		= 'Add Siswa';
		$data['body']		= 'category/add';

		$data['category'] 	= $this->model->read(); 

		$this->load->view('admin/content',$data);
	}

	public function store(){
		$this->load->library('form_validation');
		
		$no_induk = $this->input->post('no_induk', TRUE);
		$name = $this->input->post('name', TRUE);
		$jekel = $this->input->post('jekel', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$ttl = $this->input->post('ttl', TRUE);

	    $this->form_validation->set_rules('no_induk', 'no_induk', 'trim|required|is_unique[siswa.no_induk]');

		if ($this->form_validation->run() == FALSE){
			echo "<script>alert('Gagal menambah Siswa');history.go(-1)</script>";
		}
		else{

			$data = array(
				'no_induk'		=> $no_induk,
				'nama'			=> $name,
				'jekel' 		=> $jekel,
				'alamat'		=> $alamat,
				'ttl'			=> $ttl
			);

			$query = $this->model->create($data);
			if ($query) {
				redirect('admin/siswa');
			}else{
				echo "<script>alert('Berhasil menambahkan category');</script>";
			}

		}

	}

	public function update($id){
		if (isset($id)) {

			if (isset($_POST['submit'])) {
				$config['encrypt_name'] = true;
				$config['upload_path'] = './uploads/';
		        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
		        $config['max_size'] = 10000;

				$this->load->library('upload', $config);
				if($this->upload->do_upload('input_file')) {
					$upload = $this->upload->data();
					$file = $upload['file_name'];
				}else{
					$file = $this->input->post('old_file',true);
				}
				$name = $this->input->post('name', TRUE);
				$description = $this->input->post('description', TRUE);
				$data = array(
					'name'			=> $name,
					'description' 	=> $description,
					'banner'		=> $file
				);

				$this->model->update($id,$data);
				redirect('admin/category');

			}else{

				$data['title']		= 'Add category | PT Leoputra';
				$data['body']		= 'category/update';
				$data['row']		= $this->model->read_by_id($id);
				$this->model->table = 'category';
				$data['category'] 	= $this->model->read(); 

				$this->load->view('admin/content',$data);
			}

		}else{
			redirect('admin/category');
		}
	}

	public function delete($id){
		if (isset($id)) {
			$this->model->delete($id);
		}
		redirect('admin/siswa');
	}

}

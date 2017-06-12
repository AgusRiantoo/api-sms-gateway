<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mymodel');
		$this->model = $this->mymodel;
		$this->model->table = 'mata_pelajaran';
		if (!$this->session->userdata('isLogin')) {
			redirect('page/login');
		}
	}

	public function index(){
		$data['title']	= 'mapel | PT Leoputra';
		$data['body']	= 'mapel/list';
		$data['query']	= $this->model->read('kode');

		$this->load->view('admin/content',$data);
	}

	public function add(){
		$data['title']		= 'Add Siswa';
		$data['body']		= 'mapel/add';

		$data['mapel'] 	= $this->model->read(); 

		$this->load->view('admin/content',$data);
	}

	public function store(){
		$this->load->library('form_validation');
		
		$no_induk = $this->input->post('kode', TRUE);
		$name = $this->input->post('mapel', TRUE);
		$jekel = $this->input->post('kelas', TRUE);
		$alamat = $this->input->post('semester', TRUE);

	    $this->form_validation->set_rules('kode', 'kode', 'trim|required|is_unique[mata_pelajaran.kode]');

		if ($this->form_validation->run() == FALSE){
			echo "<script>alert('Gagal menambah Siswa');history.go(-1)</script>";
		}
		else{

			$data = array(
				'kode'		=> $no_induk,
				'nama'			=> $name,
				'kelas' 		=> $jekel,
				'semester'		=> $alamat
			);

			$query = $this->model->create($data);
			if ($query) {
				redirect('admin/siswa');
			}else{
				echo "<script>alert('Berhasil menambahkan mapel');</script>";
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
				redirect('admin/mapel');

			}else{

				$data['title']		= 'Add mapel | PT Leoputra';
				$data['body']		= 'mapel/update';
				$data['row']		= $this->model->read_by_id($id);
				$this->model->table = 'mapel';
				$data['mapel'] 	= $this->model->read(); 

				$this->load->view('admin/content',$data);
			}

		}else{
			redirect('admin/mapel');
		}
	}

	public function delete($id){
		if (isset($id)) {
			$this->model->delete($id);
		}
		redirect('admin/mapel');
	}

}

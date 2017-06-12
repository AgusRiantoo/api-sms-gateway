<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mymodel');
		$this->model = $this->mymodel;
		$this->model->table = 'slider';
		if (!$this->session->userdata('isLogin')) {
			redirect('page/login');
		}
	}

	public function index(){
		$data['title']	= 'Slider | PT Leoputra';
		$data['body']	= 'slider/list';
		$data['query']	= $this->model->read();

		$this->load->view('admin/content',$data);
	}

	public function add(){
		$data['title']		= 'Add Slider | PT Leoputra';
		$data['body']		= 'slider/add';
		$this->load->view('admin/content',$data);
	}

	public function store(){
		$this->load->library('form_validation');
		
		$description = $this->input->post('description', TRUE);
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == FALSE){
			echo "<script>alert('Gagal memposting data');history.go(-1)</script>";
		}
		else{

			$config['encrypt_name'] = true;
			$config['upload_path'] = './uploads/';
	        $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
	        $config['max_size'] = 5000;

			$this->load->library('upload', $config);

			if($this->upload->do_upload('input_file')) {
				$upload = $this->upload->data();
				$file = $upload['file_name'];
	
				$data = array(
					'description' 	=> $description,
					'picture'		=> $file
				);

				$query = $this->model->create($data);
				if ($query) {
					redirect('admin/slider');
				}
			}else{
				echo "<script>alert('Format atau ukuran file tidak didukung.!');</script>";
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
				$description = $this->input->post('description', TRUE);

				$data = array(
					'description' 	=> $description,
					'picture'		=> $file,
				);

				$this->model->update($id,$data);
				redirect('admin/slider');

			}else{

				$data['title']		= 'Add slider | PT Leoputra';
				$data['body']		= 'slider/update';
				$data['row']		= $this->model->read_by_id($id);
				$this->load->view('admin/content',$data);
			}

		}else{
			redirect('admin/slider');
		}
	}

	public function delete($id){
		if (isset($id)) {
			$this->model->delete($id);
		}
		redirect('admin/slider');
	}

}

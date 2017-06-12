<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mymodel');
		$this->model = $this->mymodel;
		$this->model->table = 'news';
		if (!$this->session->userdata('isLogin')) {
			redirect('page/login');
		}
	}

	public function index(){
		$data['title']	= 'News | PT Leoputra';
		$data['body']	= 'news/list';

		$this->load->library('pagination');

		$config['base_url'] = base_url('admin/news/index/');
		$total_rows = $this->model->read2()->num_rows();
		$config['total_rows'] = $total_rows;
		$config['per_page'] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = 2;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		if($this->uri->segment(4)){
			$page = ($this->uri->segment(4)) * $config['per_page'] - $config['per_page'] ;
		}
		else{
			$page = 0	;
		}
		
		$data['query']	= $this->model->read2($config['per_page'],$page);
		$this->load->view('admin/content',$data);
	}

	public function add(){
		$data['title']		= 'Add news | PT Leoputra';
		$data['body']		= 'news/add';

		$this->model->table = 'category';
		$data['category'] 	= $this->model->read(); 

		$this->load->view('admin/content',$data);
	}

	public function store(){
		$this->load->library('form_validation');
		
		$title = $this->input->post('title', TRUE);
		$description = $this->input->post('description', TRUE);

		$this->form_validation->set_rules('title', 'Title', 'required');
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
			}else{
				$file = 'default.jpg';
			}

			$data = array(
				'title'			=> $title,
				'description' 	=> $description,
				'picture'		=> $file
			);

			$query = $this->model->create($data);
			if ($query) {
				redirect('admin/news');
			}else{
				echo "<script>alert('Berhasil menambahkan postingan');</script>";
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
				$title = $this->input->post('title', TRUE);
				$description = $this->input->post('description', TRUE);
				$date = date('Y/m/d h:i:s', time());

				$data = array(
					'title'			=> $title,
					'description' 	=> $description,
					'picture'		=> $file,
					'update_at'		=> $date
				);

				$this->model->update($id,$data);
				redirect('admin/news');

			}else{

				$data['title']		= 'Add news | PT Leoputra';
				$data['body']		= 'news/update';
				$data['row']		= $this->model->read_by_id($id);
				$this->model->table = 'category';
				$data['category'] 	= $this->model->read(); 

				$this->load->view('admin/content',$data);
			}

		}else{
			redirect('admin/news');
		}
	}

	public function delete($id){
		if (isset($id)) {
			$this->model->delete($id);
		}
		redirect('admin/news');
	}

}

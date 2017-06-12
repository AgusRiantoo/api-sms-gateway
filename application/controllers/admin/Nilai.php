<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mymodel');
		$this->model = $this->mymodel;
		$this->model->table = 'nilai';
		if (!$this->session->userdata('isLogin')) {
			redirect('page/login');
		}
	}

	public function index(){
		$data['title']	= 'nilai | PT Leoputra';
		$data['body']	= 'nilai/list';
		
		$this->load->library('pagination');

		$config['base_url'] = base_url('admin/nilai/index/');
		$total_rows = $this->model->read()->num_rows();
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
		$data['title']		= 'Add nilai | PT Leoputra';
		$data['body']		= 'nilai/add';

		$this->model->table = 'siswa';
		$data['category'] 	= $this->model->read(); 

		$this->model->table = 'mata_pelajaran';
		$data['category2'] 	= $this->model->read(); 


		$this->load->view('admin/content',$data);
	}

	public function store(){
		$this->load->library('form_validation');
		
		$name = $this->input->post('no', TRUE);
		$description = $this->input->post('kdmp', TRUE);
		$category = $this->input->post('nilai', TRUE);

		$this->form_validation->set_rules('no', 'no', 'required');

		if ($this->form_validation->run() == FALSE){
			echo "<script>alert('Gagal memposting data');history.go(-1)</script>";
		}
		else{
			$data = array(
				'no_induk'	=> $name,
				'kdmp' 	=> $description,
				'nilai'	=> $category
			);

			$query = $this->model->create($data);
			if ($query) {
				redirect('admin/nilai');
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
				$name = $this->input->post('name', TRUE);
				$description = $this->input->post('description', TRUE);
				$category = $this->input->post('category', TRUE);
				$date = date('Y/m/d h:i:s', time());

				$data = array(
					'name'			=> $name,
					'description' 	=> $description,
					'category_id'	=> $category,
					'picture'		=> $file,
					'update_at'		=> $date
				);

				$this->model->update($id,$data);
				redirect('admin/nilai');

			}else{

				$data['title']		= 'Add nilai | PT Leoputra';
				$data['body']		= 'nilai/update';
				$data['row']		= $this->model->read_by_id($id);
				$this->model->table = 'category';
				$data['category'] 	= $this->model->read(); 

				$this->load->view('admin/content',$data);
			}

		}else{
			redirect('admin/nilai');
		}
	}

	public function delete($id){
		if (isset($id)) {
			$this->model->delete($id);
		}
		redirect('admin/nilai');
	}

}

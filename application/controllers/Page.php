<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mymodel');
		$this->model = $this->mymodel;
	}

	public function index(){
		// echo hash ( "sha256", "admin");
		redirect('page/login');
	}

	public function login()
	{
		$data['msg'] = '';
		if (isset($_POST['submit'])) {
			$u = $this->input->post('username', TRUE);
			$p = $this->input->post('password', TRUE);
			$enc = hash ( "sha256", $p);

			if ($this->model->cek($u,$enc)) {
				redirect('admin');
			}else{
				$data['msg'] = 'Username or password is wrong! <br>';
			}
		}
		$this->load->view('login',$data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect();
	}
	
}

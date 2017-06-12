<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mymodel');
		$this->model = $this->mymodel;
		if (!$this->session->userdata('isLogin')) {
			redirect('page/login');
		}
	}

	public function index(){
			$data['title'] = 'Dasboard | PT Leoputra';
			$data['body'] = 'admin/dashboard';
			$this->load->view('admin/content',$data);
	}

}

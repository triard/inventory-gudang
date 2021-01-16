<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('ModItems');
		$this->load->model('ModUser');
		$this->load->model('ModItems');
		$this->load->model('ModSuppliers');
		$this->load->model('ModInputItems');
		$this->load->model('ModOutputItems');
	} 
	
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		$data['limit'] = $this->ModItems->getNotifStokLimit();
		$data['user'] = $this->ModUser->getCountUser();
		$data['supplier'] = $this->ModSuppliers->getCountSupplier();
		$data['barang'] = $this->ModItems->getCountBarang();
		$data['mostInput'] = $this->ModInputItems->GetMostInput();
		$data['mostOutput'] = $this->ModOutputItems->GetMostOutput();
		// $data['inputFilter'] = $this->ModInputItems->InputFilter();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('home', $data);
		$this->load->view('template/footer');
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}

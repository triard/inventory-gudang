<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('ModItems');
		$this->load->model('ModUser');
		$this->load->model('ModItems');
		$this->load->model('ModSuppliers');
		$this->load->model('ModSuppliersBaku');
		$this->load->model('ModBaku');
		$this->load->model('ModInputItems');
		$this->load->model('ModInputBaku');
		$this->load->model('ModOutputItems');
		$this->load->model('ModOutputBaku'); 
	} 
	
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		$data['limitKemas'] = $this->ModItems->getNotifStokLimit();
		$data['limitBaku'] = $this->ModBaku->getNotifStokLimit();
		$data['expiredBaku'] = $this->ModInputBaku->getNotifStokExpired();
		$data['user'] = $this->ModUser->getCountUser();
		$data['supplier'] = $this->ModSuppliers->getCountSupplier();
		$data['supplierBaku'] = $this->ModSuppliersBaku->getCountSupplier();
		$data['kemas'] = $this->ModItems->getCountBarang();
		$data['baku'] = $this->ModBaku->getCountBaku();
		$data['mostInput'] = $this->ModInputItems->GetMostInput();
		$data['mostInputBaku'] = $this->ModInputBaku->GetMostInput();
		$data['mostOutput'] = $this->ModOutputItems->GetMostOutput();
		$data['mostOutputBaku'] = $this->ModOutputBaku->GetMostOutput();
		$data['inputFilter'] = $this->ModInputItems->InputFilter();
		$data['inputFilterBaku'] = $this->ModInputBaku->InputFilter();
		$data['outputFilter'] = $this->ModOutputItems->OutputFilter();
		$data['outputFilterBaku'] = $this->ModOutputBaku->OutputFilter();
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

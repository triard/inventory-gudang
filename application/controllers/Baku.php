<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baku extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModUser');
		$this->load->model('ModBaku');
		$this->load->model('ModTransaksiBaku');
		$this->load->model('ModInputBaku');
		$this->load->model('ModOutputBaku');
		$this->load->model('ModSuppliersBaku');
	}
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		
		$menu['login'] = $this->ModUser->edit($this->session->userdata('id_user'));
		$data['baku'] = $this->ModBaku->selectAll();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('baku',$data);
		$this->load->view('template/footer');
	}
	public function detail($id)
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		
		$menu['login'] = $this->ModUser->edit($this->session->userdata('id_user'));
		$data['transaksi'] = $this->ModTransaksiBaku->selectAllById($id); 
		$data['data'] = $this->ModBaku->getAllById($id);
		$data['id'] = $this->ModTransaksiBaku->selectId($id); 
		$data['filter'] = $this->ModTransaksiBaku->filter($id);
		// $data['tanggal'] = $this->ModOutputBaku->getTanggal();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('detailbaku',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$this->load->view('modal/baku', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModBaku->addNoStok();
		echo json_encode(array("status" => TRUE));
	}
	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['baku'] = $this->ModBaku->edit($id);
		$this->load->view('modal/baku', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModBaku->delete($id);
		$this->ModInputBaku->deleteByBaku($id);
		$this->ModOutputBaku->deleteByBaku($id);
		$this->ModTransaksiBaku->deleteByBaku($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		// $this->ModBaku->update();
		$this->ModBaku->updateStokLimit();
		$this->ModInputBaku->updateBaku();
		$this->ModOutputBaku->updateBaku();
		echo json_encode(array("status" => TRUE));
	} 
	public function updateStok() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModBaku->updateStok();
		echo json_encode(array("status" => TRUE));
	}
	// public function updateLimitStok() {
	// 	$q = $this->session->userdata('status');
	// 	if($q != "login") {
	// 		exit();
	// 	}
	// 	$this->ModBaku->updateStokLimit();
	// 	echo json_encode(array("status" => TRUE));
	// }
}

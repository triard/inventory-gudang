<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModUser');
		$this->load->model('ModItems');
		$this->load->model('ModSuppliers');
	}
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		
		$menu['login'] = $this->ModUser->edit($this->session->userdata('id_user'));
		$data['items'] = $this->ModItems->selectAll();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('item',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$this->load->view('modal/items', $data);
	}
	public function restock() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 2;
		$this->load->view('modal/items', $data);
	}
	public function limitstock() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}

		$data['item'] = $this->ModItems->edit();
		$this->load->view('modal/items', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModItems->add();
		echo json_encode(array("status" => TRUE));
	}
	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['items'] = $this->ModItems->edit($id);
		$this->load->view('modal/items', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModItems->delete($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		// $this->ModItems->update();
		$this->ModItems->updateStokLimit();
		echo json_encode(array("status" => TRUE));
	} 
	public function updateStok() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModItems->updateStok();
		echo json_encode(array("status" => TRUE));
	}
	public function updateLimitStok() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModItems->updateStokLimit();
		echo json_encode(array("status" => TRUE));
	}
}

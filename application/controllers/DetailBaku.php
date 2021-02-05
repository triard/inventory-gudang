<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailBaku extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModUser');
		$this->load->model('ModBaku');
		$this->load->model('ModOutputBaku');
		$this->load->model('ModTransaksiBaku');
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
		$this->ModBaku->add();
		echo json_encode(array("status" => TRUE));
	}
	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['transaksi_baku'] = $this->ModTransaksiBaku->edit($id);
		$this->load->view('modal/detailbaku', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModBaku->delete($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		// $this->ModBaku->update();
		$this->ModTransaksiBaku->update();
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
}

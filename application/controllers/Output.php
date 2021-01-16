<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Output extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModOutputItems');
		$this->load->model('ModItems');
		$this->load->model('ModSuppliers');
	}
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		$data['output'] = $this->ModOutputItems->selectAll();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('output-items',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$data['item'] = $this->ModOutputItems->listItems();
		$data['supplier'] = $this->ModOutputItems->listSupplier();
		$this->load->view('modal/output', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$qty = $this->input->post('qty_output');
		$id_item = $this->input->post('id_item');
		$stok = $this->ModItems->getStok($id_item);

		if ($qty > $stok) {
			$this->session->set_flashdata('stok', 'Stok tidak mencukupi!');
		} else {
			$this->ModOutputItems->add();
			$total = $stok - $qty;
			$this->ModItems->updateStok($total);
			echo json_encode(array("status" => TRUE));
		}
	}

	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['item'] = $this->ModOutputItems->listItems();
		$data['supplier'] = $this->ModOutputItems->listSupplier();
		$data['outputEdit'] = $this->ModOutputItems->edit($id);
		$this->load->view('modal/output', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$qtyLama = $this->ModOutputItems->getStok($id);
		$stok = $this->ModOutputItems->getStokByOutput($id);
		$total = $stok + $qtyLama;
		$id_item = $this->ModOutputItems->getIdItem($id);
		$this->ModItems->updateStokWithId($total, $id_item);
		// $this->session->set_flashdata('stok', $id_item);
		$this->ModOutputItems->delete($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if ($q != "login") {
			exit();
		}
		$id_item = $this->input->post('id_item');
		$id_output = $this->input->post('id_output');
		$qtyBaru = $this->input->post('qty_output');
		$qtyLama = $this->ModOutputItems->getStok($id_output);
		$stok = $this->ModItems->getStok($id_item);

		$total = $stok + ($qtyLama-$qtyBaru);

		if ($total < 0) {
			$this->session->set_flashdata('stok', 'Stok tidak mencukupi!');
		} else {
			$this->ModOutputItems->update();
			$this->ModItems->updateStok($total);
		}
		echo json_encode(array("status" => TRUE));
	}
	public function set_item($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['items'] = $this->ModItems->edit($id);
		$this->load->view('modal/set-itemOutput', $data);
	}
}

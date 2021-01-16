<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModInputItems');
		$this->load->model('ModItems');
		$this->load->model('ModSuppliers');
	}
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		
		$data['input'] = $this->ModInputItems->selectAll();
		// $data['stok'] = $this->ModItems->getStok();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('input',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$data['item'] = $this->ModInputItems->listItems();
		$data['supplier'] = $this->ModInputItems->listSupplier();
		$this->load->view('modal/input', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$id_item = $this->input->post('id_item');
		$id_supplier = $this->input->post('id_supplier');
		$qty = $this->input->post('qty_input');
		if ($id_item=="0" && $id_supplier=="0") {
			$cek1 = $this->ModItems->cekItem();
			$cek2 = $this->ModSuppliers->cekSupplier();
			if ($cek1 == "TRUE" && $cek2 == "TRUE") {
				$this->ModItems->add();
				$this->ModSuppliers->add();

				$id1 = $this->ModItems->getId();
				$id2 = $this->ModSuppliers->getId();

				$this->ModInputItems->addTT($id1, $id2);
				echo json_encode(array("status" => TRUE));
			} else {
				$this->session->set_flashdata('cek', 'Barang & Supplier sudah terdaftar!');
			}
		}
		else if ($id_item=="0" && $id_supplier!="0") {
			$cek1 = $this->ModItems->cekItem();
			if ($cek1 == "TRUE") {
				$this->ModItems->add();
				echo json_encode(array("status" => TRUE));

				$id1 = $this->ModItems->getId();

				$this->ModInputItems->addTitem($id1);
				echo json_encode(array("status" => TRUE));
			} else {
				$this->session->set_flashdata('cek', 'Barang sudah terdaftar!');
			}
		}
		else if ($id_item!="0" && $id_supplier=="0") {
			$cek2 = $this->ModSuppliers->cekSupplier();
			if ($cek2 == "TRUE") {
				$this->ModSuppliers->add();
				echo json_encode(array("status" => TRUE));

				$id2 = $this->ModSuppliers->getId();

				$this->ModInputItems->addTsupplier($id2);
				echo json_encode(array("status" => TRUE));

				$stok = $this->ModItems->getStok($id_item);
				$total = $stok + $qty;
				$this->ModItems->updateStok($total);
				echo json_encode(array("status" => TRUE));
			} else {
				$this->session->set_flashdata('cek', 'Supplier sudah terdaftar!');
			}
		}
		else if ($id_item!="0" && $id_supplier!="0") {
			$this->ModInputItems->add();

			$stok = $this->ModItems->getStok($id_item);
			$total = $stok + $qty;
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
		$data['item'] = $this->ModInputItems->listItems();
		$data['supplier'] = $this->ModInputItems->listSupplier();
		$data['inputEdit'] = $this->ModInputItems->edit($id);
		$this->load->view('modal/input', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModInputItems->delete($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModInputItems->update();
		echo json_encode(array("status" => TRUE));
	}
	public function set_supplier($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['supplier'] = $this->ModSuppliers->edit($id);
		$this->load->view('modal/set-supplier', $data);
	}
	public function set_item($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['items'] = $this->ModItems->edit($id);
		$this->load->view('modal/set-item', $data);
	}


}

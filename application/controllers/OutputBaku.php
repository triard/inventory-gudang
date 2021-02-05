<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OutputBaku extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModOutputBaku');
		$this->load->model('ModInputBaku');
		$this->load->model('ModBaku');
		$this->load->model('ModTransaksiBaku');
		$this->load->model('ModSuppliersBaku');
	}
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		$data['output'] = $this->ModOutputBaku->selectAll();
		$data['filter'] = $this->ModOutputBaku->filter();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('output-baku',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$data['baku'] = $this->ModOutputBaku->listBaku();
		$data['supplier'] = $this->ModOutputBaku->listSupplier();
		$this->load->view('modal/outputBaku', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$qty = $this->input->post('qty_output');
		$kb_output = $this->input->post('kb_output');
		$id_baku = $this->input->post('id_baku');
		$stok = $this->ModBaku->getStok($id_baku);
		$kb = $this->ModBaku->getKb($id_baku);
		$tanggal = $this->input->post('tgl_output');

		if ($qty > $stok || $kb_output > $kb) {
			$this->session->set_flashdata('stok', 'Stok / Koli tidak mencukupi!');
		} else {
			$total = $stok - $qty;
			$totalKb = $kb - $kb_output;
			$this->ModBaku->updateStok($total);
			$this->ModBaku->updateKb($totalKb);
			$this->ModOutputBaku->add($total);

			// transaksi baku
			$cekTanggal = $this->ModTransaksiBaku->cekTanggal($id_baku, $tanggal);
			if ($cekTanggal == 1) {
				$stokTi = $this->ModTransaksiBaku->getStokKeluar($id_baku, $tanggal);
				$kbTi = $this->ModTransaksiBaku->getKbKeluar($id_baku, $tanggal);
				$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggal);
				$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggal);
				$totalStokTi = $stokTi + $qty;
				$totalKbTi = $kbTi + $kb_output;
				$this->ModTransaksiBaku->updateStokKeluar($totalStokTi, $id_baku, $tanggal);
				$this->ModTransaksiBaku->updateKbKeluar($totalKbTi, $id_baku, $tanggal);
				$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);
			} else {
				$this->ModTransaksiBaku->addTanggalOutput($id_baku);
				$stokTi = $this->ModTransaksiBaku->getStokKeluar($id_baku, $tanggal);
				$kbTi = $this->ModTransaksiBaku->getKbKeluar($id_baku, $tanggal);
				$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggal);
				$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggal);
				$totalStokTi = $stokTi + $qty;
				$totalKbTi = $kbTi + $kb_output;
				$this->ModTransaksiBaku->updateStokKeluar($totalStokTi, $id_baku, $tanggal);
				$this->ModTransaksiBaku->updateKbKeluar($totalKbTi, $id_baku, $tanggal);
				$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);   
			}

			echo json_encode(array("status" => TRUE));
		}
	}

	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['baku'] = $this->ModOutputBaku->listBaku();
		$data['supplier'] = $this->ModOutputBaku->listSupplier();
		$data['outputEdit'] = $this->ModOutputBaku->edit($id);
		$this->load->view('modal/outputBaku', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$id_baku = $this->ModOutputBaku->getIdbaku($id);

		$tanggal = $this->ModOutputBaku->getTanggal($id);

		$qtyLama = $this->ModOutputBaku->getStok($id);
		$stok = $this->ModOutputBaku->getStokByOutput($id);
		$total = $stok + $qtyLama;

		$kbLama = $this->ModOutputBaku->getKb($id);
		$kb = $this->ModOutputBaku->getKbByOutput($id);
		$totalKb = $kb + $kbLama;

		$this->ModBaku->updateStokWithId($total, $id_baku);
		$this->ModBaku->updateKbWithId($totalKb, $id_baku);

		$stokTi = $this->ModTransaksiBaku->getStokKeluar($id_baku, $tanggal);
		$kbTi = $this->ModTransaksiBaku->getKbKeluar($id_baku, $tanggal);
		$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggal);
		$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggal);
		$totalStokTi = $stokTi - $qtyLama;
		$totalKbTi = $kbTi - $kbLama;
		$this->ModTransaksiBaku->updateStokKeluar($totalStokTi, $id_baku, $tanggal);
		$this->ModTransaksiBaku->updateKbKeluar($totalKbTi, $id_baku, $tanggal);

		$this->ModOutputBaku->delete($id);
		$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);

		// cek hapus tanggal
		$this->ModTransaksiBaku->cekHapusTanggal($id_baku);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if ($q != "login") {
			exit();
		}
		$id_baku = $this->input->post('id_baku');
		$id_output = $this->input->post('id_output');

		$tanggalBaru = $this->input->post('tgl_output');
		$tanggalLama = $this->ModOutputBaku->getTanggal($id_output);

		$qtyBaru = $this->input->post('qty_output');
		$qtyLama = $this->ModOutputBaku->getStok($id_output);
		$stok = $this->ModBaku->getStok($id_baku);

		$kbBaru = $this->input->post('kb_output');
		$kbLama = $this->ModOutputBaku->getKb($id_output);
		$kb = $this->ModBaku->getKb($id_baku);

		$total = $stok + ($qtyLama-$qtyBaru);
		$totalKb = $kb + ($kbLama-$kbBaru);

		if ($total < 0 || $totalKb < 0) {
			$this->session->set_flashdata('stok', 'Stok / Koli tidak mencukupi!');
		} else {
			$this->ModOutputBaku->update();
			$this->ModOutputBaku->update_H_Stok($total);
			$this->ModBaku->updateStok($total);
			$this->ModBaku->updateKb($totalKb);

			if ($tanggalLama == $tanggalBaru) {
				$stokTi = $this->ModTransaksiBaku->getStokKeluar($id_baku, $tanggalBaru);
				$kbTi = $this->ModTransaksiBaku->getKbKeluar($id_baku, $tanggalBaru);
				$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggalBaru);
				$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggalBaru);
				$totalStokTi = $stokTi - ($qtyLama-$qtyBaru);
				$totalKbTi = $kbTi - ($kbLama-$kbBaru);
				$this->ModTransaksiBaku->updateStokKeluar($totalStokTi, $id_baku, $tanggalBaru);
				$this->ModTransaksiBaku->updateKbKeluar($totalKbTi, $id_baku, $tanggalBaru);
				$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);
			} else {
				$cekTanggal = $this->ModTransaksiBaku->cekTanggal($id_baku, $tanggalBaru);
				if ($cekTanggal == 1) {
					$stokTi1 = $this->ModTransaksiBaku->getStokKeluar($id_baku, $tanggalLama);
					$kbTi1 = $this->ModTransaksiBaku->getKbKeluar($id_baku, $tanggalLama);
					$sisa_stokTi1 = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggalLama);
					$sisa_kbTi1 = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggalLama);
					$totalStokTi1 = $stokTi1 - $qtyLama;
					$totalKbTi1 = $kbTi1 - $kbLama;
					$this->ModTransaksiBaku->updateStokKeluar($totalStokTi, $id_baku, $tanggalLama);
					$this->ModTransaksiBaku->updateKbKeluar($totalKbTi, $id_baku, $tanggalLama);
					$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);

					$stokTi = $this->ModTransaksiBaku->getStokKeluar($id_baku, $tanggalBaru);
					$kbTi = $this->ModTransaksiBaku->getKbKeluar($id_baku, $tanggalBaru);
					$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggalBaru);
					$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggalBaru);
					$totalStokTi = $stokTi + $qtyBaru;
					$totalKbTi = $kbTi + $kbBaru;
					$this->ModTransaksiBaku->updateStokKeluar($totalStokTi, $id_baku, $tanggalBaru);
					$this->ModTransaksiBaku->updateKbKeluar($totalKbTi, $id_baku, $tanggalBaru);
					$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);

					// cek hapus tanggal
					$this->ModTransaksiBaku->cekHapusTanggal($id_baku);
					echo json_encode(array("status" => TRUE));  
				} else {
					$this->ModTransaksiBaku->addTanggalOutput($id_baku);
					$stokTi1 = $this->ModTransaksiBaku->getStokKeluar($id_baku, $tanggalLama);
					$kbTi1 = $this->ModTransaksiBaku->getKbKeluar($id_baku, $tanggalLama);
					$sisa_stokTi1 = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggalLama);
					$sisa_kbTi1 = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggalLama);
					$totalStokTi1 = $stokTi1 - $qtyLama;
					$totalKbTi1 = $kbTi1 - $kbLama;
					$this->ModTransaksiBaku->updateStokKeluar($totalStokTi, $id_baku, $tanggalLama);
					$this->ModTransaksiBaku->updateKbKeluar($totalKbTi, $id_baku, $tanggalLama);

					$stokTi = $this->ModTransaksiBaku->getStokKeluar($id_baku, $tanggalBaru);
					$kbTi = $this->ModTransaksiBaku->getKbKeluar($id_baku, $tanggalBaru);
					$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggalBaru);
					$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggalBaru);
					$totalStokTi = $stokTi + $qtyBaru;
					$totalKbTi = $kbTi + $kbBaru;
					$this->ModTransaksiBaku->updateStokKeluar($totalStokTi, $id_baku, $tanggalBaru);
					$this->ModTransaksiBaku->updateKbKeluar($totalKbTi, $id_baku, $tanggalBaru);
					$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);
					
					// cek hapus tanggal
					$this->ModTransaksiBaku->cekHapusTanggal($id_baku);
					echo json_encode(array("status" => TRUE));
				}
			}
		}
		echo json_encode(array("status" => TRUE));
	}
	public function set_baku($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['baku'] = $this->ModBaku->edit($id);
		$this->load->view('modal/set-bakuOutput', $data);
	}
}

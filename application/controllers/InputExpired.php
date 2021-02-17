<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InputExpired extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModInputBaku');
		$this->load->model('ModOutputBaku');
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

		$data['input'] = $this->ModInputBaku->listExpired();
		$data['filter'] = $this->ModInputBaku->filterExpired();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('inputExpired',$data);
		$this->load->view('template/footer');
	}
	public function v_index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		$this->session->unset_userdata('startSession');
		$this->session->unset_userdata('endSession');
		$data['input'] = $this->ModInputBaku->listExpired();
		$data['filter'] = $this->ModInputBaku->filterExpired();
		$this->load->view('template/header');
		$this->load->view('template/menu');
		$this->load->view('inputExpired',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$data['baku'] = $this->ModInputBaku->listBaku();
		$data['supplier'] = $this->ModInputBaku->listSupplier();
		$this->load->view('modal/inputBaku', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$id_baku = $this->input->post('id_baku');
		$id_supplier = $this->input->post('id_supplier');
		$qty = $this->input->post('qty_input');
		$kb_input = $this->input->post('kb_input');
		$tanggal = $this->input->post('tgl_input');
		if ($id_baku=="0" && $id_supplier=="0") {
			$cek1 = $this->ModBaku->cekbaku();
			$cek2 = $this->ModSuppliersBaku->cekSupplier();
			if ($cek1 == "TRUE" && $cek2 == "TRUE") {
				$this->ModBaku->add();
				$this->ModSuppliersBaku->add();

				$id1 = $this->ModBaku->getId();
				$id2 = $this->ModSuppliersBaku->getId();

				$this->ModInputBaku->addTT($id1, $id2);
				echo json_encode(array("status" => TRUE));

				// transaksi baku
				$cekTanggal = $this->ModTransaksiBaku->cekTanggal($id1, $tanggal);
				if ($cekTanggal == 1) {
					$stokTi = $this->ModTransaksiBaku->getStokMasuk($id1, $tanggal);
					$kbTi = $this->ModTransaksiBaku->getKbMasuk($id1, $tanggal);
					$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id1, $tanggal);
					$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id1, $tanggal);
					$totalStokTi = $stokTi + $qty;
					$totalKbTi = $kbTi + $kb_input;
					$totalSisaStokTi = $sisa_stokTi + $qty;
					$totalSisaKbTi = $sisa_kbTi + $kb_input;
					$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id1, $tanggal);
					$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id1, $tanggal);
					$this->ModTransaksiBaku->getSisaAllStokKb($id1); 
				} else {
					$this->ModTransaksiBaku->addTanggalInput($id1);
					$stokTi = $this->ModTransaksiBaku->getStokMasuk($id1, $tanggal);
					$kbTi = $this->ModTransaksiBaku->getKbMasuk($id1, $tanggal);
					$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id1, $tanggal);
					$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id1, $tanggal);
					$totalStokTi = $stokTi + $qty;
					$totalKbTi = $kbTi + $kb_input;
					$totalSisaStokTi = $sisa_stokTi + $qty;
					$totalSisaKbTi = $sisa_kbTi + $kb_input;
					$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id1, $tanggal);
					$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id1, $tanggal);
					$this->ModTransaksiBaku->getSisaAllStokKb($id1); 
				}
				echo json_encode(array("status" => TRUE));
			} else {
				$this->session->set_flashdata('cek', 'Barang & Supplier sudah terdaftar!');
			}
		}
		else if ($id_baku=="0" && $id_supplier!="0") {
			$cek1 = $this->ModBaku->cekbaku();
			if ($cek1 == "TRUE") {
				$this->ModBaku->add();
				echo json_encode(array("status" => TRUE));

				$id1 = $this->ModBaku->getId();

				$this->ModInputBaku->addTbaku($id1);

				// transaksi baku
				$cekTanggal = $this->ModTransaksiBaku->cekTanggal($id1, $tanggal);
				if ($cekTanggal == 1) {
					$stokTi = $this->ModTransaksiBaku->getStokMasuk($id1, $tanggal);
					$kbTi = $this->ModTransaksiBaku->getKbMasuk($id1, $tanggal);
					$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id1, $tanggal);
					$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id1, $tanggal);
					$totalStokTi = $stokTi + $qty;
					$totalKbTi = $kbTi + $kb_input;
					$totalSisaStokTi = $sisa_stokTi + $qty;
					$totalSisaKbTi = $sisa_kbTi + $kb_input;
					$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id1, $tanggal);
					$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id1, $tanggal);
					$this->ModTransaksiBaku->getSisaAllStokKb($id1);  
				} else {
					$this->ModTransaksiBaku->addTanggalInput($id1);
					$stokTi = $this->ModTransaksiBaku->getStokMasuk($id1, $tanggal);
					$kbTi = $this->ModTransaksiBaku->getKbMasuk($id1, $tanggal);
					$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id1, $tanggal);
					$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id1, $tanggal);
					$totalStokTi = $stokTi + $qty;
					$totalKbTi = $kbTi + $kb_input;
					$totalSisaStokTi = $sisa_stokTi + $qty;
					$totalSisaKbTi = $sisa_kbTi + $kb_input;
					$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id1, $tanggal);
					$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id1, $tanggal);
					$this->ModTransaksiBaku->getSisaAllStokKb($id1); 
				}

				echo json_encode(array("status" => TRUE));
			} else {
				$this->session->set_flashdata('cek', 'Barang sudah terdaftar!');
			}
		}
		else if ($id_baku!="0" && $id_supplier=="0") {
			$cek2 = $this->ModSuppliersBaku->cekSupplier();
			if ($cek2 == "TRUE") {
				$this->ModSuppliersBaku->add();
				echo json_encode(array("status" => TRUE));

				$id2 = $this->ModSuppliersBaku->getId();

				$stok = $this->ModBaku->getStok($id_baku);
				$total = $stok + $qty;
				$this->ModBaku->updateStok($total);

				$kb = $this->ModBaku->getKb($id_baku);
				$totalKb = $kb + $kb_input;
				$this->ModBaku->updateKb($totalKb);

				$this->ModInputBaku->addTsupplier($id2, $total);

				// transaksi baku
				$cekTanggal = $this->ModTransaksiBaku->cekTanggal($id_baku, $tanggal);
				if ($cekTanggal == 1) {
					$stokTi = $this->ModTransaksiBaku->getStokMasuk($id_baku, $tanggal);
					$kbTi = $this->ModTransaksiBaku->getKbMasuk($id_baku, $tanggal);
					$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggal);
					$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggal);
					$totalStokTi = $stokTi + $qty;
					$totalKbTi = $kbTi + $kb_input;
					$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id_baku, $tanggal);
					$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id_baku, $tanggal);
					$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);
				} else {
					$this->ModTransaksiBaku->addTanggalInput($id_baku);
					$stokTi = $this->ModTransaksiBaku->getStokMasuk($id_baku, $tanggal);
					$kbTi = $this->ModTransaksiBaku->getKbMasuk($id_baku, $tanggal);
					$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggal);
					$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggal);
					$totalStokTi = $stokTi + $qty;
					$totalKbTi = $kbTi + $kb_input;
					$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id_baku, $tanggal);
					$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id_baku, $tanggal);
					$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);  
				}

				echo json_encode(array("status" => TRUE));
			} else {
				$this->session->set_flashdata('cek', 'Supplier sudah terdaftar!');
			}
		}
		else if ($id_baku!="0" && $id_supplier!="0") {
			$stok = $this->ModBaku->getStok($id_baku);
			$total = $stok + $qty;
			$this->ModBaku->updateStok($total);

			$kb = $this->ModBaku->getKb($id_baku);
			$totalKb = $kb + $kb_input;
			$this->ModBaku->updateKb($totalKb);

			$this->ModInputBaku->add($total);

			// transaksi baku
			$cekTanggal = $this->ModTransaksiBaku->cekTanggal($id_baku, $tanggal);
			// $this->session->set_flashdata('cek', $cekTanggal);
			if ($cekTanggal == 1) {
				$stokTi = $this->ModTransaksiBaku->getStokMasuk($id_baku, $tanggal);
				$kbTi = $this->ModTransaksiBaku->getKbMasuk($id_baku, $tanggal);
				$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggal);
				$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggal);
				$totalStokTi = $stokTi + $qty;
				$totalKbTi = $kbTi + $kb_input;
				$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id_baku, $tanggal);
				$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id_baku, $tanggal);
				$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);
				echo json_encode(array("status" => TRUE));  
			} else {
				$this->ModTransaksiBaku->addTanggalInput($id_baku);
				$stokTi = $this->ModTransaksiBaku->getStokMasuk($id_baku, $tanggal);
				$kbTi = $this->ModTransaksiBaku->getKbMasuk($id_baku, $tanggal);
				$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggal);
				$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggal);
				$totalStokTi = $stokTi + $qty;
				$totalKbTi = $kbTi + $kb_input;
				$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id_baku, $tanggal);
				$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id_baku, $tanggal);
				$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);
				echo json_encode(array("status" => TRUE));
			}
			echo json_encode(array("status" => TRUE));
		}
		$setStatus = $this->ModInputBaku->selectAll();
		foreach ($setStatus as $row){
		    $id_input = $row->id_input;
		    $id_baku = $row->id_baku;
		    $expired = $row->expired;
		    $status = $row->status;
		    $tgl_input = $row->tgl_input;
		    $qty_input = $row->qty_input;
		    $kb_input = $row->kb_input;
		    $fifo = $row->fifo;
		    $today = date('Y-m-d');
		    $today_time = strtotime($today);
			$expired_time = strtotime($expired);
			$stok = $this->ModBaku->getStok($id_baku);
			$kb = $this->ModBaku->getKb($id_baku);

		    if ($expired_time <= $today_time && $status != "expired" && $status != "out") {
		    	$this->ModInputBaku->updateStatusExpired($id_input);
		    	$total = $stok - $qty_input;
				$totalKb = $kb - $kb_input;
				$this->ModBaku->updateStokWithId($total, $id_baku);
				$this->ModBaku->updateKbWithId($totalKb, $id_baku);
				$this->ModTransaksiBaku->updateKeteranganNoId($id_baku, $tgl_input);

				// transaksi
				$stokTi = $this->ModTransaksiBaku->getStokMasuk($id_baku, $tgl_input);
				$kbTi = $this->ModTransaksiBaku->getKbMasuk($id_baku, $tgl_input);
				$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tgl_input);
				$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tgl_input);
				$totalStokTi = $stokTi - $qty_input;
				$totalKbTi = $kbTi - $kb_input;
				$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id_baku, $tgl_input);
				$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id_baku, $tgl_input);
				$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);
		    }
			else if ($expired_time != $today_time && $status != "expired" && $status != "out") {
				if ($fifo <= 0) {
					$this->ModInputBaku->updateStatusOut($id_input);
				} else {
					$this->ModInputBaku->updateStatusHampir($id_input);
				}
		    }
		}
	}

	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['baku'] = $this->ModInputBaku->listBaku();
		$data['supplier'] = $this->ModInputBaku->listSupplier();
		$data['inputEdit'] = $this->ModInputBaku->edit($id);
		$this->load->view('modal/inputBaku', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$status = $this->ModInputBaku->getStatus($id);
		$tanggal = $this->ModInputBaku->getTanggal($id);
		$id_baku = $this->ModInputBaku->getIdbaku($id);
		$qtyLama = $this->ModInputBaku->getStok($id);
		$kbLama = $this->ModInputBaku->getKb($id);
		$stok = $this->ModInputBaku->getStokByInput($id);
		$kb = $this->ModInputBaku->getKbByInput($id);
		$cekTotalStokInput = $this->ModInputBaku->getTotalQtyProduk($id_baku);
		$cekTotalStokOutput = $this->ModOutputBaku->getTotalQtyProduk($id_baku);
		$cekStokProduk = ($cekTotalStokInput-$qtyLama) - $cekTotalStokOutput;  

		if ($status != 'expired' && $status != 'out') {
			if ($cekStokProduk >= 0) {
				$total = $stok - $qtyLama;
				$totalKb = $kb - $kbLama;
				
				$this->ModBaku->updateStokWithId($total, $id_baku);
				$this->ModBaku->updateKbWithId($totalKb, $id_baku);


				// transaksi
				$stokTi = $this->ModTransaksiBaku->getStokMasuk($id_baku, $tanggal);
				$kbTi = $this->ModTransaksiBaku->getKbMasuk($id_baku, $tanggal);
				$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggal);
				$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggal);
				$totalStokTi = $stokTi - $qtyLama;
				$totalKbTi = $kbTi - $kbLama;
				$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id_baku, $tanggal);
				$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id_baku, $tanggal);
				$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);

				// $this->session->set_flashdata('cek', $total);
				$this->ModInputBaku->delete($id);

				// cek hapus tanggal
				$this->ModTransaksiBaku->cekHapusTanggal($id_baku);
				echo json_encode(array("status" => TRUE));	
			}
			else {
				$this->session->set_flashdata('cek', 'Quantity Stock Is Used!');	
			}
		}
		else if ($status == 'out') {
			$this->session->set_flashdata('cek', 'Quantity Stock Is Used!');
		}
		else {
			// $this->session->set_flashdata('cek', $total);
			$this->ModInputBaku->delete($id);

			$this->ModTransaksiBaku->updateKeteranganNoId($id_baku, $tanggal);
			
			echo json_encode(array("status" => TRUE));
		}
	}
	public function update() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}

		$id_baku = $this->input->post('id_baku');
		$id_input = $this->input->post('id_input');

		$tanggalBaru = $this->input->post('tgl_input');
		$tanggalLama = $this->ModInputBaku->getTanggal($id_input);

		$qtyBaru = $this->input->post('qty_input');
		$qtyLama = $this->ModInputBaku->getStok($id_input);
		$stok = $this->ModBaku->getStok($id_baku);

		$kbBaru = $this->input->post('kb_input');
		$kbLama = $this->ModInputBaku->getKb($id_input);
		$kb = $this->ModBaku->getKb($id_baku);

		$total = $stok - ($qtyLama-$qtyBaru);
		$totalKb = $kb - ($kbLama-$kbBaru);

		if ($total < 0 || $totalKb < 0) {
			$this->session->set_flashdata('cek', 'Stok / Koli tidak mencukupi!');
		} else {
			$this->ModInputBaku->update();
			$this->ModInputBaku->update_H_Stok($total);
			$this->ModBaku->updateStok($total);
			$this->ModBaku->updateKb($totalKb);

			if ($tanggalLama == $tanggalBaru) {
				$stokTi = $this->ModTransaksiBaku->getStokMasuk($id_baku, $tanggalBaru);
				$kbTi = $this->ModTransaksiBaku->getKbMasuk($id_baku, $tanggalBaru);
				$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggalBaru);
				$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggalBaru);
				$totalStokTi = $stokTi - ($qtyLama-$qtyBaru);
				$totalKbTi = $kbTi - ($kbLama-$kbBaru);
				$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id_baku, $tanggalBaru);
				$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id_baku, $tanggalBaru);
				$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);
			} else {
				$cekTanggal = $this->ModTransaksiBaku->cekTanggal($id_baku, $tanggalBaru);
				if ($cekTanggal == 1) {
					$stokTi1 = $this->ModTransaksiBaku->getStokMasuk($id_baku, $tanggalLama);
					$kbTi1 = $this->ModTransaksiBaku->getKbMasuk($id_baku, $tanggalLama);
					$sisa_stokTi1 = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggalLama);
					$sisa_kbTi1 = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggalLama);
					$totalStokTi1 = $stokTi1 - $qtyLama;
					$totalKbTi1 = $kbTi1 - $kbLama;
					$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id_baku, $tanggalLama);
					$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id_baku, $tanggalLama);
					$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);

					$stokTi = $this->ModTransaksiBaku->getStokMasuk($id_baku, $tanggalBaru);
					$kbTi = $this->ModTransaksiBaku->getKbMasuk($id_baku, $tanggalBaru);
					$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggalBaru);
					$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggalBaru);
					$totalStokTi = $stokTi + $qtyBaru;
					$totalKbTi = $kbTi + $kbBaru;
					$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id_baku, $tanggalBaru);
					$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id_baku, $tanggalBaru);
					$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);

					// cek hapus tanggal
					$this->ModTransaksiBaku->cekHapusTanggal($id_baku);
					echo json_encode(array("status" => TRUE));  
				} else {
					$this->ModTransaksiBaku->addTanggalInput($id_baku);
					$stokTi1 = $this->ModTransaksiBaku->getStokMasuk($id_baku, $tanggalLama);
					$kbTi1 = $this->ModTransaksiBaku->getKbMasuk($id_baku, $tanggalLama);
					$sisa_stokTi1 = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggalLama);
					$sisa_kbTi1 = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggalLama);
					$totalStokTi1 = $stokTi1 - $qtyLama;
					$totalKbTi1 = $kbTi1 - $kbLama;
					$this->ModTransaksiBaku->updateStokMasuk($totalStokTi1, $id_baku, $tanggalLama);
					$this->ModTransaksiBaku->updateKbMasuk($totalKbTi1, $id_baku, $tanggalLama);
					$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);

					$stokTi = $this->ModTransaksiBaku->getStokMasuk($id_baku, $tanggalBaru);
					$kbTi = $this->ModTransaksiBaku->getKbMasuk($id_baku, $tanggalBaru);
					$sisa_stokTi = $this->ModTransaksiBaku->getStokSisa($id_baku, $tanggalBaru);
					$sisa_kbTi = $this->ModTransaksiBaku->getKbSisa($id_baku, $tanggalBaru);
					$totalStokTi = $stokTi + $qtyBaru;
					$totalKbTi = $kbTi + $kbBaru;
					$this->ModTransaksiBaku->updateStokMasuk($totalStokTi, $id_baku, $tanggalBaru);
					$this->ModTransaksiBaku->updateKbMasuk($totalKbTi, $id_baku, $tanggalBaru);
					$this->ModTransaksiBaku->getSisaAllStokKb($id_baku);

					// cek hapus tanggal
					$this->ModTransaksiBaku->cekHapusTanggal($id_baku);
					echo json_encode(array("status" => TRUE));
				}
			}
		
			$this->ModInputBaku->update();
			echo json_encode(array("status" => TRUE));
		}
	}
	public function set_supplierBaku($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['supplier'] = $this->ModSuppliersBaku->edit($id);
		$this->load->view('modal/set-supplier', $data);
	}
	public function set_baku($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['baku'] = $this->ModBaku->edit($id);
		$this->load->view('modal/set-baku', $data);
	}
}

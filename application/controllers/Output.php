<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Output extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModOutputItems');
		$this->load->model('ModInputItems');
		$this->load->model('ModItems');
		$this->load->model('ModTransaksiItems');
		$this->load->model('ModSuppliers');
	}
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		$data['output'] = $this->ModOutputItems->selectAll();
		$data['filter'] = $this->ModOutputItems->filter();
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
		$kb_output = $this->input->post('kb_output');
		$id_item = $this->input->post('id_item');
		$stok = $this->ModItems->getStok($id_item);
		$kb = $this->ModItems->getKb($id_item);
		$tanggal = $this->input->post('tgl_output');

		if ($qty > $stok || $kb_output > $kb) {
			$this->session->set_flashdata('stok', 'Stok / Koli tidak mencukupi!');
		} else {
			$total = $stok - $qty;
			$totalKb = $kb - $kb_output;
			$this->ModItems->updateStok($total);
			$this->ModItems->updateKb($totalKb);
			$this->ModOutputItems->add($total);

			// transaksi item
			$cekTanggal = $this->ModTransaksiItems->cekTanggal($id_item, $tanggal);
			if ($cekTanggal == 1) {
				$stokTi = $this->ModTransaksiItems->getStokKeluar($id_item, $tanggal);
				$kbTi = $this->ModTransaksiItems->getKbKeluar($id_item, $tanggal);
				$sisa_stokTi = $this->ModTransaksiItems->getStokSisa($id_item, $tanggal);
				$sisa_kbTi = $this->ModTransaksiItems->getKbSisa($id_item, $tanggal);
				$totalStokTi = $stokTi + $qty;
				$totalKbTi = $kbTi + $kb_output;
				$this->ModTransaksiItems->updateStokKeluar($totalStokTi, $id_item, $tanggal);
				$this->ModTransaksiItems->updateStokSisa($total, $id_item, $tanggal);
				$this->ModTransaksiItems->updateKbKeluar($totalKbTi, $id_item, $tanggal);
				$this->ModTransaksiItems->updateKbSisa($totalKb, $id_item, $tanggal);   
			} else {
				$this->ModTransaksiItems->addTanggalOutput($id_item);
				$stokTi = $this->ModTransaksiItems->getStokKeluar($id_item, $tanggal);
				$kbTi = $this->ModTransaksiItems->getKbKeluar($id_item, $tanggal);
				$sisa_stokTi = $this->ModTransaksiItems->getStokSisa($id_item, $tanggal);
				$sisa_kbTi = $this->ModTransaksiItems->getKbSisa($id_item, $tanggal);
				$totalStokTi = $stokTi + $qty;
				$totalKbTi = $kbTi + $kb_output;
				$this->ModTransaksiItems->updateStokKeluar($totalStokTi, $id_item, $tanggal);
				$this->ModTransaksiItems->updateStokSisa($total, $id_item, $tanggal);
				$this->ModTransaksiItems->updateKbKeluar($totalKbTi, $id_item, $tanggal);
				$this->ModTransaksiItems->updateKbSisa($totalKb, $id_item, $tanggal);   
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
		$id_item = $this->ModOutputItems->getIdItem($id);

		$tanggal = $this->ModOutputItems->getTanggal($id);

		$qtyLama = $this->ModOutputItems->getStok($id);
		$stok = $this->ModOutputItems->getStokByOutput($id);
		$total = $stok + $qtyLama;

		$kbLama = $this->ModOutputItems->getKb($id);
		$kb = $this->ModOutputItems->getKbByOutput($id);
		$totalKb = $kb + $kbLama;

		$this->ModItems->updateStokWithId($total, $id_item);
		$this->ModItems->updateKbWithId($totalKb, $id_item);

		$stokTi = $this->ModTransaksiItems->getStokKeluar($id_item, $tanggal);
		$kbTi = $this->ModTransaksiItems->getKbKeluar($id_item, $tanggal);
		$sisa_stokTi = $this->ModTransaksiItems->getStokSisa($id_item, $tanggal);
		$sisa_kbTi = $this->ModTransaksiItems->getKbSisa($id_item, $tanggal);
		$totalStokTi = $stokTi - $qtyLama;
		$totalKbTi = $kbTi - $kbLama;
		$this->ModTransaksiItems->updateStokKeluar($totalStokTi, $id_item, $tanggal);
		$this->ModTransaksiItems->updateStokSisa($total, $id_item, $tanggal);
		$this->ModTransaksiItems->updateKbKeluar($totalKbTi, $id_item, $tanggal);
		$this->ModTransaksiItems->updateKbSisa($totalKb, $id_item, $tanggal); 

		// cek hapus tanggal
		$cekStokMasuk = $this->ModTransaksiItems->getStokMasuk($id_item, $tanggal);
		$cekKbMasuk = $this->ModTransaksiItems->getKbMasuk($id_item, $tanggal);
		$cekStokKeluar = $this->ModTransaksiItems->getStokKeluar($id_item, $tanggal);
		$cekKbKeluar = $this->ModTransaksiItems->getKbKeluar($id_item, $tanggal);
		if ($cekStokMasuk == 0 && $cekKbMasuk == 0 && $cekStokKeluar == 0 && $cekKbKeluar == 0) {
			$this->ModTransaksiItems->deleteByTanggal($id_item, $tanggal);
		}

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

		$tanggalBaru = $this->input->post('tgl_output');
		$tanggalLama = $this->ModOutputItems->getTanggal($id_output);

		$qtyBaru = $this->input->post('qty_output');
		$qtyLama = $this->ModOutputItems->getStok($id_output);
		$stok = $this->ModItems->getStok($id_item);

		$kbBaru = $this->input->post('kb_output');
		$kbLama = $this->ModOutputItems->getKb($id_output);
		$kb = $this->ModItems->getKb($id_item);

		$total = $stok + ($qtyLama-$qtyBaru);
		$totalKb = $kb + ($kbLama-$kbBaru);

		if ($total < 0 || $totalKb < 0) {
			$this->session->set_flashdata('stok', 'Stok / Koli tidak mencukupi!');
		} else {
			$this->ModOutputItems->update();
			$this->ModOutputItems->update_H_Stok($total);
			$this->ModItems->updateStok($total);
			$this->ModItems->updateKb($totalKb);

			if ($tanggalLama == $tanggalBaru) {
				$stokTi = $this->ModTransaksiItems->getStokKeluar($id_item, $tanggalBaru);
				$kbTi = $this->ModTransaksiItems->getKbKeluar($id_item, $tanggalBaru);
				$sisa_stokTi = $this->ModTransaksiItems->getStokSisa($id_item, $tanggalBaru);
				$sisa_kbTi = $this->ModTransaksiItems->getKbSisa($id_item, $tanggalBaru);
				$totalStokTi = $stokTi + ($qtyLama-$qtyBaru);
				$totalKbTi = $kbTi + ($kbLama-$kbBaru);
				$this->ModTransaksiItems->updateStokKeluar($totalStokTi, $id_item, $tanggalBaru);
				$this->ModTransaksiItems->updateStokSisa($total, $id_item, $tanggalBaru);
				$this->ModTransaksiItems->updateKbKeluar($totalKbTi, $id_item, $tanggalBaru);
				$this->ModTransaksiItems->updateKbSisa($totalKb, $id_item, $tanggalBaru); 
			} else {
				$cekTanggal = $this->ModTransaksiItems->cekTanggal($id_item, $tanggalBaru);
				if ($cekTanggal == 1) {
					$stokTi1 = $this->ModTransaksiItems->getStokKeluar($id_item, $tanggalLama);
					$kbTi1 = $this->ModTransaksiItems->getKbKeluar($id_item, $tanggalLama);
					$sisa_stokTi1 = $this->ModTransaksiItems->getStokSisa($id_item, $tanggalLama);
					$sisa_kbTi1 = $this->ModTransaksiItems->getKbSisa($id_item, $tanggalLama);
					$totalStokTi1 = $stokTi1 - $qtyLama;
					$totalKbTi1 = $kbTi1 - $kbLama;
					$this->ModTransaksiItems->updateStokKeluar($totalStokTi, $id_item, $tanggalLama);
					$this->ModTransaksiItems->updateStokSisa($total, $id_item, $tanggalLama);
					$this->ModTransaksiItems->updateKbKeluar($totalKbTi, $id_item, $tanggalLama);
					$this->ModTransaksiItems->updateKbSisa($totalKb, $id_item, $tanggalLama); 

					// cek hapus tanggal
					$cekStokMasuk = $this->ModTransaksiItems->getStokMasuk($id_item, $tanggalLama);
					$cekKbMasuk = $this->ModTransaksiItems->getKbMasuk($id_item, $tanggalLama);
					$cekStokKeluar = $this->ModTransaksiItems->getStokKeluar($id_item, $tanggalLama);
					$cekKbKeluar = $this->ModTransaksiItems->getKbKeluar($id_item, $tanggalLama);
					if ($cekStokMasuk == 0 && $cekKbMasuk == 0 && $cekStokKeluar == 0 && $cekKbKeluar == 0) {
						$this->ModTransaksiItems->deleteByTanggal($id_item, $tanggalLama);
					} 

					$stokTi = $this->ModTransaksiItems->getStokKeluar($id_item, $tanggalBaru);
					$kbTi = $this->ModTransaksiItems->getKbKeluar($id_item, $tanggalBaru);
					$sisa_stokTi = $this->ModTransaksiItems->getStokSisa($id_item, $tanggalBaru);
					$sisa_kbTi = $this->ModTransaksiItems->getKbSisa($id_item, $tanggalBaru);
					$totalStokTi = $stokTi + $qtyBaru;
					$totalKbTi = $kbTi + $kbBaru;
					$this->ModTransaksiItems->updateStokKeluar($totalStokTi, $id_item, $tanggalBaru);
					$this->ModTransaksiItems->updateStokSisa($total, $id_item, $tanggalBaru);
					$this->ModTransaksiItems->updateKbKeluar($totalKbTi, $id_item, $tanggalBaru);
					$this->ModTransaksiItems->updateKbSisa($totalKb, $id_item, $tanggalBaru); 
					echo json_encode(array("status" => TRUE));  
				} else {
					$this->ModTransaksiItems->addTanggalOutput($id_item);
					$stokTi1 = $this->ModTransaksiItems->getStokKeluar($id_item, $tanggalLama);
					$kbTi1 = $this->ModTransaksiItems->getKbKeluar($id_item, $tanggalLama);
					$sisa_stokTi1 = $this->ModTransaksiItems->getStokSisa($id_item, $tanggalLama);
					$sisa_kbTi1 = $this->ModTransaksiItems->getKbSisa($id_item, $tanggalLama);
					$totalStokTi1 = $stokTi1 - $qtyLama;
					$totalKbTi1 = $kbTi1 - $kbLama;
					$this->ModTransaksiItems->updateStokKeluar($totalStokTi, $id_item, $tanggalLama);
					$this->ModTransaksiItems->updateStokSisa($total, $id_item, $tanggalLama);
					$this->ModTransaksiItems->updateKbKeluar($totalKbTi, $id_item, $tanggalLama);
					$this->ModTransaksiItems->updateKbSisa($totalKb, $id_item, $tanggalLama);

					// cek hapus tanggal
					$cekStokMasuk = $this->ModTransaksiItems->getStokMasuk($id_item, $tanggalLama);
					$cekKbMasuk = $this->ModTransaksiItems->getKbMasuk($id_item, $tanggalLama);
					$cekStokKeluar = $this->ModTransaksiItems->getStokKeluar($id_item, $tanggalLama);
					$cekKbKeluar = $this->ModTransaksiItems->getKbKeluar($id_item, $tanggalLama);
					if ($cekStokMasuk == 0 && $cekKbMasuk == 0 && $cekStokKeluar == 0 && $cekKbKeluar == 0) {
						$this->ModTransaksiItems->deleteByTanggal($id_item, $tanggalLama);
					}  

					$stokTi = $this->ModTransaksiItems->getStokKeluar($id_item, $tanggalBaru);
					$kbTi = $this->ModTransaksiItems->getKbKeluar($id_item, $tanggalBaru);
					$sisa_stokTi = $this->ModTransaksiItems->getStokSisa($id_item, $tanggalBaru);
					$sisa_kbTi = $this->ModTransaksiItems->getKbSisa($id_item, $tanggalBaru);
					$totalStokTi = $stokTi + $qtyBaru;
					$totalKbTi = $kbTi + $kbBaru;
					$this->ModTransaksiItems->updateStokKeluar($totalStokTi, $id_item, $tanggalBaru);
					$this->ModTransaksiItems->updateStokSisa($total, $id_item, $tanggalBaru);
					$this->ModTransaksiItems->updateKbKeluar($totalKbTi, $id_item, $tanggalBaru);
					$this->ModTransaksiItems->updateKbSisa($totalKb, $id_item, $tanggalBaru); 
					echo json_encode(array("status" => TRUE));
				}
			}
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

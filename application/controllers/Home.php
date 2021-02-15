<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('ModItems');
		$this->load->model('ModUser');
		$this->load->model('ModBaku');
		$this->load->model('ModSuppliers');
		$this->load->model('ModSuppliersBaku');
		$this->load->model('ModTransaksiBaku');
		$this->load->model('ModTransaksiItems');
		$this->load->model('ModInputItems');
		$this->load->model('ModOutputItems'); 
		$this->load->model('ModInputBaku');
		$this->load->model('ModOutputBaku'); 
	} 
	
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		
		// $this->session->set_flashdata('cek', $now);
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

		$data['limit'] = $this->ModItems->getNotifStokLimit();
		$data['user'] = $this->ModUser->getCountUser();
		$data['supplier'] = $this->ModSuppliers->getCountSupplier();
		$data['supplierBaku'] = $this->ModSuppliersBaku->getCountSupplier();
		$data['barang'] = $this->ModItems->getCountBarang();
		$data['mostInput'] = $this->ModInputItems->GetMostInput();
		$data['mostOutput'] = $this->ModOutputItems->GetMostOutput();
		$data['inputFilter'] = $this->ModInputItems->InputFilter();
		$data['outputFilter'] = $this->ModOutputItems->OutputFilter();
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

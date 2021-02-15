<?php
class ModTransaksiBaku extends CI_model {
	public function selectAll() {
		$this->db->order_by('tanggal', 'desc');
        return $this->db->get('transaksi_baku')->result();
	} 

	public function selectAllById($id) {
		$this->db->where('id_baku', $id);
		$this->db->order_by('tanggal', 'asc');
		return $this->db->get('transaksi_baku')->result();
		
	}
	public function selectId($id) {
		$this->db->where('id_baku', $id);
		return $this->db->get('transaksi_baku')->row();
	}
	public function filter($id) {
		
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$this->db->where('id_baku', $id);
		$this->db->where("tanggal BETWEEN '$start 'AND' $end'");
		return $this->db->get('transaksi_baku')->result();
		
	}
	public function cekTanggal($id_baku, $tanggal) {
		$data = array('id_baku'=>$id_baku, 'tanggal'=>$tanggal);
		$cek = $this->db->get_where('transaksi_baku', $data)->num_rows();
		if($cek > 0) {
			return 1;
		}
	}
	public function addTanggalInput($id_baku) {
		$id_baku = $id_baku;
		$tanggal = $this->input->post('tgl_input');
		
		$data = array('tanggal' => $tanggal,'id_baku' => $id_baku);
		$this->db->insert('transaksi_baku', $data);
	}
	public function addTanggalOutput($id_baku) {
		$id_baku = $id_baku;
		$tanggal = $this->input->post('tgl_output');
		
		$data = array('tanggal' => $tanggal,'id_baku' => $id_baku);
		$this->db->insert('transaksi_baku', $data);
	}
	public function delete($id){
		$this->db->where('id_tb', $id);
		$this->db->delete('transaksi_baku');
	}

	public function deleteByBaku($id_baku){
		$this->db->where('id_baku', $id_baku);
		$this->db->delete('transaksi_baku');
	}

	public function deleteByTanggal($id, $tanggal){
		$this->db->where('id_baku', $id);
		$this->db->where('tanggal', $tanggal);
		$this->db->delete('transaksi_baku');
	}
	public function edit($id){
		$this->db->where('id_tb', $id);
		return $this->db->get('transaksi_baku')->row();
	}
	public function update(){
		$id = $this->input->post('id_tb');
		$keterangan = $this->input->post('keterangan');

		$data = array('keterangan' => $keterangan);
		$this->db->where('id_tb', $id);
		$this->db->update('transaksi_baku', $data);
	}

	public function updateKeteranganNoId($id_baku, $tgl_input){
		$query1 = $this->db->query("SELECT SUM(qty_input) AS qty FROM input_baku WHERE id_baku= '$id_baku' AND tgl_input = '$tgl_input' AND status = 'expired'");
        $hasil1 = $query1->row();
        $total = $hasil1->qty;
        if ($total > 0) {
        	$keterangan = 'Terdapat '.$total.' item yang sudah expired.';
        }
        else {
        	$keterangan = '';	
        }
		$data = array('keterangan' => $keterangan);
		$this->db->where('tanggal', $tgl_input);
		$this->db->where('id_baku', $id_baku);
		$this->db->update('transaksi_baku', $data);
	}

	// public function updateKeteranganNoValue($id_baku, $tgl_input){
 //        $keterangan = '';
	// 	$data = array('keterangan' => $keterangan);
	// 	$this->db->where('tanggal', $tgl_input);
	// 	$this->db->where('id_baku', $id_baku);
	// 	$this->db->update('transaksi_baku', $data);
	// }

	public function getStokMasuk($id_baku, $tanggal){
        $query = $this->db->query("SELECT stok_masuk from transaksi_baku where id_baku= '$id_baku' AND tanggal= '$tanggal'");
        $hasil = $query->row();
        return $hasil->stok_masuk;
	}

	public function getKbMasuk($id_baku, $tanggal){
        $query = $this->db->query("SELECT kb_masuk from transaksi_baku where id_baku= '$id_baku' AND tanggal= '$tanggal'");
        $hasil = $query->row();
        return $hasil->kb_masuk;
	}

	public function getStokKeluar($id_baku, $tanggal){
        $query = $this->db->query("SELECT stok_keluar from transaksi_baku where id_baku= '$id_baku' AND tanggal= '$tanggal'");
        $hasil = $query->row();
        return $hasil->stok_keluar;
	}

	public function getKbKeluar($id_baku, $tanggal){
        $query = $this->db->query("SELECT kb_keluar from transaksi_baku where id_baku= '$id_baku' AND tanggal= '$tanggal'");
        $hasil = $query->row();
        return $hasil->kb_keluar;
	}

	public function getStokSisa($id_baku, $tanggal){
        $query = $this->db->query("SELECT sisa_stok from transaksi_baku where id_baku= '$id_baku' AND tanggal= '$tanggal'");
        $hasil = $query->row();
        return $hasil->sisa_stok;
	}

	public function getKbSisa($id_baku, $tanggal){
        $query = $this->db->query("SELECT sisa_kb from transaksi_baku where id_baku= '$id_baku' AND tanggal= '$tanggal'");
        $hasil = $query->row();
        return $hasil->sisa_kb;
	}

	// public function getIdTanggal($id_baku){
	// 	$this->db->where('id_baku', $id_baku);
 //        return $this->db->get('transaksi_baku')->result();
	// }

	public function getSisaAllStokKb($id_baku){
		$query = $this->db->query("SELECT * FROM transaksi_baku WHERE id_baku= '$id_baku'");
        foreach ($query->result() as $row){
		    $id_baku = $row->id_baku;
		    $tanggal = $row->tanggal;

		    $query1 = $this->db->query("SELECT SUM(stok_masuk) AS stok_masuk FROM transaksi_baku WHERE id_baku= '$id_baku' AND tanggal <= '$tanggal'");
	        $hasil1 = $query1->row();
	        $asm = $hasil1->stok_masuk;

	        $query2 = $this->db->query("SELECT SUM(stok_keluar) AS stok_keluar FROM transaksi_baku WHERE id_baku= '$id_baku' AND tanggal <= '$tanggal'");
	        $hasil2 = $query2->row();
	        $ask = $hasil2->stok_keluar;

	        $query3 = $this->db->query("SELECT SUM(kb_masuk) AS kb_masuk FROM transaksi_baku WHERE id_baku= '$id_baku' AND tanggal <= '$tanggal'");
	        $hasil3 = $query3->row();
	        $akm = $hasil3->kb_masuk;

	        $query4 = $this->db->query("SELECT SUM(kb_keluar) AS kb_keluar FROM transaksi_baku WHERE id_baku= '$id_baku' AND tanggal <= '$tanggal'");
	        $hasil4 = $query4->row();
	        $akk = $hasil4->kb_keluar;

	        $ss = $asm - $ask;
	        $sk = $akm - $akk;

			$dataStok = array('sisa_stok' => $ss);
			$this->db->where('id_baku', $id_baku);
			$this->db->where('tanggal', $tanggal);
			$this->db->update('transaksi_baku', $dataStok);

			$dataKb = array('sisa_kb' => $sk);
			$this->db->where('id_baku', $id_baku);
			$this->db->where('tanggal', $tanggal);
			$this->db->update('transaksi_baku', $dataKb);
		}
	}

	public function cekHapusTanggal($id_baku){
		$query = $this->db->query("SELECT * FROM transaksi_baku WHERE id_baku= '$id_baku'");
        foreach ($query->result() as $row){
		    $id_baku = $row->id_baku;
		    $tanggal = $row->tanggal;

		    $query1 = $this->db->query("SELECT stok_masuk FROM transaksi_baku WHERE id_baku= '$id_baku' AND tanggal = '$tanggal'");
	        $hasil1 = $query1->row();
	        $asm = $hasil1->stok_masuk;

	        $query2 = $this->db->query("SELECT stok_keluar FROM transaksi_baku WHERE id_baku= '$id_baku' AND tanggal = '$tanggal'");
	        $hasil2 = $query2->row();
	        $ask = $hasil2->stok_keluar;

	        if ($asm <= 0 && $ask <= 0) {
	        	$this->db->where('id_baku', $id_baku);
				$this->db->where('tanggal', $tanggal);
				$this->db->delete('transaksi_baku');
	        }
		}
	}

	public function getAllStokMasuk($id_baku, $tanggal){
        $query = $this->db->query("SELECT SUM(stok_masuk) AS stok_masuk FROM transaksi_baku WHERE id_baku= '$id_baku' AND tanggal <= '$tanggal'");
        $hasil = $query->row();
        return $hasil->stok_masuk;
	}

	public function getAllStokKeluar($id_baku, $tanggal){
        $query = $this->db->query("SELECT SUM(stok_keluar) AS stok_keluar FROM transaksi_baku WHERE id_baku= '$id_baku' AND tanggal <= '$tanggal'");
        $hasil = $query->row();
        return $hasil->stok_keluar;
	}

	public function getAllKbMasuk($id_baku, $tanggal){
        $query = $this->db->query("SELECT SUM(kb_masuk) AS kb_masuk FROM transaksi_baku WHERE id_baku= '$id_baku' AND tanggal <= '$tanggal'");
        $hasil = $query->row();
        return $hasil->kb_masuk;
	}

	public function getAllKbKeluar($id_baku, $tanggal){
        $query = $this->db->query("SELECT SUM(kb_keluar) AS kb_keluar FROM transaksi_baku WHERE id_baku= '$id_baku' AND tanggal <= '$tanggal'");
        $hasil = $query->row();
        return $hasil->kb_keluar;
	}
 
	public function updateStokMasuk($stok, $id_baku, $tanggal){
		$stok_masuk = $stok;

		$data = array('stok_masuk' => $stok_masuk);
		$this->db->where('id_baku', $id_baku);
		$this->db->where('tanggal', $tanggal);
		$this->db->update('transaksi_baku', $data);
	}

	public function updateKbMasuk($kb, $id_baku, $tanggal){
		$kb_masuk = $kb;

		$data = array('kb_masuk' => $kb_masuk);
		$this->db->where('id_baku', $id_baku);
		$this->db->where('tanggal', $tanggal);
		$this->db->update('transaksi_baku', $data);
	}

	public function updateStokKeluar($stok, $id_baku, $tanggal){
		$stok_keluar = $stok;

		$data = array('stok_keluar' => $stok_keluar);
		$this->db->where('id_baku', $id_baku);
		$this->db->where('tanggal', $tanggal);
		$this->db->update('transaksi_baku', $data);
	}

	public function updateKbKeluar($kb, $id_baku, $tanggal){
		$kb_keluar = $kb;

		$data = array('kb_keluar' => $kb_keluar);
		$this->db->where('id_baku', $id_baku);
		$this->db->where('tanggal', $tanggal);
		$this->db->update('transaksi_baku', $data);
	}

	public function updateStokSisa($stok, $id_baku, $tanggal){
		$sisa_stok = $stok;

		$data = array('sisa_stok' => $sisa_stok);
		$this->db->where('id_baku', $id_baku);
		$this->db->where('tanggal', $tanggal);
		$this->db->update('transaksi_baku', $data);
	}

	public function updateKbSisa($kb, $id_baku, $tanggal){
		$sisa_kb = $kb;

		$data = array('sisa_kb' => $sisa_kb);
		$this->db->where('id_baku', $id_baku);
		$this->db->where('tanggal', $tanggal);
		$this->db->update('transaksi_baku', $data);
	}

	// public function getId(){
	// 	$nama_baku = $this->input->post('nama_baku');
	// 	$jenis = $this->input->post('jenis');
	// 	$netto = $this->input->post('netto');
	// 	$merk = $this->input->post('merk');
 //        $query = $this->db->query("SELECT id_baku from baku where nama_baku='$nama_baku' AND jenis='$jenis' AND netto='$netto' AND merk='$merk'");
 //        $hasil = $query->row();
 //        return $hasil->id_baku;
 //    }
}
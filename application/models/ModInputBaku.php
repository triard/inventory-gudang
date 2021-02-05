<?php
class ModInputBaku extends CI_model {
	public function selectAll() {
		$this->db->select('*');
		$this->db->from('input_baku');
		$this->db->join('suppliers_baku', 'input_baku.id_supplier = suppliers_baku.id_supplier');
		$this->db->join('user', 'input_baku.id_user = user.id_user');
		$this->db->order_by('tgl_input', "asc");
        return $this->db->get()->result();
	}
	public function listBaku() {
		$this->db->order_by('nama_baku', "asc");
        return $this->db->get('baku')->result();
	}
	public function listSupplier() {
		$this->db->order_by('nama_supplier', "asc");
        return $this->db->get('suppliers_baku')->result();
	}
	public function add($stok) {
		$id_baku = $this->input->post('id_baku');
		$id_supplier = $this->input->post('id_supplier');
		$qty_input = $this->input->post('qty_input');
		$kb_input = $this->input->post('kb_input');
		$tgl_input = $this->input->post('tgl_input');
		$h_stokInput = $stok;
		$nama_baku = $this->input->post('nama_baku');
		$netto = $this->input->post('netto');
		$merk = $this->input->post('merk');
		$id_user = $this->session->userdata('id_user');
		$batch = $this->input->post('batch');
		$expired = $this->input->post('expired');
		
		$data = array('id_baku' => $id_baku,'id_supplier' => $id_supplier, 'qty_input' => $qty_input, 'kb_input' => $kb_input, 'tgl_input' => $tgl_input, 'h_stokInput' => $h_stokInput, 'nama_baku' => $nama_baku, 'netto' => $netto, 'merk' => $merk, 'id_user' => $id_user, 'batch' => $batch, 'expired' => $expired);
		$this->db->insert('input_baku', $data);
	}
	public function addTbaku($id_baku) {
		$id_baku = $id_baku;
		$id_supplier = $this->input->post('id_supplier');
		$qty_input = $this->input->post('qty_input');
		$kb_input = $this->input->post('kb_input');
		$h_stokInput = $this->input->post('qty_input');
		$tgl_input = $this->input->post('tgl_input');
		$nama_baku = $this->input->post('nama_baku');
		$netto = $this->input->post('netto');
		$merk = $this->input->post('merk');
		$id_user = $this->session->userdata('id_user');
		$batch = $this->input->post('batch');
		$expired = $this->input->post('expired');
		
		$data = array('id_baku' => $id_baku,'id_supplier' => $id_supplier, 'qty_input' => $qty_input, 'kb_input' => $kb_input, 'tgl_input' => $tgl_input, 'h_stokInput' => $h_stokInput, 'nama_baku' => $nama_baku, 'netto' => $netto, 'merk' => $merk, 'id_user' => $id_user, 'batch' => $batch, 'expired' => $expired);
		$this->db->insert('input_baku', $data);
	}
	public function addTsupplier($id_supplier, $stok) {
		$id_baku = $this->input->post('id_baku');
		$id_supplier = $id_supplier;
		$qty_input = $this->input->post('qty_input');
		$kb_input = $this->input->post('kb_input');
		$tgl_input = $this->input->post('tgl_input');
		$h_stokInput = $stok;
		$nama_baku = $this->input->post('nama_baku');
		$netto = $this->input->post('netto');
		$merk = $this->input->post('merk');
		$id_user = $this->session->userdata('id_user');
		$batch = $this->input->post('batch');
		$expired = $this->input->post('expired');
		
		$data = array('id_baku' => $id_baku,'id_supplier' => $id_supplier, 'qty_input' => $qty_input, 'kb_input' => $kb_input, 'tgl_input' => $tgl_input, 'h_stokInput' => $h_stokInput, 'nama_baku' => $nama_baku, 'netto' => $netto, 'merk' => $merk, 'id_user' => $id_user, 'batch' => $batch, 'expired' => $expired);
		$this->db->insert('input_baku', $data);
	}
	public function addTT($id_baku, $id_supplier) {
		$id_baku = $id_baku;
		$id_supplier = $id_supplier;
		$qty_input = $this->input->post('qty_input');
		$kb_input = $this->input->post('kb_input');
		$tgl_input = $this->input->post('tgl_input');
		$h_stokInput = $this->input->post('qty_input');
		$nama_baku = $this->input->post('nama_baku');
		$netto = $this->input->post('netto');
		$merk = $this->input->post('merk');
		$id_user = $this->session->userdata('id_user');
		$batch = $this->input->post('batch');
		$expired = $this->input->post('expired');
		
		$data = array('id_baku' => $id_baku,'id_supplier' => $id_supplier, 'qty_input' => $qty_input, 'kb_input' => $kb_input, 'tgl_input' => $tgl_input, 'h_stokInput' => $h_stokInput, 'nama_baku' => $nama_baku, 'netto' => $netto, 'merk' => $merk, 'id_user' => $id_user, 'batch' => $batch, 'expired' => $expired);
		$this->db->insert('input_baku', $data);
	}
	public function delete($id){
		$this->db->where('id_input', $id);
		$this->db->delete('input_baku');
	}

	public function deleteByBaku($id_baku){
		$this->db->where('id_baku', $id_baku);
		$this->db->delete('input_baku');
	}

	public function edit($id){
		$this->db->select('*');
		$this->db->from('input_baku');
		$this->db->join('suppliers_baku', 'input_baku.id_supplier = suppliers_baku.id_supplier');
		$this->db->join('user', 'input_baku.id_user = user.id_user');
		$this->db->where('id_input', $id);
		return $this->db->get()->result();
	}
	
	public function update(){
		$id_input = $this->input->post('id_input');
		$id_baku = $this->input->post('id_baku');
		$id_supplier = $this->input->post('id_supplier');
		$qty_input = $this->input->post('qty_input');
		$kb_input = $this->input->post('kb_input');
		$tgl_input = $this->input->post('tgl_input');
		$id_user = $this->session->userdata('id_user');
		$batch = $this->input->post('batch');
		$expired = $this->input->post('expired');
		
		$data = array('id_baku' => $id_baku,'id_supplier' => $id_supplier, 'qty_input' => $qty_input, 'kb_input' => $kb_input,'tgl_input' => $tgl_input, 'id_user' => $id_user, 'batch' => $batch, 'expired' => $expired);
			$this->db->where('id_input', $id_input);
			$this->db->update('input_baku', $data);
	}

	public function updatebaku(){
		$id_baku = $this->input->post('id_baku');
		$nama_baku = $this->input->post('nama_baku');
		$merk = $this->input->post('merk');
		
		$data = array('nama_baku' => $nama_baku,'merk' => $merk);
			$this->db->where('id_baku', $id_baku);
			$this->db->update('input_baku', $data);
	}

	public function update_H_Stok($stok){
		$id_input = $this->input->post('id_input');
		$h_stokInput = $stok;		
		$data = array('h_stokInput' => $h_stokInput);
		$this->db->where('id_input', $id_input);
		$this->db->update('input_baku', $data);
	}


	public function GetMostInput()
	{

		$this->db->select('a.nama_baku, a.qty_input, SUM(a.qty_input) AS total_stok');
		$this->db->from('input_baku as a');
		$this->db->group_by('a.id_baku'); 
		$this->db->order_by('a.qty_input', "desc");
		$this->db->limit('7');
        return $this->db->get()->result();
	}

	public function GetMostInputInMonth()
	{
		$awal_bulan = date('Y-m-d',strtotime('first day of this month'));
		$akhir_bulan = date('Y-m-d',strtotime('last day of this month'));
		$this->db->select('a.nama_baku, a.qty_input, SUM(a.qty_input) AS total_stok');
		$this->db->from('input_baku as a');
		$this->db->group_by('a.id_baku');
		$this->db->order_by('a.qty_input', "desc");
		$this->db->where("a.tgl_input BETWEEN '$awal_bulan 'AND' $akhir_bulan'");
		$this->db->limit('7');
        return $this->db->get()->result();
	}

	public function InputFilter()
	{
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$this->db->select('a.nama_baku, a.qty_input, SUM(a.qty_input) AS total_stok');
		$this->db->from('input_baku as a');
		$this->db->group_by('a.id_baku');
		$this->db->order_by('a.qty_input', "desc");
		$this->db->where("a.tgl_input BETWEEN '$start 'AND' $end'");
		$this->db->limit('7');
        return $this->db->get()->result();
	}

	public function filter() {
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$this->db->select('*');
		$this->db->from('input_baku');
		$this->db->join('suppliers_baku', 'input_baku.id_supplier = suppliers_baku.id_supplier');
		$this->db->join('user', 'input_baku.id_user = user.id_user');
		$this->db->order_by('tgl_input', "asc");
		$this->db->where("input_baku.tgl_input BETWEEN '$start 'AND' $end'");
        return $this->db->get()->result();
	}

	public function getStok($id_input){
        $query = $this->db->query("SELECT qty_input from input_baku where id_input= '$id_input'");
        $hasil = $query->row();
        return $hasil->qty_input;
    }
    public function getStokByInput($id_input){
        $query = $this->db->query("SELECT stok from input_baku INNER JOIN baku ON input_baku.id_baku=baku.id_baku where id_input= '$id_input'");
        $hasil = $query->row();
        return $hasil->stok;
    }

    public function getKb($id_input){
        $query = $this->db->query("SELECT kb_input from input_baku where id_input= '$id_input'");
        $hasil = $query->row();
        return $hasil->kb_input;
    }
    public function getKbByInput($id_input){
        $query = $this->db->query("SELECT kb from input_baku INNER JOIN baku ON input_baku.id_baku=baku.id_baku where id_input= '$id_input'");
        $hasil = $query->row();
        return $hasil->kb;
    }

    public function getIdBaku($id_input){
        $query = $this->db->query("SELECT id_baku from input_baku where id_input= '$id_input'");
        $hasil = $query->row();
        return $hasil->id_baku;
    }

    public function getTanggal($id_input){
        $query = $this->db->query("SELECT tgl_input from input_baku where id_input= '$id_input'");
        $hasil = $query->row();
        return $hasil->tgl_input;
    }

    public function getTotalQtyProduk($id_baku){
        $query = $this->db->query("SELECT SUM(qty_input) AS total FROM input_baku WHERE id_baku = '$id_baku'");
        $hasil = $query->row();
        return $hasil->total;
    }

}
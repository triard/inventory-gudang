<?php
class ModOutputBaku extends CI_model {
	public function selectAll() {
		$this->db->select('*');
		$this->db->from('output_baku');
		$this->db->join('user', 'output_baku.id_user = user.id_user');
		$this->db->order_by('tgl_output', "asc");
        return $this->db->get()->result();
	}

	public function filter() {
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$this->db->select('*');
		$this->db->from('output_baku');
		$this->db->join('user', 'output_baku.id_user = user.id_user');
		$this->db->order_by('tgl_output', "asc");
		$this->db->where("output_baku.tgl_output BETWEEN '$start 'AND' $end'");
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
		$qty_output = $this->input->post('qty_output');
		$kb_output = $this->input->post('kb_output');
		$h_stokOutput = $stok;
		$nama_baku = $this->input->post('nama_baku');
		$netto = $this->input->post('netto');
		$merk = $this->input->post('merk');
		$tgl_output = $this->input->post('tgl_output');
		$id_user = $this->session->userdata('id_user');
		$keterangan = $this->input->post('keterangan');
		
		$data = array('id_baku' => $id_baku, 'qty_output' => $qty_output, 'kb_output' => $kb_output, 'tgl_output' => $tgl_output, 'h_stokOutput' => $h_stokOutput, 'nama_baku' => $nama_baku, 'netto' => $netto, 'merk' => $merk, 'id_user' => $id_user, 'keterangan' => $keterangan);
		$this->db->insert('output_baku', $data);
	}

	public function delete($id){
		$this->db->where('id_output', $id);
		$this->db->delete('output_baku');
	}

	public function deleteByBaku($id_baku){
		$this->db->where('id_baku', $id_baku);
		$this->db->delete('output_baku');
	}

	public function edit($id){
		$this->db->select('*');
		$this->db->from('output_baku');
		$this->db->join('user', 'output_baku.id_user = user.id_user');
		$this->db->where('id_output', $id);
		return $this->db->get()->result();
	}
	
	public function update(){
		$id_output = $this->input->post('id_output');
		$id_baku = $this->input->post('id_baku');
		$qty_output = $this->input->post('qty_output');
		$kb_output = $this->input->post('kb_output');
		$tgl_output = $this->input->post('tgl_output');
		$id_user = $this->session->userdata('id_user');
		$keterangan = $this->input->post('keterangan');
		
		$data = array('id_baku' => $id_baku, 'qty_output' => $qty_output, 'kb_output' => $kb_output, 
		'tgl_output' => $tgl_output, 'id_user' => $id_user, 'keterangan' => $keterangan);
			$this->db->where('id_output', $id_output);
			$this->db->update('output_baku', $data);
	}

	public function updateBaku(){
		$id_baku = $this->input->post('id_baku');
		$nama_baku = $this->input->post('nama_baku');
		$merk = $this->input->post('merk');
		
		$data = array('nama_baku' => $nama_baku, 'merk' => $merk);
		$this->db->where('id_baku', $id_baku);
		$this->db->update('output_baku', $data);
	}

	public function update_H_Stok($stok){
		$id_output = $this->input->post('id_output');
		$h_stokOutput = $stok;		
		$data = array('h_stokOutput' => $h_stokOutput);
		$this->db->where('id_output', $id_output);
		$this->db->update('output_baku', $data);
	}

	public function getStok($id_output){
        $query = $this->db->query("SELECT qty_output from output_baku where id_output= '$id_output'");
        $hasil = $query->row();
        return $hasil->qty_output;
    }
    public function getStokByOutput($id_output){
        $query = $this->db->query("SELECT stok from output_baku INNER JOIN baku ON output_baku.id_baku=baku.id_baku where id_output= '$id_output'");
        $hasil = $query->row();
        return $hasil->stok;
    }

    public function getKb($id_output){
        $query = $this->db->query("SELECT kb_output from output_baku where id_output= '$id_output'");
        $hasil = $query->row();
        return $hasil->kb_output;
    }
    public function getKbByOutput($id_output){
        $query = $this->db->query("SELECT kb from output_baku INNER JOIN baku ON output_baku.id_baku=baku.id_baku where id_output= '$id_output'");
        $hasil = $query->row();
        return $hasil->kb;
    }

    public function getIdBaku($id_output){
        $query = $this->db->query("SELECT id_baku from output_baku where id_output= '$id_output'");
        $hasil = $query->row();
        return $hasil->id_baku;
	}
	
	public function GetMostOutput()
	{
		$this->db->select('*, SUM(a.qty_output) AS total_stok');
		$this->db->from('output_baku as a');
		$this->db->group_by('a.id_baku');
		$this->db->order_by('a.qty_output', "desc");
		$this->db->limit('7');
        return $this->db->get()->result();
	}

	public function OutputFilter()
	{
		$startOut = $this->input->post('startOutBaku');
		$endOut = $this->input->post('endOutBaku');
		$this->db->select('*, SUM(a.qty_output) AS total_stok');
		$this->db->from('output_baku as a');
		$this->db->group_by('a.id_baku');
		$this->db->order_by('a.qty_output', "desc");
		$this->db->where("a.tgl_output BETWEEN '$startOut 'AND' $endOut'");
		$this->db->limit('7');
        return $this->db->get()->result();
	}

	 public function getTanggal($id_output){
        $query = $this->db->query("SELECT tgl_output from output_baku where id_output= '$id_output'");
        $hasil = $query->row();
        return $hasil->tgl_output;
    }

    public function getTotalQtyProduk($id_baku){
        $query = $this->db->query("SELECT SUM(qty_output) AS total FROM output_baku WHERE id_baku = '$id_baku'");
        $hasil = $query->row();
        return $hasil->total;
    }

}
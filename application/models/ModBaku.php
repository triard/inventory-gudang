<?php
class ModBaku extends CI_model {
	public function selectAll() {
		// $this->db->order_by('nama_user', "asc");
        return $this->db->get('baku')->result();
	}
	public function add() {
		$nama_baku = $this->input->post('nama_baku');
		$produsen = $this->input->post('produsen');
		$stok = $this->input->post('qty_input');
		$kb = $this->input->post('kb_input');
		// $stok_limit = $this->input->post('stok_limit');
		
		$data = array('nama_baku' => $nama_baku, 'produsen' => $produsen, 'stok' => $stok, 'kb' => $kb);
		$this->db->insert('baku', $data);
	}
	public function addNoStok() {
		$nama_baku = $this->input->post('nama_baku');
		$produsen = $this->input->post('produsen');
		$stok_limit = $this->input->post('stok_limit');
		
		$data = array('nama_baku' => $nama_baku, 'produsen' => $produsen, 'stok_limit' => $stok_limit);
		$this->db->insert('baku', $data);
	}
	public function delete($id){
		$this->db->where('id_baku', $id);
		$this->db->delete('baku');
	}
	public function edit($id){
		$this->db->where('id_baku', $id);
		return $this->db->get('baku')->row();
	}
	public function update(){
		$id = $this->input->post('id_baku');
		$stok_limit = $this->input->post('stok_limit');

		$data = array('stok_limit' => $stok_limit);
		$this->db->where('id_baku', $id);
		$this->db->update('baku', $data);
	}
 
	public function updateStok($stok){
		$id = $this->input->post('id_baku');
		$stok = $stok;

		$data = array('stok' => $stok);
		$this->db->where('id_baku', $id);
		$this->db->update('baku', $data);
	}

	public function updateStokWithId($stok, $id){
		$id = $id;
		$stok = $stok;

		$data = array('stok' => $stok);
		$this->db->where('id_baku', $id);
		$this->db->update('baku', $data);
	}

	public function updateKb($kb){
		$id = $this->input->post('id_baku');
		$kb = $kb;

		$data = array('kb' => $kb);
		$this->db->where('id_baku', $id);
		$this->db->update('baku', $data);
	}

	public function updateKbWithId($kb, $id){
		$id = $id;
		$kb = $kb;

		$data = array('kb' => $kb);
		$this->db->where('id_baku', $id);
		$this->db->update('baku', $data);
	}

	public function updateStokLimit(){
		$id = $this->input->post('id_baku');
		$nama_baku = $this->input->post('nama_baku');
		$produsen = $this->input->post('produsen');
		$stok_limit = $this->input->post('stok_limit');

		$data = array('nama_baku' => $nama_baku,'produsen' => $produsen,'stok_limit' => $stok_limit);
		$this->db->where('id_baku', $id);
		$this->db->update('baku', $data);
	} 

	public function cekBaku(){
		$nama_baku = $this->input->post('nama_baku');
		$produsen = $this->input->post('produsen');
		$data = array('nama_baku'=>$nama_baku, 'produsen'=>$produsen);
		$cek = $this->db->get_where('baku', $data)->num_rows();
		if($cek > 0) {
			return "FALSE";
		} else {
			return "TRUE";
		}
    }

	public function getId(){
		$nama_baku = $this->input->post('nama_baku');
		$produsen = $this->input->post('produsen');
        $query = $this->db->query("SELECT id_baku from baku where nama_baku='$nama_baku' AND produsen='$produsen'");
        $hasil = $query->row();
        return $hasil->id_baku;
    }

    public function getStok($id_baku){
        $query = $this->db->query("SELECT stok from baku where id_baku= '$id_baku'");
        $hasil = $query->row();
        return $hasil->stok;
	}

	public function getKb($id_baku){
        $query = $this->db->query("SELECT kb from baku where id_baku= '$id_baku'");
        $hasil = $query->row();
        return $hasil->kb;
	}

	public function getAllById($id_baku){
        $query = $this->db->query("SELECT * from baku where id_baku= '$id_baku'");
        $hasil = $query->row();
        return $hasil;
	}
	
	public function getNotifStokLimit()
	{
		$this->db->select('*');
		$this->db->from('baku');
		$this->db->where('stok <= stok_limit');
        return $this->db->get()->result();
	}

	public function getCountBarang()
	{
		$this->db->select('id_baku');
		$this->db->from('baku');
		return $this->db->count_all_results();
	}

	public function getTransaksi($id)
	{
		$this->db->select('*');
		$this->db->from('baku');
		$this->db->join('input_baku', 'baku.id_baku = input_baku.id_baku');
		$this->db->join('output_baku', 'input_baku.id_baku = output_baku.id_baku');
		$this->db->where('baku.id_baku = $id');
        return $this->db->get()->result();
	}
}
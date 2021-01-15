<?php
class ModSuppliers extends CI_model {
	public function selectAll() {
		// $this->db->order_by('nama_user', "asc");
        return $this->db->get('suppliers')->result();
	}
	public function add() {
		$nama_supplier = $this->input->post('nama_supplier');
		$kontak = $this->input->post('kontak');
		
		$data = array('nama_supplier' => $nama_supplier,'kontak' => $kontak);
		$this->db->insert('suppliers', $data);
		// $x = $this->db->insert_id();
		// foreach ($akses_id as $k => $v) {
		// 	$data = array('admin_id' => $x, 'akses_id' => $v);
		// 	$this->db->insert('admin_akses', $data);
		// 	$this->db->insert_id();
		// }
	}
	public function delete($id){
		$this->db->where('id_supplier', $id);
		$this->db->delete('suppliers');
	}
	public function edit($id){
		$this->db->where('id_supplier', $id);
		return $this->db->get('suppliers')->row();
	}
	
	public function update(){
		$id = $this->input->post('id_supplier');
		$nama_supplier = $this->input->post('nama_supplier');
		$kontak = $this->input->post('kontak');

		$data = array('nama_supplier' => $nama_supplier,'kontak' => $kontak);
		$this->db->where('id_supplier', $id);
		$this->db->update('suppliers', $data);
	}

	public function cekSupplier(){
		$nama_supplier = $this->input->post('nama_supplier');
		$kontak = $this->input->post('kontak');
		$data = array('nama_supplier' => $nama_supplier,'kontak' => $kontak);
		$cek = $this->db->get_where('suppliers', $data)->num_rows();
		if($cek > 0) {
			return "FALSE";
		} else {
			return "TRUE";
		}
    }

	public function getId(){
		$nama_supplier = $this->input->post('nama_supplier');
		$kontak = $this->input->post('kontak');
        $query = $this->db->query("SELECT id_supplier from suppliers where nama_supplier='$nama_supplier' AND kontak='$kontak'");
        $hasil = $query->row();
        return $hasil->id_supplier;
    }
}
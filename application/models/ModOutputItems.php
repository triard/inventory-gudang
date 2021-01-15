<?php
class ModOutputItems extends CI_model {
	public function selectAll() {
		$this->db->select('*');
		$this->db->from('output_items');
		$this->db->join('items', 'output_items.id_item = items.id_item');
		$this->db->join('user', 'output_items.id_user = user.id_user');
		$this->db->order_by('tgl_output', "asc");
        return $this->db->get()->result();
	}
	public function listItems() { 
		$this->db->order_by('nama_item', "asc");
        return $this->db->get('items')->result();
	}
	public function listSupplier() {
		$this->db->order_by('nama_supplier', "asc");
        return $this->db->get('suppliers')->result();
	}
	public function add() {
		$id_item = $this->input->post('id_item');
		$qty_output = $this->input->post('qty_output');
		$tgl_output = $this->input->post('tgl_output');
		$id_user = $this->input->post('id_user');
		
		$data = array('id_item' => $id_item, 'qty_output' => $qty_output, 'tgl_output' => $tgl_output, 'id_user' => $id_user);
		$this->db->insert('output_items', $data);
	}
	public function delete($id){
		$this->db->where('id_output', $id);
		$this->db->delete('output_items');
	}
	public function edit($id){
		$this->db->select('*');
		$this->db->from('output_items');
		$this->db->join('items', 'output_items.id_item = items.id_item');
		$this->db->join('user', 'output_items.id_user = user.id_user');
		$this->db->where('id_output', $id);
		return $this->db->get()->result();
	}
	
	public function update(){
		$id_output = $this->input->post('id_output');
		$id_item = $this->input->post('id_item');
		$qty_output = $this->input->post('qty_output');
		$tgl_output = $this->input->post('tgl_output');
		$id_user = $this->input->post('id_user');
		
		$data = array('id_item' => $id_item, 'qty_output' => $qty_output, 
		'tgl_output' => $tgl_output, 'id_user' => $id_user);
			$this->db->where('id_output', $id_output);
			$this->db->update('output_items', $data);
	}
}
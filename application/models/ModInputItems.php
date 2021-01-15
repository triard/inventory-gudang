<?php
class ModInputItems extends CI_model {
	public function selectAll() {
		$this->db->select('*');
		$this->db->from('input_items');
		$this->db->join('items', 'input_items.id_item = items.id_item');
		$this->db->join('suppliers', 'input_items.id_supplier = suppliers.id_supplier');
		$this->db->join('user', 'input_items.id_user = user.id_user');
		$this->db->order_by('tgl_input', "asc");
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
		$id_supplier = $this->input->post('id_supplier');
		$qty_input = $this->input->post('qty_input');
		$tgl_input = $this->input->post('tgl_input');
		$id_user = $this->input->post('id_user');
		
		$data = array('id_item' => $id_item,'id_supplier' => $id_supplier, 'qty_input' => $qty_input, 'tgl_input' => $tgl_input, 'id_user' => $id_user);
		$this->db->insert('input_items', $data);
	}
	public function addTitem($id_item) {
		$id_item = $id_item;
		$id_supplier = $this->input->post('id_supplier');
		$qty_input = $this->input->post('qty_input');
		$tgl_input = $this->input->post('tgl_input');
		$id_user = $this->input->post('id_user');
		
		$data = array('id_item' => $id_item,'id_supplier' => $id_supplier, 'qty_input' => $qty_input, 'tgl_input' => $tgl_input, 'id_user' => $id_user);
		$this->db->insert('input_items', $data);
	}
	public function addTsupplier($id_supplier) {
		$id_item = $this->input->post('id_item');
		$id_supplier = $id_supplier;
		$qty_input = $this->input->post('qty_input');
		$tgl_input = $this->input->post('tgl_input');
		$id_user = $this->input->post('id_user');
		
		$data = array('id_item' => $id_item,'id_supplier' => $id_supplier, 'qty_input' => $qty_input, 'tgl_input' => $tgl_input, 'id_user' => $id_user);
		$this->db->insert('input_items', $data);
	}
	public function addTT($id_item, $id_supplier) {
		$id_item = $id_item;
		$id_supplier = $id_supplier;
		$qty_input = $this->input->post('qty_input');
		$tgl_input = $this->input->post('tgl_input');
		$id_user = $this->input->post('id_user');
		
		$data = array('id_item' => $id_item,'id_supplier' => $id_supplier, 'qty_input' => $qty_input, 'tgl_input' => $tgl_input, 'id_user' => $id_user);
		$this->db->insert('input_items', $data);
	}
	public function delete($id){
		$this->db->where('id_input', $id);
		$this->db->delete('input_items');
	}
	public function edit($id){
		$this->db->select('*');
		$this->db->from('input_items');
		$this->db->join('items', 'input_items.id_item = items.id_item');
		$this->db->join('suppliers', 'input_items.id_supplier = suppliers.id_supplier');
		$this->db->join('user', 'input_items.id_user = user.id_user');
		$this->db->where('id_input', $id);
		return $this->db->get()->result();
	}
	
	public function update(){
		$id_input = $this->input->post('id_input');
		$id_item = $this->input->post('id_item');
		$id_supplier = $this->input->post('id_supplier');
		$qty_input = $this->input->post('qty_input');
		$tgl_input = $this->input->post('tgl_input');
		$id_user = $this->input->post('id_user');
		
		$data = array('id_item' => $id_item,'id_supplier' => $id_supplier, 'qty_input' => $qty_input, 
		'tgl_input' => $tgl_input, 'id_user' => $id_user);
			$this->db->where('id_input', $id_input);
			$this->db->update('input_items', $data);
	}
}
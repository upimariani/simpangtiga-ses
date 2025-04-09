<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mProduk extends CI_Model
{
	public function create($data)
	{
		$this->db->insert('produk', $data);
	}
	public function select()
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->join('user', 'produk.id_user = user.id_user', 'left');
		return $this->db->get()->result();
	}
	public function get_data($id)
	{
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->where('id_produk', $id);
		return $this->db->get()->row();
	}
	public function update($id, $data)
	{
		$this->db->where('id_produk', $id);
		$this->db->update('produk', $data);
	}
	public function delete($id)
	{
		$this->db->where('id_produk', $id);
		$this->db->delete('produk');
	}
}

/* End of file mProduk.php */

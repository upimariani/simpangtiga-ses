<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mPermintaan extends CI_Model
{
	public function select()
	{
		$this->db->select('*');
		$this->db->from('permintaan');
		$this->db->order_by('tgl_permintaan', 'desc');

		return $this->db->get()->result();
	}
}

/* End of file mPermintaan.php */

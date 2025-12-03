<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cPermintaan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mPermintaan');
	}

	public function index()
	{
		$data = array(
			'permintaan' => $this->mPermintaan->select()
		);
		$this->load->view('Supplier/Layout/head');
		$this->load->view('Supplier/Layout/aside');
		$this->load->view('Supplier/Permintaan/vPermintaan', $data);
		$this->load->view('Supplier/Layout/footer');
	}
	public function konfirmasi($id_permintaan)
	{
		$data = array(
			'status' => '2'
		);
		$this->db->where('id_permintaan', $id_permintaan);
		$this->db->update('permintaan', $data);
		$this->session->set_flashdata('success', 'Permintaan berhasil dikonfirmasi!');
		redirect('Supplier/cPermintaan');
	}
}

/* End of file cPermintaan.php */

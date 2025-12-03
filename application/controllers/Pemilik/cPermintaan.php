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
		$this->load->view('Pemilik/Layout/head');
		$this->load->view('Pemilik/Layout/aside');
		$this->load->view('Pemilik/Permintaan/vPermintaan', $data);
		$this->load->view('Pemilik/Layout/footer');
	}
	public function konfirmasi($id_permintaan)
	{
		$data = array(
			'status' => '1'
		);
		$this->db->where('id_permintaan', $id_permintaan);
		$this->db->update('permintaan', $data);
		$this->session->set_flashdata('success', 'Permintaan berhasil dikonfirmasi!');
		redirect('Pemilik/cPermintaan');
	}
}

/* End of file cPermintaan.php */

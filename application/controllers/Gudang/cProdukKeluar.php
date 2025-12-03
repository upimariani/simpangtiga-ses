<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cProdukKeluar extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mProduk');
	}

	public function index()
	{
		$data = array(
			'produk' => $this->mProduk->select(),
			'produk_keluar' => $this->db->query("SELECT * FROM `produk_keluar` JOIN produk ON produk_keluar.id_produk=produk.id_produk")->result()
		);
		$this->load->view('Gudang/Layout/head');
		$this->load->view('Gudang/Layout/aside');
		$this->load->view('Gudang/vProdukKeluar', $data);
		$this->load->view('Gudang/Layout/footer');
	}
	public function create()
	{
		$produk = $this->input->post('produk');
		$dt_produk = $this->db->query("SELECT * FROM `produk` WHERE id_produk='" . $produk . "'")->row();

		$stok_seb = $dt_produk->stok;
		$stok_kel = $this->input->post('qty');

		if ($stok_kel > $stok_seb) {
			$this->session->set_flashdata('error', 'Quantity Keluar melebihi stok yang tersedia!');
			redirect('Gudang/cProdukKeluar');
		} else {
			$stok_update = $stok_seb - $stok_kel;

			$data = array(
				'id_produk' => $produk,
				'tgl_keluar' => date('Y-m-d'),
				'qty' => $stok_kel
			);
			$this->db->insert('produk_keluar', $data);

			$dt_stok = array(
				'stok' => $stok_update
			);
			$this->db->where('id_produk', $produk);
			$this->db->update('produk', $dt_stok);


			$this->session->set_flashdata('success', 'Produk Keluar berhasil disimpan!');
			redirect('Gudang/cProdukKeluar');
		}
	}
}

/* End of file cProdukKeluar.php */

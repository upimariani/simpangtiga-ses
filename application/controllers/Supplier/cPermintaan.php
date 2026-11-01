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
		// Ambil data permintaan
		$permintaan = $this->db
			->get_where('permintaan', [
				'id_permintaan' => $id_permintaan
			])->row();

		if (!$permintaan) {
			$this->session->set_flashdata(
				'error',
				'Data permintaan tidak ditemukan!'
			);
			redirect('Supplier/cPermintaan');
			return;
		}

		// Cegah stok bertambah dua kali
		if ($permintaan->status == '3') {
			$this->session->set_flashdata(
				'error',
				'Permintaan ini sudah dikonfirmasi sebelumnya!'
			);
			redirect('Supplier/cPermintaan');
			return;
		}

		// Ambil detail produk yang diminta gudang
		$detail = $this->db->get_where('detail_permintaan', [
			'id_permintaan' => $id_permintaan
		])->result();

		if (empty($detail)) {
			$this->session->set_flashdata(
				'error',
				'Detail permintaan tidak ditemukan!'
			);
			redirect('Supplier/cPermintaan');
			return;
		}

		// Mulai transaksi database
		$this->db->trans_begin();

		foreach ($detail as $item) {
			$jumlah = (int) $item->qty;

			// Tambahkan stok produk sesuai jumlah permintaan
			$this->db->query(
				"UPDATE produk
             SET stok = stok + ?
             WHERE id_produk = ?",
				[$jumlah, $item->id_produk]
			);
		}

		// Ubah status menjadi 2 (dikonfirmasi)
		$this->db->where('id_permintaan', $id_permintaan);
		$this->db->update('permintaan', [
			'status' => '3'
		]);

		// Simpan semua perubahan jika berhasil
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();

			$this->session->set_flashdata(
				'error',
				'Konfirmasi gagal. Stok tidak berhasil diperbarui!'
			);
		} else {
			$this->db->trans_commit();

			$this->session->set_flashdata(
				'success',
				'Permintaan berhasil dikonfirmasi dan stok produk berhasil ditambahkan!'
			);
		}

		redirect('Supplier/cPermintaan');
	}
}

/* End of file cPermintaan.php */

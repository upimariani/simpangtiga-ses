<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cPermintaan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mPermintaan');
		$this->load->model('mProduk');
	}

	public function index()
	{
		$data = array(
			// 'permintaan' => $this->mPermintaan->select()
			'permintaan' => $this->db->query("SELECT * FROM `permintaan` GROUP BY id_permintaan DESC")->result()
		);
		$this->load->view('Gudang/Layout/head');
		$this->load->view('Gudang/Layout/aside');
		$this->load->view('Gudang/Permintaan/vPermintaan', $data);
		$this->load->view('Gudang/Layout/footer');
	}
	public function tambah_permintaan()
	{
		$this->form_validation->set_rules('produk', 'Produk', 'required');
		$this->form_validation->set_rules('qty', 'Quantity', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'produk' => $this->mProduk->select()
			);
			$this->load->view('Gudang/Layout/head');
			$this->load->view('Gudang/Layout/aside');
			$this->load->view('Gudang/Permintaan/vTambahPermintaan', $data);
			$this->load->view('Gudang/Layout/footer');
		} else {
			$data = array(
				'id' => $this->input->post('produk'),
				'name' => $this->input->post('nama'),
				'price' => $this->input->post('harga'),
				'qty' => $this->input->post('qty'),
				'keterangan' => $this->input->post('keterangan')
			);
			$this->cart->insert($data);
			$this->session->set_flashdata('success', 'Produk berhasil masuk ke keranjang!');
			redirect('Gudang/cPermintaan/tambah_permintaan');
		}
	}
	public function delete_cart($rowid)
	{
		$this->cart->remove($rowid);
		$this->session->set_flashdata('success', 'Produk berhasil dihapus!');
		redirect('Gudang/cPermintaan/tambah_permintaan');
	}
	public function selesai()
	{
		//menyimpan di tabel permintaan
		$dt_permintaan = array(
			'tgl_permintaan' => date('Y-m-d'),
			'total_bayar' => $this->cart->total(),
			'status' => '0',
			'payment' => '0'
		);
		$this->db->insert('permintaan', $dt_permintaan);

		//menyimpan data detail permintaan
		$id = $this->db->query("SELECT MAX(id_permintaan) as id_permintaan FROM `permintaan`")->row();
		foreach ($this->cart->contents() as $key => $value) {
			$dt_produk = array(
				'id_permintaan' => $id->id_permintaan,
				'id_produk' => $value['id'],
				'qty' => $value['qty']
			);
			$this->db->insert('detail_permintaan', $dt_produk);
		}
		$this->session->set_flashdata('success', 'Permintaan Produk berhasil dikirim ke Supplier!');
		redirect('Gudang/cPermintaan');
	}
	public function bayar($id_permintaan)
	{
		$config['upload_path']          = './asset/bayar';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 500000;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('gambar')) {
			$data = array(
				'permintaan' => $this->mPermintaan->select()
			);
			$this->load->view('Gudang/Layout/head');
			$this->load->view('Gudang/Layout/aside');
			$this->load->view('Gudang/Permintaan/vPermintaan', $data);
			$this->load->view('Gudang/Layout/footer');
		} else {
			$upload_data = $this->upload->data();
			$data = array(
				'payment' => $upload_data['file_name']
			);
			$this->db->where('id_permintaan', $id_permintaan);
			$this->db->update('permintaan', $data);
			$this->session->set_flashdata('success', 'Pembayaran berhasil dikirim!');
			redirect('Gudang/cPermintaan');
		}
	}
	public function delete($id)
	{
		$this->db->where('id_permintaan', $id);
		$this->db->delete('permintaan');

		$this->db->where('id_permintaan', $id);
		$this->db->delete('detail_permintaan');

		$this->session->set_flashdata('success', 'Data permintaan berhasil dihapus!');
		redirect('Gudang/cPermintaan');
	}
}

/* End of file cPermintaan.php */

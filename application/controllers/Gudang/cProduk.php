<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cProduk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mProduk');
		$this->load->model('mUser');
	}

	public function index()
	{
		$data = array(
			'produk' => $this->mProduk->select()
		);
		$this->load->view('Gudang/Layout/head');
		$this->load->view('Gudang/Layout/aside');
		$this->load->view('Gudang/Produk/vProduk', $data);
		$this->load->view('Gudang/Layout/footer');
	}
	public function create()
	{
		$this->form_validation->set_rules('nama', 'Nama Produk', 'required');
		$this->form_validation->set_rules('supplier', 'Keterangan', 'required');
		$this->form_validation->set_rules('harga', 'Deskripsi', 'required');
		$this->form_validation->set_rules('keterangan', 'Stok', 'required');
		$this->form_validation->set_rules('stok', 'Harga', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'supplier' => $this->mUser->select()
			);
			$this->load->view('Gudang/Layout/head');
			$this->load->view('Gudang/Layout/aside');
			$this->load->view('Gudang/Produk/vTambahProduk', $data);
			$this->load->view('Gudang/Layout/footer');
		} else {
			$config['upload_path']          = './asset/produk';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 500000;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$data = array(
					'supplier' => $this->mUser->select()
				);
				$this->load->view('Gudang/Layout/head');
				$this->load->view('Gudang/Layout/aside');
				$this->load->view('Gudang/Produk/vTambahProduk', $data);
				$this->load->view('Gudang/Layout/footer');
			} else {
				$upload_data = $this->upload->data();
				$data = array(
					'id_user' => $this->input->post('supplier'),
					'nama_produk' => $this->input->post('nama'),
					'keterangan' => $this->input->post('keterangan'),
					'harga' => $this->input->post('harga'),
					'stok' =>  $this->input->post('stok'),
					'gambar' => $upload_data['file_name']
				);
				$this->mProduk->create($data);
				$this->session->set_flashdata('success', 'Data Produk Berhasil Ditambahkan!');
				redirect('Gudang/cProduk');
			}
		}
	}
	public function edit($id)
	{
		$this->form_validation->set_rules('nama', 'Nama Produk', 'required');
		$this->form_validation->set_rules('supplier', 'Keterangan', 'required');
		$this->form_validation->set_rules('harga', 'Deskripsi', 'required');
		$this->form_validation->set_rules('keterangan', 'Stok', 'required');
		$this->form_validation->set_rules('stok', 'Harga', 'required');

		if ($this->form_validation->run() == TRUE) {
			$config['upload_path']          = './asset/produk';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 500000;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('gambar')) {
				$data = array(
					'supplier' => $this->mUser->select(),
					'produk' => $this->mProduk->get_data($id)
				);
				$this->load->view('Admin/Layout/head');
				$this->load->view('Admin/Layout/aside');
				$this->load->view('Admin/Produk/vEditProduk', $data);
				$this->load->view('Admin/Layout/footer');
			} else {
				$upload_data = $this->upload->data();
				$data = array(
					'id_user' => $this->input->post('supplier'),
					'nama_produk' => $this->input->post('nama'),
					'keterangan' => $this->input->post('keterangan'),
					'harga' => $this->input->post('harga'),
					'stok' =>  $this->input->post('stok'),
					'gambar' => $upload_data['file_name']
				);
				$this->mProduk->update($id, $data);
				$this->session->set_flashdata('success', 'Data Produk Berhasil Diperbaharui!');
				redirect('Admin/cProduk');
			} //tanpa ganti gambar
			$upload_data = $this->upload->data();
			$data = array(
				'id_user' => $this->input->post('supplier'),
				'nama_produk' => $this->input->post('nama'),
				'keterangan' => $this->input->post('keterangan'),
				'harga' => $this->input->post('harga'),
				'stok' =>  $this->input->post('stok')
			);
			$this->mProduk->update($id, $data);
			$this->session->set_flashdata('success', 'Data Produk Berhasil Diperbaharui!');
			redirect('Admin/cProduk');
		}
		$data = array(
			'supplier' => $this->mUser->select(),
			'produk' => $this->mProduk->get_data($id)
		);
		$this->load->view('Admin/Layout/head');
		$this->load->view('Admin/Layout/aside');
		$this->load->view('Admin/Produk/vEditProduk', $data);
		$this->load->view('Admin/Layout/footer');
	}
	public function delete($id)
	{
		$this->mProduk->delete($id);
		$this->session->set_flashdata('success', 'Data Produk Berhasil Dihapus!');
		redirect('Admin/cProduk');
	}
}

/* End of file cProduk.php */

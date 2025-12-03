<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cPeramalan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mProduk');
		$this->load->model('mPeramalan');
	}

	public function index()
	{
		$data = array(
			'produk' => $this->mProduk->select()
		);
		$this->load->view('Admin/Layout/head');
		$this->load->view('Admin/Layout/aside');
		$this->load->view('Admin/vPeramalan', $data);
		$this->load->view('Admin/Layout/footer');
	}
	public function view_peramalan($id_produk)
	{
		// echo 'Bismillah perhitungan<br>';
		$dt_aktual = $this->mPeramalan->dt_aktual($id_produk);
		foreach ($dt_aktual as $key => $value) {
			$cek_data_peramalan = $this->db->query("SELECT * FROM `peramalan` WHERE id_produk='" . $id_produk . "' AND bulan='" . $value->periode . "' AND tahun='" . $value->tahun . "';")->row();
			if (!$cek_data_peramalan) {
				// echo $value->jumlah;
				// echo ' | ';
				$dt_cek = $this->db->query("SELECT * FROM `peramalan` WHERE id_produk='" . $id_produk . "'")->row();

				if (!$dt_cek) {
					$dt_peramalan = '0';
					// echo $value->jumlah;

					$data = array(
						'id_produk' => $id_produk,
						'bulan' => $value->periode,
						'tahun' => $value->tahun,
						'dt_permintaan' => $value->jumlah,
						'dt_peramalan' => $value->jumlah,

					);
					$this->db->insert('peramalan', $data);
				} else {
					$per = $value->periode - 1;
					$dt_peramalan_sebelumnya = $this->db->query("SELECT * FROM `peramalan` WHERE id_produk='" . $id_produk . "' AND bulan='" . $per . "' AND tahun='" . $value->tahun . "';")->row();
					$forecasting = $dt_peramalan_sebelumnya->dt_peramalan;
					$aktual = $dt_peramalan_sebelumnya->dt_permintaan;

					$ft = round((0.2 * $aktual) + ((1 - 0.2) * $forecasting));
					// echo $ft;

					$data = array(
						'id_produk' => $id_produk,
						'bulan' => $value->periode,
						'tahun' => $value->tahun,
						'dt_permintaan' => $value->jumlah,
						'dt_peramalan' => $ft
					);
					$this->db->insert('peramalan', $data);
				}
				// echo '<br>';
			}
		}
		$data = array(
			'view_analisis' => $this->mPeramalan->view_peramalan($id_produk),
			'periode' => $this->mPeramalan->periode(),
			'id_produk' => $id_produk
		);
		$this->load->view('Admin/Layout/head');
		$this->load->view('Admin/Layout/aside');
		$this->load->view('Admin/vViewPeramalan', $data);
		$this->load->view('Admin/Layout/footer');
	}
}

/* End of file cPeramalan.php */

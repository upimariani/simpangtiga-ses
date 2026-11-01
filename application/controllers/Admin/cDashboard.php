<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cDashboard extends CI_Controller
{

	public function index()
	{ // 1. Total produk
		$data['total_produk'] = $this->db
			->count_all('produk');

		// 2. Jumlah produk dengan stok <= 20
		$data['stok_menipis'] = $this->db
			->where('stok <=', 20)
			->count_all_results('produk');

		// 3. Daftar produk untuk dropdown grafik
		$data['produk'] = $this->db
			->order_by('nama_produk', 'ASC')
			->get('produk')
			->result();

		// 4. Daftar produk dengan stok menipis
		$data['produk_menipis'] = $this->db
			->where('stok <=', 20)
			->order_by('stok', 'ASC')
			->get('produk')
			->result();

		// 5. Menghitung MAPE keseluruhan
		$hasil = $this->db
			->where('dt_permintaan >', 0)
			->get('peramalan')
			->result();

		$total_ape = 0;
		$jumlah_data = 0;

		foreach ($hasil as $row) {
			$aktual = (float) $row->dt_permintaan;
			$ramalan = (float) $row->dt_peramalan;

			$total_ape += abs(($aktual - $ramalan) / $aktual) * 100;
			$jumlah_data++;
		}

		$data['mape'] = $jumlah_data > 0
			? $total_ape / $jumlah_data
			: null;

		// 6. Data peramalan terbaru
		$data['peramalan_terbaru'] = $this->db
			->select('peramalan.*, produk.nama_produk')
			->from('peramalan')
			->join(
				'produk',
				'produk.id_produk = peramalan.id_produk',
				'left'
			)
			->order_by('peramalan.tahun', 'DESC')
			->order_by('peramalan.bulan', 'DESC')
			->limit(1)
			->get()
			->row();
		$this->load->view('Admin/Layout/head');
		$this->load->view('Admin/Layout/aside');
		$this->load->view('Gudang/vDashboard', $data);
		$this->load->view('Admin/Layout/footer');
	}
}

/* End of file cDashboard.php */

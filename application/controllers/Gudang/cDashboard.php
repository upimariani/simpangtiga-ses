<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cDashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Jika aplikasi menggunakan login, aktifkan pengecekan sesi di sini.
		// $this->load->library('session');
	}

	public function index()
	{
		// 1. Total produk
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

		// 7. Tampilkan view dashboard
		$this->load->view('Gudang/Layout/head');
		$this->load->view('Gudang/Layout/aside');
		$this->load->view('Gudang/vDashboard', $data);
		$this->load->view('Gudang/Layout/footer');
	}

	// Data grafik dan MAPE sesuai produk yang dipilih
	public function data_grafik()
	{
		$id_produk = (int) $this->input->get('id_produk');

		$nama_bulan = array(
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maret',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember'
		);

		// Jika produk belum dipilih
		if ($id_produk <= 0) {
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode(array(
					'labels' => array(),
					'aktual' => array(),
					'peramalan' => array(),
					'mape' => null
				)));
		}

		// Ambil data peramalan untuk produk terpilih
		$rows = $this->db
			->where('id_produk', $id_produk)
			->order_by('tahun', 'ASC')
			->order_by('bulan', 'ASC')
			->get('peramalan')
			->result();

		$labels = array();
		$aktual = array();
		$peramalan = array();

		$total_ape = 0;
		$jumlah_data = 0;

		foreach ($rows as $row) {
			$bulan = (int) $row->bulan;
			$tahun = (int) $row->tahun;
			$nilai_aktual = (float) $row->dt_permintaan;
			$nilai_peramalan = (float) $row->dt_peramalan;

			// Label sumbu X
			$labels[] = isset($nama_bulan[$bulan])
				? $nama_bulan[$bulan] . ' ' . $tahun
				: $tahun;

			$aktual[] = $nilai_aktual;
			$peramalan[] = $nilai_peramalan;

			// MAPE hanya dihitung jika nilai aktual > 0
			if ($nilai_aktual > 0) {
				$total_ape += abs(
					($nilai_aktual - $nilai_peramalan) / $nilai_aktual
				) * 100;

				$jumlah_data++;
			}
		}

		$per = $jumlah_data - 1;

		$mape = $jumlah_data > 0
			? round($total_ape / $per, 2)
			: null;

		$response = array(
			'labels' => $labels,
			'aktual' => $aktual,
			'peramalan' => $peramalan,
			'mape' => $mape,
			'ttl_ape' => $total_ape,
			'jml_data' => $jumlah_data

		);

		return $this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
}

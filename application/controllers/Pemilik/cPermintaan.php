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
	public function cetak_laporan()
	{
		require('asset/fpdf/fpdf.php');

		// intance object dan memberikan pengaturan halaman PDF
		$pdf = new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();


		$pdf->SetFont('Times', 'B', 14);
		// $pdf->Image('asset/logo.png', 10, 3, 28);
		$pdf->Cell(200, 5, 'TOKO SIMPANG TIGA', 0, 1, 'C');
		$pdf->SetFont('Times', '', 10);
		$pdf->Cell(200, 20, 'Kuningan, Kabupaten Kuningan Jawa Barat', 0, 0, 'C');

		$pdf->SetLineWidth(1);
		$pdf->Line(10, 43, 200, 43);
		$pdf->SetLineWidth(0);
		$pdf->Line(10, 42, 200, 42);
		$pdf->Cell(10, 30, '', 0, 1);



		$pdf->SetFont('Times', 'B', 14);
		$pdf->Cell(190, 10, 'LAPORAN PERMINTAAN PRODUK', 0, 1, 'C');
		$pdf->SetFont('Times', '', 12);
		$pdf->SetFont('Times', '', 10);

		$pdf->Cell(10, 10, '', 0, 1);
		$pdf->SetFont('Times', 'B', 9);
		$pdf->Cell(20, 7, 'No.', 1, 0, 'C');
		$pdf->Cell(40, 7, 'Tanggal Permintaan', 1, 0, 'C');
		$pdf->Cell(70, 7, 'Produk', 1, 0, 'C');
		$pdf->Cell(50, 7, 'Jumlah Permintaan', 1, 1, 'C');

		$pdf->SetFont('Times', '', 9);

		$data = $this->db->query("SELECT * FROM `permintaan` JOIN detail_permintaan ON permintaan.id_permintaan=detail_permintaan.id_permintaan JOIN produk ON detail_permintaan.id_produk=produk.id_produk")->result();

		$no = 1;
		foreach ($data as $key => $value) {
			$pdf->Cell(20, 7, $no++, 1, 0, 'R');
			$pdf->Cell(40, 7, $value->tgl_permintaan, 1, 0);
			$pdf->Cell(70, 7, $value->nama_produk, 1, 0, 'C');
			$pdf->Cell(50, 7, number_format($value->qty) . ' ' . $value->keterangan, 1, 1, 'C');
		}

		$pdf->SetFont('Times', '', 9);
		$pdf->Cell(40, 7, '', 0, 1, 'C');
		$pdf->Cell(40, 7, '', 0, 1, 'C');

		$pdf->Cell(95, 7, 'Kuningan, ' . date('j F Y'), 0, 1, 'C');

		$pdf->Cell(95, 7, 'Pemilik', 0, 1, 'C');
		$pdf->Cell(95, 10, '', 0, 1, 'C');

		$pdf->SetFont('Times', 'B', 9);

		$pdf->Cell(95, 7, '(....................)', 0, 0, 'C');

		$pdf->Output();
	}
}

/* End of file cPermintaan.php */

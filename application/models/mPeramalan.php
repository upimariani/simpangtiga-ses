<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mPeramalan extends CI_Model
{
	public function produk()
	{
		$this->db->select('*');
		$this->db->from('produk');
		return $this->db->get()->result();
	}
	public function view_peramalan($id)
	{
		$this->db->select('*');
		$this->db->from('peramalan');
		$this->db->join('produk', 'produk.id_produk = peramalan.id_produk', 'left');
		$this->db->where('peramalan.id_produk', $id);
		return $this->db->get()->result();
	}

	//mengambil data analisis
	public function periode()
	{
		return $this->db->query("SELECT MONTH(tgl_permintaan) as periode FROM `permintaan` GROUP BY MONTH(tgl_permintaan), YEAR(tgl_permintaan)")->result();
	}
	public function cek_data_peramalan($id_produk)
	{
		return $this->db->query("SELECT * FROM `peramalan` WHERE id_produk='" . $id_produk . "'")->row();
	}
	public function dt_aktual($id_produk)
	{
		return $this->db->query("SELECT SUM(qty) as jumlah, MONTH(tgl_permintaan) as periode, YEAR(tgl_permintaan) as tahun, id_produk FROM `permintaan` JOIN detail_permintaan ON permintaan.id_permintaan=detail_permintaan.id_permintaan WHERE id_produk='" . $id_produk . "' GROUP BY MONTH(tgl_permintaan), YEAR(tgl_permintaan), id_produk ORDER BY tahun, periode ASC")->result();
	}
	public function dt_peramalan_sebelumnya($id_produk, $periode)
	{
		return $this->db->query("SELECT * FROM `peramalan` WHERE id_produk='" . $id_produk . "' AND bulan='" . $periode . "'")->row();
	}

	//action peramalan
	public function insert_peramalan($data)
	{
		$this->db->insert('peramalan', $data);
	}
	public function update_dt_aktual($id_produk, $periode, $data)
	{
		$this->db->where('id_produk', $id_produk);
		$this->db->where('bulan', $periode);
		$this->db->update('peramalan', $data);
	}
}

/* End of file mPeramalan.php */

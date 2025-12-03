<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cLogin extends CI_Controller
{

	public function index()
	{
		$this->load->view('vLogin');
	}
	public function proses()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->db->query("SELECT * FROM `user` WHERE username='" . $username . "' AND password='" . $password . "'")->row();
		if ($query) {
			$array = array(
				'id_user' => $query->id_user
			);

			$this->session->set_userdata($array);

			if ($query->level_user == '1') {
				redirect('Admin/cDashboard');
			} else if ($query->level_user == '2') {
				redirect('Gudang/cDashboard');
			} else if ($query->level_user == '3') {
				redirect('Pemilik/cDashboard');
			} else {
				redirect('Supplier/cDashboard');
			}
		} else {
			$this->session->set_flashdata('error', 'Username dan Password Anda Salah!');
			redirect('cLogin');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->set_flashdata('success', 'Anda berhasil logout!');
		redirect('cLogin');
	}
}

/* End of file cLogin.php */

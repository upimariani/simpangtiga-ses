<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cUser extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mUser');
	}

	public function index()
	{
		$data = array(
			'user' => $this->mUser->select()
		);
		$this->load->view('Admin/Layout/head');
		$this->load->view('Admin/Layout/aside');
		$this->load->view('Admin/User/vUser', $data);
		$this->load->view('Admin/Layout/footer');
	}
	public function create()
	{
		$this->form_validation->set_rules('nama', 'Nama User', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('level', 'Level User', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('Admin/Layout/head');
			$this->load->view('Admin/Layout/aside');
			$this->load->view('Admin/User/vTambahUser');
			$this->load->view('Admin/Layout/footer');
		} else {
			$data = array(
				'nama_user' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'level_user' => $this->input->post('level')
			);
			$this->mUser->create($data);
			$this->session->set_flashdata('success', 'Data User Berhasil Disimpan!');
			redirect('Admin/cUser');
		}
	}
	public function edit($id)
	{
		$this->form_validation->set_rules('nama', 'Nama User', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('level', 'Level User', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'user' => $this->mUser->get_data($id)
			);
			$this->load->view('Admin/Layout/head');
			$this->load->view('Admin/Layout/aside');
			$this->load->view('Admin/User/vEditUser', $data);
			$this->load->view('Admin/Layout/footer');
		} else {
			$data = array(
				'nama_user' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'level_user' => $this->input->post('level')
			);
			$this->mUser->update($id, $data);
			$this->session->set_flashdata('success', 'Data User Berhasil Disimpan!');
			redirect('Admin/cUser');
		}
	}
	public function delete($id)
	{
		$this->mUser->delete($id);
		$this->session->set_flashdata('success', 'Data User berhasil dihapus!');
		redirect('Admin/cUser');
	}
}

/* End of file cUser.php */

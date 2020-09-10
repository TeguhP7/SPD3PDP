<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyedia extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Penyedia_model');
		$this->load->library('pagination');

		if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
			redirect('/');
		}
	}

	function index()
	{
		$config['base_url'] = site_url('Penyedia/index'); //site url
		$config['total_rows'] = $this->db->count_all('penyedia'); //total row
		$config['per_page'] = 5;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		// Membuat Style pagination untuk BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		//panggil function 
		$data['data'] = $this->Penyedia_model->pagination($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		//$data['Penyedia'] = $this->Penyedia_model->ambil_data();
		$this->load->view('Penyedia/penyedia_list', $data);
	}

	function tambah()
	{

		$data = array(
			'nama_penyedia' => set_value('nama_penyedia'),
			'alamat_penyedia' => set_value('alamat_penyedia'),
			'id_penyedia' => set_value('id_penyedia'),
			'button' => 'Tambah',
			'action' => site_url('Penyedia/tambah_aksi'),

		);
		$this->load->view('Penyedia/penyedia_form', $data);
	}

	function tambah_aksi()
	{
		$data = array(
			'nama_penyedia' => $this->input->post('nama_penyedia'),
			'alamat_penyedia' => $this->input->post('alamat_penyedia'),

		);
		$this->Penyedia_model->tambah_data($data);
		redirect(site_url('Penyedia'));
	}
	function delete($id)
	{
		$this->Penyedia_model->hapus_data($id);
		redirect(site_url('Penyedia'));
	}

	function edit($id)
	{
		$pyd = $this->Penyedia_model->ambil_data_id($id);
		$data = array(
			'nama_penyedia' => set_value('nama_penyedia', $pyd->nama_penyedia),
			'alamat_penyedia' => set_value('alamat_penyedia', $pyd->alamat_penyedia),
			'id_penyedia' => set_value('id_penyedia', $pyd->id_penyedia),
			'button' => 'Edit',
			'action' => site_url('Penyedia/edit_aksi'),

		);
		$this->load->view('Penyedia/penyedia_form', $data);
	}
	function edit_aksi()
	{
		$data = array(
			'nama_penyedia' => $this->input->post('nama_penyedia'),
			'alamat_penyedia' => $this->input->post('alamat_penyedia'),

		);
		$id = $this->input->post('id');
		$this->Penyedia_model->edit_data($id, $data);
		redirect(site_url('Penyedia'));
	}
}

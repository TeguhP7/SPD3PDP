<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model');
		$this->load->library('pagination');

		if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
			redirect('/');
		}
	}
	function index()
	{
		$config['base_url'] = site_url('Pegawai/index'); //site url
		$config['total_rows'] = $this->db->count_all('pegawai'); //total row
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
		$data['data'] = $this->Pegawai_model->pagination($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		//$data['Pegawai'] = $this->Pegawai_model->ambil_data();
		$this->load->view('Pegawai/pegawai_list', $data);
	}

	function tambah()
	{
		$data = array(
			'nama_pegawai' => set_value('nama_pegawai'),
			'notelp_pegawai' => set_value('notelp_pegawai'),
			'alamat_pegawai' => set_value('alamat_pegawai'),
			'id_pegawai' => set_value('id_pegawai'),
			'button' => 'Tambah',
			'action' => site_url('Pegawai/tambah_aksi'),
		);
		$this->load->view('Pegawai/pegawai_form', $data);
	}

	function tambah_aksi()
	{
		$data = array(
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'notelp_pegawai' => $this->input->post('notelp_pegawai'),
			'alamat_pegawai' => $this->input->post('alamat_pegawai'),
		);
		$this->Pegawai_model->tambah_data($data);
		redirect(site_url('Pegawai'));
	}

	function delete($id)
	{
		$this->Pegawai_model->hapus_data($id);
		redirect(site_url('Pegawai'));
	}

	function edit($id)
	{
		$kry = $this->Pegawai_model->ambil_data_id($id);
		$data = array(
			'nama_pegawai' => set_value('nama_pegawai', $kry->nama_pegawai),
			'notelp_pegawai' => set_value('notelp_pegawai', $kry->notelp_pegawai),
			'alamat_pegawai' => set_value('alamat_pegawai', $kry->alamat_pegawai),
			'id_pegawai' => set_value('id_pegawai', $kry->id_pegawai),
			'button' => 'Edit',
			'action' => site_url('Pegawai/edit_aksi'),

		);
		$this->load->view('Pegawai/pegawai_form', $data);
	}
	function edit_aksi()
	{
		$data = array(
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'notelp_pegawai' => $this->input->post('notelp_pegawai'),
			'alamat_pegawai' => $this->input->post('alamat_pegawai'),
		);
		$id = $this->input->post('id');
		$this->Pegawai_model->edit_data($id, $data);
		redirect(site_url('Pegawai'));
	}
}

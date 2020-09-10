<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Barang_model');
		$this->load->model('Penyedia_model');
		$this->load->library('pagination');
		if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
			redirect('/');
		}
	}
	function index()
	{
		$config['base_url'] = site_url('Barang/index'); //site url
		$config['total_rows'] = $this->db->count_all('barang'); //total row
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
		$data['data'] = $this->Barang_model->pagination($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		// $data['Barang'] = $this->Barang_model->ambil_data();

		$this->load->view('Barang/barang_list', $data);
	}

	function tambah()
	{
		$data = array(
			'nama_barang' => set_value('nama_barang'),
			'jenis_barang' => set_value('jenis_barang'),
			'id_barang' => set_value('id_barang'),
			'id_penyedia' => set_value('id_penyedia'),
			'penyedia' => $this->Penyedia_model->ambil_data(),
			'jumlah' => set_value('jumlah'),
			'button' => 'Tambah',
			'action' => site_url('Barang/tambah_aksi'),
		);
		$this->load->view('Barang/barang_form', $data);
	}

	function tambah_aksi()
	{
		$data = array(
			'nama_barang' => $this->input->post('nama_barang'),
			'jenis_barang' => $this->input->post('jenis_barang'),
			'id_penyedia' => $this->input->post('id_penyedia'),
			'jumlah' => $this->input->post('jumlah'),
		);
		$this->Barang_model->tambah_data($data);
		redirect(site_url('Barang'));
	}
	function delete($id)
	{
		$this->Barang_model->hapus_data($id);
		redirect(site_url('Barang'));
	}

	function edit($id)
	{
		$brg = $this->Barang_model->ambil_data_id($id);
		$data = array(
			'nama_barang' => set_value('nama_barang', $brg->nama_barang),
			'jenis_barang' => set_value('jenis_barang', $brg->jenis_barang),
			'id_barang' => set_value('id_barang', $brg->id_barang),
			'penyedia' => $this->Penyedia_model->ambil_data(),
			'id_penyedia' => set_value('id_penyedia', $brg->id_penyedia),
			'jumlah' => set_value('jumlah', $brg->jumlah),
			'button' => 'Edit',
			'action' => site_url('Barang/edit_aksi'),

		);
		$this->load->view('Barang/barang_form', $data);
	}
	function edit_aksi()
	{
		$data = array(
			'nama_barang' => $this->input->post('nama_barang'),
			'jenis_barang' => $this->input->post('jenis_barang'),
			'id_penyedia' => $this->input->post('id_penyedia'),
			'jumlah' => $this->input->post('jumlah'),
		);
		$id = $this->input->post('id');
		$this->Barang_model->edit_data($id, $data);
		redirect(site_url('Barang'));
	}
}

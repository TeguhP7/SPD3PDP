<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam_barang extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Pinjam_barang_model');
		$this->load->library('pagination');

		if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
			redirect('/');
		}
	}

	function index()
	{
		$config['base_url'] = site_url('Pinjam_barang/index'); //site url
		$config['total_rows'] = $this->db->count_all('pinjam_barang'); //total row
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
		$data['data'] = $this->Pinjam_barang_model->pagination($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		//$data['Pinjam_barang'] = $this->Pinjam_barang_model->ambil_data();
		$this->load->view('Pinjam_barang/pinjam_barang_list', $data);
	}

	function tambah()
	{
		$data = array(
			'nama_barang' => set_value('nama_barang'),
			'jumlah' => set_value('jumlah'),
			'harga_sewa' => set_value('harga_sewa'),
			'keterangan_lain' => set_value('keterangan_lain'),
			'id_pinjam_barang' => set_value('id_pinjam_barang'),
			'button' => 'Tambah',
			'action' => site_url('Pinjam_barang/tambah_aksi'),

		);
		$data['Pinjam_barang'] = $this->Pinjam_barang_model->ambil_data();
		$this->load->view('Pinjam_barang/pinjam_barang_form', $data);
	}

	function tambah_aksi()
	{
		$data = array(
			'nama_barang' => $this->input->post('nama_barang'),
			'jumlah' => $this->input->post('jumlah'),
			'harga_sewa' => $this->input->post('harga_sewa'),
			'keterangan_lain' => $this->input->post('keterangan_lain'),
		);
		$this->Pinjam_barang_model->tambah_data($data);
		redirect(site_url('Pinjam_barang'));
	}
	function delete($id)
	{
		$this->Pinjam_barang_model->hapus_data($id);
		redirect(site_url('Pinjam_barang'));
	}

	function edit($id)
	{
		$pjm_brng = $this->Pinjam_barang_model->ambil_data_id($id);
		$data = array(
			'nama_barang' => set_value('nama_barang', $pjm_brng->nama_barang),
			'jumlah' => set_value('jumlah', $pjm_brng->jumlah),
			'harga_sewa' => set_value('harga_sewa', $pjm_brng->harga_sewa),
			'keterangan_lain' => set_value('keterangan_lain', $pjm_brng->keterangan_lain),
			'id_pinjam_barang' => set_value('id_pinjam_barang', $pjm_brng->id_pinjam_barang),
			'button' => 'Edit',
			'action' => site_url('Pinjam_barang/edit_aksi'),

		);
		$this->load->view('Pinjam_barang/pinjam_barang_form', $data);
	}
	function edit_aksi()
	{
		$data = array(
			'nama_barang' => $this->input->post('nama_barang'),
			'jumlah' => $this->input->post('jumlah'),
			'harga_sewa' => $this->input->post('harga_sewa'),
			'keterangan_lain' => $this->input->post('keterangan_lain'),
		);
		$id = $this->input->post('id_pinjam_barang');
		$this->Pinjam_barang_model->edit_data($id, $data);
		redirect(site_url('Pinjam_barang'));
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Peminjaman_model');
		$this->load->model('Pinjam_barang_model');
		$this->load->library('pagination');

		if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
			redirect('/');
		}
	}

	function index()
	{
		$config['base_url'] = site_url('Peminjaman/index'); //site url
		$config['total_rows'] = $this->db->count_all('peminjaman'); //total row
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
		$data['data'] = $this->Peminjaman_model->pagination($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		// $data['Peminjaman'] = $this->Peminjaman_model->ambil_data();
		$this->load->view('Peminjaman/peminjaman_list', $data);
	}

	function tambah()
	{
		$data = array(
			'nama_peminjam' => set_value('nama_peminjam'),
			'nama_barang' => set_value('nama_barang'),
			'jumlah' => set_value('jumlah'),
			'harga_sewa' => set_value('harga_sewa'),
			'tanggal_peminjaman' => set_value('tanggal_peminjaman'),
			'tanggal_pengembalian' => set_value('tanggal_pengembalian'),
			'status' => set_value('status'),
			'id_peminjaman' => set_value('id_peminjaman'),
			'id_pinjam_barang' => set_value('id_pinjam_barang'),
			'pinjam_barang' => $this->Pinjam_barang_model->ambil_data(),
			'button' => 'Tambah',
			'action' => site_url('Peminjaman/tambah_aksi'),

		);
		$this->load->view('Peminjaman/peminjaman_form', $data);
	}

	function tambah_aksi()
	{
		$data = array(
			'nama_peminjam' => set_value('nama_peminjam'),
			'id_pinjam_barang' => $this->input->post('id_pinjam_barang'),
			'jumlah' => set_value('jumlah'),
			'tanggal_peminjaman' => set_value('tanggal_peminjaman'),
			'tanggal_pengembalian' => set_value('tanggal_pengembalian'),
			'status' => set_value('status'),
		);
		$this->Peminjaman_model->tambah_data($data);
		redirect(site_url('Peminjaman'));
	}
	function delete($id)
	{
		$this->Peminjaman_model->hapus_data($id);
		redirect(site_url('Peminjaman'));
	}

	function edit($id)
	{
		$pjm = $this->Peminjaman_model->ambil_data_id($id);
		$data = array(
			'nama_peminjam' => set_value('nama_peminjam', $pjm->nama_peminjam),
			'jumlah' => set_value('jumlah', $pjm->jumlah),
			'tanggal_peminjaman' => set_value('tanggal_peminjaman', $pjm->tanggal_peminjaman),
			'tanggal_pengembalian' => set_value('tanggal_pengembalian', $pjm->tanggal_pengembalian),
			'status' => set_value('status', $pjm->status),
			'id_peminjaman' => set_value('id_peminjaman', $pjm->id_peminjaman),
			'pinjam_barang' => $this->Pinjam_barang_model->ambil_data(),
			'id_pinjam_barang' => set_value('id_pinjam_barang', $pjm->id_pinjam_barang),
			'button' => 'Edit',
			'action' => site_url('Peminjaman/edit_aksi'),

		);
		$this->load->view('Peminjaman/peminjaman_form_edit', $data);
	}
	function edit_aksi()
	{
		$data = array(
			'nama_peminjam' => $this->input->post('nama_peminjam'),
			'jumlah' => $this->input->post('jumlah'),
			'tanggal_peminjaman' => $this->input->post('tanggal_peminjaman'),
			'tanggal_pengembalian' => $this->input->post('tanggal_pengembalian'),
			'status' => $this->input->post('status'),
			'id_pinjam_barang' => $this->input->post('id_pinjam_barang'),
		);
		$id = $this->input->post('id_peminjaman');
		$this->Peminjaman_model->edit_data($id, $data);
		redirect(site_url('Peminjaman'));
	}
}

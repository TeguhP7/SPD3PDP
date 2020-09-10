<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Pembelian_model');
		$this->load->model('Barang_model');
		$this->load->model('Pegawai_model');
		$this->load->library('pagination');
		if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
			redirect('/');
		}
	}

	function index()
	{
		$config['base_url'] = site_url('Pembelian/index'); //site url
		$config['total_rows'] = $this->db->count_all('pembelian'); //total row
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
		$data['data'] = $this->Pembelian_model->pagination($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		//$data['Pembelian'] = $this->Pembelian_model->ambil_data();

		$this->load->view('Pembelian/pembelian_list', $data);
	}

	function tambah()
	{
		$data = array(
			'tanggal' => set_value('tanggal'),
			'harga_satuan' => set_value('harga_satuan'),
			'jumlah_barang' => set_value('jumlah_barang'),
			'total_belanja' => set_value('total_belanja'),
			'id_barang' => set_value('id_barang'),
			'id_pembelian' => set_value('id_pembelian'),
			'barang' => $this->Barang_model->ambil_data(),
			'pegawai' => $this->Pegawai_model->ambil_data(),
			'button' => 'Tambah',
			'action' => site_url('Pembelian/tambah_aksi'),

		);
		$this->load->view('Pembelian/pembelian_form', $data);
	}

	function tambah_aksi()
	{
		$data = array(
			'id_pegawai' => $this->input->post('id_pegawai'),
			'tanggal' => $this->input->post('tanggal'),
			'harga_satuan' => $this->input->post('harga_satuan'),
			'jumlah_barang' => $this->input->post('jumlah_barang'),
			'total_belanja' => $this->input->post('total_belanja'),
			'id_barang' => $this->input->post('id_barang'),
		);
		$this->Pembelian_model->tambah_data($data);
		redirect(site_url('Pembelian'));
	}
	function delete($id)
	{
		$this->Pembelian_model->hapus_data($id);
		redirect(site_url('Pembelian'));
	}

	function edit($id)
	{
		$pmb = $this->Pembelian_model->ambil_data_id($id);
		$data = array(
			'tanggal' => set_value('tanggal', $pmb->tanggal),
			'harga_satuan' => set_value('harga_satuan', $pmb->harga_satuan),
			'jumlah_barang' => set_value('jumlah_barang', $pmb->jumlah_barang),
			'total_belanja' => set_value('total_belanja', $pmb->total_belanja),
			'id_barang' => set_value('id_barang', $pmb->id_barang),
			'id_pembelian' => set_value('id_pembelian', $pmb->id_pembelian),
			'barang' => $this->Barang_model->ambil_data(),
			'pegawai' => $this->Pegawai_model->ambil_data(),
			'button' => 'Edit',
			'action' => site_url('Pembelian/edit_aksi'),
		);
		$this->load->view('Pembelian/pembelian_form', $data);
	}
	function edit_aksi()
	{
		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'harga_satuan' => $this->input->post('harga_satuan'),
			'jumlah_barang' => $this->input->post('jumlah_barang'),
			'total_belanja' => $this->input->post('total_belanja'),
			'id_barang' => $this->input->post('id_barang'),
		);
		$id = $this->input->post('id');
		$this->Pembelian_model->edit_data($id, $data);
		redirect(site_url('Pembelian'));
	}
}

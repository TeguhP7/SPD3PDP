<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventaris extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Inventaris_model');
		$this->load->library('pagination');

		if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
			redirect('/');
		}
	}

	function index()
	{
		$config['base_url'] = site_url('Inventaris/index'); //site url
		$config['total_rows'] = $this->db->count_all('inventaris'); //total row
		$config['per_page'] = 5;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		// Membuat Style pagination untuk BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = '>>';
		$config['prev_link']        = '<<';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>>></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		//panggil function 
		$data['data'] = $this->Inventaris_model->pagination($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		//load view 
		//$data['Inventaris'] = $this->Inventaris_model->ambil_data();
		$this->load->view('Inventaris/inventaris_list', $data);
	}

	function tambah()
	{
		$data = array(
			'nama_aset' => set_value('nama_aset'),
			'jumlah' => set_value('jumlah'),
			'kondisi' => set_value('kondisi'),
			'keterangan_lain' => set_value('keterangan_lain'),
			'id' => set_value('id'),
			'button' => 'Tambah',
			'action' => site_url('Inventaris/tambah_aksi'),

		);
		$this->load->view('Inventaris/inventaris_form', $data);
	}

	function tambah_aksi()
	{
		$data = array(
			'nama_aset' => $this->input->post('nama_aset'),
			'jumlah' => $this->input->post('jumlah'),
			'kondisi' => $this->input->post('kondisi'),
			'keterangan_lain' => $this->input->post('keterangan_lain'),
		);
		$this->Inventaris_model->tambah_data($data);
		redirect(site_url('Inventaris'));
	}
	function delete($id)
	{
		$this->Inventaris_model->hapus_data($id);
		redirect(site_url('Inventaris'));
	}

	function edit($id)
	{
		$ivs = $this->Inventaris_model->ambil_data_id($id);
		$data = array(
			'nama_aset' => set_value('nama_aset', $ivs->nama_aset),
			'jumlah' => set_value('jumlah', $ivs->jumlah),
			'kondisi' => set_value('kondisi', $ivs->kondisi),
			'keterangan_lain' => set_value('keterangan_lain', $ivs->keterangan_lain),
			'id' => set_value('id', $ivs->id),
			'button' => 'Edit',
			'action' => site_url('Inventaris/edit_aksi'),

		);
		$this->load->view('Inventaris/inventaris_form', $data);
	}
	function edit_aksi()
	{
		$data = array(
			'nama_aset' => $this->input->post('nama_aset'),
			'jumlah' => $this->input->post('jumlah'),
			'kondisi' => $this->input->post('kondisi'),
			'keterangan_lain' => $this->input->post('keterangan_lain'),
		);
		$id = $this->input->post('id');
		$this->Inventaris_model->edit_data($id, $data);
		redirect(site_url('Inventaris'));
	}
}

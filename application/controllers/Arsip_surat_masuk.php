<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip_surat_masuk extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Arsip_surat_masuk_model');
        $this->load->library('pagination');

        if (!$this->session->userdata('logined') || $this->session->userdata('logined') != true) {
            redirect('/');
        }
    }

    function index()
    {
        $config['base_url'] = site_url('Arsip_surat_masuk/index'); //site url
        $config['total_rows'] = $this->db->count_all('arsip_surat_masuk'); //total row
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
        $data['data'] = $this->Arsip_surat_masuk_model->pagination($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['nama_file'] = $this->db->get_where('arsip_surat_masuk', 'nama_file');
        //load view 
        //$data['Inventaris'] = $this->Inventaris_model->ambil_data();
        $this->load->view('Arsip_surat/arsip_surat_masuk_list', $data);
    }

    function uploadImage()
    {
        $config['upload_path'] = './assets/images/arsip_surat_masuk/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['overwrite'] = true;
        $config['max_size']  = '5120';
        $config['remove_space'] = true;

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('input_gambar')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    // Fungsi untuk menyimpan data ke database
    // function save($upload)
    // {
    //     $data = array(
    //         'deskripsi' => $this->input->post('input_deskripsi'),
    //         'nama_file' => $upload['file']['file_name'],
    //         'ukuran_file' => $upload['file']['file_size'],
    //         'tipe_file' => $upload['file']['file_type']
    //     );

    //     $this->db->insert('gambar', $data);
    // }

    function download($id)
    {
        $sk = $this->Arsip_surat_masuk_model->ambil_data_nama_file($id);
        force_download('assets/images/arsip_surat_masuk/' . $sk, null);
    }

    function tambah_aksi()
    {
        $upload = $this->uploadImage();
        $data = array(
            'no_surat' => $this->input->post('no_surat'),
            'nama_surat' => $this->input->post('nama_surat'),
            'nama_file' => $upload['file']['file_name'],
            'ukuran' => $upload['file']['file_size'],
        );
        $this->Arsip_surat_masuk_model->tambah_data($data);
        redirect(site_url('Arsip_surat_masuk'));
    }

    function tambah()
    {
        $data = array(
            'no_surat' => set_value('no_surat'),
            'nama_surat' => set_value('nama_surat'),
            // 'ukuran' => set_value('ukuran'),
            'id_surat_masuk' => set_value('id_surat_masuk'),
            'button' => 'Tambah',
            'action' => site_url('Arsip_surat_masuk/tambah_aksi'),

        );
        if ($this->input->post('submit')) { // Jika user menekan tombol Submit (Simpan) pada form
            // lakukan upload file dengan memanggil function upload yang ada di GambarModel.php
            $upload = $this->uploadImage();

            if ($upload['result'] == "success") { // Jika proses upload sukses
                // Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
                $this->tambah_aksi($upload);

                redirect('Arsip_surat_masuk'); // Redirect kembali ke halaman awal / halaman view data
            } else { // Jika proses upload gagal
                $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
            }
        }

        $this->load->view('Arsip_surat/arsip_surat_masuk_form', $data);
    }

    function delete($id)
    {
        $this->Arsip_surat_masuk_model->hapus_data($id);
        redirect(site_url('Arsip_surat_masuk'));
    }

    function edit($id)
    {
        $sk = $this->Arsip_surat_masuk_model->ambil_data_id($id);
        $data = array(
            'no_surat' => set_value('no_surat', $sk->no_surat),
            'nama_surat' => set_value('nama_surat', $sk->nama_surat),
            // 'ukuran' => set_value('ukuran', $sk->ukuran),
            'id_surat_masuk' => set_value('id_surat_masuk', $sk->id_surat_masuk),
            'button' => 'Edit',
            'action' => site_url('Arsip_surat_masuk/edit_aksi'),

        );
        if ($this->input->post('submit')) { // Jika user menekan tombol Submit (Simpan) pada form
            // lakukan upload file dengan memanggil function upload yang ada di GambarModel.php
            $upload = $this->uploadImage();

            if ($upload['result'] == "success") { // Jika proses upload sukses
                // Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
                $this->edit_aksi($upload);

                redirect('Arsip_surat_masuk'); // Redirect kembali ke halaman awal / halaman view data
            } else { // Jika proses upload gagal
                $data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
            }
        }

        $this->load->view('Arsip_surat/arsip_surat_masuk_form', $data);
    }

    function edit_aksi()
    {
        $upload = $this->uploadImage();
        $data = array(
            'no_surat' => $this->input->post('no_surat'),
            'nama_surat' => $this->input->post('nama_surat'),
            'ukuran' => $this->input->post('ukuran'),
            'nama_file' => $upload['file']['file_name'],
            'ukuran' => $upload['file']['file_size'],
        );
        $id = $this->input->post('id_surat_masuk');
        $this->Arsip_surat_masuk_model->edit_data($id, $data);
        redirect(site_url('Arsip_surat_masuk'));
    }
}

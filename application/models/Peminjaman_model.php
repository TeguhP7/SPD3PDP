<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Peminjaman_model extends CI_Model
{

	public $nama_table = 'peminjaman';
	public $id         = 'id_peminjaman';
	public $order	   = 'DESC';

	function __construct()
	{
		parent::__construct();
	}

	function pagination($limit, $start)
	{
		$this->db->distinct();
		$this->db->select('p.id_peminjaman, p.nama_peminjam, b.nama_barang, p.jumlah, b.harga_sewa, p.tanggal_peminjaman, p.tanggal_pengembalian, p.status');
		$this->db->from('peminjaman p');
		$this->db->join('pinjam_barang b', 'p.id_pinjam_barang = b.id_pinjam_barang');
		return $this->db->get($this->nama_table, $limit, $start)->result();
	}

	function ambil_data()
	{
		$this->db->distinct();
		$this->db->select('p.id_peminjaman, p.nama_peminjam, b.nama_barang, p.jumlah, b.harga_sewa, p.tanggal_peminjaman, p.tanggal_pengembalian, p.status');
		$this->db->from('peminjaman p');
		$this->db->join('pinjam_barang b', 'p.id_pinjam_barang = b.id_pinjam_barang');
		return $this->db->get($this->nama_table)->result();
	}

	function ambil_data_id($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->nama_table)->row();
	}

	function cek_login($username, $password)
	{
		$this->db->where('nama', $username);
		$this->db->where('prodi', $password);
		return $this->db->get($this->nama_table)->row();
	}

	//untuk insert data seluruh mahasiswa
	function tambah_data($data)
	{
		$this->db->insert($this->nama_table, $data);
		return $this->db->get($this->nama_table)->result();
	}

	//untuk hapus data seluruh mahasiswa
	function hapus_data($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->nama_table);
	}

	function edit_data($id, $data)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->nama_table, $data);
	}
}

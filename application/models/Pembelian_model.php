<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pembelian_model extends CI_Model
{

	public $nama_table = 'pembelian';
	public $id         = 'id_pembelian';
	public $order	   = 'DESC';

	function __construct()
	{
		parent::__construct();
	}

	function pagination($limit, $start)
	{
		$this->db->distinct();
		$this->db->select('p.id_pembelian, b.nama_barang, p.tanggal, p.harga_satuan, p.jumlah_barang, p.total_belanja , k.nama_pegawai');
		$this->db->from('pembelian p');
		$this->db->join('barang b', 'p.id_barang = b.id_barang');
		$this->db->join('pegawai k', 'k.id_pegawai = p.id_pegawai');
		return $this->db->get($this->nama_table, $limit, $start)->result();
	}

	function ambil_data()
	{
		$this->db->distinct();
		$this->db->select('p.id_pembelian, b.nama_barang, p.tanggal, p.harga_satuan, p.jumlah_barang, p.total_belanja , k.nama_pegawai');
		$this->db->from('pembelian p');
		$this->db->join('barang b', 'p.id_barang = b.id_barang');
		$this->db->join('pegawai k', 'k.id_pegawai = p.id_pegawai');
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

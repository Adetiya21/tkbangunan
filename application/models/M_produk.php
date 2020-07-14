<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_produk extends CI_Model {

	var $tabel = 'tb_produk';

	public function json($kat) {
		$this->datatables->select('tb_produk.id as id_produk, tb_produk.id_kategori, tb_produk.nama, tb_produk.gambar, tb_produk.slug,tb_produk.tgl,
			tb_kategori_produk.nama as nama_kategori');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_kategori_produk', 'tb_produk.id_kategori=tb_kategori_produk.id');
		$this->datatables->where('tb_produk.id_kategori', $kat);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id_produk,slug');
		return $this->datatables->generate();
	}

}

/* End of file M_produk.php */
/* Location: ./application/models/M_produk.php */
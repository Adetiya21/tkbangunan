<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

	var $table = 'tb_barang';

	public function json() {
		$this->datatables->select('tb_barang.id_barang, tb_barang.id_satuan, tb_barang.nama_barang as nama,
			tb_barang.harga_barang, tb_barang.stok_barang, tb_barang.deskripsi, tb_barang.gambar, tb_barang.slug, tb_barang.tgl,
			tb_satuan.satuan');
		$this->datatables->from($this->table);
		$this->datatables->join('tb_satuan', 'tb_barang.id_satuan=tb_satuan.id_satuan');
		$this->datatables->add_column('view', '<div align="center">
			<div class="dropdown-warning dropdown open">
				<button class="btn btn-sm btn-warning dropdown-toggle waves-effect waves-light " type="button" id="dropdown-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</button>
				<div class="dropdown-menu" aria-labelledby="dropdown-3" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
				<a class="dropdown-item waves-light waves-effect" href="'.site_url('barang/detail/$2').'" target="_blank"><span class="fa fa-eye"></span> Detail</a>
				<a class="dropdown-item waves-light waves-effect" href="'.site_url('admin/barang/edit/$1').'"><span class="fa fa-edit"></span> Edit</a>
				<a class="dropdown-item waves-light waves-effect" href="javascript:void(0)" title="Hapus" onclick="hapus($1)"><span class="fa fa-trash"></span> Hapus</a>
				<hr style="margin-top:0;margin-bottom:0">
				<a class="dropdown-item waves-light waves-effect" href="'.site_url('admin/gambar/barang/$2').'" title="Tambah Gambar"><span class="fa fa-plus"></span> Gambar Lain</a>
				</div>
			</div>
			</div>', 'id_barang,slug');
		return $this->datatables->generate();
	}

}

/* End of file M_barang.php */
/* Location: ./application/models/M_barang.php */
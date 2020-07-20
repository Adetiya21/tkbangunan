<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gambar extends CI_Model {

	// deklarasi var table
	var $table = 'tb_gambar_barang';

	public function json($where='') {
		$this->datatables->select('id_gambar,id_barang,gambar');
		$this->datatables->where($where);
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '<div align="">
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id_gambar');
		return $this->datatables->generate();
	}	

}

/* End of file M_gambar.php */
/* Location: ./application/models/M_gambar.php */
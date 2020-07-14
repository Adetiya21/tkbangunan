<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_fasilitas extends CI_Model {

	var $table = 'tb_fasilitas';

	public function json() {
		$this->datatables->select('id,judul,deskripsi,icon');
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id,slug');
		return $this->datatables->generate();
	}

}

/* End of file M_fasilitas.php */
/* Location: ./application/models/M_fasilitas.php */
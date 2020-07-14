<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_header extends CI_Model {

	var $table = 'tb_header';

	public function json() {
		$this->datatables->select('id,gambar');
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

}

/* End of file M_header.php */
/* Location: ./application/models/M_header.php */
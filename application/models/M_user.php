<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	// deklarasi var table
	var $table = 'tb_user';

	// load database user yang diakses oleh admin
	public function json() {
		$this->datatables->select('id_user as id,nama,no_telp,email,alamat,slug,password');
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '<div align="center">
			<a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a>
			<a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
			</div>', 'id');
		return $this->datatables->generate();
	}

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */
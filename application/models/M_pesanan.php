<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesanan extends CI_Model {

	var $table = 'tb_invoice';

	public function json() {
		$this->datatables->select("tb_invoice.id_invoice,tb_invoice.no_invoice,CONCAT(tb_user.nama,'<hr style=\"margin-top:2px;margin-bottom:2px;\">',tb_invoice.email_user, '<br>', tb_user.no_telp) as user,tb_invoice.total,tb_invoice.tgl,tb_invoice.status");
		$this->datatables->from('tb_invoice');
		$this->datatables->join('tb_user','tb_user.email = tb_invoice.email_user');;
		$this->datatables->add_column('view', '
			<div align="center">
			<div class="dropdown-warning dropdown open">
				<button class="btn btn-sm btn-warning dropdown-toggle waves-effect waves-light " type="button" id="dropdown-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Action</button>
				<div class="dropdown-menu" aria-labelledby="dropdown-3" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
				<a class="dropdown-item waves-light waves-effect" href="'.site_url("admin/pesanan/detail/$1").'"><span class="fa fa-eye"></span> Detail</a>
				<a class="dropdown-item waves-light waves-effect" href="javascript:void(0)" title="Edit" onclick="edit($2)"><span class="fa fa-edit"></span> Edit</a>
				<a class="dropdown-item waves-light waves-effect" href="javascript:void(0)" title="Hapus" onclick="hapus($2)"><span class="fa fa-trash"></span> Hapus</a>
				</div>
			</div>
			</div>', 'no_invoice,id_invoice');
		return $this->datatables->generate();
	}
// <a class="btn btn-warning btn-rounded btn-sm" href="javascript:void(0)" title="Edit" onclick="edit($1)"> <span class="fa fa-edit"></span></a><a class="btn btn-danger btn-rounded btn-sm" href="javascript:void(0)" title="Hapus" onclick="hapus($1)" > <span class="fa fa-trash"></span></a>
}

/* End of file M_pesanan.php */
/* Location: ./application/models/M_pesanan.php */
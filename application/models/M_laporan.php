<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

	var $table = 'tb_invoice';

	// fun load database keseluruhan
	public function json() {
		$this->datatables->select("tb_invoice.id_invoice,tb_invoice.no_invoice, tb_user.nama as user,tb_invoice.total,tb_invoice.tgl,tb_invoice.status");
		$this->datatables->from('tb_invoice');
		$this->datatables->where("status", 'Selesai');
		$this->datatables->join('tb_user','tb_user.email = tb_invoice.email_user');
		$this->datatables->add_column('view', '
			<div align="center"><a class="btn btn-warning btn-rounded btn-sm" href="'.site_url("admin/pesanan/detail/$1").'"><span class="fa fa-eye"></span> Detail</a>
			</div>', 'no_invoice,id_invoice');
		return $this->datatables->generate();
	}

	// fun load database berdasarkan bulan
	public function json_bulan($bln) {
		$this->datatables->select("tb_invoice.id_invoice,tb_invoice.no_invoice,tb_user.nama as user,tb_invoice.total,tb_invoice.tgl,tb_invoice.status");
		$this->datatables->from('tb_invoice');
		$this->datatables->where("DATE_FORMAT(tgl,'%m')", $bln);
		$this->datatables->where("status", 'Selesai');
		$this->datatables->join('tb_user','tb_user.email = tb_invoice.email_user');
		$this->datatables->add_column('view', '
			<div align="center"><a class="btn btn-warning btn-rounded btn-sm" href="'.site_url("admin/pesanan/detail/$1").'"><span class="fa fa-eye"></span> Detail</a>
			</div>', 'no_invoice,id_invoice');
		return $this->datatables->generate();
	}

}

/* End of file M_laporan.php */
/* Location: ./application/models/M_laporan.php */
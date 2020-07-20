<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pesanan_saya extends CI_Model {

	var $table = 'tb_invoice';

	public function json() {
		$this->datatables->select("tb_invoice.id_invoice,tb_invoice.no_invoice,tb_invoice.tgl,tb_invoice.status
			,tb_invoice.total");
		$where = array('email_user' => $this->session->userdata('email'), );
		$this->datatables->where($where);
		$this->datatables->from($this->table);
		$this->datatables->add_column('view', '
			<a href="'.site_url("pesanan-saya/detail/$1").'" class="btn red_button2 btn-sm" title="View"><i class="fa fa-eye"></i> &nbsp;Detail</a>
			', 'no_invoice');
		$this->datatables->join('tb_pesanan','tb_pesanan.no_invoice = tb_invoice.no_invoice');
		$this->datatables->group_by('tb_invoice.no_invoice');
		return $this->datatables->generate();
	}

}

/* End of file M_pesanan_saya.php */
/* Location: ./application/models/M_pesanan_saya.php */
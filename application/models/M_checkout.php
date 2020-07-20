<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_checkout extends CI_Model {

    // membuat no invoice
	function find_invoice()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(no_invoice,4)) AS kd_max FROM tb_invoice WHERE DATE(tgl)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'TB-'.date('dmy').$kd;
	}

}

/* End of file M_checkout.php */
/* Location: ./application/models/M_checkout.php */
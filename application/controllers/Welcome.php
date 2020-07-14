<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct(); 
	}

	public function get_tokens($value="") {
		if ($this->session->userdata('bayand') == "SudahMasukMas") {
			echo $this->security->get_csrf_hash();
		}
	}

	public function index()
	{
		// $data['title'] = 'Selamat Datang';
		// $data['header'] = $this->DButama->GetDB('tb_header');
		// $data['kategori'] = $this->DButama->GetDB('tb_kategori_produk');
		// $data['fasilitas'] = $this->DButama->GetDB('tb_fasilitas');
		// $data['tentang'] = $this->DButama->GetDB('tb_tentang')->row();
		// $data['produk'] = $this->db->order_by('tgl', 'desc');
		// $data['produk'] = $this->db->limit('8');
		// $data['produk'] = $this->DButama->GetDB('tb_produk');
		// $this->load->view('utama/temp-header', $data);
		// $this->load->view('utama/v_index',$data);
		// $this->load->view('utama/temp-footer');

		echo "masih tahap pengembangan";
	}

}

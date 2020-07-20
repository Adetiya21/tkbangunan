<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak_toko extends CI_Controller {

	// fun halaman kontak toko
	public function index()
	{
		$data['title'] = 'Tentang Toko';
		$data['ten'] = $this->DButama->GetDB('tb_toko')->row();  //load database tb_toko
		// fun view
		$this->load->view('utama/temp-header', $data);
		$this->load->view('utama/v_kontak-toko');
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Kontak_toko.php */
/* Location: ./application/controllers/Kontak_toko.php */
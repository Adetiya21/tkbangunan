<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang_toko extends CI_Controller {

	// fun halaman tentang toko
	public function index()
	{
		$data['title'] = 'Tentang Toko';
		$data['ten'] = $this->DButama->GetDB('tb_toko')->row();  //load database tb_toko
		// fun view
		$this->load->view('utama/temp-header', $data);
		$this->load->view('utama/v_tentang-toko');
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Tentang-toko.php */
/* Location: ./application/controllers/Tentang-toko.php */
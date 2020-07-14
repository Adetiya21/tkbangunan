<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang_kami extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Tentang Kami';
		$data['tentang'] = $this->DButama->GetDB('tb_tentang')->row();
		$this->load->view('utama/temp-header', $data);
		$this->load->view('utama/v_tentang-kami',$data);
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Tentang.php */
/* Location: ./application/controllers/Tentang.php */
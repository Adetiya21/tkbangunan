<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Temukan_kami extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Temukan Kami';
		$data['tentang'] = $this->DButama->GetDB('tb_tentang')->row();
		$this->load->view('utama/temp-header', $data);
		$this->load->view('utama/v_temukan-kami',$data);
		$this->load->view('utama/temp-footer');
	}

}

/* End of file Temukankami.php */
/* Location: ./application/controllers/Temukankami.php */
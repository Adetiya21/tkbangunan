<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_saya extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// cek session user sudah login
		if ($this->session->userdata('user_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Anda Harus Login!');";
			echo 'window.location.assign("'.site_url("i/keranjang-belanja").'")
			</script>';
		}
	}

	// fun halaman akun saya
	public function index()
	{
		$data['title'] = 'Akun Saya';
		$data['ten'] = $this->DButama->GetDB('tb_toko')->row();  //load database tb_toko
		$data['users'] = $this->DButama->GetDBWhere('tb_user', array('email' => $this->session->userdata('email'), ))->row();
		// fun view
		$this->load->view('utama/temp-header', $data);
		$this->load->view('utama/v_akun-saya');
		$this->load->view('utama/temp-footer');
	}

	// proses edit data
	public function proses_edit($value='')
	{
		$this->load->library('form_validation');
		if ($this->input->method() == "post") {
			$config = array(
				array('field' => 'nama','label' => "Nama",'rules' => 'required' ),
				array('field' => 'alamat','label' => "Alamat",'rules' => 'required' ),
				array('field' => 'no_telp','label' => "No Telp",'rules' => 'required' ),
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
			{
				// menampilkan pesan error
				$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>'.validation_errors().'</strong> 
						</div>');
				redirect('akun-saya','refresh');
			}else{
				$data = array(
					'nama' => $this->input->post('nama'),
					'no_telp' => $this->input->post('no_telp'),
					'alamat' => $this->input->post('alamat'),
				);
				$where = array('email' => $this->session->userdata('email') );
				// fun update
				$this->DButama->UpdateDB('tb_user',$where,$data);
				// menyimpan nama session
				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
				// menampilkan pesan sukses
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Akun anda sudah diperbaharui</strong> 
							</div>');
				redirect('akun-saya','refresh');
			}
		}
	}

	// cek password dengan database
	public function cek_password()
	{
		if ($this->input->method() == "post") {
			if (!empty($this->input->post('old_password'))) {
				$old_password = $this->input->post('old_password');
				$query = $this->DButama->GetDBWhere('tb_user',array('email' => $this->session->userdata('email'), ));
				$row = $query->row();
				if (password_verify($old_password, $row->password)) {
					echo 'true'; 
				} else {
					echo 'false'; 
				}
			}
		}
	}

	// proses ganti password
	public function proses_ganti_password()
	{
		if ($this->input->method() == "post") {
			$old_password = $this->input->post('old_password');
			$pass=$this->input->post('password');
			$where = array('email' => $this->session->userdata('email') );
			$query = $this->DButama->GetDBWhere('tb_user',$where);
			$row = $query->row();
			if (password_verify($old_password, $row->password)) {
				$hash=password_hash($pass, PASSWORD_DEFAULT);	
				$data = array(
					'password' => $hash,
				);
				$this->DButama->UpdateDB('tb_user',$where,$data);
				echo "<script>
				alert('Change Password Success');";
				echo 'window.location.assign("'.site_url("akun-saya").'")
				</script>';	
			} else {
				echo "<script>
				alert('Change Password Failed');";
				echo 'window.location.assign("'.site_url("akun-saya").'")
				</script>';	
			}
		}
	}

}

/* End of file Akun_saya.php */
/* Location: ./application/controllers/Akun_saya.php */
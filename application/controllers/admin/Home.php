<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	var $table = 'tb_admin';

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
	}

	public function index()
	{
		$title = array('title' => 'Dashboard', );
		$data['header'] = $this->DButama->GetDB('tb_header')->num_rows();
		$data['kategori'] = $this->DButama->GetDB('tb_kategori_produk')->num_rows();
		$data['kat'] = $this->DButama->GetDB('tb_kategori_produk');
		$data['produk'] = $this->DButama->GetDB('tb_produk')->num_rows();
		$data['pr'] = $this->db->order_by('tgl', 'desc');
		$data['pr'] = $this->db->limit('5');
		$data['pr'] = $this->DButama->GetDB('tb_produk');
		$data['admin'] = $this->DButama->GetDB('tb_admin')->num_rows();
		$data['fasilitas'] = $this->DButama->GetDB('tb_fasilitas');
		$this->load->view('admin/temp-header',$title);
		$this->load->view('admin/v_index',$data);
		$this->load->view('admin/temp-footer');
	}

	public function profil($id)
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('id'=> $id));
		if ($cek->num_rows() == 1) {
			$title = array('title' => 'Profil', );
			$data['profil'] = $cek->row();
			$this->load->view('admin/temp-header',$title);
			$this->load->view('admin/v_profil',$data);
			$this->load->view('admin/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

	function edit_profil()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'nama','label' => 'Nama','rules' => 'required',),
			array('field' => 'username','label' => 'Username','rules' => 'required'),
			array('field' => 'password','label' => 'Password','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('admin/home/profil/'.$this->session->userdata('id').'','refresh');
		}else{
			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
				$pass=$this->input->post('password');
				$hash=password_hash($pass, PASSWORD_DEFAULT);
				$data = array(
					'nama' => $this->input->post('nama'),
					'username' => $this->input->post('username'),
					'password' => $hash
				);
				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
				$this->DButama->UpdateDB($this->table,$where,$data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success background-success">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="icofont icofont-close-line-circled text-white"></i>
						</button>Akun anda telah diperbaharui</code></div>');
				redirect('admin/home/profil/'.$this->session->userdata('id').'','refresh');
		
		}
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/admin/Home.php */
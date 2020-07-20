<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_user';

	public function __construct()
	{
		parent::__construct();
		// cek session admin sudah login
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('m_user','Model');  //load model m_user
	}

	// fun json datatables data user
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	// fun halaman user
	public function index()
	{
		$data['title'] = 'Data User';
		// fun view user
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_user',$data);
		$this->load->view('admin/temp-footer');
	}

	// fun proses tambah
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			// cek email yang terdaftar
			$DataUser  = array('email' => $this->input->post('email'));
			if ($this->DButama->GetDBWhere($this->table,$DataUser)->num_rows() == 1) {
				$data = array();
				$data['inputerror'][] = 'email';
				$data['error_string'][] = 'Email sudah ada / tidak boleh duplikat';
				$data['status'] = FALSE;
				echo json_encode($data);
				exit();
			}else{
				$pass='12345';  //default password
				$hash=password_hash($pass, PASSWORD_DEFAULT); //membuat encrypt password
				$data = array(
					'id_user' => $this->input->post('id_user'),
					'nama' => $this->input->post('nama'),
					'email' => $this->input->post('email'),
					'no_telp' => $this->input->post('no_telp'),
					'alamat' => $this->input->post('alamat'),
					'password' => $hash
				);
				// fungsi tambah admin
				$this->DButama->AddDB($this->table,$data);
				echo json_encode(array("status" => TRUE));
			}
		}
	}

	// proses hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id_user' => $id);  //filter berdasarkan id
			$this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			$this->DButama->DeleteDB($this->table,$where);  //fun delete
			echo json_encode(array("status" => TRUE));
		}
	}

	// fun edit
	public function edit($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id_user' => $id);  //filter berdasarkan id
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			echo json_encode($data);
		}
	}

	// proses update
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$where  = array('id_user' => $this->input->post('id_user'));  //filter berdasarkan id
			$query = $this->DButama->GetDBWhere($this->table,$where);  //load database table tb_pelatih
			$row = $query->row();

			$where_nama = array('nama' => $this->input->post('nama'));  //filter berdasarkan nama
			$cari_nama = $this->DButama->GetDBWhere($this->table,$where_nama); //load database table tb_pelatih
        	
        	// jika nama tidak di ganti
			if ($row->nama == $this->input->post('nama')) {
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);  //membuat data slug berdasarkan nama
				$data = array(
					'email' => $this->input->post('email'),
					'nama' => $this->input->post('nama'),
					'no_telp' => $this->input->post('no_telp'),
					'alamat' => $this->input->post('alamat'),
					'slug' => $slug
				);

				// fun update
				$this->DButama->UpdateDB($this->table,$where,$data);
				echo json_encode(array("status" => TRUE));
	        
	        // jika nama di ganti ternyata duplikat
			} else if ($cari_nama->num_rows() == 1) {
            	$data = array();
				$data['inputerror'][] = 'nama';
				$data['error_string'][] = 'Nama sudah ada / tidak boleh duplikat';
				$data['status'] = FALSE;
				echo json_encode($data);
				exit();
	        
	        // jika nama di ganti
			}else{
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);  //membuat data slug berdasarkan nama
				$data = array(
					'email' => $this->input->post('email'),
					'nama' => $this->input->post('nama'),
					'no_telp' => $this->input->post('no_telp'),
					'alamat' => $this->input->post('alamat'),
					'slug' => $slug
				);

				// fun update
				$this->DButama->UpdateDB($this->table,$where,$data);
				echo json_encode(array("status" => TRUE));
			}
		}
	}

}

/* End of file User.php */
/* Location: ./application/controllers/admin/User.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	var $table = 'tb_admin';

	function __construct()
	{
		parent::__construct();
		// cek session admin sudah login
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->helper('rupiah');  //load helper rupiah
	}

	// fun halaman home
	public function index()
	{
		$title = array('title' => 'Dashboard', );
		$data['admin'] = $this->DButama->GetDB('tb_admin')->num_rows();  //menghitung jumlah admin
		$data['user'] = $this->DButama->GetDB('tb_user')->num_rows();  //menghitung jumlah user
		$data['satuan'] = $this->DButama->GetDB('tb_satuan')->num_rows();  //menghitung jumlah isi tabel satuan
		$data['barang'] = $this->DButama->GetDB('tb_barang')->num_rows();  //menghitung jumlah isi tabel barang
		$data['invoice'] = $this->DButama->GetDB('tb_invoice')->num_rows();  //menghitung jumlah isi tabel invoice

		//menghitung jumlah pesanan bersadarkan status pesanan
		$data['imk'] = $this->DButama->GetDBWhere('tb_invoice', array('status' => 'Menunggu Konfirmasi'))->num_rows();
		$data['ip'] = $this->DButama->GetDBWhere('tb_invoice', array('status' => 'Proses'))->num_rows();
		$data['idk'] = $this->DButama->GetDBWhere('tb_invoice', array('status' => 'Dikirim'))->num_rows();
		$data['isl'] = $this->DButama->GetDBWhere('tb_invoice', array('status' => 'Selesai'))->num_rows();
		$data['idb'] = $this->DButama->GetDBWhere('tb_invoice', array('status' => 'Dibatalkan'))->num_rows();

		//load tabel invoice
		$query = $this->db->select('tb_invoice.no_invoice,tb_invoice.total,tb_user.nama'); 
        $query = $this->db->from('tb_invoice');
        $query = $this->db->join('tb_user', 'tb_invoice.email_user = tb_user.email');
        $query = $this->db->order_by('tgl', 'desc');   //mengurutkan data berdasarkan tgl terbaru
		$query = $this->db->limit('5');  //filter tampilan data sebanyak 5
		$query = $this->db->get();
        $data['pesanan'] = $query;

        $data['usr'] = $this->db->order_by('id_user', 'desc');   //mengurutkan data berdasarkan id terbaru
		$data['usr'] = $this->db->limit('5');  //filter tampilan data sebanyak 5
        $data['usr'] = $this->DButama->GetDB('tb_user');  //menghitung jumlah admin
				
		$this->load->view('admin/temp-header',$title);
		$this->load->view('admin/v_index',$data);
		$this->load->view('admin/temp-footer');
	}

	// fun halaman profil
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

	// proses edit profil
	function edit_profil()
	{
		//load form validasi
		$this->load->library('form_validation');

		// field form validasi
		$config = array(
			array('field' => 'nama','label' => 'Nama','rules' => 'required',),
			array('field' => 'username','label' => 'Username','rules' => 'required'),
			array('field' => 'password','label' => 'Password','rules' => 'required')
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			// menampilkan pesan error
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>'.validation_errors().'</strong> 
							</div>');
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
				// menyimpan data session
				$sess_data['nama'] = $this->input->post('nama');
				$this->session->set_userdata($sess_data);
				// fun update data
				$this->DButama->UpdateDB($this->table,$where,$data);
				// menampilkan pesan sukses
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
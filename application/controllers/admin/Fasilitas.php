<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas extends CI_Controller {

	var $table = 'tb_fasilitas';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('m_fasilitas','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	public function index()
	{
		$data['title'] = 'Daftar Fasilitas';
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_fasilitas');
		$this->load->view('admin/temp-footer');
	}

	//hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$this->DButama->GetDBWhere($this->table,$where)->row();
			$this->DButama->DeleteDB($this->table,$where);
			echo json_encode(array("status" => TRUE));
		}
	}

    //input
	public function tambah()
	{
		if ($this->input->is_ajax_request()) {
			$this->_validate();
			$DataUser  = array('judul' => $this->input->post('judul'));
			if ($this->DButama->GetDBWhere($this->table,$DataUser)->num_rows() == 1) {
				$data = array();
				$data['inputerror'][] = 'judul';
				$data['error_string'][] = 'Judul sudah ada / tidak boleh duplikat';
				$data['status'] = FALSE;
				echo json_encode($data);
				exit();
			}else{
				$this->_validate();
				$data = array(
					'judul' => $this->input->post('judul'),
					'deskripsi' => $this->input->post('deskripsi'),
					'icon' => $this->input->post('icon'),
				);
				
				$this->DButama->AddDB($this->table,$data);
				echo json_encode(array("status" => TRUE));
				redirect('admin/fasilitas','refresh');
			}

		}

	}

    //edit
	public function edit($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();
			echo json_encode($data);
		}
	}
	
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$this->_validate();
			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$where_username = array('nama' => $this->input->post('nama'));
			$cari_username = $this->DButama->GetDBWhere($this->table,$where_username);
        // jika username tidak di ganti
			if ($row->nama == $this->input->post('nama')) {
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$data = array(
					'nama' => $this->input->post('nama'),
					'slug' => $slug,
				);

				if($this->input->post('remove_photo')) // hapus gambar
				{
					if(file_exists('assets/assets/img/fasilitas/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
						unlink('assets/assets/img/fasilitas/'.$this->input->post('remove_photo'));
					$data['gambar'] = '';
				}

				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
            		//hapus gambar lama di folder
					$row_cek = $this->DButama->GetDBWhere($this->table,$where)->row();
					if(file_exists('assets/assets/img/fasilitas/'.$row_cek->gambar) && $row_cek->gambar)
						unlink('assets/assets/img/fasilitas/'.$row_cek->gambar);
					$data['gambar'] = $upload;
				}

				$this->DButama->UpdateDB($this->table,$where,$data);
				echo json_encode(array("status" => TRUE));
        // jika username di ganti ternyata duplikat
			}elseif ($cari_username->num_rows() == 1) {
            # code...
				$data = array();
				$data['inputerror'][] = 'nama';
				$data['error_string'][] = 'Nama Kategory sudah ada / tidak boleh duplikat';
				$data['status'] = FALSE;
				echo json_encode($data);
				exit();
        // jika username di ganti
			}else{
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$data = array(
					'nama' => $this->input->post('nama'),
					'slug' => $slug,
				);
				
				if($this->input->post('remove_photo')) // hapus gambar
				{
					if(file_exists('assets/assets/img/fasilitas/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
						unlink('assets/assets/img/fasilitas/'.$this->input->post('remove_photo'));
					$data['gambar'] = '';
				}

				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
            		//hapus gambar lama di folder
					$row_cek = $this->DButama->GetDBWhere($this->table,$where)->row();
					if(file_exists('assets/assets/img/fasilitas/'.$row_cek->gambar) && $row_cek->gambar)
						unlink('assets/assets/img/fasilitas/'.$row_cek->gambar);
					$data['gambar'] = $upload;
				}
				$this->DButama->UpdateDB($this->table,$where,$data);
				echo json_encode(array("status" => TRUE));
			}
		}

	}

    private function _validate()
    {
    	$data = array();
    	$data['error_string'] = array();
    	$data['inputerror'] = array();
    	$data['status'] = TRUE;

    	if($this->input->post('judul') == '')
    	{
    		$data['inputerror'][] = 'judul';
    		$data['error_string'][] = 'Judul tidak boleh kosong';
    		$data['status'] = FALSE;
    	} 

    	if($data['status'] === FALSE)
    	{
    		echo json_encode($data);
    		exit();
    	}
    }

}

/* End of file Fasilitas.php */
/* Location: ./application/controllers/admin/Fasilitas.php */
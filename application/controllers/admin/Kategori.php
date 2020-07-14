<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	var $table = 'tb_kategori_produk';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('m_kategori','Model');
	}

	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	public function index()
	{
		$data['title'] = 'Daftar Kategori Produk';
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_kategori');
		$this->load->view('admin/temp-footer');
	}

	//hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id' => $id);
			$this->DButama->GetDBWhere($this->table,$where)->row();
			$tes = $this->DButama->GetDBWhere($this->table,$where)->row();
			$query = $this->DButama->DeleteDB($this->table,$where);
			if($query){
                unlink("assets/assets/img/kategori/".$tes->gambar);
            }
			echo json_encode(array("status" => TRUE));
		}
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Produk';
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_kategori-tambah');
		$this->load->view('admin/temp-footer');
	}

	//proses tambah
	public function proses()
	{
		$this->load->library('form_validation');
		$config = array(
			array('field' => 'nama','label' => "Nama Kategori",'rules' => 'required' ),
			array('field' => 'deskripsi','label' => "Deskripsi",'rules' => 'required' ),
			array('field' => 'spesifikasi','label' => "Spesifikasi",'rules' => 'required' ),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>'.validation_errors().'</strong> 
						</div>');
			$this->_Values();
			redirect('admin/kategori/tambah','refresh');
		} else {
			$slug = url_title($this->input->post('nama'), 'dash', TRUE);
			$data = array(
				'nama' => $this->input->post('nama'),
				'deskripsi' => $this->input->post('deskripsi'),
				'spesifikasi' => $this->input->post('spesifikasi'),
				'slug' => $slug
			);
			
			$gambar = $_FILES['gambar']['name'];
			if(!empty($gambar))
			{
				$upload = $this->_do_upload();
				$data['gambar'] = $upload;
			}

			$this->DButama->AddDB($this->table,$data);
			redirect('admin/kategori','refresh');
		}	
	}

	public function edit($id)
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('id'=> $id));
		if ($cek->num_rows() == 1) {
			$data['kategori'] = $cek->row();
			$data['title'] = 'Edit Kategori Produk';
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_kategori-edit',$data);
			$this->load->view('admin/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

	public function proses_edit()
	{
		$this->load->library('form_validation');
		$config = array(
			array('field' => 'nama','label' => "Nama Kategori",'rules' => 'required' ),
			array('field' => 'deskripsi','label' => "Deskripsi",'rules' => 'required' ),
			array('field' => 'spesifikasi','label' => "Spesifikasi",'rules' => 'required' ),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('admin/kategori/edit/'.$this->input->post('id'),'refresh');
		}else{
			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$where_nama = array('nama' => $this->input->post('nama'));
			$cari_nama = $this->DButama->GetDBWhere($this->table,$where_nama);

			 // jika nama tidak di ganti
			if ($row->nama == $this->input->post('nama')) {
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$data = array(
					'nama' => $this->input->post('nama'),
					'deskripsi' => $this->input->post('deskripsi'),
					'spesifikasi' => $this->input->post('spesifikasi'),
					'slug' => $slug
				);

				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
					$data['gambar'] = $upload;
				}

				$this->DButama->UpdateDB($this->table,$where,$data);
				redirect('admin/kategori','refresh');
        // jika nama di ganti
			} else {
				$slug = url_title($this->input->post('nama'), 'dash', TRUE);
				$data = array(
					'nama' => $this->input->post('nama'),
					'deskripsi' => $this->input->post('deskripsi'),
					'spesifikasi' => $this->input->post('spesifikasi'),
					'slug' => $slug
				);
				
				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
					$data['gambar'] = $upload;
				}

				$this->DButama->UpdateDB($this->table,$where,$data);
				redirect('admin/kategori','refresh');
			}
		}
	}

	private function _do_upload()
	{
		$config['upload_path']   = 'assets/assets/img/kategori/';
		$config['allowed_types'] = 'jpg|png';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name']  = TRUE;
        $config['file_name']     = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('gambar')) //upload and validate
        {
        	$data['inputerror'][] = 'gambar';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate()
    {
    	$data = array();
    	$data['error_string'] = array();
    	$data['inputerror'] = array();
    	$data['status'] = TRUE;

    	if($this->input->post('nama') == '')
    	{
    		$data['inputerror'][] = 'nama';
    		$data['error_string'][] = 'First name is required';
    		$data['status'] = FALSE;
    	} 

    	if($data['status'] === FALSE)
    	{
    		echo json_encode($data);
    		exit();
    	}
    }

}

/* End of file Kategori.php */
/* Location: ./application/controllers/admin/Kategori.php */
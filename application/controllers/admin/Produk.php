<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	var $table = 'tb_produk';
	var $tablekat = 'tb_kategori_produk';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
		$this->load->model('m_produk','Model');
		$this->load->library(array(
			'custom_upload',
			'form_validation'
		));
	}

	public function json($kat) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json($kat);
		}
	}

	public function index()
	{
		redirect('admin/kategori','refresh');
	}

	public function i($id_kategori)
	{
		$cek = $this->DButama->GetDBWhere($this->tablekat,array('id'=> $id_kategori));
		if ($cek->num_rows() == 1) {
			$data['kat'] = $id_kategori;
			$data['title'] = 'Daftar Produk';
			$data['kategori'] = $this->DButama->GetDB('tb_kategori_produk');
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_produk');
			$this->load->view('admin/temp-footer');
		} else {
			redirect('error404','refresh');
		}
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
                unlink("assets/assets/img/produk/".$tes->gambar);
            }
			echo json_encode(array("status" => TRUE));
		}
	}

    //tambah
	public function tambah()
	{
		$data['title'] = 'Tambah Produk';
		$data['kat'] =$this->db->order_by('nama', 'asc');
		$data['kat'] = $this->DButama->GetDB('tb_kategori_produk');
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_produk-tambah',$data);
		$this->load->view('admin/temp-footer');
	}

	//proses tambah
	public function proses()
	{
		$this->load->library('form_validation');

		$config = array(
			array('field' => 'id_kategori','label' => "Kategori Produk",'rules' => 'required' ),
			// array('field' => 'nama','label' => 'Nama Produk','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>'.validation_errors().'</strong> 
						</div>');
			$this->_Values();
			redirect('admin/produk/tambah','refresh');
		} else {
			$id_kategori = $this->input->post('id_kategori');
			$file = $this->custom_upload->multiple_upload('gambar', array(
				'upload_path' => 'assets/assets/img/produk/',
				'allowed_types' => 'jpg|jpeg|png', // etc
				'quality' => '50%',
				'width' => 500,
                'height' => 500
			));

			$data = array();
			foreach ($file as $f) {
				array_push($data, array(
					'id_kategori' => $this->input->post('id_kategori'),
					'tgl' => date('Y-m-d H:i:s'),
					'gambar' => $f
				));
			}
			$this->db->insert_batch($this->table, $data);

			// $this->DButama->AddDB($this->table,$data);
			redirect('admin/produk/i/'.$id_kategori,'refresh');
		}
	}

	private function _do_upload()
	{
		$config['upload_path']   = 'assets/assets/img/produk/';
		$config['allowed_types'] = 'jpg|jpeg|png';
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

    private function _Values()
	{
		$this->session->set_flashdata('id_kategori', set_value('id_kategori') );
	}

}

/* End of file Produk.php */
/* Location: ./application/controllers/admin/Produk.php */
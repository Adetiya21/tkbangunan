<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_barang';

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
		$this->load->model('m_barang','Model');  //load model m_barang
		
	}

	// fun json datatables
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	// fun halaman barang
	public function index()
	{
		$title = array('title' => 'Daftar Barang', );
		// fun view
		$this->load->view('admin/temp-header',$title);
		$this->load->view('admin/v_barang');
		$this->load->view('admin/temp-footer');
	}

	// fun hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id_barang' => $id); //filter berdasarkan id
			$this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			$tes = $this->DButama->GetDBWhere($this->table,$where)->row();
			$query = $this->DButama->DeleteDB($this->table,$where);  //fun delete
			// menghapus gambar di folder
			if($query){
                unlink("assets/back-end/images/produk/".$tes->gambar);
            }			
			echo json_encode(array("status" => TRUE));
		}
	}

	// fun halaman tambah barang
	public function tambah()
	{
		$data['satuan'] =$this->db->order_by('satuan', 'asc');  //menampilkan kolom tertentu secara berurutan
		$data['satuan'] = $this->DButama->GetDB('tb_satuan');  //load database table tb_satuan
		$data['title'] = 'Tambah Data Barang';
		// fun view
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_barang-tambah',$data);
		$this->load->view('admin/temp-footer');
	}

	// proses tambah
	public function proses()
	{
		//load form validasi
		$this->load->library('form_validation');

		// field form validasi
		$config = array(
			array('field' => 'id_satuan','label' => "Satuan Barang",'rules' => 'required'),
			array('field' => 'nama_barang','label' => "Nama Barang",'rules' => 'required'),
			array('field' => 'stok_barang','label' => 'Stok Barang','rules' => 'required'),
			array('field' => 'harga_barang','label' => 'Harga Barang','rules' => 'required|numeric'),
			array('field' => 'deskripsi','label' => 'Deskripsi Barang','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			// menampilkan pesan error
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>'.validation_errors().'</strong> 
							</div>');
			$this->_Values();
			redirect('admin/barang/tambah','refresh');
		}else{
			// cek nama barang yang terdaftar
			$DataUser  = array('nama_barang' => $this->input->post('nama_barang'));
			if ($this->DButama->GetDBWhere($this->table,$DataUser)->num_rows() == 1) {
				$this->_Values();
				// menampilkan pesan error
				$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Nama Barang Sama / Tidak Boleh Duplikat</strong> 
						</div>');
				redirect('admin/barang/tambah','refresh');
			}else{
				$slug = url_title($this->input->post('nama_barang'), 'dash', TRUE);  //membuat data slug berdasarkan nama
				$data = array(
					'id_satuan' => $this->input->post('id_satuan'),
					'nama_barang' => $this->input->post('nama_barang'),
					'tgl' => date('Y-m-d H:i:s'),
					'harga_barang' => $this->input->post('harga_barang'),
					'stok_barang' => $this->input->post('stok_barang'),
					'deskripsi' => $this->input->post('deskripsi'),
					'slug' => $slug
				);
				
				// mengupload gambar
				$gambar = $_FILES['gambar']['name'];
				if(!empty($gambar))
				{
					$upload = $this->_do_upload();
					$data['gambar'] = $upload;
				}

				// fun tambah
				$this->DButama->AddDB($this->table,$data);
				redirect('admin/barang','refresh');
			}
		}
	}

	// fun halaman edit data
	public function edit($id)
	{
		$cek = $this->DButama->GetDBWhere($this->table,array('id_barang'=> $id));
		if ($cek->num_rows() == 1) {
			$data['barang'] = $cek->row();
			$data['title'] = 'Edit Data Barang';
			$data['satuan'] =$this->db->order_by('satuan', 'asc');  //menampilkan kolom tertentu secara berurutan
			$data['satuan'] = $this->DButama->GetDB('tb_satuan');  //load database table tb_satuan
			// fun view
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_barang-edit',$data);
			$this->load->view('admin/temp-footer');
		}else{
			redirect('error404','refresh');
		}	
	}

	// proses edit data
	public function proses_edit()
	{
		//load form validasi
		$this->load->library('form_validation');

		// field form validasi
		$config = array(
			array('field' => 'id_satuan','label' => "Satuan Barang",'rules' => 'required'),
			array('field' => 'nama_barang','label' => "Nama Barang",'rules' => 'required'),
			array('field' => 'stok_barang','label' => 'Stok Barang','rules' => 'required'),
			array('field' => 'harga_barang','label' => 'Harga Barang','rules' => 'required|numeric'),
			array('field' => 'deskripsi','label' => 'Deskripsi Barang','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			// menampilkan pesan error
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>'.validation_errors().'</strong> 
							</div>');
			$this->_Values();
			redirect('admin/barang/edit/'.$this->input->post('id_barang'),'refresh');
		}else{
			$where  = array('id_barang' => $this->input->post('id_barang'));  //menfilter berdasarkan id
			$query = $this->DButama->GetDBWhere($this->table,$where);  //load database tabel tb_barang
			$row = $query->row();
			$where_nama = array('nama_barang' => $this->input->post('nama_barang'));  //menfilter berdasarkan nama
			$cari_nama = $this->DButama->GetDBWhere($this->table,$where_nama);  //load database tabel tb_barang

			 // jika nama tidak di ganti
			if ($row->nama_barang == $this->input->post('nama_barang')) {
				$slug = url_title($this->input->post('nama_barang'), 'dash', TRUE);
				$data = array(
					'id_satuan' => $this->input->post('id_satuan'),
					'nama_barang' => $this->input->post('nama_barang'),
					'tgl' => date('Y-m-d H:i:s'),
					'harga_barang' => $this->input->post('harga_barang'),
					'stok_barang' => $this->input->post('stok_barang'),
					'deskripsi' => $this->input->post('deskripsi'),
					'slug' => $slug
				);

				// mengupload gambar
				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
					$data['gambar'] = $upload;
				}

				// fun update
				$this->DButama->UpdateDB($this->table,$where,$data);
				redirect('admin/barang','refresh');
	        
	        // jika nama di ganti
			}else{
				$slug = url_title($this->input->post('nama_barang'), 'dash', TRUE);
				$data = array(
					'id_satuan' => $this->input->post('id_satuan'),
					'nama_barang' => $this->input->post('nama_barang'),
					'tgl' => date('Y-m-d H:i:s'),
					'harga_barang' => $this->input->post('harga_barang'),
					'stok_barang' => $this->input->post('stok_barang'),
					'deskripsi' => $this->input->post('deskripsi'),
					'slug' => $slug
				);
				
				// mengupload gambar
				if(!empty($_FILES['gambar']['name']))
				{
					$upload = $this->_do_upload();
            		//hapus gambar lama di folder
					$row_cek = $this->DButama->GetDBWhere($this->table,$where)->row();
					if(file_exists('assets/back-end/images/produk/'.$row_cek->gambar) && $row_cek->gambar)
						unlink('assets/back-end/images/produk/'.$row_cek->gambar);
					$data['gambar'] = $upload;
				}

				// fun update
				$this->DButama->UpdateDB($this->table,$where,$data);
				redirect('admin/barang','refresh');
			}
		}
	}

	// proses upload gambar
	private function _do_upload()
	{
		$config['upload_path']   = 'assets/back-end/images/produk/';  //lokasi folder
		$config['allowed_types'] = 'jpg|png|jpeg';
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

    // fun value validasi
    private function _Values()
	{
		$this->session->set_flashdata('nama_barang', set_value('nama_barang') );
		$this->session->set_flashdata('id_satuan', set_value('id_satuan') );
		$this->session->set_flashdata('stok_barang', set_value('stok_barang') );
		$this->session->set_flashdata('harga_barang', set_value('harga_barang') );
		$this->session->set_flashdata('deskripsi', set_value('deskripsi') );
	}

}

/* End of file Barang.php */
/* Location: ./application/controllers/admin/Barang.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class I extends CI_Controller {

	function __construct()
	{
		parent::__construct(); 
		$this->load->helper('rupiah');
	}

	// token digunakan untuk javascript
	public function get_tokens($value="") {
		if ($this->session->userdata('bayand') == "SudahMasukMas") {
			echo $this->security->get_csrf_hash();
		}
	}

// <<------------------------ HALAMAN UTAMA ------------------------>>
	// fun halaman utama
	public function index($page=0)
	{
		$data['title'] = 'Selamat Datang';
		$data['ten'] = $this->DButama->GetDB('tb_toko')->row();  //load database tb_toko

		// load database barang
		$query =  $this->db->order_by('tgl', 'desc');
        $query = $this->DButama->GetDB('tb_barang');  //load database tb_barang
        $jml = $query;

        $config['base_url'] = base_url('').'i/index/';
        $config['total_rows'] = $jml->num_rows();;
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;

        /*Class bootstrap pagination yang digunakan*/
        $config['full_tag_open'] = "<ul class='pagination modal-2' style='position:relative; top:-25px;'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='page-item disabled'><li class='active'><a  style='background:#FF6347;color:#fff'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li class='page-item'>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li class='page-item'>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li class='page-item'>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li class='page-item'>";
        $config['last_tagl_close'] = "</li>";
        // membuat daftar bagian per halaman
        $this->pagination->initialize($config);
        $data['halaman']    = $this->pagination->create_links();

        $data['satuan'] = $this->DButama->GetDB('tb_satuan');  //load database tb_satuan

		$query = $this->db->order_by('tgl', 'desc');
        $query = $this->db->get('tb_barang', $config['per_page'], abs($page));
        $data['barang'] = $query;
        // fun view
        $this->load->view('utama/temp-header', $data);
		$this->load->view('utama/v_index',$data);
		$this->load->view('utama/temp-footer');
	}
// <<------------------------ HALAMAN UTAMA ------------------------>>

// <<------------------------  USER ------------------------>>
	// proses login user
	public function login()
	{
		// recaptcha google
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true) {
			// menampilkan pesan error
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Klik Recaptcha</strong> 
				</div>');
			redirect('','refresh');
		} else {
			if ($this->input->is_ajax_request()) {
				// load databases dengan filter email
				$query = $this->DButama->GetDBWhere('tb_user', array('email' => $this->input->post('email'), ));
				if ($query->num_rows() == 0 ) {
					// menampilkan pesan error
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Email / Password Tidak Ada</strong> 
						</div>');
					redirect('','refresh');
				}else{
					$hasil = $query->row();
					if (password_verify($this->input->post('password'), $hasil->password)) {
						foreach ($query->result() as $key ) {
							$sess_data['user_logged_in'] = "Sudah_Loggin";
							$sess_data['nama'] = $key->nama;
							$sess_data['email'] = $key->email;
							$sess_data['no_telp'] = $key->no_telp;
							$sess_data['alamat'] = $key->alamat;
							$sess_data['id_user'] = $key->id_user;
							// menyimpan data user ke session
							$this->session->set_userdata($sess_data);
							$this->session->unset_userdata('admin_logged_in');
							// cek alamat
							if ($key->alamat!=null) {
								echo json_encode(array("status" => TRUE));
							} else { 
								echo json_encode(array("status1" => TRUE));
							}
						}
					}
				}
			}
		}
	}

	// proses logout
	function logout()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
		redirect('','refresh');
	}
// <<------------------------  USER ------------------------>>

// <<------------------------ DAFTAR USER ------------------------>>
	// proses daftar
	public function proses_daftar()
	{
		// recaptcha google
		$recaptcha = $this->input->post('g-recaptcha-response');
		$response = $this->recaptcha->verifyResponse($recaptcha);
		if (!isset($response['success']) || $response['success'] <> true) {
			// menampilkan pesan error
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Klik Recaptcha</strong> 
				</div>');
			redirect('','refresh');
		} else {
			if ($this->input->is_ajax_request()) {
				// load databases dengan filter email
				$DataUser  = array('email' => $this->input->post('email'));
				if ($this->DButama->GetDBWhere('tb_user',$DataUser)->num_rows() == 1) {
					$data = array();
					$data['inputerror'][] = 'email';
					$data['error_string'][] = 'email sudah ada / tidak boleh duplikat';
					$data['status'] = FALSE;
					echo json_encode($data);
					exit();
				}else{
					$slug = url_title($this->input->post('nama'), 'dash', TRUE);
					$pass=$this->input->post('password');
					$hash=password_hash($pass, PASSWORD_DEFAULT);
					$data = array(
						'id_user' => $this->input->post('id_user'),
						'nama' => $this->input->post('nama'),
						'email' => $this->input->post('email'),
						'password' => $hash,
						'slug' => $slug
					);
					$this->DButama->AddDB('tb_user',$data);
					echo json_encode(array("status" => TRUE));
				}
			}
		}
	}
// <<------------------------ DAFTAR USER ------------------------>>

// <<------------------------ KERANJANG ------------------------>>
	// proses tambah kekeranjang dari index
	function tambah_keranjang()
    {
        if ($this->input->is_ajax_request()) {
            $where  = array('id_barang' => $this->input->post('id_barang') );
            $barang = $this->DButama->GetDBWhere('tb_barang', $where)->row();
            $data = array(
                'id' => $barang->id_barang,
                'qty'	=> 1,
                'price'	=> $barang->harga_barang,
                'name'	=> $barang->nama_barang,
                'slug'	=> $barang->slug,
                'image'	=> $barang->gambar,
                'id_satuan' => $barang->id_satuan,
            );
            // fun tambah cart
            $this->cart->insert($data);
	        $total_items = $this->cart->total_items(); //count total items
	        die(json_encode(array('items'=>$total_items))); //output json
        }
    }

    // proses tambah kekeranjang dari detail barang
	function tambah_keranjang_detail()
    {
        if ($this->input->is_ajax_request()) {
            $where  = array('id_barang' => $this->input->post('id_barang') );
            $barang = $this->DButama->GetDBWhere('tb_barang', $where)->row();
            $data = array(
                'id' => $barang->id_barang,
                'qty'	=> $this->input->post('qty'),
                'price'	=> $barang->harga_barang,
                'name'	=> $barang->nama_barang,
                'slug'	=> $barang->slug,
                'image'	=> $barang->gambar,
                'id_satuan' => $barang->id_satuan,
            );
            // fun tambah cart
            $this->cart->insert($data);
	        $total_items = $this->cart->total_items(); //count total items
	        die(json_encode(array('items'=>$total_items))); //output json
        }
    }

    // fun halaman keranjang belanja
    function keranjang_belanja()
	{
		$data['title']='Keranjang Belanja';
		$data['ten'] = $this->DButama->GetDB('tb_toko')->row();  //load database tb_toko
		$data['satuan'] = $this->DButama->GetDB('tb_satuan');  //load database tb_toko
		$this->load->view('utama/temp-header',$data);
		$this->load->view('utama/v_keranjang-belanja');
		$this->load->view('utama/temp-footer');
	}

	// fun update keranjang
	function update_keranjang()
	{
		$rowid = $this->input->post('rowid');
		$data = array(
			'rowid' => $rowid,
			'qty' => $this->input->post('qty'),
		);
		// fun update
		$this->cart->update($data);
		redirect('i/keranjang-belanja','refresh');
	}

	// fun hapus keranjang
	function delete_keranjang($rowid)
	{
		$data = array(
			'rowid'   => $rowid,
			'qty'     => 0,
		);
		// fun update
		$this->cart->update($data);
		redirect('i/keranjang-belanja','refresh');
	}

// <<------------------------ KERANJANG ------------------------>>


// <<------------------------ DETAIL BARANG ------------------------>>
	// fun detail barang
	public function detail($slug)
	{
		$cek = $this->DButama->GetDBWhere('tb_barang', array('slug' => $slug, ));
        if ($cek->num_rows() == 1) {
            $data_id = $cek->row()->id_barang;
            $nama_data = $cek->row()->nama_barang;
            $data['title']='Detail Barang | '.$nama_data;

            // load barang berdasarkan slug yang terpilih
            $where  = array('tb_barang.id_barang' => $data_id, );
            $query = $this->db->select('tb_barang.id_barang,tb_barang.nama_barang,tb_barang.deskripsi,tb_barang.harga_barang,tb_barang.stok_barang,tb_barang.tgl,tb_barang.gambar,tb_barang.slug,tb_satuan.satuan');
            $query = $this->db->where($where);
            $query = $this->db->from('tb_barang');
            $query = $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
            $query = $this->db->get();
            $data['barang'] = $query->row();

            // load gambar barang
            $query = $this->DButama->GetDBWhere('tb_gambar_barang', array('id_barang' => $data_id, ));
            $data['gmbr'] = $query;

            // load database barang untuk barang terbaru
			$query =  $this->db->order_by('tgl', 'desc');
			$query =  $this->db->limit('8');
	        $query = $this->DButama->GetDB('tb_barang');
	        $data['brg_terbaru'] = $query;

            $data['ten'] = $this->DButama->GetDB('tb_toko')->row();  //load database tb_toko
            $data['satuan'] = $this->DButama->GetDB('tb_satuan');  //load database tb_satuan
            $data['brg'] = $cek->row();  //load database tb_toko
            // fun view
            $this->load->view('utama/temp-header',$data);
            $this->load->view('utama/v_detail',$data);
            $this->load->view('utama/temp-footer');
        }else{
            redirect('error404','refresh');
        }
	}
// <<------------------------ DETAIL BARANG ------------------------>>

// <<------------------------ CARI BARANG ------------------------>>
	// fun cari barang
	public function cari($page=0)
    {
        $cari = $this->input->post('cari');
        $cek = $this->db->query("SELECT * from tb_barang where nama_barang like '%$cari%' ");
        if ($cek->num_rows() != 0) {
            $row = $cek->row();
            $data['slug']= $row->slug;
            
            $jml = $cek;
            $config['base_url'] = base_url('').'i/cari-barang/'.$cari;
            $config['total_rows'] = $jml->num_rows();;
           	$config['per_page'] = 10;
	        $config['uri_segment'] = 4;

            /*Class bootstrap pagination yang digunakan*/
	        $config['full_tag_open'] = "<ul class='pagination modal-2' style='position:relative; top:-25px;'>";
	        $config['full_tag_close'] ="</ul>";
	        $config['num_tag_open'] = '<li>';
	        $config['num_tag_close'] = '</li>';
	        $config['cur_tag_open'] = "<li class='page-item disabled'><li class='active'><a  style='background:#FF6347;color:#fff'>";
	        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
	        $config['next_tag_open'] = "<li class='page-item'>";
	        $config['next_tagl_close'] = "</li>";
	        $config['prev_tag_open'] = "<li class='page-item'>";
	        $config['prev_tagl_close'] = "</li>";
	        $config['first_tag_open'] = "<li class='page-item'>";
	        $config['first_tagl_close'] = "</li>";
	        $config['last_tag_open'] = "<li class='page-item'>";
	        $config['last_tagl_close'] = "</li>";

            // membuat daftar bagian per halaman
	        $this->pagination->initialize($config);
	        $data['halaman']    = $this->pagination->create_links();

	        $data['satuan'] = $this->DButama->GetDB('tb_satuan');  //load database tb_satuan
	        $query = $this->db->like('nama_barang',$cari);
			$query = $this->db->order_by('tgl', 'desc');
	        $query = $this->db->get('tb_barang', $config['per_page'], abs($page));  //load database tb_barang
	        $data['barang'] = $query;

	        $data['title']= 'Barang '.$cari.'' ;
			$data['ten'] = $this->DButama->GetDB('tb_toko')->row();  //load database tabel toko
	        // fun view
	        $this->load->view('utama/temp-header', $data);
			$this->load->view('utama/v_cari',$data);
			$this->load->view('utama/temp-footer');
        }else{
            redirect('error404','refresh');
        }
    }

    // fun cari barang lanjutan yang diatas
    public function cari_barang($url='',$page=0)
    {
    	$cek = $this->db->query("SELECT * from tb_barang where nama_barang like '%$url%' ");
        if ($cek->num_rows() != 0) {
            $row = $cek->row();
            $data['slug']= $row->slug;
            
            $jml = $cek;
            $config['base_url'] = base_url('').'i/cari-barang/'.$url.'/';
            $config['total_rows'] = $jml->num_rows();;
           	$config['per_page'] = 10;
	        $config['uri_segment'] = 4;

            /*Class bootstrap pagination yang digunakan*/
	        $config['full_tag_open'] = "<ul class='pagination modal-2' style='position:relative; top:-25px;'>";
	        $config['full_tag_close'] ="</ul>";
	        $config['num_tag_open'] = '<li>';
	        $config['num_tag_close'] = '</li>';
	        $config['cur_tag_open'] = "<li class='page-item'><li class='active'><a  style='background:#FF6347;color:#fff'>";
	        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
	        $config['next_tag_open'] = "<li class='page-item'>";
	        $config['next_tagl_close'] = "</li>";
	        $config['prev_tag_open'] = "<li class='page-item'>";
	        $config['prev_tagl_close'] = "</li>";
	        $config['first_tag_open'] = "<li class='page-item'>";
	        $config['first_tagl_close'] = "</li>";
	        $config['last_tag_open'] = "<li class='page-item'>";
	        $config['last_tagl_close'] = "</li>";

            // membuat daftar bagian per halaman
	        $this->pagination->initialize($config);
	        $data['halaman'] = $this->pagination->create_links();

	        $data['satuan'] = $this->DButama->GetDB('tb_satuan');  //load database tb_satuan
	        $query = $this->db->like('nama_barang',$url);
			$query = $this->db->order_by('tgl', 'desc');
	        $query = $this->db->get('tb_barang', $config['per_page'], abs($page));  //load database tb_barang
	        $data['barang'] = $query;

	        $data['title']= 'Barang '.$url.'' ;
			$data['ten'] = $this->DButama->GetDB('tb_toko')->row();  //load database tabel toko
	        // fun view
	        $this->load->view('utama/temp-header', $data);
			$this->load->view('utama/v_cari',$data);
			$this->load->view('utama/temp-footer');
        }else{
            redirect('error404','refresh');
        }
    }

// <<------------------------ CARI BARANG ------------------------>>


}

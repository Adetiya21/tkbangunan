<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller {

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
		$this->load->model('m_pesanan_saya','Model');  //load model
		$this->load->helper('rupiah');  //load helper
	}

	// fun halaman pesanan saya
	public function index()
	{
		$data['title'] = 'Pesanan Saya';
		$data['ten'] = $this->DButama->GetDB('tb_toko')->row();  //load database tb_toko
		// fun view
		$this->load->view('utama/temp-header', $data);
		$this->load->view('utama/v_pesanan-saya');
		$this->load->view('utama/temp-footer');
	}

	// fun datatables pada tabel
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	// fun halaman detail pesanan
	public function detail($inv='')
	{
		// cek invoice dan email
		$query = $this->DButama->GetDBWhere('tb_invoice', array('no_invoice' => $inv, 'email_user' => $this->session->userdata('email') ));
		if ($query->num_rows() == 1) {
			$row = $query->row();
			$data['invoice'] 	= $row;
			$data['ten'] = $this->DButama->GetDB('tb_toko')->row();  //load database tb_toko
			//load database tb_user
			$data['user'] = $this->DButama->GetDBWhere('tb_user', array('email' => $this->session->userdata('email')))->row();
			$data['title']='Detail Pesanan '.$inv;
			
			// load data pesanan barang berdasarkan no invoice yang terpilih
            $where  = array('tb_pesanan.no_invoice' => $inv, );
            $query = $this->db->select('
            	tb_pesanan.qty, tb_pesanan.no_invoice, tb_pesanan.id_barang, tb_pesanan.slug,
            	tb_barang.nama_barang,tb_barang.harga_barang,tb_barang.gambar,
            	tb_satuan.satuan');
            $query = $this->db->where($where);
            $query = $this->db->from('tb_pesanan');
            $query = $this->db->join('tb_barang', 'tb_pesanan.id_barang = tb_barang.id_barang', 'left');
            $query = $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
            $query = $this->db->get();
            $data['barang'] = $query;

			// fun view
			$this->load->view('utama/temp-header',$data);
			$this->load->view('utama/v_pesanan-detail',$data);
			$this->load->view('utama/temp-footer');
		}else{
			redirect('pesanan-saya','refresh');
		}
	}

	// fun batalkan pesanan
	function batal($no_invoice)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('no_invoice' => $no_invoice);  //filter berdasarkan id
			$data = array(
				'status' => 'Dibatalkan'
			);
			// fun update
			$this->DButama->UpdateDB('tb_invoice',$where,$data);
			echo json_encode(array("status" => TRUE));
		}
	}

}

/* End of file Pesanan_saya.php */
/* Location: ./application/controllers/Pesanan_saya.php */
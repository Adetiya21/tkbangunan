<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// cek session user sudah login
		if ($this->session->userdata('user_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Anda belum login!');";
			echo 'window.location.assign("'.site_url("i/keranjang-belanja").'")
			</script>';
		}
		// cek isi keranjang belanja
		if ($this->cart->total_items() == 0) {
			echo "<script>
			alert('Keranjang anda masih kosong!');";
			echo 'window.location.assign("'.site_url("i/keranjang-belanja").'")
			</script>';
		}
		$this->load->model('m_checkout','checkout');  //load model 
		$this->load->helper('rupiah');  //load helper
	}

	// fun halaman checkout
	public function index()
	{
		$data['title'] = 'Proses Checkout';
		$data['ten'] = $this->DButama->GetDB('tb_toko')->row();  //load database tb_toko
		$data['satuan'] = $this->DButama->GetDB('tb_satuan');  //load database tb_toko
		// fun view
		$this->load->view('utama/temp-header', $data);
		$this->load->view('utama/v_checkout');
		$this->load->view('utama/temp-footer');
	}

	// proses checkout pesanan
	public function proses_checkout()
	{
		if ($this->session->userdata('alamat')==null) {
			echo "<script>
			alert('Lengkapi data diri anda terlebih dahulu!');";
			echo 'window.location.assign("'.site_url("akun-saya").'")
			</script>';
		} else {
			// cek id dan email user
			$cek = $this->DButama->GetDBWhere('tb_user', array('id_user' => $this->session->userdata('id_user'), 'email' => $this->session->userdata('email')));
			if ($cek->num_rows() == 0) {
				redirect('i/keranjang-belanja','refresh');
			}else{
				$invoice_id =  $this->checkout->find_invoice();  //membuat no invoice
				$invoice 	= array(
					'no_invoice' => $invoice_id,
					'tgl' => date('Y-m-d H:i:s'),
					'email_user' => $this->session->userdata('email'),
					'status'  => 'Menunggu Konfirmasi',
					'total' => $this->cart->total(),
				);
				// fun tambah data
				$add1 = $this->DButama->AddDB('tb_invoice',$invoice);
				
				// fun tambah ke table pesanan
				foreach ($this->cart->contents() as $items) {
					$slug = url_title($items['name'], 'dash', TRUE);
					$orders = array(
						'no_invoice' => $invoice_id,
						'id_barang' => $items['id'],
						'qty' => $items['qty'],
						'slug' => $slug,
					);
					// fun tambah
					$add2 = $this->DButama->AddDB('tb_pesanan',$orders);
				}
				// menghapus isi keranjang
				$this->cart->destroy();
				// pesan sukses
				echo "<script>alert('Pesananan anda telah disimpan, silahkan klik detail pesanan, dan segera lakukan konfirmasi  agar pesanan anda segera di proses')</script>";
				redirect('pesanan-saya','refresh');
			}
		}
	}

}

/* End of file Checkout.php */
/* Location: ./application/controllers/Checkout.php */
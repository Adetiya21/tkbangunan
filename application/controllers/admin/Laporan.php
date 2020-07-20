<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_invoice';

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
		$this->load->model('m_laporan','Model');  //load model m_laporan
		$this->load->helper('rupiah');  //load helper rupiah
	}

	// fun halaman pesanan
	public function index()
	{
		$query = $this->db->where( "status", 'selesai');   //filter berdasarkan status selesai
        $query = $this->db->select('id_invoice,no_invoice,sum(DISTINCT total) as total,tgl');  //load database
        $query = $this->db->from('tb_invoice');  //nama tabel
        $query = $this->db->get();
        $data['laporan'] = $query->row();
        $data['title'] = 'Data Laporan Pemasukan';
        // fun view
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_laporan',$data);
		$this->load->view('admin/temp-footer');
	}

	// fun halaman laporan berdasarkan bulan
	public function proses()
	{
		$bulan = $this->input->post('bulan');  //menangkap hasil inputan
		$data['bln'] = $bulan;  //deklarasi bulan
		$query = $this->db->where( "DATE_FORMAT(tgl,'%m')", $bulan);  //filter berdasarkan bulan yang diinputkan
        $query = $this->db->where( "status", 'selesai');   //filter berdasarkan status selesai
        $query = $this->db->select('id_invoice,no_invoice,sum(DISTINCT total) as total,tgl');  //load database
        $query = $this->db->from('tb_invoice');  //nama tabel
        $query = $this->db->get();
        $data['laporan'] = $query->row();
        $data['title'] = 'Data Laporan Pemasukan';
        // fun view
        $this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_laporan-bulan',$data);
		$this->load->view('admin/temp-footer');
	}

	// fun json datatables keseluruhan
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	// fun json datatables berdasarkan bulan
	public function json_bulan($bln) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json_bulan($bln);
		}
	}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/admin/Laporan.php */
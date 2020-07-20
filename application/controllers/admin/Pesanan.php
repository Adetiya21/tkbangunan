<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

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
		$this->load->model('m_pesanan','Model');  //load model m_pesanan
		$this->load->helper('rupiah');  //load helper rupiah
	}

	// fun json datatables
	public function json() {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			echo $this->Model->json();
		}
	}

	// fun halaman pesanan
	public function index()
	{
		$data['title'] = 'Data Pesanan';
		// fun view
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_pesanan');
		$this->load->view('admin/temp-footer');
	}

	// fun hapus
	public function hapus($id_invoice)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id_invoice' => $id_invoice);  //filter berdasarkan id_invoice
			$this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			$this->DButama->DeleteDB($this->table,$where);  //fun delete
			echo json_encode(array("status" => TRUE));
		}
	}

	public function detail($no_invoice)
	{
		// cek data sesuai dengan di database
		$cek = $this->DButama->GetDBWhere('tb_invoice',array('no_invoice'=> $no_invoice));
		if ($cek->num_rows() == 1) {
			$invoice = $cek->row();
			$data['title'] = 'Detail Pesanan '.$invoice->no_invoice;
			// select data dengan menggabungkan 3 buah tabel
			$data['invoice'] = $cek->row();
			$data['pemesan'] = $this->DButama->GetDBWhere('tb_user', array('email' => $invoice->email_user, ))->result();
			$where  = array('tb_pesanan.no_invoice' => $no_invoice, );
			$query = $this->db->select('tb_pesanan.no_invoice,tb_pesanan.id_barang,tb_pesanan.qty,
				tb_invoice.email_user,tb_invoice.tgl,tb_invoice.total,tb_invoice.status,
				tb_barang.nama_barang,tb_barang.harga_barang,tb_barang.gambar,tb_barang.slug,tb_barang.id_satuan,
				tb_satuan.satuan');
            $query = $this->db->where($where);
            $query = $this->db->from('tb_pesanan');
            $query = $this->db->join('tb_invoice', 'tb_pesanan.no_invoice = tb_invoice.no_invoice');
            $query = $this->db->join('tb_barang', 'tb_pesanan.id_barang = tb_barang.id_barang');
            $query = $this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan');
            $query = $this->db->get();
            $data['orders'] = $query;
			// fun view
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_pesanan-detail',$data);
			$this->load->view('admin/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

	// fun edit
	public function edit($id_invoice)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id_invoice' => $id_invoice);  //filter berdasarkan id_invoice
			$data = $this->DButama->GetDBWhere($this->table,$where)->row();  //load database
			echo json_encode($data);
		}
	}

	// proses edit
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$where  = array('id_invoice' => $this->input->post('id_invoice'));  //filter berdasarkan id_invoice
			$data = array(
				'status' => $this->input->post('status')
			);
			// fun update
			$this->DButama->UpdateDB($this->table,$where,$data);
			echo json_encode(array("status" => TRUE));
		}
	}

}

/* End of file Pesanan.php */
/* Location: ./application/controllers/admin/Pesanan.php */
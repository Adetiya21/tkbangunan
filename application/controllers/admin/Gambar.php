<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gambar extends CI_Controller {

	// deklarasi var table
	var $table = 'tb_gambar_barang';

	function __construct()
	{
		parent::__construct();
		// cek session admin sudah login
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('You Must Login!');";
			echo 'window.location.assign("'.site_url("admin").'")
			</script>';
		}
		$this->load->model('m_gambar','Model');  //load model m_gambar
		$this->load->helper('rupiah');  //load helper rupiah
		$this->load->library(array(
			'custom_upload',
			'form_validation'
		));
	}

	public function index()
	{
		redirect('admin/barang','refresh');
	}

	public function barang($slug)
	{
		$cek = $this->DButama->GetDBWhere('tb_barang',array('slug'=> $slug));
		if ($cek->num_rows() == 1) {
			$data['title'] = 'Tambah Gambar Barang';
			$br = $cek->row();
			$data['barang'] = $cek->row();
			$data['satuan'] = $this->DButama->GetDBWhere('tb_satuan',array('id_satuan'=> $br->id_satuan))->row();
			$this->load->view('admin/temp-header',$data);
			$this->load->view('admin/v_gambar-barang',$data);
			$this->load->view('admin/temp-footer');
		}else{
			redirect('error404','refresh');
		}
	}

	public function proses()
	{
		$slug = $this->input->post('slug');
		$id_barang = $this->input->post('id_barang');
		$file = $this->custom_upload->multiple_upload('gambar', array(
			'upload_path' => 'assets/back-end/images/produk/',
			'allowed_types' => 'jpg|jpeg|png', // etc
			'quality' => '50%',
			'width' => 500,
            'height' => 500
		));

		$data = array();
		foreach ($file as $f) {
			array_push($data, array(
				'id_barang' => $this->input->post('id_barang'),
				'gambar' => $f
			));
		}
		$this->db->insert_batch($this->table, $data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success background-success">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<i class="icofont icofont-close-line-circled text-white"></i>
						</button>Gambar telah diupload</code></div>');
		redirect('admin/gambar/barang/'.$slug,'refresh');
	}

	// fun datatables gambar barang
	public function json($id) {
		if ($this->input->is_ajax_request()) {
			header('Content-Type: application/json');
			$where = array('id_barang' => $id, );  //filter berdasarkan id
			echo $this->Model->json($where);
		}
	}

	// fun hapus//hapus
	public function hapus($id)
	{
		if ($this->input->is_ajax_request()) {
			$where = array('id_gambar' => $id);  //filter berdasarkan id
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

}

/* End of file Gambar.php */
/* Location: ./application/controllers/admin/Gambar.php */
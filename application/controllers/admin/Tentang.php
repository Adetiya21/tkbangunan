<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang extends CI_Controller {

	var $table = 'tb_tentang';

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('admin_logged_in') !=  "Sudah_Loggin") {
			echo "<script>
			alert('Login Dulu!');";
			echo 'window.location.assign("'.site_url("admin/welcome").'")
			</script>';
		}
	}

	public function index()
	{
		$data['title'] = 'Informasi Tentang Website';
		$cek = $this->DButama->GetDB($this->table);
		$data['tentang'] = $cek->row();
		$this->load->view('admin/temp-header',$data);
		$this->load->view('admin/v_tentang',$data);
		$this->load->view('admin/temp-footer');
	}

	public function proses()
	{
		$this->load->library('form_validation');
		$config = array(
			array('field' => 'no_telp','label' => 'No Telp','rules' => 'required',),
			array('field' => 'facebook','label' => 'Facebook','rules' => 'required'),
			array('field' => 'instagram','label' => 'Instagram','rules' => 'required'),
			array('field' => 'alamat','label' => 'Alamat','rules' => 'required'),
			array('field' => 'maps','label' => 'Iframe Maps','rules' => 'required'),
			array('field' => 'keterangan','label' => 'keterangan','rules' => 'required'),
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>'.validation_errors().'</strong> 
							</div>');
			redirect('admin/tentang','refresh');
		}else{

			$where  = array('id' => $this->input->post('id'));
			$query = $this->DButama->GetDBWhere($this->table,$where);
			$row = $query->row();
			$data = array(
				'no_telp' => $this->input->post('no_telp'),
				'facebook' => $this->input->post('facebook'),
				'instagram' => $this->input->post('instagram'),
				'alamat' => $this->input->post('alamat'),
				'maps' => $this->input->post('maps'),
				'keterangan' => $this->input->post('keterangan')
			);

			if(!empty($_FILES['logo']['name']))
			{
				$upload = $this->_do_upload();
				$data['logo'] = $upload;
			}

			$this->DButama->UpdateDB($this->table,$where,$data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Data sudah di perbaharui</strong> 
							</div>');
			redirect('admin/tentang','refresh');
		}
	}

	private function _do_upload()
	{
		$config['upload_path']   = 'assets/assets/img/logo/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['remove_spaces'] = TRUE;
		$config['encrypt_name']  = TRUE;
        $config['file_name']     = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('logo')) //upload and validate
        {
        	$this->session->set_flashdata('upload_error', 'Upload error: '.$this->upload->display_errors('',''));
        }
        return $this->upload->data('file_name');
    }

    private function _Values()
	{
		$this->session->set_flashdata('no_telp', set_value('no_telp') );
		$this->session->set_flashdata('facebook', set_value('facebook') );
		$this->session->set_flashdata('instagram', set_value('instagram') );
		$this->session->set_flashdata('alamat', set_value('alamat') );
		$this->session->set_flashdata('maps', set_value('maps') );
		$this->session->set_flashdata('keterangan', set_value('keterangan') );
	}

}

/* End of file Tentang.php */
/* Location: ./application/controllers/admin/Tentang.php */
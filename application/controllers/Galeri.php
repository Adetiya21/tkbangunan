<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller {

	// public function index()
	// {
	// 	$data['title'] = 'Galeri';
	// 	$data['produk'] =$this->db->order_by('tgl', 'asc');
	// 	$data['produk'] = $this->DButama->GetDB('tb_produk');
	// 	$this->load->view('utama/temp-header', $data);
	// 	$this->load->view('utama/v_galeri',$data);
	// 	$this->load->view('utama/temp-footer');
	// }

	public function i($page=0)
    {
        $data['title']='Galeri';
        $query =  $this->db->order_by('tgl', 'desc');
        $query = $this->DButama->GetDB('tb_produk');
        $jml = $query;

        $config['base_url'] = base_url('').'galeri/i/';
        $config['total_rows'] = $jml->num_rows();;
        $config['per_page'] = 12;
        $config['uri_segment'] = 3;

        /*Class bootstrap pagination yang digunakan*/
        $config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);

        $data['halaman']    = $this->pagination->create_links();
        $query = $this->db->order_by('tgl', 'desc');
        $query = $this->db->get('tb_produk', $config['per_page'], $page);
        $data['produk'] = $query;
        
        $this->load->view('utama/temp-header',$data);
        $this->load->view('utama/v_galeri',$data);
        $this->load->view('utama/temp-footer');
    }

}

/* End of file Galeri.php */
/* Location: ./application/controllers/Galeri.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function i($url)
    {
        $cek = $this->DButama->GetDBWhere('tb_kategori_produk', array('slug' => $url, ));
        if ($cek->num_rows() == 1) {
            $row = $cek->row();
            $title['title']= $row->nama;
            $data['slug']= $row->slug;
            $this->load->view('utama/temp-header',$title);

            $query = $this->db->order_by('tgl', 'desc');
            $query = $this->db->limit('8');
            $query = $this->db->where(array('id_kategori' => $row->id, ));
            $query = $this->db->get('tb_produk');
            $data['produk'] = $query;
            $data['kat'] = $this->DButama->GetDBWhere('tb_kategori_produk', array('id' => $row->id, ))->row();
            $this->load->view('utama/v_produk',$data);
            $this->load->view('utama/temp-footer');
        }else{
            redirect('error404','refresh');
        }
    }

    public function cari()
    {
        $cari = $this->input->post('cari');
        $cek = $this->db->query("SELECT * from tb_kategori_produk where nama like '%$cari%' ");
        if ($cek->num_rows() != 0) {
            $row = $cek->row();
            $title['title']= 'Produk '.$cari.'' ;
            $query = $this->db->order_by('tgl', 'desc');
            $query = $this->db->limit('8');
            $query = $this->db->where(array('id_kategori' => $row->id, ));
            $query = $this->db->get('tb_produk');
            $data['produk'] = $query;
            $data['kat'] = $this->DButama->GetDBWhere('tb_kategori_produk', array('id' => $row->id, ))->row();
            $this->load->view('utama/temp-header',$title);
            $this->load->view('utama/v_produk',$data);
            $this->load->view('utama/temp-footer');
        }else{
            redirect('error404','refresh');
        }
    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
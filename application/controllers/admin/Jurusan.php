<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

	function __construct() {
		parent::__construct();
		admin_logged_in();
		$this->load->model('Model_jurusan');
	}

	public function index()
	{
		
		$isi['content'] 	= 'backend/jurusan/tampil_datajurusan';
		$isi['judul'] 		= 'Master';
		$isi['sub_judul'] 	= 'Jurusan';
		
		$isi['data']		= $this->db->get('jurusan');
		
		$this->load->view('backend/tampil_home', $isi);
	}

	public function tambah()
	{
		
		$isi['content'] 	= 'backend/jurusan/form_tambahjurusan';
		$isi['judul'] 		= 'Master';
		$isi['sub_judul'] 	= 'Tambah Jurusan';
		
		$isi['id_jurusan'] 			= '';
		$isi['nama_jurusan'] 		= '';
		$isi['singkatan'] 			= '';

		$this->load->view('backend/tampil_home', $isi);
	}

	public function simpan()
	{
		$data = array(
			'nama_jurusan'  => $this->input->post('nama_jurusan', TRUE),
			'singkatan'  	=> $this->input->post('singkatan', TRUE)
		);
		
		$key= $this->input->post('id_jurusan');

		$query = $this->Model_jurusan->getdata($key);
		if($query->num_rows() > 0)
		{
			
			$this->Model_jurusan->update($key,$data);
			$this->session->set_flashdata('Info','Data berhasil di update');
		}else{
			$this->Model_jurusan->simpan();
			$this->session->set_flashdata('Info','Data berhasil di simpan');
		}

		redirect('admin/jurusan');
	}

	public function edit()
	{
		
		$isi['content'] 	= 'backend/jurusan/form_tambahjurusan';
		$isi['judul'] 		= 'Master';
		$isi['sub_judul'] 	= 'Edit Jurusan';

		$key = $this->uri->segment(4);
		$this->db->where('id_jurusan',$key);
		$query = $this->db->get('jurusan');
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row) 
			{
				$isi['id_jurusan'] 				= $row->id_jurusan;
				$isi['nama_jurusan'] 			= $row->nama_jurusan;
				$isi['singkatan'] 				= $row->singkatan;
			}
		}
	else{
		$isi['id_jurusan'] 				= '';
		$isi['nama_jurusan'] 			= '';
		$isi['singkatan'] 				= '';
	}
	$this->load->view('backend/tampil_home', $isi);
}

}

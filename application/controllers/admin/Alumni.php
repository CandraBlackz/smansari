<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		admin_logged_in();
		$this->load->model('model_alumni');
	}

	public function index()
	{
		
		$isi['content'] 	= 'backend/alumni/tampil_dataalumni';
		$isi['judul'] 		= 'Master';
		$isi['sub_judul'] 	= 'alumni';
		$isi['data']		= $this->model_alumni->getAlumni();
		$this->load->view('backend/tampil_home', $isi);
	}

	public function tambah()
	{
		
		$isi['content'] 	= 'backend/alumni/form_tambahnisn';
		$isi['judul'] 		= 'Master';
		$isi['sub_judul'] 	= 'Tambah NISN Alumni';
		
		$isi['id'] 			= '';
		$isi['nisn'] 		= '';

		$this->load->view('backend/tampil_home', $isi);
	}

	public function simpan()
	{	
		$data['nisn'] 	= $this->input->post('nisn');

		$key= $this->input->post('id');

		$query = $this->model_alumni->getdata($key);
		if($query->num_rows() > 0)
		{
			
			$this->model_alumni->getupdate_nisn($key,$data);
			$this->session->set_flashdata('Info','Data berhasil di update');
		}else{
			$this->model_alumni->getinsert($data);
			$this->session->set_flashdata('Info','Data berhasil di simpan');
		}

		redirect('admin/alumni');
	}

	public function edit()
	{
		
		$isi['content'] 	= 'backend/alumni/form_tambahnisn';
		$isi['judul'] 		= 'Master';
		$isi['sub_judul'] 	= 'Edit NISN Alumni';

		$key = $this->uri->segment(4);
		$this->db->where('id',$key);
		$query = $this->db->get('alumni');
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row) 
			{
				$isi['id'] 				= $row->id;
				$isi['nisn'] 			= $row->nisn;
			}
		}
	else{
		$isi['id'] 				= '';
		$isi['nisn'] 			= '';
	}
	$this->load->view('backend/tampil_home', $isi);
}

public function detail_alumni($Id)
{
	$this->load->model('model_alumni');
	
	$isi['content'] 	= 'backend/alumni/detail_alumni';
	$isi['judul'] 		= 'Home';
	$isi['sub_judul'] 	= 'Detail Alumni';
	$isi['data']    	= $this->model_alumni->get_detail($Id);
	
	$this->load->view('backend/tampil_home',$isi);
}

public function delete()
{
	$key = $this->uri->segment(4);
	$this->db->where('id',$key);
	$query = $this->db->get('alumni');
	if($query->num_rows()>0)
	{
		$this->model_alumni->getdelete($key);
	}
	redirect('admin/alumni');
}
}

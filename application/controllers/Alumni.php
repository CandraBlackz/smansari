<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumni extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->database();
		$this->load->model('model_alumni');
		$this->load->model('model_site');
	}

	public function index()
	{
		$logoheader			= $this->model_site->getConfig('WHERE id_config = 1')->result_array();
		$teks_kontak		= $this->model_site->getConfig('WHERE id_config = 6')->result_array();
		$footer 			= $this->model_site->getConfig('WHERE id_config = 8')->result_array();
		$home 				= $this->model_site->getConfig('WHERE id_config = 2')->result_array();
		
		$berita_terbaru		= $this->db->query('SELECT * from berita order by id_berita desc limit 3')->result_array();
		$agenda_terbaru		= $this->db->query('SELECT * from agenda order by id_agenda desc limit 3')->result_array();
		$jurusan 			= $this->db->query('SELECT * from jurusan order by id_jurusan desc limit 3')->result_array();

		$data = array(
			'title'			=> strip_tags($home[0]['content']),		
			'teks_kontak'		=> strip_tags($teks_kontak[0]['content']),
			'footer'			=> strip_tags($footer[0]['content']),
			'logo'			=> strip_tags($logoheader[0]['content']),
			'home'			=> strip_tags($home[0]['content']),
			
			'judul'			=> 'Data Alumni',
			'title'			=> strip_tags($home[0]['content']),
			'berita_terbaru'	=> $berita_terbaru,
			'agenda_terbaru'	=> $agenda_terbaru,
			'jurusan'			=> $jurusan,

		);
		
		$this->load->view('frontend/head',$data);
		$this->load->view('frontend/navigasi/navi_page');
		$this->load->view('frontend/alumni');
		$this->load->view('frontend/footer');
		
	}

	public function ajax_list()
	{
		$list = $this->model_alumni->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $alumni) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $alumni->nisn;
			$row[] = $alumni->nama_lengkap;
			$row[] = $alumni->jenis_kelamin;
			$row[] = $alumni->nama_jurusan;
			$row[] = $alumni->telp;
			$row[] = $alumni->tahun_lulus;
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Detail Alumni" onclick="edit_alumni('."'".$alumni->id."'".')"><i class="fa fa-eye"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->model_alumni->count_all(),
			"recordsFiltered" => $this->model_alumni->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->model_alumni->get_by($id);
		echo json_encode($data);
	}

	public function profile_alumni($id= '')
	{
		alumni_logged_in();

		$logoheader			= $this->model_site->getConfig('WHERE id_config = 1')->result_array();
		$teks_kontak		= $this->model_site->getConfig('WHERE id_config = 6')->result_array();
		$footer 			= $this->model_site->getConfig('WHERE id_config = 8')->result_array();
		$home 				= $this->model_site->getConfig('WHERE id_config = 2')->result_array();

		$berita_terbaru		= $this->db->query('SELECT * from berita order by id_berita desc limit 3')->result_array();
		$agenda_terbaru		= $this->db->query('SELECT * from agenda order by id_agenda desc limit 3')->result_array();
		$jurusan			= $this->db->query('select * from jurusan')->result_array();
		$alumni				= $this->model_alumni->get_by($id);

		$data = array(
			'title'			=> strip_tags($home[0]['content']),		
			'teks_kontak'		=> strip_tags($teks_kontak[0]['content']),
			'footer'			=> strip_tags($footer[0]['content']),
			'logo'			=> strip_tags($logoheader[0]['content']),
			'home'			=> strip_tags($home[0]['content']),
			
			'judul'			=> 'Profile Alumni',
			'title'			=> strip_tags($home[0]['content']),
			'berita_terbaru'	=> $berita_terbaru,
			'agenda_terbaru'	=> $agenda_terbaru,
			'jurusan'			=> $jurusan,
			'alumni'			=> $alumni,
		);

		$key = $this->uri->segment(3);

		$this->db->where('id',$key);
		$query = $this->db->get('alumni');
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row) 
			{
				$data['jenis_kelamin'] 	= $row->jenis_kelamin;
				$data['id_jurusan'] 	= $row->id_jurusan;
				$data['agama'] 			= $row->agama;
				$data['id_provinsi'] 	= $row->id_provinsi;
			}
		}
	else{
		$data['jenis_kelamin'] 	= '';
		$data['id_jurusan'] 	= '';
		$data['agama'] 			= '';
	}

	$data['prov'] = $this->db->get('provinsi');
	
	$this->load->view('frontend/head',$data);
	$this->load->view('frontend/navigasi/navi_page');
	$this->load->view('frontend/profile_alumni');
	$this->load->view('frontend/footer');
}

public function tambah()
{
	$key= $this->input->post('nisn');
	
	$data['nisn'] 			= $this->input->post('nisn');
	$data['nama_lengkap'] 	= $this->input->post('nama_lengkap');
	$data['password'] 		= md5($this->input->post('password'));
	
	$this->model_alumni->daftar_alumni($key,$data);
	$this->session->set_flashdata('success','Pendaftaran Berhasil. Silahkan Login dibawah.');

	redirect('frontend/login');
}

public function simpan()
{
	$key= $this->input->post('id');
	
	$data['id'] 			= $this->input->post('id');
	$data['nisn'] 			= $this->input->post('nisn');
	$data['nama_lengkap'] 	= $this->input->post('nama_lengkap');
	$data['jenis_kelamin'] 	= $this->input->post('jenis_kelamin');
	$data['email'] 			= $this->input->post('email');
	$data['telp'] 			= $this->input->post('telp');
	$data['tempat_lahir'] 	= $this->input->post('tempat_lahir');
	$data['tanggal_lahir'] 	= $this->input->post('tanggal_lahir');
	$data['tahun_lulus'] 	= $this->input->post('tahun_lulus');
	$data['id_jurusan'] 	= $this->input->post('id_jurusan');
	$data['agama'] 			= $this->input->post('agama');
	$data['profesi'] 		= $this->input->post('profesi');
	$data['id_provinsi'] 	= $this->input->post('id_provinsi');
	$data['id_kabupaten'] 	= $this->input->post('id_kabupaten');
	$data['alamat'] 		= $this->input->post('alamat');

	$this->load->model('model_alumni');
	$query = $this->model_alumni->getdata($key);
	if($query->num_rows() > 0)
	{
		
		$this->model_alumni->getupdateprofil($key,$data);
		$this->session->set_flashdata('Info','Data berhasil di update');
	}else{
		$this->model_alumni->getinsert($data);
	}

	redirect('alumni/profile_alumni');
	
}

public function simpan_password(){
	$key= $this->input->post('id');

	$this->load->model('model_alumni');
	
	$this->model_alumni->simpan_password($key,$data);
	$this->session->set_flashdata('Info','Password berhasil di ubah');

	redirect('alumni/profile_alumni');
}

public function ubah_foto()
{
	
	$config['upload_path'] = './uploads/alumni/';
	$config['allowed_types'] = 'jpg|png';
		$config['max_size']	= '2000'; //KB
		$config['max_width']  = '2000'; //pixels
		$config['max_height']  = '2000'; //pixels
		
		$this->upload->initialize($config);
		
		if(!$this->upload->do_upload('foto')){
			$error=array('error'=>$this->upload->display_errors());
			echo $error['error'];
		} else {

			$img=$this->upload->data();
			$key= $this->input->post('id');
			
			$data['id'] 			= $this->input->post('id');
			$data['foto'] 			= $img['file_name'];

			$this->load->model('model_alumni');
			$query = $this->model_alumni->getdata($key);
			if($query->num_rows() > 0)
			{
				
				$this->model_alumni->getupdateprofil($key,$data);

			}else{
				$this->model_alumni->getinsert($data);
			}
			$this->session->set_flashdata('success', 'Foto Berhasil Di Simpan.');
			redirect('alumni/profile_alumni');
		}
	}

	public function cek_status_nisn(){
		$nisn = $this->input->post('nisn');
		
		$hasil_nisn = $this->model_alumni->cek_nisn($nisn);
		
		if(count($hasil_nisn)!=0){ 
			echo "1"; 
		}else{
			echo "2";
		}
		
	}

	public function kabupaten(){
		$propinsiID = $_GET['id_provinsi'];
		$kabupaten   = $this->db->get_where('kabupaten',array('id_provinsi'=>$propinsiID));
		echo "<select id='id_kabupaten' name='id_kabupaten' class='form-control'>";
		foreach ($kabupaten->result() as $k)
		{
			echo "<option value='$k->id_kabupaten'>$k->nama_kabupaten</option>";
		}
		echo "</select></div>";
	}	

}

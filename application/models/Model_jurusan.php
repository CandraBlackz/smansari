<?php

class Model_jurusan extends CI_model {

	public $table ="jurusan";

	function getdata($key)
	{
		$this->db->where('id_jurusan', $key);
		$hasil = $this->db->get('jurusan');
		return $hasil;
	}

	function simpan() {
		$this->db->insert($this->table,$data);
	}

	function update($key,$data)
	{
		$data = array(
			'nama_jurusan'  => $this->input->post('nama_jurusan', TRUE),
			'singkatan'  	=> $this->input->post('singkatan', TRUE)
		);

		$this->db->where('id_jurusan',$key);
		$this->db->update('jurusan',$data);
	}
}

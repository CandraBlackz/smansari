<?php
class Model_laporan extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

	public function semua_alumni() {
	$query = $this->db->query("SELECT *
		FROM 
		alumni 
		INNER JOIN jurusan ON jurusan.id_jurusan = alumni.id_jurusan
		INNER JOIN kabupaten ON kabupaten.id_kabupaten = alumni.id_kabupaten
		INNER JOIN provinsi ON kabupaten.id_provinsi = provinsi.id_provinsi order by nisn ");
	return $query->result();
}

public function semua_alumni_tahun($tahun) {
	$query = $this->db->query("SELECT *
		FROM 
		jurusan 
		INNER JOIN alumni ON alumni.id_jurusan = jurusan.id_jurusan
		INNER JOIN kabupaten ON kabupaten.id_kabupaten = alumni.id_kabupaten
		INNER JOIN provinsi ON kabupaten.id_provinsi = provinsi.id_provinsi where tahun_lulus like '%$tahun%' order by nisn ");
	return $query->result();
}

public function semua_alumni_jurusan($jurusan) {
	$query = $this->db->query("SELECT *	
		FROM 
		jurusan 
		INNER JOIN alumni ON alumni.id_jurusan = jurusan.id_jurusan
		INNER JOIN kabupaten ON kabupaten.id_kabupaten = alumni.id_kabupaten
		INNER JOIN provinsi ON kabupaten.id_provinsi = provinsi.id_provinsi where nama_jurusan='$jurusan' order by nisn ");
	return $query->result();
}

}
?>
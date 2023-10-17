<?php defined('BASEPATH') or exit('No direct script access allowed');

class First_pembangunan_m extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function paging($p = 1)
	{
		//$sql = "SELECT COUNT(id) AS id FROM tbl_pembangunan WHERE status = 1 AND tipe='0'";
		$sql = "SELECT COUNT(id) AS id FROM tbl_pembangunan WHERE status = 1 ";

		$query = $this->db->query($sql);
		$row = $query->row_array();
		$jml_data = $row['id'];

		$this->load->library('paging');
		$cfg['page'] = $p;
		$cfg['per_page'] = 10;
		$cfg['num_rows'] = $jml_data;
		$this->paging->init($cfg);

		return $this->paging;
	}

	// daftar Pembangunan
	public function pembangunan_show($offset = 0, $limit = 50)
	{
		// OPTIMIZE: benarkah butuh paging?
		$paging_sql = ' LIMIT ' . $offset . ',' . $limit;

		//$sql = "SELECT * FROM tbl_pembangunan
		//	WHERE status = 1 AND tipe ='0'
		$sql = "SELECT * FROM tbl_pembangunan
			WHERE status = 1 
			ORDER BY tahun";
		$sql .= $paging_sql;

		$query = $this->db->query($sql);
		$data = $query->result_array();
		// Untuk album yang tidak ada foto cover, cari foto di sub-gallery
		for ($i = 0; $i < count($data); $i++) {
			if ($data[$i]['foto'] == '') {
				$galeri = $data[$i]['id'];
				//$sql = "SELECT foto FROM tbl_pembangunan WHERE ((status = '1') AND ((parrent = '".$galeri."') OR (id = '".$galeri."')) AND (foto<>'')) LIMIT 1";
				$sql = "SELECT foto FROM tbl_pembangunan WHERE ((status = '1') AND (foto<>'')) LIMIT 1";
				$query = $this->db->query($sql);
				$row  = $query->row_array();
				$data[$i]['foto'] = $row['foto'];
			}
		}
		return $data;
	}

	public function paging2($gal = 0, $p = 1)
	{
		// di rincian, cover tetap diikutkan, jadi jangan lupa paging juga memperhitungkan kehadirannya :)
		$sql = "SELECT COUNT(id) AS id FROM tbl_pembangunan WHERE status = 1 AND (id = '$gal' or parrent = '$gal')";
		$sql = "SELECT COUNT(id) AS id FROM tbl_pembangunan WHERE status = 1 ";
		$query = $this->db->query($sql, $gal);
		$row = $query->row_array();
		$jml_data = $row['id'];

		$this->load->library('paging');
		$cfg['page'] = $p;
		$cfg['per_page'] = 10;
		$cfg['num_rows'] = $jml_data;
		$this->paging->init($cfg);

		return $this->paging;
	}

	// daftar foto di tiap album
	public function pembangunan_detail_show($gal = 0, $offset = 0, $limit = 50)
	{
		$paging_sql = ' LIMIT ' . $offset . ',' . $limit;
		$sql = "SELECT * FROM tbl_pembangunan
			/*WHERE ((status = '1') AND (parrent = '" . $gal . "'))*/
			WHERE ((status = '1'))
			ORDER BY urutan_prioritas
			";
		$sql .= $paging_sql;

		$query = $this->db->query($sql);
		$data  = $query->result_array();
		return $data;
	}

	public function get_parrent($parrent)
	{
		/*$sql = "SELECT * FROM tbl_pembangunan WHERE id = '$parrent'";*/
		$sql = "SELECT * FROM tbl_pembangunan";

		$query = $this->db->query($sql);
		$data  = $query->row_array();
		return $data;
	}

	// daftar album di widget
	public function gallery_widget()
	{
		$sql = "SELECT * FROM tbl_pembangunan WHERE status = '1' and parrent = 0 order by rand() limit 4";
		$query = $this->db->query($sql);
		$data  = $query->result_array();
		return $data;
	}
}

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
		$sql = "SELECT COUNT(id) AS id FROM tbl_pembangunan WHERE status = 1 AND status_pelaksanaan = 1";

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
	public function kegiatan_pembangunan($offset = 0, $limit = 50)
	{
		// OPTIMIZE: benarkah butuh paging?
		$paging_sql = ' LIMIT ' . $offset . ',' . $limit;

		$sql = "SELECT * FROM tbl_pembangunan
			WHERE status = 1 
			ORDER BY tahun";
		$sql .= $paging_sql;

		$query = $this->db->query($sql);
		$data = $query->result_array();
		// Untuk album yang tidak ada foto cover, cari foto di sub-gallery
		for ($i = 0; $i < count($data); $i++) {
			if ($data[$i]['foto'] == '') {
				$sql = "SELECT foto FROM tbl_pembangunan WHERE ((status = '1') AND (foto <> '')) LIMIT 1";
				$query = $this->db->query($sql);
				$row  = $query->row_array();
				$data[$i]['foto'] = $row['foto'];
			}
		}
		return $data;
	}

	public function detail_pembangunan($id = 0)
	{
		$data = $this->db
			->select('p.*', 'pd.gambar as foto2', 'pd.persentase as persen')
			->from('tbl_pembangunan p')
			->join('tbl_pembangunan_dok pd', 'p.id = pd.id_pembangunan', 'left')
			->where('p.id', $id)
			->get()
			->row_array();

		return $data;

		// Query untuk menggabungkan dua tabel
		//$sql = "SELECT p.*, pd.* 
       // FROM tbl_pembangunan 
        //INNER JOIN tbl_pembangunan_dok ON p.id = pd.id_pembangunan";
		//$result = $conn->query($sql);
	}
}

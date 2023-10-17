<?php

class First_gallery_youtube extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function paging($p=1)
	{
		$sql = "SELECT COUNT(id) AS id FROM gallery_youtube WHERE enabled = 1 AND tipe='0'";
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

	// daftar album galeri
	public function gallery_show($offset=0, $limit=50)
	{
		// OPTIMIZE: benarkah butuh paging?
		$paging_sql = ' LIMIT ' .$offset. ',' .$limit;

		$sql = "SELECT * FROM gallery_youtube
			WHERE enabled = 1 AND tipe ='0'
			ORDER BY urut";
		$sql .= $paging_sql;

		$query = $this->db->query($sql);
		$data = $query->result_array();
		// Untuk album yang tidak ada link cover, cari link di sub-gallery
		for ($i=0; $i<count($data); $i++)
		{
			if ($data[$i]['link'] == '')
			{
				$galeri = $data[$i]['id'];
				$sql = "SELECT link FROM gallery_youtube WHERE ((enabled = '1') AND ((parrent = '".$galeri."') OR (id = '".$galeri."')) AND (link<>'')) LIMIT 1";
				$query = $this->db->query($sql);
				$row  = $query->row_array();
				$data[$i]['link'] = $row['link'];
			}
		}
		return $data;
	}

	public function paging2($gal=0, $p=1)
	{
		// di rincian, cover tetap diikutkan, jadi jangan lupa paging juga memperhitungkan kehadirannya :)
		$sql = "SELECT COUNT(id) AS id FROM gallery_youtube WHERE enabled = 1 AND (id = '$gal' or parrent = '$gal')";
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

	// daftar link di tiap album
	public function sub_gallery_show($gal=0, $offset=0, $limit=50)
	{
		$paging_sql = ' LIMIT ' .$offset. ',' .$limit;
		$sql = "SELECT * FROM gallery_youtube
			WHERE ((enabled = '1') AND (parrent = '".$gal."'))
			ORDER BY urut
			";
		$sql .= $paging_sql;

		$query = $this->db->query($sql);
		$data  = $query->result_array();
		return $data;
	}

	public function get_parrent($parrent)
	{
		$sql = "SELECT * FROM gallery_youtube WHERE id = '$parrent'";
		$query = $this->db->query($sql);
		$data  = $query->row_array();
		return $data;
	}

	// daftar album di widget
	public function gallery_widget()
	{
		$sql = "SELECT * FROM gallery_youtube WHERE enabled = '1' and parrent = 0 order by rand() limit 4";
		$query = $this->db->query($sql);
		$data  = $query->result_array();
		return $data;
	}

}


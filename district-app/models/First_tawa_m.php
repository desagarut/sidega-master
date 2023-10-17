<?php class First_tawa_m extends CI_Model {

	private $urut_model;

	public function __construct()
	{
		parent::__construct();
	  require_once APPPATH.'/models/Urut_model.php';
		$this->urut_model = new Urut_Model('tbl_tawa');
	}

/*	public function autocomplete()
	{
		//return $this->autocomplete_str('nama', 'tbl_tawa');
	}

	private function search_sql()
	{
		if (isset($_SESSION['cari']))
		{
			$cari = $_SESSION['cari'];
			$kw = $this->db->escape_like_str($cari);
			$kw = '%' .$kw. '%';
			$search_sql= " AND (gambar LIKE '$kw' OR nama LIKE '$kw')";
			return $search_sql;
		}
	}

	private function filter_sql()
	{
		if (isset($_SESSION['filter']))
		{
			$kf = $_SESSION['filter'];
			$filter_sql= " AND enabled = $kf";
			return $filter_sql;
		}
	}
*/
	public function paging($p=1, $o=0)
	{
		$sql = "SELECT COUNT(*) AS jml " . $this->list_data_sql();
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$jml_data = $row['jml'];

		$this->load->library('paging');
		$cfg['page'] = $p;
		$cfg['per_page'] = $_SESSION['per_page'];
		$cfg['num_rows'] = $jml_data;
		$this->paging->init($cfg);

		return $this->paging;
	}

	private function list_data_sql()
	{
		$sql = " FROM tbl_tawa WHERE tipe = 0  ";
//		$sql .= $this->search_sql();
//		$sql .= $this->filter_sql();
		return $sql;
	}

	public function list_data($o=0, $offset=0, $limit=500)
	{
		
		switch ($o)
		{
			case 1: $order_sql = ' ORDER BY nama'; break;
			case 2: $order_sql = ' ORDER BY nama DESC'; break;
			case 3: $order_sql = ' ORDER BY enabled'; break;
			case 4: $order_sql = ' ORDER BY enabled DESC'; break;
			case 5: $order_sql = ' ORDER BY tgl_upload'; break;
			case 6: $order_sql = ' ORDER BY tgl_upload DESC'; break;
			default:$order_sql = ' ORDER BY urut';
		}

		$paging_sql = ' LIMIT ' .$offset. ',' .$limit;

		$sql = "SELECT * " . $this->list_data_sql();
		$sql .= $order_sql;
		$sql .= $paging_sql;

		$query = $this->db->query($sql);
		$data = $query->result_array();

		$j = $offset;
		for ($i=0; $i<count($data); $i++)
		{
			$data[$i]['no'] = $j + 1;

			if ($data[$i]['enabled'] == 1)
				$data[$i]['aktif'] = "Ya";
			else
				$data[$i]['aktif'] = "Tidak";

			$j++;
		}
		return $data;
	}
	

	public function gallery_slider($id='', $val=0)
	{
		if ($val == 1)
		{
			// Hanya satu gallery yang boleh tampil di slider
			$this->db->where('slider', 1)
				->set('slider', 0)
				->update('tbl_tawa');
			// Aktifkan galeri kalau digunakan untuk slider
			$this->db->set('enabled', 1);
		}
		$this->db->where('id', $id)
			->set('slider', $val)
			->update('tbl_tawa');
	}

	public function get_usaha($id=0)
	{
		$sql = "SELECT * FROM tbl_tawa WHERE id = ?";
		$query = $this->db->query($sql, $id);
		$data = $query->row_array();
		return $data;
	}

	public function list_slide_galeri()
	{
		$gallery_slide_id = $this->db->select('id')
			->where('slider', 1)
			->limit(1)
			->get('tbl_tawa')->row()->id;
		$slide_galeri = $this->db->select('id, nama as judul, gambar')
			->where('parrent', $gallery_slide_id)
			->where('tipe', 2)
			->where('enabled', 1)
			->get('tbl_tawa')->result_array();
		return $slide_galeri;
	}

	public function paging2($gal=0, $p=1)
	{
		$sql = "SELECT COUNT(*) AS jml " . $this->list_layanan_sql();
		$query = $this->db->query($sql,$gal);
		$row = $query->row_array();
		$jml_data = $row['jml'];

		$this->load->library('paging');
		$cfg['page'] = $p;
		$cfg['per_page'] = $_SESSION['per_page'];
		$cfg['num_rows'] = $jml_data;
		$this->paging->init($cfg);

		return $this->paging;
	}

	private function list_layanan_sql()
	{
		$sql = " FROM tbl_tawa WHERE parrent = ? AND tipe = 2 ";
//		$sql .= $this->search_sql();
//		$sql .= $this->filter_sql();
		return $sql;
	}

	public function list_layanan($gal=1, $o=0, $offset=0, $limit=500)
	{
		switch($o)
		{
			case 1: $order_sql = ' ORDER BY nama'; break;
			case 2: $order_sql = ' ORDER BY nama DESC'; break;
			case 3: $order_sql = ' ORDER BY enabled'; break;
			case 4: $order_sql = ' ORDER BY enabled DESC'; break;
			case 5: $order_sql = ' ORDER BY tgl_upload'; break;
			case 6: $order_sql = ' ORDER BY tgl_upload DESC'; break;
			default:$order_sql = ' ORDER BY urut';
		}

		$paging_sql = ' LIMIT ' .$offset. ',' .$limit;

		$sql = "SELECT * " . $this->list_layanan_sql();
		$sql .= $order_sql;
		$sql .= $paging_sql;
		$query = $this->db->query($sql, $gal);
		$data = $query->result_array();

		for ($i=0; $i<count($data); $i++)
		{
			$data[$i]['no'] = $i + 1;

			if ($data[$i]['enabled'] == 1)
				$data[$i]['aktif'] = "Ya";
			else
				$data[$i]['aktif'] = "Tidak";
		}
		return $data;
	}


	// $arah:
	//		1 - turun
	// 		2 - naik
	public function urut($id, $arah, $gallery='')
	{
  	$subset = !empty($gallery) ? array('parrent' => $gallery) : array('parrent' => 0);
  	$this->urut_model->urut($id, $arah, $subset);
	}
	
	public function list_lokasi_tawa()
	{
		$data = $this->db->select([
			'p.*',
			"(CASE WHEN p.id_lokasi IS NOT NULL THEN CONCAT(
				(CASE WHEN w.rt != '0' THEN CONCAT('RT ', w.rt, ' / ') ELSE '' END),
				(CASE WHEN w.rw != '0' THEN CONCAT('RW ', w.rw, ' - ') ELSE '' END),
				w.dusun
			) ELSE p.lokasi END) AS alamat",
		])
		->from('tbl_tawa p')
		->where('p.status = 1')
		->join('tweb_wil_clusterdesa w', 'p.id_lokasi = w.id', 'left')
		->get()
		->result();

		return $data;
	}
	
}
?>

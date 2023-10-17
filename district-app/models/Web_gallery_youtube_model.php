<?php class Web_gallery_youtube_model extends MY_Model {

	private $urut_model;

	public function __construct()
	{
		parent::__construct();
	  require_once APPPATH.'/models/Urut_model.php';
		$this->urut_model = new Urut_Model('gallery_youtube');
	}

	public function autocomplete()
	{
		return $this->autocomplete_str('nama', 'gallery_youtube');
	}

	private function search_sql()
	{
		if (isset($_SESSION['cari']))
		{
			$cari = $_SESSION['cari'];
			$kw = $this->db->escape_like_str($cari);
			$kw = '%' .$kw. '%';
			$search_sql= " AND (link LIKE '$kw' OR nama LIKE '$kw')";
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
		$sql = " FROM gallery_youtube WHERE tipe = 0  ";
		$sql .= $this->search_sql();
		$sql .= $this->filter_sql();
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

	public function insert()
	{
		$_SESSION['success'] = 1;
		$_SESSION['error_msg'] = '';

		$data = [];
		$data['nama'] = nomor_surat_keputusan($this->input->post('nama')); //pastikan nama album hanya berisi karakter yg diizinkan seperti pada nomor sk
		$data['urut'] = $this->urut_model->urut_max(array('parrent' => 0)) + 1;
		$data['link'] = $this->input->post('link'); //link Video Embed Youtube
		$data['deskripsi'] = $this->input->post('deskripsi'); //deskripsi Video

		if ($_SESSION['grup'] == 4)
		{
			$data['enabled'] = 2;
		}

		$outp = $this->db->insert('gallery_youtube', $data);
		if (!$outp) $_SESSION['success'] = -1;
	}

	public function update($id=0)
	{
		$_SESSION['success'] = 1;
		$_SESSION['error_msg'] = '';

		$data = [];
		$data['nama'] = nomor_surat_keputusan($this->input->post('nama')); //pastikan nama album hanya berisi karakter yg diizinkan seperti pada nomor sk
		$data['link'] = $this->input->post('link'); //pastikan nama album hanya berisi karakter yg diizinkan seperti pada nomor sk
		$data['deskripsi'] = $this->input->post('deskripsi'); //deskripsi Video
		
		if ($_SESSION['grup'] == 4)
		{
			$data['enabled'] = 2;
		}

		unset($data['old_link']);
		$outp = $this->db->where('id', $id)->update('gallery_youtube', $data);
		if (!$outp) $_SESSION['success'] = -1;
	}

	public function delete_gallery($id='', $semua=false)
	{
		if (!$semua) $this->session->success = 1;

		$this->delete($id);
		$sub_gallery = $this->db->select('id')->
			where('parrent', $id)->
			get('gallery_youtube')->result_array();
		foreach ($sub_gallery as $gallery)
		{
			$this->delete($gallery['id']);
		}
	}

	public function delete_all_gallery()
	{
		$this->session->success = 1;

		$id_cb = $_POST['id_cb'];
		foreach ($id_cb as $id)
		{
			$this->delete_gallery($id, $semua=true);
		}
	}

	public function delete($id='', $semua=false)
	{
		if (!$semua) $this->session->success = 1;
		// Note:
		// link yang dihapus ada kemungkinan dipakai
		// oleh gallery lain, karena ketika mengupload
		// nama file nya belum diubah sesuai dengan
		// judul gallery
		$this->delete_gallery_image($id);

		$outp = $this->db->where('id', $id)->delete('gallery_youtube');

		status_sukses($outp, $gagal_saja=true); //Tampilkan Pesan
	}

	public function delete_all()
	{
		$this->session->success = 1;

		$id_cb = $_POST['id_cb'];
		foreach ($id_cb as $id)
		{
			$this->delete($id, $semua=true);
		}
	}

	public function delete_gallery_image($id)
	{
		$image = $this->db->select('link')->
			get_where('gallery_youtube', array('id'=>$id))->
			row()->link;
		$prefix = array('kecil_', 'sedang_');
		foreach ($prefix as $pref)
		{
			if (is_file(FCPATH . LOKASI_GALERI . $pref . $image))
				unlink(FCPATH . LOKASI_GALERI . $pref . $image);
		}
	}

	public function gallery_lock($id='', $val=0)
	{
		// Jangan kunci jika digunakan untuk slider
		if ($val == 2)
		{
			$this->db
				->group_start()
					->where('slider <>', 1)
					->or_where('slider IS NULL')
				->group_end();
		}
		$outp = $this->db
			->where('id', $id)
			->set('enabled', $val)
			->update('gallery_youtube');
		status_sukses($outp); //Tampilkan Pesan
	}

	public function gallery_slider($id='', $val=0)
	{
		if ($val == 1)
		{
			// Hanya satu gallery yang boleh tampil di slider
			$this->db->where('slider', 1)
				->set('slider', 0)
				->update('gallery_youtube');
			// Aktifkan galeri kalau digunakan untuk slider
			$this->db->set('enabled', 1);
		}
		$this->db->where('id', $id)
			->set('slider', $val)
			->update('gallery_youtube');
	}

	public function get_gallery($id=0)
	{
		$sql = "SELECT * FROM gallery_youtube WHERE id = ?";
		$query = $this->db->query($sql, $id);
		$data = $query->row_array();
		return $data;
	}

	public function list_slide_galeri()
	{
		$gallery_slide_id = $this->db->select('id')
			->where('slider', 1)
			->limit(1)
			->get('gallery_youtube')->row()->id;
		$slide_galeri = $this->db->select('id, nama as judul, link')
			->where('parrent', $gallery_slide_id)
			->where('tipe', 2)
			->where('enabled', 1)
			->get('gallery_youtube')->result_array();
		return $slide_galeri;
	}

	public function paging2($gal=0, $p=1)
	{
		$sql = "SELECT COUNT(*) AS jml " . $this->list_sub_gallery_sql();
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

	private function list_sub_gallery_sql()
	{
		$sql = " FROM gallery_youtube WHERE parrent = ? AND tipe = 2 ";
		$sql .= $this->search_sql();
		$sql .= $this->filter_sql();
		return $sql;
	}

	public function list_sub_gallery($gal=1, $o=0, $offset=0, $limit=500)
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

		$sql = "SELECT * " . $this->list_sub_gallery_sql();
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

	public function insert_sub_gallery($parrent=0)
	{
		$_SESSION['success'] = 1;
		$_SESSION['error_msg'] = '';

		$data = [];
		$data['nama'] = nomor_surat_keputusan($this->input->post('nama')); //pastikan nama album hanya berisi
		$data['urut'] = $this->urut_model->urut_max(array('parrent' => $parrent)) + 1;
		$data['link'] = $this->input->post('link'); //pastikan link terisi
		$data['deskripsi'] = $this->input->post('deskripsi'); //pastikan link terisi

		if ($_SESSION['grup'] == 4)
		{
			$data['enabled'] = 2;
		}

		$data['parrent'] = $parrent;
		$data['tipe'] = 2;
		$outp = $this->db->insert('gallery_youtube', $data);
		if (!$outp) $_SESSION['success'] = -1;
	}

	public function update_sub_gallery($id=0)
	{
		$_SESSION['success'] = 1;
		$_SESSION['error_msg'] = '';

		$data = [];
		$data['nama'] = nomor_surat_keputusan($this->input->post('nama')); //pastikan nama album hanya berisi
		$data['link'] = $this->input->post('link'); //pastikan nama album hanya berisi
		$data['deskripsi'] = $this->input->post('deskripsi'); //pastikan nama album hanya berisi

		$outp = $this->db->where('id', $id)->update('gallery_youtube', $data);
		if (!$outp) $_SESSION['success'] = -1;
	}

	// $arah:
	//		1 - turun
	// 		2 - naik
	public function urut($id, $arah, $gallery='')
	{
  	$subset = !empty($gallery) ? array('parrent' => $gallery) : array('parrent' => 0);
  	$this->urut_model->urut($id, $arah, $subset);
	}
}

<?php class Wisata_model extends MY_Model {

	private $urut_model;

	public function __construct()
	{
		parent::__construct();
	  require_once APPPATH.'/models/Urut_model.php';
		$this->urut_model = new Urut_Model('tbl_wisata');
	}

	public function autocomplete()
	{
		return $this->autocomplete_str('nama', 'tbl_wisata');
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
		$sql = " FROM tbl_wisata WHERE tipe = 0  ";
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
		if (UploadError($_FILES['gambar']))
		{
			$_SESSION['success'] = -1;
			return;
		}

	  $lokasi_file = $_FILES['gambar']['tmp_name'];
	  $tipe_file = TipeFile($_FILES['gambar']);
	  
		$data = [];
		$data['nama'] = nomor_surat_keputusan($this->input->post('nama')); //pastikan nama album hanya berisi karakter yg diizinkan seperti pada nomor sk
		$data['urut'] = $this->urut_model->urut_max(array('parrent' => 0)) + 1;
		
		//Form Data Toko
		$data['nama_pengelola'] 			= $this->input->post('nama_pengelola');
		$data['nik']        				= $this->input->post('nik');
		$data['alamat_pengelola']     		= $this->input->post('alamat_pengelola');
		$data['no_hp_pengelola']        				= $this->input->post('no_hp_pengelola');
		$data['no_hp_wisata']        				= $this->input->post('no_hp_wisata');
		$data['email']        				= $this->input->post('email');
		$data['website']        			= $this->input->post('website');
		$data['fb']        					= $this->input->post('fb');
		$data['ig']        					= $this->input->post('ig');
		$data['youtube']        			= $this->input->post('youtube');
		$data['sumber_modal']       		= $this->input->post('sumber_modal');
		$data['nama']         				= $this->input->post('nama');
		$data['kepemilikan_tempat_usaha']	= $this->input->post('kepemilikan_tempat_usaha');
		$data['jumlah_karyawan']            = $this->input->post('jumlah_karyawan');
		$data['tahun_berdiri']     			= $this->input->post('tahun_berdiri');
		$data['id_lokasi']             		= $this->input->post('id_lokasi');
		$data['lokasi']             		= $this->input->post('lokasi');
		$data['keterangan_lokasi']         	= $this->input->post('keterangan_lokasi');
		
		$data['jenis_wisata']				= $this->input->post('jenis_wisata');
		$data['daya_tarik_utama'] 			= $this->input->post('daya_tarik_utama');
		$data['luas_area']				= $this->input->post('luas_area');
		$data['jarak_tempuh']				= $this->input->post('jarak_tempuh');
		$data['waktu_tempuh']				= $this->input->post('waktu_tempuh');
		$data['cara_tempuh']         				= $this->input->post('cara_tempuh');
		$data['sebutan_biaya']         				= $this->input->post('sebutan_biaya');
		$data['sebutan_ukuran']         				= $this->input->post('sebutan_ukuran');
		
		$data['updated_at']         		= date('Y-m-d H:i:s');
		$data['created_at']         		= date('Y-m-d H:i:s');
		$data['taksiran_modal']     		= $this->input->post('taksiran_modal');
		$data['taksiran_omset']     		= $this->input->post('taksiran_omset');
		$data['harga'] 						= $this->input->post('harga');
		$data['deskripsi'] 					= $this->input->post('deskripsi');

		$data['skdu']     		= $this->input->post('skdu');
		$data['iud']     		= $this->input->post('iud');
		$data['npwp']     		= $this->input->post('npwp');
		$data['situ']     		= $this->input->post('situ');
		$data['siui']     		= $this->input->post('siui');
		$data['sip']     		= $this->input->post('sip');
		$data['siup']     		= $this->input->post('siup');
		$data['tdp']     		= $this->input->post('tdp');
		$data['tdi']     		= $this->input->post('tdi');
		$data['imb']     		= $this->input->post('imb');
		$data['bpom']     		= $this->input->post('bpom');
		$data['ho']     		= $this->input->post('ho'); 
		
		
		// Bolehkan album tidak ada gambar cover
		if (!empty($lokasi_file))
		{
		  if (!CekGambar($_FILES['gambar'], $tipe_file))
		  {
				$_SESSION['success'] = -1;
				return;
		  }
		  $nama_file  = urlencode(generator(6)."_".$_FILES['gambar']['name']);
			UploadGallery($nama_file, "", $tipe_file);
			$data['gambar'] = $nama_file;
		}

		if ($_SESSION['grup'] == 4)
		{
			$data['enabled'] = 2;
		}

		$outp = $this->db->insert('tbl_wisata', $data);
		if (!$outp) $_SESSION['success'] = -1;
	}

	public function update($id=0)
	{
		$_SESSION['success'] = 1;
		$_SESSION['error_msg'] = '';
		if (UploadError($_FILES['gambar']))
		{
			$_SESSION['success'] = -1;
			return;
		}

	  $lokasi_file = $_FILES['gambar']['tmp_name'];
	  $tipe_file = TipeFile($_FILES['gambar']);
		$data = [];
		$data['nama'] = nomor_surat_keputusan($this->input->post('nama')); //pastikan nama album hanya berisi karakter yg diizinkan seperti pada nomor sk
		
		//Form Data Toko
		$data['nama_pengelola'] 			= $this->input->post('nama_pengelola');
		$data['nik']        				= $this->input->post('nik');
		$data['alamat_pengelola']     		= $this->input->post('alamat_pengelola');
		$data['no_hp_pengelola']        				= $this->input->post('no_hp_pengelola');
		$data['no_hp_wisata']        				= $this->input->post('no_hp_wisata');
		$data['email']        			= $this->input->post('email');
		$data['website']        			= $this->input->post('website');
		$data['fb']        					= $this->input->post('fb');
		$data['ig']        					= $this->input->post('ig');
		$data['youtube']        			= $this->input->post('youtube');
		$data['sumber_modal']       		= $this->input->post('sumber_modal');
		$data['nama']         				= $this->input->post('nama');
		$data['kepemilikan_tempat_usaha']	= $this->input->post('kepemilikan_tempat_usaha');
		$data['jumlah_karyawan']            = $this->input->post('jumlah_karyawan');
		$data['tahun_berdiri']     			= $this->input->post('tahun_berdiri');
		$data['id_lokasi']             		= $this->input->post('id_lokasi');
		$data['lokasi']             		= $this->input->post('lokasi');
		$data['keterangan_lokasi']         	= $this->input->post('keterangan_lokasi');
		
		$data['jenis_wisata']				= $this->input->post('jenis_wisata');
		$data['daya_tarik_utama'] 			= $this->input->post('daya_tarik_utama');
		$data['luas_area']				= $this->input->post('luas_area');
		$data['jarak_tempuh']				= $this->input->post('jarak_tempuh');
		$data['waktu_tempuh']				= $this->input->post('waktu_tempuh');
		$data['cara_tempuh']         				= $this->input->post('cara_tempuh');
		$data['sebutan_biaya']         				= $this->input->post('sebutan_biaya');
		$data['sebutan_ukuran']         				= $this->input->post('sebutan_ukuran');
		
		$data['updated_at']         		= date('Y-m-d H:i:s');
		$data['taksiran_modal']     		= $this->input->post('taksiran_modal');
		$data['taksiran_omset']     		= $this->input->post('taksiran_omset');
		$data['harga'] 						= $this->input->post('harga');
		$data['deskripsi'] 					= $this->input->post('deskripsi');

		$data['skdu']     		= $this->input->post('skdu');
		$data['iud']     		= $this->input->post('iud');
		$data['npwp']     		= $this->input->post('npwp');
		$data['situ']     		= $this->input->post('situ');
		$data['siui']     		= $this->input->post('siui');
		$data['sip']     		= $this->input->post('sip');
		$data['siup']     		= $this->input->post('siup');
		$data['tdp']     		= $this->input->post('tdp');
		$data['tdi']     		= $this->input->post('tdi');
		$data['imb']     		= $this->input->post('imb');
		$data['bpom']     		= $this->input->post('bpom');
		$data['ho']     		= $this->input->post('ho'); 
		
		// Kalau kosong, gambar tidak diubah
		if (!empty($lokasi_file))
		{
		  if (!CekGambar($_FILES['gambar'], $tipe_file))
		  {
				$_SESSION['success'] = -1;
				return;
		  }
		  $nama_file  = urlencode(generator(6)."_".$_FILES['gambar']['name']);
			UploadGallery($nama_file, $data['old_gambar'], $tipe_file);
			$data['gambar'] = $nama_file;
		}

		if ($_SESSION['grup'] == 4)
		{
			$data['enabled'] = 2;
		}

		unset($data['old_gambar']);
		$outp = $this->db->where('id', $id)->update('tbl_wisata', $data);
		if (!$outp) $_SESSION['success'] = -1;
	}

	public function delete_gallery($id='', $semua=false)
	{
		if (!$semua) $this->session->success = 1;

		$this->delete($id);
		$sub_gallery = $this->db->select('id')->
			where('parrent', $id)->
			get('tbl_wisata')->result_array();
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
		// Gambar yang dihapus ada kemungkinan dipakai
		// oleh gallery lain, karena ketika mengupload
		// nama file nya belum diubah sesuai dengan
		// judul gallery
		$this->delete_gallery_image($id);

		$outp = $this->db->where('id', $id)->delete('tbl_wisata');

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
		$image = $this->db->select('gambar')->
			get_where('tbl_wisata', array('id'=>$id))->
			row()->gambar;
		$prefix = array('kecil_', 'sedang_');
		foreach ($prefix as $pref)
		{
			if (is_file(FCPATH . LOKASI_GALERI . $pref . $image))
				unlink(FCPATH . LOKASI_GALERI . $pref . $image);
		}
	}

	public function wisata_lock($id='', $val=0)
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
			->update('tbl_wisata');
		status_sukses($outp); //Tampilkan Pesan
	}

	public function gallery_slider($id='', $val=0)
	{
		if ($val == 1)
		{
			// Hanya satu gallery yang boleh tampil di slider
			$this->db->where('slider', 1)
				->set('slider', 0)
				->update('tbl_wisata');
			// Aktifkan galeri kalau digunakan untuk slider
			$this->db->set('enabled', 1);
		}
		$this->db->where('id', $id)
			->set('slider', $val)
			->update('tbl_wisata');
	}

	public function get_wisata($id=0)
	{
		$sql = "SELECT * FROM tbl_wisata WHERE id = ?";
		$query = $this->db->query($sql, $id);
		$data = $query->row_array();
		return $data;
	}

	public function list_slide_galeri()
	{
		$gallery_slide_id = $this->db->select('id')
			->where('slider', 1)
			->limit(1)
			->get('tbl_wisata')->row()->id;
		$slide_galeri = $this->db->select('id, nama as judul, gambar')
			->where('parrent', $gallery_slide_id)
			->where('tipe', 2)
			->where('enabled', 1)
			->get('tbl_wisata')->result_array();
		return $slide_galeri;
	}

	public function paging2($gal=0, $p=1)
	{
		$sql = "SELECT COUNT(*) AS jml " . $this->list_fasilitas_sql();
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

	private function list_fasilitas_sql()
	{
		$sql = " FROM tbl_wisata WHERE parrent = ? AND tipe = 2 ";
		$sql .= $this->search_sql();
		$sql .= $this->filter_sql();
		return $sql;
	}

	public function list_fasilitas($gal=1, $o=0, $offset=0, $limit=500)
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

		$sql = "SELECT * " . $this->list_fasilitas_sql();
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

	public function insert_fasilitas($parrent=0)
	{
		$_SESSION['success'] = 1;
		$_SESSION['error_msg'] = '';
		if (UploadError($_FILES['gambar']))
		{
			$_SESSION['success'] = -1;
			return;
		}

	  $lokasi_file = $_FILES['gambar']['tmp_name'];
	  $tipe_file = TipeFile($_FILES['gambar']);
		$data = [];
		$data['nama'] = nomor_surat_keputusan($this->input->post('nama')); //pastikan nama album hanya berisi
		$data['harga'] = $this->input->post('harga'); //pastikan nama album hanya berisi
		$data['diskon'] = $this->input->post('diskon'); 
		$data['sebutan_biaya'] = $this->input->post('sebutan_biaya'); 
		$data['sebutan_ukuran'] = $this->input->post('sebutan_ukuran'); 
		$data['deskripsi'] = nomor_surat_keputusan($this->input->post('deskripsi')); 
		
		$data['urut'] = $this->urut_model->urut_max(array('parrent' => $parrent)) + 1;
		// Bolehkan isi album tidak ada gambar
		if (!empty($lokasi_file))
		{
		  if (!CekGambar($_FILES['gambar'], $tipe_file))
		  {
				$_SESSION['success'] = -1;
				return;
		  }
		  $nama_file  = urlencode(generator(6)."_".$_FILES['gambar']['name']);
			UploadGallery($nama_file, "", $tipe_file);
			$data['gambar'] = $nama_file;
		}

		if ($_SESSION['grup'] == 4)
		{
			$data['enabled'] = 2;
		}

		$data['parrent'] = $parrent;
		$data['tipe'] = 2;
		$outp = $this->db->insert('tbl_wisata', $data);
		if (!$outp) $_SESSION['success'] = -1;
	}

	public function update_fasilitas($id=0)
	{
		$_SESSION['success'] = 1;
		$_SESSION['error_msg'] = '';
		if (UploadError($_FILES['gambar']))
		{
			$_SESSION['success'] = -1;
			return;
		}

	  $lokasi_file = $_FILES['gambar']['tmp_name'];
	  $tipe_file = TipeFile($_FILES['gambar']);
		$data = [];
		$data['nama'] = nomor_surat_keputusan($this->input->post('nama')); //pastikan nama album hanya berisi
		$data['harga'] = $this->input->post('harga'); //pastikan harga hanya berisi
		$data['diskon'] = $this->input->post('diskon'); 
		$data['sebutan_biaya'] = $this->input->post('sebutan_biaya'); 
		$data['sebutan_ukuran'] = $this->input->post('sebutan_ukuran'); 
		$data['deskripsi'] = nomor_surat_keputusan($this->input->post('deskripsi')); 
		
		// Kalau kosong, gambar tidak diubah
		if (!empty($lokasi_file))
		{
		  if (!CekGambar($_FILES['gambar'], $tipe_file))
		  {
				$_SESSION['success'] = -1;
				return;
		  }
		  $nama_file  = urlencode(generator(6)."_".$_FILES['gambar']['name']);
			UploadGallery($nama_file,$data['old_gambar'], $tipe_file);
			$data['gambar'] = $nama_file;
		}

		unset($data['old_gambar']);
		$outp = $this->db->where('id', $id)->update('tbl_wisata', $data);
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
		
	public function update_map($id, array $request)
	{
		$post = $this->input->post();

		$data['lat']        = $post['lat'];
		$data['lng']              = $post['lng'];
		$data['updated_at']             = $post['updated_at'];

		$this->db->where('id', $id);
		$outp = $this->db->update('tbl_wisata', $data);

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}

	public function update_lokasi_maps($id, array $request)
	{
		return $this->db->where('id', $id)->update($this->table, [
			'lat'        => $request['lat'],
			'lng'        => $request['lng'],
			'updated_at' => date('Y-m-d H:i:s'),
		]);
	}


}
?>

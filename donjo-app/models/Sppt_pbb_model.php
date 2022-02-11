<?php
class Sppt_pbb_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->model('data_persil_model');
	}
	
	public function autocomplete($cari='')
	{
		$cari = $this->db->escape_like_str($cari);
		$sql_kolom = [];
		$list_kolom = [
			'no_hp' => 'pbb_data_tagih',
			'nama_tertagih_luar' => 'pbb_data_tagih',
			'nama_tertagih_warga' => 'pbb_data_tagih'
		];
		foreach ($list_kolom as $kolom => $tabel)
		{
			$this->db->select($kolom.' as item')
				->distinct()->from($tabel)
				->order_by('item');
			if ($cari) $this->db->like($kolom, $cari);
			$sql_kolom[] = $this->db->get_compiled_select();
		}
		$this->db->select('u.nama as item')
			->from('pbb_data_tagih c')
			->distinct()
			->join('pbb_penduduk cu', 'cu.id_pbb = c.id', 'left')
			->join('tweb_penduduk u', 'u.id = cu.id_pend', 'left')
			->order_by('item');
			if ($cari) $this->db->like('u.nama', $cari);
			$sql_kolom[] = $this->db->get_compiled_select();;
		$sql = '('.implode(') UNION (', $sql_kolom).')';

		$query = $this->db->query($sql);
		$data = $query->result_array();

		$str = autocomplete_data_ke_str($data);
		return $str;
	}

	public function autocomplete2($cari='')
	{
		$cari = $this->db->escape_like_str($cari);
		$sql_kolom = [];
		$list_kolom = [
			'no_hp' => 'pbb_data_tagih',
			'nama_tertagih_luar' => 'pbb_data_tagih',
			'nama_tertagih_warga' => 'pbb_data_tagih'
		];
		foreach ($list_kolom as $kolom => $tabel)
		{
			$this->db->select($kolom.' as item')
				->distinct()->from($tabel)
				->order_by('item');
			if ($cari) $this->db->like($kolom, $cari);
			$sql_kolom[] = $this->db->get_compiled_select();
		}
		$this->db->select('u.nama as item')
			->from('pbb_data_tagih c')
			->distinct()
			->join('pbb_penduduk cu', 'cu.id_pbb = c.id', 'left')
			//->join('tweb_penduduk u', 'u.id = cu.id_pend', 'left')
			->order_by('item');
			if ($cari) $this->db->like('u.nama', $cari);
			$sql_kolom[] = $this->db->get_compiled_select();;
		$sql = '('.implode(') UNION (', $sql_kolom).')';

		$query = $this->db->query($sql);
		$data = $query->result_array();

		$str = autocomplete_data_ke_str($data);
		return $str;
	}



	private function search_sql()
	{
		if ($this->session->cari)
		{
			$cari = $this->session->cari;
			$cari = $this->db->escape_like_str($cari);
			$this->db
				->group_start()
					->like('u.nama', $cari)
					->or_like('c.nama_tertagih_warga', $cari)
					->or_like('c.nama_tertagih_warga', $cari)
					->or_like('c.no_hp', $cari)
				->group_end();
		}
	}

	private function main_sql_pbb()
	{
		$this->db->from('pbb_data_tagih c')
			->join('mutasi_pbb m', 'm.id_pbb_masuk = c.id or m.pbb_keluar = c.id', 'left')
			->join('persil p', 'p.id = m.id_persil or c.id = p.cdesa_awal', 'left')
			->join('ref_persil_kelas k', 'k.id = p.kelas', 'left')
			->join('pbb_penduduk cu', 'cu.id_pbb = c.id', 'left')
			->join('tweb_penduduk u', 'u.id = cu.id_pend', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = u.id_cluster', 'left');
		$this->search_sql();
	}

	public function paging_pbb($p=1)
	{
		$this->main_sql_pbb();
		$jml_data = $this->db
			->select('COUNT(DISTINCT c.id) AS jml')
			->get()
			->row()
			->jml;

		$this->load->library('paging');
		$cfg['page'] = $p;
		$cfg['per_page'] = $_SESSION['per_page'];
		$cfg['num_rows'] = $jml_data;
		$this->paging->init($cfg);

		return $this->paging;
	}
	
	public function list_pbb_tagih($offset=0, $per_page='', $kecuali=[])
	{
		$kecuali = sql_in_list($kecuali);
		$data = [];
		$this->main_sql_pbb();
		$this->db
			->select('c.*, c.id as id_pbb, c.created_at as tanggal_daftar, cu.id_pend')
			->select('u.nik AS nik, u.nama as nama_tertagih, w.*')
			->select('(CASE WHEN c.kategori_warga = 1 THEN u.nama ELSE c.nama_tertagih_luar END) AS nama_tertagih')
			->select('(CASE WHEN c.kategori_warga = 1 THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE c.alamat_tertagih_luar END) AS alamat')
			->select('COUNT(DISTINCT p.id) AS jumlah')
			->order_by('cast(c.no_hp as unsigned)')
			->group_by('c.id, cu.id');
		if ($per_page) $this->db->limit($per_page, $offset);
  	if ($kecuali)	$this->db->where("c.id not in ($kecuali)");
		$data = $this->db
			->get()
			->result_array();
		$j = $offset;
		for ($i=0; $i<count($data); $i++)
		{
			$data[$i]['no'] = $j + 1;
			$luas_persil = $this->jumlah_luas($data[$i]['id_pbb']);
			$data[$i]['basah'] = $luas_persil['BASAH'];
			$data[$i]['kering'] = $luas_persil['KERING'];
			$j++;
		}
		return $data;
	}

	public function list_pbb($offset=0, $per_page='', $kecuali=[])
	{
		$kecuali = sql_in_list($kecuali);
		$data = [];
		$this->main_sql_pbb();
		$this->db
			->select('c.*, c.id as id_pbb, c.created_at as tanggal_daftar, cu.id_pend')
			->select('u.nik AS nik, u.nama as namapemilik, w.*')
			->select('(CASE WHEN c.kategori_warga = 1 THEN u.nama ELSE c.nama_tertagih_luar END) AS namapemilik')
			->select('(CASE WHEN c.kategori_warga = 1 THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE c.alamat_tertagih_luar END) AS alamat')
			->select('COUNT(DISTINCT p.id) AS jumlah')
			->order_by('cast(c.no_hp as unsigned)')
			->group_by('c.id, cu.id');
		if ($per_page) $this->db->limit($per_page, $offset);
  	if ($kecuali)	$this->db->where("c.id not in ($kecuali)");
		$data = $this->db
			->get()
			->result_array();
		$j = $offset;
		for ($i=0; $i<count($data); $i++)
		{
			$data[$i]['no'] = $j + 1;
			$luas_persil = $this->jumlah_luas($data[$i]['id_pbb']);
			$data[$i]['basah'] = $luas_persil['BASAH'];
			$data[$i]['kering'] = $luas_persil['KERING'];
			$j++;
		}
		return $data;
	}

	// Untuk cetak daftar SPPT PBB, menghitung jumlah luas per kelas persil
 	// Perhitungkan kasus suatu SPPT PBB adalah pemilik awal keseluruhan persil
	public function jumlah_luas($id_pbb)
	{
		// luas total = jumlah luas setiap persil untuk pbb
		// luas persil = luas keseluruhan persil (kalau pemilik awal) +/- luas setiap mutasi tergantung masuk atau keluar
		// Jumlahkan sesuai dengan tipe kelas persil (basah atau kering)
		$persil_awal = $this->db
			->select('p.id, luas_persil, k.tipe')
			->from('persil p')
			->join('ref_persil_kelas k', 'p.kelas = k.id')
			->where('cdesa_awal', $id_pbb)
			->get()
			->result_array();
		$luas_persil = [];
		foreach ($persil_awal as $persil)
		{
			$luas_persil[$persil['tipe']][$persil['id']] = $persil['luas_persil'];
		}
		$list_mutasi = $this->db
			->select('m.id_persil, m.luas, m.pbb_keluar, k.tipe')
			->from('mutasi_pbb m')
			->join('persil p', 'p.id = m.id_persil')
			->join('ref_persil_kelas k', 'p.kelas = k.id')
			->where('m.id_pbb_masuk', $id_pbb)
			->or_where('m.pbb_keluar', $id_pbb)
			->get('')
			->result_array();
		foreach ($list_mutasi as $mutasi)
		{
			if ($mutasi['pbb_keluar'] == $id_pbb)
			{
				$luas_persil[$mutasi['tipe']][$mutasi['id_persil']] -= $mutasi['luas'];
			}
			else
			{
				$luas_persil[$mutasi['tipe']][$mutasi['id_persil']] += $mutasi['luas'];
			}
		}
		$luas_total = [];
		foreach ($luas_persil as $key => $luas)
		{
			$luas_total[$key] += array_sum($luas);
		}
		return $luas_total;
	}

	public function get_persil($id_mutasi)
	{
		$data = $this->db->select('p.*, k.kode, k.tipe, k.ndesc')
			->select('(CASE WHEN p.id_wilayah IS NOT NULL THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE p.lokasi END) AS alamat')
			->from('mutasi_pbb m')
			->join('pbb_data_tagih c', 'c.id = m.id_pbb_masuk', 'left')
			->join('persil p', 'm.id_persil = p.id', 'left')
			->join('ref_persil_kelas k', 'k.id = p.kelas', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_wilayah', 'left')
			->where('m.id', $id_mutasi)
			->get()
			->row_array();
		return $data;
	}

	public function get_mutasi($id_mutasi)
	{
		$data = $this->db->select('m.*')
			->from('mutasi_pbb m')
			->where('m.id', $id_mutasi)
			->get('')
			->row_array();
		return $data;
	}

	public function get_pbb_data_tagih($id)
	{
		$data = $this->db->where('c.id', $id)
			->select('c.*')
			->select('(CASE WHEN c.kategori_warga = 1 THEN u.nama ELSE c.nama_tertagih_luar END) AS namapemilik')
			->select('(CASE WHEN c.kategori_warga = 1 THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE c.alamat_tertagih_luar END) AS alamat')
			->from('pbb_data_tagih c')
			->join('pbb_penduduk cu', 'cu.id_pbb = c.id', 'left')
			->join('tweb_penduduk u', 'u.id = cu.id_pend', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = u.id_cluster', 'left')
			->limit(1)
			->get()
			->row_array();

		return $data;
	}
	
	public function pbb_daftar_alamat_tagih_simpan()
	{
		$data = array();
		$data['no_hp'] = bilangan_spasi($this->input->post('pbb_data_tagih'));
		$data['nama_tertagih_warga'] = nama($this->input->post('nama_tertagih_warga'));
		$data['kategori_warga'] = $this->input->post('kategori_warga');
		$data['nama_tertagih_luar'] = nama($this->input->post('nama_tertagih_luar'));
		$data['alamat_tertagih_luar'] = strip_tags($this->input->post('alamat_tertagih_luar'));
		if ($id_pbb = $this->input->post('id'))
		{
			$data_lama = $this->db->where('id', $id_pbb)
				->get('pbb_data_tagih')->row_array();
			if ($data['no_hp'] == $data_lama['no_hp']) unset($data['no_hp']);
			if ($data['nama_tertagih_warga'] == $data_lama['nama_tertagih_warga']) unset($data['nama_tertagih_warga']);
			$data['updated_by'] = $this->session->user;
			$this->db->where('id', $id_pbb)
				->update('pbb_data_tagih', $data);
		}
		else
		{
			$data['created_by'] = $this->session->user;
			$data['updated_by'] = $this->session->user;
			$this->db->insert('pbb_data_tagih', $data);
			$id_pbb = $this->db->insert_id();
		}

		if ($this->input->post('kategori_warga') == 1)
		{
			$this->simpan_pemilik($id_pbb, $this->input->post('id_pend'));
		}
		else
		{
			$this->hapus_pemilik($id_pbb);
		}
		return $id_pbb;
	}
	
	private function hapus_tertagih($id_pbb)
	{
		$this->db->where('id_pbb', $id_pbb)
			->delete('pbb_penduduk');
	}
	
	private function simpan_tertagih($id_pbb, $id_pend)
	{
		// Hapus pemilik lama
		$this->hapus_pemilik($id_pbb);
		// Tambahkan pemiliki baru
		$data = array();
		$data['id_pbb'] = $id_pbb;
		$data['id_pend'] = $id_pend;
		$this->db->insert('pbb_penduduk', $data);
	}

/*	public function simpan_pbb()
	{
		$data = array();
		$data['no_hp'] = bilangan_spasi($this->input->post('pbb_data_tagih'));
		$data['nama_kepemilikan'] = nama($this->input->post('nama_kepemilikan'));
		$data['kategori_warga'] = $this->input->post('kategori_warga');
		$data['nama_tertagih_luar'] = nama($this->input->post('nama_tertagih_luar'));
		$data['alamat_tertagih_luar'] = strip_tags($this->input->post('alamat_tertagih_luar'));
		if ($id_pbb = $this->input->post('id'))
		{
			$data_lama = $this->db->where('id', $id_pbb)
				->get('pbb_data_tagih')->row_array();
			if ($data['no_hp'] == $data_lama['no_hp']) unset($data['no_hp']);
			if ($data['nama_kepemilikan'] == $data_lama['nama_kepemilikan']) unset($data['nama_kepemilikan']);
			$data['updated_by'] = $this->session->user;
			$this->db->where('id', $id_pbb)
				->update('pbb_data_tagih', $data);
		}
		else
		{
			$data['created_by'] = $this->session->user;
			$data['updated_by'] = $this->session->user;
			$this->db->insert('pbb_data_tagih', $data);
			$id_pbb = $this->db->insert_id();
		}

		if ($this->input->post('kategori_warga') == 1)
		{
			$this->simpan_pemilik($id_pbb, $this->input->post('id_pend'));
		}
		else
		{
			$this->hapus_pemilik($id_pbb);
		}
		return $id_pbb;
	}*/

	private function hapus_pemilik($id_pbb)
	{
		$this->db->where('id_pbb', $id_pbb)
			->delete('pbb_penduduk');
	}

	private function simpan_pemilik($id_pbb, $id_pend)
	{
		// Hapus pemilik lama
		$this->hapus_pemilik($id_pbb);
		// Tambahkan pemiliki baru
		$data = array();
		$data['id_pbb'] = $id_pbb;
		$data['id_pend'] = $id_pend;
		$this->db->insert('pbb_penduduk', $data);
	}

	public function simpan_mutasi($id_pbb, $id_mutasi, $post)
	{
		$data = array();
		$data['id_persil'] = $post['id_persil'];
		$data['id_pbb_masuk'] = $id_pbb;
		$data['no_bidang_persil'] = bilangan($post['no_bidang_persil']) ?: NULL;
		$data['no_objek_pajak'] = strip_tags($post['no_objek_pajak']);

		$data['tanggal_mutasi'] = $post['tanggal_mutasi'] ? tgl_indo_in($post['tanggal_mutasi']) : NULL;
		$data['jenis_mutasi'] = $post['jenis_mutasi'] ?: NULL;
		$data['luas'] = bilangan_titik($post['luas']) ?: NULL;
		$data['pbb_keluar'] = bilangan($post['pbb_keluar']) ?: NULL;
		$data['keterangan'] = strip_tags($post['keterangan']) ?: NULL;

		if ($id_mutasi)
			$outp = $this->db->where('id', $id_mutasi)->update('mutasi_pbb', $data);
		else
			$outp = $this->db->insert('mutasi_pbb', $data);
		if ($outp)
			{
				$_SESSION["success"] = 1;
				$_SESSION["pesan"] = "Data Persil telah DISIMPAN";
				$data["hasil"] = true;
				$data["id"]= $_POST["id_persil"];
				$data['jenis'] = $_POST["jenis"];
			}
		return $data;
	}

	public function hapus_pbb($id)
	{
		$outp = $this->db->where('id', $id)
			->delete('pbb_data_tagih');
		status_sukses($outp);
	}

	public function get_pemilik($id_pbb)
	{
		$this->db->select('p.id, p.nik, p.nama, k.no_kk, w.rt, w.rw, w.dusun')
			->select('(CASE WHEN c.kategori_warga = 1 THEN p.nama ELSE c.nama_tertagih_luar END) AS namapemilik')
			->select('(CASE WHEN c.kategori_warga = 1 THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE c.alamat_tertagih_luar END) AS alamat')
			->from('pbb_data_tagih c')
			->join('pbb_penduduk cp', 'c.id = cp.id_pbb', 'left')
			->join('tweb_penduduk p', 'p.id = cp.id_pend', 'left')
			->join('tweb_keluarga k','k.id = p.id_kk', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_cluster', 'left')
			->where('c.id', $id_pbb);
		$data = $this->db->get()->row_array();

		return $data;
	}

	public function get_list_mutasi($id_pbb, $id_persil='')
	{
		$nomor_pbb = $this->db->select('no_hp')
			->where('id', $id_pbb)
			->get('pbb_data_tagih')
			->row()->no_hp;
		$this->db
			->select('m.*, p.no_hp, rk.kode as kelas_tanah')
			->select('CONCAT("RT ", rt, " / RW ", rw, " - ", dusun) as lokasi, p.lokasi as alamat')
			->select("IF (m.id_pbb_masuk = {$id_pbb}, m.luas, '') AS luas_masuk")
			->select("IF (m.pbb_keluar = {$id_pbb}, m.luas, '') AS luas_keluar")
			->select("IF (m.jenis_mutasi = '9', 0, 1) AS awal")
			->from('mutasi_pbb m')
			->join('pbb_data_tagih c', 'c.id = m.id_pbb_masuk', 'left')
			->join('persil p', 'p.id = m.id_persil', 'left')
			->join('ref_persil_kelas rk', 'p.kelas = rk.id', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_wilayah', 'left')
			->group_start()
				->where('m.id_pbb_masuk', $id_pbb)
				->or_where('m.pbb_keluar', $id_pbb)
			->group_end()
			->order_by('awal, tanggal_mutasi');
		if ($id_persil)
			$this->db->where('m.id_persil', $id_persil);
		$data = $this->db->get()->result_array();
		return $data;
	}

	public function get_list_persil($id_pbb)
	{
		$this->db
			->select('p.*, rk.kode as kelas_tanah')
			->select('COUNT(m.id) as jml_mutasi')
			->select('CONCAT("RT ", rt, " / RW ", rw, " - ", dusun) as lokasi, p.lokasi as alamat')
			->from('persil p')
			->join('mutasi_pbb m', 'p.id = m.id_persil', 'left')
			->join('ref_persil_kelas rk', 'p.kelas = rk.id', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_wilayah', 'left')
			->group_start()
				->where('m.id_pbb_masuk', $id_pbb)
				->or_where('m.pbb_keluar', $id_pbb)
				->or_where('p.cdesa_awal', $id_pbb)
			->group_end()
			->group_by('p.id')
			->order_by('cast(p.nomor as unsigned), nomor_urut_bidang');
		$data = $this->db->get()->result_array();
		return $data;
	}

	// TODO: ganti ke impor pbb
	public function impor_persil()
	{
		$this->load->library('Spreadsheet_Excel_Reader');
		$data = new Spreadsheet_Excel_Reader($_FILES['persil']['tmp_name']);

		$sheet = 0;
		$baris = $data->rowcount($sheet_index = $sheet);
		$kolom = $data->colcount($sheet_index = $sheet);

		for ($i=2; $i<=$baris; $i++)
		{
			$nik = $data->val($i, 2, $sheet);
			$upd['id_pend'] = $this->db->select('id')->
						where('nik', $nik)->
						get('tweb_penduduk')->row()->id;
			$upd['nama'] = $data->val($i, 3, $sheet);
			$upd['persil_jenis_id'] = $data->val($i, 4, $sheet);
			$upd['id_clusterdesa'] = $data->val($i, 5, $sheet);
			$upd['luas'] = $data->val($i, 6, $sheet);
			$upd['kelas'] = $data->val($i, 7, $sheet);
			$upd['no_sppt_pbb'] = $data->val($i, 8, $sheet);
			$upd['persil_peruntukan_id'] = $data->val($i, 9, $sheet);
			$outp = $this->db->insert('data_persil',$upd);
		}

		status_sukses($outp); //Tampilkan Pesan
	}

	public function get_cetak_mutasi($id_pbb, $tipe='')
	{
		// Mutasi masuk
		$this->db
			->select('m.tanggal_mutasi, m.luas, m.pbb_keluar as id_pbb_keluar, p.id as id_persil, p.no_hp as nopersil, p.nomor_urut_bidang, 0 as cdesa_awal, p.luas_persil, c.no_hp as pbb_masuk, 0 as pbb_keluar, rk.kode as kelas_tanah, rm.nama as sebabmutasi')
			->from('mutasi_pbb m')
			->join('persil p', 'p.id = m.id_persil', 'left')
			->join('ref_persil_kelas rk', 'p.kelas = rk.id', 'left')
			->join('ref_persil_mutasi rm', 'm.jenis_mutasi = rm.id', 'left')
			->join('pbb_data_tagih c', 'c.id = m.pbb_keluar', 'left')
			->where('m.id_pbb_masuk', $id_pbb)
			->where('m.jenis_mutasi <> 9')
			->where('rk.tipe', $tipe);
		$sql_masuk = $this->db->get_compiled_select();
		// Mutasi keluar
		$this->db
			->select('m.tanggal_mutasi, m.luas, m.pbb_keluar as id_pbb_keluar, p.id as id_persil, p.no_hp as nopersil, p.nomor_urut_bidang, 0 as cdesa_awal, p.luas_persil, 0 as pbb_masuk, c.no_hp as pbb_keluar, rk.kode as kelas_tanah, rm.nama as sebabmutasi')
			->from('mutasi_pbb m')
			->join('persil p', 'p.id = m.id_persil', 'left')
			->join('ref_persil_kelas rk', 'p.kelas = rk.id', 'left')
			->join('ref_persil_mutasi rm', 'm.jenis_mutasi = rm.id', 'left')
			->join('pbb_data_tagih c', 'c.id = m.id_pbb_masuk', 'left')
			->where('m.pbb_keluar', $id_pbb)
			->where('rk.tipe', $tipe);
		$sql_keluar = $this->db->get_compiled_select();
		// Persil milik awal
		$this->db
			->select('"" as tanggal_mutasi, 0 as luas, 0 as id_pbb_keluar, p.id as id_persil, p.no_hp as nopersil, p.nomor_urut_bidang, p.cdesa_awal, p.luas_persil, 0 as pbb_masuk, 0 as pbb_keluar, rk.kode as kelas_tanah, "" as sebabmutasi')
			->from('persil p')
			->join('ref_persil_kelas rk', 'p.kelas = rk.id', 'left')
			->where('p.cdesa_awal', $id_pbb)
			->where('rk.tipe', $tipe);
		$sql_cdesa_awal = $this->db->get_compiled_select();
		$sql = '('.$sql_masuk.') UNION ('.$sql_keluar.') UNION ('.$sql_cdesa_awal.') ORDER BY nopersil, nomor_urut_bidang, cdesa_awal DESC, tanggal_mutasi';
		$data = $this->db->query($sql)->result_array();

		$persil_ini = 0;
		foreach ($data as $key => $mutasi)
		{
			if ($persil_ini <> $mutasi['id_persil'] and $id_pbb == $mutasi['cdesa_awal'])
			{
				// Cek kalau memiliki keseluruhan persil sekali saja untuk setiap persil
				// Data terurut berdasarkan persil
				$data[$key]['luas'] = $data[$key]['luas_persil'];
				$data[$key]['mutasi'] = '<p>Memiliki keseluruhan persil sejak awal</p>';
			}
			else
			{
				if ($persil_ini == $mutasi['id_persil'])
				{
					// Tidak ulangi info persil
					$data[$key]['nopersil'] = '';
					$data[$key]['kelas_tanah'] = '';
				}
				$data[$key]['mutasi'] = $this->format_mutasi($id_pbb, $mutasi);
			}
			if ($persil_ini <> $mutasi['id_persil']) $persil_ini = $mutasi['id_persil'];
		}
		return $data;
	}

	private function format_mutasi($id_pbb, $mutasi)
	{
		$keluar = $mutasi['id_pbb_keluar'] == $id_pbb;
		$div = $keluar ? 'class="out"' : null;
		$hasil = "<p $div>";
		$hasil .= $mutasi['sebabmutasi'];
		$hasil .= $keluar ? ' ke C No '.str_pad($mutasi['pbb_keluar'], 4, '0', STR_PAD_LEFT) : ' dari C No '.str_pad($mutasi['pbb_masuk'], 4, '0', STR_PAD_LEFT);
		$hasil .= !empty($mutasi['luas']) ? ", Seluas ".number_format($mutasi['luas'])." m<sup>2</sup>, " : null;
		$hasil .= !empty($mutasi['tanggal_mutasi']) ? tgl_indo_out($mutasi['tanggal_mutasi'])."<br />" : null;
		$hasil .= !empty($mutasi['keterangan']) ? $mutasi['keterangan']: null;
		$hasil .= "</p>";
		return $hasil;
	}

	// TODO: apakah bisa diambil dari penduduk_model?
	public function get_penduduk($id, $nik=false)
	{
		$this->db->select('p.id, p.nik,p.nama,k.no_kk,w.rt,w.rw,w.dusun')
			->from('tweb_penduduk p')
			->join('tweb_keluarga k','k.id = p.id_kk', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_cluster', 'left');
		if ($nik)
			$this->db->where('p.nik', $id);
		else
			$this->db->where('p.id', $id);
		$data = $this->db->get()->row_array();
		return $data;
	}

	// TODO: apakah bisa diambil dari penduduk_model?
	public function list_penduduk()
	{
		$strSQL = "SELECT p.nik,p.nama,k.no_kk,w.rt,w.rw,w.dusun FROM tweb_penduduk p
			LEFT JOIN tweb_keluarga k ON k.id = p.id_kk
			LEFT JOIN tweb_wil_clusterdesa w ON w.id = p.id_cluster
			WHERE 1 ORDER BY nama";
		$query = $this->db->query($strSQL);
		$data = "";
		$data = $query->result_array();
		if ($query->num_rows() > 0)
		{
			$j = 0;
			for ($i=0; $i<count($data); $i++)
			{
				if ($data[$i]['nik'] != "")
				{
					$data1[$j]['id']=$data[$i]['nik'];
					$data1[$j]['nik']=$data[$i]['nik'];
					$data1[$j]['nama']=strtoupper($data[$i]['nama'])." [NIK: ".$data[$i]['nik']."] / [NO KK: ".$data[$i]["no_kk"]."]";
					$data1[$j]['info']= "RT/RW ". $data[$i]['rt']."/".$data[$i]['rw']." - ".strtoupper($data[$i]['dusun']);
					$j++;
				}
			}
			$hasil2 = $data1;
		}
		else
		{
			$hasil2 = false;
		}
		return $hasil2;
	}
	
    public function fetchData(){
        $query = $this->db->query("SELECT (SELECT count(*) FROM `pbb_data_tagih`) as jumlah_nop,
        (SELECT sum(pajak) FROM `pbb_data_tagih`) as total_pajak,
        (SELECT count(*) FROM `pbb_data_tagih` where ket = 'Lunas') as lunas,
        (SELECT sum(pajak) FROM `pbb_data_tagih` where ket = 'Lunas') as pajak_lunas,
        (SELECT count(*) FROM `pbb_data_tagih` where ket = 'Belum Bayar') as terhutang,
        (SELECT sum(pajak) FROM `pbb_data_tagih` where ket = 'Belum Bayar') as pajak_terhutang,
        (SELECT count(*) FROM `pbb_data_tagih` where ket = 'Lunas')/(SELECT count(*) FROM `pbb_data_tagih`)*100 as presentase");

        return $query;
    }

	
    public function fetchBelumBayar(){
        $query = $this->db->query("SELECT * FROM `pbb_data_tagih` where ket = 'Belum Bayar'");

        return $query;
    }
	    
    public function fetchSingle($id){
        return $this->db->get_where('pbb_data_tagih', array('id' => $id));
    }

    public function insertData($data){
        $this->db->insert('pbb_data_tagih', $data);
    }

    public function updateData($data){
        $this->db->where("id", $data['id']);
        $this->db->update("pbb_data_tagih", $data);
    }
    function deleteData($id){
        $this->db->where('id', $id);
        $this->db->delete('pbb_data_tagih');
    }

    public function insertDataBayar($data){
        $this->db->insert('data_bayar', $data);
    }

}
?>
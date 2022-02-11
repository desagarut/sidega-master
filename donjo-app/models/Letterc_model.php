<?php
class Letterc_model extends CI_Model {

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
			'nomor' => 'letterc',
			'nama_pemilik_luar' => 'letterc',
			'nama_kepemilikan' => 'letterc'
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
			->from('letterc c')
			->distinct()
			->join('letterc_penduduk cu', 'cu.id_letterc = c.id', 'left')
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

	private function search_sql()
	{
		if ($this->session->cari)
		{
			$cari = $this->session->cari;
			$cari = $this->db->escape_like_str($cari);
			$this->db
				->group_start()
					->like('u.nama', $cari)
					->or_like('c.nama_kepemilikan', $cari)
					->or_like('c.nama_kepemilikan', $cari)
					->or_like('c.nomor', $cari)
				->group_end();
		}
	}

	private function main_sql_letterc()
	{
		$this->db->from('letterc c')
			->join('mutasi_letterc m', 'm.id_letterc_masuk = c.id or m.letterc_keluar = c.id', 'left')
			->join('persil p', 'p.id = m.id_persil or c.id = p.letterc_awal', 'left')
			->join('ref_persil_kelas k', 'k.id = p.kelas', 'left')
			->join('letterc_penduduk cu', 'cu.id_letterc = c.id', 'left')
			->join('tweb_penduduk u', 'u.id = cu.id_pend', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = u.id_cluster', 'left');
		$this->search_sql();
	}

	public function pagging_letterc($p=1)
	{
		$this->main_sql_letterc();
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

	public function list_letterc($offset=0, $per_page='', $kecuali=[])
	{
		$kecuali = sql_in_list($kecuali);
		$data = [];
		$this->main_sql_letterc();
		$this->db
			->select('c.*, c.id as id_letterc, c.created_at as tanggal_daftar, cu.id_pend')
			->select('u.nik AS nik, u.nama as namapemilik, w.*')
			->select('(CASE WHEN c.jenis_pemilik = 1 THEN u.nama ELSE c.nama_pemilik_luar END) AS namapemilik')
			->select('(CASE WHEN c.jenis_pemilik = 1 THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE c.alamat_pemilik_luar END) AS alamat')
			->select('COUNT(DISTINCT p.id) AS jumlah')
			->order_by('cast(c.nomor as unsigned)')
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
			$luas_persil = $this->jumlah_luas($data[$i]['id_letterc']);
			$data[$i]['basah'] = $luas_persil['BASAH'];
			$data[$i]['kering'] = $luas_persil['KERING'];
			$j++;
		}
		return $data;
	}

	// Untuk cetak daftar Letter-C, menghitung jumlah luas per kelas persil
 	// Perhitungkan kasus suatu Letter-C adalah pemilik awal keseluruhan persil
	public function jumlah_luas($id_letterc)
	{
		// luas total = jumlah luas setiap persil untuk letterc
		// luas persil = luas keseluruhan persil (kalau pemilik awal) +/- luas setiap mutasi tergantung masuk atau keluar
		// Jumlahkan sesuai dengan tipe kelas persil (basah atau kering)
		$persil_awal = $this->db
			->select('p.id, luas_persil, k.tipe')
			->from('persil p')
			->join('ref_persil_kelas k', 'p.kelas = k.id')
			->where('letterc_awal', $id_letterc)
			->get()
			->result_array();
		$luas_persil = [];
		foreach ($persil_awal as $persil)
		{
			$luas_persil[$persil['tipe']][$persil['id']] = $persil['luas_persil'];
		}
		$list_mutasi = $this->db
			->select('m.id_persil, m.luas, m.letterc_keluar, k.tipe')
			->from('mutasi_letterc m')
			->join('persil p', 'p.id = m.id_persil')
			->join('ref_persil_kelas k', 'p.kelas = k.id')
			->where('m.id_letterc_masuk', $id_letterc)
			->or_where('m.letterc_keluar', $id_letterc)
			->get('')
			->result_array();
		foreach ($list_mutasi as $mutasi)
		{
			if ($mutasi['letterc_keluar'] == $id_letterc)
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
			->from('mutasi_letterc m')
			->join('letterc c', 'c.id = m.id_letterc_masuk', 'left')
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
			->from('mutasi_letterc m')
			->where('m.id', $id_mutasi)
			->get('')
			->row_array();
		return $data;
	}

	public function get_letterc($id)
	{
		$data = $this->db->where('c.id', $id)
			->select('c.*')
			->select('(CASE WHEN c.jenis_pemilik = 1 THEN u.nama ELSE c.nama_pemilik_luar END) AS namapemilik')
			->select('(CASE WHEN c.jenis_pemilik = 1 THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE c.alamat_pemilik_luar END) AS alamat')
			->from('letterc c')
			->join('letterc_penduduk cu', 'cu.id_letterc = c.id', 'left')
			->join('tweb_penduduk u', 'u.id = cu.id_pend', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = u.id_cluster', 'left')
			->limit(1)
			->get()
			->row_array();

		return $data;
	}

	public function simpan_letterc()
	{
		$data = array();
		$data['nomor'] = bilangan_spasi($this->input->post('letterc'));
		$data['nama_kepemilikan'] = nama($this->input->post('nama_kepemilikan'));
		$data['jenis_pemilik'] = $this->input->post('jenis_pemilik');
		$data['nama_pemilik_luar'] = nama($this->input->post('nama_pemilik_luar'));
		$data['alamat_pemilik_luar'] = strip_tags($this->input->post('alamat_pemilik_luar'));
		if ($id_letterc = $this->input->post('id'))
		{
			$data_lama = $this->db->where('id', $id_letterc)
				->get('letterc')->row_array();
			if ($data['nomor'] == $data_lama['nomor']) unset($data['nomor']);
			if ($data['nama_kepemilikan'] == $data_lama['nama_kepemilikan']) unset($data['nama_kepemilikan']);
			$data['updated_by'] = $this->session->user;
			$this->db->where('id', $id_letterc)
				->update('letterc', $data);
		}
		else
		{
			$data['created_by'] = $this->session->user;
			$data['updated_by'] = $this->session->user;
			$this->db->insert('letterc', $data);
			$id_letterc = $this->db->insert_id();
		}

		if ($this->input->post('jenis_pemilik') == 1)
		{
			$this->simpan_pemilik($id_letterc, $this->input->post('id_pend'));
		}
		else
		{
			$this->hapus_pemilik($id_letterc);
		}
		return $id_letterc;
	}

	private function hapus_pemilik($id_letterc)
	{
		$this->db->where('id_letterc', $id_letterc)
			->delete('letterc_penduduk');
	}

	private function simpan_pemilik($id_letterc, $id_pend)
	{
		// Hapus pemilik lama
		$this->hapus_pemilik($id_letterc);
		// Tambahkan pemiliki baru
		$data = array();
		$data['id_letterc'] = $id_letterc;
		$data['id_pend'] = $id_pend;
		$this->db->insert('letterc_penduduk', $data);
	}

	public function simpan_mutasi($id_letterc, $id_mutasi, $post)
	{
		$data = array();
		$data['id_persil'] = $post['id_persil'];
		$data['id_letterc_masuk'] = $id_letterc;
		$data['no_bidang_persil'] = bilangan($post['no_bidang_persil']) ?: NULL;
		$data['no_objek_pajak'] = strip_tags($post['no_objek_pajak']);

		$data['tanggal_mutasi'] = $post['tanggal_mutasi'] ? tgl_indo_in($post['tanggal_mutasi']) : NULL;
		$data['jenis_mutasi'] = $post['jenis_mutasi'] ?: NULL;
		$data['luas'] = bilangan_titik($post['luas']) ?: NULL;
		$data['letterc_keluar'] = bilangan($post['letterc_keluar']) ?: NULL;
		$data['keterangan'] = strip_tags($post['keterangan']) ?: NULL;

		if ($id_mutasi)
			$outp = $this->db->where('id', $id_mutasi)->update('mutasi_letterc', $data);
		else
			$outp = $this->db->insert('mutasi_letterc', $data);
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

	public function hapus_letterc($id)
	{
		$outp = $this->db->where('id', $id)
			->delete('letterc');
		status_sukses($outp);
	}

	public function get_pemilik($id_letterc)
	{
		$this->db->select('p.id, p.nik, p.nama, k.no_kk, w.rt, w.rw, w.dusun')
			->select('(CASE WHEN c.jenis_pemilik = 1 THEN p.nama ELSE c.nama_pemilik_luar END) AS namapemilik')
			->select('(CASE WHEN c.jenis_pemilik = 1 THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE c.alamat_pemilik_luar END) AS alamat')
			->from('letterc c')
			->join('letterc_penduduk cp', 'c.id = cp.id_letterc', 'left')
			->join('tweb_penduduk p', 'p.id = cp.id_pend', 'left')
			->join('tweb_keluarga k','k.id = p.id_kk', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_cluster', 'left')
			->where('c.id', $id_letterc);
		$data = $this->db->get()->row_array();

		return $data;
	}

	public function get_list_mutasi($id_letterc, $id_persil='')
	{
		$nomor_letterc = $this->db->select('nomor')
			->where('id', $id_letterc)
			->get('letterc')
			->row()->nomor;
		$this->db
			->select('m.*, p.nomor, rk.kode as kelas_tanah')
			->select('CONCAT("RT ", rt, " / RW ", rw, " - ", dusun) as lokasi, p.lokasi as alamat')
			->select("IF (m.id_letterc_masuk = {$id_letterc}, m.luas, '') AS luas_masuk")
			->select("IF (m.letterc_keluar = {$id_letterc}, m.luas, '') AS luas_keluar")
			->select("IF (m.jenis_mutasi = '9', 0, 1) AS awal")
			->from('mutasi_letterc m')
			->join('letterc c', 'c.id = m.id_letterc_masuk', 'left')
			->join('persil p', 'p.id = m.id_persil', 'left')
			->join('ref_persil_kelas rk', 'p.kelas = rk.id', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_wilayah', 'left')
			->group_start()
				->where('m.id_letterc_masuk', $id_letterc)
				->or_where('m.letterc_keluar', $id_letterc)
			->group_end()
			->order_by('awal, tanggal_mutasi');
		if ($id_persil)
			$this->db->where('m.id_persil', $id_persil);
		$data = $this->db->get()->result_array();
		return $data;
	}

	public function get_list_persil($id_letterc)
	{
		$this->db
			->select('p.*, rk.kode as kelas_tanah')
			->select('COUNT(m.id) as jml_mutasi')
			->select('CONCAT("RT ", rt, " / RW ", rw, " - ", dusun) as lokasi, p.lokasi as alamat')
			->from('persil p')
			->join('mutasi_letterc m', 'p.id = m.id_persil', 'left')
			->join('ref_persil_kelas rk', 'p.kelas = rk.id', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_wilayah', 'left')
			->group_start()
				->where('m.id_letterc_masuk', $id_letterc)
				->or_where('m.letterc_keluar', $id_letterc)
				->or_where('p.letterc_awal', $id_letterc)
			->group_end()
			->group_by('p.id')
			->order_by('cast(p.nomor as unsigned), nomor_urut_bidang');
		$data = $this->db->get()->result_array();
		return $data;
	}

	// TODO: ganti ke impor letterc
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

	public function get_cetak_mutasi($id_letterc, $tipe='')
	{
		// Mutasi masuk
		$this->db
			->select('m.tanggal_mutasi, m.luas, m.letterc_keluar as id_letterc_keluar, p.id as id_persil, p.nomor as nopersil, p.nomor_urut_bidang, 0 as letterc_awal, p.luas_persil, c.nomor as letterc_masuk, 0 as letterc_keluar, rk.kode as kelas_tanah, rm.nama as sebabmutasi')
			->from('mutasi_letterc m')
			->join('persil p', 'p.id = m.id_persil', 'left')
			->join('ref_persil_kelas rk', 'p.kelas = rk.id', 'left')
			->join('ref_persil_mutasi rm', 'm.jenis_mutasi = rm.id', 'left')
			->join('letterc c', 'c.id = m.letterc_keluar', 'left')
			->where('m.id_letterc_masuk', $id_letterc)
			->where('m.jenis_mutasi <> 9')
			->where('rk.tipe', $tipe);
		$sql_masuk = $this->db->get_compiled_select();
		// Mutasi keluar
		$this->db
			->select('m.tanggal_mutasi, m.luas, m.letterc_keluar as id_letterc_keluar, p.id as id_persil, p.nomor as nopersil, p.nomor_urut_bidang, 0 as letterc_awal, p.luas_persil, 0 as letterc_masuk, c.nomor as letterc_keluar, rk.kode as kelas_tanah, rm.nama as sebabmutasi')
			->from('mutasi_letterc m')
			->join('persil p', 'p.id = m.id_persil', 'left')
			->join('ref_persil_kelas rk', 'p.kelas = rk.id', 'left')
			->join('ref_persil_mutasi rm', 'm.jenis_mutasi = rm.id', 'left')
			->join('letterc c', 'c.id = m.id_letterc_masuk', 'left')
			->where('m.letterc_keluar', $id_letterc)
			->where('rk.tipe', $tipe);
		$sql_keluar = $this->db->get_compiled_select();
		// Persil milik awal
		$this->db
			->select('"" as tanggal_mutasi, 0 as luas, 0 as id_letterc_keluar, p.id as id_persil, p.nomor as nopersil, p.nomor_urut_bidang, p.letterc_awal, p.luas_persil, 0 as letterc_masuk, 0 as letterc_keluar, rk.kode as kelas_tanah, "" as sebabmutasi')
			->from('persil p')
			->join('ref_persil_kelas rk', 'p.kelas = rk.id', 'left')
			->where('p.letterc_awal', $id_letterc)
			->where('rk.tipe', $tipe);
		$sql_letterc_awal = $this->db->get_compiled_select();
		$sql = '('.$sql_masuk.') UNION ('.$sql_keluar.') UNION ('.$sql_letterc_awal.') ORDER BY nopersil, nomor_urut_bidang, letterc_awal DESC, tanggal_mutasi';
		$data = $this->db->query($sql)->result_array();

		$persil_ini = 0;
		foreach ($data as $key => $mutasi)
		{
			if ($persil_ini <> $mutasi['id_persil'] and $id_letterc == $mutasi['letterc_awal'])
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
				$data[$key]['mutasi'] = $this->format_mutasi($id_letterc, $mutasi);
			}
			if ($persil_ini <> $mutasi['id_persil']) $persil_ini = $mutasi['id_persil'];
		}
		return $data;
	}

	private function format_mutasi($id_letterc, $mutasi)
	{
		$keluar = $mutasi['id_letterc_keluar'] == $id_letterc;
		$div = $keluar ? 'class="out"' : null;
		$hasil = "<p $div>";
		$hasil .= $mutasi['sebabmutasi'];
		$hasil .= $keluar ? ' ke C No '.str_pad($mutasi['letterc_keluar'], 4, '0', STR_PAD_LEFT) : ' dari C No '.str_pad($mutasi['letterc_masuk'], 4, '0', STR_PAD_LEFT);
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


}
?>
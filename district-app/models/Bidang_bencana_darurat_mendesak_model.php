<?php defined('BASEPATH') OR exit('No direct script access allowed');

class  Bidang_bencana_darurat_mendesak_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
	{
		$data = $this->validasi($this->input->post());
		$hasil = $this->db->insert('tbl_bidang_bencana_darurat_mendesak', $data);
		$_SESSION["success"] = $hasil ? 1 : -1;
	}

	private function validasi($post)
	{
		$data = [];
		// Ambil dan bersihkan data input
		$data['kelompok_bencana'] = $post['kelompok_bencana'];
		$data['jenis_bencana'] = nomor_surat_keputusan($post['jenis_bencana']);
		$data['lokasi_bencana'] = $post['lokasi_bencana'];
		$data['tanggal_kejadian'] = tgl_indo_in($post['tanggal_kejadian']);
		$data['waktu_kejadian'] = $post['waktu_kejadian'];
		$data['lokasi_bencana'] = htmlentities($post['lokasi_bencana']);
		$data['penyebab_bencana'] = htmlentities($post['penyebab_bencana']);
		$data['deskripsi_bencana'] = htmlentities($post['deskripsi_bencana']);
		$data['jumlah_korban'] = $post['jumlah_korban'];
		$data['korban_meninggal'] = $post['korban_meninggal'];
		$data['korban_hilang'] = $post['korban_hilang'];
		$data['korban_lukaberat'] = $post['korban_lukaberat'];
		$data['korban_lukaringan'] = $post['korban_lukaringan'];
		$data['lokasi_pengungsi'] = $post['lokasi_pengungsi'];
		$data['jumlah_pengungsi'] = $post['jumlah_pengungsi'];
		$data['penderita_terdampak'] = $post['penderita_terdampak'];
		$data['kerusakan_bangunan'] = htmlentities($post['kerusakan_bangunan']);
		$data['kerusakan_ls'] = htmlentities($post['kerusakan_ls']);
		$data['akses_ke_lokasi'] = htmlentities($post['akses_ke_lokasi']);
		$data['sarana_transportasi'] = $post['sarana_transportasi'];
		$data['jalur_komunikasi'] = $post['jalur_komunikasi'];
		$data['jaringan_listrik'] = $post['jaringan_listrik'];
		$data['jaringan_air_bersih'] = $post['jaringan_air_bersih'];
		$data['fasilitas_kesehatan'] = $post['fasilitas_kesehatan'];
		$data['upaya_penanganan'] = htmlentities($post['upaya_penanganan']);
		$data['sumberdaya'] = htmlentities($post['sumberdaya']);
		$data['mobilisasi_relawan'] = htmlentities($post['mobilisasi_relawan']);
		$data['bantuan_dn'] = $post['bantuan_dn'];
		$data['bantuan_ln'] = $post['bantuan_ln'];
		$data['potensi_bencana_susulan'] = $post['potensi_bencana_susulan'];
		$data['nama_pelapor'] = $post['nama_pelapor'];
		$data['alamat_pelapor'] = $post['alamat_pelapor'];
		$data['nomor_pelapor'] = $post['nomor_pelapor'];
		$data['foto_kejadian'] = $post['foto_kejadian'];
		$data['tanggal_tutup_laporan'] = tgl_indo_in($post['tanggal_tutup_laporan']);
		$data['status'] = $post['status'];
		$data['userid'] = $post['userid'];

		return $data;
	}

	public function list_data($kelompok_bencana = 0)
	{
		if ($kelompok_bencana > 0) $this->db->where('s.kelompok_bencana', $kelompok_bencana);

		$data = $this->db
			->select('s.*')
			->select('COUNT(st.id) AS jml')
			->from('tbl_bidang_bencana_darurat_mendesak s')
			->join('tbl_bidang_bencana_darurat_mendesak_terdampak st', "s.id = st.kejadian_bencana_id", 'left')
			->order_by('s.jenis_bencana')
			->group_by('s.id')
			->get()
			->result_array();

		return $data;
	}

	public function get_data_bencana($id)
	{
		$data = $this->db
			->select('s.*')
			->select('COUNT(st.id) AS jml')
			->from('tbl_bidang_bencana_darurat_mendesak s')
			->join('tbl_bidang_bencana_darurat_mendesak_terdampak st', "s.id = st.kejadian_bencana_id", 'left')
			->where('s.id', $id)
			->group_by('s.id')
			->get()
			->row_array();

		return $data;
	}

	public function list_kelompok_bencana($id, $kelompok_bencana)
	{
		$data = [];
		switch ($kelompok_bencana)
		{
			// Sasaran Penduduk
			case '1':
				$data['judul'] = 'NIK / Nama Penduduk';
				$data['data'] = $this->list_penduduk($id);
				break;

			// Sasaran Keluarga
			case '2':
				$data['judul'] = 'No.KK / Nama Kepala Keluarga';
				$data['data'] = $this->list_kk($id);

			default:
				# code...
				break;
		}

		return $data;
	}

	private function get_warga_terdampak_bencana($kejadian_bencana_id)
	{
		$list_penduduk = $this->db
			->select('p.id')
			->from('tweb_penduduk p')
			->join('tbl_bidang_bencana_darurat_mendesak_terdampak t', 'p.id = t.warga_terdampak', 'left')
			->where('t.kejadian_bencana_id', $kejadian_bencana_id)
			->get()
			->result_array();

		return sql_in_list(array_column($list_penduduk, 'id'));
	}

	private function list_penduduk($id)
	{
		// Penduduk yang sudah peserta untuk tbl_bidang_bencana_darurat_mendesak ini
		$peserta = $this->get_warga_terdampak_bencana($id);
		if ($peserta) $this->db->where("p.id NOT IN ($peserta)");

		$data = $this->db->select('p.id as id, p.nik as nik, p.nama, w.rt, w.rw, w.dusun')
			->from('tweb_penduduk p')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_cluster', 'left')
			->get()
			->result_array();

		$hasil = [];
		foreach ($data as $item)
		{
			$penduduk = array(
				'id' => $item['id'],
				'nama' => strtoupper($item['nama']) ." [".$item['nik']."]",
				'info' => "RT/RW ". $item['rt']."/".$item['rw']." - ".strtoupper($item['dusun'])
			);
			$hasil[] = $penduduk;
		}
		return $hasil;
	}

	private function get_warga_terdampak_kk($kejadian_bencana_id)
	{
		$list_kk = $this->db
			->select('k.id')
			->from('tweb_keluarga k')
			->join('tbl_bidang_bencana_darurat_mendesak_terdampak t', 'k.id = t.warga_terdampak', 'left')
			->where('t.kejadian_bencana_id', $kejadian_bencana_id)
			->get()
			->result_array();

		return sql_in_list(array_column($list_kk, 'id'));
	}

	private function list_kk($id)
	{
		// Keluarga yang sudah peserta untuk tbl_bidang_bencana_darurat_mendesak ini
		$peserta = $this->get_warga_terdampak_kk($id);
		if ($peserta) $this->db->where("k.id NOT IN ($peserta)");

		// Daftar keluarga, tidak termasuk keluarga yang sudah peserta
		$data = $this->db->select('k.id as id, k.no_kk, p.nama, w.rt, w.rw, w.dusun')
			->from('tweb_keluarga k')
			->join('tweb_penduduk p', 'p.id = k.nik_kepala', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_cluster', 'left')
			->get()
			->result_array();

		$hasil = [];
		foreach ($data as $item)
		{
			$item['id'] = preg_replace('/[^a-zA-Z0-9]/', '', $item['id']); //hapus non_alpha di no_kk
			$kk = array(
				'id' => $item['id'],
				'nama' => strtoupper($item['nama']) ." [".$item['no_kk']."]",
				'info' => "RT/RW ". $item['rt']."/".$item['rw']." - ".strtoupper($item['dusun'])
			);
			$hasil[] = $kk;
		}
		return $hasil;
	}

	public function get_laporan_kejadian_bencana($id)
	{
		$data = $this->db
			->select('s.*')
			->select('COUNT(st.id) AS jml')
			->from('tbl_bidang_bencana_darurat_mendesak s')
			->join('tbl_bidang_bencana_darurat_mendesak_terdampak st', "s.id = st.kejadian_bencana_id", 'left')
			->where('s.id', $id)
			->group_by('s.id')
			->get()
			->row_array();

		return $data;
	}

	public function get_rincian($p, $kejadian_bencana_id)
	{
		$kejadian_bencana = $this->db->where('id', $kejadian_bencana_id)->get('tbl_bidang_bencana_darurat_mendesak')->row_array();

		switch ($kejadian_bencana['kelompok_bencana'])
		{
			// Sasaran Penduduk
			case '1':
				$data = $this->get_penduduk_peserta($kejadian_bencana_id, $p);
				$data['judul']['judul_warga_info'] = 'No. KK';
				$data['judul']['judul_warga_plus'] = 'NIK Penduduk';
				$data['judul']['judul_warga_nama'] = 'Nama Penduduk';
				break;

			// Sasaran Keluarga
			case '2':
				$data = $this->get_kk_peserta($kejadian_bencana_id, $p);
				$data['judul']['judul_warga_info'] = 'NIK KK';
				$data['judul']['judul_warga_plus'] = 'No. KK';
				$data['judul']['judul_warga_nama'] = 'Kepala Keluarga';

				break;

			// Sasaran X
			default:
				# code...
				break;
		}

		$data['kejadian_bencana'] = $kejadian_bencana;
		$data['keyword'] = $this->autocomplete($kejadian_bencana['kejadian_bencana']);

		return $data;
	}

	private function paging($p, $get_peserta_sql)
	{
		$sql = "SELECT COUNT(*) as jumlah ".$get_peserta_sql;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$jml_data = $row['jumlah'];

		$this->load->library('paging');
		$cfg['page'] = $p;
		$cfg['per_page'] = $_SESSION['per_page'];
		$cfg['num_rows'] = $jml_data;
		$this->paging->init($cfg);

		return $this->paging;
	}

	private function get_penduduk_peserta_sql($kejadian_bencana_id)
	{
		# Data penduduk
		$sql = " FROM tbl_bidang_bencana_darurat_mendesak_terdampak s
			LEFT JOIN tweb_penduduk o ON s.warga_terdampak = o.id
			LEFT JOIN tweb_keluarga k ON k.id = o.id_kk
			LEFT JOIN tweb_wil_clusterdesa w ON w.id = o.id_cluster
			WHERE s.kejadian_bencana_id=".$kejadian_bencana_id;
		return $sql;
	}

	private function get_penduduk_peserta($kejadian_bencana_id, $p)
	{
		$hasil = [];
		$get_peserta_sql = $this->get_penduduk_peserta_sql($kejadian_bencana_id);
		$select_sql = "SELECT s.*, s.warga_terdampak, o.nik, o.nama, o.tempatlahir, o.tanggallahir, o.sex, k.no_kk, w.rt, w.rw, w.dusun,
			(case when (o.id_kk IS NULL or o.id_kk = 0) then o.alamat_sekarang else k.alamat end) AS alamat
		 ";
		$sql = $select_sql.$get_peserta_sql;
		$sql .= $this->search_sql('1');
		if ( ! empty($_SESSION['per_page']) and $_SESSION['per_page'] > 0)
		{
			$hasil["paging"] = $this->paging($p, $get_peserta_sql.$this->search_sql('1'));
			$paging_sql = ' LIMIT ' .$hasil["paging"]->offset. ',' .$hasil["paging"]->per_page;
			$sql .= $paging_sql;
		}
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$data = $query->result_array();
			for ($i=0; $i<count($data); $i++)
			{
				$data[$i]['peserta_info'] = $data[$i]['no_kk'];
				$data[$i]['peserta_plus'] = $data[$i]['nik'];
				$data[$i]['peserta_nama'] = strtoupper($data[$i]['nama']);
				$data[$i]['tempat_lahir'] = strtoupper($data[$i]['tempatlahir']);
				$data[$i]['tanggal_lahir'] = tgl_indo($data[$i]['tanggallahir']);
				$data[$i]['sex'] = ($data[$i]['sex'] == 1) ? "LAKI-LAKI" : "PEREMPUAN";
				$data[$i]['info'] = strtoupper($data[$i]['alamat'] . " "  .  "RT/RW ". $data[$i]['rt']."/".$data[$i]['rw'] . " - " . $this->setting->sebutan_dusun . " " . $data[$i]['dusun']);
			}
			$hasil['peserta'] = $data;
		}

		return $hasil;
	}

	private function get_kk_peserta_sql($kejadian_bencana_id)
	{
		# Data KK
		$sql = " FROM tbl_bidang_bencana_darurat_mendesak_terdampak s
			LEFT JOIN tweb_keluarga o ON s.warga_terdampak = o.id
			LEFT JOIN tweb_penduduk q ON o.nik_kepala = q.id
			LEFT JOIN tweb_wil_clusterdesa w ON w.id = q.id_cluster
			WHERE s.kejadian_bencana_id=".$kejadian_bencana_id;
		return $sql;
	}


	private function get_kk_peserta($kejadian_bencana_id, $p)
	{
		$hasil = [];
		$get_peserta_sql = $this->get_kk_peserta_sql($kejadian_bencana_id);
		$select_sql = "SELECT s.*, s.warga_terdampak, o.no_kk, s.kejadian_bencana_id, o.nik_kepala, o.alamat, q.nik, q.nama, q.tempatlahir, q.tanggallahir, q.sex, w.rt, w.rw, w.dusun ";
		$sql = $select_sql.$get_peserta_sql;
		$sql .= $this->search_sql('2');
		if ( ! empty($_SESSION['per_page']) and $_SESSION['per_page'] > 0)
		{
			$hasil["paging"] = $this->paging($p, $get_peserta_sql.$this->search_sql('2'));
			$paging_sql = ' LIMIT ' .$hasil["paging"]->offset. ',' .$hasil["paging"]->per_page;
			$sql .= $paging_sql;
		}
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$data = $query->result_array();
			for ($i=0; $i<count($data); $i++)
			{
				$data[$i]['peserta_info'] = $data[$i]['nik'];
				$data[$i]['peserta_plus'] = $data[$i]['no_kk'];
				$data[$i]['peserta_nama'] = strtoupper($data[$i]['nama']);
				$data[$i]['tempat_lahir'] = strtoupper($data[$i]['tempatlahir']);
				$data[$i]['tanggal_lahir'] = tgl_indo($data[$i]['tanggallahir']);
				$data[$i]['sex'] = ($data[$i]['sex'] == 1) ? "LAKI-LAKI" : "PEREMPUAN";
				$data[$i]['info'] = strtoupper($data[$i]['alamat'] . " "  .  "RT/RW ". $data[$i]['rt']."/".$data[$i]['rw'] . " - " . $this->setting->sebutan_dusun . " " . $data[$i]['dusun']);
			}
			$hasil['peserta'] = $data;
		}
		return $hasil;
	}

	/*
		Mengambil data individu peserta
	*/
	public function get_peserta($warga_terdampak, $sasaran)
	{
		$this->load->model('surat_model');
		switch ($sasaran)
		{
			// Sasaran Penduduk
			case 1:
				$sql = "SELECT u.id AS id, u.nama AS nama, x.nama AS sex, u.id_kk AS id_kk,
				u.tempatlahir AS tempatlahir, u.tanggallahir AS tanggallahir,
				(select (date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0) AS `(date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0)`
				from tweb_penduduk where (tweb_penduduk.id = u.id)) AS umur,
				w.nama AS status_kawin, f.nama AS warganegara, a.nama AS agama, d.nama AS pendidikan, j.nama AS pekerjaan, u.nik AS nik, c.rt AS rt, c.rw AS rw, c.dusun AS dusun, k.no_kk AS no_kk, k.alamat,
				(select tweb_penduduk.nama AS nama from tweb_penduduk where (tweb_penduduk.id = k.nik_kepala)) AS kepala_kk
				from tweb_penduduk u
				left join tweb_penduduk_sex x on u.sex = x.id
				left join tweb_penduduk_kawin w on u.status_kawin = w.id
				left join tweb_penduduk_agama a on u.agama_id = a.id
				left join tweb_penduduk_pendidikan_kk d on u.pendidikan_kk_id = d.id
				left join tweb_penduduk_pekerjaan j on u.pekerjaan_id = j.id
				left join tweb_wil_clusterdesa c on u.id_cluster = c.id
				left join tweb_keluarga k on u.id_kk = k.id
				left join tweb_penduduk_warganegara f on u.warganegara_id = f.id
				WHERE u.id = ?";
				$query = $this->db->query($sql, $warga_terdampak);
				$data  = $query->row_array();
				$data['peserta_info'] = $data['nik'];
				$data['peserta_plus'] = $data['no_kk'];
				$data['peserta_nama'] = $data['nama'];
				$data['alamat_wilayah']= $this->surat_model->get_alamat_wilayah($data);
				break;

			// Sasaran Keluarga
			case 2:
				$data = $this->keluarga_model->get_kepala_kk($warga_terdampak);
				$data['peserta_info'] = $data['nik'];
				$data['peserta_plus'] = $data['no_kk'];
				$data['peserta_nama'] = $data['nama'];
				$data['id'] = $data['id_kk']; // id_kk digunakan sebagai id peserta
				break;

			default:
				break;
		}
		return $data;
	}

	public function hapus($id)
	{
		$ada = $this->db->where('kejadian_bencana_id', $id)
			->get('tbl_bidang_bencana_darurat_mendesak_terdampak')->num_rows();
		if ($ada)
		{
			$this->session->success = '-1';
			$this->session->error_msg = ' --> Tidak bisa dihapus, karena masih digunakan';
			return;
		}
		$hasil = $this->db->where('id', $id)->delete('tbl_bidang_bencana_darurat_mendesak');

		status_sukses($hasil); //Tampilkan Pesan
	}

	public function update($id)
	{
		$data = $this->validasi($this->input->post());
		$hasil = $this->db->where('id', $id)->update('tbl_bidang_bencana_darurat_mendesak', $data);

		status_sukses($hasil); //Tampilkan Pesan
	}

	public function add_peserta2($post, $id)
	{
		$warga_terdampak = $post['warga_terdampak'];
		$sasaran = $this->db->select('sasaran')->where('id', $id)->get('tbl_bidang_bencana_darurat_mendesak')->row()->sasaran;
		$hasil = $this->db->where('kejadian_bencana_id', $id)->where('warga_terdampak', $warga_terdampak)->get('tbl_bidang_bencana_darurat_mendesak_terdampak');
		if ($hasil->num_rows() > 0)
		{
			return false;
		}
		else
		{
			$data = array(
				'kejadian_bencana_id' => $id,
				'warga_terdampak' => $warga_terdampak,
				'sasaran' => $sasaran,
				'keterangan' => substr(htmlentities($post['keterangan']), 0, 100) // Batasi 100 karakter
			);
			return $this->db->insert('tbl_bidang_bencana_darurat_mendesak_terdampak', $data);
		}
	}

	public function add_peserta($post, $id)
	{
		$warga_terdampak = $post['warga_terdampak'];
		$sasaran = $this->db->select('sasaran')->where('id', $id)->get('tbl_bidang_bencana_darurat_mendesak')->row()->sasaran;
		$hasil = $this->db->where('kejadian_bencana_id', $id)->where('warga_terdampak', $warga_terdampak)->get('tbl_bidang_bencana_darurat_mendesak_terdampak');
		if ($hasil->num_rows() > 0)
		{
			return false;
		}
		else
		{
			$data = array(
				'kejadian_bencana_id' => $id,
				'warga_terdampak' => $warga_terdampak,
				'sasaran' => $sasaran,
				'keterangan' => substr(htmlentities($post['keterangan']), 0, 100) // Batasi 100 karakter
			);
			return $this->db->insert('tbl_bidang_bencana_darurat_mendesak_terdampak', $data);
		}
	}

	public function hapus_peserta($warga_terdampak)
	{
		$this->db->where('id', $warga_terdampak);
		$this->db->delete('tbl_bidang_bencana_darurat_mendesak_terdampak');
	}

	// $id = pemberdayaan_masyarakat_peserta.id
	public function edit_peserta($post,$id)
	{
		$data['keterangan'] = substr(htmlentities($post['keterangan']), 0, 100); // Batasi 100 karakter
		$this->db->where('id', $id);
		$this->db->update('tbl_bidang_bencana_darurat_mendesak_terdampak', $data);
	}

	/*
		Mengambil data individu peserta menggunakan id tabel tbl_bidang_bencana_darurat_mendesak_terdampak
	*/
	public function get_laporan_kejadian_bencana_warga_by_id($id)
	{
		$data = $this->db->where('id', $id)->get('tbl_bidang_bencana_darurat_mendesak_terdampak')->row_array();
		// Data tambahan untuk ditampilkan
		$peserta = $this->get_peserta($data['warga_terdampak'], $data['sasaran']);
		switch ($data['sasaran'])
		{
			case 1:
				$data['judul_warga_nama'] = 'NIK';
				$data['judul_warga_info'] = 'Nama peserta';
				$data['peserta_nama'] = $peserta['nik'];
				$data['peserta_info'] = $peserta['nama'];
				break;
			case 2:
				$data['judul_warga_nama'] = 'No. KK';
				$data['judul_warga_info'] = 'Kepala Keluarga';
				$data['peserta_nama'] = $peserta['no_kk'];
				$data['peserta_info'] = $peserta['nama'];
				break;
			default:
		}

		return $data;
	}

	public function get_peserta_pemberdayaan_masyarakat($sasaran,$warga_terdampak)
	{
		$list_pemberdayaan_masyarakat = [];
		/*
		 * Menampilkan keterlibatan $warga_terdampak dalam data tbl_bidang_bencana_darurat_mendesak yang ada
		 *
		 * */
		$strSQL = "SELECT p.id as id, o.warga_terdampak as nik, p.nama as nama, p.keterangan
			FROM tbl_bidang_bencana_darurat_mendesak_terdampak o
			LEFT JOIN tbl_bidang_bencana_darurat_mendesak p ON p.id = o.kejadian_bencana_id
			WHERE ((o.warga_terdampak='".$warga_terdampak."') AND (o.sasaran='".$sasaran."'))";
		$query = $this->db->query($strSQL);
		if ($query->num_rows() > 0)
		{
			$list_pemberdayaan_masyarakat = $query->result_array();
		}

		switch ($sasaran)
		{
			case 1:
				/*
				 * Rincian Penduduk
				 * */
				$strSQL = "SELECT o.nama, o.foto, o.nik, w.rt, w.rw, w.dusun,
				(case when (o.id_kk IS NULL or o.id_kk = 0) then o.alamat_sekarang else k.alamat end) AS alamat
					FROM tweb_penduduk o
					LEFT JOIN tweb_keluarga k ON k.id = o.id_kk
					LEFT JOIN tweb_wil_clusterdesa w ON w.id = o.id_cluster
					WHERE o.id = '".$warga_terdampak."'";
				$query = $this->db->query($strSQL);
				if ($query->num_rows() > 0)
				{
					$row = $query->row_array();
					$data_profil = array(
						"id" => $id,
						"nama" => $row["nama"] ." - ".$row["nik"],
						"ndesc" => "Alamat: ".$row["alamat"]." RT ".strtoupper($row["rt"])." / RW ".strtoupper($row["rw"])." ".strtoupper($row["dusun"]),
						"foto" => $row["foto"]
						);
				}

				break;
			case 2:
				/*
				 * KK
				 * */
				$strSQL = "SELECT o.nik_kepala, o.no_kk, o.alamat, p.nama, w.rt, w.rw, w.dusun
					FROM tweb_keluarga o
					LEFT JOIN tweb_penduduk p ON o.nik_kepala = p.id
					LEFT JOIN tweb_wil_clusterdesa w ON w.id = p.id_cluster
					WHERE o.id = '".$warga_terdampak."'";
				$query = $this->db->query($strSQL);
				if ($query->num_rows() > 0)
				{
					$row = $query->row_array();
					$data_profil = array(
						"id" => $id,
						"nama" => "Kepala KK : ".$row["nama"].", NO KK: ".$row["no_kk"],
						"ndesc" => "Alamat: ".$row["alamat"]." RT ".strtoupper($row["rt"])." / RW ".strtoupper($row["rw"])." ".strtoupper($row["dusun"]),
						"foto" => ""
						);
				}

				break;
			default:

		}
		if ( ! empty($list_pemberdayaan_masyarakat))
		{
			$hasil = array("daftar_pemberdayaan_masyarakat" => $list_pemberdayaan_masyarakat, "profil" => $data_profil);
			return $hasil;
		}
		else
		{
			return null;
		}
	}

	protected function search_sql($kelompok_bencana = '')
	{
		if ( $this->session->cari)
		{
			$cari = $this->session->cari;
			$kw = $this->db->escape_like_str($cari);
			$kw = '%' .$kw. '%';
			switch ($kelompok_bencana)
			{
				case '1':
					## sasaran penduduk
					$search_sql = " AND (o.nama LIKE '$kw' OR o.nik LIKE '$kw' OR k.no_kk like '$kw')";
					break;
				case '2':
					## sasaran keluarga / KK
					$search_sql = " AND (o.no_kk LIKE '$kw' OR o.nik_kepala LIKE '$kw' OR q.nik LIKE '$kw' OR q.nama LIKE '$kw')";
					break;
			}
			return $search_sql;
		}
	}

	private function autocomplete($kelompok_bencana)
	{
		switch ($kelompok_bencana)
		{
			case '1':
				## kelompok_bencana penduduk
				$data = $this->db
					->select('p.nama')
					->from('tbl_bidang_bencana_darurat_mendesak_terdampak s')
					->join('tweb_penduduk p', 'p.id = s.warga_terdampak', 'left')
					->where('s.kelompok_bencana', $kelompok_bencana)
					->group_by('p.nama')
					->get()
					->result_array();
				break;

			case '2':
				## kelompok_bencana keluarga / KK
				$data = $this->db
					->select('p.nama')
					->from('tbl_bidang_bencana_darurat_mendesak_terdampak s')
					->join('tweb_keluarga k', 'k.id = s.warga_terdampak', 'left')
					->join('tweb_penduduk p', 'p.id = k.nik_kepala', 'left')
					->where('s.kelompok_bencana', $kelompok_bencana)
					->group_by('p.nama')
					->get()
					->result_array();
				break;
			default:
				break;
		}

		return autocomplete_data_ke_str($data);
	}

}
?>

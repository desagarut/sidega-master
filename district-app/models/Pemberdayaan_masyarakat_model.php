<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pemberdayaan_masyarakat_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
	{
		$data = $this->validasi($this->input->post());
		$hasil = $this->db->insert('tbl_pemberdayaan_masyarakat', $data);
		$_SESSION["success"] = $hasil ? 1 : -1;
	}

	private function validasi($post)
	{
		$data = [];
		// Ambil dan bersihkan data input
		$data['sasaran'] = $post['sasaran'];
		$data['nama_kegiatan'] = nomor_surat_keputusan($post['nama_kegiatan']);
//		$data['nama'] = nomor_surat_keputusan($post['nama']);
		$data['nama_penyelenggara'] = $post['nama_penyelenggara'];
		$data['tgl_mulai'] = tgl_indo_in($post['tgl_mulai']);
		$data['tgl_selesai'] = tgl_indo_in($post['tgl_selesai']);
		$data['sumber_dana'] = $post['sumber_dana'];
		$data['lokasi'] = $post['lokasi'];
		$data['anggaran'] = $post['anggaran'];
		$data['keterangan'] = htmlentities($post['keterangan']);
		
		return $data;
	}

	public function list_data($sasaran = 0)
	{
		if ($sasaran > 0) $this->db->where('s.sasaran', $sasaran);

		$data = $this->db
			->select('s.*')
			->select('COUNT(st.id) AS jml')
			->from('tbl_pemberdayaan_masyarakat s')
			->join('tbl_pemberdayaan_masyarakat_peserta st', "s.id = st.id_kegiatan", 'left')
			->order_by('s.nama_kegiatan')
			->group_by('s.id')
			->get()
			->result_array();

		return $data;
	}

	public function list_sasaran($id, $sasaran)
	{
		$data = [];
		switch ($sasaran)
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

	private function get_id_peserta_penduduk($id_kegiatan)
	{
		$list_penduduk = $this->db
			->select('p.id')
			->from('tweb_penduduk p')
			->join('tbl_pemberdayaan_masyarakat_peserta t', 'p.id = t.id_peserta', 'left')
			->where('t.id_kegiatan', $id_kegiatan)
			->get()
			->result_array();

		return sql_in_list(array_column($list_penduduk, 'id'));
	}

	private function list_penduduk($id)
	{
		// Penduduk yang sudah peserta untuk tbl_pemberdayaan_masyarakat ini
		$peserta = $this->get_id_peserta_penduduk($id);
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

	private function get_id_peserta_kk($id_kegiatan)
	{
		$list_kk = $this->db
			->select('k.id')
			->from('tweb_keluarga k')
			->join('tbl_pemberdayaan_masyarakat_peserta t', 'k.id = t.id_peserta', 'left')
			->where('t.id_kegiatan', $id_kegiatan)
			->get()
			->result_array();

		return sql_in_list(array_column($list_kk, 'id'));
	}

	private function list_kk($id)
	{
		// Keluarga yang sudah peserta untuk tbl_pemberdayaan_masyarakat ini
		$peserta = $this->get_id_peserta_kk($id);
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

	public function get_pemberdayaan_masyarakat($id)
	{
		$data = $this->db
			->select('s.*')
			->select('COUNT(st.id) AS jml')
			->from('tbl_pemberdayaan_masyarakat s')
			->join('tbl_pemberdayaan_masyarakat_peserta st', "s.id = st.id_kegiatan", 'left')
			->where('s.id', $id)
			->group_by('s.id')
			->get()
			->row_array();

		return $data;
	}

	public function get_rincian($p, $kegiatan_id)
	{
		$pemberdayaan_masyarakat = $this->db->where('id', $kegiatan_id)->get('tbl_pemberdayaan_masyarakat')->row_array();

		switch ($pemberdayaan_masyarakat['sasaran'])
		{
			// Sasaran Penduduk
			case '1':
				$data = $this->get_penduduk_peserta($kegiatan_id, $p);
				$data['judul']['judul_peserta_info'] = 'No. KK';
				$data['judul']['judul_peserta_plus'] = 'NIK Penduduk';
				$data['judul']['judul_peserta_nama'] = 'Nama Penduduk';
				break;

			// Sasaran Keluarga
			case '2':
				$data = $this->get_kk_peserta($kegiatan_id, $p);
				$data['judul']['judul_peserta_info'] = 'NIK KK';
				$data['judul']['judul_peserta_plus'] = 'No. KK';
				$data['judul']['judul_peserta_nama'] = 'Kepala Keluarga';

				break;

			// Sasaran X
			default:
				# code...
				break;
		}

		$data['pemberdayaan_masyarakat'] = $pemberdayaan_masyarakat;
		$data['keyword'] = $this->autocomplete($pemberdayaan_masyarakat['sasaran']);

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

	private function get_penduduk_peserta_sql($kegiatan_id)
	{
		# Data penduduk
		$sql = " FROM tbl_pemberdayaan_masyarakat_peserta s
			LEFT JOIN tweb_penduduk o ON s.id_peserta = o.id
			LEFT JOIN tweb_keluarga k ON k.id = o.id_kk
			LEFT JOIN tweb_wil_clusterdesa w ON w.id = o.id_cluster
			WHERE s.id_kegiatan=".$kegiatan_id;
		return $sql;
	}

	private function get_penduduk_peserta($kegiatan_id, $p)
	{
		$hasil = [];
		$get_peserta_sql = $this->get_penduduk_peserta_sql($kegiatan_id);
		$select_sql = "SELECT s.*, s.id_peserta, o.nik, o.nama, o.tempatlahir, o.tanggallahir, o.sex, k.no_kk, w.rt, w.rw, w.dusun,
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

	private function get_kk_peserta_sql($kegiatan_id)
	{
		# Data KK
		$sql = " FROM tbl_pemberdayaan_masyarakat_peserta s
			LEFT JOIN tweb_keluarga o ON s.id_peserta = o.id
			LEFT JOIN tweb_penduduk q ON o.nik_kepala = q.id
			LEFT JOIN tweb_wil_clusterdesa w ON w.id = q.id_cluster
			WHERE s.id_kegiatan=".$kegiatan_id;
		return $sql;
	}


	private function get_kk_peserta($kegiatan_id, $p)
	{
		$hasil = [];
		$get_peserta_sql = $this->get_kk_peserta_sql($kegiatan_id);
		$select_sql = "SELECT s.*, s.id_peserta, o.no_kk, s.id_kegiatan, o.nik_kepala, o.alamat, q.nik, q.nama, q.tempatlahir, q.tanggallahir, q.sex, w.rt, w.rw, w.dusun ";
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
	public function get_peserta($id_peserta, $sasaran)
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
				$query = $this->db->query($sql, $id_peserta);
				$data  = $query->row_array();
				$data['peserta_info'] = $data['nik'];
				$data['peserta_plus'] = $data['no_kk'];
				$data['peserta_nama'] = $data['nama'];
				$data['alamat_wilayah']= $this->surat_model->get_alamat_wilayah($data);
				break;

			// Sasaran Keluarga
			case 2:
				$data = $this->keluarga_model->get_kepala_kk($id_peserta);
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
		$ada = $this->db->where('id_kegiatan', $id)
			->get('tbl_pemberdayaan_masyarakat_peserta')->num_rows();
		if ($ada)
		{
			$this->session->success = '-1';
			$this->session->error_msg = ' --> Tidak bisa dihapus, karena masih digunakan';
			return;
		}
		$hasil = $this->db->where('id', $id)->delete('tbl_pemberdayaan_masyarakat');

		status_sukses($hasil); //Tampilkan Pesan
	}

	public function update($id)
	{
		$data = $this->validasi($this->input->post());
		$hasil = $this->db->where('id', $id)->update('tbl_pemberdayaan_masyarakat', $data);

		status_sukses($hasil); //Tampilkan Pesan
	}

	public function add_peserta2($post, $id)
	{
		$id_peserta = $post['id_peserta'];
		$sasaran = $this->db->select('sasaran')->where('id', $id)->get('tbl_pemberdayaan_masyarakat')->row()->sasaran;
		$hasil = $this->db->where('id_kegiatan', $id)->where('id_peserta', $id_peserta)->get('tbl_pemberdayaan_masyarakat_peserta');
		if ($hasil->num_rows() > 0)
		{
			return false;
		}
		else
		{
			$data = array(
				'id_kegiatan' => $id,
				'id_peserta' => $id_peserta,
				'sasaran' => $sasaran,
				'keterangan' => substr(htmlentities($post['keterangan']), 0, 100) // Batasi 100 karakter
			);
			return $this->db->insert('tbl_pemberdayaan_masyarakat_peserta', $data);
		}
	}

	public function add_peserta($post, $id)
	{
		$id_peserta = $post['id_peserta'];
		$sasaran = $this->db->select('sasaran')->where('id', $id)->get('tbl_pemberdayaan_masyarakat')->row()->sasaran;
		$hasil = $this->db->where('id_kegiatan', $id)->where('id_peserta', $id_peserta)->get('tbl_pemberdayaan_masyarakat_peserta');
		if ($hasil->num_rows() > 0)
		{
			return false;
		}
		else
		{
			$data = array(
				'id_kegiatan' => $id,
				'id_peserta' => $id_peserta,
				'sasaran' => $sasaran,
				'keterangan' => substr(htmlentities($post['keterangan']), 0, 100) // Batasi 100 karakter
			);
			return $this->db->insert('tbl_pemberdayaan_masyarakat_peserta', $data);
		}
	}

	public function hapus_peserta($id_peserta)
	{
		$this->db->where('id', $id_peserta);
		$this->db->delete('tbl_pemberdayaan_masyarakat_peserta');
	}

	// $id = pemberdayaan_masyarakat_peserta.id
	public function edit_peserta($post,$id)
	{
		$data['keterangan'] = substr(htmlentities($post['keterangan']), 0, 100); // Batasi 100 karakter
		$this->db->where('id', $id);
		$this->db->update('tbl_pemberdayaan_masyarakat_peserta', $data);
	}

	/*
		Mengambil data individu peserta menggunakan id tabel tbl_pemberdayaan_masyarakat_peserta
	*/
	public function get_pemberdayaan_masyarakat_peserta_by_id($id)
	{
		$data = $this->db->where('id', $id)->get('tbl_pemberdayaan_masyarakat_peserta')->row_array();
		// Data tambahan untuk ditampilkan
		$peserta = $this->get_peserta($data['id_peserta'], $data['sasaran']);
		switch ($data['sasaran'])
		{
			case 1:
				$data['judul_peserta_nama'] = 'NIK';
				$data['judul_peserta_info'] = 'Nama peserta';
				$data['peserta_nama'] = $peserta['nik'];
				$data['peserta_info'] = $peserta['nama'];
				break;
			case 2:
				$data['judul_peserta_nama'] = 'No. KK';
				$data['judul_peserta_info'] = 'Kepala Keluarga';
				$data['peserta_nama'] = $peserta['no_kk'];
				$data['peserta_info'] = $peserta['nama'];
				break;
			default:
		}

		return $data;
	}

	public function get_peserta_pemberdayaan_masyarakat($sasaran,$id_peserta)
	{
		$list_pemberdayaan_masyarakat = [];
		/*
		 * Menampilkan keterlibatan $id_peserta dalam data tbl_pemberdayaan_masyarakat yang ada
		 *
		 * */
		$strSQL = "SELECT p.id as id, o.id_peserta as nik, p.nama as nama, p.keterangan
			FROM tbl_pemberdayaan_masyarakat_peserta o
			LEFT JOIN tbl_pemberdayaan_masyarakat p ON p.id = o.id_kegiatan
			WHERE ((o.id_peserta='".$id_peserta."') AND (o.sasaran='".$sasaran."'))";
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
					WHERE o.id = '".$id_peserta."'";
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
					WHERE o.id = '".$id_peserta."'";
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

	protected function search_sql($sasaran = '')
	{
		if ( $this->session->cari)
		{
			$cari = $this->session->cari;
			$kw = $this->db->escape_like_str($cari);
			$kw = '%' .$kw. '%';
			switch ($sasaran)
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

	private function autocomplete($sasaran)
	{
		switch ($sasaran)
		{
			case '1':
				## sasaran penduduk
				$data = $this->db
					->select('p.nama')
					->from('tbl_pemberdayaan_masyarakat_peserta s')
					->join('tweb_penduduk p', 'p.id = s.id_peserta', 'left')
					->where('s.sasaran', $sasaran)
					->group_by('p.nama')
					->get()
					->result_array();
				break;

			case '2':
				## sasaran keluarga / KK
				$data = $this->db
					->select('p.nama')
					->from('tbl_pemberdayaan_masyarakat_peserta s')
					->join('tweb_keluarga k', 'k.id = s.id_peserta', 'left')
					->join('tweb_penduduk p', 'p.id = k.nik_kepala', 'left')
					->where('s.sasaran', $sasaran)
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

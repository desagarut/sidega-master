<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Data_kemiskinan_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
	{
		$data = $this->validasi($this->input->post());
		$hasil = $this->db->insert('data_kemiskinan', $data);
		$_SESSION["success"] = $hasil ? 1 : -1;
	}

	private function validasi($post)
	{
		$data = [];
		// Ambil dan bersihkan data input
		$data['sasaran'] = $post['sasaran'];
		$data['nama'] = nomor_surat_keputusan($post['nama']);
		$data['tahun'] = $post['tahun'];
		$data['keterangan'] = htmlentities($post['keterangan']);
		return $data;
	}

	public function list_data($sasaran = 0)
	{
		if ($sasaran > 0) $this->db->where('s.sasaran', $sasaran);

		$data = $this->db
			->select('s.*')
			->select('COUNT(st.id) AS jml')
			->from('data_kemiskinan s')
			->join('data_kemiskinan_detail st', "s.id = st.id_data_kemiskinan", 'left')
			->order_by('s.tahun')
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

	private function get_id_terdata_penduduk($id_data_kemiskinan)
	{
		$list_penduduk = $this->db
			->select('p.id')
			->from('tweb_penduduk p')
			->join('data_kemiskinan_detail t', 'p.id = t.id_terdata', 'left')
			->where('t.id_data_kemiskinan', $id_data_kemiskinan)
			->get()
			->result_array();

		return sql_in_list(array_column($list_penduduk, 'id'));
	}

	private function list_penduduk($id)
	{
		// Penduduk yang sudah terdata untuk Data Kemiskinan ini
		$terdata = $this->get_id_terdata_penduduk($id);
		if ($terdata) $this->db->where("p.id NOT IN ($terdata)");

		$data = $this->db->select('p.id as id, p.nik as nik, p.nama, p.foto, w.rt, w.rw, w.dusun')
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

	private function get_id_terdata_kk($id_data_kemiskinan)
	{
		$list_kk = $this->db
			->select('k.id')
			->from('tweb_keluarga k')
			->join('data_kemiskinan_detail t', 'k.id = t.id_terdata', 'left')
			->where('t.id_data_kemiskinan', $id_data_kemiskinan)
			->get()
			->result_array();

		return sql_in_list(array_column($list_kk, 'id'));
	}

	private function list_kk($id)
	{
		// Keluarga yang sudah terdata untuk Data Kemiskinan ini
		$terdata = $this->get_id_terdata_kk($id);
		if ($terdata) $this->db->where("k.id NOT IN ($terdata)");

		// Daftar keluarga, tidak termasuk keluarga yang sudah terdata
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

	public function get_data_kemiskinan($id)
	{
		$data = $this->db
			->select('s.*')
			->select('COUNT(st.id) AS jml')
			->from('data_kemiskinan s')
			->join('data_kemiskinan_detail st', "s.id = st.id_data_kemiskinan", 'left')
			->where('s.id', $id)
			->group_by('s.id')
			->get()
			->row_array();

		return $data;
	}

	public function get_rincian($p, $data_kemiskinan_id)
	{
		$data_kemiskinan = $this->db->where('id', $data_kemiskinan_id)->get('data_kemiskinan')->row_array();

		switch ($data_kemiskinan['sasaran'])
		{
			// Sasaran Penduduk
			case '1':
				$data = $this->get_penduduk_terdata($data_kemiskinan_id, $p);
				$data['judul']['judul_terdata_foto'] = 'FOTO';
				$data['judul']['judul_terdata_info'] = 'No. KK';
				$data['judul']['judul_terdata_plus'] = 'NIK Penduduk';
				$data['judul']['judul_terdata_nama'] = 'Nama Penduduk';
				break;

			// Sasaran Keluarga
			case '2':
				$data = $this->get_kk_terdata($data_kemiskinan_id, $p);
				$data['judul']['judul_terdata_foto'] = 'FOTO';
				$data['judul']['judul_terdata_info'] = 'NIK KK';
				$data['judul']['judul_terdata_plus'] = 'No. KK';
				$data['judul']['judul_terdata_nama'] = 'Kepala Keluarga';

				break;

			// Sasaran X
			default:
				# code...
				break;
		}

		$data['data_kemiskinan'] = $data_kemiskinan;
		$data['keyword'] = $this->autocomplete($data_kemiskinan['sasaran']);

		return $data;
	}

	private function paging($p, $get_terdata_sql)
	{
		$sql = "SELECT COUNT(*) as jumlah ".$get_terdata_sql;
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

	private function get_penduduk_terdata_sql($data_kemiskinan_id)
	{
		# Data penduduk
		$sql = " FROM data_kemiskinan_detail s
			LEFT JOIN tweb_penduduk o ON s.id_terdata = o.id
			LEFT JOIN tweb_keluarga k ON k.id = o.id_kk
			LEFT JOIN tweb_wil_clusterdesa w ON w.id = o.id_cluster
			WHERE s.id_data_kemiskinan=".$data_kemiskinan_id;
		return $sql;
	}

	private function get_penduduk_terdata($data_kemiskinan_id, $p)
	{
		$hasil = [];
		$get_terdata_sql = $this->get_penduduk_terdata_sql($data_kemiskinan_id);
		$select_sql = "SELECT s.*, s.id_terdata, o.nik, o.nama, o.tempatlahir, o.tanggallahir, o.sex, o.foto, k.no_kk, o.pekerjaan_id, o.nama_ibu, o.kk_level, w.rt, w.rw, w.dusun,
			(case when (o.id_kk IS NULL or o.id_kk = 0) then o.alamat_sekarang else k.alamat end) AS alamat
		 ";
		$sql = $select_sql.$get_terdata_sql;
		$sql .= $this->search_sql('1');
		if ( ! empty($_SESSION['per_page']) and $_SESSION['per_page'] > 0)
		{
			$hasil["paging"] = $this->paging($p, $get_terdata_sql.$this->search_sql('1'));
			$paging_sql = ' LIMIT ' .$hasil["paging"]->offset. ',' .$hasil["paging"]->per_page;
			$sql .= $paging_sql;
		}
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$data = $query->result_array();
			for ($i=0; $i<count($data); $i++)
			{
				$data[$i]['terdata_foto'] = $data[$i]['foto'];
				$data[$i]['terdata_info'] = $data[$i]['no_kk'];
				$data[$i]['terdata_plus'] = $data[$i]['nik'];
				$data[$i]['terdata_nama'] = strtoupper($data[$i]['nama']);
				$data[$i]['tempat_lahir'] = strtoupper($data[$i]['tempatlahir']);
				$data[$i]['tanggal_lahir'] = tgl_indo($data[$i]['tanggallahir']);
				$data[$i]['sex'] = ($data[$i]['sex'] == 1) ? "LAKI-LAKI" : "PEREMPUAN";
				$data[$i]['info'] = strtoupper($data[$i]['alamat'] . " "  .  "RT/RW ". $data[$i]['rt']."/".$data[$i]['rw'] . " - " . $this->setting->sebutan_dusun . " " . $data[$i]['dusun']);
				$data[$i]['pekerjaan_id'] = $data[$i]['pekerjaan_id'];
				$data[$i]['nama_ibu'] = $data[$i]['nama_ibu'];
				$data[$i]['kk_level'] = $data[$i]['kk_level'];
			}
			$hasil['terdata'] = $data;
		}

		return $hasil;
	}

	private function get_kk_terdata_sql($data_kemiskinan_id)
	{
		# Data KK
		$sql = " FROM data_kemiskinan_detail s
			LEFT JOIN tweb_keluarga o ON s.id_terdata = o.id
			LEFT JOIN tweb_penduduk q ON o.nik_kepala = q.id
			LEFT JOIN tweb_wil_clusterdesa w ON w.id = q.id_cluster
			WHERE s.id_data_kemiskinan=".$data_kemiskinan_id;
		return $sql;
	}


	private function get_kk_terdata($data_kemiskinan_id, $p)
	{
		$hasil = [];
		$get_terdata_sql = $this->get_kk_terdata_sql($data_kemiskinan_id);
		$select_sql = "SELECT s.*, s.id_terdata, o.no_kk, s.id_data_kemiskinan, o.nik_kepala, o.alamat, q.nik, q.nama, q.tempatlahir, q.tanggallahir, q.sex, q.foto, q.pekerjaan_id, w.rt, w.rw, w.dusun ";
		$sql = $select_sql.$get_terdata_sql;
		$sql .= $this->search_sql('2');
		if ( ! empty($_SESSION['per_page']) and $_SESSION['per_page'] > 0)
		{
			$hasil["paging"] = $this->paging($p, $get_terdata_sql.$this->search_sql('2'));
			$paging_sql = ' LIMIT ' .$hasil["paging"]->offset. ',' .$hasil["paging"]->per_page;
			$sql .= $paging_sql;
		}
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$data = $query->result_array();
			for ($i=0; $i<count($data); $i++)
			{
				$data[$i]['terdata_foto'] = $data[$i]['foto'];
				$data[$i]['terdata_info'] = $data[$i]['nik'];
				$data[$i]['terdata_plus'] = $data[$i]['no_kk'];
				$data[$i]['terdata_nama'] = strtoupper($data[$i]['nama']);
				$data[$i]['tempat_lahir'] = strtoupper($data[$i]['tempatlahir']);
				$data[$i]['tanggal_lahir'] = tgl_indo($data[$i]['tanggallahir']);
				$data[$i]['sex'] = ($data[$i]['sex'] == 1) ? "LAKI-LAKI" : "PEREMPUAN";
				$data[$i]['info'] = strtoupper($data[$i]['alamat'] . " "  .  "RT/RW ". $data[$i]['rt']."/".$data[$i]['rw'] . " - " . $this->setting->sebutan_dusun . " " . $data[$i]['dusun']);
				$data[$i]['pekerjaan_id'] = $data[$i]['pekerjaan_id'];
				$data[$i]['nama_ibu'] = $data[$i]['nama_ibu'];
				$data[$i]['kk_level'] = $data[$i]['kk_level'];
			}
			$hasil['terdata'] = $data;
		}
		return $hasil;
	}

	/*
		Mengambil data individu terdata
	*/
	public function get_terdata($id_terdata, $sasaran)
	{
		$this->load->model('surat_model');
		switch ($sasaran)
		{
			// Sasaran Penduduk
			case 1:
				$sql = "SELECT u.id AS id, u.nama AS nama, x.nama AS sex, u.id_kk AS id_kk,
				u.tempatlahir AS tempatlahir, u.tanggallahir AS tanggallahir, u.foto AS foto,
				(select (date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0) AS `(date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0)`
				from tweb_penduduk where (tweb_penduduk.id = u.id)) AS umur,
				w.nama AS status_kawin, f.nama AS warganegara, a.nama AS agama, d.nama AS pendidikan, j.nama AS pekerjaan_id, u.nik AS nik, c.rt AS rt, c.rw AS rw, c.dusun AS dusun, k.no_kk AS no_kk, k.alamat,
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
				$query = $this->db->query($sql, $id_terdata);
				$data  = $query->row_array();
				$data['terdata_foto'] = $data['foto'];
				$data['terdata_info'] = $data['nik'];
				$data['terdata_plus'] = $data['no_kk'];
				$data['terdata_nama'] = $data['nama'];
				$data['alamat_wilayah']= $this->surat_model->get_alamat_wilayah($data);
				break;

			// Sasaran Keluarga
			case 2:
				$data = $this->keluarga_model->get_kepala_kk($id_terdata);
				$data['terdata_foto'] = $data['foto'];
				$data['terdata_info'] = $data['nik'];
				$data['terdata_plus'] = $data['no_kk'];
				$data['terdata_nama'] = $data['nama'];
				$data['id'] = $data['id_kk']; // id_kk digunakan sebagai id terdata
				break;

			default:
				break;
		}
		return $data;
	}

	public function hapus($id)
	{
		$ada = $this->db->where('id_data_kemiskinan', $id)
			->get('data_kemiskinan_detail')->num_rows();
		if ($ada)
		{
			$this->session->success = '-1';
			$this->session->error_msg = ' --> Tidak bisa dihapus, karena masih digunakan';
			return;
		}
		$hasil = $this->db->where('id', $id)->delete('data_kemiskinan');

		status_sukses($hasil); //Tampilkan Pesan
	}

	public function update($id)
	{
		$data = $this->validasi($this->input->post());
		$hasil = $this->db->where('id', $id)->update('data_kemiskinan', $data);

		status_sukses($hasil); //Tampilkan Pesan
	}

	public function add_terdata($post, $id)
	{
		$id_terdata = $post['id_terdata'];
		$id_dtks = $post['id_dtks'];

		$sasaran = $this->db->select('sasaran')->where('id', $id)->get('data_kemiskinan')->row()->sasaran;
		$hasil = $this->db->where('id_data_kemiskinan', $id)->where('id_terdata', $id_terdata)->get('data_kemiskinan_detail');
		if ($hasil->num_rows() > 0)
		{
			return false;
		}
		else
		{
			$data = array(
				'id_data_kemiskinan' => $id,
				'id_dtks' => $id_dtks,
				'id_terdata' => $id_terdata,
				'sasaran' => $sasaran,
				'keterangan_padan' => substr(htmlentities($post['keterangan_padan']), 0, 50), // Batasi 100 karakter
				'keterangan_bantuan' => substr(htmlentities($post['keterangan_bantuan']), 0, 100) // Batasi 100 karakter

			);
			return $this->db->insert('data_kemiskinan_detail', $data);
		}
				status_sukses($hasil); //Tampilkan Pesan

	}

	public function hapus_terdata($id_terdata)
	{
		$this->db->where('id', $id_terdata);
		$this->db->delete('data_kemiskinan_detail');
	}

	// $id = data_kemiskinan_detail.id
	public function edit_terdata($post, $id)
	{
		$data['keterangan_padan'] = substr(htmlentities($post['keterangan_padan']), 0, 50); // Batasi 100 karakter
		$data['keterangan_bantuan'] = substr(htmlentities($post['keterangan_bantuan']), 0, 100); // Batasi 100 karakter

		$data['id_dtks'] = $post['id_dtks'];
		$this->db->where('id', $id);
		$this->db->update('data_kemiskinan_detail', $data);
	}

	/*
		Mengambil data individu terdata menggunakan id tabel data_kemiskinan_detail
	*/
	public function get_data_kemiskinan_terdata_by_id($id)
	{
		$data = $this->db->where('id', $id)->get('data_kemiskinan_detail')->row_array();
		// Data tambahan untuk ditampilkan
		$terdata = $this->get_terdata($data['id_terdata'], $data['sasaran']);
		switch ($data['sasaran'])
		{
			case 1:
				$data['id_dtks'] = $terdata['id_dtks'];
				$data['judul_terdata_nama'] = 'NIK';
				$data['judul_terdata_info'] = 'Nama Terdata';
				$data['terdata_nama'] = $terdata['nik'];
				$data['terdata_info'] = $terdata['nama'];
				$data['pekerjaan_id'] = $terdata['pekerjaan_id'];

				break;
			case 2:
				$data['id_dtks'] = $terdata['id_dtks'];
				$data['judul_terdata_nama'] = 'No. KK';
				$data['judul_terdata_info'] = 'Kepala Keluarga';
				$data['terdata_nama'] = $terdata['no_kk'];
				$data['terdata_info'] = $terdata['nama'];
				$data['pekerjaan_id'] = $terdata['pekerjaan_id'];
				break;
			default:
		}

		return $data;
	}

	public function get_terdata_data_kemiskinan($sasaran,$id_terdata)
	{
		$list_data_kemiskinan = [];
		/*
		 * Menampilkan keterlibatan $id_terdata dalam data data_kemiskinan yang ada
		 *
		 * */
		$strSQL = "SELECT p.id as id, o.id_terdata as nik, p.nama as nama
			FROM data_kemiskinan_detail o
			LEFT JOIN data_kemiskinan p ON p.id = o.id_data_kemiskinan
			WHERE ((o.id_terdata='".$id_terdata."') AND (o.sasaran='".$sasaran."'))";
		$query = $this->db->query($strSQL);
		if ($query->num_rows() > 0)
		{
			$list_data_kemiskinan = $query->result_array();
		}

		switch ($sasaran)
		{
			case 1:
				/*
				 * Rincian Penduduk
				 * */
				$strSQL = "SELECT o.nama, o.foto, o.nik, o.pekerjaan_id, o.nama_ibu, w.rt, w.rw, w.dusun,
				(case when (o.id_kk IS NULL or o.id_kk = 0) then o.alamat_sekarang else k.alamat end) AS alamat
					FROM tweb_penduduk o
					LEFT JOIN tweb_keluarga k ON k.id = o.id_kk
					LEFT JOIN tweb_wil_clusterdesa w ON w.id = o.id_cluster
					WHERE o.id = '".$id_terdata."'";
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
				$strSQL = "SELECT o.nik_kepala, o.no_kk, o.alamat, p.nama, w.rt, w.rw, w.dusun, w.pekerjaan_id
					FROM tweb_keluarga o
					LEFT JOIN tweb_penduduk p ON o.nik_kepala = p.id
					LEFT JOIN tweb_wil_clusterdesa w ON w.id = p.id_cluster
					WHERE o.id = '".$id_terdata."'";
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
		if ( ! empty($list_data_kemiskinan))
		{
			$hasil = array("daftar_data_kemiskinan" => $list_data_kemiskinan, "profil" => $data_profil);
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
					->from('data_kemiskinan_detail s')
					->join('tweb_penduduk p', 'p.id = s.id_terdata', 'left')
					->where('s.sasaran', $sasaran)
					->group_by('p.nama')
					->get()
					->result_array();
				break;

			case '2':
				## sasaran keluarga / KK
				$data = $this->db
					->select('p.nama')
					->from('data_kemiskinan_detail s')
					->join('tweb_keluarga k', 'k.id = s.id_terdata', 'left')
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

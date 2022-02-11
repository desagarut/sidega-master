<?php

define("JENIS_VAKSIN", serialize(array(
	"SINOVAC" => "SINOVAC",
	"ASTRAZENECA" => "ASTRAZENECA",
	"SINOPHARM" => "SINOPHARM",
	"MODERNA" => "MODERNA",
	"PFIZER" => "PFIZER",
	"NOVAVAX" => "NOVAVAX",
	"SPUTNIK-V" => "SPUTNIK-V",
	"JANSEN" => "JANSEN",
	"CONVIDENCIA" => "CONVIDENCIA",
	"ZIFIVAK" => "ZIFIVAK",
)));


$h_plus_array = array();
$h_plus_array["-- Semua Data --"] = "99";
for ($i=0; $i<=31; $i++, $h_plus_array["H+$i"] = "$i");
define("H_PLUS", serialize($h_plus_array));


class Covid19_vaksin_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('referensi_model');
	}


	public function list_jenis_vaksin()
	{
		$status_rekam = array_flip(unserialize(JENIS_VAKSIN));
		return $status_rekam;
	}

	public function list_h_plus()
	{
		$status_rekam = array_flip(unserialize(H_PLUS));
		return $status_rekam;
	}

	// TABEL peserta_vaksin
	public function get_penduduk_not_in_peserta_vaksin()
	{
		$retval = array();

		$this->db->select('p.id');
		$this->db->from('penduduk_hidup p');
		$this->db->join('covid19_vaksin t', 'p.id = t.id_terdata', 'right');
		$penduduk_not_in_peserta_vaksin = $this->db->get()->result_array();

		$not_in_peserta_vaksin = "";
		foreach ($penduduk_not_in_peserta_vaksin as $row)
		{
			$not_in_peserta_vaksin .= ",".$row["id"];
		}
		$not_in_peserta_vaksin = ltrim($not_in_peserta_vaksin, ",");

		$this->db->select('p.id as id, p.nik as nik, p.nama, w.rt, w.rw, w.dusun');
		$this->db->from('penduduk_hidup p');
		$this->db->join('tweb_wil_clusterdesa w', 'w.id = p.id_cluster', 'left');

		if (!empty($not_in_peserta_vaksin))
		{
			$this->db->where("p.id NOT IN ($not_in_peserta_vaksin)");
		}

		$data = $this->db->get()->result_array();
		foreach ($data as $item)
		{
			$penduduk = array(
				'id' => $item['id'],
				'nama' => strtoupper($item['nama']) ." [".$item['nik']."]",
				'info' => "RT/RW ". $item['rt']."/".$item['rw']." - ".strtoupper($item['dusun'])
			);
			$retval[] = $penduduk;
		}
		return $retval;
	}

	public function get_penduduk_by_id($id)
	{
		$this->db->select('u.id, u.nama, x.nama AS sex, u.id_kk, u.tempatlahir, u.tanggallahir, w.nama AS status_kawin, f.nama AS warganegara, a.nama AS agama, d.nama AS pendidikan, j.nama AS pekerjaan, u.nik, c.rt, c.rw, c.dusun, k.no_kk, k.alamat');
		$this->db->select("(select (date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0) AS `(date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0)`
		from tweb_penduduk where (tweb_penduduk.id = u.id)) AS umur");
		$this->db->select('(select tweb_penduduk.nama AS nama from tweb_penduduk where (tweb_penduduk.id = k.nik_kepala)) AS kepala_kk');

		$this->db->from('tweb_penduduk u');

		$this->db->join('tweb_penduduk_sex x', 'u.sex = x.id', 'left');
		$this->db->join('tweb_penduduk_kawin w', 'u.status_kawin = w.id', 'left');
		$this->db->join('tweb_penduduk_agama a', 'u.agama_id = a.id', 'left');
		$this->db->join('tweb_penduduk_pendidikan_kk d', 'u.pendidikan_kk_id = d.id', 'left');
		$this->db->join('tweb_penduduk_pekerjaan j', 'u.pekerjaan_id = j.id', 'left');
		$this->db->join('tweb_wil_clusterdesa c', 'u.id_cluster = c.id', 'left');
		$this->db->join('tweb_keluarga k', 'u.id_kk = k.id', 'left');
		$this->db->join('tweb_penduduk_warganegara f', 'u.warganegara_id = f.id', 'left');

		$this->db->where('u.id', $id);

		$query = $this->db->get();
		$data  = $query->row_array();

		$this->load->model('surat_model');
		$data['alamat_wilayah']= $this->surat_model->get_alamat_wilayah($data);

		return $data;
	}

	private function get_peserta_vaksin($id = NULL, $pokmas = NULL, $limit = NULL)
	{
		$this->db->select('s.*, o.nik as terdata_id, o.nama, o.tempatlahir, o.tanggallahir, o.sex, w.rt, w.rw, w.dusun');
		$this->db->select("(select (date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0) AS `(date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0)`
		from tweb_penduduk where (tweb_penduduk.id = o.id)) AS umur");
		$this->db->select('(case when (o.id_kk IS NULL or o.id_kk = 0) then o.alamat_sekarang else k.alamat end) AS `alamat`');
		$this->db->from('covid19_vaksin s');
		$this->db->join('tweb_penduduk o', 's.id_terdata = o.id', 'left');
		$this->db->join('tweb_keluarga k', 'k.id = o.id_kk', 'left');
		$this->db->join('tweb_wil_clusterdesa w', 'w.id = o.id_cluster', 'left');

		if (isset($id))
			$this->db->where('s.id', $id);

		if ($is_pantau_covid_page)
			$this->db->where('s.is_wajib_pantau', '1');

		if (isset($limit))
			$this->db->limit($limit["per_page"], $limit["offset"]);

		$this->db->order_by('s.tanggal', 'DESC');

		return $this->db->get();
	}

	public function get_peserta_vaksin_by_id($id)
	{
		$data = $this->get_peserta_vaksin($id)->row_array();
		$data['judul_terdata_nama'] = 'NIK';
		$data['judul_terdata_info'] = 'Nama Terdata';
		$data['terdata_nama'] = $data['terdata_id'];
		$data['terdata_info'] = $data['nama'];
		return $data;
	}

	public function get_list_peserta_vaksin($page)
	{
		$retval = array();

		// paging
		if ($this->session->has_userdata('per_page') and $this->session->userdata('per_page') > 0)
		{

			$this->load->library('paging');

			$cfg['page'] = $page;
			$cfg['per_page'] = $this->session->userdata('per_page');
			$cfg['num_rows'] = $this->get_peserta_vaksin()->num_rows();

			$this->paging->init($cfg);
			$retval["paging"] = $this->paging;
		}
		// paging end

		// get list
		$limit = null;
		if (isset($retval["paging"]))
		{
			$limit["per_page"] = $retval["paging"]->per_page;
			$limit["offset"] = $retval["paging"]->offset;
		}

		$query = $this->get_peserta_vaksin(NULL, NULL, NULL, $limit);
		if ($query->num_rows() > 0)
		{
			$data = $query->result_array();
			for ($i=0; $i<count($data); $i++)
			{
				$data[$i]['id'] = $data[$i]['id'];
				$data[$i]['terdata_nama'] = $data[$i]['terdata_id'];
				$data[$i]['terdata_info'] = $data[$i]['nama'];
				$data[$i]['nama'] = strtoupper($data[$i]['nama']);
				$data[$i]['tempat_lahir'] = strtoupper($data[$i]['tempatlahir']);
				$data[$i]['tanggal_lahir'] = tgl_indo($data[$i]['tanggallahir']);
				$data[$i]['sex'] = ($data[$i]['sex'] == 1) ? "LAKI-LAKI" : "PEREMPUAN";
				$data[$i]['info'] = $data[$i]['alamat'] . " "  .  "RT/RW ". $data[$i]['rt']."/".$data[$i]['rw']." - ". "Dusun " . strtoupper($data[$i]['dusun']);
			}
			$retval['peserta_vaksin_list'] = $data;
		}
		return $retval;
	}

	public function get_list_peseta_wajib_pantau($is_wajib_pantau = NULL)
	{
		return $this->get_peserta_vaksin(NULL, $is_wajib_pantau, NULL)->result_array();
	}

	public function add_peserta_vaksin($post)
	{
		$data = $this->sterilkan($post);
		$data['id_terdata'] = $post['id_terdata'];

		return $this->db->insert('covid19_vaksin', $data);
	}

	private function sterilkan($post)
	{
		//$list_jenis_vaksin = $this->referensi_model->list_ref_flip(JENIS_VAKSIN);
		$data = array(
			'tanggal' => $post['tanggal'],
			'no_hp' => bilangan_spasi($post['no_hp']),
			'email' => strip_tags($post['email']),
			'pokmas' => $post['pokmas'],
			'dosis1' => $post['dosis1'],
			'dosis2' => $post['dosis2'],
			'jenis_vaksin' => $post['jenis_vaksin'],
			'kipi' => $post['kipi'],
			'is_wajib_pantau' => $post['is_wajib_pantau'],
			'keterangan' => alfanumerik_spasi($post['keterangan'])
		);
		return $data;
	}

	public function update_peserta_vaksin_by_id($post, $id)
	{
		$data = $this->sterilkan($post);

		$this->db->where('id',$id);
		$this->db->update('covid19_vaksin', $data);
	}

	public function delete_peserta_vaksin_by_id($id)
	{
		//delete warga peserta_vaksin
		$this->db->where('id', $id);
		$this->db->delete('covid19_vaksin');
	}
	// TABEL PEMUDIK END


	// TABEL PEMANTAUAN
	private function get_pantau_peserta_vaksin($filter_tgl=null, $filter_nik=null, $limit=NULL)
	{
		$this->db->select('p.*, o.nik, o.nama, o.sex, s.tanggal');
		$this->db->select('DATEDIFF(p.tanggal_jam, s.tanggal) AS date_diff');
		$this->db->select("(select (date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0) AS `(date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0)`
		from tweb_penduduk where (tweb_penduduk.id = o.id)) AS umur");
		//$this->db->from('covid19_pantau p');
		$this->db->join('covid19_vaksin s', 's.id = p.id_vaksin', 'left');
		$this->db->join('tweb_penduduk o', 's.id_terdata = o.id', 'left');
		$this->db->order_by('o.nik', 'ASC');
		$this->db->order_by('p.tanggal_jam', 'DESC');

		if (isset($filter_tgl))
		{
			if ($filter_tgl != '0')
				$this->db->where('DATE(p.tanggal_jam)', $filter_tgl);
		}

		if (isset($filter_nik))
		{
			if ($filter_nik != '0')
				$this->db->where('p.id_vaksin', $filter_nik);
		}

		if (isset($limit))
			$this->db->limit($limit["per_page"], $limit["offset"]);

		return  $this->db->get();
	}

	public function get_list_pantau_peserta_vaksin($page, $filter_tgl=null, $filter_nik=null)
	{
		$retval = array();

		// paging
		if ($this->session->has_userdata('per_page') and $this->session->userdata('per_page') > 0)
		{
			$this->load->library('paging');

			$cfg['page'] = $page;
			$cfg['per_page'] = $this->session->userdata('per_page');
			$cfg['num_rows'] = $this->get_pantau_peserta_vaksin($filter_tgl, $filter_nik)->num_rows();

			$this->paging->init($cfg);
			$retval["paging"] = $this->paging;
		}
		// paging end

		// get list
		$limit = null;
		if (isset($retval["paging"]))
		{
			$limit["per_page"] = $retval["paging"]->per_page;
			$limit["offset"] = $retval["paging"]->offset;
		}

		$query = $this->get_pantau_peserta_vaksin($filter_tgl, $filter_nik, $limit);
		$retval["query_array"] = $query->result_array();
		return $retval;
	}

	public function get_unique_date_pantau_peserta_vaksin()
	{
		$this->db->select('DATE(p.tanggal_jam) as tanggal');
		$this->db->from('covid19_pantau p');
		$this->db->group_by("tanggal");
		$this->db->order_by('tanggal', 'DESC');

		return $this->db->get()->result_array();
	}

	public function get_unique_nik_pantau_peserta_vaksin()
	{
		$this->db->select('p.id_vaksin, o.nik, o.nama');
		$this->db->from('covid19_pantau p');
		$this->db->join('covid19_vaksin s', 's.id = p.id_vaksin', 'left');
		$this->db->join('tweb_penduduk o', 's.id_terdata = o.id', 'left');
		$this->db->group_by("p.id_vaksin");
		$this->db->group_by("o.nik");
		$this->db->group_by("o.nama");

		return $this->db->get()->result_array();
	}

	public function add_pantau_peserta_vaksin($post)
	{
		$data = array(
			'id_vaksin' => $post['terdata'],
			'tanggal_jam' => $post['tgl_jam'],
			'suhu_tubuh' => $post['suhu'],
			'batuk' => (isset($post['batuk']) ? '1':'0'),
			'flu' => (isset($post['flu']) ? '1':'0'),
			'sesak_nafas' => (isset($post['sesak']) ? '1':'0'),
			'keluhan_lain' => $this->security->xss_clean($post['keluhan']),
			'status_covid' => $this->security->xss_clean($post['status_covid']),
		);
		return $this->db->insert('covid19_pantau', $data);
	}

	public function delete_pantau_peserta_vaksin_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('covid19_pantau');
	}
	// TABEL PEMANTAUAN END

}
?>

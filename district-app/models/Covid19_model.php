<?php
define("TUJUAN_MUDIK", serialize(array(
	"Liburan" => "1",
	"Menjenguk Keluarga" => "2",
	"Pulang Kampung" => "3",
	"Dll" => "4",
)));

define("STATUS_COVID", serialize(array(
	"Orang Dalam Pemantauan (ODP)" => "ODP",
	"Pasien Dalam Pengawasan (PDP)" => "PDP",
	"Orang Dalam Resiko (ODR)" => "ODR",
	"Orang Tanpa Gejala (OTG)" => "OTG",
	"Positif Covid-19" => "POSITIF",
	"Dll" => "DLL",
)));

$h_plus_array = array();
$h_plus_array["-- Semua Data --"] = "99";
for ($i=0; $i<=31; $i++, $h_plus_array["H+$i"] = "$i");
define("H_PLUS", serialize($h_plus_array));


class Covid19_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('referensi_model');
	}

	public function list_tujuan_mudik()
	{
		$status_rekam = array_flip(unserialize(TUJUAN_MUDIK));
		return $status_rekam;
	}

	public function list_status_covid()
	{
		$status_rekam = array_flip(unserialize(STATUS_COVID));
		return $status_rekam;
	}

	public function list_h_plus()
	{
		$status_rekam = array_flip(unserialize(H_PLUS));
		return $status_rekam;
	}

	// TABEL PEMUDIK
	public function get_penduduk_not_in_pemudik()
	{
		$retval = array();

		$this->db->select('p.id');
		$this->db->from('penduduk_hidup p');
		$this->db->join('covid19_pemudik t', 'p.id = t.id_terdata', 'right');
		$penduduk_not_in_pemudik = $this->db->get()->result_array();

		$not_in_pemudik = "";
		foreach ($penduduk_not_in_pemudik as $row)
		{
			$not_in_pemudik .= ",".$row["id"];
		}
		$not_in_pemudik = ltrim($not_in_pemudik, ",");

		$this->db->select('p.id as id, p.nik as nik, p.nama, w.rt, w.rw, w.dusun');
		$this->db->from('penduduk_hidup p');
		$this->db->join('tweb_wil_clusterdesa w', 'w.id = p.id_cluster', 'left');

		if (!empty($not_in_pemudik))
		{
			$this->db->where("p.id NOT IN ($not_in_pemudik)");
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

	private function get_pemudik($id = NULL, $is_wajib_pantau = NULL, $limit = NULL)
	{
		$this->db->select('s.*, o.nik as terdata_id, o.nama, o.tempatlahir, o.tanggallahir, o.sex, w.rt, w.rw, w.dusun');
		$this->db->select("(select (date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0) AS `(date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0)`
		from tweb_penduduk where (tweb_penduduk.id = o.id)) AS umur");
		$this->db->select('(case when (o.id_kk IS NULL or o.id_kk = 0) then o.alamat_sekarang else k.alamat end) AS `alamat`');
		$this->db->from('covid19_pemudik s');
		$this->db->join('tweb_penduduk o', 's.id_terdata = o.id', 'left');
		$this->db->join('tweb_keluarga k', 'k.id = o.id_kk', 'left');
		$this->db->join('tweb_wil_clusterdesa w', 'w.id = o.id_cluster', 'left');

		if (isset($id))
			$this->db->where('s.id', $id);

		if ($is_pantau_covid_page)
			$this->db->where('s.is_wajib_pantau', '1');

		if (isset($limit))
			$this->db->limit($limit["per_page"], $limit["offset"]);

		$this->db->order_by('s.tanggal_datang', 'DESC');

		return $this->db->get();
	}

	public function get_pemudik_by_id($id)
	{
		$data = $this->get_pemudik($id)->row_array();
		$data['judul_terdata_nama'] = 'NIK';
		$data['judul_terdata_info'] = 'Nama Terdata';
		$data['terdata_nama'] = $data['terdata_id'];
		$data['terdata_info'] = $data['nama'];
		return $data;
	}

	public function get_list_pemudik($page)
	{
		$retval = array();

		// paging
		if ($this->session->has_userdata('per_page') and $this->session->userdata('per_page') > 0)
		{

			$this->load->library('paging');

			$cfg['page'] = $page;
			$cfg['per_page'] = $this->session->userdata('per_page');
			$cfg['num_rows'] = $this->get_pemudik()->num_rows();

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

		$query = $this->get_pemudik(NULL, NULL, NULL, $limit);
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
			$retval['pemudik_list'] = $data;
		}
		return $retval;
	}

	public function get_list_pemudik_wajib_pantau($is_wajib_pantau = NULL)
	{
		return $this->get_pemudik(NULL, $is_wajib_pantau, NULL)->result_array();
	}

	public function add_pemudik($post)
	{
		$data = $this->sterilkan($post);
		$data['id_terdata'] = $post['id_terdata'];

		return $this->db->insert('covid19_pemudik', $data);
	}

	private function sterilkan($post)
	{
		$tujuan_mudik = $this->referensi_model->list_ref_flip(TUJUAN_MUDIK);
		$data = array(
			'tanggal_datang' => $post['tanggal_tiba'],
			'asal_mudik' => alfanumerik_spasi($post['asal_pemudik']),
			'durasi_mudik' => $post['durasi_pemudik'],
			'tujuan_mudik' => $tujuan_mudik[$post['tujuan_pemudik']],
			'no_hp' => bilangan_spasi($post['hp_pemudik']),
			'email' => strip_tags($post['email_pemudik']),
			'status_covid' => $post['status_covid'],
			'is_wajib_pantau' => $post['wajib_pantau'],
			'keluhan_kesehatan' => alfanumerik_spasi($post['keluhan']),
			'keterangan' => alfanumerik_spasi($post['keterangan'])
		);
		return $data;
	}

	public function update_pemudik_by_id($post, $id)
	{
		$data = $this->sterilkan($post);

		$this->db->where('id',$id);
		$this->db->update('covid19_pemudik', $data);
	}

	public function delete_pemudik_by_id($id)
	{
		//delete warga pemudik
		$this->db->where('id', $id);
		$this->db->delete('covid19_pemudik');
	}
	// TABEL PEMUDIK END


	// TABEL PEMANTAUAN
	private function get_pantau_pemudik($filter_tgl=null, $filter_nik=null, $limit=NULL)
	{
		$this->db->select('p.*, o.nik, o.nama, o.sex, s.tanggal_datang');
		$this->db->select('DATEDIFF(p.tanggal_jam, s.tanggal_datang) AS date_diff');
		$this->db->select("(select (date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0) AS `(date_format(from_days((to_days(now()) - to_days(tweb_penduduk.tanggallahir))),'%Y') + 0)`
		from tweb_penduduk where (tweb_penduduk.id = o.id)) AS umur");
		$this->db->from('covid19_pantau p');
		$this->db->join('covid19_pemudik s', 's.id = p.id_pemudik', 'left');
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
				$this->db->where('p.id_pemudik', $filter_nik);
		}

		if (isset($limit))
			$this->db->limit($limit["per_page"], $limit["offset"]);

		return  $this->db->get();
	}

	public function get_list_pantau_pemudik($page, $filter_tgl=null, $filter_nik=null)
	{
		$retval = array();

		// paging
		if ($this->session->has_userdata('per_page') and $this->session->userdata('per_page') > 0)
		{
			$this->load->library('paging');

			$cfg['page'] = $page;
			$cfg['per_page'] = $this->session->userdata('per_page');
			$cfg['num_rows'] = $this->get_pantau_pemudik($filter_tgl, $filter_nik)->num_rows();

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

		$query = $this->get_pantau_pemudik($filter_tgl, $filter_nik, $limit);
		$retval["query_array"] = $query->result_array();
		return $retval;
	}

	public function get_unique_date_pantau_pemudik()
	{
		$this->db->select('DATE(p.tanggal_jam) as tanggal');
		$this->db->from('covid19_pantau p');
		$this->db->group_by("tanggal");
		$this->db->order_by('tanggal', 'DESC');

		return $this->db->get()->result_array();
	}

	public function get_unique_nik_pantau_pemudik()
	{
		$this->db->select('p.id_pemudik, o.nik, o.nama');
		$this->db->from('covid19_pantau p');
		$this->db->join('covid19_pemudik s', 's.id = p.id_pemudik', 'left');
		$this->db->join('tweb_penduduk o', 's.id_terdata = o.id', 'left');
		$this->db->group_by("p.id_pemudik");
		$this->db->group_by("o.nik");
		$this->db->group_by("o.nama");

		return $this->db->get()->result_array();
	}

	public function add_pantau_pemudik($post)
	{
		$data = array(
			'id_pemudik' => $post['terdata'],
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

	public function delete_pantau_pemudik_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('covid19_pantau');
	}
	// TABEL PEMANTAUAN END

}
?>

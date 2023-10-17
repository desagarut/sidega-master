<?php

class Data_persil_model extends MY_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function autocomplete($cari='')
	{
		return $this->autocomplete_str('nomor', 'persil', $cari);
	}

	private function search_sql()
	{
		if ($this->session->cari)
		{
			$cari = $this->session->cari;
			$kw = $this->db->escape_like_str($cari);
			$kw = '%' .$kw. '%';
			$this->db->where("p.nomor like '$kw'");
		}
	}

	// Filter kelas tanah
	private function filter_kelas()
	{
		if (isset($this->session->tipe))
		{
			$tipe = $this->session->tipe;

			if ($tipe == "BASAH")
			{
				$this->db->where("p.kelas BETWEEN 1 AND 4");
			}
			else
			{
				$this->db->where("p.kelas BETWEEN 5 AND 8");
			}
		}
		if (isset($this->session->kelas))
		{
			$kelas = $this->session->kelas;
			$this->db->where("p.kelas = $kelas");
		}
	}

	// Filter lokasi luar/dalam desa
	private function filter_lokasi()
	{
		if (isset($this->session->lokasi))
		{
			$lokasi = $this->session->lokasi;
			if ($lokasi == "2")
			{
				$this->db->where("p.id_wilayah IS NULL");
			}
			else
			{
				$this->db->where("p.id_wilayah IS NOT NULL");
			}
		}
	}

	// Filter wilayah
	private function filter_wilayah()
	{
		if (isset($this->session->dusun))
		{
			$dusun = $this->session->dusun;
			{
				$this->db->where("w.dusun = '$dusun'");
			}
		}
		if (isset($this->session->rw))
		{
			$rw = $this->session->rw;
			$this->db->where("w.rw = '$rw'");
		}
		if (isset($this->session->rt))
		{
			$rt = $this->session->rt;
			$this->db->where("w.rt = '$rt'");
		}
	}

	//list pada data select
	public function list_kelas($tipe='')
	{
		$this->db
			->distinct()
			->select('k.id, k.kode')
			->from('persil p')
			->join('ref_persil_kelas k', 'k.id = p.kelas', 'left')
			->where("tipe = '$tipe'");

		$data = $this->db
			->get()
			->result_array();
		return $data;
	}

	//list pada data select
	public function list_dusun()
	{
		$this->db
			->distinct()
			->select('w.dusun')
			->from('persil p')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_wilayah', 'left')
			->where("w.dusun IS NOT NULL");
		$this->filter_kelas();

		$data = $this->db
			->get()
			->result_array();
		return $data;
	}

	//list pada data select
	public function list_rw($dusun='')
	{
		$data = $this->db
			->distinct()
			->select('w.rw')
			->from('persil p')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_wilayah', 'left')
			->where("w.dusun IS NOT NULL")
			->where('dusun', $dusun)
			->get()
			->result_array();
		return $data;
	}

	//list pada data select
	public function list_rt($dusun='', $rw='')
	{
		$data = $this->db
			->distinct()
			->select('w.rt')
			->from('persil p')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_wilayah', 'left')
			->where("w.dusun IS NOT NULL")
			->where('dusun', $dusun)
			->where('rw', $rw)
			->get()
			->result_array();
		return $data;
	}

	public function paging($p=1)
	{
		$this->main_sql();
		$jml = $this->db->select('p.id')->get()->num_rows();

		$this->load->library('paging');
		$cfg['page'] = $p;
		$cfg['per_page'] = $this->session->per_page;
		$cfg['num_rows'] = $jml;
		$this->paging->init($cfg);

		return $this->paging;
	}

	private function main_sql()
	{
		$this->db->from('persil p')
			->join('ref_persil_kelas k', 'k.id = p.kelas', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_wilayah', 'left')
			->join('mutasi_letterc m', 'p.id = m.id_persil', 'left')
			->join('letterc c', 'c.id = p.letterc_awal', 'left')
			->group_by('p.id, nomor_urut_bidang');
		$this->filter_kelas();
		$this->filter_lokasi();
		$this->filter_wilayah();
		$this->search_sql();
	}

	public function list_data($offset = 0, $per_page = 0)
	{
		$this->main_sql();
		$this->db->select('p.*, k.kode, count(m.id_persil) as jml_bidang, c.nomor as nomor_letterc_awal')
			->select('(CASE WHEN p.id_wilayah IS NOT NULL THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE p.lokasi END) AS alamat')
			->order_by('nomor, nomor_urut_bidang');

		if ($per_page > 0 ) $this->db->limit($per_page, $offset);
		$data =  $this->db
			->get()
			->result_array();

		$j = $offset;
		for ($i=0; $i<count($data); $i++)
		{
			$data[$i]['no'] = $j + 1;
			$j++;
		}

		return $data;
	}

	public function list_persil()
	{
		$data = $this->db
			->select('p.id, nomor, nomor_urut_bidang')
			->select('CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) as lokasi')
			->from('persil p')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_wilayah')
			->order_by('nomor, nomor_urut_bidang')
			->get()->result_array();
		return $data;
	}

	public function get_persil($id)
	{
		$data = $this->db->select('p.*, k.kode, k.tipe, k.ndesc, c.nomor as nomor_letterc_awal')
			->select('CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) as alamat')
			->from('persil p')
			->join('ref_persil_kelas k', 'k.id = p.kelas', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_wilayah', 'left')
			->join('letterc c', 'c.id = p.letterc_awal', 'left')
			->where('p.id', $id)
			->get()->row_array();
		return $data;
	}

	public function get_list_mutasi($id)
	{
		$this->db
			->select('m.*, m.id_letterc_masuk, c.nomor as letterc_masuk, k.id as id_letterc_keluar')
			->from('persil p')
			->join('mutasi_letterc m', 'p.id = m.id_persil', 'left')
			->join('letterc c', 'c.id = m.id_letterc_masuk', 'left')
			->join('letterc k', 'k.nomor = m.letterc_keluar', 'left')
			->where('m.id_persil', $id);
		$data = $this->db->get()->result_array();
		return $data;
	}

 	private function get_persil_by_nomor($nomor, $nomor_urut_bidang)
 	{
 		$id = $this->db->select('id')
 			->where('nomor', $nomor)
 			->where('nomor_urut_bidang', $nomor_urut_bidang)
 			->get('persil')->row()->id;
 		return $id;
 	}

	public function simpan_persil($post)
	{
		$data = array();
		$data['nomor'] = bilangan($post['no_persil']);
		$data['nomor_urut_bidang'] = bilangan($post['nomor_urut_bidang']);
		$data['kelas'] = $post['kelas'];
		$data['id_wilayah'] = $post['id_wilayah'] ?: NULL;
		$data['luas_persil'] = bilangan($post['luas_persil']) ?: NULL;
		$data['lokasi'] = $post['lokasi'] ?: NULL;
		$id_persil = $post['id_persil'] ?: $this->get_persil_by_nomor($post['no_persil'], $post['nomor_urut_bidang']);
		if ($id_persil)
		{
			$this->db->where('id', $id_persil)
				->update('persil', $data);
		}
		else
		{
			$data['letterc_awal'] = bilangan($post['letterc_awal']);
			$data['nomor'] = $post['no_persil'];
			$this->db->insert('persil', $data);
			$id_persil = 	$this->db->insert_id();
			$this->mutasi_awal($data, $id_persil);
		}
		return $id_persil;
 	}

	public function hapus($id)
	{
		$hasil = $this->db->where('id', $id)
			->delete('persil');
		status_sukses($hasil);
	}

	public function list_dusunrwrt()
	{
		$strSQL = "SELECT `id`,`rt`,`rw`,`dusun` FROM `tweb_wil_clusterdesa` WHERE (`rt`>0) ORDER BY `dusun`";
		$query = $this->db->query($strSQL);
		return $query->result_array();
	}

	public function list_persil_kelas($table='')
	{
		if ($table)
		{
			$data =$this->db->order_by('kode')
				->get_where('ref_persil_kelas', array('tipe' => $table))
				->result_array();
			$data = array_combine(array_column($data, 'id'), $data);
		}
		else
		{
			$data = $this->db->order_by('kode')
			->get('ref_persil_kelas')
			->result_array();
			$data = array_combine(array_column($data, 'id'), $data);
		}

		return $data;
	}

	public function awal_persil($letterc_awal, $id_persil, $hapus=false)
	{
		// Hapus mutasi awal kalau ada
		$this->db->where('id_persil', $id_persil)
			->where('jenis_mutasi', '9')
			->delete('mutasi_letterc');
		$letterc_awal = $hapus ? null : $letterc_awal; // Kosongkan pemilik awal persil ini
		$this->db->where('id', $id_persil)
			->set('letterc_awal', $letterc_awal)
			->update('persil');
		$persil = $this->db->where('id', $id_persil)
			->get('persil')->row_array();
		$this->mutasi_awal($persil, $id_persil);
	}

	private function mutasi_awal($data, $id_persil)
 	{
 		$mutasi['id_letterc_masuk'] = $data['letterc_awal'];
 		$mutasi['jenis_mutasi'] = '9';
 		$mutasi['tanggal_mutasi'] = date('Y-m-d H:i:s');
 		$mutasi['id_persil'] = $id_persil;
 		$mutasi['luas'] = $data['luas_persil'];
 		$mutasi['keterangan'] = 'Pemilik awal persil ini';
 		$this->db->insert('mutasi_letterc', $mutasi);
 	}

}
?>
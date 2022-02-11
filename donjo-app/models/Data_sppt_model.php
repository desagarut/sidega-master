<?php
class Data_sppt_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->model('pamong_model');
	}

	public function autocomplete($cari='')
	{
		$cari = $this->db->escape_like_str($cari);
		$sql_kolom = [];
		$list_kolom = [
			'nomor' => 'tbl_data_sppt',
			'nama_wp_luar' => 'tbl_data_sppt',
			'nama_wp' => 'tbl_data_sppt'
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
			->from('tbl_data_sppt c')
			->distinct()
			->join('tbl_sppt_penduduk cu', 'cu.id_sppt = c.id', 'left')
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


    public function rekapitulasi(){
        $query = $this->db->query("SELECT (SELECT count(*) FROM `tbl_data_sppt`) as jumlah_nop,
        (SELECT sum(pbb_terhutang) FROM `tbl_data_sppt`) as pbb_terhutang,
        (SELECT sum(total_tagih) FROM `tbl_data_sppt_tagih`) as total_tagih,
        (SELECT count(*) FROM `tbl_data_sppt_tagih`) as jml_kuitansi,
        (SELECT count(*) FROM `tbl_data_sppt_tagih` where status = 'Lunas') as lunas,
        (SELECT sum(pbb_terhutang) FROM `tbl_data_sppt_tagih` where status = 'Lunas') as pajak_lunas,
        (SELECT count(*) FROM `tbl_data_sppt_tagih` where status = 'Belum Bayar') as terhutang,
        (SELECT sum(pbb_terhutang) FROM `tbl_data_sppt_tagih` where status = 'Belum Bayar') as pajak_terhutang,
        (SELECT count(*) FROM `tbl_data_sppt_tagih` where status = 'Lunas')/(SELECT count(*) FROM `tbl_data_sppt_tagih`)*100 as presentase");

        return $query;
    }

    public function fetchSppt($limit, $start){
        $query = $this->db->query("SELECT * FROM tbl_data_sppt a
        ORDER BY a.id DESC
        LIMIT " . $start . ", " . $limit);

        return $query;
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
					->or_like('c.nama_wp', $cari)
					->or_like('c.nama_wp', $cari)
					->or_like('c.nomor', $cari)
				->group_end();
		}
	}


// Model SPPT
	private function main_sql_sppt_daftar()
	{
		$this->db->from('tbl_data_sppt c')
			->join('tbl_sppt_penduduk cu', 'cu.id_sppt = c.id', 'left')
			->join('tweb_penduduk u', 'u.id = cu.id_pend', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = u.id_cluster', 'left');
		$this->search_sql();
	}

	public function paging_data_sppt($p=1)
	{
		$this->main_sql_sppt_daftar();
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

	public function list_data_sppt($offset=0, $per_page='', $kecuali=[])
	{
		$kecuali = sql_in_list($kecuali);
		$data = [];
		$this->main_sql_sppt_daftar();
		$this->db
			->select('c.*, c.id as id_sppt, c.created_at as tanggal_daftar, cu.id_pend')
			->select('u.nik AS nik, u.nama as namatertagih, w.*')
			->select('(CASE WHEN c.jenis_wp = 1 THEN u.nama ELSE c.nama_wp_luar END) AS namatertagih')
			->select('(CASE WHEN c.jenis_wp = 1 THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE c.alamat_wp_luar END) AS alamat')
			->select('COUNT(DISTINCT c.id) AS jumlah')
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
			$j++;
		}
		return $data;
	}


	public function get_data_sppt($id)
	{
		$data = $this->db->where('c.id', $id)
			->select('c.*')
			->select('(CASE WHEN c.jenis_wp = 1 THEN u.nama ELSE c.nama_wp_luar END) AS namatertagih')
			->select('(CASE WHEN c.jenis_wp = 1 THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE c.alamat_wp_luar END) AS alamat')
			->from('tbl_data_sppt c')
			->join('tbl_sppt_penduduk cu', 'cu.id_sppt = c.id', 'left')
			->join('tweb_penduduk u', 'u.id = cu.id_pend', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = u.id_cluster', 'left')
			->limit(1)
			->get()
			->row_array();

		return $data;
	}

	public function simpan_sppt()
	{
		
		unset($_SESSION['success']);
		unset($_SESSION['error_msg']);

		
		$data = array();
		$data['nomor'] = bilangan_spasi($this->input->post('data_sppt'));
		$data['nama_wp'] = nama($this->input->post('nama_wp'));
		$data['jenis_wp'] = $this->input->post('jenis_wp');
		$data['nama_wp_luar'] = nama($this->input->post('nama_wp_luar'));
		$data['alamat_wp_luar'] = strip_tags($this->input->post('alamat_wp_luar'));
		$data['letak_op'] = strip_tags($this->input->post('letak_op'));
		$data['luas_tanah'] = bilangan($this->input->post('luas_tanah'));
		$data['pajak_tanah'] = $this->input->post('pajak_tanah');
		$data['kelas_tanah'] = $this->input->post('kelas_tanah');
		$data['total_pajak_tanah'] = $this->input->post('total_pajak_tanah');
		$data['luas_bangunan'] =$this->input->post('luas_bangunan');
		$data['pajak_bangunan'] = $this->input->post('pajak_bangunan');
		$data['kelas_bangunan'] = $this->input->post('kelas_bangunan');
		$data['total_pajak_bangunan'] = $this->input->post('total_pajak_bangunan');
		$data['dp_pbb'] = $this->input->post('dp_pbb');
		$data['njop_tkp'] = $this->input->post('njop_tkp');
		$data['njop_ppbb'] = $this->input->post('njop_ppbb');
		$data['pbb_terhutang'] = $this->input->post('pbb_terhutang');
		
		$data['id_wilayah'] = $this->input->post('id_wilayah');
		$data['lat'] = $this->input->post('lang');
		$data['lng'] = $this->input->post('lang');
		$data['tahun_awal'] = $this->input->post('tahun_awal');

		$data['ket'] = $this->input->post('ket');
		
		if ($id_sppt = $this->input->post('id'))
		{
			$data_lama = $this->db->where('id', $id_data_sppt)
				->get('tbl_data_sppt')->row_array();
			if ($data['nomor'] == $data_lama['nomor']) unset($data['nomor']);
			if ($data['nama_wp'] == $data_lama['nama_wp']) unset($data['nama_wp']);
			
			$data['letak_op'] = $this->input->post('letak_op');
			$data['updated_by'] = $this->session->user;
			$this->db->where('id', $id_sppt)
				->update('tbl_data_sppt', $data);
		}
		else
		{
			$data['created_by'] = $this->session->user;
			$data['updated_by'] = $this->session->user;
			$this->db->insert('tbl_data_sppt', $data);
			$id_sppt = $this->db->insert_id();
		}

		if ($this->input->post('jenis_wp') == 1)
		{
			$this->simpan_wp($id_sppt, $this->input->post('id_pend'));
		}
		else
		{
			$this->hapus_wp($id_sppt);
		}
		return $id_sppt;
	}

// Start Model Tagihan

	public function autocomplete_tagih($cari_tagih='')
	{
		$cari_tagih = $this->db->escape_like_str($cari_tagih);
		$sql_kolom = [];
		$list_kolom = [
			'tahun_tagih' => 'tbl_data_sppt_tagih',
			'nomor' => 'tbl_data_sppt_tagih',
			'nama_wp' => 'tbl_data_sppt_tagih'
		];
		foreach ($list_kolom as $kolom => $tabel)
		{
			$this->db->select($kolom.' as item')
				->distinct()->from($tabel)
				->order_by('item');
			if ($cari_tagih) $this->db->like($kolom, $cari_tagih);
			$sql_kolom[] = $this->db->get_compiled_select();
		}
		$this->db->select('tahun_tagih, nomor, nama_wp as item')
			->from('tbl_data_sppt_tagih m')
			->distinct()
			->order_by('item');
			if ($cari_tagih) $this->db->like('m.tahun_tagih','m.nomor','m.nama_wp', $cari_tagih);
			$sql_kolom[] = $this->db->get_compiled_select();;
		$sql = '('.implode(') UNION (', $sql_kolom).')';

		$query = $this->db->query($sql);
		$data = $query->result_array();

		$str = autocomplete_data_ke_str($data);
		return $str;
	}
	

	private function search_sql_tagih()
	{
		if ($this->session->cari_tagih)
		{
			$cari_tagih = $this->session->cari_tagih;
			$cari_tagih = $this->db->escape_like_str($cari_tagih);
			$this->db
				->group_start()
					->like('m.nama_wp', $cari_tagih)
					->or_like('m.tahun_tagih', $cari_tagih)
					->or_like('m.nomor', $cari_tagih)
				->group_end();
		}
	}

	private function main_sql_tagih()
	{
		$this->db->from('tbl_data_sppt_tagih m')
			->join('tbl_data_sppt cu', 'cu.id = m.id_tagih', 'left');
		$this->search_sql_tagih();
	}
	
	public function paging_data_tagihan($m=1)
	{
		$this->main_sql_tagih();
		$jml_data = $this->db
			->select('COUNT(DISTINCT m.id_tagih) AS jml')
			->get()
			->row()
			->jml;

		$this->load->library('paging');
		$cfg['page'] = $m;
		$cfg['per_page'] = $_SESSION['per_page'];
		$cfg['num_rows'] = $jml_data;
		$this->paging->init($cfg);

		return $this->paging;
	}

	public function list_tagihan($offset=0, $per_page='', $kecuali=[])
	{
		$kecuali = sql_in_list($kecuali);
		$data = [];
		$this->main_sql_tagih();
		$this->db
			->select('m.*, m.id_tagih as id, m.created_at as tanggal_daftar, cu.id')
			->order_by('cast(m.id_tagih as unsigned)')
			->group_by('m.id_tagih, cu.id');
		if ($per_page) $this->db->limit($per_page, $offset);
  	if ($kecuali)	$this->db->where("m.id_tagih not in ($kecuali)");
		$data = $this->db
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
	
	public function get_data_tagih($id)
	{
		$data = $this->db->where('m.id_tagih', $id)
			->select('m.*')
			->from('tbl_data_sppt_tagih m')
			->limit(1)
			->get()
			->row_array();

		return $data;
	}
	
	public function simpan_tagihan()
	{
		$data = array();
		$data['nomor'] = $this->input->post('nomor');
		$data['nama_wp'] = $this->input->post('nama_wp');
		$data['letak_op'] = $this->input->post('letak_op');
		$data['tahun_tagih'] = $this->input->post('tahun_tagih');
		$data['pbb_terhutang'] = $this->input->post('pbb_terhutang');
		$data['denda'] = $this->input->post('denda');
		$data['iuran'] = $this->input->post('iuran');
		$data['total_tagih'] = $this->input->post('total_tagih');
		$data['status'] = $this->input->post('status');
		
		if ($id_tagih = $this->input->post('id_tagih'))
		{
			$data_lama = $this->db->where('id_tagih', $id_tagih)
				->get('tbl_data_sppt_tagih')->row_array();
			if ($data['id_tagih'] == $data_lama['id_tagih']) unset($data['id_tagih']);
			if ($data['nomor'] == $data_lama['nomor']) unset($data['nomor']);
			if ($data['nama_wp'] == $data_lama['nama_wp']) unset($data['nama_wp']);
			if ($data['letak_op'] == $data_lama['letak_op']) unset($data['letak_op']);
			
			$data['updated_by'] = $this->session->user;
			$this->db->where('id_tagih', $id_tagih)
				->update('tbl_data_sppt_tagih', $data);
		}
		else
		{
			$data['created_by'] = $this->session->user;
			$data['updated_by'] = $this->session->user;
			$this->db->insert('tbl_data_sppt_tagih', $data);
			$id_tagih = $this->db->insert_id();
		}

		return $id_sppt;
	}
	
	public function update_tagihan()
	{
		$data = array();
		$data['tahun_tagih'] = $this->input->post('tahun_tagih');
		$data['pbb_terhutang'] = $this->input->post('pbb_terhutang');
		$data['denda'] = $this->input->post('denda');
		$data['iuran'] = $this->input->post('iuran');
		$data['total_tagih'] = $this->input->post('total_tagih');
		
		if ($id_tagih = $this->input->post('id_tagih'))
		{
			$data_lama = $this->db->where('id_tagih', $id_tagih)
				->get('tbl_data_sppt_tagih')->row_array();
			if ($data['id_tagih'] == $data_lama['id_tagih']) unset($data['id_tagih']);
			if ($data['nomor'] == $data_lama['nomor']) unset($data['nomor']);
			if ($data['nama_wp'] == $data_lama['nama_wp']) unset($data['nama_wp']);
			if ($data['letak_op'] == $data_lama['letak_op']) unset($data['letak_op']);
			
			$data['updated_by'] = $this->session->user;
			$this->db->where('id_tagih', $id_tagih)
				->update('tbl_data_sppt_tagih', $data);
		}
		else
		{
			$data['created_by'] = $this->session->user;
			$data['updated_by'] = $this->session->user;
			$this->db->insert('tbl_data_sppt_tagih', $data);
			$id_tagih = $this->db->insert_id();
		}
		
		return $id_sppt;
	}
	
	public function update_tagihan_bayar()
	{
		$data = array();
		$data['tahun_tagih'] = $this->input->post('tahun_tagih');
		$data['status'] = $this->input->post('status');
		$data['tgl_bayar'] = $this->input->post('tgl_bayar');

		if ($id_tagih = $this->input->post('id_tagih'))
		{
			$data_lama = $this->db->where('id_tagih', $id_tagih)
				->get('tbl_data_sppt_tagih')->row_array();
			if ($data['id_tagih'] == $data_lama['id_tagih']) unset($data['id_tagih']);
			if ($data['nomor'] == $data_lama['nomor']) unset($data['nomor']);
			if ($data['nama_wp'] == $data_lama['nama_wp']) unset($data['nama_wp']);
			if ($data['letak_op'] == $data_lama['letak_op']) unset($data['letak_op']);
			
			$data['updated_by'] = $this->session->user;
			$this->db->where('id_tagih', $id_tagih)
				->update('tbl_data_sppt_tagih', $data);
		}
		else
		{
			$data['created_by'] = $this->session->user;
			$data['updated_by'] = $this->session->user;
			$this->db->insert('tbl_data_sppt_tagih', $data);
			$id_tagih = $this->db->insert_id();
		}
		
		return $id_sppt;
	}
	
	public function hapus_tagih($id)
	{
		$this->db->where('id_tagih', $id);
		$this->db->delete('tbl_data_sppt_tagih');
	}
	
	public function daftar_tagihan($limit, $start){
        $query = $this->db->get('tbl_data_sppt_tagih', $limit, $start);
        return $query;
    }	

// End Model Tagihan

// Start Model Pembayaran

	public function autocomplete_bayar($cari_bayar='')
	{
		$cari_bayar = $this->db->escape_like_str($cari_bayar);
		$sql_kolom = [];
		$list_kolom = [
			'tgl_bayar' => 'tbl_data_sppt_bayar',
			'id_bayar' => 'tbl_data_sppt_bayar',
			'nomor' => 'tbl_data_sppt_bayar',
			'nama_wp' => 'tbl_data_sppt_bayar'
		];
		foreach ($list_kolom as $kolom => $tabel)
		{
			$this->db->select($kolom.' as item')
				->distinct()->from($tabel)
				->order_by('item');
			if ($cari_bayar) $this->db->like($kolom, $cari_bayar);
			$sql_kolom[] = $this->db->get_compiled_select();
		}
		$this->db->select('tahun_tagih as item')
			->from('tbl_data_sppt_tagih m')
			->distinct()
			//->join('tbl_sppt_penduduk cu', 'cu.id_sppt = m.id_tagih', 'left')
			//->join('tweb_penduduk u', 'u.id = cu.id_pend', 'left')
			->order_by('item');
			if ($cari_tagih) $this->db->like('m.tahun_tagih', $cari_tagih);
			$sql_kolom[] = $this->db->get_compiled_select();;
		$sql = '('.implode(') UNION (', $sql_kolom).')';

		$query = $this->db->query($sql);
		$data = $query->result_array();

		$str = autocomplete_data_ke_str($data);
		return $str;
	}
	
	private function search_sql_bayar()
	{
		if ($this->session->cari_bayar)
		{
			$cari_bayar = $this->session->cari_bayar;
			$cari_bayar = $this->db->escape_like_str($cari_bayar);
			$this->db
				->group_start()
					->like('m.tahun_tagih', $cari_bayar)
					->or_like('cu.nama_wp', $cari_bayar)
					->or_like('cu.nomor', $cari_bayar)
				->group_end();
		}
	}

	private function main_sql_bayar()
	{
		$this->db->from('tbl_data_sppt_bayar b')
			->join('tbl_data_sppt_tagih cu', 'cu.id_tagih = b.id_bayar', 'left');
		$this->search_sql();
	}

	public function paging_bayar($p=1)
	{
		$this->main_sql_bayar();
		$jml_data = $this->db
			->select('COUNT(DISTINCT b.id_bayar) AS jml')
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

	
	public function list_pembayaran($offset=0, $per_page='', $kecuali=[])
	{
		$kecuali = sql_in_list($kecuali);
		$data = [];
		$this->main_sql_bayar();
		$this->db
			->select('b.*, b.id_bayar as id, b.created_at as tgl_bayar, cu.id_tagih')
			->order_by('cast(b.id_bayar as unsigned)')
			->group_by('b.id_bayar, cu.id_tagih');
		if ($per_page) $this->db->limit($per_page, $offset);
  	if ($kecuali)	$this->db->where("b.id_bayar not in ($kecuali)");
		$data = $this->db
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
	
	public function get_data_bayar($id)
	{
		$data = $this->db->where('m.id_bayar', $id)
			->select('m.*')
			->from('tbl_data_sppt_bayar m')
			->limit(1)
			->get()
			->row_array();

		return $data;
	}
	
	public function simpan_pembayaran()
	{
		$data = array();
//		$data['id_sppt'] = $this->input->post('id_sppt');
		$data['nomor'] = $this->input->post('nomor');
		$data['nama_wp'] = $this->input->post('nama_wp');
		$data['letak_op'] = $this->input->post('letak_op');
		$data['tahun_tagih'] = $this->input->post('tahun_tagih');
		$data['pbb_terhutang'] = $this->input->post('pbb_terhutang');
		$data['denda'] = $this->input->post('denda');
		$data['iuran'] = $this->input->post('iuran');
		$data['total_bayar'] = $this->input->post('total_bayar');
		$data['ket'] = $this->input->post('ket');
		$data['tgl_bayar'] = $this->input->post('tgl_bayar');
		
			$data['created_by'] = $this->session->user;
			$data['updated_by'] = $this->session->user;
			$this->db->insert('tbl_data_sppt_bayar', $data);
			$id_tagih = $this->db->insert_id();

		
/*		if ($id_bayar = $this->input->post('id_bayar'))
		{
			$data_lama = $this->db->where('id_bayar', $id_bayar)
				->get('tbl_data_sppt_bayar')->row_array();
			if ($data['id_bayar'] == $data_lama['id_bayar']) unset($data['id_bayar']);
			//if ($data['tahun_tagih'] == $data_lama['tahun_tagih']) unset($data['tahun_tagih']);
			if ($data['nomor'] == $data_lama['nomor']) unset($data['nomor']);
			if ($data['nama_wp'] == $data_lama['nama_wp']) unset($data['nama_wp']);
			if ($data['letak_op'] == $data_lama['letak_op']) unset($data['letak_op']);
			
			$data['updated_by'] = $this->session->user;
			$data['updated_at'] = $this->session->user;
			$this->db->where('id_bayar', $id_bayar)
				->update('tbl_data_sppt_bayar', $data);
		}
		else
		{
			$data['created_by'] = $this->session->user;
			$data['updated_by'] = $this->session->user;
			$this->db->insert('tbl_data_sppt_bayar', $data);
			$id_tagih = $this->db->insert_id();
		}
*/

		return $id_sppt;
	}
		public function update_pembayaran()
	{
		$data = array();
		$data['tahun_tagih'] = $this->input->post('tahun_tagih');
		$data['pbb_terhutang'] = $this->input->post('pbb_terhutang');
		$data['denda'] = $this->input->post('denda');
		$data['iuran'] = $this->input->post('iuran');
		$data['total_bayar'] = $this->input->post('total_bayar');
		$data['tgl_bayar'] = $this->input->post('tgl_bayar');
		
		if ($id_bayar = $this->input->post('id_bayar'))
		{
			$data_lama = $this->db->where('id_tagih', $id_tagih)
				->get('tbl_data_sppt_bayar')->row_array();
			if ($data['id_bayar'] == $data_lama['id_bayar']) unset($data['id_bayar']);
			if ($data['nomor'] == $data_lama['nomor']) unset($data['nomor']);
			if ($data['nama_wp'] == $data_lama['nama_wp']) unset($data['nama_wp']);
			if ($data['letak_op'] == $data_lama['letak_op']) unset($data['letak_op']);
			
			$data['updated_by'] = $this->session->user;
			$this->db->where('id_bayar', $id_bayar)
				->update('tbl_data_sppt_bayar', $data);
		}
		else
		{
			$data['created_by'] = $this->session->user;
			$data['updated_by'] = $this->session->user;
			$this->db->insert('tbl_data_sppt_bayar', $data);
			$id_tagih = $this->db->insert_id();
		}
		
		return $id_sppt;
	}
	
	public function hapus_bayar($id)
	{
		$this->db->where('id_bayar', $id);
		$this->db->delete('tbl_data_sppt_bayar');
	}
	
	public function paging_data_bayar($p=1)
	{
		$this->main_sql_bayar();
		$jml_data = $this->db
			->select('COUNT(*) AS jml')
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


// End model Pembayaran 


	private function hapus_wp($id_sppt)
	{
		$this->db->where('id_sppt', $id_sppt)
			->delete('tbl_sppt_penduduk');
	}

	private function simpan_wp($id_sppt, $id_pend)
	{
		// Hapus Wajib Pajak lama
		$this->hapus_wp($id_sppt);
		// Tambahkan Wajib Pajak baru
		$data = array();
		$data['id_sppt'] = $id_sppt;
		$data['id_pend'] = $id_pend;
		$this->db->insert('tbl_sppt_penduduk', $data);
	}

	public function hapus_sppt($id)
	{
		$outp = $this->db->where('id', $id)
			->delete('tbl_data_sppt');
		status_sukses($outp);
	}

	public function get_wajib_pajak($id_sppt)
	{
		$this->db->select('p.id, p.nik, p.nama, k.no_kk, w.rt, w.rw, w.dusun')
			->select('(CASE WHEN c.jenis_wp = 1 THEN p.nama ELSE c.nama_wp_luar END) AS namatertagih')
			->select('(CASE WHEN c.jenis_wp = 1 THEN CONCAT("RT ", w.rt, " / RW ", w.rw, " - ", w.dusun) ELSE c.alamat_wp_luar END) AS alamat')
			->from('tbl_data_sppt c')
			->join('tbl_sppt_penduduk cp', 'c.id = cp.id_sppt', 'left')
			->join('tweb_penduduk p', 'p.id = cp.id_pend', 'left')
			->join('tweb_keluarga k','k.id = p.id_kk', 'left')
			->join('tweb_wil_clusterdesa w', 'w.id = p.id_cluster', 'left')
			->where('c.id', $id_sppt);
		$data = $this->db->get()->row_array();

		return $data;
	}


	// TODO: ganti ke impor cdesa
	public function impor_sppt()
	{
		$this->load->library('Spreadsheet_Excel_Reader');
		$data = new Spreadsheet_Excel_Reader($_FILES['sppt']['tmp_name']);

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
			//$upd['persil_jenis_id'] = $data->val($i, 4, $sheet);
			$upd['id_clusterdesa'] = $data->val($i, 5, $sheet);
			$upd['luas'] = $data->val($i, 6, $sheet);
			$upd['kelas'] = $data->val($i, 7, $sheet);
			$upd['nomor'] = $data->val($i, 8, $sheet);
			//$upd['persil_peruntukan_id'] = $data->val($i, 9, $sheet);
			$outp = $this->db->insert('data_sppt',$upd);
		}

		status_sukses($outp); //Tampilkan Pesan
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

	public function get_lokasi($id=0)
	{
		$data = $this->db->where('id', $id)
			->get('tbl_data_sppt')->row_array();
		return $data;
	}

	public function update_position($id=0)
	{
		$data['lat'] = koordinat($this->input->post('lat'));
		$data['lng'] = koordinat($this->input->post('lng'));
		$this->db->where('id', $id);
		$outp = $this->db->update('tbl_data_sppt', $data);

		status_sukses($outp); //Tampilkan Pesan
	}
	
	public function list_lokasi()
	{
		$data = $this->db
			->select('l.*, p.nama AS kategori, m.nama AS jenis, p.simbol AS simbol')
			->from('tbl_data_sppt l')
			->join('point p', 'l.ref_point = p.id', 'left')
			->join('point m', 'p.parrent = m.id', 'left')
			->where('l.enabled = 1')
			->where('p.enabled = 1')
			->where('m.enabled = 1')
			->get()->result_array();
		return $data;
	}
	
    public function laporan(){
        $query = $this->db->query("SELECT (SELECT count(*) FROM `tbl_data_sppt`) as jumlah_nop,
        (SELECT sum(pbb_terhutang) FROM `tbl_data_sppt`) as pbb_terhutang,
        (SELECT count(*) FROM `tbl_data_sppt_tagih` where status = 'Lunas') as lunas,
        (SELECT sum(pbb_terhutang) FROM `tbl_data_sppt_tagih` where status = 'Lunas') as pajak_lunas,
        (SELECT count(*) FROM `tbl_data_sppt_tagih` where status = 'Belum Bayar') as terhutang,
        (SELECT sum(pbb_terhutang) FROM `tbl_data_sppt_tagih` where status = 'Belum Bayar') as pajak_terhutang,
        (SELECT count(*) FROM `tbl_data_sppt_tagih` where status = 'Lunas')/(SELECT count(*) FROM `tbl_data_sppt_tagih`)*100 as presentase,
        (SELECT count(tahun_tagih) FROM `tbl_data_sppt_tagih` where status = 'Lunas') as jml_blm_bayar");

        return $query;
    }
	
}

?>
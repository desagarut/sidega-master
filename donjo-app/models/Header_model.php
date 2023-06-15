<?php

class Header_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('config_model');
	}

	// Data penduduk yang digunakan untuk ditampilkan di Widget halaman dashbord (Home SID)
	public function penduduk_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function keluarga_total()
	{
		$data = $this->db->select('COUNT(*) AS jumlah')
			->from('tweb_keluarga u')
			->join('tweb_penduduk t', 'u.nik_kepala = t.id', 'left')
			->where('t.status_dasar', '1')
			->where('t.kk_level', '1')
			->get()->result_array();
		return $data;
	}

	public function bantuan_total()
	{
		$jml_program = $this->db->select('COUNT(id) as jml')
			->get('program')
			->row()->jml;
		if (empty($jml_program))
		{
			$data['jumlah'] = 0;
			$data['nama'] = 'Bantuan';
			$data['link_detail'] = 'program_bantuan';
			return $data;
		}

		if (empty($this->setting->dashboard_program_bantuan))
			$this->setting->dashboard_program_bantuan = 1;
		$data = $this->db->select('COUNT(pp.id) AS jumlah')
			->select('nama')
			->from('program p')
			->join('program_peserta pp', 'p.id = pp.program_id', 'left')
			->where('p.id', $this->setting->dashboard_program_bantuan)
			->get()
			->row_array();
		$data['link_detail'] = 'statistik/clear/50'.$this->setting->dashboard_program_bantuan;
		return $data;
	}

	public function kelompok_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM kelompok";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function rtm_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE rtm_level = 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function dusun_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM tweb_wil_clusterdesa WHERE rt = '0' AND rw = '0' ";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	// ---
	public function get_data()
	{
	/*
	 * global variabel
	 * */
		$outp["sasaran"] = array("1"=>"Penduduk", "2"=>"Keluarga / KK", "3"=>"Rumah Tangga", "4"=>"Kelompok/Organisasi Kemasyarakatan");

		/*
		 * Pembenahan per 13 Juli 15, sebelumnya ada notifikasi Error, saat $_SESSOIN['user'] nya kosong!
		 * */
		$id = @$_SESSION['user'];
		$sql = "SELECT nama,foto FROM user WHERE id = ?";
		$query = $this->db->query($sql, $id);
		if ($query)
		{
			if ($query->num_rows() > 0)
			{
				$data  = $query->row_array();
				$outp['nama'] = $data['nama'];
				$outp['foto'] = $data['foto'];
			}
		}

		$outp['desa'] = $this->config_model->get_data();

		$sql = "SELECT COUNT(id) AS jml FROM komentar WHERE id_artikel = 775 AND status = 2;";
		$query = $this->db->query($sql);
		$lap = $query->row_array();
		$outp['lapor'] = $lap['jml'];

		$this->load->model('modul_model');
		$outp['modul'] = $this->modul_model->list_aktif();

		return $outp;
	}

	public function rkpdes_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM tbl_perencanaan_desa WHERE status = 1 and status_rkpdes = 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function durkpdes_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM tbl_perencanaan_desa WHERE status = 1 and status_rkpdes = 0";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	
	public function letterc_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM letterc";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function letterc_warga_total()
	{
		$sql = "SELECT COUNT(id) AS letterc_warga FROM letterc WHERE jenis_pemilik = 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function letterc_nonwarga_total()
	{
		$sql = "SELECT COUNT(id) AS letterc_non FROM letterc WHERE jenis_pemilik = 2";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function persil_total()
	{
		$sql = "SELECT COUNT(id) AS jumlah FROM persil";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

    public function rekap_ktp(){
        $query = $this->db->query("SELECT (SELECT count(ktp_el) FROM `tweb_penduduk` WHERE ktp_el = 1 AND status_dasar = 1) as ktp_el_ya,
        (SELECT count(ktp_el) FROM `tweb_penduduk` WHERE ktp_el = 2 AND status_dasar = 1) as ktp_el_no,
		(SELECT count(*) FROM `tweb_penduduk` where ktp_el = 1 AND status_dasar = 1)/(SELECT count(*) FROM `tweb_penduduk` WHERE status_dasar = 1)*100 as persentase_ktp_el,
		(SELECT count(*) FROM `tweb_penduduk` where status_dasar = 1) as penduduk_total,
        (SELECT count(*) FROM `tweb_penduduk`where foto <> '' and status_dasar = 1) as foto_y,
		(SELECT count(*) FROM `tweb_penduduk`where foto = '' and status_dasar = 1) as foto_n,
		(SELECT count(*) FROM `tweb_penduduk` where foto <> '' and status_dasar = 1)/(SELECT count(*) FROM `tweb_penduduk` WHERE foto = '' and status_dasar = 1)*100 as persentase_foto,
        (SELECT count(*) FROM `rumah`) as rumah_y,
		(SELECT count(*) FROM `rumah`)/(SELECT count(*) FROM `tweb_penduduk` WHERE status_dasar = 1)*100 as persentase_rumah,
        (SELECT count(*) FROM `tweb_penduduk_map`) as lokasi_y,
		(SELECT count(*) FROM `tweb_penduduk_map`)/(SELECT count(*) FROM `tweb_penduduk` WHERE status_dasar = 1)*100 as persentase_lokasi,

		(SELECT count(*) FROM `tbl_data_sppt`) as jumlah_nop,
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

}

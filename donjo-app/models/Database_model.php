<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Database_model extends CI_Model {

	private $user = 1;

	private $engine = 'InnoDB';
	/* define versi sidega dan script migrasi yang harus dijalankan */
	private $versionMigrate = array(
	);

	public function __construct()
	{
		parent::__construct();

		$this->load->dbutil();
		if( ! $this->dbutil->database_exists($this->db->database)) return;

		$this->cek_engine_db();
		$this->load->dbforge();
		$this->load->model('surat_master_model');
		$this->load->model('analisis_import_model');
		$this->user = $this->session_user ?: 1;
	}

	private function cek_engine_db()
	{
		$this->db->db_debug = FALSE; //disable debugging for queries

			$query = $this->db->query("SELECT `engine` FROM INFORMATION_SCHEMA.TABLES WHERE table_schema= '". $this->db->database ."' AND table_name = 'user'");
			$error = $this->db->error();
			if ($error['code'] != 0)
			{
				$this->engine = $query->row()->engine;
			}

		$this->db->db_debug = $db_debug; //restore setting
	}

	private function reset_setting_aplikasi()
	{
		$this->db->truncate('setting_aplikasi');
		$query = "
			INSERT INTO setting_aplikasi (`id`, `key`, `value`, `keterangan`, `jenis`,`kategori`) VALUES
			(1, 'sebutan_kabupaten','kabupaten','Pengganti sebutan wilayah kabupaten','',''),
			(2, 'sebutan_kabupaten_singkat','kab.','Pengganti sebutan singkatan wilayah kabupaten','',''),
			(3, 'sebutan_kecamatan','kecamatan','Pengganti sebutan wilayah kecamatan','',''),
			(4, 'sebutan_kecamatan_singkat','kec.','Pengganti sebutan singkatan wilayah kecamatan','',''),
			(5, 'sebutan_desa','desa','Pengganti sebutan wilayah desa','',''),
			(6, 'sebutan_dusun','dusun','Pengganti sebutan wilayah dusun','',''),
			(7, 'sebutan_camat','camat','Pengganti sebutan jabatan camat','',''),
			(8, 'website_title','Website Resmi','Judul tab browser modul web','','web'),
			(9, 'login_title','SIDeGa', 'Judul tab browser halaman login modul administrasi','',''),
			(10, 'admin_title','Sistem Informasi Desa','Judul tab browser modul administrasi','',''),
			(11, 'web_theme', 'default','Tema penampilan modul web','','web'),
			(12, 'offline_mode',FALSE,'Apakah modul web akan ditampilkan atau tidak','boolean',''),
			(13, 'enable_track',TRUE,'Apakah akan mengirimkan data statistik ke tracker','boolean',''),
			(14, 'dev_tracker','','Host untuk tracker pada development','','development'),
			(15, 'nomor_terakhir_semua_surat', FALSE,'Gunakan nomor surat terakhir untuk seluruh surat tidak per jenis surat','boolean',''),
			(16, 'google_key','','Google API Key untuk Google Maps','','web'),
			(17, 'libreoffice_path','','Path tempat instal libreoffice di server SID','','')
		";
		$this->db->query($query);
	}


  private function catat_versi_database()
  {
		// Catat migrasi ini telah dilakukan
		$sudah = $this->db->where('versi_database', VERSI_DATABASE)
			->get('migrasi')->num_rows();
		if (!$sudah) $this->db->insert('migrasi', array('versi_database' => VERSI_DATABASE));
  }

  private function getCurrentVersion()
  {
		// Untuk kasus tabel setting_aplikasi belum ada
		if (!$this->db->table_exists('setting_aplikasi')) return NULL;
		$result = NULL;
		$_result = $this->db->where(array('key' => 'current_version'))->get('setting_aplikasi')->row();
		if (!empty($_result))
		{
		  $result = $_result->value;
		}
		return $result;
  }

  private function nop()
  {
  	// Tidak lakukan apa-apa
  }

  private function versi_database_terbaru()
  {
		$sudah = false;
		if ($this->db->table_exists('migrasi') )
			$sudah = $this->db->where('versi_database', VERSI_DATABASE)
				->get('migrasi')->num_rows();
		return $sudah;
  }

	// Cek apakah migrasi perlu dijalankan
	public function cek_migrasi()
	{
		// Paksa menjalankan migrasi kalau belum
		// Migrasi direkam di tabel migrasi
		if ( ! $this->versi_database_terbaru())
		{
			// Ulangi migrasi terakhir
			$terakhir = key(array_slice($this->versionMigrate, -1, 1, true));
			$sebelumnya = key(array_slice($this->versionMigrate, -2, 1, true));
			$this->versionMigrate[$terakhir]['migrate'] ?: $this->versionMigrate[$terakhir]['migrate'] = $this->versionMigrate[$sebelumnya]['migrate'];
			$this->migrasi_db_cri();
		}
	}




  private function jalankan_migrasi($migrasi)
  {
  	$this->load->model('migrations/'.$migrasi);
  	$this->$migrasi->up();
  }

  public function get_views()
	{
		$db = $this->db->database;
		$sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'VIEW' AND TABLE_SCHEMA = '$db'";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return array_column($data, 'TABLE_NAME');
	}

}

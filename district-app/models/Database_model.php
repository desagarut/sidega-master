<?php defined('BASEPATH') || exit('No direct script access allowed');

class Database_model extends MY_Model
{
    private $user   = 1;
    private $engine = 'InnoDB';

    // define versi opensid dan script migrasi yang harus dijalankan
    private $versionMigrate = [
        '2.4'     => ['migrate' => 'migrasi_24_ke_25', 'nextVersion' => '2.5'],
        'pra-2.5' => ['migrate' => 'migrasi_24_ke_25', 'nextVersion' => '2.5'],
        '2.5'     => ['migrate' => 'migrasi_25_ke_26', 'nextVersion' => '2.6'],
        '2.6'     => ['migrate' => 'migrasi_26_ke_27', 'nextVersion' => '2.7'],
        '2.7'     => ['migrate' => 'migrasi_27_ke_28', 'nextVersion' => '2.8'],
        '2.8'     => ['migrate' => 'migrasi_28_ke_29', 'nextVersion' => '2.9'],
        '2.9'     => ['migrate' => 'migrasi_29_ke_210', 'nextVersion' => '2.10'],
        '2.10'    => ['migrate' => 'migrasi_210_ke_211', 'nextVersion' => '2.11'],
        '2.11'    => ['migrate' => 'migrasi_211_ke_1806', 'nextVersion' => '18.06'],
        '2.12'    => ['migrate' => 'migrasi_211_ke_1806', 'nextVersion' => '18.06'],
        '18.06'   => ['migrate' => 'migrasi_1806_ke_1807', 'nextVersion' => '18.08'],
        '18.07'   => ['migrate' => 'migrasi_1806_ke_1807', 'nextVersion' => '18.08'],
        '18.08'   => ['migrate' => 'migrasi_1808_ke_1809', 'nextVersion' => '18.09'],
        '18.09'   => ['migrate' => 'migrasi_1809_ke_1810', 'nextVersion' => '18.10'],
        '18.10'   => ['migrate' => 'migrasi_1810_ke_1811', 'nextVersion' => '18.11'],
        '18.11'   => ['migrate' => 'migrasi_1811_ke_1812', 'nextVersion' => '18.12'],
        '18.12'   => ['migrate' => 'migrasi_1812_ke_1901', 'nextVersion' => '19.01'],
        '19.01'   => ['migrate' => 'migrasi_1901_ke_1902', 'nextVersion' => '19.02'],
        '19.02'   => ['migrate' => 'nop', 'nextVersion' => '19.03'],
        '19.03'   => ['migrate' => 'migrasi_1903_ke_1904', 'nextVersion' => '19.04'],
        '19.04'   => ['migrate' => 'migrasi_1904_ke_1905', 'nextVersion' => '19.05'],
        '19.05'   => ['migrate' => 'migrasi_1905_ke_1906', 'nextVersion' => '19.06'],
        '19.06'   => ['migrate' => 'migrasi_1906_ke_1907', 'nextVersion' => '19.07'],
        '19.07'   => ['migrate' => 'migrasi_1907_ke_1908', 'nextVersion' => '19.08'],
        '19.08'   => ['migrate' => 'migrasi_1908_ke_1909', 'nextVersion' => '19.09'],
        '19.09'   => ['migrate' => 'migrasi_1909_ke_1910', 'nextVersion' => '19.10'],
        '19.10'   => ['migrate' => 'migrasi_1910_ke_1911', 'nextVersion' => '19.11'],
        '19.11'   => ['migrate' => 'migrasi_1911_ke_1912', 'nextVersion' => '19.12'],
        '19.12'   => ['migrate' => 'migrasi_1912_ke_2001', 'nextVersion' => '20.01'],
        '20.01'   => ['migrate' => 'migrasi_2001_ke_2002', 'nextVersion' => '20.02'],
        '20.02'   => ['migrate' => 'migrasi_2002_ke_2003', 'nextVersion' => '20.03'],
        '20.03'   => ['migrate' => 'migrasi_2003_ke_2004', 'nextVersion' => '20.04'],
        '20.04'   => ['migrate' => 'migrasi_2004_ke_2005', 'nextVersion' => '20.05'],
        '20.05'   => ['migrate' => 'migrasi_2005_ke_2006', 'nextVersion' => '20.06'],
        '20.06'   => ['migrate' => 'migrasi_2006_ke_2007', 'nextVersion' => '20.07'],
        '20.07'   => ['migrate' => 'migrasi_2007_ke_2008', 'nextVersion' => '20.08'],
        '20.08'   => ['migrate' => 'migrasi_2008_ke_2009', 'nextVersion' => '20.09'],
        '20.09'   => ['migrate' => 'migrasi_2009_ke_2010', 'nextVersion' => '20.10'],
        '20.10'   => ['migrate' => 'migrasi_2010_ke_2011', 'nextVersion' => '20.11'],
        '20.11'   => ['migrate' => 'migrasi_2011_ke_2012', 'nextVersion' => '20.12'],
        '20.12'   => ['migrate' => 'migrasi_2012_ke_2101', 'nextVersion' => '21.01'],
        '21.01'   => ['migrate' => 'migrasi_2101_ke_2102', 'nextVersion' => '21.02'],
        '21.02'   => ['migrate' => 'migrasi_2102_ke_2103', 'nextVersion' => '21.03'],
        '21.03'   => ['migrate' => 'migrasi_2103_ke_2104', 'nextVersion' => '21.04'],
        '21.04'   => ['migrate' => 'migrasi_2104_ke_2105', 'nextVersion' => '21.05'],
        '21.05'   => ['migrate' => 'migrasi_2105_ke_2106', 'nextVersion' => '21.06'],
        '21.06'   => ['migrate' => 'migrasi_2106_ke_2107', 'nextVersion' => '21.07'],
        '21.07'   => ['migrate' => 'migrasi_2107_ke_2108', 'nextVersion' => '21.08'],
        '21.08'   => ['migrate' => 'migrasi_2108_ke_2109', 'nextVersion' => '21.09'],
        '21.09'   => ['migrate' => 'migrasi_2109_ke_2110', 'nextVersion' => '21.10'],
        '21.10'   => ['migrate' => 'migrasi_2110_ke_2111', 'nextVersion' => '21.11'],
        '21.11'   => ['migrate' => 'migrasi_2111_ke_2112', 'nextVersion' => '21.12'],
        '21.12'   => ['migrate' => 'migrasi_2112_ke_2201', 'nextVersion' => '22.01'],
        '22.01'   => ['migrate' => 'migrasi_2201_ke_2202', 'nextVersion' => '22.02'],
        '22.02'   => ['migrate' => 'migrasi_2202_ke_2203', 'nextVersion' => '22.03'],
        '22.03'   => ['migrate' => 'migrasi_2203_ke_2204', 'nextVersion' => '22.04'],
        '22.04'   => ['migrate' => 'migrasi_2204_ke_2205', 'nextVersion' => '22.05'],
        '22.05'   => ['migrate' => 'migrasi_2205_ke_2206', 'nextVersion' => '22.06'],
        '22.06'   => ['migrate' => 'migrasi_2206_ke_2207', 'nextVersion' => '22.07'],
        '22.07'   => ['migrate' => 'migrasi_2207_ke_2208', 'nextVersion' => '22.08'],
        '22.08'   => ['migrate' => 'migrasi_2208_ke_2209', 'nextVersion' => '22.09'],
        '22.09'   => ['migrate' => 'migrasi_2209_ke_2210', 'nextVersion' => null],
    ];

    public function __construct()
    {
        parent::__construct();

        $this->load->dbutil();
        if (! $this->dbutil->database_exists($this->db->database)) {
            return;
        }

        $this->cek_engine_db();
        $this->load->dbforge();
        $this->user = $this->session_user ?: 1;
    }

    private function cek_engine_db()
    {
        $db_debug           = $this->db->db_debug;
        $this->db->db_debug = false; //disable debugging for queries

        $query = $this->db->query("SELECT `engine` FROM INFORMATION_SCHEMA.TABLES WHERE table_schema= '" . $this->db->database . "' AND table_name = 'user'");
        $error = $this->db->error();
        if ($error['code'] != 0) {
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
			(9, 'login_title','OpenSID', 'Judul tab browser halaman login modul administrasi','',''),
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

    public function migrasi_db_cri()
    {
        $this->load->model('folder_desa_model');
        // Tunggu restore selesai sebelum migrasi
        if (isset($this->session->sedang_restore) && $this->session->sedang_restore == 1) {
            return;
        }

        $_SESSION['daftar_migrasi'] = []; // Catat migrasi yg sdh dijalankan, supaya tidak diulang

        $_SESSION['success'] = 1;
        $versi               = $this->getCurrentVersion();
        $nextVersion         = $versi;
        $versionMigrate      = $this->versionMigrate;
        if (isset($versionMigrate[$versi])) {
            while (! empty($nextVersion) && ! empty($versionMigrate[$nextVersion]['migrate'])) {
                $migrate     = $versionMigrate[$nextVersion]['migrate'];
                $nextVersion = $versionMigrate[$nextVersion]['nextVersion'];
                if (method_exists($this, $migrate)) {
                    log_message('error', 'Jalankan ' . $migrate);
                    call_user_func(__NAMESPACE__ . '\\Database_model::' . $migrate);
                } else {
                    $this->jalankan_migrasi($migrate);
                }
            }
        } else {
            $this->_migrasi_db_cri();
        }

        // Jalankan migrasi layanan
        $this->jalankan_migrasi('migrasi_layanan');
        $this->folder_desa_model->amankan_folder_desa();
        $this->db->where('id', 13)->update('setting_aplikasi', ['value' => true]);
        /*
         * Update current_version di db.
         * 'pasca-<versi>' atau '<versi>-pasca disimpan sebagai '<versi>'
         */
        $versi      = AmbilVersi();
        $versi      = preg_replace('/-premium.*|pasca-|-pasca/', '', $versi);
        $newVersion = [
            'value' => $versi,
        ];
        $this->db->where(['key' => 'current_version'])->update('setting_aplikasi', $newVersion);
        $this->catat_versi_database();
        $this->load->model('track_model');
        $this->track_model->kirim_data();
    }

    private function catat_versi_database()
    {
        // Catat migrasi ini telah dilakukan
        $sudah = $this->db->where('versi_database', VERSI_DATABASE)
            ->get('migrasi')->num_rows();
        if (! $sudah) {
            $this->db->insert('migrasi', ['versi_database' => VERSI_DATABASE]);
        }
    }

    private function getCurrentVersion()
    {
        // Untuk kasus tabel setting_aplikasi belum ada
        if (! $this->db->table_exists('setting_aplikasi')) {
            return null;
        }
        $result  = null;
        $_result = $this->db->where(['key' => 'current_version'])->get('setting_aplikasi')->row();
        if (! empty($_result)) {
            $result = $_result->value;
        }

        return $result;
    }

    private function versi_database_terbaru()
    {
        $sudah = false;
        if ($this->db->table_exists('migrasi')) {
            $sudah = $this->db->where('versi_database', VERSI_DATABASE)
                ->get('migrasi')->num_rows();
        }

        return $sudah;
    }

    // Cek apakah migrasi perlu dijalankan
    public function cek_migrasi()
    {
        // Paksa menjalankan migrasi kalau belum
        // Migrasi direkam di tabel migrasi
        if (! $this->versi_database_terbaru()) {
            if (empty($this->session->error_premium)) {
                // Ulangi migrasi terakhir
                $terakhir                                                                                  = key(array_slice($this->versionMigrate, -1, 1, true));
                $sebelumnya                                                                                = key(array_slice($this->versionMigrate, -2, 1, true));
                $this->versionMigrate[$terakhir]['migrate'] ?: $this->versionMigrate[$terakhir]['migrate'] = $this->versionMigrate[$sebelumnya]['migrate'];

                $this->migrasi_db_cri();
            } else {
                // Selalu jalankan migrasi ini
                $this->jalankan_migrasi('migrasi_layanan');
            }
        }
    }

    // Migrasi dengan fuction
    private function _migrasi_db_cri()
    {
    }


    public function kosongkan_db()
    {
        $this->load->model('analisis_import_model');

        // Views tidak perlu dikosongkan.
        $views        = $this->get_views();
        $table_lookup = [
            'analisis_ref_state',
            'analisis_ref_subjek',
            'analisis_tipe_indikator',
            'artikel', //remove everything except widgets 1003
            'config', //Karena terkait validasi pengguna premium
            'gis_simbol',
            'klasifikasi_surat',
            'keuangan_manual_ref_bidang',
            'keuangan_manual_ref_kegiatan',
            'keuangan_manual_ref_rek1',
            'keuangan_manual_ref_rek2',
            'keuangan_manual_ref_rek3',
            'keuangan_manual_rinci_tpl',
            'media_sosial',
            'ref_asal_tanah_kas',
            'ref_dokumen',
            'ref_penduduk_hamil',
            'ref_peristiwa',
            'ref_persil_kelas', // Migrasi tambah data ref_peristiwa perlu dilakukan ulang (Migrasi_2007_ke_2008)
            'ref_persil_mutasi', // Migrasi tambah data ref_persil_kelas perlu dilakukan ulang (Migrasi_2007_ke_2008)
            'ref_peruntukan_tanah_kas', // Migrasi tambah data ref_peruntukan_tanah_kas perlu dilakukan ulang (Migrasi_2007_ke_2008)
            'ref_pindah',
            'ref_penduduk_bahasa',
            'ref_penduduk_bidang',
            'ref_penduduk_kursus',
            'ref_penduduk_suku',
            'ref_syarat_surat',
            'ref_status_covid',
            'setting_modul',
            'setting_aplikasi',
            'setting_aplikasi_options',
            'syarat_surat',
            'tweb_aset',
            'tweb_cacat',
            'tweb_cara_kb',
            'tweb_golongan_darah',
            'tweb_keluarga_sejahtera',
            'tweb_penduduk_agama',
            'tweb_penduduk_asuransi',
            'tweb_penduduk_hubungan',
            'tweb_penduduk_kawin',
            'tweb_penduduk_pekerjaan',
            'tweb_penduduk_pendidikan',
            'tweb_penduduk_pendidikan_kk',
            'tweb_penduduk_sex',
            'tweb_penduduk_status',
            'tweb_penduduk_umur',
            'tweb_penduduk_warganegara',
            'tweb_rtm_hubungan',
            'tweb_sakit_menahun',
            'tweb_status_dasar',
            'tweb_status_ktp',
            'tweb_surat_format',
            'user',
            'user_grup',
            'widget',
        ];

        // Hanya kosongkan contoh menu kalau pengguna memilih opsi itu
        if (empty($_POST['kosongkan_menu'])) {
            array_push($table_lookup, 'kategori', 'menu');
        }

        $jangan_kosongkan = array_merge($views, $table_lookup);

        // Hapus semua artikel kecuali artikel widget dengan kategori 1003
        $this->db->where('id_kategori !=', '1003');
        $query = $this->db->delete('artikel');
        // Kosongkan semua tabel kecuali table lookup dan views
        // Tabel yang ada foreign key akan dikosongkan secara otomatis
        $semua_table = $this->db->list_tables();
        $this->db->simple_query('SET FOREIGN_KEY_CHECKS=0');

        foreach ($semua_table as $table) {
            if (! in_array($table, $jangan_kosongkan)) {
                $query = 'DELETE FROM ' . $table . ' WHERE 1';
                $this->db->query($query);
            }
        }
        $this->db->simple_query('SET FOREIGN_KEY_CHECKS=1');
        // Tambahkan kembali Analisis DDK Profil Desa dan Analisis DAK Profil Desa
        $file_analisis = FCPATH . 'assets/import/analisis_DDK_Profil_Desa.xlsx';
        $this->analisis_import_model->impor_analisis($file_analisis, 'DDK02', 1);
        $file_analisis = FCPATH . 'assets/import/analisis_DAK_Profil_Desa.xlsx';
        $this->analisis_import_model->impor_analisis($file_analisis, 'DAK02', $jenis = 1);

        // Kecuali folder
        $exclude = [
            'instansi/config',
            'instansi/themes',
        ];

        // Kosongkan folder desa dan copy isi folder desa-contoh
        foreach (glob('instansi/*', GLOB_ONLYDIR) as $folder) {
            if (! in_array($folder, $exclude)) {
                delete_files(FCPATH . $folder, true);
            }
        }

        xcopy('desa-contoh', 'desa', ['config'], ['.htaccess', 'index.html', 'baca-ini.txt']);

        session_success();
    }

    public function get_views()
    {
        $db    = $this->db->database;
        $sql   = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'VIEW' AND TABLE_SCHEMA = '{$db}'";
        $query = $this->db->query($sql);
        $data  = $query->result_array();

        return array_column($data, 'TABLE_NAME');
    }
}

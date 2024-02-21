<?php defined('BASEPATH') || exit('No direct script access allowed');

define('KOLOM_IMPOR_KELUARGA', serialize([
    'alamat'               => '0',
    'dusun'                => '1',
    'rw'                   => '2',
    'rt'                   => '3',
    'nama'                 => '4',
    'no_kk'                => '5',
    'nik'                  => '6',
    'sex'                  => '7',
    'tempatlahir'          => '8',
    'tanggallahir'         => '9',
    'agama_id'             => '10',
    'pendidikan_kk_id'     => '11',
    'pendidikan_sedang_id' => '12',
    'pekerjaan_id'         => '13',
    'status_kawin'         => '14',
    'kk_level'             => '15',
    'warganegara_id'       => '16',
    'nama_ayah'            => '17',
    'nama_ibu'             => '18',
    'golongan_darah_id'    => '19',
    'akta_lahir'           => '20',
    'dokumen_pasport'      => '21',
    'tanggal_akhir_paspor' => '22',
    'dokumen_kitas'        => '23',
    'ayah_nik'             => '24',
    'ibu_nik'              => '25',
    'akta_perkawinan'      => '26',
    'tanggalperkawinan'    => '27',
    'akta_perceraian'      => '28',
    'tanggalperceraian'    => '29',
    'cacat_id'             => '30',
    'cara_kb_id'           => '31',
    'hamil'                => '32',
    'ktp_el'               => '33',
    'status_rekam'         => '34',
    'alamat_sekarang'      => '35',
    'status_dasar'         => '36',
    'suku'                 => '37',
    'tag_id_card'          => '38',
    'id_asuransi'          => '39',
    'no_asuransi'          => '40',
]));

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Import_model extends CI_Model
{
    public $error_tulis_penduduk; // error pada pemanggilan terakhir tulis_tweb_penduduk()

    public function __construct()
    {
        parent::__construct();
        // Sediakan memory paling sedikit 512M
        preg_match('/^(\d+)(M)$/', ini_get('memory_limit'), $matches);
        $memory_limit = $matches[1] ?: 0;
        if ($memory_limit < 512) {
            ini_set('memory_limit', '512M');
        }
        set_time_limit(3600);
        $this->load->model(['referensi_model', 'penduduk_model']);
        $this->load->library('Spreadsheet_Excel_Reader');

        // Data referensi tambahan
        $sex = [
            'L'  => 1,
            'LK' => 1,
            'P'  => 2,
            'Pr' => 2,
        ];

        $pendidikan = [
            'Tidak/Blm Sekolah'                => 1,
            'Tidak Tamat SD/Sederajat'         => 2,
            'Akademi/Diploma III/Sarjana Muda' => 7,
            'Strata-II'                        => 9,
        ];

        $status = [
            'BK' => 1,
            'K'  => 2,
            'CH' => 3,
            'CM' => 4,
        ];

        $status_dasar = [
            'PINDAH DALAM NEGERI' => 3,
            'PINDAH LUAR NEGERI'  => 3,
        ];

        $golongan_darah = [
            'Tdk Th' => 13,
        ];

        $this->kode_sex               = $this->referensi_model->impor_list_data('tweb_penduduk_sex', $sex);
        $this->kode_hubungan          = $this->referensi_model->impor_list_data('tweb_penduduk_hubungan');
        $this->kode_agama             = $this->referensi_model->impor_list_data('tweb_penduduk_agama');
        $this->kode_pendidikan_kk     = $this->referensi_model->impor_list_data('tweb_penduduk_pendidikan_kk', $pendidikan);
        $this->kode_pendidikan_sedang = $this->referensi_model->impor_list_data('tweb_penduduk_pendidikan');
        $this->kode_pekerjaan         = $this->referensi_model->impor_list_data('tweb_penduduk_pekerjaan');
        $this->kode_status            = $this->referensi_model->impor_list_data('tweb_penduduk_kawin', $status);
        $this->kode_golongan_darah    = $this->referensi_model->impor_list_data('tweb_golongan_darah', $golongan_darah);
        $this->kode_ktp_el            = array_change_key_case(unserialize(KTP_EL));
        $this->kode_status_rekam      = array_flip($this->referensi_model->list_status_rekam());
        $this->kode_status_dasar      = $this->referensi_model->impor_list_data('tweb_status_dasar', $status_dasar);
        $this->kode_cacat             = $this->referensi_model->impor_list_data('tweb_cacat');
        $this->kode_warganegara       = $this->referensi_model->impor_list_data('tweb_penduduk_warganegara');
        $this->kode_hamil             = $this->referensi_model->impor_list_data('ref_penduduk_hamil');
        $this->kode_asuransi          = $this->referensi_model->impor_list_data('tweb_penduduk_asuransi');
    }

    /**
     * ========================================================
     * IMPORT EXCEL
     * ========================================================
     */
    private function file_import_valid()
    {
        // error 1 = UPLOAD_ERR_INI_SIZE; lihat Upload.php
        // TODO: pakai cara upload yg disediakan Codeigniter
        if ($_FILES['userfile']['error'] == 1) {
            $upload_mb = max_upload();
            $this->session->error_msg .= ' -> Ukuran file melebihi batas ' . $upload_mb . ' MB';
            $this->session->success = -1;

            return false;
        }

        $mime_type_excel = ['application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel.sheet.macroenabled.12'];
        if (! in_array(strtolower($_FILES['userfile']['type']), $mime_type_excel)) {
            $this->session->error_msg .= ' -> Jenis file salah: ' . $_FILES['userfile']['type'];
            $this->session->success = -1;

            return false;
        }

        return true;
    }

    /**
     * Konversi tulisan menjadi kode angka
     *
     * @param		array		tulisan => kode angka
     * @param 	string	tulisan yang akan dikonversi
     * @param mixed $daftar_kode
     * @param mixed $nilai
     *
     * @return int kode angka, -1 kalau tidak ada kodenya
     */
    protected function get_kode($daftar_kode, $nilai)
    {
        /*
         *
         * Hapus spasi pada daftar kode
         * Contoh:
         * SLTA / SEDERAJAT => SLTA/SEDERAJAT
         *
         */
        $daftar_kode = array_combine(str_replace(' ', '', array_keys($daftar_kode)), array_values($daftar_kode));

        $nilai = str_replace(' ', '', strtolower($nilai));
        $nilai = preg_replace('/\\s*\\/\\s*/', '/', $nilai);

        if (! empty($nilai) && $nilai != '-' && ! array_key_exists($nilai, $daftar_kode)) {
            return -1;
        } // kode salah

        return $daftar_kode[$nilai];
    }

    protected function get_konversi_kode($daftar_kode, $nilai)
    {
        $nilai = trim($nilai);

        if (ctype_digit($nilai)) {
            return $nilai;
        }

        return $this->get_kode($daftar_kode, $nilai);
    }

    protected function data_import_valid($isi_baris)
    {
        // Kolom yang harus diisi
        if ($isi_baris['nama'] == '' || $isi_baris['nik'] == '' || $isi_baris['dusun'] == '' || $isi_baris['rt'] == '' || $isi_baris['rw'] == '') {
            return 'nama/nik/dusun/rt/rw kosong';
        }
        // Validasi data setiap kolom ber-kode
        if ($isi_baris['sex'] != '' && ! ($isi_baris['sex'] >= 1 && $isi_baris['sex'] <= 2)) {
            return 'kode jenis kelamin ' . $isi_baris['sex'] . '  tidak dikenal';
        }
        if ($isi_baris['agama_id'] != '' && ! ($isi_baris['agama_id'] >= 1 && $isi_baris['agama_id'] <= 7)) {
            return 'kode agama ' . $isi_baris['agama_id'] . '  tidak dikenal';
        }
        if ($isi_baris['pendidikan_kk_id'] != '' && ! ($isi_baris['pendidikan_kk_id'] >= 1 && $isi_baris['pendidikan_kk_id'] <= 10)) {
            return 'kode pendidikan ' . $isi_baris['pendidikan_kk_id'] . '  tidak dikenal';
        }
        if ($isi_baris['pendidikan_sedang_id'] != '' && ! ($isi_baris['pendidikan_sedang_id'] >= 1 && $isi_baris['pendidikan_sedang_id'] <= 18)) {
            return 'kode pendidikan_sedang ' . $isi_baris['pendidikan_sedang_id'] . '  tidak dikenal';
        }
        if ($isi_baris['pekerjaan_id'] != '' && ! ($isi_baris['pekerjaan_id'] >= 1 && $isi_baris['pekerjaan_id'] <= 89)) {
            return 'kode pekerjaan ' . $isi_baris['pekerjaan_id'] . '  tidak dikenal';
        }
        if ($isi_baris['status_kawin'] != '' && ! ($isi_baris['status_kawin'] >= 1 && $isi_baris['status_kawin'] <= 4)) {
            return 'kode status_kawin ' . $isi_baris['status_kawin'] . ' tidak dikenal';
        }
        if ($isi_baris['kk_level'] != '' && ! ($isi_baris['kk_level'] >= 1 && $isi_baris['kk_level'] <= 11)) {
            return 'kode status hubungan ' . $isi_baris['kk_level'] . '  tidak dikenal';
        }
        if ($isi_baris['warganegara_id'] != '' && ! ($isi_baris['warganegara_id'] >= 1 && $isi_baris['warganegara_id'] <= 3)) {
            return 'kode warganegara ' . $isi_baris['warganegara_id'] . '  tidak dikenal';
        }
        if ($isi_baris['golongan_darah_id'] != '' && ! ($isi_baris['golongan_darah_id'] >= 1 && $isi_baris['golongan_darah_id'] <= 13)) {
            return 'kode golongan_darah ' . $isi_baris['golongan_darah_id'] . '  tidak dikenal';
        }
        if ($isi_baris['cacat_id'] != '' && ! ($isi_baris['cacat_id'] >= 1 && $isi_baris['cacat_id'] <= 7)) {
            return 'kode cacat ' . $isi_baris['cacat_id'] . '  tidak dikenal';
        }
        if ($isi_baris['cara_kb_id'] != '' && ! ($isi_baris['cara_kb_id'] >= 1 && $isi_baris['cara_kb_id'] <= 8) && $isi_baris['cara_kb_id'] != '99') {
            return 'kode cara_kb ' . $isi_baris['cara_kb_id'] . '  tidak dikenal';
        }
        if ($isi_baris['hamil'] != '' && ! ($isi_baris['hamil'] >= 1 && $isi_baris['hamil'] <= 2)) {
            return 'kode hamil ' . $isi_baris['hamil'] . '  tidak dikenal';
        }
        if ($isi_baris['ktp_el'] != '' && ! ($isi_baris['ktp_el'] >= 1 && $isi_baris['ktp_el'] <= 2)) {
            return 'kode ktp_el ' . $isi_baris['ktp_el'] . ' tidak dikenal';
        }
        if ($isi_baris['status_rekam'] != '' && ! ($isi_baris['status_rekam'] >= 1 && $isi_baris['status_rekam'] <= 8)) {
            return 'kode status_rekam ' . $isi_baris['status_rekam'] . ' tidak dikenal';
        }
        if ($isi_baris['status_dasar'] != '' && ! in_array($isi_baris['status_dasar'], [1, 2, 3, 4, 6, 9])) {
            return 'kode status_dasar ' . $isi_baris['status_dasar'] . ' tidak dikenal';
        }

        if ($isi_baris['id_asuransi'] != '' && ! in_array($isi_baris['id_asuransi'], [1, 2, 3, 99])) {
            return 'kode asuransi tidak dikenal';
        }

        // Validasi data lain
        if (! ctype_digit($isi_baris['nik']) || (strlen($isi_baris['nik']) != 16 && $isi_baris['nik'] != '0')) {
            return 'nik salah';
        }

        return '';
    }

    protected function format_tanggal($kolom_tanggal)
    {
        // spout mengambil kolom tanggal sebagai DateTime object
        if (is_a($kolom_tanggal, 'DateTime')) {
            return $kolom_tanggal->format('Y-m-d');
        }
        $tanggal = ltrim(trim($kolom_tanggal), "'");
        if (strlen($tanggal) == 0) {
            return $tanggal;
        }

        // Ganti separator tanggal supaya tanggal diproses sebagai dd-mm-YYYY.
        // Kalau pakai '/', strtotime memrosesnya sebagai mm/dd/YYYY.
        // Lihat panduan strtotime: http://php.net/manual/en/function.strtotime.php
        $tanggal = str_replace('/', '-', $tanggal);

        return date('Y-m-d', strtotime($tanggal));
    }

    private function cek_kosong($isi)
    {
        $isi = trim($isi);

        return (in_array($isi, ['', '-'])) ? null : $isi;
    }

    private function get_isi_baris($rowData)
    {
        $kolom_impor_keluarga = unserialize(KOLOM_IMPOR_KELUARGA);
        $isi_baris['alamat']  = trim($rowData[$kolom_impor_keluarga['alamat']]);
        $dusun                = ltrim(trim($rowData[$kolom_impor_keluarga['dusun']]), "'");
        $dusun                = str_replace('_', ' ', $dusun);
        $dusun                = strtoupper($dusun);
        $dusun                = str_replace('DUSUN ', '', $dusun);
        $isi_baris['dusun']   = $dusun;

        $isi_baris['rw'] = ltrim(trim($rowData[$kolom_impor_keluarga['rw']]), "'");
        $isi_baris['rt'] = ltrim(trim($rowData[$kolom_impor_keluarga['rt']]), "'");

        $nama              = trim($rowData[$kolom_impor_keluarga['nama']]);
        $nama              = preg_replace('/[^a-zA-Z0-9,\.\']/', ' ', $nama);
        $isi_baris['nama'] = $nama;

        // Data Disdukcapil adakalanya berisi karakter tambahan pada no_kk dan nik
        // yang tidak tampak (non-printable characters),
        // jadi perlu dibuang
        $no_kk              = trim($rowData[$kolom_impor_keluarga['no_kk']]);
        $no_kk              = preg_replace('/[^0-9]/', '', $no_kk);
        $isi_baris['no_kk'] = $no_kk;

        $nik              = trim($rowData[$kolom_impor_keluarga['nik']]);
        $nik              = preg_replace('/[^0-9]/', '', $nik);
        $isi_baris['nik'] = $nik;

        $isi_baris['sex']                  = $this->get_konversi_kode($this->kode_sex, $rowData[$kolom_impor_keluarga['sex']]);
        $isi_baris['tempatlahir']          = $this->cek_kosong($rowData[$kolom_impor_keluarga['tempatlahir']]);
        $isi_baris['tanggallahir']         = $this->format_tanggal($rowData[$kolom_impor_keluarga['tanggallahir']]);
        $isi_baris['agama_id']             = $this->get_konversi_kode($this->kode_agama, $rowData[$kolom_impor_keluarga['agama_id']]);
        $isi_baris['pendidikan_kk_id']     = $this->get_konversi_kode($this->kode_pendidikan_kk, $rowData[$kolom_impor_keluarga['pendidikan_kk_id']]);
        $isi_baris['pendidikan_sedang_id'] = $this->get_konversi_kode($this->kode_pendidikan_sedang, $rowData[$kolom_impor_keluarga['pendidikan_sedang_id']]);
        $isi_baris['pekerjaan_id']         = $this->get_konversi_kode($this->kode_pekerjaan, $rowData[$kolom_impor_keluarga['pekerjaan_id']]);
        $isi_baris['status_kawin']         = $this->get_konversi_kode($this->kode_status, $rowData[$kolom_impor_keluarga['status_kawin']]);
        $isi_baris['kk_level']             = $this->get_konversi_kode($this->kode_hubungan, $rowData[$kolom_impor_keluarga['kk_level']]);
        $isi_baris['warganegara_id']       = $this->get_konversi_kode($this->kode_warganegara, $rowData[$kolom_impor_keluarga['warganegara_id']]);
        $isi_baris['nama_ayah']            = $this->cek_kosong($rowData[$kolom_impor_keluarga['nama_ayah']]);
        $isi_baris['nama_ibu']             = $this->cek_kosong($rowData[$kolom_impor_keluarga['nama_ibu']]);
        $isi_baris['golongan_darah_id']    = $this->get_konversi_kode($this->kode_golongan_darah, $rowData[$kolom_impor_keluarga['golongan_darah_id']]);
        $isi_baris['akta_lahir']           = $this->cek_kosong($rowData[$kolom_impor_keluarga['akta_lahir']]);
        $isi_baris['dokumen_pasport']      = $this->cek_kosong($rowData[$kolom_impor_keluarga['dokumen_pasport']]);
        $isi_baris['tanggal_akhir_paspor'] = $this->cek_kosong($this->format_tanggal($rowData[$kolom_impor_keluarga['tanggal_akhir_paspor']]));
        $isi_baris['dokumen_kitas']        = $this->cek_kosong($rowData[$kolom_impor_keluarga['dokumen_kitas']]);
        $isi_baris['ayah_nik']             = $this->cek_kosong($rowData[$kolom_impor_keluarga['ayah_nik']]);
        $isi_baris['ibu_nik']              = $this->cek_kosong($rowData[$kolom_impor_keluarga['ibu_nik']]);
        $isi_baris['akta_perkawinan']      = $this->cek_kosong($rowData[$kolom_impor_keluarga['akta_perkawinan']]);
        $isi_baris['tanggalperkawinan']    = $this->cek_kosong($this->format_tanggal($rowData[$kolom_impor_keluarga['tanggalperkawinan']]));
        $isi_baris['akta_perceraian']      = $this->cek_kosong($rowData[$kolom_impor_keluarga['akta_perceraian']]);
        $isi_baris['tanggalperceraian']    = $this->cek_kosong($this->format_tanggal($rowData[$kolom_impor_keluarga['tanggalperceraian']]));
        $isi_baris['cacat_id']             = $this->get_konversi_kode($this->kode_cacat, $rowData[$kolom_impor_keluarga['cacat_id']]);
        $isi_baris['cara_kb_id']           = $this->get_konversi_kode($this->kode_cara_kb, $rowData[$kolom_impor_keluarga['cara_kb_id']]);
        $isi_baris['hamil']                = $this->get_konversi_kode($this->kode_hamil, $rowData[$kolom_impor_keluarga['hamil']]);
        $isi_baris['ktp_el']               = $this->get_konversi_kode($this->kode_ktp_el, $rowData[$kolom_impor_keluarga['ktp_el']]);
        $isi_baris['status_rekam']         = $this->get_konversi_kode($this->kode_status_rekam, $rowData[$kolom_impor_keluarga['status_rekam']]);
        $isi_baris['alamat_sekarang']      = $this->cek_kosong($rowData[$kolom_impor_keluarga['alamat_sekarang']]);
        $isi_baris['status_dasar']         = $this->get_konversi_kode($this->kode_status_dasar, $rowData[$kolom_impor_keluarga['status_dasar']]);
        $isi_baris['suku']                 = $this->cek_kosong($rowData[$kolom_impor_keluarga['suku']]);
        $isi_baris['tag_id_card']          = $this->cek_kosong($rowData[$kolom_impor_keluarga['tag_id_card']]);
        $isi_baris['id_asuransi']          = $this->get_konversi_kode($this->kode_asuransi, trim($rowData[$kolom_impor_keluarga['id_asuransi']]));
        $isi_baris['no_asuransi']          = trim($rowData[$kolom_impor_keluarga['no_asuransi']]);

        return $isi_baris;
    }

    protected function tulis_tweb_wil_clusterdesa(&$isi_baris)
    {
        // Masukkan wilayah administratif ke tabel tweb_wil_clusterdesa apabila
        // wilayah administratif ini belum ada

        // --- Masukkan dusun apabila belum ada
        $query = 'SELECT id FROM tweb_wil_clusterdesa WHERE dusun = ?';
        $hasil = $this->db->query($query, $isi_baris['dusun']);
        $res   = $hasil->row_array();
        if (empty($res)) {
            $query = "INSERT INTO tweb_wil_clusterdesa(rt, rw, dusun) VALUES (0, 0, '" . $isi_baris['dusun'] . "')";
            $hasil = $this->db->query($query);
            $query = "INSERT INTO tweb_wil_clusterdesa(rt, rw, dusun) VALUES (0, '-', '" . $isi_baris['dusun'] . "')";
            $hasil = $this->db->query($query);
            $query = "INSERT INTO tweb_wil_clusterdesa(rt, rw, dusun) VALUES ('-','-','" . $isi_baris['dusun'] . "')";
            $hasil = $this->db->query($query);
        }

        // --- Masukkan rw apabila belum ada
        $query = 'SELECT id FROM tweb_wil_clusterdesa WHERE dusun = ? AND rw = ?';
        $hasil = $this->db->query($query, [$isi_baris['dusun'], $isi_baris['rw']]);
        $res   = $hasil->row_array();
        if (empty($res)) {
            $query                   = "INSERT INTO tweb_wil_clusterdesa(rt,rw,dusun) VALUES (0, '" . $isi_baris['rw'] . "', '" . $isi_baris['dusun'] . "')";
            $hasil                   = $this->db->query($query);
            $query                   = "INSERT INTO tweb_wil_clusterdesa(rt,rw,dusun) VALUES ('-', '" . $isi_baris['rw'] . "', '" . $isi_baris['dusun'] . "')";
            $hasil                   = $this->db->query($query);
            $isi_baris['id_cluster'] = $this->db->insert_id();
        }

        // --- Masukkan rt apabila belum ada
        $query = "SELECT id FROM tweb_wil_clusterdesa WHERE
							dusun = '" . $isi_baris['dusun'] . "' AND rw='" . $isi_baris['rw'] . "' AND rt='" . $isi_baris['rt'] . "'";
        $hasil = $this->db->query($query);
        $res   = $hasil->row_array();
        if (! empty($res)) {
            $isi_baris['id_cluster'] = $res['id'];
        } else {
            $query                   = "INSERT INTO tweb_wil_clusterdesa(rt,rw,dusun) VALUES ('" . $isi_baris['rt'] . "', '" . $isi_baris['rw'] . "', '" . $isi_baris['dusun'] . "')";
            $hasil                   = $this->db->query($query);
            $isi_baris['id_cluster'] = $this->db->insert_id();
        }
    }

    protected function tulis_tweb_keluarga(&$isi_baris)
    {
        // Penduduk dengan no_kk kosong adalah penduduk lepas
        if ($isi_baris['no_kk'] == '') {
            return false;
        }
        // Masukkan keluarga ke tabel tweb_keluarga apabila
        // keluarga ini belum ada
        $keluarga_baru = false;

        $keluarga_id = $this->db
            ->select('id')
            ->get_where('tweb_keluarga', ['no_kk' => $isi_baris['no_kk']])
            ->row()
            ->id;

        $data['updated_by'] = $this->session->user;
        $data['id_cluster'] = $isi_baris['id_cluster'];

        if ($keluarga_id) {
            // Update keluarga apabila sudah ada
            $isi_baris['id_kk'] = $keluarga_id;
            $this->db->where('id', $keluarga_id);
            // Hanya update apabila alamat kosong
            // karena alamat keluarga akan diupdate menggunakan data kepala keluarga di tulis_tweb_pendududk
            $this->db->where('alamat', null);
            $data['alamat'] = $isi_baris['alamat'];
            $this->db->update('tweb_keluarga', $data);
        } else {
            $data['no_kk']  = $isi_baris['no_kk'];
            $data['alamat'] = $isi_baris['alamat'];

            $this->db->insert('tweb_keluarga', $data);
            $isi_baris['id_kk'] = $this->db->insert_id();
            $keluarga_baru      = true;
        }

        return $keluarga_baru;
    }

    protected function tulis_tweb_penduduk($isi_baris)
    {
        $this->load->model('penduduk_model');
        $this->error_tulis_penduduk = null;

        // Siapkan data penduduk
        $kolom_baris = ['nama', 'nik', 'id_kk', 'kk_level', 'sex', 'tempatlahir', 'tanggallahir', 'agama_id', 'pendidikan_kk_id', 'pendidikan_sedang_id', 'pekerjaan_id', 'status_kawin', 'warganegara_id', 'nama_ayah', 'nama_ibu', 'golongan_darah_id', 'akta_lahir', 'dokumen_pasport', 'tanggal_akhir_paspor', 'dokumen_kitas', 'ayah_nik', 'ibu_nik', 'akta_perkawinan', 'tanggalperkawinan', 'akta_perceraian', 'tanggalperceraian', 'cacat_id', 'cara_kb_id', 'hamil', 'id_cluster', 'ktp_el', 'status_rekam', 'alamat_sekarang', 'alamat_sebelumnya', 'status_dasar', 'suku', 'tag_id_card', 'id_asuransi', 'no_asuransi'];

        foreach ($kolom_baris as $kolom) {
            $data[$kolom] = $isi_baris[$kolom];
        }

        $data['status'] = '1';  // penduduk impor dianggap aktif
        // Jangan masukkan atau update isian yang kosong
        foreach ($data as $key => $value) {
            if (empty($value)) {
                if (! ($key == 'nik' && $value == '0')) {
                    unset($data[$key]);
                } // Kecuali untuk kolom NIk boleh 0
            }
        }
        // Masukkan penduduk ke tabel tweb_penduduk apabila
        // penduduk ini belum ada
        // Penduduk dianggap baru apabila NIK tidak diketahui (nilai 0)
        $penduduk_baru = false;
        if ($isi_baris['nik'] == 0) {
            // Update penduduk NIK sementara dengan ketentuan
            // 1. Cek nama
            // 2. Cek tempat lahir
            // 3. Cek tgl lahir
            // Jika ke 3 data tsb sama, maka data sebelumnya dianggap sama, selain itu dianggap penduduk yg berbeda/baru
            $cek_data         = $this->db->get_where('tweb_penduduk', ['nama' => $isi_baris['nama'], 'tempatlahir' => $isi_baris['tempatlahir'], 'tanggallahir' => $isi_baris['tanggallahir']])->row_array();
            $isi_baris['nik'] = $cek_data['nik'] ?? $this->penduduk_model->nik_sementara();
        }

        // Hamil hanya untuk jenis kelamin perempuan (2)
        if ($data['sex'] == '1') {
            unset($data['hamil']);
        }

        $res = $this->db->get_where('tweb_penduduk', ['nik' => $isi_baris['nik']])->row_array();
        if ($res) {
            if ($data['status_dasar'] != -1) {
                if ($this->penduduk_model->cekTagIdCard($data['tag_id_card'], $res['id'])) {
                    return $this->error_tulis_penduduk['message'] = 'Tag ID Card ' . $data['tag_id_card'] . ' sudah digunakan pada NIK : ' . $data['nik'];
                }

                $data['nik'] = $res['nik'];

                // Hanya update apabila status dasar valid (data SIAK)
                $data['updated_at'] = date('Y-m-d H:i:s');
                $data['updated_by'] = $this->session->user;
                $this->db->where('id', $res['id']);
                if (! $this->db->update('tweb_penduduk', $data)) {
                    $this->error_tulis_penduduk = $this->db->error();
                }
            }

            $penduduk_baru = $res['id'];
        } else {
            if ($this->penduduk_model->cekTagIdCard($data['tag_id_card'])) {
                return $this->error_tulis_penduduk['message'] = 'Tag ID Card ' . $data['tag_id_card'] . ' sudah digunakan pada NIK : ' . $data['nik'];
            }

            // Konfersi nik 0 sesuai format nik sementara
            $data['nik'] = $isi_baris['nik'];

            if ($data['status_dasar'] == -1) {
                $data['status_dasar'] = 9;
            } // Tidak Valid
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->user;
            if (! $this->db->insert('tweb_penduduk', $data)) {
                $this->error_tulis_penduduk = $this->db->error();
            }
            $penduduk_baru = $this->db->insert_id();

            // Insert ke log_penduduk pada penduduk baru
            $log['tgl_peristiwa']  = $data['created_at'];
            $log['kode_peristiwa'] = 5;
            $log['tgl_lapor']      = $data['created_at'];
            $log['id_pend']        = $penduduk_baru;
            $log['created_by']     = $data['created_by'];
            $this->penduduk_model->tulis_log_penduduk_data($log);
        }

        // Update nik_kepala dan id_cluster di keluarga apabila baris ini kepala keluarga
        // dan sudah ada NIK
        if ($data['kk_level'] == 1) {
            $this->db
                ->where('id', $data['id_kk'])
                ->update('tweb_keluarga', [
                    'nik_kepala' => $penduduk_baru,
                    'id_cluster' => $isi_baris['id_cluster'],
                    'alamat'     => $isi_baris['alamat'],
                ]);
        }

        return $penduduk_baru;
    }

    private function hapus_data_penduduk()
    {
        $tabel_penduduk = ['tweb_wil_clusterdesa', 'tweb_keluarga', 'tweb_penduduk', 'log_keluarga', 'log_penduduk', 'log_perubahan_penduduk', 'log_surat', 'tweb_rtm'];

        foreach ($tabel_penduduk as $tabel) {
            $this->db->empty_table($tabel);
        }

        // Hapus peserta bantuan dengan sasaran penduduk, keluarga, rumah tangga, kelompok
        $program = $this->db
            ->select('id')
            ->where_in('sasaran', [1, 2, 3, 4])
            ->get('program')
            ->result_array();
        $this->db
            ->where_in('program_id', array_column($program, 'id'))
            ->delete('program_peserta');
    }

    /** Tidak boleh menghapus data penduduk jika:
     * dalam demo_mode, atau
     * status penduduk sudah lengkap
     * tidak ada lagi data tweb_penduduk contoh awal (created_by = -1)
     */
    public function boleh_hapus_penduduk()
    {
        $data_awal = $this->db
            ->from('tweb_penduduk')
            ->where('created_by <=', 0)
            ->count_all_results();
        if (config_item('demo_mode') || $data_awal == 0) {
            return false;
        }

        return ! $this->setting->tgl_data_lengkap_aktif || empty($this->setting->tgl_data_lengkap);
    }

    public function import_excel($hapus = false)
    {
        $this->session->error_msg = '';
        $this->session->success   = 1;

        if ($this->file_import_valid() == false) {
            return;
        }

        // Pengguna bisa menentukan apakah data penduduk yang ada dihapus dulu
        // atau tidak sebelum melakukan impor
        if ($hapus && $this->boleh_hapus_penduduk()) {
            $this->hapus_data_penduduk();
        }

        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->setShouldPreserveEmptyRows(true);
        $reader->open($_FILES['userfile']['tmp_name']);

        foreach ($reader->getSheetIterator() as $sheet) {
            $gagal         = 0;
            $baris_gagal   = '';
            $baris_data    = 0;
            $baris_pertama = false;
            $nomor_baris   = 0;

            if ($sheet->getName() == 'Kode Data') {
                continue;
            }

            foreach ($sheet->getRowIterator() as $row) {
                $nomor_baris++;
                $rowData = [];
                $cells   = $row->getCells();

                foreach ($cells as $cell) {
                    $rowData[] = $cell->getValue();
                }

                // Baris dengan kolom dusun = '###' menunjukkan telah sampai pada baris data terakhir
                if ($rowData[1] == '###') {
                    break;
                }

                // Baris dengan dusun/rw/rt kosong menandakan baris tanpa data
                if ($rowData[1] == '' && $rowData[2] == '' && $rowData[3] == '') {
                    continue;
                }

                // Baris pertama diabaikan, berisi nama kolom
                if (! $baris_pertama) {
                    $baris_pertama = true;

                    continue;
                }

                $baris_data++;

                $this->db->query('SET character_set_connection = utf8');
                $this->db->query('SET character_set_client = utf8');

                $isi_baris      = $this->get_isi_baris($rowData);
                $error_validasi = $this->data_import_valid($isi_baris);
                if (empty($error_validasi)) {
                    $this->tulis_tweb_wil_clusterdesa($isi_baris);
                    $this->tulis_tweb_keluarga($isi_baris);
                    $this->tulis_tweb_penduduk($isi_baris);
                    if ($error = $this->error_tulis_penduduk) {
                        $gagal++;
                        $baris_gagal .= $nomor_baris . ') ' . $error['message'] . '<br>';
                    }
                } else {
                    $gagal++;
                    $baris_gagal .= $nomor_baris . ') ' . $error_validasi . '<br>';
                }
            }

            if ($baris_data <= 0) {
                $this->session->error_msg .= ' -> Tidak ada data';
                $this->session->success = -1;

                return;
            }

            $sukses = $baris_data - $gagal;
            if ($gagal == 0) {
                $baris_gagal = 'tidak ada data yang gagal di import.';
            } else {
                $this->session->success = -1;
            }
            $this->session->gagal  = $gagal;
            $this->session->sukses = $sukses;
            $this->session->baris  = $baris_gagal;
        }
        $reader->close();
    }

    /* 	====================
            Selesai IMPORT EXCEL
            ====================
    */

    public function import_bip($hapus = false)
    {
        $this->session->error_msg = '';
        $this->session->success   = 1;
        if ($this->file_import_valid() == false) {
            return;
        }

        $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

        $this->db->query('SET character_set_connection = utf8');
        $this->db->query('SET character_set_client = utf8');

        // Pengguna bisa menentukan apakah data penduduk yang ada dihapus dulu
        // atau tidak sebelum melakukan impor
        if ($hapus) {
            $this->hapus_data_penduduk();
        }

        require_once APPPATH . '/models/Bip_model.php';
        $bip = new BIP_Model($data);
        $bip->impor_bip();
    }

    private function hapus_rtm_penduduk()
    {
        // Hapus status rtm di tabel tweb_penduduk
        $this->db
            ->where('id_rtm <>', '0')
            ->or_where('rtm_level <>', '0')
            ->update('tweb_penduduk', [
                'id_rtm'    => '0',
                'rtm_level' => '0',
            ]);

        // Hapus data RTM
        $this->db->truncate('tweb_rtm');
    }

    /**
     * Impor Pengelompokan Data Rumah Tangga
     * Alur :
     * Cek apakah NIK ada atau tidak.
     * 1. Jika Ya, update data penduduk (rtm) berdasarkan data impor.
     * 2. Jika Tidak, tampilkan notifikasi baris data yang gagal.
     *
     * @param mixed $hapus
     */
    public function pbdt_individu($hapus = false)
    {
        if (pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION) !== 'xlsx') {
            return session_error('-> File impor tidak sesuai');
        }

        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($_FILES['userfile']['tmp_name']);

        $outp = true;

        // Hapus data RTM sebelum Impor
        if ($hapus) {
            $outp = $outp && $this->hapus_rtm_penduduk();
        }

        foreach ($reader->getSheetIterator() as $sheet) {
            $baris_pertama = false;
            $gagal         = 0;
            $nomor_baris   = 0;
            $pesan         = '';

            if ($sheet->getName() === 'RTM') {
                foreach ($sheet->getRowIterator() as $row) {
                    // Abaikan baris pertama yg berisi nama kolom
                    if (! $baris_pertama) {
                        $baris_pertama = true;

                        continue;
                    }

                    $nomor_baris++;

                    $rowData = [];
                    $cells   = $row->getCells();

                    foreach ($cells as $cell) {
                        $rowData[] = $cell->getValue();
                    }
                    //ID RuTa
                    $id_rtm = $rowData[1];

                    if (empty($id_rtm)) {
                        $pesan .= "Pesan Gagal : Baris {$nomor_baris} Nomer Rumah Tannga Tidak Boleh Kosong</br>";
                        $gagal++;
                        $outp = false;

                        continue;
                    }

                    //Level
                    $rtm_level = (int) $rowData[2];

                    if (empty($rowData[2]) || ! is_int($rowData[2])) {
                        $pesan .= "Pesan Gagal : Baris {$nomor_baris} Kode Hubungan Rumah Tangga Tidak Diketahui</br>";
                        $gagal++;
                        $outp = false;

                        continue;
                    }

                    if ($rtm_level > 1) {
                        $rtm_level = 2;
                    }

                    //NIK
                    $nik = $rowData[0];

                    if (empty($nik)) {
                        $pesan .= "Pesan Gagal : Baris {$nomor_baris} NIK Tidak Boleh Kosong</br>";
                        $gagal++;
                        $outp = false;

                        continue;
                    }

                    if ($penduduk = $this->cekPenduduk($nik)) {
                        $ada = [
                            'id_rtm'     => $id_rtm,
                            'rtm_level'  => $rtm_level,
                            'updated_at' => date('Y-m-d H:i:s'),
                            'updated_by' => $this->session->user,
                        ];

                        if (! $this->db->where('nik', $nik)->update('tweb_penduduk', $ada)) {
                            $pesan .= "Pesan Gagal : Baris {$nomor_baris} Data penduduk dengan NIK : { {$nik} } gagal disimpan</br>";
                            $gagal++;
                            $outp = false;

                            continue;
                        }

                        if ($rtm_level == 1) {
                            $dataRTM = [
                                'nik_kepala' => $penduduk['id'],
                                'no_kk'      => $id_rtm,
                            ];

                            $sql = $this->db->insert_string('tweb_rtm', $dataRTM) . ' ON DUPLICATE KEY UPDATE nik_kepala = VALUES(nik_kepala), no_kk = VALUES(no_kk)';
                            if (! $this->db->query($sql)) {
                                $pesan .= "Pesan Gagal : Baris {$nomor_baris} Data penduduk dengan NIK : {$nik} gagal disimpan</br>";
                                $gagal++;
                                $outp = false;

                                continue;
                            }
                        }
                    } else {
                        $pesan .= "Pesan Gagal : Baris {$nomor_baris} Data penduduk dengan NIK : {$nik} tidak ditemukan</br>";
                        $gagal++;
                        $outp = false;
                    }
                }
                $berhasil = ($nomor_baris - $gagal);
                $pesan .= "Jumlah Berhasil : {$berhasil} </br>";
                $pesan .= "Jumlah Gagal : {$gagal} </br>";
                $pesan .= "Jumlah Data : {$nomor_baris} </br>";

                break;
            }

            return session_error('-> File impor tidak sesuai');
        }
        $reader->close();
        $this->session->set_flashdata('pesan_rtm', $pesan);

        return status_sukses($outp, false, 'Terjadi kesalahan impor data RTM');
    }

    private function cekPenduduk($nik = '')
    {
        return $this->db
            ->select('id', 'nama')
            ->where('nik', $nik)
            ->get('tweb_penduduk')
            ->row_array();
    }
}

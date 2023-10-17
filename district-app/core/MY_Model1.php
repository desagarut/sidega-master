<?php defined('BASEPATH') || exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->driver('cache');
    }

    // Konversi url menu menjadi slug tanpa mengubah data
    public function menu_slug($url)
    {
        $this->load->model('first_artikel_m');

        $cut = explode('/', $url);

        switch ($cut[0]) {
            case 'artikel':

                $data = $this->first_artikel_m->get_artikel($cut[1]);
                $url  = ($data) ? ($cut[0] . '/' . buat_slug($data)) : ($url);
                break;

            case 'kategori':
                $data = $this->first_artikel_m->get_kategori($cut[1]);
                $url  = ($data) ? ('artikel/' . $cut[0] . '/' . $data['slug']) : ($url);
                break;

            case 'data-suplemen':
                $this->load->model('suplemen_model');
                $data = $this->suplemen_model->get_suplemen($cut[1]);
                $url  = ($data) ? ($cut[0] . '/' . $data['slug']) : ($url);
                break;

            case 'data-kelompok':
                $this->load->model('kelompok_model');
                $data = $this->kelompok_model->get_kelompok($cut[1]);
                $url  = ($data) ? ($cut[0] . '/' . $data['slug']) : ($url);
                break;

            /*
             * TODO : Jika semua link pada tabel menu sudah tdk menggunakan first/ lagi
             * Ganti hapus case dibawah ini yg datanya diambil dari tabel menu dan ganti default adalah $url;
             */

            case 'arsip':
            case 'peraturan_desa':
            case 'data_analisis':
            case 'ambil_data_covid':
            case 'informasi_publik':
            case 'load_aparatur_desa':
            case 'load_apbdes':
            case 'load_aparatur_wilayah':
            case 'peta':
            case 'data-wilayah':
            case 'status-idm':
            case 'status-sdgs':
            case 'lapak':
            case 'pembangunan':
            case 'galeri':
            case 'pengaduan':
                break;

            default:
                $url = 'first/' . $url;
                break;
        }

        return site_url($url);
    }

    public function autocomplete_str($kolom, $tabel, $cari = '')
    {
        if ($cari) {
            $this->db->like($kolom, $cari);
        }
        $data = $this->db->distinct()->
            select($kolom)->
            order_by($kolom)->
            get($tabel)->result_array();

        return autocomplete_data_ke_str($data);
    }

    /**
     * Autocomple str union query.
     *
     * ```php
     * $list_kode = [
     *     ['field_1', $table, $where, $cari],
     *     ['field_2', $table, $where, $cari],
     *     ['field_3', $table, $where, $cari],
     * ];
     *
     * $joins = [
     *     [$table2, "{$table2}.id = {$table}.id", "right"],
     * ];
     * ```
     *
     * @param array $list_kode
     * @param array $joins
     *
     * @return array
     */
    public function union($list_kode = [], $joins = [])
    {
        $sql = [];

        foreach ($list_kode as $kode) {
            if ($joins) {
                foreach ($joins as $val) {
                    [$join, $cond, $type] = $val;

                    $this->db->join($join, $cond, $type);
                }
            }

            [$kolom, $table, $where, $cari] = $kode;

            $sql[] = "({$this->db->select($kolom)->from($table)->where($where)->like($kolom, $cari)->order_by($kolom, 'desc')->get_compiled_select()})";
        }

        $sql = implode('UNION', $sql);

        return $this->db->query($sql)->result_array();
    }

    public function hapus_indeks($tabel, $indeks)
    {
        if ($this->cek_indeks($tabel, $indeks)) {
            return $this->db->query("DROP INDEX {$indeks} ON {$tabel}");
        }

        return true;
    }

    public function tambah_indeks($tabel, $kolom, $index = 'UNIQUE')
    {
        if ($index == 'UNIQUE') {
            $duplikat = $this->db
                ->select($kolom)
                ->from($tabel)
                ->group_by($kolom)
                ->having("COUNT(`{$kolom}`) > 1")
                ->get()
                ->num_rows();

            if ($duplikat > 0) {
                session_error('--> Silahkan Cek <a href="' . site_url('info_sistem') . '">Info Sistem > Log</a>.');
                log_message('error', "Data kolom {$kolom} pada tabel {$tabel} ada yang duplikat dan perlu diperbaiki sebelum migrasi dilanjutkan.");

                return false;
            }
        }

        if (! $this->cek_indeks($tabel, $kolom)) {
            return $this->db->query("ALTER TABLE {$tabel} ADD {$index} {$kolom} (`{$kolom}`)");
        }

        return true;
    }

    public function cek_indeks($tabel, $kolom)
    {
        $db = $this->db->database;

        return $this->db
            ->select('COUNT(index_name) as ada')
            ->from('INFORMATION_SCHEMA.STATISTICS')
            ->where('table_schema', $db)
            ->where('table_name', $tabel)
            ->where('index_name', $kolom)
            ->get()->row()->ada;
    }

    public function tambah_modul($modul)
    {
        // Modul
        $sql = $this->db->insert_string('setting_modul', $modul) . ' ON DUPLICATE KEY UPDATE modul = VALUES(modul), url = VALUES(url), ikon = VALUES(ikon), hidden = VALUES(hidden), urut = VALUES(urut), parent = VALUES(parent)';

        $hasil = $this->db->query($sql);

        // Hak Akses Default Operator
        // Hanya lakukan jika tabel grup_akses sudah ada. Tabel ini belum ada sebelum Migrasi_fitur_premium_2105.php
        if ($this->db->table_exists('grup_akses')) {
            $hasil = $hasil && $this->grup_akses(2, $modul['id'], 3);
        }

        // Hapus cache menu navigasi
        $this->cache->hapus_cache_untuk_semua('_cache_modul');

        return $hasil;
    }

    public function grup_akses($id_grup, $id_modul, $akses)
    {
        return $this->db->insert('grup_akses', ['id_grup' => $id_grup, 'id_modul' => $id_modul, 'akses' => $akses]);
    }

    /**
     * Ubah modul setting menu.
     *
     * @return bool
     */
    public function ubah_modul(int $id, array $modul)
    {
        $hasil = $this->db
            ->where('id', $id)
            ->update('setting_modul', $modul);

        // Hapus cache menu navigasi
        $this->cache->hapus_cache_untuk_semua('_cache_modul');

        return $hasil;
    }

    public function tambah_setting($setting)
    {
        $sql = $this->db->insert_string('setting_aplikasi', $setting) . ' ON DUPLICATE KEY UPDATE keterangan = VALUES(keterangan), jenis = VALUES(jenis), kategori = VALUES(kategori)';

        return $this->db->query($sql);
    }

    // fungsi untuk format paginasi
    public function paginasi($page = 1, $jml_data = 0)
    {
        $this->load->library('paging');
        $cfg['page']      = $page;
        $cfg['per_page']  = $this->session->per_page ?? 10;
        $cfg['num_links'] = 10;
        $cfg['num_rows']  = $jml_data;
        $this->paging->init($cfg);

        return $this->paging;
    }

    // Buat FOREIGN KEY $nama_constraint $di_tbl untuk $fk menunjuk $ke_tbl di $ke_kolom
    public function tambah_foreign_key($nama_constraint, $di_tbl, $fk, $ke_tbl, $ke_kolom)
    {
        $query = $this->db
            ->from('INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS')
            ->where('CONSTRAINT_NAME', $nama_constraint)
            ->where('TABLE_NAME', $di_tbl)
            ->get();
        $hasil = true;
        if ($query->num_rows() == 0) {
            $hasil = $hasil && $this->dbforge->add_column($di_tbl, [
                "CONSTRAINT `{$nama_constraint}` FOREIGN KEY (`{$fk}`) REFERENCES `{$ke_tbl}` (`{$ke_kolom}`) ON DELETE CASCADE ON UPDATE CASCADE",
            ]);
        }

        return $hasil;
    }

    public function jalankan_migrasi($migrasi)
    {
        if (in_array($migrasi, $this->session->daftar_migrasi)) {
            return true;
        }

        $this->load->model('migrations/' . $migrasi);
        $_SESSION['daftar_migrasi'][] = $migrasi;
        if ($this->{$migrasi}->up()) {
            log_message('error', 'Berhasil Jalankan ' . $migrasi);

            return true;
        }

        log_message('error', 'Gagal Jalankan ' . $migrasi);

        return false;
    }
}

<?php defined('BASEPATH') || exit('No direct script access allowed');

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class Database extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['import_model', 'export_model', 'database_model']);
        $this->modul_ini     = 11;
        $this->sub_modul_ini = 45;
    }

    public function clear()
    {
        redirect('export');
    }

    public function index()
    {
        // Untuk development: menghapus session tracking. Tidak ada kaitan dengan database.
        // Di sini untuk kemudahan saja.
        // TODO: cari tempat yang lebih cocok
        if (defined('ENVIRONMENT') && ENVIRONMENT == 'development') {
            log_message('debug', 'Reset tracking');
            unset($_SESSION['track_web'], $_SESSION['track_admin'], $_SESSION['siteman_timeout']);
        }

        $data['act_tab'] = 1;
        $data['content'] = 'export/exp';
        $this->load->view('database/database.tpl.php', $data);
    }

    public function import()
    {
        if (config_item('demo_mode')) {
            redirect($this->controller);
        }

        $data['form_action']          = site_url('database/import_dasar');
        $data['form_action3']         = site_url('database/ppls_individu');
        $data['boleh_hapus_penduduk'] = $this->import_model->boleh_hapus_penduduk();

        $data['act_tab'] = 2;
        $data['content'] = 'import/imp';
        $this->load->view('database/database.tpl.php', $data);
    }

    public function import_bip()
    {
        if (config_item('demo_mode')) {
            redirect($this->controller);
        }

        $data['form_action']          = site_url('database/import_data_bip');
        $data['boleh_hapus_penduduk'] = $this->import_model->boleh_hapus_penduduk();

        $data['act_tab'] = 3;
        $data['content'] = 'import/bip';
        $this->load->view('database/database.tpl.php', $data);
    }

    public function migrasi_cri()
    {
        $data['form_action'] = site_url('database/migrasi_db_cri');

        $data['act_tab'] = 5;
        $data['content'] = 'database/migrasi_cri';
        $this->load->view('database/database.tpl.php', $data);
    }

    public function backup()
    {
        $data['form_action'] = site_url('database/restore');

        $data['act_tab'] = 4;
        $data['content'] = 'database/backup';
        $this->load->view('database/database.tpl.php', $data);
    }

    public function kosongkan()
    {
        if (config_item('demo_mode')) {
            redirect($this->controller);
        }

        $data['act_tab'] = 6;
        $data['content'] = 'database/kosongkan';
        $this->load->view('database/database.tpl.php', $data);
    }

    // $opendk - tidak kosong untuk header sesuai dengan format impor OpenDK
    public function export_excel()
    {
        $writer = WriterEntityFactory::createXLSXWriter();

        //Nama File
        $tgl      = date('d_m_Y');
        $fileName = 'penduduk_' . $tgl . '.xlsx';
        $writer->openToBrowser($fileName); // stream data directly to the browser

        //Header Tabel
        $daftar_kolom = [
            ['Alamat', 'alamat'],
            ['Dusun', 'dusun'],
            ['RW', 'rw'],
            ['RT', 'rt'],
            ['Nama', 'nama'],
            ['Nomor KK', 'nomor_kk'],
            ['Nomor NIK', 'nomor_nik'],
            ['Jenis Kelamin', 'jenis_kelamin'],
            ['Tempat Lahir', 'tempat_lahir'],
            ['Tanggal Lahir', 'tanggal_lahir'],
            ['Agama', 'agama'],
            ['Pendidikan (dlm KK)', 'pendidikan_dlm_kk'],
            ['Pendidikan (sdg ditempuh)', 'pendidikan_sdg_ditempuh'],
            ['Pekerjaan', 'pekerjaan'],
            ['Kawin', 'kawin'],
            ['Hub. Keluarga', 'hubungan_keluarga'],
            ['Kewarganegaraan', 'kewarganegaraan'],
            ['Nama Ayah', 'nama_ayah'],
            ['Nama Ibu', 'nama_ibu'],
            ['Gol. Darah', 'gol_darah'],
            ['Akta Lahir', 'akta_lahir'],
            ['Nomor Dokumen Paspor', 'nomor_dokumen_pasport'],
            ['Tanggal Akhir Paspor', 'tanggal_akhir_pasport'],
            ['Nomor Dokumen KITAS', 'nomor_dokumen_kitas'],
            ['NIK Ayah', 'nik_ayah'],
            ['NIK Ibu', 'nik_ibu'],
            ['Nomor Akta Perkawinan', 'nomor_akta_perkawinan'],
            ['Tanggal Perkawinan', 'tanggal_perkawinan'],
            ['Nomor Akta Perceraian', 'nomor_akta_perceraian'],
            ['Tanggal Perceraian', 'tanggal_perceraian'],
            ['Cacat', 'cacat'],
            ['Cara KB', 'cara_kb'],
            ['Hamil', 'hamil'],
            ['KTP-el', 'ktp_el'],
            ['Status Rekam', 'status_rekam'],
            ['Alamat Sekarang', 'alamat_sekarang'],
            ['Status Dasar', 'status_dasar'],
            ['Suku', 'suku'],
            ['Tag ID Card', 'tag_id_card'],
            ['Asuransi', 'asuransi'],
            ['No Asuransi', 'no_asuransi'],
        ];

        $judul  = array_column($daftar_kolom, 0);
        $header = WriterEntityFactory::createRowFromArray($judul);
        $writer->addRow($header);

        //Isi Tabel
        $get = $this->export_model->export_excel();

        foreach ($get as $row) {
            $penduduk = [
                $row->alamat,
                $row->dusun,
                $row->rw,
                $row->rt,
                $row->nama,
                $row->no_kk,
                $row->nik,
                $row->sex,
                $row->tempatlahir,
                $row->tanggallahir,
                $row->agama_id,
                $row->pendidikan_kk_id,
                $row->pendidikan_sedang_id,
                $row->pekerjaan_id,
                $row->status_kawin,
                $row->kk_level,
                $row->warganegara_id,
                $row->nama_ayah,
                $row->nama_ibu,
                $row->golongan_darah_id,
                $row->akta_lahir,
                $row->dokumen_pasport,
                $row->tanggal_akhir_pasport,
                $row->dokumen_kitas,
                $row->ayah_nik,
                $row->ibu_nik,
                $row->akta_perkawinan,
                $row->tanggalperkawinan,
                $row->akta_perceraian,
                $row->tanggalperceraian,
                $row->cacat_id,
                $row->cara_kb_id,
                $row->hamil,
                $row->ktp_el,
                $row->status_rekam,
                $row->alamat_sekarang,
                $row->status_dasar,
                $row->suku,
                $row->tag_id_card,
                $row->asuransi,
                $row->no_asuransi,
            ];
            $rowFromValues = WriterEntityFactory::createRowFromArray($penduduk);
            $writer->addRow($rowFromValues);
        }
        $writer->close();
    }

    public function export_dasar()
    {
        $this->export_model->export_dasar();
    }

    public function import_dasar()
    {
        $this->redirect_hak_akses('u');
        $hapus = isset($_POST['hapus_data']);
        $this->import_model->import_excel($hapus);
        redirect('database/import');
    }

    public function import_data_bip()
    {
        $this->redirect_hak_akses('u');
        $hapus = isset($_POST['hapus_data']);
        $this->import_model->import_bip($hapus);
        redirect('database/import_bip');
    }

    public function migrasi_db_cri()
    {
        $this->redirect_hak_akses('u');
        $this->session->unset_userdata(['success, error_msg']);
        $this->database_model->migrasi_db_cri();
        redirect('database/migrasi_cri');
    }

    public function kosongkan_db()
    {
        $this->redirect_hak_akses('h');
        $this->database_model->kosongkan_db();
        redirect('database/kosongkan');
    }

    // Impor Pengelompokan Data Rumah Tangga
    public function ppls_individu()
    {
        $this->redirect_hak_akses('u');
        $this->import_model->pbdt_individu(isset($_POST['hapus_rtm']));
        redirect("{$this->controller}/import");
    }

    public function exec_backup()
    {
        $this->export_model->backup();
    }

    public function desa_backup()
    {
        $this->load->library('zip');

        $backup_folder = FCPATH . 'instansi/'; // Folder yg akan di backup
        $this->zip->read_dir($backup_folder, false);
        $this->zip->download('backup_folder_instansi_' . date('Y_m_d') . '.zip');
    }

    public function restore()
    {
        $this->redirect_hak_akses('h');

        try {
            $this->session->success        = 1;
            $this->session->error_msg      = '';
            $this->session->sedang_restore = 1;
            $this->export_model->restore();
        } catch (Exception $e) {
            $this->session->success   = -1;
            $this->session->error_msg = $e->getMessage();
        } finally {
            $this->session->sedang_restore = 0;
            redirect('database/backup');
        }
    }

    public function export_csv()
    {
        $data['main'] = $this->export_model->export_csv();
        $this->load->view('export/penduduk_csv', $data);
    }

    // Dikhususkan untuk server yg hanya digunakan untuk web publik
    public function acak()
    {
        $this->redirect_hak_akses('u');
        if ($this->setting->penggunaan_server != 6) {
            return;
        }

        $this->load->model('acak_model');
        echo $this->load->view('database/hasil_acak', '', true);
        $hasil = $this->acak_model->acak_penduduk();
        $hasil = $hasil && $this->acak_model->acak_keluarga();
        echo $this->load->view('database/hasil_acak', '', true);
    }

    // Digunakan untuk server yg hanya digunakan untuk web publik
    public function mutakhirkan_data_server()
    {
        $this->redirect_hak_akses('u');
        $this->session->error_msg = null;
        if ($this->setting->penggunaan_server != 6) {
            return;
        }
        $this->load->view('database/ajax_sinkronkan');
    }

    public function proses_sinkronkan()
    {
        $this->redirect_hak_akses('u');
        $this->load->model('sinkronisasi_model');

        $this->load->library('upload');

        $config['upload_path']   = LOKASI_SINKRONISASI_ZIP;
        $config['allowed_types'] = 'zip';
        $config['overwrite']     = true;
        //$config['max_size']				= max_upload() * 1024;
        $config['file_name'] = namafile('sinkronisasi');

        $this->upload->initialize($config);

        if (! $this->upload->do_upload('sinkronkan')) {
            status_sukses(false, false, $this->upload->display_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }

        $hasil = $this->sinkronisasi_model->sinkronkan();
        status_sukses($hasil);
        redirect($_SERVER['HTTP_REFERER']);
    }
}

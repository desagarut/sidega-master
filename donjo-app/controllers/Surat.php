<?php defined('BASEPATH') || exit('No direct script access allowed');

class Surat extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('penduduk_model');
        $this->load->model('keluarga_model');
        $this->load->model('surat_model');
        $this->load->model('keluar_model');
        $this->load->model('referensi_model');
        $this->load->model('penomoran_surat_model');
        $this->load->model('permohonan_surat_model');
		$this->modul_ini = 15;
		$this->sub_modul_ini = 31;
    }

    public function index()
    {
        $data['menu_surat']    = $this->surat_model->list_surat();
        $data['menu_surat2']   = $this->surat_model->list_surat2();
        $data['surat_favorit'] = $this->surat_model->list_surat_fav();

        // Reset untuk surat yang menggunakan session variable
        unset($_SESSION['id_pria'], $_SESSION['id_wanita'], $_SESSION['id_ibu'], $_SESSION['id_bayi'], $_SESSION['id_saksi1'], $_SESSION['id_saksi2'], $_SESSION['id_pelapor'], $_SESSION['id_diberi_izin'], $_SESSION['post'], $_SESSION['id_pemberi_kuasa'], $_SESSION['id_penerima_kuasa'], $_SESSION['qrcode']);

        $this->render('surat/format_surat', $data);
    }

    public function panduan()
    {
        $this->sub_modul_ini = 33;

        $this->render('surat/panduan');
    }

    public function form($url = '', $clear = '')
    {
        $data['url']    = $url;
        $data['anchor'] = $this->input->post('anchor');
        if (! empty($_POST['nik'])) {
            $data['individu'] = $this->surat_model->get_penduduk($_POST['nik']);
            $data['anggota']  = $this->keluarga_model->list_anggota($data['individu']['id_kk'], ['dengan_kk' => true], true);
        } else {
            $data['individu'] = null;
            $data['anggota']  = null;
        }
        $this->get_data_untuk_form($url, $data);

        $data['surat_url']    = rtrim($_SERVER['REQUEST_URI'], '/clear');
        $data['form_action']  = site_url("surat/doc/{$url}");
        $data['masa_berlaku'] = $this->surat_model->masa_berlaku_surat($url);

        $this->render('surat/form_surat', $data);
    }

    public function periksa_doc($id, $url)
    {
        // Ganti status menjadi 'Menunggu Tandatangan'
        $this->permohonan_surat_model->proses($id, 2);
        $this->cetak_doc($url);
    }

    public function doc($url = '')
    {
        $this->load->config('develbar', false);
        $this->cetak_doc($url);
        $this->load->config('develbar', true);
    }

    private function cetak_doc($url)
    {
        $format                 = $this->surat_model->get_surat($url);
        $log_surat['url_surat'] = $format['id'];
        $log_surat['id_pamong'] = $_POST['pamong_id'];
        $log_surat['id_user']   = $_SESSION['user'];
        $log_surat['no_surat']  = $_POST['nomor'];
        $id                     = $_POST['nik'];
        $keperluan              = $_POST['keperluan'];
        $keterangan             = $_POST['keterangan'];


        switch ($url) {
            case 'surat_ket_kelahiran':
                // surat_ket_kelahiran id-nya ibu atau bayi
                if (! $id) { $id = $_SESSION['id_ibu'];}
                if (! $id) { $id = $_SESSION['id_bayi'];}
                break;

            case 'surat_ket_nikah':
                // id-nya calon pasangan pria atau wanita
                if (! $id) { $id = $_POST['id_pria'];}
                if (! $id) { $id = $_POST['id_wanita'];}
                break;

            case 'surat_kuasa':
                // id-nya pemberi kuasa atau penerima kuasa
                if (! $id) { $id = $_POST['id_pemberi_kuasa'];}
                if (! $id) { 
                    $id = $_POST['id_penerima_kuasa'];
                }
                break;

            default:
                // code...
                break;
        }

        if ($id) {
            $log_surat['id_pend'] = $id;
            $nik                  = $this->db->select('nik')->where('id', $id)->get('tweb_penduduk')
                ->row()->nik;
        } else {
            // Surat untuk non-warga
            $log_surat['nama_non_warga'] = $_POST['nama_non_warga'];
            $log_surat['nik_non_warga']  = $_POST['nik_non_warga'];
            $nik                         = $log_surat['nik_non_warga'];
        }

        $log_surat['keterangan']    = $keterangan ?: $keperluan;
        $log_surat['keperluan']     = $keperluan;

        $nama_surat                 = $this->keluar_model->nama_surat_arsip($url, $nik, $_POST['nomor']);
        $log_surat['nama_surat']    = $nama_surat;
        if ($format['lampiran']) {
            $lampiran               = pathinfo($nama_surat, PATHINFO_FILENAME) . '_lampiran.pdf';
            $log_surat['lampiran']  = $lampiran;
        }
        $this->keluar_model->log_surat($log_surat);

        $nama_surat = $this->surat_model->buat_surat($url, $nama_surat, $lampiran);

        if (function_exists('exec') && $this->input->post('submit_cetak') == 'cetak_pdf') {
            $nama_surat = $this->surat_model->rtf_to_pdf($nama_surat);
        }

        if ($lampiran) {
            $this->load->library('zip');

            $this->zip->read_file(LOKASI_ARSIP . $nama_surat);
            $this->zip->read_file(LOKASI_ARSIP . $lampiran);
            $this->zip->download(pathinfo($nama_surat, PATHINFO_FILENAME) . '.zip');
        } else {
            ambilBerkas($nama_surat, $this->controller);
        }
    }

    public function nomor_surat_duplikat()
    {
        $hasil = $this->penomoran_surat_model->nomor_surat_duplikat('log_surat', $_POST['nomor'], $_POST['url']);
        echo $hasil ? 'false' : 'true';
    }

    public function search()
    {
        $cari = $this->input->post('nik');
        if ($cari != '') {
            redirect("surat/form/{$cari}");
        } else {
            redirect('surat');
        }
    }

    private function get_data_untuk_form($url, &$data)
    {
        $this->session->unset_userdata('qrcode');
        $this->load->model('pamong_model');
        $data['surat_terakhir']     = $this->surat_model->get_last_nosurat_log($url);
        $data['surat']              = $this->surat_model->get_surat($url);
        $data['config']             = $this->config_model->get_data();
        $data['input']              = $this->input->post();
        $data['input']['nomor']     = $data['surat_terakhir']['no_surat_berikutnya'];
        $data['format_nomor_surat'] = $this->penomoran_surat_model->format_penomoran_surat($data);
        $data['lokasi']             = $this->config_model->get_data();
        $data['penduduk']           = $this->surat_model->list_penduduk();
        $data['pamong']             = $this->surat_model->list_pamong();
        $pamong_ttd                 = $this->pamong_model->get_ttd();
        $pamong_ub                  = $this->pamong_model->get_ub();
        $data['perempuan']          = $this->surat_model->list_penduduk_perempuan();
        if ($pamong_ttd) {
            $str_ttd             = ucwords($pamong_ttd['jabatan'] . ' ' . $data['lokasi']['nama_desa']);
            $data['atas_nama'][] = "a.n {$str_ttd}";
            if ($pamong_ub) {
                $data['atas_nama'][] = "u.b {$pamong_ub['jabatan']}";
            }
        }
        $data_form = $this->surat_model->get_data_form($url);
        if (is_file($data_form)) {
            include $data_form;
        }
    }

    public function favorit($id = 0, $k = 0)
    {
        $this->redirect_hak_akses('u', $_SERVER['HTTP_REFERER']);
        $this->load->model('surat_master_model');
        $this->surat_master_model->favorit($id, $k);
        redirect('surat');
    }

    /*
        Ajax POST data:
        url -- url surat
        nomor -- nomor surat
    */
    public function format_nomor_surat()
    {
        $data['surat']          = $this->surat_model->get_surat($this->input->post('url'));
        $data['input']['nomor'] = $this->input->post('nomor');
        $format_nomor           = $this->penomoran_surat_model->format_penomoran_surat($data);
        echo json_encode($format_nomor);
    }

    /*
        Ajax url query data:
        q -- kata pencarian
        page -- nomor paginasi
    */
    public function list_penduduk_ajax()
    {
        $cari          = $this->input->get('q');
        $page          = $this->input->get('page');
        $filter_sex    = $this->input->get('filter_sex');
        $filter['sex'] = ($filter_sex == 'perempuan') ? 2 : $filter_sex;
        $penduduk      = $this->surat_model->list_penduduk_ajax($cari, $filter, $page);
        echo json_encode($penduduk);
    }

    // list untuk dropdown arsip layanan tampil hanya yg bersurat saja
    public function list_penduduk_bersurat_ajax()
    {
        $cari     = $this->input->get('q');
        $page     = $this->input->get('page');
        $penduduk = $this->surat_model->list_penduduk_bersurat_ajax($cari, $page);
        echo json_encode($penduduk);
    }
}

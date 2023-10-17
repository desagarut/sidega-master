<?php defined('BASEPATH') || exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    // Common data
    public $user;
    public $settings;
    public $includes;
    public $current_uri;
    public $theme;
    public $template;
    public $error;
    public $header;

    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->controller = strtolower($this->router->fetch_class());
        $this->setting_model->init();
        $this->header = $this->config_model->get_data();
    }

    // Bersihkan session cluster wilayah
    public function clear_cluster_session()
    {
        $cluster_session = ['dusun', 'rw', 'rt'];

        foreach ($cluster_session as $session) {
            $this->session->unset_userdata($session);
        }
    }

    public function json_output($parm, $header = 200)
    {
        $this->output
            ->set_status_header($header)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($parm))
            ->_display();

        exit();
    }
}

class Web_Controller extends MY_Controller
{
    // Constructor
    public function __construct()
    {
        parent::__construct();
        // Gunakan tema klasik kalau setting tema kosong atau folder di desa/themes untuk tema pilihan tidak ada
        // if (empty($this->setting->web_theme) OR !is_dir(FCPATH.'instansi/themes/'.$this->setting->web_theme))
        $theme        = preg_replace('/instansi\\//', '', strtolower($this->setting->web_theme));
        $theme_folder = preg_match('/instansi\\//', strtolower($this->setting->web_theme)) ? 'instansi/themes' : 'themes';
        if (empty($this->setting->web_theme) || !is_dir(FCPATH . $theme_folder . '/' . $theme)) {
            $this->theme        = 'bodas';
            $this->theme_folder = 'themes';
        } else {
            $this->theme        = $theme;
            $this->theme_folder = $theme_folder;
        }
        // Variabel untuk tema
        $this->template                  = "../../{$this->theme_folder}/{$this->theme}/template.php";
        $this->includes['folder_themes'] = '../../' . $this->theme_folder . '/' . $this->theme;

        $this->load->model('web_menu_model');
    }

    /*
     * Jika file theme/view tidak ada, gunakan file klasik/view
     * Supaya tidak semua layout atau partials harus diulangi untuk setiap tema
     */
    public static function fallback_default($theme, $view)
    {
        $view         = trim($view, '/');
        $theme_folder = self::get_instance()->theme_folder;
        $theme_view   = "../../{$theme_folder}/{$theme}/{$view}";

        if (!is_file(APPPATH . 'views/' . $theme_view)) {
            $theme_view = "../../themes/klasik/{$view}";
        }

        return $theme_view;
    }

    /**
     * Set Template
     * sometime, we want to use different template for different page
     * for example, 404 template, login template, full-width template, sidebar template, etc.
     * so, use this function
     * --------------------------------------
     *
     * @since	Version 3.1.0
     *
     * @param	string, template file name
     * @param mixed $template_file
     *
     * @return chained object
     */
    public function set_template($template_file = 'template.php')
    {
        // make sure that $template_file has .php extension
        $template_file = substr($template_file, -4) == '.php' ? $template_file : ($template_file . '.php');

        $template_file_path = FCPATH . $this->theme_folder . '/' . $this->theme . '/' . $template_file;
        if (is_file($template_file_path)) {
            $this->template = "../../{$this->theme_folder}/{$this->theme}/{$template_file}";
        } else {
            $this->template = '../../themes/klasik/' . $template_file;
        }
    }

    public function _get_common_data(&$data)
    {
        $this->load->library('statistik_pengunjung');

        $this->load->model('theme_model');
        $this->load->model('first_menu_m');
        $this->load->model('teks_berjalan_model');
        $this->load->model('first_artikel_m');
        $this->load->model('web_widget_model');
        $this->load->model('anjungan_model');
        $this->load->model('keuangan_grafik_manual_model');
        $this->load->model('keuangan_grafik_model');
        $this->load->model('pengaduan_model');

        // Counter statistik pengunjung
        $this->statistik_pengunjung->counter_visitor();

        // Data statistik pengunjung
        $data['statistik_pengunjung'] = $this->statistik_pengunjung->get_statistik();

        $data['latar_website'] = $this->theme_model->latar_website();
        $data['desa']          = $this->header;
        $data['menu_atas']     = $this->first_menu_m->list_menu_atas();
        $data['menu_kiri']     = $this->first_menu_m->list_menu_kiri();
        $data['teks_berjalan'] = $this->teks_berjalan_model->list_data(true);
        $data['slide_artikel'] = $this->first_artikel_m->slide_show();
        $data['slider_gambar'] = $this->first_artikel_m->slider_gambar();
        $data['w_cos']         = $this->web_widget_model->get_widget_aktif();
        $data['cek_anjungan']  = $this->anjungan_model->cek_anjungan();

        $this->web_widget_model->get_widget_data($data);
        $data['data_config'] = $this->header;
        if ($this->setting->apbdes_footer && $this->setting->apbdes_footer_all) {
            $data['transparansi'] = $this->setting->apbdes_manual_input
                ? $this->keuangan_grafik_manual_model->grafik_keuangan_tema()
                : $this->keuangan_grafik_model->grafik_keuangan_tema();
        }
        // Pembersihan tidak dilakukan global, karena artikel yang dibuat oleh
        // petugas terpecaya diperbolehkan menampilkan <iframe> dsbnya..
        $list_kolom = [
            'arsip',
            'w_cos',
        ];

        foreach ($list_kolom as $kolom) {
            $data[$kolom] = $this->security->xss_clean($data[$kolom]);
        }
    }
}

class Mandiri_Controller extends MY_Controller
{
    public $cek_anjungan;
    public $is_login;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('anjungan_model');
        $this->cek_anjungan = $this->anjungan_model->cek_anjungan();
        $this->is_login     = $this->session->is_login;

        if ($this->setting->layanan_mandiri == 0 && !$this->cek_anjungan) {
            show_404();
        }

        if ($this->session->mandiri != 1) {
            if (!$this->session->login_ektp) {
                redirect('layanan-mandiri/masuk');
            } else {
                redirect('layanan-mandiri/masuk-ektp');
            }
        }
    }

    public function render($view, ?array $data = null)
    {
        $data['desa']         = $this->header;
        $data['cek_anjungan'] = $this->cek_anjungan;
        $data['konten']       = $view;
        $this->load->view(MANDIRI . '/template', $data);
    }
}

// Untuk API read-only, seperti Api_informasi_publik
class Api_Controller extends MY_Controller
{
    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    protected function log_request()
    {
        $message = 'API Request ' . $this->input->server('REQUEST_URI') . ' dari ' . $this->input->ip_address();
        log_message('error', $message);
    }
}

class Admin_Controller extends MY_Controller
{
    public $grup;
    public $CI;
    public $pengumuman;

    public function __construct()
    {
        parent::__construct();
        $this->CI = CI_Controller::get_instance();
        $this->load->model(['header_model', 'user_model', 'notif_model', 'referensi_model']);

        // Kalau sehabis periksa data, paksa harus login lagi
        if ($this->session->periksa_data == 1) {
            $this->user_model->logout();
        }

        $this->grup = $this->user_model->sesi_grup($_SESSION['sesi']);
        $this->load->model('modul_model');
        if (!$this->modul_model->modul_aktif($this->controller)) {
            session_error('Fitur ini tidak aktif');
            redirect($_SERVER['HTTP_REFERER']);
        }
        if (!$this->user_model->hak_akses($this->grup, $this->controller, 'b')) {
            if (empty($this->grup)) {
                $_SESSION['request_uri'] = $_SERVER['REQUEST_URI'];
                redirect('insidega');
            } else {
                session_error('Anda tidak mempunyai akses pada fitur itu');
                unset($_SESSION['request_uri']);
                redirect('main');
            }
        }
        $this->cek_pengumuman();
        $this->header                           = $this->header_model->get_data();
        $this->header['notif_permohonan_surat'] = $this->notif_model->permohonan_surat_baru();
        $this->header['notif_inbox']            = $this->notif_model->inbox_baru();
        $this->header['notif_komentar']         = $this->notif_model->komentar_baru();
        $this->header['notif_langganan']        = $this->notif_model->status_langganan();
    }

    private function cek_pengumuman()
    {
        if (config_item('demo_mode') || ENVIRONMENT === 'development') {
            return null;
        }

        // Hanya untuk user administrator
        if ($this->grup == 1) {
            $notifikasi = $this->notif_model->get_semua_notif();
            foreach ($notifikasi as $notif) {
                $this->pengumuman = $this->notif_model->notifikasi($notif);
                if ($notif['jenis'] == 'persetujuan') break;
            }
        }
    }

    // Untuk kasus di mana method controller berbeda hak_akses. Misalnya 'setting_qrcode' readonly, tetapi 'setting/analisis' boleh ubah
    protected function redirect_hak_akses_url($akses, $redirect = '', $controller = '')
    {
        if (empty($controller)) {
            $controller = $this->controller;
        }
        if (! $this->user_model->hak_akses_url($this->grup, $controller, $akses)) {
            session_error('Anda tidak mempunyai akses pada fitur ini');
            if (empty($this->grup)) {
                redirect('insidega');
            }
            empty($redirect) ? redirect($_SERVER['HTTP_REFERER']) : redirect($redirect);
        }
    }

    protected function redirect_hak_akses($akses, $redirect = '', $controller = '')
    {
        if (empty($controller)) {
            $controller = $this->controller;
        }
        if (! $this->user_model->hak_akses($this->grup, $controller, $akses)) {
            session_error('Anda tidak mempunyai akses pada fitur ini');
            if (empty($this->grup)) {
                redirect('insidega');
            }
            empty($redirect) ? redirect($_SERVER['HTTP_REFERER']) : redirect($redirect);
        }
    }

    // Untuk kasus di mana method controller berbeda hak_akses. Misalnya 'setting_qrcode' readonly, tetapi 'setting/analisis' boleh ubah
    public function cek_hak_akses_url($akses, $controller = '')
    {
        if (empty($controller)) {
            $controller = $this->controller;
        }

        return $this->user_model->hak_akses_url($this->grup, $controller, $akses);
    }

    public function cek_hak_akses($akses, $controller = '')
    {
        if (empty($controller)) {
            $controller = $this->controller;
        }

        return $this->user_model->hak_akses($this->grup, $controller, $akses);
    }

    public function redirect_tidak_valid($valid)
    {
        if ($valid) {
            return;
        }

        session_error('Aksi ini tidak diperbolehkan');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function render($view, ?array $data = null)
    {
        $this->load->view('header', $this->header);
        $this->load->view('nav');
        $this->load->view($view, $data);
        $this->load->view('footer');
    }
}

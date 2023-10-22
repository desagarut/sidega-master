<?php defined('BASEPATH') || exit('No direct script access allowed');

class Masuk extends Web_Controller
{
    private $cek_anjungan;

    public function __construct()
    {
        parent::__construct();
        mandiri_timeout();
        $this->session->login_ektp        = false;
        $this->session->daftar            = false;
        $this->session->daftar_verifikasi = false;
        $this->load->model(['anjungan_model', 'mandiri_model', 'theme_model']);
        if ($this->setting->layanan_mandiri == 0 && ! $this->cek_anjungan) {
            show_404();
        }
    }

    public function index()
    {
        if ($this->session->mandiri == 1) {
            redirect('layanan-mandiri');
        }
        $mac_address = $this->input->get('mac_address', true);
        $token       = $this->input->get('token_layanan', true);
        if ($mac_address && $token == $this->setting->layanan_opendesa_token) {
            $this->session->mac_address = $mac_address;
            redirect('layanan-mandiri');
        }

        //Initialize Session ------------
        $this->session->unset_userdata('balik_ke');
        if (! isset($this->session->mandiri)) {
            // Belum ada session variable
            $this->session->mandiri           = 0;
            $this->session->mandiri_try       = 4;
            $this->session->mandiri_wait      = 0;
            $this->session->login_ektp        = false;
            $this->session->daftar            = false;
            $this->session->daftar_verifikasi = false;
        }

        $data = [
            'header'              => $this->header,
            'latar_login_mandiri' => $this->theme_model->latar_login_mandiri(),
            'cek_anjungan'        => $this->anjungan_model->cek_anjungan($this->session->mac_address),
            'form_action'         => site_url('layanan-mandiri/cek'),
        ];

        if ($this->setting->tampilan_anjungan == 1) {
            $this->load->model('first_gallery_m');

            $data['daftar_album'] = $this->first_gallery_m->sub_gallery_show($this->setting->tampilan_anjungan_slider);
        }

        $this->load->view(MANDIRI . '/masuk', $data);
    }

    public function cek()
    {
        $this->mandiri_model->siteman();
        redirect('layanan-mandiri');
    }

    public function lupa_pin()
    {
        $data = [
            'header'              => $this->header,
            'latar_login_mandiri' => $this->theme_model->latar_login_mandiri(),
            'cek_anjungan'        => $this->anjungan_model->cek_anjungan($this->session->mac_address),
            'form_action'         => site_url('layanan-mandiri/cek-pin'),
        ];

        $this->load->view(MANDIRI . '/lupa_pin', $data);
    }

    public function cek_pin()
    {
        $nik = bilangan($this->input->post('nik'));
        $this->mandiri_model->cek_verifikasi($nik);

        redirect('layanan-mandiri/lupa-pin');
    }
}

<?php defined('BASEPATH') || exit('No direct script access allowed');

class Daftar extends Web_Controller
{
    public function __construct()
    {
        parent::__construct();
        mandiri_timeout();
        $this->session->daftar = true;
        $this->load->model(['mandiri_model', 'theme_model']);
        if (! $this->setting->tampilkan_pendaftaran) {
            redirect('layanan-mandiri/masuk');
        }
    }

    public function index()
    {
        if ($this->session->mandiri == 1) {
            redirect('layanan-mandiri');
        }

        //Initialize Session ------------
        $this->session->unset_userdata('balik_ke');
        if (! isset($this->session->mandiri)) {
            // Belum ada session variable
            $this->session->mandiri      = 0;
            $this->session->mandiri_try  = 4;
            $this->session->mandiri_wait = 0;
            $this->session->daftar       = true;
        }

        $data = [
            'header'              => $this->header,
            'latar_login_mandiri' => $this->theme_model->latar_login_mandiri(),
            'form_action'         => site_url('layanan-mandiri/proses-daftar'),
        ];

        $this->load->view(MANDIRI . '/masuk', $data);
    }

    //Prosess Pendaftaran
    public function proses_daftar()
    {
        $post              = $this->input->post();
        $data['nama']      = $post['daftar_nama'];
        $data['nik']       = $post['daftar_nik'];
        $data['kk']        = $post['daftar_kk'];
        $data['tgl_lahir'] = date('Y-m-d', strtotime($post['daftar_tgl_lahir']));
        $data['pin1']      = $post['daftar_pin1'];
        $data['pin2']      = $post['daftar_pin2'];

        if ($data['pin1'] == $data['pin2']) {
            $this->mandiri_model->pendaftaran_mandiri($data);
        } else {
            $respon = [
                'status' => -1,
                'pesan'  => 'Mohon Maaf, PIN yang dimasukan tidak sama',
            ];
            $this->session->set_flashdata('info_pendaftaran', $respon);
        }
        redirect('layanan-mandiri/daftar');
    }
}

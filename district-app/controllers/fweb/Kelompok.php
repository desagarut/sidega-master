<?php defined('BASEPATH') || exit('No direct script access allowed');

class Kelompok extends Web_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kelompok_model');
    }

    public function detail($slug = null)
    {
        $id = $this->kelompok_model->slug($slug);

        if (! $this->web_menu_model->menu_aktif('data-kelompok/' . $id)) {
            show_404();
        }

        $data = $this->includes;

        $data['detail']   = $this->kelompok_model->get_kelompok($id);
        $data['title']    = 'Data Kelompok ' . $data['detail']['nama'];
        $data['pengurus'] = $this->kelompok_model->list_pengurus($id);
        $data['anggota']  = $this->kelompok_model->list_anggota($id, $sub = 'anggota');

        // Jika kelompok tdk tersedia / sudah terhapus pd modul kelompok
        if ($data['detail'] == null) {
            show_404();
        }

        $this->_get_common_data($data);
        $this->set_template('layouts/kelompok.tpl.php');
        $this->load->view($this->template, $data);
    }
}

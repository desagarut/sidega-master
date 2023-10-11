<?php defined('BASEPATH') || exit('No direct script access allowed');

class Ba_inventaris_kekayaan extends Admin_Controller
{
    private $list_session = ['tahun'];

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['pamong_model', 'inventaris_laporan_model']);
        $this->modul_ini     = 15;
        $this->sub_modul_ini = 301;
        $header['minsidebar'] = 1;
    }

    public function index()
    {
        $tahun  = (empty($this->session->tahun) || $this->session->tahun == 'semua') ? date('Y') : $this->session->tahun;
        $pamong = $this->pamong_model->list_data();

        // $this->json_output($tahun);

        $data = [
            'subtitle'     => 'Buku Inventaris dan Kekayaan Desa',
            'selected_nav' => 'inventaris',
            'main_content' => 'ba/umum/content_inventaris',
            'min_tahun'    => $this->inventaris_laporan_model->min_tahun(),
            'data'         => $this->inventaris_laporan_model->permen_47($tahun, null),
            'kades'        => $data['sekdes'] = $pamong,
            'sekdes'       => $data['sekdes'] = $pamong,
            'tahun'        => $this->session->tahun,
        ];
        $this->render('ba/umum/main', $data);
    }

    public function filter($filter)
    {
        $value = $this->input->post($filter);
        if ($value != '') {
            $this->session->{$filter} = $value;
        } else {
            $this->session->unset_userdata($filter);
        }
        redirect('ba_inventaris_kekayaan');
    }
}

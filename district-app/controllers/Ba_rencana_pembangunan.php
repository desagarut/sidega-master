<?php defined('BASEPATH') || exit('No direct script access allowed');

class Ba_rencana_pembangunan extends Admin_Controller
{
    protected $tipe = 'rencana';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pembangunan_model', 'model');
        $this->load->model('pamong_model');
        $this->modul_ini     = 305;
        $this->sub_modul_ini = 330;
        //$this->model->set_tipe($this->tipe);
    }

    public function index()
    {
        if ($this->input->is_ajax_request()) {
            $start  = $this->input->post('start');
            $length = $this->input->post('length');
            $search = $this->input->post('search[value]');
            $order  = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
            $dir    = $this->input->post('order[0][dir]');
            $tahun  = $this->input->post('tahun');

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'draw'            => $this->input->post('draw'),
                    'recordsTotal'    => $this->model->get_data()->count_all_results(),
                    'recordsFiltered' => $this->model->get_data($search, $tahun)->count_all_results(),
                    'data'            => $this->model->get_data($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
            ]));
        }

        $this->render('ba/pembangunan/main', [
            'tipe'         => ucwords($this->tipe),
            'list_tahun'   => $this->model->list_filter_tahun(),
            'selected_nav' => $this->tipe,
            'subtitle'     => 'Buku ' . ucwords($this->tipe) . ' Pembangunan',
            'main_content' => 'ba/pembangunan/' . $this->tipe . '/index',
        ]);
    }

    public function dialog($aksi = '')
    {
        $data = [
            'aksi'        => $aksi,
            'form_action' => site_url('ba_' . $this->tipe . '_pembangunan/cetak/' . $aksi),
            'isi'         => 'ba/pembangunan/ajax_dialog',
            'list_tahun'  => $this->model->list_filter_tahun(),
        ];

        $this->load->view('global/dialog_cetak', $data);
    }

    public function cetak($aksi = '')
    {
        $tahun = $this->input->post('tahun');

        $data = [
            'aksi'           => $aksi,
            'config'         => $this->header['desa'],
            'tahun'          => $tahun,
            'pamong_ketahui' => $this->pamong_model->get_ttd(),
            'pamong_ttd'     => $this->pamong_model->get_ub(),
            'main'           => $this->model->get_data('', $tahun)->get()->result(),
            'tgl_cetak'      => $this->input->post('tgl_cetak'),
            'file'           => 'Buku ' . ucwords($this->tipe) . ' Kerja Pembangunan',
            'isi'            => 'ba/pembangunan/' . $this->tipe . '/cetak',
            'letak_ttd'      => ['1', '1', '3'],
        ];

        $this->load->view('global/format_cetak', $data);
    }

    // Lainnya
    public function lainnya($submenu)
    {
        $this->render('ba/pembangunan/main', [
            'selected_nav' => $submenu,
            'main_content' => 'ba/pembangunan/content_rencana',
        ]);
    }
}

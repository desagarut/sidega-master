<?php defined('BASEPATH') || exit('No direct script access allowed');

class Ba_tanah_kas_desa extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['tanah_kas_desa_model', 'pamong_model', 'data_persil_model']);
        $this->controller    = 'ba_tanah_kas_desa';
        $this->modul_ini     = 15;
        $this->sub_modul_ini = 301;
        $header['minsidebar'] = 1;

    }

    public function index()
    {
        if ($this->input->is_ajax_request()) {
            $start  = $this->input->post('start');
            $length = $this->input->post('length');
            $search = $this->input->post('search[value]');
            $order  = $this->tanah_kas_desa_model::ORDER_ABLE[$this->input->post('order[0][column]')];
            $dir    = $this->input->post('order[0][dir]');

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'draw'            => $this->input->post('draw'),
                    'recordsTotal'    => $this->tanah_kas_desa_model->get_data()->count_all_results(),
                    'recordsFiltered' => $this->tanah_kas_desa_model->get_data($search)->count_all_results(),
                    'data'            => $this->tanah_kas_desa_model->get_data($search)->order_by($order, $dir)->limit($length, $start)->get()->result(),
                ]));
        }

        $this->render('ba/umum/main', [
            'subtitle'     => 'Buku Tanah Kas Desa',
            'selected_nav' => 'tanah_kas',
            'main_content' => 'ba/pembangunan/tanah_kas_desa/content_tanah_kas_desa',
        ]);
    }

    public function clear()
    {
        $this->session->filter_tahun = date('Y');
        $this->session->filter_bulan = date('m');

        redirect('ba_tanah_kas_desa');
    }

    public function view_tanah_kas_desa($id)
    {
        $view_data = $this->tanah_kas_desa_model->view_tanah_kas_desa_by_id($id);
        $data      = [
            'main'            => $view_data,
            'main_content'    => 'ba/pembangunan/tanah_kas_desa/form_tanah_kas_desa',
            'persil'          => $this->data_persil_model->list_persil_kelas(),
            'list_asal_tanah' => $this->tanah_kas_desa_model->list_asal_tanah_kas(),
            'list_peruntukan' => $this->tanah_kas_desa_model->list_peruntukan_tanah_kas(),
            'subtitle'        => 'Buku Tanah Kas Desa',
            'selected_nav'    => 'tanah_kas',
            'view_mark'       => 1,
            'asal_tanah'      => $view_data->nama_pemilik_asal,
        ];

        $this->render('ba/umum/main', $data);
    }

    public function form($id = '')
    {
        $this->redirect_hak_akses('u');
        if ($id) {
            $view_data = $this->tanah_kas_desa_model->view_tanah_kas_desa_by_id($id);
            $data      = [
                'main'            => $view_data,
                'main_content'    => 'ba/pembangunan/tanah_kas_desa/form_tanah_kas_desa',
                'persil'          => $this->data_persil_model->list_persil_kelas(),
                'list_asal_tanah' => $this->tanah_kas_desa_model->list_asal_tanah_kas(),
                'list_peruntukan' => $this->tanah_kas_desa_model->list_peruntukan_tanah_kas(),
                'subtitle'        => 'Buku Tanah Kas Desa',
                'selected_nav'    => 'tanah_kas',
                'view_mark'       => 2,
                'asal_tanah'      => $view_data->nama_pemilik_asal,
                'form_action'     => site_url("ba_tanah_kas_desa/update_tanah_kas_desa/{$id}"),
            ];
        } else {
            $data = [
                'main'            => null,
                'main_content'    => 'ba/pembangunan/tanah_kas_desa/form_tanah_kas_desa',
                'persil'          => $this->data_persil_model->list_persil_kelas(),
                'list_asal_tanah' => $this->tanah_kas_desa_model->list_asal_tanah_kas(),
                'list_peruntukan' => $this->tanah_kas_desa_model->list_peruntukan_tanah_kas(),
                'subtitle'        => 'Buku Tanah Kas Desa',
                'selected_nav'    => 'tanah_kas',
                'view_mark'       => 0,
                'form_action'     => site_url('ba_tanah_kas_desa/add_tanah_kas_desa'),
            ];
        }

        $this->render('ba/umum/main', $data);
    }

    public function add_tanah_kas_desa()
    {
        $this->redirect_hak_akses('u');
        $this->tanah_kas_desa_model->add_tanah_kas_desa();
        if ($this->session->success == -1) {
            $this->session->dari_internal = true;
            redirect('ba_tanah_kas_desa/form');
        } else {
            redirect('ba_tanah_kas_desa/clear');
        }
    }

    public function update_tanah_kas_desa($id)
    {
        $this->redirect_hak_akses('u');
        $this->tanah_kas_desa_model->update_tanah_kas_desa();
        if ($this->session->success == -1) {
            $this->session->dari_internal = true;
            redirect("ba_tanah_kas_desa/form/{$id}");
        } else {
            redirect('ba_tanah_kas_desa/clear');
        }
    }

    public function delete_tanah_kas_desa($id)
    {
        $this->redirect_hak_akses('h');
        $this->tanah_kas_desa_model->delete_tanah_kas_desa($id);

        redirect('ba_tanah_kas_desa');
    }

    public function cetak_tanah_kas_desa($aksi = '')
    {
        $data = [
            'aksi'           => $aksi,
            'config'         => $this->header['desa'],
            'pamong_ketahui' => $this->pamong_model->get_ttd(),
            'pamong_ttd'     => $this->pamong_model->get_ub(),
            'main'           => $this->tanah_kas_desa_model->cetak_tanah_kas_desa(),
            'bulan'          => $this->session->filter_bulan,
            'tahun'          => $this->session->filter_tahun,
            'tgl_cetak'      => $this->input->post('tgl_cetak'),
            'file'           => 'Buku Tanah Kas Desa',
            'isi'            => 'ba/pembangunan/tanah_kas_desa/tanah_kas_desa_cetak',
            'letak_ttd'      => ['1', '1', '20'],
        ];

        $this->load->view('global/format_cetak', $data);
    }
}

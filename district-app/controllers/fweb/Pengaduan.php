<?php defined('BASEPATH') || exit('No direct script access allowed');

class Pengaduan extends Web_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pengaduan_model');
        $this->load->library('upload');
    }

    public function index($p = 1)
    {
        $data = $this->includes;
        $this->_get_common_data($data);

        $data['form_action'] = site_url("{$this->controller}/kirim");
        $data['cari']        = $this->input->get('cari');
        $data['caristatus']  = $this->input->get('caristatus');

        // TODO : Sederhanakan bagian panging dengan suffix
        $data['paging']       = $this->pengaduan_model->paging_pengaduan($p, $data['cari'] ?? '', $data['caristatus'] ?? '');
        $data['paging_page']  = 'pengaduan';
        $data['paging_range'] = 3;
        $data['start_paging'] = max($data['paging']->start_link, $p - $data['paging_range']);
        $data['end_paging']   = min($data['paging']->end_link, $p + $data['paging_range']);
        $data['pages']        = range($data['start_paging'], $data['end_paging']);

        $data['pengaduan']       = $this->pengaduan_model->get_pengaduan($data['cari'] ?? '', $data['caristatus'] ?? '');
        $data['pengaduan']       = $data['pengaduan']->limit($data['paging']->per_page, $data['cari'] ? 0 : $data['paging']->offset)->get()->result_array();
        $data['pengaduan_balas'] = $this->pengaduan_model->get_pengaduan_balas($data['cari'] ?? '', $data['caristatus'] ?? '')->get()->result_array();
        $data['halaman_statis']  = 'pengaduan/index';

        $this->set_template('layouts/halaman_statis_lebar.tpl.php');
        $this->load->view($this->template, $data);
    }

    public function kirim()
    {
        $result = $this->pengaduan_model->insert();

        if ($result) {
            $data = [
                'status' => 'success',
                'pesan'  => 'Pengaduan berhasil dikirim.',
            ];
        } else {
            $data = [
                'status' => 'error',
                'pesan'  => 'Pengaduan gagal dikirim.',
            ];
        }

        $this->session->set_flashdata('notif', $data);

        redirect($this->controller);
    }
}

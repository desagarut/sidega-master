<?php defined('BASEPATH') || exit('No direct script access allowed');

class Pembangunan extends Web_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['pembangunan_model', 'pembangunan_dokumentasi_model']);
    }

    public function index($p = 1)
    {
        $this->pembangunan_model->set_tipe(''); // Ambil semua pembangunan

        $data = $this->includes;
        $this->_get_common_data($data);

        $data['paging']         = $this->pembangunan_model->paging_pembangunan($p);
        $data['paging_page']    = 'pembangunan/index';
        $data['paging_range']   = 3;
        $data['start_paging']   = max($data['paging']->start_link, $p - $data['paging_range']);
        $data['end_paging']     = min($data['paging']->end_link, $p + $data['paging_range']);
        $data['pages']          = range($data['start_paging'], $data['end_paging']);
        $data['pembangunan']    = $this->pembangunan_model->get_data('', 'semua')->limit($data['paging']->per_page, $data['paging']->offset)->order_by('p.tahun_anggaran', 'desc')->get()->result();
        $data['halaman_statis'] = $this->controller . '/index';

        $this->set_template('layouts/halaman_statis_lebar.tpl.php');
        $this->load->view($this->template, $data);
    }

    public function detail($slug = null)
    {
        $data = $this->includes;
        $this->_get_common_data($data);

        $data['pembangunan']    = $this->pembangunan_model->slug($slug);
        $data['dokumentasi']    = $this->pembangunan_dokumentasi_model->find_dokumentasi($data['pembangunan']->id);
        $data['halaman_statis'] = $this->controller . '/detail';

        $this->set_template('layouts/halaman_statis_lebar.tpl.php');
        $this->load->view($this->template, $data);
    }
}

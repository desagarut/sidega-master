<?php defined('BASEPATH') || exit('No direct script access allowed');

class Galeri extends Web_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('first_gallery_m');
        if (! $this->web_menu_model->menu_aktif('galeri')) {
            show_404();
        }
    }

    public function index($p = 1)
    {
        $data                 = $this->includes;
        $data['p']            = $p;
        $data['paging']       = $this->first_gallery_m->paging($p);
        $data['paging_range'] = 3;
        $data['start_paging'] = max($data['paging']->start_link, $p - $data['paging_range']);
        $data['end_paging']   = min($data['paging']->end_link, $p + $data['paging_range']);
        $data['pages']        = range($data['start_paging'], $data['end_paging']);
        $data['gallery']      = $this->first_gallery_m->gallery_show($data['paging']->offset, $data['paging']->per_page);
        $data['paging_page']  = 'index';

        $this->_get_common_data($data);
        $this->set_template('layouts/gallery.tpl.php');
        $this->load->view($this->template, $data);
    }

    public function detail($parent = 0, $p = 1)
    {
        $data                 = $this->includes;
        $data['p']            = $p;
        $data['paging']       = $this->first_gallery_m->paging2($parent, $p);
        $data['paging_range'] = 3;
        $data['start_paging'] = max($data['paging']->start_link, $p - $data['paging_range']);
        $data['end_paging']   = min($data['paging']->end_link, $p + $data['paging_range']);
        $data['pages']        = range($data['start_paging'], $data['end_paging']);
        $data['gallery']      = $this->first_gallery_m->sub_gallery_show($parent, $data['paging']->offset, $data['paging']->per_page);
        $data['parent']       = $this->first_gallery_m->get_parent($parent);
        $data['paging_page']  = "{$parent}/index";

        $this->_get_common_data($data);
        $this->set_template('layouts/sub_gallery.tpl.php');
        $this->load->view($this->template, $data);
    }
}

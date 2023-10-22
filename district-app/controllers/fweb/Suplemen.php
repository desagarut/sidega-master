<?php defined('BASEPATH') || exit('No direct script access allowed');

class Suplemen extends Web_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('suplemen_model');

        $this->session->unset_userdata('per_page');
    }

    public function detail($slug = null)
    {
        $id = $this->suplemen_model->slug($slug);

        if (! $this->web_menu_model->menu_aktif('data-suplemen/' . $id)) {
            show_404();
        }

        $data            = $this->includes;
        $data['main']    = $this->suplemen_model->get_rincian(0, $id);
        $data['title']   = 'Data Suplemen ' . $data['main']['suplemen']['nama'];
        $data['sasaran'] = unserialize(SASARAN);

        $this->_get_common_data($data);
        $this->set_template('layouts/suplemen.tpl.php');
        $this->load->view($this->template, $data);
    }
}

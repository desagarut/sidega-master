<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Status_desa extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('header_model');
		$this->load->library('data_publik');
		$this->modul_ini = 200;
		$this->sub_modul_ini = 101;
	}

	public function index()
	{
		$header = $this->header_model->get_data();
		$kode_desa = $header['desa']['kode_desa'];
		$tahun     = $this->session->flashdata('tahun') ?? ($this->input->post('tahun') ?? date('Y'));
        $cache     = 'idm_' . $tahun . '_' . $kode_desa;

		if ($this->data_publik->has_internet_connection())
		{
            $this->data_publik->set_api_url("https://idm.kemendesa.go.id/open/api/desa/rumusan/$kode_desa/$tahun", $cache)
			->set_interval(7)
				->set_cache_folder(FCPATH.'instansi');

			$idm = $this->data_publik->get_url_content();
			if ($idm->body->error)
			{
				$idm->body->mapData->error_msg = $idm->body->message . " : " . $idm->header->url . "<br><br>" .
					"Periksa Kode Instansi di Profil. Masukkan kode lengkap, contoh '3205052001'<br>";
			}
			$data = [
                'idm'   => $idm->body->mapData,
                'tahun' => $tahun,];
		}

	//	$this->load->view('header', $header);
	//	$this->load->view('nav', $nav);
	//	$this->load->view('home/idm', ['idm' => $idm->body->mapData]);
	//	$this->load->view('footer');
	$this->render('home/idm', $data);
	}

    public function perbaharui($tahun)
    {
        if (cek_koneksi_internet() && $tahun) {
            $kode_desa = $this->header['desa']['kode_desa'];
            $cache     = 'idm_' . $tahun . '_' . $kode_desa . '.json';

            $this->cache->file->delete($cache);
            $this->session->set_flashdata('tahun', $tahun);
            $this->session->success = 1;
        }

        redirect('status_desa');
    }

}

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
		if ($this->data_publik->has_internet_connection())
		{
			$this->data_publik->set_api_url("https://idm.kemendesa.go.id/open/api/desa/rumusan/$kode_desa/2020", "idm_$kode_desa")
				->set_interval(7)
				->set_cache_folder(FCPATH.'desa');

			$idm = $this->data_publik->get_url_content();
			if ($idm->body->error)
			{
				$idm->body->mapData->error_msg = $idm->body->message . " : " . $idm->header->url . "<br><br>" .
					"Periksa Kode Desa di Identitas Desa. Masukkan kode lengkap, contoh '3507012006'<br>";
			}
		}

		$this->load->view('header', $header);
		$this->load->view('nav', $nav);
		$this->load->view('home/idm', ['idm' => $idm->body->mapData]);
		$this->load->view('footer');
	}

}

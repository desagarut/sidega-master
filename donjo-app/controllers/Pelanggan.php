<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Pelanggan extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('config_model');
		$this->load->model('header_model');
		$this->load->model('referensi_model');
		$this->modul_ini = 200;
		$this->sub_modul_ini = 313;
	}

	public function index()
	{
		$header = $this->header_model->get_data();

		$data['jenis_pelanggan'] =  $this->referensi_model->list_ref_pelanggan(JENIS_PELANGGAN);
		$data['status_langganan'] = $this->referensi_model->list_ref_pelanggan(STATUS_LANGGANAN);
		$data['filter_langganan'] = $this->referensi_model->list_ref_pelanggan(FILTER_LANGGANAN);
		$data['pelaksana'] = $this->referensi_model->list_ref_pelanggan(PELAKSANA);
		$data['selected_filter'] = $filter;

		$this->render('pelanggan/form', $data);
	}

}

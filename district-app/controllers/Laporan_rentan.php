<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_rentan extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('laporan_bulanan_model');
		$this->load->model('config_model');

		//Initialize Session ------------
		$_SESSION['success'] = 0;
		$_SESSION['per_page'] = 20;
		$_SESSION['cari'] = '';
		//-------------------------------

		$this->modul_ini = 2;
		$this->sub_modul_ini = 29;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		unset($_SESSION['dusun']);
		unset($_SESSION['rw']);
		unset($_SESSION['rt']);
		redirect('laporan_rentan');
	}

	public function index()
	{
		if (isset($_SESSION['dusun']))
			$data['dusun'] = $_SESSION['dusun'];
		else $data['dusun'] = '';

		$data['list_dusun'] = $this->laporan_bulanan_model->list_dusun();
		$data['config'] = $this->config_model->get_data();
		$data['main'] = $this->laporan_bulanan_model->list_data();
		$this->set_minsidebar(1);
		$this->render('laporan/kelompok', $data);
	}

	public function cetak()
	{
		$data['config'] = $this->config_model->get_data();
		$data['main'] = $this->laporan_bulanan_model->list_data();
		$this->load->view('laporan/kelompok_print', $data);
	}

	public function excel()
	{
		$data['config'] = $this->config_model->get_data();
		$data['main'] = $this->laporan_bulanan_model->list_data();
		$this->load->view('laporan/kelompok_excel', $data);
	}

	public function dusun()
	{
		$dusun = $this->input->post('dusun');
		if ($dusun != "")
			$_SESSION['dusun'] = $dusun;
		else unset($_SESSION['dusun']);
		redirect('laporan_rentan');
	}
}

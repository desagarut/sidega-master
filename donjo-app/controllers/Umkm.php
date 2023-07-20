<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Umkm extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('referensi_model');
		$this->load->model('toko_warga_model');
		$this->load->model('tukang_model');
		$this->load->model('tawa_model');
		$this->load->model('wisata_model');

		$this->load->model('config_model');
		$this->load->model('wilayah_model');
		$this->load->model('pamong_model');
		$this->load->model('plan_lokasi_model');
		$this->load->model('plan_area_model');
		$this->load->model('plan_garis_model');
		$this->modul_ini = 400;
		$this->sub_modul_ini = 401;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('umkm');
	}

	public function index($p=1, $o=0)
	{
		$data['p'] = $p;
		$data['o'] = $o;
		$data      = ['selected_nav' => 'umkm_ststistik'];
		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['filter']))
			$data['filter'] = $_SESSION['filter'];
		else $data['filter'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page'] = $_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['paging'] = $this->toko_warga_model->paging($p,$o);
		$data['main'] = $this->toko_warga_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };
		$data['keyword'] = $this->toko_warga_model->autocomplete();

		$this->render('umkm/umkm_statistik', $data);
	}

}

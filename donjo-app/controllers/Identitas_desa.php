<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Identitas_desa extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['config_model', 'wilayah_model', 'provinsi_model']);

		$this->modul_ini = 200;
		$this->sub_modul_ini = 17;
	}

	public function index()
	{
		$data['main'] = $this->config_model->get_data();
		$data['desa'] = ucwords($this->setting->sebutan_desa);
		$data['kecamatan'] = ucwords($this->setting->sebutan_kecamatan);
		$data['kabupaten'] = ucwords($this->setting->sebutan_kabupaten);
		$data['desa_map'] = $this->config_model->get_data();
		$data_desa = $this->config_model->get_data();
		$data['wil_ini'] = $data_desa;
		$data['wil_atas'] = $data_desa;
		$data['wil_atas']['zoom'] = 14;

		$this->render('identitas_desa/index', $data);
	}

	public function form()
	{
		$data['main'] = $this->config_model->get_data();
		$data['desa'] = ucwords($this->setting->sebutan_desa);
		$data['kecamatan'] = ucwords($this->setting->sebutan_kecamatan);
		$data['kabupaten'] = ucwords($this->setting->sebutan_kabupaten);
		$data['list_provinsi'] = $this->provinsi_model->list_data();

		// Buat row data desa di form apabila belum ada data desa
		if ($data['main'])
			$data['form_action'] = site_url('identitas_desa/update/' . $data['main']['id']);
		else
			$data['form_action'] = site_url('identitas_desa/insert');

		$this->render('identitas_desa/form', $data);
	}

	public function insert()
	{
		$this->config_model->insert();
		redirect('identitas_desa');
	}

	public function update($id = 0)
	{
		$this->config_model->update($id);
		redirect('identitas_desa');
	}

	public function maps($tipe = 'kantor')
	{
		$data_desa = $this->config_model->get_data();
		$data['desa'] = $this->config_model->get_data();
		$data['wil_ini'] = $data_desa;
		$data['wil_atas']['lat'] = -7.229426071233562;
		$data['wil_atas']['lng'] = 107.88959092620838;
		$data['wil_atas']['zoom'] = 14;
		$data['wil_atas'] = $this->config_model->get_data();
		$data['dusun_gis'] = $this->wilayah_model->list_dusun();
		$data['rw_gis'] = $this->wilayah_model->list_rw_gis();
		$data['rt_gis'] = $this->wilayah_model->list_rt_gis();
		$data['nama_wilayah'] = ucwords($this->setting->sebutan_desa . " " . $data_desa['nama_desa']);
		$data['wilayah'] = ucwords($this->setting->sebutan_desa . " " . $data_desa['nama_desa']);
		$data['breadcrumb'] = array(
			array('link' => site_url("identitas_desa"), 'judul' => "Identitas " . ucwords($this->setting->sebutan_desa)),
		);

		$data['form_action'] = site_url("identitas_desa/update_maps/$tipe");

		//$this->render('sid/wilayah/maps_' . $tipe, $data);
		$this->render('sid/wilayah/maps_google_' . $tipe, $data);
	}

	public function maps_openstreet($tipe = 'kantor')
	{
		$data_desa = $this->config_model->get_data();
		$data['desa'] = $this->config_model->get_data();
		$data['wil_ini'] = $data_desa;
		$data['wil_atas']['lat'] = -7.229426071233562;
		$data['wil_atas']['lng'] = 107.88959092620838;
		$data['wil_atas']['zoom'] = 14;
		$data['wil_atas'] = $this->config_model->get_data();
		$data['dusun_gis'] = $this->wilayah_model->list_dusun();
		$data['rw_gis'] = $this->wilayah_model->list_rw_gis();
		$data['rt_gis'] = $this->wilayah_model->list_rt_gis();
		$data['nama_wilayah'] = ucwords($this->setting->sebutan_desa . " " . $data_desa['nama_desa']);
		$data['wilayah'] = ucwords($this->setting->sebutan_desa . " " . $data_desa['nama_desa']);
		$data['breadcrumb'] = array(
			array('link' => site_url("identitas_desa"), 'judul' => "Identitas " . ucwords($this->setting->sebutan_desa)),
		);

		$data['form_action'] = site_url("identitas_desa/update_maps/$tipe");

		//$this->render('sid/wilayah/maps_' . $tipe, $data);
		$this->render('sid/wilayah/maps_openstreet_' . $tipe, $data);
	}

	public function update_maps($tipe = 'kantor')
	{
		if ($tipe = 'kantor')
			$this->config_model->update_kantor();
		else
			$this->config_model->update_wilayah();

		redirect("identitas_desa");
	}
}

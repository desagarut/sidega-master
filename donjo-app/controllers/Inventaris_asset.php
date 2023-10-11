<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Inventaris_asset extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('inventaris_asset_model');
		$this->load->model('referensi_model');
		$this->load->model('surat_model');
		$this->modul_ini = 15;
		$this->sub_modul_ini = 61;
		$this->tab_ini = 5;
		$this->tipe = 'inventaris_asset';
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('inventaris');
	}

	public function index()
	{
		$data['main'] = $this->inventaris_asset_model->list_inventaris();
		$data['total'] = $this->inventaris_asset_model->sum_inventaris();
		$data['pamong'] = $this->surat_model->list_pamong();
		$data['tip'] = 1;
		$this->set_minsidebar(1);
		$this->render('inventaris/asset/table', $data);
	}

	public function view($id)
	{
		$data['main'] = $this->inventaris_asset_model->view($id);
		$data['tip'] = 1;
		$this->set_minsidebar(1);
		$this->render('inventaris/asset/view_inventaris', $data);
	}

	public function view_mutasi($id)
	{
		$data['main'] = $this->inventaris_asset_model->view_mutasi($id);
		$data['tip'] = 2;
		$this->set_minsidebar(1);
		$this->render('inventaris/asset/view_mutasi', $data);
	}

	public function edit($id)
	{
		$data['main'] = $this->inventaris_asset_model->view($id);
		$data['get_kode'] = $this->header['desa'];
		$data['aset'] = $this->inventaris_asset_model->list_aset();
		$data['count_reg'] = $this->inventaris_asset_model->count_reg();
		$data['kd_reg'] = $this->inventaris_asset_model->list_inventaris_kd_register();
		$data['tip'] = 1;
		$this->set_minsidebar(1);
		$this->render('inventaris/asset/edit_inventaris', $data);
	}

	public function edit_mutasi($id)
	{
		$data['main'] = $this->inventaris_asset_model->edit_mutasi($id);
		$data['tip'] = 2;
		$this->set_minsidebar(1);
		$this->render('inventaris/asset/edit_mutasi', $data);
	}

	public function form()
	{
		$data['tip'] = 1;

		$data['get_kode'] = $this->header['desa'];
		$data['aset'] = $this->inventaris_asset_model->list_aset();
		$data['count_reg'] = $this->inventaris_asset_model->count_reg();
		$this->set_minsidebar(1);

		$this->render('inventaris/asset/form_tambah', $data);
	}

	public function form_mutasi($id)
	{
		$data['main'] = $this->inventaris_asset_model->view($id);
		$data['tip'] = 1;
		$this->set_minsidebar(1);
		$this->render('inventaris/asset/form_mutasi', $data);
	}

	public function mutasi()
	{
		$data['main'] = $this->inventaris_asset_model->list_mutasi_inventaris();
		$data['tip'] = 2;
		$this->set_minsidebar(1);
		$this->render('inventaris/asset/table_mutasi', $data);
	}

	public function cetak($tahun, $penandatangan)
	{
		$data['header'] = $this->header['desa'];
		$data['total'] = $this->inventaris_asset_model->sum_print($tahun);
		$data['print'] = $this->inventaris_asset_model->cetak($tahun);
		$data['pamong'] = $this->inventaris_asset_model->pamong($penandatangan);
		$this->load->view('inventaris/asset/inventaris_print', $data);
	}

	public function download($tahun, $penandatangan)
	{
		$data['header'] = $this->header['desa'];
		$data['total'] = $this->inventaris_asset_model->sum_print($tahun);
		$data['print'] = $this->inventaris_asset_model->cetak($tahun);
		$data['pamong'] = $this->inventaris_asset_model->pamong($penandatangan);
		$this->load->view('inventaris/asset/inventaris_excel', $data);
	}
}

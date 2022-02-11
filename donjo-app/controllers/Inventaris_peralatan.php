<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Inventaris_peralatan extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('inventaris_peralatan_model');
		$this->load->model('referensi_model');
		$this->load->model('surat_model');
		$this->modul_ini = 305;
		$this->sub_modul_ini = 61;
		$this->tab_ini = 2;
		$this->tipe = 'inventaris_peralatan';
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('Inventaris_peralatan');
	}

	public function index()
	{
		$data['main'] = $this->inventaris_peralatan_model->list_inventaris();
		$data['total'] = $this->inventaris_peralatan_model->sum_inventaris();
		$data['pamong'] = $this->surat_model->list_pamong();
		$data['tip'] = 1;
		$this->set_minsidebar(1);
		$this->render('inventaris/peralatan/table', $data);
	}

	public function view($id)
	{
		$data['main'] = $this->inventaris_peralatan_model->view($id);
		$data['tip'] = 1;
		$this->set_minsidebar(1);
		$this->render('inventaris/peralatan/view_inventaris', $data);
	}

	public function view_mutasi($id)
	{
		$data['main'] = $this->inventaris_peralatan_model->view_mutasi($id);
		$data['tip'] = 2;
		$this->set_minsidebar(1);
		$this->render('inventaris/peralatan/view_mutasi', $data);
	}

	public function edit($id)
	{
		$data['main'] = $this->inventaris_peralatan_model->view($id);
		$data['get_kode'] = $this->header['desa'];
		$data['aset'] = $this->inventaris_peralatan_model->list_aset();
		$data['count_reg'] = $this->inventaris_peralatan_model->count_reg();
		$data['kd_reg'] = $this->inventaris_peralatan_model->list_inventaris_kd_register();
		$data['tip'] = 1;
		$this->set_minsidebar(1);
		$this->render('inventaris/peralatan/edit_inventaris', $data);
	}

	public function edit_mutasi($id)
	{
		$data['main'] = $this->inventaris_peralatan_model->edit_mutasi($id);
		$data['tip'] = 2;
		$this->set_minsidebar(1);
		$this->render('inventaris/peralatan/edit_mutasi', $data);
	}

	public function form()
	{
		$data['tip'] = 1;

		$data['get_kode'] = $this->header['desa'];
		$data['aset'] = $this->inventaris_peralatan_model->list_aset();
		$data['count_reg'] = $this->inventaris_peralatan_model->count_reg();
		$this->set_minsidebar(1);

		$this->render('inventaris/peralatan/form_tambah', $data);
	}

	public function form_mutasi($id)
	{
		$data['main'] = $this->inventaris_peralatan_model->view($id);
		$data['tip'] = 1;
		$this->set_minsidebar(1);
		$this->render('inventaris/peralatan/form_mutasi', $data);
	}

	public function mutasi()
	{
		$data['main'] = $this->inventaris_peralatan_model->list_mutasi_inventaris();
		$data['tip'] = 2;
		$this->set_minsidebar(1);
		$this->render('inventaris/peralatan/table_mutasi', $data);
	}

	public function cetak($tahun, $penandatangan)
	{
		$data['header'] = $this->header['desa'];
		$data['total'] = $this->inventaris_peralatan_model->sum_print($tahun);
		$data['print'] = $this->inventaris_peralatan_model->cetak($tahun);
		$data['pamong'] = $this->inventaris_peralatan_model->pamong($penandatangan);
		$this->load->view('inventaris/peralatan/inventaris_print', $data);
	}

	public function download($tahun, $penandatangan)
	{
		$data['header'] = $this->header['desa'];
		$data['total'] = $this->inventaris_peralatan_model->sum_print($tahun);
		$data['print'] = $this->inventaris_peralatan_model->cetak($tahun);
		$data['pamong'] = $this->inventaris_peralatan_model->pamong($penandatangan);
		$this->load->view('inventaris/peralatan/inventaris_excel', $data);
	}
}

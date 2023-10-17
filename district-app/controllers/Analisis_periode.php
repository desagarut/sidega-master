<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Analisis_periode extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('analisis_periode_model');

		$_SESSION['submenu'] = "Data Periode";
		$_SESSION['asubmenu'] = "analisis_periode";
		$this->modul_ini = 5;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['state']);
		redirect('analisis_periode');
	}

	public function leave()
	{
		$id = $_SESSION['analisis_master'];
		unset($_SESSION['analisis_master']);
		redirect("analisis_master/menu/$id");
	}

	public function index($p=1, $o=0)
	{
		unset($_SESSION['cari2']);
		$data['p'] = $p;
		$data['o'] = $o;

		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['state']))
			$data['state'] = $_SESSION['state'];
		else $data['state'] = '';
		if (isset($_POST['per_page']))
			$_SESSION['per_page']=$_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['paging'] = $this->analisis_periode_model->paging($p,$o);
		$data['main'] = $this->analisis_periode_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->analisis_periode_model->autocomplete();
		$data['analisis_master'] = $this->analisis_periode_model->get_analisis_master();
		$data['list_state'] = $this->analisis_periode_model->list_state();

		$this->set_minsidebar(1);
		$this->render('analisis_periode/table', $data);
	}

	public function form($p=1, $o=0, $id='')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['analisis_periode'] = $this->analisis_periode_model->get_analisis_periode($id);
			$data['form_action'] = site_url("analisis_periode/update/$p/$o/$id");
		}
		else
		{
			$data['analisis_periode'] = null;
			$data['form_action'] = site_url("analisis_periode/insert");
		}

		$data['analisis_master'] = $this->analisis_periode_model->get_analisis_master();

		$this->set_minsidebar(1);
		$this->render('analisis_periode/form', $data);
	}

	public function search()
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		redirect('analisis_periode');
	}

	public function state()
	{
		$filter = $this->input->post('state');
		if ($filter != 0)
			$_SESSION['state']=$filter;
		else unset($_SESSION['state']);
		redirect('analisis_periode');
	}

	public function insert()
	{
		$this->analisis_periode_model->insert();
		redirect('analisis_periode');
	}

	public function update($p=1, $o=0, $id='')
	{
		$this->analisis_periode_model->update($id);
		redirect("analisis_periode/index/$p/$o");
	}

	public function delete($p=1, $o=0, $id='')
	{
		$this->redirect_hak_akses('h', "analisis_periode/index/$p/$o");
		$this->analisis_periode_model->delete($id);
		redirect("analisis_periode/index/$p/$o");
	}

	public function delete_all($p=1, $o=0)
	{
		$this->redirect_hak_akses('h', "analisis_periode/index/$p/$o");
		$this->analisis_periode_model->delete_all();
		redirect("analisis_periode/index/$p/$o");
	}

	public function list_state()
	{
		$sql = "SELECT * FROM analisis_ref_state";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}

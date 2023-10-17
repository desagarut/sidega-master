<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Klasifikasi extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('klasifikasi_model');
		$this->modul_ini = 15;
		$this->sub_modul_ini = 63;
	}

	public function clear()
	{
		$_SESSION['per_page'] = 50;
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('klasifikasi');
	}

	public function index($p=1, $o=0)
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['filter']))
			$data['filter'] = $_SESSION['filter'];
		else $data['filter'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page'] = $_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['paging'] = $this->klasifikasi_model->paging($p, $o);
		$data['main'] = $this->klasifikasi_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->klasifikasi_model->autocomplete();

		$this->render('klasifikasi/table', $data);
	}

	public function form($p=1, $o=0, $id='')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['data'] = $this->klasifikasi_model->get_klasifikasi($id);
			$data['form_action'] = site_url("klasifikasi/update/$id/$p/$o");
		}
		else
		{
			$data['data'] = null;
			$data['form_action'] = site_url("klasifikasi/insert");
		}

		$this->render('klasifikasi/form', $data);
	}

	public function search()
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		redirect('klasifikasi');
	}

	public function filter()
	{
		$filter = $this->input->post('filter');
		if ($filter != "")
			$_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		redirect("klasifikasi");
	}

	public function insert()
	{
		$_SESSION['success'] = 1;
		$outp = $this->klasifikasi_model->insert();
		if (!$outp) $_SESSION['success'] = -1;
		redirect("klasifikasi");
	}

	public function update($id='', $p=1, $o=0)
	{
		$_SESSION['success'] = 1;
		$outp = $this->klasifikasi_model->update($id);
		if (!$outp) $_SESSION['success'] = -1;
		redirect("klasifikasi/index/$p/$o");
	}

	public function delete($p=1, $o=0, $id='')
	{
		$this->redirect_hak_akses('h', "klasifikasi/index/$p/$o");
		$this->klasifikasi_model->delete($id);
		redirect("klasifikasi/index/$p/$o");
	}

	public function delete_all($p=1, $o=0)
	{
		$this->redirect_hak_akses('h', "klasifikasi/index/$p/$o");
		$this->klasifikasi_model->delete_all();
		redirect("klasifikasi/index/$p/$o");
	}

	public function lock($p=1, $o=0, $id='')
	{
		$this->klasifikasi_model->lock($id, 0);
		redirect("klasifikasi/index/$p/$o");
	}

	public function unlock($p=1, $o=0, $id='')
	{
		$this->klasifikasi_model->lock($id, 1);
		redirect("klasifikasi/index/$p/$o");
	}

	public function ekspor()
	{
		download_send_headers("klasifikasi_surat_" . date("Y-m-d") . ".csv");
		echo get_csv('klasifikasi_surat');
	}

	public function impor()
	{
		$data['form_action'] = site_url("klasifikasi/proses_impor");
		$this->load->view('klasifikasi/impor', $data);
	}

	public function proses_impor()
	{
		$this->klasifikasi_model->impor($_FILES['klasifikasi']['tmp_name']);
		redirect('klasifikasi');
	}
}

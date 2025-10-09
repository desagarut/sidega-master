<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Bpd_buku_aspirasi extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('bpd_buku_aspirasi_model');
		$this->modul_ini = 900;
		$this->sub_modul_ini = 903;
		$this->set_minsidebar(0);
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('bpd_buku_aspirasi');
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

		$data['paging'] = $this->bpd_buku_aspirasi_model->paging($p,$o);
		$data['main'] = $this->bpd_buku_aspirasi_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->bpd_buku_aspirasi_model->autocomplete();

		$this->render('bpd/aspirasi/table', $data);
	}

	public function form($p=1, $o=0, $id='')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['bpd_buku_aspirasi'] = $this->bpd_buku_aspirasi_model->get_aspirasi($id);
			$data['form_action'] = site_url("bpd_buku_aspirasi/update/$id/$p/$o");
		}
		else
		{
			$data['bpd_buku_aspirasi'] = null;
			$data['form_action'] = site_url("bpd_buku_aspirasi/insert");
		}
		$this->modul_ini = 900;
		$this->sub_modul_ini = 903;
		$this->set_minsidebar(0);

		$this->render('bpd/aspirasi/form', $data);
	}

	public function search($bpd_buku_aspirasi='')
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		if ($bpd_buku_aspirasi != '')
		{
			redirect("bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi");
		}
		else
		{
			redirect('bpd_buku_aspirasi');
		}
	}

	public function filter($bpd_buku_aspirasi='')
	{
		$filter = $this->input->post('filter');
		if ($filter != 0)
			$_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		if ($bpd_buku_aspirasi != '')
		{
			redirect("bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi");
		}
		else
		{
			redirect('bpd_buku_aspirasi');
		}
	}

	public function insert()
	{
		$this->bpd_buku_aspirasi_model->insert();
		redirect('bpd_buku_aspirasi');
	}

	public function update($id='', $p=1, $o=0)
	{
		$this->bpd_buku_aspirasi_model->update($id);
		redirect("bpd_buku_aspirasi/index/$p/$o");
	}

	public function delete($p=1, $o=0, $id='')
	{
		$this->redirect_hak_akses('h', "bpd_buku_aspirasi/index/$p/$o");
		$this->bpd_buku_aspirasi_model->delete_aspirasi($id);
		redirect("bpd_buku_aspirasi/index/$p/$o");
	}

	public function delete_all($p=1, $o=0)
	{
		$this->redirect_hak_akses('h', "bpd_buku_aspirasi/index/$p/$o");
		$_SESSION['success'] = 1;
		$this->bpd_buku_aspirasi_model->delete_all_aspirasi();
		redirect("bpd_buku_aspirasi/index/$p/$o");
	}

	public function kunci_aspirasi($id='', $bpd_buku_aspirasi='')
	{
		$this->bpd_buku_aspirasi_model->kunci_aspirasi($id, 1);
		if ($bpd_buku_aspirasi != '')
			redirect("bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi/$p");
		else
			redirect("bpd_buku_aspirasi/index/$p/$o");
	}

	public function buka_kunci_aspirasi($id='', $bpd_buku_aspirasi='')
	{
		$this->bpd_buku_aspirasi_model->kunci_aspirasi($id, 2);
		if ($bpd_buku_aspirasi != '')
			redirect("bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi/$p");
		else
			redirect("bpd_buku_aspirasi/index/$p/$o");
	}

	public function table_dokumentasi($gal=0, $p=1, $o=0)
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

		$data['paging'] = $this->bpd_buku_aspirasi_model->paging2($gal, $p);
		$data['table_dokumentasi'] = $this->bpd_buku_aspirasi_model->list_dokumentasi($gal, $o, $data['paging']->offset, $data['paging']->per_page);
		$data['bpd_buku_aspirasi'] = $gal;
		$data['sub'] = $this->bpd_buku_aspirasi_model->get_aspirasi($gal);
		$data['keyword'] = $this->bpd_buku_aspirasi_model->autocomplete();

		$this->render('bpd/aspirasi/table_dokumentasi', $data);
	}

	public function form_dokumentasi($bpd_buku_aspirasi=0, $id=0)
	{
		if ($id)
		{
			$data['bpd_buku_aspirasi'] = $this->bpd_buku_aspirasi_model->get_aspirasi($id);
			$data['form_action'] = site_url("bpd_buku_aspirasi/update_dokumentasi/$bpd_buku_aspirasi/$id");
		}
		else
		{
			$data['bpd_buku_aspirasi'] = null;
			$data['form_action'] = site_url("bpd_buku_aspirasi/insert_dokumentasi/$bpd_buku_aspirasi");
		}
		$data['album']=$bpd_buku_aspirasi;

		$this->render('bpd/aspirasi/form_dokumentasi', $data);
	}

	public function insert_dokumentasi($bpd_buku_aspirasi='')
	{
		$this->bpd_buku_aspirasi_model->insert_dokumentasi($bpd_buku_aspirasi);
		redirect("bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi");
	}

	public function update_dokumentasi($bpd_buku_aspirasi='', $id='')
	{
		$this->bpd_buku_aspirasi_model->update_dokumentasi($id);
		redirect("bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi");
	}

	public function delete_dokumentasi($bpd_buku_aspirasi='', $id='')
	{
		$this->redirect_hak_akses('h', "bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi");
		$this->bpd_buku_aspirasi_model->delete($id);
		redirect("bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi");
	}

	public function delete_all_dokumentasi($bpd_buku_aspirasi='')
	{
		$this->redirect_hak_akses('h', "bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi");
		$_SESSION['success']=1;
		$this->bpd_buku_aspirasi_model->delete_all();
		redirect("bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi");
	}

	public function gallery_lock_dokumentasi($bpd_buku_aspirasi='', $id='')
	{
		$this->bpd_buku_aspirasi_model->kunci_aspirasi($id, 1);
		redirect("bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi");
	}

	public function gallery_unlock_dokumentasi($bpd_buku_aspirasi='', $id='')
	{
		$this->bpd_buku_aspirasi_model->kunci_aspirasi($id, 2);
		redirect("bpd_buku_aspirasi/table_dokumentasi/$bpd_buku_aspirasi");
	}
}

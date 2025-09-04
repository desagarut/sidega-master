<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Bpd_buku_kegiatan extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('bpd_kegiatan_model');
		$this->modul_ini = 900;
		$this->sub_modul_ini = 902;
		$this->set_minsidebar(0);

	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('bpd_buku_kegiatan');
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

		$data['paging'] = $this->bpd_kegiatan_model->paging($p,$o);
		$data['main'] = $this->bpd_kegiatan_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->bpd_kegiatan_model->autocomplete();

		$this->render('bpd/kegiatan/table', $data);
	}

	public function form($p=1, $o=0, $id='')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['bpd_buku_kegiatan'] = $this->bpd_kegiatan_model->get_kegiatan($id);
			$data['form_action'] = site_url("bpd_buku_kegiatan/update/$id/$p/$o");
		}
		else
		{
			$data['bpd_buku_kegiatan'] = null;
			$data['form_action'] = site_url("bpd_buku_kegiatan/insert");
		}

		$this->render('bpd/kegiatan/form', $data);
	}

	public function search($bpd_buku_kegiatan='')
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		if ($bpd_buku_kegiatan != '')
		{
			redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan");
		}
		else
		{
			redirect('bpd_buku_kegiatan');
		}
	}

	public function filter($bpd_buku_kegiatan='')
	{
		$filter = $this->input->post('filter');
		if ($filter != 0)
			$_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		if ($bpd_buku_kegiatan != '')
		{
			redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan");
		}
		else
		{
			redirect('bpd_buku_kegiatan');
		}
	}

	public function insert()
	{
		$this->bpd_kegiatan_model->insert();
		redirect('bpd_buku_kegiatan');
	}

	public function update($id='', $p=1, $o=0)
	{
		$this->bpd_kegiatan_model->update($id);
		redirect("bpd_buku_kegiatan/index/$p/$o");
	}

	public function delete($p=1, $o=0, $id='')
	{
		$this->redirect_hak_akses('h', "bpd_buku_kegiatan/index/$p/$o");
		$this->bpd_kegiatan_model->delete_kegiatan($id);
		redirect("bpd_buku_kegiatan/index/$p/$o");
	}

	public function delete_all($p=1, $o=0)
	{
		$this->redirect_hak_akses('h', "bpd_buku_kegiatan/index/$p/$o");
		$_SESSION['success'] = 1;
		$this->bpd_kegiatan_model->delete_all_kegiatan();
		redirect("bpd_buku_kegiatan/index/$p/$o");
	}

	public function kunci_kegiatan($id='', $bpd_buku_kegiatan='')
	{
		$this->bpd_kegiatan_model->kunci_kegiatan($id, 1);
		if ($bpd_buku_kegiatan != '')
			redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan/$p");
		else
			redirect("bpd_buku_kegiatan/index/$p/$o");
	}

	public function buka_kunci_kegiatan($id='', $bpd_buku_kegiatan='')
	{
		$this->bpd_kegiatan_model->kunci_kegiatan($id, 2);
		if ($bpd_buku_kegiatan != '')
			redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan/$p");
		else
			redirect("bpd_buku_kegiatan/index/$p/$o");
	}

	public function slider_on($id='', $bpd_buku_kegiatan='')
	{
		$this->bpd_kegiatan_model->gallery_slider($id, 1);
		if ($bpd_buku_kegiatan != '')
			redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan/$p");
		else
			redirect("bpd_buku_kegiatan/index/$p/$o");
	}

	public function slider_off($id='', $bpd_buku_kegiatan='')
	{
		$this->bpd_kegiatan_model->gallery_slider($id,0);
		if ($bpd_buku_kegiatan != '')
			redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan/$p");
		else
			redirect("bpd_buku_kegiatan/index/$p/$o");
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

		$data['paging'] = $this->bpd_kegiatan_model->paging2($gal, $p);
		$data['table_dokumentasi'] = $this->bpd_kegiatan_model->list_dokumentasi($gal, $o, $data['paging']->offset, $data['paging']->per_page);
		$data['bpd_buku_kegiatan'] = $gal;
		$data['sub'] = $this->bpd_kegiatan_model->get_kegiatan($gal);
		$data['keyword'] = $this->bpd_kegiatan_model->autocomplete();

		$this->render('bpd/kegiatan/table_dokumentasi', $data);
	}

	public function form_dokumentasi($bpd_buku_kegiatan=0, $id=0)
	{
		if ($id)
		{
			$data['bpd_buku_kegiatan'] = $this->bpd_kegiatan_model->get_kegiatan($id);
			$data['form_action'] = site_url("bpd_buku_kegiatan/update_dokumentasi/$bpd_buku_kegiatan/$id");
		}
		else
		{
			$data['bpd_buku_kegiatan'] = null;
			$data['form_action'] = site_url("bpd_buku_kegiatan/insert_dokumentasi/$bpd_buku_kegiatan");
		}
		$data['album']=$bpd_buku_kegiatan;

		$this->render('bpd/kegiatan/form_dokumentasi', $data);
	}

	public function insert_dokumentasi($bpd_buku_kegiatan='')
	{
		$this->bpd_kegiatan_model->insert_dokumentasi($bpd_buku_kegiatan);
		redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan");
	}

	public function update_dokumentasi($bpd_buku_kegiatan='', $id='')
	{
		$this->bpd_kegiatan_model->update_dokumentasi($id);
		redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan");
	}

	public function delete_dokumentasi($bpd_buku_kegiatan='', $id='')
	{
		$this->redirect_hak_akses('h', "bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan");
		$this->bpd_kegiatan_model->delete($id);
		redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan");
	}

	public function delete_all_dokumentasi($bpd_buku_kegiatan='')
	{
		$this->redirect_hak_akses('h', "bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan");
		$_SESSION['success']=1;
		$this->bpd_kegiatan_model->delete_all();
		redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan");
	}

	public function gallery_lock_dokumentasi($bpd_buku_kegiatan='', $id='')
	{
		$this->bpd_kegiatan_model->kunci_kegiatan($id, 1);
		redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan");
	}

	public function gallery_unlock_dokumentasi($bpd_buku_kegiatan='', $id='')
	{
		$this->bpd_kegiatan_model->kunci_kegiatan($id, 2);
		redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan");
	}

	public function urut($id, $arah = 0, $bpd_buku_kegiatan='')
	{
		$this->bpd_kegiatan_model->urut($id, $arah, $bpd_buku_kegiatan);
		if ($bpd_buku_kegiatan != '')
			redirect("bpd_buku_kegiatan/table_dokumentasi/$bpd_buku_kegiatan");
		else
			redirect("bpd_buku_kegiatan/index");
	}
}

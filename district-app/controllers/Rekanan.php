<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Rekanan extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('rekanan_model');
		$this->modul_ini = 11;
		$this->sub_modul_ini = 802;
		$this->set_minsidebar(0);

	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('rekanan');
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

		$data['paging'] = $this->rekanan_model->paging($p,$o);
		$data['main'] = $this->rekanan_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->rekanan_model->autocomplete();

		$this->render('rekanan/daftar_rekanan', $data);
	}

	public function form_rekanan($p=1, $o=0, $id='')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['rekanan'] = $this->rekanan_model->get_rekanan($id);
			$data['form_action'] = site_url("rekanan/update/$id/$p/$o");
		}
		else
		{
			$data['rekanan'] = null;
			$data['form_action'] = site_url("rekanan/insert");
		}

		$this->render('rekanan/form_rekanan', $data);
	}

	public function search($rekanan='')
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		if ($rekanan != '')
		{
			redirect("rekanan/dokumen_rekanan/$rekanan");
		}
		else
		{
			redirect('rekanan');
		}
	}

	public function filter($rekanan='')
	{
		$filter = $this->input->post('filter');
		if ($filter != 0)
			$_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		if ($rekanan != '')
		{
			redirect("rekanan/dokumen_rekanan/$rekanan");
		}
		else
		{
			redirect('rekanan');
		}
	}

	public function insert()
	{
		$this->rekanan_model->insert();
		redirect('rekanan');
	}

	public function update($id='', $p=1, $o=0)
	{
		$this->rekanan_model->update($id);
		redirect("rekanan");
	}

	public function delete($p=1, $o=0, $id='')
	{
		$this->redirect_hak_akses('h', "rekanan/daftar_rekanan/$p/$o");
		$this->rekanan_model->delete_rekanan($id);
		redirect("rekanan/$p/$o");
	}

	public function delete_all($p=1, $o=0)
	{
		$this->redirect_hak_akses('h', "rekanan/daftar_rekanan/$p/$o");
		$_SESSION['success'] = 1;
		$this->rekanan_model->delete_all_rekanan();
		redirect("rekanan/daftar_rekanan/$p/$o");
	}

	public function rekanan_lock($id='', $rekanan='')
	{
		$this->rekanan_model->rekanan_lock($id, 1);
		if ($rekanan != '')
			redirect("rekanan/dokumen_rekanan/$rekanan/$p");
		else
			redirect("rekanan");
	}

	public function rekanan_unlock($id='', $rekanan='')
	{
		$this->rekanan_model->rekanan_lock($id, 2);
		if ($rekanan != '')
			redirect("rekanan/dokumen_rekanan/$rekanan/$p");
		else
			redirect("rekanan");
	}

	public function slider_on($id='', $rekanan='')
	{
		$this->rekanan_model->rekanan_slider($id, 1);
		if ($rekanan != '')
			redirect("rekanan/dokumen_rekanan/$rekanan/$p");
		else
			redirect("rekanan/daftar_rekanan/$p/$o");
	}

	public function slider_off($id='', $rekanan='')
	{
		$this->rekanan_model->rekanan_slider($id,0);
		if ($rekanan != '')
			redirect("rekanan/dokumen_rekanan/$rekanan/$p");
		else
			redirect("rekanan/daftar_rekanan/$p/$o");
	}

	public function dokumen_rekanan($gal=0, $p=1, $o=0)
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

		$data['paging'] = $this->rekanan_model->paging2($gal, $p);
		$data['dokumen_rekanan'] = $this->rekanan_model->list_dokumen_rekanan($gal, $o, $data['paging']->offset, $data['paging']->per_page);
		$data['rekanan'] = $gal;
		$data['data_rekanan'] = $this->rekanan_model->get_rekanan($gal);
		$data['keyword'] = $this->rekanan_model->autocomplete();

		$this->render('rekanan/daftar_rekanan_dok', $data);
	}

	public function form_dokumen_rekanan($rekanan=0, $id=0)
	{
		if ($id)
		{
			$data['rekanan'] = $this->rekanan_model->get_rekanan($id);
			$data['form_action'] = site_url("rekanan/update_dokumen_rekanan/$rekanan/$id");
		}
		else
		{
			$data['rekanan'] = null;
			$data['form_action'] = site_url("rekanan/insert_dokumen_rekanan/$rekanan");
		}
		$data['album']=$rekanan;

		$this->render('rekanan/form_rekanan_dok', $data);
	}

	public function insert_dokumen_rekanan($rekanan='')
	{
		$this->rekanan_model->insert_dokumen_rekanan($rekanan);
		redirect("rekanan/dokumen_rekanan/$rekanan");
	}

	public function update_dokumen_rekanan($rekanan='', $id='')
	{
		$this->rekanan_model->update_dokumen_rekanan($id);
		redirect("rekanan/dokumen_rekanan/$rekanan");
	}

	public function delete_dokumen_rekanan($rekanan='', $id='')
	{
		$this->redirect_hak_akses('h', "rekanan/dokumen_rekanan/$rekanan");
		$this->rekanan_model->delete($id);
		redirect("rekanan/dokumen_rekanan/$rekanan");
	}

	public function delete_all_dokumen_rekanan($rekanan='')
	{
		$this->redirect_hak_akses('h', "rekanan/dokumen_rekanan/$rekanan");
		$_SESSION['success']=1;
		$this->rekanan_model->delete_all();
		redirect("rekanan/dokumen_rekanan/$rekanan");
	}

	public function rekanan_lock_dokumen_rekanan($rekanan='', $id='')
	{
		$this->rekanan_model->rekanan_lock($id, 1);
		redirect("rekanan/dokumen_rekanan/$rekanan");
	}

	public function rekanan_unlock_dokumen_rekanan($rekanan='', $id='')
	{
		$this->rekanan_model->rekanan_lock($id, 2);
		redirect("rekanan/dokumen_rekanan/$rekanan");
	}

	public function urut($id, $arah = 0, $rekanan='')
	{
		$this->rekanan_model->urut($id, $arah, $rekanan);
		if ($rekanan != '')
			redirect("rekanan/dokumen_rekanan/$rekanan");
		else
			redirect("rekanan/index");
	}
}

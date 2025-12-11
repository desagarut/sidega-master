<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bpd_buku_tamu extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('bpd_buku_tamu_model');
		$this->modul_ini = 900;
		$this->sub_modul_ini = 910;
		$this->set_minsidebar(0);
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('bpd_buku_tamu');
	}

	public function index($p = 1, $o = 0)
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
		$data['paging'] = $this->bpd_buku_tamu_model->paging($p, $o);
		$data['main'] = $this->bpd_buku_tamu_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->bpd_buku_tamu_model->autocomplete();

		$this->render('bpd/tamu/buku', $data);
	}

	public function buku_form($id = '')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id) {
			$data['buku_tamu'] = $this->bpd_buku_tamu_model->get_buku($id);
			$data['form_action'] = site_url("bpd_buku_tamu/update/$id");
		} else {
			$data['buku_tamu'] = null;
			$data['form_action'] = site_url("bpd_buku_tamu/insert");
		}

		$this->render('bpd/tamu/buku_form', $data);
	}

	public function search($buku_tamu = '')
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		if ($buku_tamu != '') {
			redirect("bpd_buku_tamu/daftar_tamu/$buku_tamu");
		} else {
			redirect('bpd_buku_tamu');
		}
	}

	public function filter($buku_tamu = '')
	{
		$filter = $this->input->post('filter');
		if ($filter != 0)
			$_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		if ($buku_tamu != '') {
			redirect("bpd_buku_tamu/daftar_tamu/$buku_tamu");
		} else {
			redirect('bpd_buku_tamu');
		}
	}

	public function insert()
	{
		$this->bpd_buku_tamu_model->insert();
		redirect('bpd_buku_tamu');
	}

	public function update($id = '')
	{
		$this->bpd_buku_tamu_model->update($id);
		redirect("bpd_buku_tamu/index/$p/$o");
	}

	public function delete($p = 1, $o = 0, $id = '')
	{
		$this->redirect_hak_akses('h', "gallery/index/$p/$o");
		$this->bpd_buku_tamu_model->delete_gallery($id);
		redirect("bpd_buku_tamu/index/$p/$o");
	}

	public function delete_all($p = 1, $o = 0)
	{
		$this->redirect_hak_akses('h', "gallery/index/$p/$o");
		$_SESSION['success'] = 1;
		$this->bpd_buku_tamu_model->delete_all_gallery();
		redirect("bpd_buku_tamu/index/$p/$o");
	}

	public function gallery_lock($id = '', $gallery = '')
	{
		$this->bpd_buku_tamu_model->gallery_lock($id, 1);
		if ($gallery != '')
			redirect("bpd_buku_tamu/daftar_tamu/$gallery/$p");
		else
			redirect("bpd_buku_tamu/index/$p/$o");
	}

	public function gallery_unlock($id = '', $gallery = '')
	{
		$this->bpd_buku_tamu_model->gallery_lock($id, 2);
		if ($gallery != '')
			redirect("bpd_buku_tamu/daftar_tamu/$gallery/$p");
		else
			redirect("bpd_buku_tamu/index/$p/$o");
	}

	public function slider_on($id = '', $gallery = '')
	{
		$this->bpd_buku_tamu_model->gallery_slider($id, 1);
		if ($gallery != '')
			redirect("bpd_buku_tamu/daftar_tamu/$gallery/$p");
		else
			redirect("bpd_buku_tamu/index/$p/$o");
	}

	public function slider_off($id = '', $gallery = '')
	{
		$this->bpd_buku_tamu_model->gallery_slider($id, 0);
		if ($gallery != '')
			redirect("bpd_buku_tamu/daftar_tamu/$gallery/$p");
		else
			redirect("bpd_buku_tamu/index/$p/$o");
	}

	public function daftar_tamu($gal = 0, $p = 1, $o = 0)
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

		$data['paging'] = $this->bpd_buku_tamu_model->paging2($gal, $p);
		$data['daftar_tamu'] = $this->bpd_buku_tamu_model->list_sub_gallery($gal, $o, $data['paging']->offset, $data['paging']->per_page);
		$data['buku_tamu'] = $gal;
		$data['sub'] = $this->bpd_buku_tamu_model->get_buku($gal);
		$data['keyword'] = $this->bpd_buku_tamu_model->autocomplete();

		$this->render('bpd/tamu/daftar_tamu', $data);
	}

	public function daftar_tamu_form($buku_tamu = 0, $id = 0)
	{
		$d = new DateTime('NOW');
		$data['tanggal'] = $d->format('Y-m-d H:i:s');

		if ($id) {
			$data['buku_tamu'] = $this->bpd_buku_tamu_model->get_buku($id);
			$data['form_action'] = site_url("bpd_buku_tamu/update_data_tamu/$buku_tamu/$id");
		} else {
			$data['buku_tamu'] = null;
			$data['form_action'] = site_url("bpd_buku_tamu/insert_data_tamu/$buku_tamu");
		}
		$data['buku'] = $buku_tamu;

		$this->render('bpd/tamu/daftar_tamu_form', $data);
	}

	public function insert_data_tamu($gallery = '')
	{
		$this->bpd_buku_tamu_model->insert_data_tamu($gallery);
		redirect("bpd_buku_tamu/daftar_tamu/$gallery");
	}

	public function update_data_tamu($gallery = '', $id = '')
	{
		$this->bpd_buku_tamu_model->update_data_tamu($id);
		redirect("bpd_buku_tamu/daftar_tamu/$gallery");
	}

	public function delete_sub_gallery($gallery = '', $id = '')
	{
		$this->redirect_hak_akses('h', "gallery/daftar_tamu/$gallery");
		$this->bpd_buku_tamu_model->delete($id);
		redirect("bpd_buku_tamu/daftar_tamu/$gallery");
	}

	public function delete_all_sub_gallery($gallery = '')
	{
		$this->redirect_hak_akses('h', "gallery/daftar_tamu/$gallery");
		$_SESSION['success'] = 1;
		$this->bpd_buku_tamu_model->delete_all();
		redirect("bpd_buku_tamu/daftar_tamu/$gallery");
	}

	public function gallery_lock_sub_gallery($gallery = '', $id = '')
	{
		$this->bpd_buku_tamu_model->gallery_lock($id, 1);
		redirect("bpd_buku_tamu/daftar_tamu/$gallery");
	}

	public function gallery_unlock_sub_gallery($gallery = '', $id = '')
	{
		$this->bpd_buku_tamu_model->gallery_lock($id, 2);
		redirect("bpd_buku_tamu/daftar_tamu/$gallery");
	}

	public function urut($id, $arah = 0, $gallery = '')
	{
		$this->bpd_buku_tamu_model->urut($id, $arah, $gallery);
		if ($gallery != '')
			redirect("bpd_buku_tamu/daftar_tamu/$gallery");
		else
			redirect("bpd_buku_tamu/index");
	}
}

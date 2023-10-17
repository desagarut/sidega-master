<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lembaga extends Admin_Controller {

	private $_set_page;
	private $_list_session;

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['lembaga_model','referensi_model', 'pamong_model']);
		$this->modul_ini = 200;
		$this->sub_modul_ini = 34;
		$this->_set_page = ['20', '50', '100'];
		$this->_list_session = ['cari', 'filter'];
	}

	public function clear()
	{
		$this->session->unset_userdata($this->_list_session);
		$this->session->per_page = $this->_set_page[0];
		redirect('lembaga');
	}

	public function index($p = 1, $o = 0)
	{
		$data['p'] = $p;
		$data['o'] = $o;

		foreach ($this->_list_session as $list)
		{
			$data[$list] = $this->session->$list ?: '';
		}

		$per_page = $this->input->post('per_page');
		if (isset($per_page))
			$this->session->per_page = $per_page;

		$data['func'] = 'index';
		$data['set_page'] = $this->_set_page;
		$data['filter'] = $this->session->filter;
		$data['paging'] = $this->lembaga_model->paging($p, $o);
		$data['main'] = $this->lembaga_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->lembaga_model->autocomplete();
		$data['list_master'] = $this->lembaga_model->list_master();

		$this->set_minsidebar(1);
		$this->render('lembaga/table', $data);
	}

	public function anggota($id=0)
	{
		$data['lembaga'] = $this->lembaga_model->get_lembaga($id);
		$data['main'] = $this->lembaga_model->list_anggota($id);

		$this->set_minsidebar(1);
		$this->render('lembaga/anggota/table', $data);
	}

	public function form($p = 1, $o = 0, $id = '')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['lembaga'] = $this->lembaga_model->get_lembaga($id);
			$data['form_action'] = site_url("lembaga/update/$p/$o/$id");
		}
		else
		{
			$data['lembaga'] = NULL;
			$data['form_action'] = site_url("lembaga/insert");
		}

		$data['list_master'] = $this->lembaga_model->list_master();
		$data['list_penduduk'] = $this->lembaga_model->list_penduduk();

		$this->set_minsidebar(1);
		$this->render('lembaga/form', $data);
	}

	public function aksi($aksi = '', $id = 0)
	{
		$this->session->set_userdata('aksi', $aksi);

		redirect("lembaga/form_anggota/$id");
	}

	public function form_anggota($id = 0, $id_a = 0)
	{
		if ($id_a == 0)
		{
			$data['lembaga'] = $id;
			$data['pend'] = NULL;
			$data['list_penduduk'] = $this->lembaga_model->list_penduduk($ex_lembaga=$id);
			$data['form_action'] = site_url("lembaga/insert_a/$id");
		}
		else
		{
			$data['lembaga'] = $id;
			$data['pend'] = $this->lembaga_model->get_anggota($id, $id_a);
			$data['list_penduduk'] = $this->lembaga_model->list_penduduk();
			$data['form_action'] = site_url("lembaga/update_a/$id/$id_a");
		}

		$data['list_jabatan'] = $this->referensi_model->list_ref(JABATAN_KELOMPOK);

		$this->set_minsidebar(1);
		$data['list_jabatan'] = $this->referensi_model->list_ref(JABATAN_KELOMPOK);
		$this->render('lembaga/anggota/form', $data);
	}

	/*
	* $aksi = cetak/unduh
	*/
	public function dialog_anggota($aksi = 'cetak', $id = 0)
	{
		$data['aksi'] = ucwords($aksi);
		$data['pamong'] = $this->pamong_model->list_data();
		$data['form_action'] = site_url("lembaga/daftar_anggota/$aksi/$id");

		$this->load->view('global/ttd_pamong', $data);
	}

	/*
	* $aksi = cetak/unduh
	*/
	public function dialog($aksi = 'cetak')
	{
		$data['aksi'] = ucwords($aksi);
		$data['pamong'] = $this->pamong_model->list_data();
		$data['form_action'] = site_url("lembaga/daftar/$aksi");

		$this->load->view('global/ttd_pamong', $data);
	}

	public function daftar($aksi = 'cetak')
	{
		$post = $this->input->post();
		$data['aksi'] = $aksi;
		$data['config'] = $this->header['desa'];
		$data['pamong_ttd'] = $this->pamong_model->get_data($post['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($post['pamong_ketahui']);

		$data['main'] = $this->lembaga_model->list_data();

		$data['file'] = "Data lembaga"; // nama file
		$data['isi'] = "lembaga/cetak";
		$data['letak_ttd'] = ['1', '1', '1'];

		$this->load->view('global/format_cetak', $data);
	}

	public function daftar_anggota($aksi = 'cetak', $id = 0)
	{
		$post = $this->input->post();
		$data['aksi'] = $aksi;
		$data['config'] = $this->header['desa'];
		$data['pamong_ttd'] = $this->pamong_model->get_data($post['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($post['pamong_ketahui']);

		$data['main'] = $this->lembaga_model->list_anggota($id);
		$data['lembaga'] = $this->lembaga_model->get_lembaga($id);

		$data['file'] = "Laporan Data lembaga " . $data['lembaga']['nama']; // nama file
		$data['isi'] = "lembaga/anggota/cetak";
		$data['letak_ttd'] = ['2', '3', '2'];

		$this->load->view('global/format_cetak', $data);
	}

	public function filter($filter)
	{
		$value = $this->input->post($filter);
		if ($value != "")
			$this->session->$filter = $value;
		else $this->session->unset_userdata($filter);
		redirect('lembaga');
	}

	public function insert()
	{
		$this->lembaga_model->insert();
		redirect('lembaga');
	}

	public function update($p = 1, $o = 0, $id = '')
	{
		$this->lembaga_model->update($id);
		redirect("lembaga/index/$p/$o");
	}

	public function delete($id = '')
	{
		$this->redirect_hak_akses('h');
		$this->lembaga_model->delete($id);
		redirect("lembaga");
	}

	public function delete_all()
	{
		$this->redirect_hak_akses('h');
		$this->lembaga_model->delete_all();
		redirect("lembaga");
	}

	public function insert_a($id = 0)
	{
		$this->lembaga_model->insert_a($id);
		$redirect = ($this->session->aksi != 1) ? $_SERVER['HTTP_REFERER'] : "lembaga/anggota/$id";

		$this->session->unset_userdata('aksi');

		redirect($redirect);
	}

	public function update_a($id = '', $id_a = 0)
	{
		$this->lembaga_model->update_a($id, $id_a);
		redirect("lembaga/anggota/$id");
	}

	public function delete_anggota($id = 0, $a=0)
	{
		$this->redirect_hak_akses('h');
		$this->lembaga_model->delete_anggota($a);
		redirect("lembaga/anggota/$id");
	}

	public function delete_anggota_all($id = 0)
	{
		$this->redirect_hak_akses('h');
		$this->lembaga_model->delete_anggota_all();
		redirect("lembaga/anggota/$id");
	}

	public function to_master($id=0)
	{
		$filter = $id;
		if ($filter != 0)
			$this->session->filter = $filter;
		else $this->session->unset_userdata(['filter']);
		redirect('lembaga');
	}
}

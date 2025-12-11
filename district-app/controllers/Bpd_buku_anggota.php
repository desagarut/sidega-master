<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bpd_buku_anggota extends Admin_Controller {

	private $_set_page;
	private $_list_session;

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['bpd_model', 'penduduk_model', 'config_model', 'referensi_model', 'wilayah_model']);
		$this->modul_ini = 900;
		$this->sub_modul_ini = 901;
		$this->_set_page = ['20', '50', '100'];
		$this->_list_session = ['status', 'cari'];
	}

	public function clear()
	{
		$this->session->unset_userdata($this->_list_session);
		$this->session->per_page = $this->_set_page[0];
		redirect('bpd_buku_anggota');
	}

	public function index($p = 1)
	{
		foreach ($this->_list_session as $list)
		{
				$data[$list] = $this->session->$list ?: '';
		}

		$per_page = $this->input->post('per_page');
		if (isset($per_page)) $this->session->per_page = $per_page;

		$data['func'] = 'index';
		$data['set_page'] = $this->_set_page;
		$data['per_page'] = $this->session->per_page;
		$data['paging'] = $this->bpd_model->paging($p);
		$data['main'] = $this->bpd_model->list_data($data['paging']->offset, $data['paging']->per_page);
		$data['keyword'] = $this->bpd_model->autocomplete();
		$data['main_content'] = 'bpd/anggota/buku_anggota_bpd';
		$data['subtitle'] = "Buku Anggota BPD";
		$this->set_minsidebar(0);

		$this->load->view('header', $this->header);
		$this->load->view('nav');
		$this->load->view('bpd/anggota/buku_anggota_bpd', $data);
		$this->load->view('footer');
	}

	public function form($id = 0)
	{
		$id_pend = $this->input->post('id_pend');

		if ($id)
		{
			$data['anggota_bpd'] = $this->bpd_model->get_data($id);
			if (!isset($id_pend)) $id_pend = $data['anggota_bpd']['id_pend'];
			$data['form_action'] = site_url("bpd_buku_anggota/update/$id");
		}
		else
		{
			$data['anggota_bpd'] = NULL;
			$data['form_action'] = site_url("bpd_buku_anggota/insert");
		}
		$data['atasan'] = $this->bpd_model->list_atasan($id);
		$data['penduduk'] = $this->bpd_model->list_penduduk();
		$data['pendidikan_kk'] = $this->referensi_model->list_data('tweb_penduduk_pendidikan_kk');
		$data['agama'] = $this->referensi_model->list_data('tweb_penduduk_agama');

		if (!empty($id_pend))
			$data['individu'] = $this->penduduk_model->get_penduduk($id_pend);
		else
			$data['individu'] = NULL;

		$this->render('bpd/anggota/buku_anggota_bpd_form', $data);
	}

	public function filter($filter)
	{
		$value = $this->input->post($filter);
		if ($value != '')
			$this->session->$filter = $value;
		else $this->session->unset_userdata($filter);
		redirect('bpd_buku_anggota');
	}

	public function insert()
	{
		$this->bpd_model->insert();
		redirect('bpd_buku_anggota');
	}

	public function update($id = 0)
	{
		$this->bpd_model->update($id);
		redirect('bpd_buku_anggota');
	}

	public function delete($id = 0)
	{
		$this->redirect_hak_akses('h', 'bpd_buku_anggota');
		$outp = $this->bpd_model->delete($id);
		redirect('bpd_buku_anggota');
	}

	public function delete_all()
	{
		$this->redirect_hak_akses('h', 'bpd_buku_anggota');
		$this->bpd_model->delete_all();
		redirect('bpd_buku_anggota');
	}

	public function ttd($id = 0, $val = 0)
	{
		$this->bpd_model->ttd('pamong_ttd', $id, $val);
		redirect('bpd_buku_anggota');
	}

	public function ub($id = 0, $val = 0)
	{
		$this->bpd_model->ttd('pamong_ub', $id, $val);
		redirect('bpd_buku_anggota');
	}

	public function urut($p = 1, $id = 0, $arah = 0)
	{
		$this->bpd_model->urut($id, $arah);
		redirect("bpd_buku_anggota/index/$p");
	}

	public function lock($id = 0, $val = 1)
	{
		$this->bpd_model->lock($id, $val);
		redirect("bpd_buku_anggota");
	}

	/*
	 * $aksi = cetak/unduh
	 */
	public function dialog($aksi = 'cetak')
	{
		$data['aksi'] = $aksi;
		$data['anggota_bpd'] = $this->bpd_model->list_data();
		$data['form_action'] = site_url("bpd_buku_anggota/daftar/$aksi");
		$this->load->view('bpd/anggota/ttd_bpd', $data);
	}

	/*
	 * $aksi = cetak/unduh
	 */
	public function daftar($aksi = 'cetak')
	{
		$data['pamong_ttd'] = $this->bpd_model->get_data($this->input->post('pamong_ttd'));
		$data['pamong_ketahui'] = $this->bpd_model->get_data($this->input->post('pamong_ketahui'));
		$data['desa'] = $this->config_model->get_data();
		$data['main'] = $this->bpd_model->list_data();

		$this->load->view('bpd/anggota/'.$aksi, $data);
	}

}

<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Bpd_ekspedisi extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		session_start();
		// Untuk bisa menggunakan helper force_download()
		$this->load->helper('download');
		$this->load->model('bpd_surat_keluar_model');
		$this->load->model('bpd_ekspedisi_model');
		$this->load->model('klasifikasi_model');
		$this->load->model('config_model');
		$this->load->model('bpd_model');
		$this->load->model('header_model');
		$this->modul_ini = 900;
		$this->sub_modul_ini = 908;
		$this->set_minsidebar(0);

	}

	public function clear()
	{
		$this->session->per_page = 20;
		$this->session->cari = NULL;
		$this->session->filter = NULL;
		redirect('bpd_ekspedisi');
	}

	public function index($p = 1, $o = 2)
	{
		$data['p'] = $p;
		$data['o'] = $o;

		$data['cari'] = $this->session->cari ?: '';
		$data['filter'] = $this->session->filter ?: '';
		$this->session->per_page = $this->input->post('per_page') ?: NULL;

		$data['per_page'] = $this->session->per_page;
		$data['paging'] = $this->bpd_ekspedisi_model->paging($p, $o);
		$data['main'] = $this->bpd_ekspedisi_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['tahun_surat'] = $this->bpd_ekspedisi_model->list_tahun_surat();
		$data['keyword'] = $this->bpd_ekspedisi_model->autocomplete();
		$data['main_content'] = 'bpd/ekspedisi/table';
		$data['subtitle'] = "Buku Ekspedisi";
		$data['selected_nav'] = 'ekspedisi';
		$this->set_minsidebar(0);

		$this->load->view('header', $this->header);
		$this->load->view('nav', $nav);
		$this->load->view('bpd/ekspedisi/table', $data);
		$this->load->view('footer');
	}

	public function form($p = 1, $o = 0, $id)
	{
		$data['klasifikasi'] = $this->klasifikasi_model->list_kode();
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['surat_keluar'] = $this->bpd_surat_keluar_model->get_surat_keluar($id);
			$data['form_action'] = site_url("bpd_ekspedisi/update/$p/$o/$id");
		}

		// Buang unique id pada link nama file
		$berkas = explode('__sid__', $data['bpd_surat_keluar']['tanda_terima']);
		$namaFile = $berkas[0];
		$ekstensiFile = explode('.', end($berkas));
		$ekstensiFile = end($ekstensiFile);
		$data['surat_keluar']['tanda_terima'] = $namaFile.'.'.$ekstensiFile;
		$this->set_minsidebar(0);

		$this->load->view('header', $this->header);
		$this->load->view('nav', $nav);
		$this->load->view('bpd/ekspedisi/form', $data);
		$this->load->view('footer');
	}

	public function search()
	{
		$this->session->cari = $this->input->post('cari') ?: NULL;
		redirect('bpd_ekspedisi');
	}

	public function filter()
	{
		$this->session->filter = $this->input->post('filter') ?: NULL;
		redirect('bpd_ekspedisi');
	}

	public function update($p = 1, $o = 0, $id)
	{
		$this->bpd_ekspedisi_model->update($id);
		redirect("bpd_ekspedisi/index/$p/$o");
	}

	public function dialog($aksi = "cetak", $o = 0)
	{
		$data['aksi'] = $aksi;
		$data['pamong'] = $this->bpd_model->list_data();
		$data['tahun_surat'] = $this->bpd_ekspedisi_model->list_tahun_surat();
		$data['form_action'] = site_url("bpd_ekspedisi/daftar/$aksi/$o");
		$this->load->view('bpd/ekspedisi/ajax_cetak', $data);
	}

	public function daftar($aksi = "cetak", $o = 1)
	{
		$data['input'] = $_POST;
		$_SESSION['filter'] = $data['input']['tahun'];
		$data['pamong_ttd'] = $this->bpd_model->get_data($_POST['pamong_ttd']);
		$data['pamong_ketahui'] = $this->bpd_model->get_data($_POST['pamong_ketahui']);
		$data['desa'] = $this->config_model->get_data();
		$data['main'] = $this->bpd_ekspedisi_model->list_data($o, 0, 10000);
		$this->load->view("bpd/ekspedisi/ekspedisi_$aksi", $data);
	}

	/**
	 * Unduh berkas tanda terima berdasarkan kolom surat_keluar.id
	 * @param   integer  $id  ID surat_keluar
	 * @return  void
	 */
	public function unduh_tanda_terima($id)
	{
		// Ambil nama berkas dari database
		$berkas = $this->bpd_ekspedisi_model->get_tanda_terima($id);
		ambilBerkas($berkas, 'bpd_surat_keluar', '__sid__');
	}

	public function bukan_ekspedisi($p = 1, $o = 0, $id)
	{
		$this->bpd_surat_keluar_model->untuk_ekspedisi($id, $masuk = 0);
		redirect("bpd/ekspedisi/index/$p/$o");
	}

}

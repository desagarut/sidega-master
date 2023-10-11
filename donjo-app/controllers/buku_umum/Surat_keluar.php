<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Surat_keluar extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		// Untuk bisa menggunakan helper force_download()
		$this->load->helper('download');
		$this->load->model('surat_keluar_model');
		$this->load->model('klasifikasi_model');
		$this->load->model('config_model');
		$this->load->model('pamong_model');

		$this->load->model('penomoran_surat_model');
		$this->modul_ini = 15;
		$this->sub_modul_ini = 301;
		$this->set_minsidebar(1);

	}

	public function clear($id = 0)
	{
		$this->session->per_page = 20;
		$this->session->surat = $id;
		$this->session->unset_userdata($this->list_session);
		redirect('surat_keluar');
	}

	public function index($p = 1, $o = 2)
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($this->session->has_userdata('cari'))
			$data['cari'] = $this->session->cari;
		else $data['cari'] = '';

		if ($this->session->has_userdata('filter'))
			$data['filter'] = $this->session->filter;
		else $data['filter'] = '';

		if ($this->session->has_userdata('per_page'))
			$this->session->per_page = $this->input->post('per_page');

		$data['per_page'] = $this->session->per_page;
		$data['paging'] = $this->surat_keluar_model->paging($p, $o);
		$data['main'] = $this->surat_keluar_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['tahun_surat'] = $this->surat_keluar_model->list_tahun_surat();
		$data['keyword'] = $this->surat_keluar_model->autocomplete();
		$data['main_content'] = 'surat_keluar/table';
		$data['subtitle'] = "Buku Agenda - Surat Keluar";
		$data['selected_nav'] = 'agenda_keluar';
		$this->set_minsidebar(1);

		$this->load->view('header', $this->header);
		$this->load->view('nav', $nav);
		$this->load->view('ba/umum/main', $data);
		$this->load->view('footer');
	}

	public function form($p = 1, $o = 0, $id = '')
	{
		$data['tujuan'] = $this->surat_keluar_model->autocomplete();
		$data['klasifikasi'] = $this->klasifikasi_model->list_kode();
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['surat_keluar'] = $this->surat_keluar_model->get_surat_keluar($id);
			$data['form_action'] = site_url("surat_keluar/update/$p/$o/$id");
		}
		else
		{
			$last_surat = $this->penomoran_surat_model->get_surat_terakhir('surat_keluar');
			$data['surat_keluar']['nomor_urut'] = $last_surat['no_surat'] + 1;
			$data['form_action'] = site_url("surat_keluar/insert");
		}

		// Buang unique id pada link nama file
		$berkas = explode('__sid__', $data['surat_keluar']['berkas_scan']);
		$namaFile = $berkas[0];
		$ekstensiFile = explode('.', end($berkas));
		$ekstensiFile = end($ekstensiFile);
		$data['surat_keluar']['berkas_scan'] = $namaFile.'.'.$ekstensiFile;
		$this->set_minsidebar(1);

		$this->render('surat_keluar/form', $data);
	}

	public function form_upload($p = 1, $o = 0, $url = '')
	{
		$data['form_action'] = site_url("surat_keluar/upload/$p/$o/$url");
		$this->load->view('surat_keluar/ajax-upload', $data);
	}

	public function search()
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$this->session->cari = $cari;
		else $this->session->unset_userdata('cari');
		redirect('surat_keluar');
	}

	public function filter()
	{
		$filter = $this->input->post('filter');
		if ($filter != 0) $this->session->filter = $filter;
		else $this->session->unset_userdata('filter');
		redirect('surat_keluar');
	}

	public function insert()
	{
		$this->surat_keluar_model->insert();
		redirect('surat_keluar');
	}

	public function update($p = 1, $o = 0, $id = '')
	{
		$this->surat_keluar_model->update($id);
		redirect("surat_keluar/index/$p/$o");
	}

	public function upload($p = 1, $o = 0, $url = '')
	{
		$this->surat_keluar_model->upload($url);
		redirect("surat_keluar/index/$p/$o");
	}

	public function delete($p = 1, $o = 0, $id = '')
	{
		$this->redirect_hak_akses('h', "surat_keluar/index/$p/$o");
		$this->surat_keluar_model->delete($id);
		redirect("surat_keluar/index/$p/$o");
	}

	public function delete_all($p = 1, $o = 0)
	{
		$this->redirect_hak_akses('h',"surat_keluar/index/$p/$o");
		$this->surat_keluar_model->delete_all();
		redirect("surat_keluar/index/$p/$o");
	}

	public function dialog_cetak($o = 0)
	{
		$data['aksi'] = "Cetak";
		$data['pamong'] = $this->pamong_model->list_data();
		$data['tahun_surat'] = $this->surat_keluar_model->list_tahun_surat();
		$data['form_action'] = site_url("surat_keluar/cetak/$o");
		$this->load->view('surat_keluar/ajax_cetak', $data);
	}

	public function dialog_unduh($o = 0)
	{
		$data['aksi'] = "Unduh";
		$data['pamong'] = $this->pamong_model->list_data();
		$data['tahun_surat'] = $this->surat_keluar_model->list_tahun_surat();
		$data['form_action'] = site_url("surat_keluar/unduh/$o");
		$this->load->view('surat_keluar/ajax_cetak', $data);
	}

	public function cetak($o = 0)
	{
		$data['input'] = $this->input->post();
		$this->session->filter = $data['input']['tahun'];
		$data['pamong_ttd'] = $this->pamong_model->get_data($data['input']['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($data['input']['pamong_ketahui']);
		$data['desa'] = $this->config_model->get_data();
		$data['main'] = $this->surat_keluar_model->list_data($o, 0, 10000);
		$this->load->view('surat_keluar/surat_keluar_print', $data);
	}

	public function unduh($o = 0)
	{
		$data['input'] = $this->input->post();
		$this->session->filter = $data['input']['tahun'];
		$data['pamong_ttd'] = $this->pamong_model->get_data($data['input']['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($data['input']['pamong_ketahui']);
		$data['desa'] = $this->config_model->get_data();
		$data['main'] = $this->surat_keluar_model->list_data($o, 0, 10000);
		$this->load->view('surat_keluar/surat_keluar_excel', $data);
	}

	/**
	 * Unduh berkas scan berdasarkan kolom surat_keluar.id
	 * @param   integer  $idSuratMasuk  Id berkas scan pada koloam surat_keluar.id
	 * @return  void
	 */
	public function unduh_berkas_scan($idSuratMasuk)
	{
		// Ambil nama berkas dari database
		$berkas = $this->surat_keluar_model->getNamaBerkasScan($idSuratMasuk);
		ambilBerkas($berkas, 'surat_keluar', '__sid__');
	}

	public function nomor_surat_duplikat()
	{
		if ($this->input->post('nomor_urut') == $this->input->post('nomor_urut_lama'))
			$hasil = false;
		else
			$hasil = $this->penomoran_surat_model->nomor_surat_duplikat('surat_keluar', $this->input->post('nomor_urut'));
   	echo $hasil ? 'false' : 'true';
	}

	public function untuk_ekspedisi($p = 1, $o = 0, $id)
	{
		$this->surat_keluar_model->untuk_ekspedisi($id, $masuk = 1);
		redirect("ekspedisi/index/$p/$o");
	}
}

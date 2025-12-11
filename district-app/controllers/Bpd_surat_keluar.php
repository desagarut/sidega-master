<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bpd_surat_keluar extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Untuk bisa menggunakan helper force_download()
		$this->load->helper('download');
		$this->load->model('bpd_surat_keluar_model');
		$this->load->model('klasifikasi_model');
		$this->load->model('config_model');
		$this->load->model('bpd_model');
		$this->load->model('penomoran_surat_model');
		$this->modul_ini = 900;
		$this->sub_modul_ini = 907;
		$this->_set_page = ['20', '50', '100'];
		$this->set_minsidebar(0);
	}

	public function clear($id = 0)
	{
		$this->session->per_page = 20;
		$this->session->surat = $id;
		$this->session->unset_userdata($this->list_session);
		redirect('bpd_surat_keluar');
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
		$data['paging'] = $this->bpd_surat_keluar_model->paging($p, $o);
		$data['main'] = $this->bpd_surat_keluar_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['tahun_surat'] = $this->bpd_surat_keluar_model->list_tahun_surat();
		$data['keyword'] = $this->bpd_surat_keluar_model->autocomplete();
		$data['main_content'] = 'bpd/surat_keluar/table';
		$data['subtitle'] = "Buku - Surat Keluar";
		$this->set_minsidebar(0);

		$this->load->view('header', $this->header);
		$this->load->view('nav', $nav);
		$this->load->view('bpd/surat_keluar/table', $data);
		$this->load->view('footer');
	}

	public function form($p = 1, $o = 0, $id = '')
	{
		$data['tujuan'] = $this->bpd_surat_keluar_model->autocomplete();
		$data['klasifikasi'] = $this->klasifikasi_model->list_kode();
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id) {
			$data['surat_keluar'] = $this->bpd_surat_keluar_model->get_surat_keluar($id);
			$data['form_action'] = site_url("bpd_surat_keluar/update/$p/$o/$id");
		} else {
			$last_surat = $this->penomoran_surat_bpd_model->get_surat_terakhir('bpd_tbl_surat_keluar');
			$data['surat_keluar']['nomor_urut'] = $last_surat['no_surat'] + 1;
			$data['form_action'] = site_url("bpd_surat_keluar/insert");
		}

		// Buang unique id pada link nama file
		$berkas = explode('__sid__', $data['bpd_surat_keluar']['berkas_scan']);
		$namaFile = $berkas[0];
		$ekstensiFile = explode('.', end($berkas));
		$ekstensiFile = end($ekstensiFile);
		$data['surat_keluar']['berkas_scan'] = $namaFile . '.' . $ekstensiFile;
		$this->set_minsidebar(0);

		$this->render('bpd/surat_keluar/form', $data);
	}

	public function form_upload($p = 1, $o = 0, $url = '')
	{
		$data['form_action'] = site_url("bpd_surat_keluar/upload/$p/$o/$url");
		$this->load->view('bpd/surat_keluar/ajax-upload', $data);
	}

	public function search()
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$this->session->cari = $cari;
		else $this->session->unset_userdata('cari');
		redirect('bpd_surat_keluar');
	}

	public function filter()
	{
		$filter = $this->input->post('filter');
		if ($filter != 0) $this->session->filter = $filter;
		else $this->session->unset_userdata('filter');
		redirect('bpd_surat_keluar');
	}

	public function insert()
	{
		$this->bpd_surat_keluar_model->insert();
		redirect('bpd_surat_keluar');
	}

	public function update($p = 1, $o = 0, $id = '')
	{
		$this->bpd_surat_keluar_model->update($id);
		redirect("bpd_surat_keluar/index/$p/$o");
	}

	public function upload($p = 1, $o = 0, $url = '')
	{
		$this->bpd_surat_keluar_model->upload($url);
		redirect("bpd_surat_keluar/index/$p/$o");
	}

	public function delete($p = 1, $o = 0, $id = '')
	{
		$this->redirect_hak_akses('h', "bpd_surat_keluar/index/$p/$o");
		$this->bpd_surat_keluar_model->delete($id);
		redirect("bpd_surat_keluar/index/$p/$o");
	}

	public function delete_all($p = 1, $o = 0)
	{
		$this->redirect_hak_akses('h', "bpd_surat_keluar/index/$p/$o");
		$this->bpd_surat_keluar_model->delete_all();
		redirect("bpd_surat_keluar/index/$p/$o");
	}

	public function dialog_cetak($o = 0)
	{
		$data['aksi'] = "Cetak";
		$data['pamong'] = $this->bpd_model->list_data();
		$data['tahun_surat'] = $this->bpd_surat_keluar_model->list_tahun_surat();
		$data['form_action'] = site_url("bpd_surat_keluar/cetak/$o");
		$this->load->view('bpd/surat_keluar/ajax_cetak', $data);
	}

	public function dialog_unduh($o = 0)
	{
		$data['aksi'] = "Unduh";
		$data['pamong'] = $this->bpd_model->list_data();
		$data['tahun_surat'] = $this->bpd_surat_keluar_model->list_tahun_surat();
		$data['form_action'] = site_url("bpd_surat_keluar/unduh/$o");
		$this->load->view('bpd/surat_keluar/ajax_cetak', $data);
	}

	public function cetak($o = 0)
	{
		$data['input'] = $this->input->post();
		$this->session->filter = $data['input']['tahun'];
		$data['pamong_ttd'] = $this->bpd_model->get_data($data['input']['pamong_ttd']);
		$data['pamong_ketahui'] = $this->bpd_model->get_data($data['input']['pamong_ketahui']);
		$data['desa'] = $this->config_model->get_data();
		$data['main'] = $this->bpd_surat_keluar_model->list_data($o, 0, 10000);
		$this->load->view('bpd/surat_keluar/surat_keluar_print', $data);
	}

	public function unduh($o = 0)
	{
		$data['input'] = $this->input->post();
		$this->session->filter = $data['input']['tahun'];
		$data['pamong_ttd'] = $this->bpd_model->get_data($data['input']['pamong_ttd']);
		$data['pamong_ketahui'] = $this->bpd_model->get_data($data['input']['pamong_ketahui']);
		$data['desa'] = $this->config_model->get_data();
		$data['main'] = $this->bpd_surat_keluar_model->list_data($o, 0, 10000);
		$this->load->view('bpd/surat_keluar/surat_keluar_excel', $data);
	}

	/**
	 * Unduh berkas scan berdasarkan kolom surat_keluar.id
	 * @param   integer  $idSuratMasuk  Id berkas scan pada koloam surat_keluar.id
	 * @return  void
	 */
	public function unduh_berkas_scan($idSuratMasuk)
	{
		// Ambil nama berkas dari database
		$berkas = $this->bpd_surat_keluar_model->getNamaBerkasScan($idSuratMasuk);
		ambilBerkas($berkas, 'bpd_surat_keluar', '__sid__');
	}

	public function nomor_surat_duplikat()
	{
		if ($this->input->post('nomor_urut') == $this->input->post('nomor_urut_lama'))
			$hasil = false;
		else
			$hasil = $this->penomoran_surat_bpd_model->nomor_surat_duplikat('bpd_tbl_surat_keluar', $this->input->post('nomor_urut'));
		echo $hasil ? 'false' : 'true';
	}

	public function untuk_ekspedisi($p = 1, $o = 0, $id)
	{
		$this->bpd_surat_keluar_model->untuk_ekspedisi($id, $masuk = 1);
		redirect("bpd/ekspedisi/index/$p/$o");
	}
}

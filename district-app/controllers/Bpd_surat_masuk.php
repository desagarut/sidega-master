<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bpd_surat_masuk extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Untuk bisa menggunakan helper force_download()
		$this->load->helper('download');
		$this->load->model('bpd_surat_masuk_model');
		$this->load->model('klasifikasi_model');
		$this->load->model('config_model');
		$this->load->model('bpd_model');

		$this->load->model('penomoran_surat_bpd_model');
		$this->modul_ini = 900;
		$this->sub_modul_ini = 906;
		$this->tab_ini = 2;
		$this->set_minsidebar(0);
	}

	public function clear($id = 0)
	{
		$_SESSION['per_page'] = 20;
		$_SESSION['surat'] = $id;
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('bpd_surat_masuk');
	}

	public function index($p = 1, $o = 2)
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
		$data['paging'] = $this->bpd_surat_masuk_model->paging($p, $o);
		$data['main'] = $this->bpd_surat_masuk_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		$data['bpd'] = $this->bpd_model->list_data();
		$data['tahun_penerimaan'] = $this->bpd_surat_masuk_model->list_tahun_penerimaan();
		$data['keyword'] = $this->bpd_surat_masuk_model->autocomplete();
		$data['main_content'] = 'surat_masuk/table';
		$data['subtitle'] = "Buku Agenda - Surat Masuk";
		$data['selected_nav'] = 'agenda_masuk';
		$this->set_minsidebar(0);

		$this->load->view('header', $this->header);
		$this->load->view('nav', $nav);
		$this->load->view('bpd/surat_masuk/table', $data);
		$this->load->view('footer');
	}

	public function form($p = 1, $o = 0, $id = '')
	{
		$data['pengirim'] = $this->bpd_surat_masuk_model->autocomplete();
		$data['klasifikasi'] = $this->klasifikasi_model->list_kode();
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id) {
			$data['surat_masuk'] = $this->bpd_surat_masuk_model->get_surat_masuk($id);
			$data['form_action'] = site_url("bpd_surat_masuk/update/$p/$o/$id");
			$data['disposisi_surat_masuk'] =
				$this->bpd_surat_masuk_model->get_disposisi_surat_masuk($id);
		} else {
			$last_surat = $this->penomoran_surat_bpd_model->get_surat_terakhir('bpd_tbl_surat_masuk');
			$data['surat_masuk']['nomor_urut'] = $last_surat['no_surat'] + 1;
			$data['form_action'] = site_url("bpd_surat_masuk/insert");
			$data['disposisi_surat_masuk'] = null;
		}
		$data['ref_disposisi'] = $this->bpd_surat_masuk_model->get_pengolah_disposisi();

		// Buang unique id pada link nama file
		$berkas = explode('__sid__', $data['surat_masuk']['berkas_scan']);
		$namaFile = $berkas[0];
		$ekstensiFile = explode('.', end($berkas));
		$ekstensiFile = end($ekstensiFile);
		$data['surat_masuk']['berkas_scan'] = $namaFile . '.' . $ekstensiFile;
		$this->set_minsidebar(0);

		$this->render('bpd/surat_masuk/form', $data);
	}

	public function form_upload($p = 1, $o = 0, $url = '')
	{
		$data['form_action'] = site_url("bpd_surat_masuk/upload/$p/$o/$url");
		$this->load->view('bpd/surat_masuk/ajax-upload', $data);
	}

	public function search()
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		redirect('bpd_surat_masuk');
	}

	public function filter()
	{
		$filter = $this->input->post('filter');
		if ($filter != 0) $_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		redirect('bpd_surat_masuk');
	}

	public function insert()
	{
		$this->bpd_surat_masuk_model->insert();
		redirect('bpd_surat_masuk');
	}

	public function update($p = 1, $o = 0, $id = '')
	{
		$this->bpd_surat_masuk_model->update($id);
		redirect("bpd_surat_masuk/index/$p/$o");
	}

	public function upload($p = 1, $o = 0, $url = '')
	{
		$this->bpd_surat_masuk_model->upload($url);
		redirect("bpd_surat_masuk/index/$p/$o");
	}

	public function delete($p = 1, $o = 0, $id = '')
	{
		$this->redirect_hak_akses('h', "bpd_surat_masuk/index/$p/$o");
		$this->bpd_surat_masuk_model->delete($id);
		redirect("bpd_surat_masuk/index/$p/$o");
	}

	public function delete_all($p = 1, $o = 0)
	{
		$this->redirect_hak_akses('h', "bpd_surat_masuk/index/$p/$o");
		$this->bpd_surat_masuk_model->delete_all();
		redirect("bpd_surat_masuk/index/$p/$o");
	}

	public function dialog_disposisi($o = 0, $id)
	{
		$data['aksi'] = "Cetak";
		$data['anggota_bpd'] = $this->bpd_model->list_data();
		$data['form_action'] = site_url("bpd_surat_masuk/disposisi/$id");
		$this->load->view('bpd/anggota/ttd_bpd', $data);
	}

	public function dialog_cetak($o = 0)
	{
		$data['aksi'] = "Cetak";
		$data['anggota_bpd'] = $this->bpd_model->list_data();
		$data['tahun_surat'] = $this->bpd_surat_masuk_model->list_tahun_surat();
		$data['form_action'] = site_url("bpd_surat_masuk/cetak/$o");
		$this->load->view('bpd/surat_masuk/ajax_cetak', $data);
	}

	public function dialog_unduh($o = 0)
	{
		$data['aksi'] = "Unduh";
		$data['bpd'] = $this->bpd_model->list_data();
		$data['tahun_surat'] = $this->bpd_surat_masuk_model->list_tahun_surat();
		$data['form_action'] = site_url("bpd_surat_masuk/unduh/$o");
		$this->load->view('bpd/surat_masuk/ajax_cetak', $data);
	}

	public function cetak($o = 0)
	{
		$data['input'] = $_POST;
		$_SESSION['filter'] = $data['input']['tahun'];
		$data['pamong_ttd'] = $this->bpd_model->get_data($this->input->post('pamong_ttd'));
		$data['pamong_ketahui'] = $this->bpd_model->get_data($this->input->post('pamong_ketahui'));
		$data['desa'] = $this->config_model->get_data();
		$data['main'] = $this->bpd_surat_masuk_model->list_data($o, 0, 10000);
		$this->load->view('bpd/surat_masuk/surat_masuk_print', $data);
	}

	public function unduh($o = 0)
	{
		$data['input'] = $_POST;
		$_SESSION['filter'] = $data['input']['tahun'];
		$data['pamong_ttd'] = $this->bpd_model->get_data($this->input->post('pamong_ttd'));
		$data['pamong_ketahui'] = $this->bpd_model->get_data($this->input->post('pamong_ketahui'));
		$data['desa'] = $this->config_model->get_data();
		$data['main'] = $this->bpd_surat_masuk_model->list_data($o, 0, 10000);
		$this->load->view('bpd/surat_masuk/surat_masuk_excel', $data);
	}

	public function disposisi($id)
	{
		$data['input'] = $_POST;
		$data['desa'] = $this->config_model->get_data();
		$data['bpd_ttd'] = $this->bpd_model->get_data($_POST['bpd_ketahui']);
		$data['bpd_ketahui'] = $this->bpd_model->get_data_ketua_bpd($_POST['pamong_nama']);
		$data['ref_disposisi'] = $this->bpd_surat_masuk_model->get_pengolah_disposisi();
		$data['disposisi_surat_masuk'] = $this->bpd_surat_masuk_model->get_disposisi_surat_masuk($id);
		$data['surat'] = $this->bpd_surat_masuk_model->get_surat_masuk($id);
		$this->load->view('bpd/surat_masuk/disposisi', $data);
	}

	/**
	 * Unduh berkas scan berdasarkan kolom surat_masuk.id
	 * @param   integer  $idSuratMasuk  Id berkas scan pada koloam surat_masuk.id
	 * @return  void
	 */
	public function unduh_berkas_scan($idSuratMasuk)
	{
		// Ambil nama berkas dari database
		$berkas = $this->bpd_surat_masuk_model->getNamaBerkasScan($idSuratMasuk);
		ambilBerkas($berkas, 'bpd_surat_masuk', '__sid__');
	}

	public function nomor_surat_duplikat()
	{
		if ($_POST['nomor_urut'] == $_POST['nomor_urut_lama'])
			$hasil = false;
		else
			$hasil = $this->penomoran_surat_bpd_model->nomor_surat_duplikat('surat_masuk', $_POST['nomor_urut']);
		echo $hasil ? 'false' : 'true';
	}
}

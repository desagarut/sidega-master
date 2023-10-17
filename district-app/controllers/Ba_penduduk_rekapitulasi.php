<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
SIDEGA
*/
class Ba_penduduk_rekapitulasi extends Admin_Controller {

	private $_set_page;
	private $_list_session;

	public function __construct()
	{
		parent::__construct();

		$this->load->model(['pamong_model', 'penduduk_model', 'referensi_model']);

		$this->modul_ini = 300;
		$this->sub_modul_ini = 303;

		$this->_set_page = ['10', '20', '50', '100'];
		$this->_list_session = ['filter', 'status_dasar', 'sex', 'agama', 'dusun', 'rw', 'rt', 'cari', 'umur_min', 'umur_max', 'umurx', 'pekerjaan_id', 'status', 'pendidikan_sedang_id', 'pendidikan_kk_id', 'status_penduduk', 'judul_statistik', 'cacat', 'cara_kb_id', 'akta_kelahiran', 'status_ktp', 'id_asuransi', 'status_covid', 'penerima_bantuan', 'log', 'warganegara', 'menahun', 'hubungan', 'golongan_darah', 'hamil', 'kumpulan_nik'];
	}

	public function index($page_number=1)
	{
		$per_page = $this->input->post('per_page');
		if (isset($per_page))
			$this->session->per_page = $per_page;

		$data = [
			'main_content' => "ba/penduduk/rekapitulasi/content_rekapitulasi",
			'subtitle' => "Buku Rekapitulasi Jumlah Penduduk",
			'selected_nav' => 'rekapitulasi',
			'p' => $page_number,
			'cari' => $this->session->cari ? $this->session->cari : '',
			'filter' => $this->session->filter ? $this->session->filter : '',
			'per_page' => $this->session->per_page,
			'bulan' => $this->session->filter_bulan ? $this->session->filter_bulan : NULL,
			'tahun' => $this->session->filter_tahun ? $this->session->filter_tahun : NULL,
			'func' => 'index',
			'set_page' => $this->_set_page,
			'tgl_lengkap' => $this->setting->tgl_data_lengkap ? rev_tgl($this->setting->tgl_data_lengkap) : NULL,
			'tgl_lengkap_aktif' => $this->setting->tgl_data_lengkap_aktif,
			'paging' => $this->laporan_bulanan_model->rekapitulasi_paging($page_number),
			'tahun_lengkap' => (new DateTime($this->setting->tgl_data_lengkap))->format('Y'),
		];

		$data['main'] = $this->laporan_bulanan_model->rekapitulasi_list($data['paging']->offset, $data['paging']->per_page);

		$this->set_minsidebar(1);
		$this->render('ba/penduduk/main', $data);
	}

	private function clear_session()
	{
		$this->session->unset_userdata($this->_list_session);
		$this->session->per_page = $this->_set_page[0];
	}

	public function clear()
	{
		$this->clear_session();
		// Set default filter ke tahun dan bulan sekarang
		$this->session->filter_tahun = date('Y');
		$this->session->filter_bulan = date('m');
		redirect('ba_penduduk_rekapitulasi');
	}

	public function ajax_cetak($aksi = '')
	{
		$data = [
			'aksi' => $aksi,
			'list_tahun' => $this->penduduk_log_model->list_tahun(),
			'form_action' => site_url("ba_penduduk_rekapitulasi/cetak/$aksi"),
			'isi' => "ba/penduduk/rekapitulasi/ajax_dialog_rekapitulasi",
		];

		$this->load->view('global/dialog_cetak', $data);
	}

	public function cetak($aksi = '')
	{
		$data = [
			'aksi' => $aksi,
			'config' => $this->header['desa'],
			'pamong_ketahui' => $this->pamong_model->get_ttd(),
			'pamong_ttd' => $this->pamong_model->get_ub(),
			'main' => $this->laporan_bulanan_model->rekapitulasi_list(NULL, NULL),
			'bulan' => $this->session->filter_bulan,
			'tahun' => $this->session->filter_tahun,
			'tgl_cetak' => $_POST['tgl_cetak'],
			'file' => "Buku Rekapitulasi Jumlah Penduduk",
			'isi' => "ba/penduduk/rekapitulasi/content_rekapitulasi_cetak",
			'letak_ttd' => ['1', '2', '28'],
		];
		$this->load->view('global/format_cetak', $data);
	}

	public function autocomplete()
	{
		$data = $this->penduduk_model->autocomplete($this->input->post('cari'));
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function filter($filter)
	{
		$value = $this->input->post($filter);
		if ($value != "")
			$this->session->$filter = $value;
		else $this->session->unset_userdata($filter);
		redirect('ba_penduduk_rekapitulasi');
	}
}

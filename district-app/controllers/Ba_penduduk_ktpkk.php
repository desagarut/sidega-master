<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
SIDEGA
 */

class Ba_penduduk_ktpkk extends Admin_Controller {

	private $_set_page;
	private $_list_session;

	public function __construct()
	{
		parent::__construct();

		$this->load->model(['pamong_model', 'penduduk_model_ba', 'referensi_model']);

		$this->modul_ini = 300;
		$this->sub_modul_ini = 303;

		$this->_set_page = ['10', '20', '50', '100'];
		$this->_list_session = ['filter_tahun', 'filter_bulan', 'filter', 'status_dasar', 'sex', 'agama', 'dusun', 'rw', 'rt', 'cari', 'umur_min', 'umur_max', 'umurx', 'pekerjaan_id', 'status', 'pendidikan_sedang_id', 'pendidikan_kk_id', 'status_penduduk', 'judul_statistik', 'cacat', 'cara_kb_id', 'akta_kelahiran', 'status_ktp', 'id_asuransi', 'status_covid', 'penerima_bantuan', 'log', 'warganegara', 'menahun', 'hubungan', 'golongan_darah', 'hamil', 'kumpulan_nik'];
	}

	public function index($page_number=1, $order_by=0)
	{
		// hanya menampilkan data status_dasar 1 (HIDUP) dan status_penduduk 1 (TETAP)
		$this->session->status_dasar = 1;
		$this->session->status_penduduk = 1;

		if ($this->input->post('per_page')) $this->session->per_page = $this->input->post('per_page');

		$data = [
			'main_content' => "ba/penduduk/ktpkk/content_ktpkk",
			'subtitle' => "Buku KTP dan KK",
			'selected_nav' => 'ktpkk',
			'p' => $page_number,
			'o' => $order_by,
			'cari' => (isset($this->session->cari)) ? $this->session->cari : "",
			'filter' => (isset($this->session->filter)) ? $this->session->filter : "",
			'per_page' => $this->session->per_page,
			'bulan' => (! isset($this->session->filter_bulan)) ? : $this->session->filter_bulan,
			'tahun' => (! isset($this->session->filter_tahun)) ? : $this->session->filter_tahun,
			'func' => 'index',
			'set_page' => $this->_set_page,
			//'paging' => $this->penduduk_model_ba->paging($page_number),
            'paging'       => $list_data['paging'],
			'list_tahun' => $this->penduduk_log_model->list_tahun()
		];

		$data['main'] = $this->penduduk_model_ba->list_data($order_by, $data['paging']->offset, $data['paging']->per_page);

		$this->set_minsidebar(1);
		$this->render('ba/penduduk/main', $data);
	}

	private function clear_session()
	{
		$this->session->unset_userdata($this->_list_session);
		$this->session->status_dasar = 1; // default status dasar = hidup
		$this->session->per_page = $this->_set_page[0];
	}

	public function clear()
	{
		$this->clear_session();
		// Set default filter ke tahun dan bulan sekarang
		$this->session->filter_tahun = date('Y');
		$this->session->filter_bulan = date('m');
		redirect('ba_penduduk_ktpkk');
	}

	public function ajax_cetak($o = 0, $aksi = '')
	{
		$data = [
			'o' => $o,
			'aksi' => $aksi,
			'form_action' => site_url("ba_penduduk_ktpkk/cetak/$o/$aksi"),
			'form_action_privasi' => site_url("ba_penduduk_ktpkk/cetak/$o/$aksi/1"),
			'isi' => "ba/penduduk/ktpkk/ajax_cetak_ktpkk"
		];

		$this->load->view('global/dialog_cetak', $data);
	}

	public function cetak($o = 0, $aksi = '', $privasi_nik = 0)
	{
		$data = [
			'aksi' => $aksi,
			'main' => $this->penduduk_model_ba->list_data($o, 0),
			'config' => $this->header['desa'],
			'pamong_ketahui' => $this->pamong_model->get_ttd(),
			'pamong_ttd' => $this->pamong_model->get_ub(),
			'bulan' => $this->session->filter_bulan ? : date('m'),
			'tahun' => $this->session->filter_tahun ? : date('Y'),
			'tgl_cetak' => $this->input->post('tgl_cetak'),
			// pengaturan data untuk format cetak/unduh
			'file' => "Buku KTP dan KK",
			'isi' => "ba/penduduk/ktpkk/content_ktpkk_cetak",
			'letak_ttd' => ['2', '2', '9']
		];

		if ($privasi_nik == 1) $data['privasi_nik'] = true;

		$this->load->view('global/format_cetak', $data);
	}

	public function autocomplete()
	{
		$data = $this->penduduk_model_ba->autocomplete($this->input->post('cari'));
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function filter($filter)
	{
		$value = $this->input->post($filter);
		if ($value != "") $this->session->$filter = $value;
		else $this->session->unset_userdata($filter);

		$this->session->filter_tahun = $this->input->post('filter_tahun') ? : date('Y');
		$this->session->filter_bulan = $this->input->post('filter_bulan') ? : date('m');
		redirect('ba_penduduk_ktpkk');
	}
}

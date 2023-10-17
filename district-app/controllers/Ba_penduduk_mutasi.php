<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
SIDEGA
 */

class Ba_penduduk_mutasi extends Admin_Controller {

	private $_set_page;
	private $_list_session;

	public function __construct()
	{
		parent::__construct();

		$this->load->model(['pamong_model', 'penduduk_model_ba', 'penduduk_log_model']);

		$this->modul_ini = 300;
		$this->sub_modul_ini = 303;

		$this->_set_page = ['10', '20', '50', '100'];
		$this->_list_session = ['tgl_lengkap', 'filter_tahun', 'filter_bulan', 'filter', 'kode_peristiwa', 'status_dasar', 'cari', 'status', 'status_penduduk'];
	}

	public function index($page_number=1, $order_by=0)
	{
		$per_page = $this->input->post('per_page');
		if (isset($per_page))
			$this->session->per_page = $per_page;

		// Menampilkan hanya kode peristiwa
		$this->session->kode_peristiwa = array(2, 3, 5);
		// Menampilkan hanya status penduduk TETAP
		$this->session->status_penduduk = 1;

		$data = [
			'main_content' => "ba/penduduk/mutasi/content_mutasi",
			'subtitle' => "Buku Mutasi Penduduk",
			'selected_nav' => 'mutasi',
			'p' => $page_number,
			'o' => $order_by,
			'cari' => $this->session->cari ? $this->session->cari : '',
			'filter' => $this->session->filter ? $this->session->filter : '',
			'per_page' => $this->session->per_page,
			'bulan' => $this->session->filter_bulan ? $this->session->filter_bulan : NULL,
			'tahun' => $this->session->filter_tahun ? $this->session->filter_tahun : NULL,
			'func' => 'index',
			'set_page' => $this->_set_page,
			'tgl_lengkap' => $this->setting->tgl_data_lengkap ? rev_tgl($this->setting->tgl_data_lengkap) : NULL,
			'tgl_lengkap_aktif' => $this->setting->tgl_data_lengkap_aktif,
			'paging' => $this->penduduk_log_model->paging($page_number),
			'tahun_lengkap' => (new DateTime($this->setting->tgl_data_lengkap))->format('Y'),
			'data_hapus' => $this->penduduk_log_model->list_data_hapus(),
		];

		$data['main'] = $this->penduduk_log_model->list_data($order_by, $data['paging']->offset, $data['paging']->per_page);

		if ($data['tgl_lengkap'])
			$this->session->tgl_lengkap = $data['tgl_lengkap'];

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
		redirect('ba_penduduk_mutasi');
	}

	public function ajax_cetak($o = 0, $aksi = '')
	{
		// pengaturan data untuk dialog cetak/unduh
		$data = [
			'o' => $o,
			'aksi' => $aksi,
			'list_tahun' => $this->penduduk_log_model->list_tahun(),
			'form_action' => site_url("ba_penduduk_mutasi/cetak/$o/$aksi"),
			'isi' => "ba/penduduk/mutasi/ajax_dialog_mutasi",
		];

		$this->load->view('global/dialog_cetak', $data);
	}

	public function cetak($o = 0, $aksi = '', $privasi_nik = 0)
	{
		$data = [
			'aksi' => $aksi,
			'config' => $this->header['desa'],
			'pamong_ketahui' => $this->pamong_model->get_ttd(),
			'pamong_ttd' => $this->pamong_model->get_ub(),
			'main' => $this->penduduk_log_model->list_data($o, NULL, NULL),
			'bulan' => $this->session->filter_bulan,
			'tahun' => $this->session->filter_tahun,
			'tgl_cetak' => $_POST['tgl_cetak'],
			'file' => "Buku Mutasi Penduduk",
			'isi' => "ba/penduduk/mutasi/content_mutasi_cetak",
			'letak_ttd' => ['1', '2', '8'],
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
		redirect('ba_penduduk_mutasi');
	}
}

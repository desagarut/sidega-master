<?php defined('BASEPATH') or exit('No direct script access allowed');

class Perencanaan_desa extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->modul_ini = 305;
		$this->set_minsidebar(0);

		$this->load->library('upload');
		$this->load->model('perencanaan_desa_model', 'model');
		$this->load->model('perencanaan_desa_dok_model');
		$this->load->model('referensi_model');
		$this->load->model('config_model');
		$this->load->model('wilayah_model');
		$this->load->model('pamong_model');
		$this->load->model('plan_lokasi_model');
		$this->load->model('plan_area_model');
		$this->load->model('plan_garis_model');
		$this->load->model('pamong_model');
	}

	public function index()
	{
		$this->tab_ini = 1;
		$this->sub_modul_ini = 700;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');
			$tahun = $this->input->post('tahun');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->model->get_data()->count_all_results(),
					'recordsFiltered' => $this->model->get_data($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('perencanaan_desa/musdus/index', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function form_usulan_masyarakat($id = '')
	{
		$this->tab_ini = 1;
		$this->sub_modul_ini = 700;

		if ($id) {
			$data['main'] = $this->model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_data('ref_bidang_desa');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['dusun'] = $this->wilayah_model->list_dusun();
			$data['form_action'] = site_url("perencanaan_desa/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_data('ref_bidang_desa');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['dusun'] = $this->wilayah_model->list_dusun();
			$data['form_action'] = site_url("perencanaan_desa/insert");
		}

		$this->render('perencanaan_desa/musdus/usulan_masyarakat_form', $data);
	}

	public function insert()
	{
		$this->model->insert();
		redirect('perencanaan_desa');
	}

	public function update($id = '')
	{
		$this->model->update($id);
		redirect("perencanaan_desa");
	}

	public function delete($id)
	{
		$this->model->delete($id);

		if ($this->db->affected_rows()) {
			$this->session->success = 4;
		} else {
			$this->session->success = -4;
		}

		redirect('perencanaan_desa');
	}

	public function lokasi_maps($id)
	{
		$this->set_minsidebar(1);
		$this->sub_modul_ini = 701;
		$this->tab_ini = 1;

		$data = $this->model->find($id);

		if (is_null($data)) show_404();

		// Update lokasi maps
		if ($request = $this->input->post()) {
			$this->model->update_lokasi_maps($id, $request);

			$this->session->success = 1;

			redirect('perencanaan_desa');
		}

		$this->render('perencanaan_desa/musdus/peta', [
			'data'      => $data,
			'lokasi_pembangunan'	=>	$this->model->find($id),
			'desa'      => $this->config_model->get_data(),
			'wil_atas'  => $this->config_model->get_data(),
			'dusun_gis' => $this->wilayah_model->list_dusun(),
			'rw_gis'    => $this->wilayah_model->list_rw(),
			'rt_gis'    => $this->wilayah_model->list_rt(),
			'all_lokasi' => $this->plan_lokasi_model->list_lokasi(),
			'all_garis' => $this->plan_garis_model->list_garis(),
			'all_area' => $this->plan_area_model->list_area(),
			'list_lokasi_program' => $this->model->list_lokasi_program(),
		]);
	}

	public function dialog_daftar($id = 0, $aksi = '')
	{
		$this->load->view('global/ttd_pamong', [
			'aksi' => $aksi,
			'pamong' => $this->pamong_model->list_data(),
			'pamong_ttd' => $this->pamong_model->get_ub(),
			'pamong_ketahui' => $this->pamong_model->get_ttd(),
			'form_action' => site_url("perencanaan_desa/daftar/$id/$aksi"),
		]);
	}

	public function daftar($id = 0, $aksi = '')
	{
		$request = $this->input->post();

		$perencanaan_desa = $this->model->find($id);
		$dokumentasi = $this->perencanaan_desa_dok_model->find_dokumentasi($perencanaan_desa->id);

		$data['perencanaan_desa']    = $perencanaan_desa;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];
		$data['pamong_ttd']     = $this->pamong_model->get_data($request['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($request['pamong_ketahui']);
		$data['aksi']           = $aksi;
		$data['file']           = "Laporan Pembangunan";
		$data['isi']            = "perencanaan_desa/musdus/cetak";

		$this->load->view('global/format_cetak', $data);
	}

	public function detail_usulan($id = 0)
	{
		$this->tab_ini = 1;
		$this->sub_modul_ini = 701;

		$musdus = $this->model->find($id);
		$dokumentasi = $this->perencanaan_desa_dok_model->find_dokumentasi($musdus->id);

		$data['musdus']    		= $musdus;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];

		$this->render('perencanaan_desa/musdus/detail_usulan', $data);
	}

	public function kerjasama_antar_desa()
	{
		$this->tab_ini = 4;
		$this->sub_modul_ini = 701;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');
			$tahun = $this->input->post('tahun');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->model->get_data()->count_all_results(),
					'recordsFiltered' => $this->model->get_data($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('perencanaan_desa/kerjasama/kerjasama_antar_desa', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function detail_kerjasama_antar_desa($id = 0)
	{
		$this->tab_ini = 4;
		$this->sub_modul_ini = 701;

		$musdus = $this->model->find($id);
		$dokumentasi = $this->perencanaan_desa_dok_model->find_dokumentasi($musdus->id);

		$data['musdus']    = $musdus;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];

		$this->render('perencanaan_desa/kerjasama/detail_kerjasama_antar_desa', $data);
	}

	public function form_kerjasama_antar_desa($id = '')
	{
		$this->tab_ini = 4;
		$this->sub_modul_ini = 701;

		if ($id) {
			$data['main'] = $this->model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_ref(BIDANG_DESA);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("perencanaan_desa/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_ref(BIDANG_DESA);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("perencanaan_desa/insert");
		}

		$this->render('perencanaan_desa/kerjasama/form_kerjasama_antar_desa', $data);
	}

	public function kerjasama_pihak_ketiga()
	{
		$this->tab_ini = 5;
		$this->sub_modul_ini = 701;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');
			$tahun = $this->input->post('tahun');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->model->get_data()->count_all_results(),
					'recordsFiltered' => $this->model->get_data($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('perencanaan_desa/kerjasama/kerjasama_pihak_ketiga', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function detail_kerjasama_pihak_ketiga($id = 0)
	{
		$this->tab_ini = 5;
		$this->sub_modul_ini = 701;

		$musdus = $this->model->find($id);
		$dokumentasi = $this->perencanaan_desa_dok_model->find_dokumentasi($musdus->id);

		$data['musdus']    = $musdus;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];

		$this->render('perencanaan_desa/kerjasama/detail_kerjasama_pihak_ketiga', $data);
	}

	public function form_kerjasama_pihak_ketiga($id = '')
	{
		$this->tab_ini = 5;
		$this->sub_modul_ini = 701;

		if ($id) {
			$data['main'] = $this->model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_ref(BIDANG_DESA);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("perencanaan_desa/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_ref(BIDANG_DESA);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("perencanaan_desa/insert");
		}

		$this->render('perencanaan_desa/kerjasama/form_kerjasama_pihak_ketiga', $data);
	}

	// Start Usulan Dusun //
	public function usulan_dusun()
	{
		$this->tab_ini = 6;
		$this->sub_modul_ini = 702;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');
			$tahun = $this->input->post('tahun');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->model->get_data_usulan()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_usulan($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_usulan($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('perencanaan_desa/usulan_dusun/index', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function form_usulan_desa($id = '')
	{
		$this->tab_ini = 1;
		if ($id) {
			$data['main'] = $this->model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_ref(BIDANG_DESA);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("perencanaan_desa/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_ref(BIDANG_DESA);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("perencanaan_desa/insert");
		}

		$this->render('perencanaan_desa/program_masuk_desa/form', $data);
	}

	public function daftar_polling()
	{
		$this->tab_ini = 7;
		$this->sub_modul_ini = 702;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');
			$tahun = $this->input->post('tahun');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->model->get_data_daftar_polling()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_daftar_polling($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_daftar_polling($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('perencanaan_desa/polling/daftar', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function hasil_polling()
	{
		$this->tab_ini = 8;
		$this->sub_modul_ini = 702;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');
			$tahun = $this->input->post('tahun');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->model->get_data_hasil_polling()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_hasil_polling($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_hasil_polling($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('perencanaan_desa/polling/hasil', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function penetapan_rkpdes()
	{
		$this->tab_ini = 9;
		$this->sub_modul_ini = 700;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');
			$tahun = $this->input->post('tahun');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->model->get_data_rkpdes()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_rkpdes($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_rkpdes($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('perencanaan_desa/rkpdes/penetapan_rkpdes', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}


	public function rkpdes()
	{
		$this->tab_ini = 10;
		$this->sub_modul_ini = 700;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');
			$tahun = $this->input->post('tahun');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->model->get_data_apdes()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_apdes($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_apdes($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('perencanaan_desa/rkpdes/rkpdes', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}
	
	public function dialog_cetak_rkpdes($id = 0, $aksi = '')
	{
		$this->load->view('global/ttd_pamong', [
			'aksi' => $aksi,
			'pamong' => $this->pamong_model->list_data(),
			'pamong_ttd' => $this->pamong_model->get_ub(),
			'pamong_ketahui' => $this->pamong_model->get_ttd(),
			'form_action' => site_url("perencanaan_desa/cetak_rkpdes/$id/$aksi"),
		]);
	}

	public function cetak_rkpdes($id = '', $aksi = '')
	{
		$request = $this->input->post();

		$rkpdes = $this->model->find_rkpdes($id);
		$dokumentasi = $this->perencanaan_desa_dok_model->find_dokumentasi($perencanaan_desa->id);

		$data['perencanaan_desa']    = $rkpdes;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];
		$data['pamong_ttd']     = $this->pamong_model->get_data($request['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($request['pamong_ketahui']);
		$data['aksi']           = $aksi;
		$data['file']           = "Cetak RKP Desa";
		$data['isi']            = "perencanaan_desa/rkpdes/cetak";

		$this->load->view('global/format_cetak', $data);
	}
	
	public function durkpdes()
	{
		$this->tab_ini = 11;
		$this->sub_modul_ini = 700;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');
			$tahun = $this->input->post('tahun');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->model->get_data_durkp()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_durkp($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_durkp($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('perencanaan_desa/rkpdes/durkpdes');
	}
	
	public function dialog_cetak_durkpdes($id = 0, $aksi = '')
	{
		$this->load->view('global/ttd_pamong', [
			'aksi' => $aksi,
			'pamong' => $this->pamong_model->list_data(),
			'pamong_ttd' => $this->pamong_model->get_ub(),
			'pamong_ketahui' => $this->pamong_model->get_ttd(),
			'form_action' => site_url("perencanaan_desa/cetak_durkpdes/$id/$aksi"),
		]);
	}

	public function cetak_durkpdes($id = 0, $aksi = '')
	{
		$request = $this->input->post();

		$durkpdes = $this->model->find_durkpdes($id);
		$dokumentasi = $this->perencanaan_desa_dok_model->find_dokumentasi($perencanaan_desa->id);

		$data['perencanaan_desa']    = $durkpdes;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];
		$data['pamong_ttd']     = $this->pamong_model->get_data($request['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($request['pamong_ketahui']);
		$data['aksi']           = $aksi;
		$data['file']           = "Cetak DU-RKP Desa";
		$data['isi']            = "perencanaan_desa/rkpdes/cetak_durkpdes";

		$this->load->view('global/format_cetak', $data);
	}

	//---- Pelaksanaan Pembangunan --//
	public function pelaksanaan()
	{
		$this->tab_ini = 11;
		$this->sub_modul_ini = 317;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');
			$tahun = $this->input->post('tahun');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->model->get_data_apdes()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_apdes($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_apdes($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('pelaksanaan_pembangunan/index', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	
	//---- Status Aktiv Usulan Musdus ----//
	public function unlock($id)
	{
		$this->model->unlock($id);

		$this->session->success = 1;

		redirect('perencanaan_desa');
	}

	public function lock($id)
	{
		$this->model->lock($id);

		$this->session->success = 1;

		redirect('perencanaan_desa');
	}
	//---- End Ststus Aktive Usulan Musdus ----//

	// Start Vote Desa//
	public function vote($id)
	{
		$this->model->vote($id);

		$this->session->success = 1;

		redirect('perencanaan_desa/usulan_dusun');
	}

	public function unvote($id)
	{
		$this->model->unvote($id);

		$this->session->success = 1;

		redirect('perencanaan_desa/usulan_dusun');
	}
	//End Vote Desa//

	// Start Usulan Ke Desa//
	public function ajukan($id)
	{
		$this->model->ajukan($id);

		$this->session->success = 1;

		redirect('perencanaan_desa');
	}

	public function batalkan($id)
	{
		$this->model->batalkan($id);

		$this->session->success = 1;

		redirect('perencanaan_desa');
	}
	//End Vote Desa//




	// Start Penetapan APBDes//
	public function apbdes_aktiv($id)
	{
		$this->model->apbdes_aktiv($id);

		$this->session->success = 1;

		redirect('perencanaan_desa/penetapan_rkpdes');
	}

	// Start Penetapan APBDes//
	public function durkp_aktiv($id)
	{
		$this->model->durkp_aktiv($id);

		$this->session->success = 1;

		redirect('perencanaan_desa/penetapan_rkpdes');
	}

	//End apbdes Desa//

	// Start Penetapan APBDes//
	public function usulan_kecamatan_aktiv($id)
	{
		$this->model->usulan_kecamatan_aktiv($id);

		$this->session->success = 1;

		redirect('perencanaan_desa/durkpdes');
	}

	// Start Penetapan APBDes//
	public function usulan_kecamatan_non_aktiv($id)
	{
		$this->model->usulan_kecamatan_non_aktiv($id);

		$this->session->success = 1;

		redirect('perencanaan_desa/durkpdes');
	}

	//End apbdes Desa//
}

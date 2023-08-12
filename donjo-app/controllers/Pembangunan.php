<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pembangunan extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->modul_ini = 305;

		$this->load->library('upload');
		$this->load->model('pembangunan_model', 'model');
		$this->load->model('pembangunan_dok_model');
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
		$this->set_minsidebar(1);


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

		$this->render('pembangunan/rencana_kegiatan/index', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function form_usulan_masyarakat($id = '')
	{
		$this->tab_ini = 1;
		$this->sub_modul_ini = 700;
		$this->set_minsidebar(1);

		if ($id) {
			$data['main'] = $this->model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_data('ref_bidang_desa');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['dusun'] = $this->wilayah_model->list_dusun();
			$data['form_action'] = site_url("pembangunan/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_data('ref_bidang_desa');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['dusun'] = $this->wilayah_model->list_dusun();
			$data['form_action'] = site_url("pembangunan/insert");
		}

		$this->render('pembangunan/rencana_kegiatan/form_usulan', $data);
	}

	public function insert()
	{
		$this->model->insert();
		redirect('pembangunan');
	}

	public function update($id = '')
	{
		$this->model->update($id);
		redirect("pembangunan");
	}

	public function delete($id)
	{
		$this->model->delete($id);

		if ($this->db->affected_rows()) {
			$this->session->success = 4;
		} else {
			$this->session->success = -4;
		}

		redirect('pembangunan');
	}

	public function lokasi_maps($id)
	{
		$this->tab_ini = 1;
		$this->sub_modul_ini = 700;
		$this->set_minsidebar(1);

		$data = $this->model->find($id);

		if (is_null($data)) show_404();

		// Update lokasi maps
		if ($request = $this->input->post()) {
			$this->model->update_lokasi_maps($id, $request);

			$this->session->success = 1;

			redirect('pembangunan');
		}

		$this->render('pembangunan/rencana_kegiatan/form_peta', [
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
			'form_action' => site_url("pembangunan/daftar/$id/$aksi"),
		]);
	}

	public function daftar($id = 0, $aksi = '')
	{
		$request = $this->input->post();

		$pembangunan = $this->model->find($id);
		$dokumentasi = $this->pembangunan_dok_model->find_dokumentasi($pembangunan->id);

		$data['pembangunan']    = $pembangunan;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];
		$data['pamong_ttd']     = $this->pamong_model->get_data($request['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($request['pamong_ketahui']);
		$data['aksi']           = $aksi;
		$data['file']           = "Laporan Pembangunan";
		$data['isi']            = "pembangunan/rencana_kegiatan/cetak";

		$this->load->view('global/format_cetak', $data);
	}

	public function detail_usulan($id = 0)
	{
		$this->tab_ini = 1;
		$this->sub_modul_ini = 700;
		$this->set_minsidebar(1);


		$musdus = $this->model->find($id);
		$dokumentasi = $this->pembangunan_dok_model->find_dokumentasi($musdus->id);

		$data['musdus']    		= $musdus;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];

		$this->render('pembangunan/rencana_kegiatan/detail_usulan', $data);
	}

	public function kerjasama_antar_desa()
	{
		$this->tab_ini = 4;
		$this->sub_modul_ini = 701;
		$this->set_minsidebar(1);

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

		$this->render('pembangunan/kerjasama/kerjasama_antar_desa', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function detail_kerjasama_antar_desa($id = 0)
	{
		$this->tab_ini = 4;
		$this->sub_modul_ini = 701;
		$this->set_minsidebar(1);

		$musdus = $this->model->find($id);
		$dokumentasi = $this->pembangunan_dok_model->find_dokumentasi($musdus->id);

		$data['musdus']    = $musdus;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];

		$this->render('pembangunan/kerjasama/detail_kerjasama_antar_desa', $data);
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
			$data['form_action'] = site_url("pembangunan/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_ref(BIDANG_DESA);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/insert");
		}

		$this->render('pembangunan/kerjasama/form_kerjasama_antar_desa', $data);
	}

	public function kerjasama_pihak_ketiga()
	{
		$this->tab_ini = 5;
		$this->sub_modul_ini = 701;
		$this->set_minsidebar(1);

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

		$this->render('pembangunan/kerjasama/kerjasama_pihak_ketiga', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function detail_kerjasama_pihak_ketiga($id = 0)
	{
		$this->tab_ini = 5;
		$this->sub_modul_ini = 701;
		$this->set_minsidebar(1);

		$musdus = $this->model->find($id);
		$dokumentasi = $this->pembangunan_dok_model->find_dokumentasi($musdus->id);

		$data['musdus']    = $musdus;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];

		$this->render('pembangunan/kerjasama/detail_kerjasama_pihak_ketiga', $data);
	}

	public function form_kerjasama_pihak_ketiga($id = '')
	{
		$this->tab_ini = 5;
		$this->sub_modul_ini = 701;
		$this->set_minsidebar(1);

		if ($id) {
			$data['main'] = $this->model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_ref(BIDANG_DESA);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_ref(BIDANG_DESA);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/insert");
		}

		$this->render('pembangunan/kerjasama/form_kerjasama_pihak_ketiga', $data);
	}

	// Start Usulan Dusun //
	public function usulan_dusun()
	{
		$this->tab_ini = 6;
		$this->sub_modul_ini = 702;
		$this->set_minsidebar(1);

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

		$this->render('pembangunan/usulan_dusun/index', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function form_usulan_desa($id = '')
	{
		$this->set_minsidebar(1);
		$this->tab_ini = 1;
		if ($id) {
			$data['main'] = $this->model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_ref(BIDANG_DESA);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_ref(BIDANG_DESA);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/insert");
		}

		$this->render('pembangunan/program_masuk_desa/form', $data);
	}

	public function daftar_polling()
	{
		$this->tab_ini = 7;
		$this->sub_modul_ini = 702;
		$this->set_minsidebar(1);

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

		$this->render('pembangunan/polling/daftar', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function hasil_polling()
	{
		$this->tab_ini = 8;
		$this->sub_modul_ini = 702;
		$this->set_minsidebar(1);

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

		$this->render('pembangunan/polling/hasil', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function penetapan_rkpdes()
	{
		$this->tab_ini = 9;
		$this->sub_modul_ini = 700;
		$this->set_minsidebar(1);

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

		$this->render('pembangunan/rkpdes/penetapan_rkpdes', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}


	public function rkpdes()
	{
		$this->tab_ini = 10;
		$this->sub_modul_ini = 700;
		$this->set_minsidebar(1);

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

		$this->render('pembangunan/rkpdes/rkpdes', [
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
			'form_action' => site_url("pembangunan/cetak_rkpdes/$id/$aksi"),
		]);
	}

	public function cetak_rkpdes($id = '', $aksi = '')
	{
		$request = $this->input->post();

		$rkpdes = $this->model->find_rkpdes($id);
		$dokumentasi = $this->pembangunan_dok_model->find_dokumentasi($pembangunan->id);

		$data['pembangunan']    = $rkpdes;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];
		$data['pamong_ttd']     = $this->pamong_model->get_data($request['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($request['pamong_ketahui']);
		$data['aksi']           = $aksi;
		$data['file']           = "Cetak RKP Desa";
		$data['isi']            = "pembangunan/rkpdes/cetak";

		$this->load->view('global/format_cetak', $data);
	}

	public function durkpdes()
	{
		$this->tab_ini = 11;
		$this->sub_modul_ini = 700;
		$this->set_minsidebar(1);

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

		$this->render('pembangunan/rkpdes/durkpdes');
	}

	public function dialog_cetak_durkpdes($id = 0, $aksi = '')
	{
		$this->load->view('global/ttd_pamong', [
			'aksi' => $aksi,
			'pamong' => $this->pamong_model->list_data(),
			'pamong_ttd' => $this->pamong_model->get_ub(),
			'pamong_ketahui' => $this->pamong_model->get_ttd(),
			'form_action' => site_url("pembangunan/cetak_durkpdes/$id/$aksi"),
		]);
	}

	public function cetak_durkpdes($id = 0, $aksi = '')
	{
		$request = $this->input->post();

		$durkpdes = $this->model->find_durkpdes($id);
		$dokumentasi = $this->pembangunan_dok_model->find_dokumentasi($pembangunan->id);

		$data['pembangunan']    = $durkpdes;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];
		$data['pamong_ttd']     = $this->pamong_model->get_data($request['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($request['pamong_ketahui']);
		$data['aksi']           = $aksi;
		$data['file']           = "Cetak DU-RKP Desa";
		$data['isi']            = "pembangunan/rkpdes/cetak_durkpdes";

		$this->load->view('global/format_cetak', $data);
	}

	//---- Pelaksanaan Pembangunan --//
	public function pelaksanaan()
	{

		$this->tab_ini = 12;
		$this->modul_ini = 305;
		$this->sub_modul_ini = 317;
		$this->set_minsidebar(1);

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
					'recordsTotal'    => $this->model->get_data_pelaksanaan()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_pelaksanaan($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_pelaksanaan($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('pembangunan/pelaksanaan/index', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}


	//---- Status Aktiv Usulan Musdus ----//
	public function unlock($id)
	{
		$this->model->unlock($id);
		$this->session->success = 1;
		redirect('pembangunan');
	}

	public function lock($id)
	{
		$this->model->lock($id);
		$this->session->success = 1;
		redirect('pembangunan');
	}
	//---- End Ststus Aktive Usulan Musdus ----//

	// Start Vote Desa//
	public function vote($id)
	{
		$this->model->vote($id);
		$this->session->success = 1;
		redirect('pembangunan/usulan_dusun');
	}

	public function unvote($id)
	{
		$this->model->unvote($id);
		$this->session->success = 1;
		redirect('pembangunan/usulan_dusun');
	}
	//End Vote Desa//

	// Start Usulan Ke Desa//
	public function ajukan($id)
	{
		$this->model->ajukan($id);
		$this->session->success = 1;
		redirect('pembangunan');
	}

	public function batalkan($id)
	{
		$this->model->batalkan($id);
		$this->session->success = 1;
		redirect('pembangunan');
	}
	//End Vote Desa//

	// Start Penetapan APBDes//
	public function apbdes_aktiv($id)
	{
		$this->model->apbdes_aktiv($id);
		$this->session->success = 1;
		redirect('pembangunan/penetapan_rkpdes');
	}

	// Start Penetapan APBDes//
	public function durkp_aktiv($id)
	{
		$this->model->durkp_aktiv($id);
		$this->session->success = 1;
		redirect('pembangunan/penetapan_rkpdes');
	}

	//End apbdes Desa//

	// Start Penetapan APBDes//
	public function usulan_kecamatan_aktiv($id)
	{
		$this->model->usulan_kecamatan_aktiv($id);

		$this->session->success = 1;

		redirect('pembangunan/durkpdes');
	}

	// Start Penetapan APBDes//
	public function usulan_kecamatan_non_aktiv($id)
	{
		$this->model->usulan_kecamatan_non_aktiv($id);

		$this->session->success = 1;

		redirect('pembangunan/durkpdes');
	}

	//End apbdes Desa//
}

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
		$this->load->model('header_model');
	}

	public function index()
	{
		$this->tab_ini = 1;
		$this->sub_modul_ini = 700;
		$this->set_minsidebar(1);

		$data['usulan_total'] = $this->header_model->usulan_total();

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

		$this->render('pembangunan/perencanaan/index', [
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
			$data['bidang_desa'] = $this->referensi_model->list_data('keuangan_manual_ref_bidang');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['dusun'] = $this->wilayah_model->list_dusun();
			$data['form_action'] = site_url("pembangunan/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_data('keuangan_manual_ref_bidang');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['dusun'] = $this->wilayah_model->list_dusun();
			$data['form_action'] = site_url("pembangunan/insert");
		}

		$this->render('pembangunan/perencanaan/form_usulan', $data);
	}

	public function form_ubah_prioritas($id = '')
	{
		$this->tab_ini = 1;
		$this->sub_modul_ini = 700;
		$this->set_minsidebar(1);

		$data['main'] = $this->model->find($id);
		$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
		$data['bidang_desa'] = $this->referensi_model->list_data('keuangan_manual_ref_bidang');
		$data['pelaksana_kegiatan'] = $this->referensi_model->list_data('data_rekanan');
		$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
		$data['dusun'] = $this->wilayah_model->list_dusun();
		$data['form_action'] = site_url("pembangunan/update_prioritas/$id");

		$this->load->view('pembangunan/prioritas/form_ubah_prioritas', $data);
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


	public function update_prioritas($id = '')
	{
		$this->model->update_prioritas($id);
		redirect("pembangunan/daftar_usulan_tk_desa");
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

		$this->render('pembangunan/perencanaan/form_peta', [
			'data'      => $data,
			'lokasi_pembangunan'	=>	$this->model->find($id),
			'desa'      => $this->config_model->get_data(),
			'wil_atas'  => $this->config_model->get_data(),
			'list_lokasi_program' => $this->model->list_lokasi_program(),
		]);
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

		$this->render('pembangunan/perencanaan/detail_usulan', $data);
	}

	public function dialog($aksi = '')
	{
		$data = [
			'aksi'        => $aksi,
			'form_action' => site_url('pembangunan/cetak/' . $aksi),
			'isi'         => 'pembangunan/ajax_dialog',
			'list_tahun'  => $this->model->list_filter_tahun(),
		];

		$this->load->view('global/dialog_cetak', $data);
	}

	public function cetak($aksi = '')
	{
		$tahun = $this->input->post('tahun');

		$data = [
			'aksi'           => $aksi,
			'config'         => $this->header['desa'],
			'tahun'          => $tahun,
			//'pamong' 		=> $this->pamong_model->list_data(),

			'pamong_ketahui' => $this->pamong_model->get_ttd(),
			'pamong_ttd'     => $this->pamong_model->get_ub(),
			'main'           => $this->model->get_data('', $tahun)->get()->result(),
			'tgl_cetak'      => $this->input->post('tgl_cetak'),
			'file'           => 'Buku Rencana Kerja Pembangunan',
			'isi'            => 'pembangunan/perencanaan/cetak',
			'letak_ttd'      => ['1', '1', '3'],
		];

		$this->load->view('global/format_cetak', $data);
	}

	// Lainnya
	public function lainnya($submenu)
	{
		$this->render('ba/pembangunan/main', [
			'selected_nav' => $submenu,
			'main_content' => 'ba/pembangunan/content_rencana',
		]);
	}


	// END PERENCANAAN


	// Modul Kerjasama Antar Desa
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
			$data['bidang_desa'] = $this->referensi_model->list_data('keuangan_manual_ref_bidang');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_data('keuangan_manual_ref_bidang');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/insert");
		}

		$this->render('pembangunan/kerjasama/form_kerjasama_antar_desa', $data);
	}

	// Modul Kerjasama dengan Pihak Ketiga
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
			$data['bidang_desa'] = $this->referensi_model->list_data('keuangan_manual_ref_bidang');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_data('keuangan_manual_ref_bidang');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/insert");
		}

		$this->render('pembangunan/kerjasama/form_kerjasama_pihak_ketiga', $data);
	}

	//  Modul Perencanaan Pembangunan : Usulan Program/ Kegiatan Tingkat Dusun/Wilayah //
	public function daftar_usulan_tk_desa()
	{
		$this->tab_ini = 6;
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
					'recordsTotal'    => $this->model->get_data_usulan()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_usulan($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_usulan($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('pembangunan/prioritas/daftar_usulan_tk_desa', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function form_usulan_desa($id = '')
	{
		$this->set_minsidebar(1);

		if ($id) {
			$data['main'] = $this->model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_data('keuangan_manual_ref_bidang');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_data('keuangan_manual_ref_bidang');
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/insert");
		}

		$this->render('pembangunan/program_masuk_desa/form', $data);
	}

	// Modul Penentuan Prioritas Program/ Kegiatan Pembangunan: Penentuan Penentuan Prioritas
	public function penentuan_prioritas_tk_desa()
	{
		$this->tab_ini = 7;
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
					'recordsTotal'    => $this->model->get_data_prioritas()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_prioritas($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_prioritas($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('pembangunan/prioritas/penentuan_prioritas_tk_desa', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function hasil_prioritas_tk_desa()
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

		$this->render('pembangunan/prioritas/hasil_prioritas_tk_desa', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}
	// End Penentuan Prioritas

	// Modul Penetapan Program/ Kegiatan Pembangunan 
	public function penetapan_rkp()
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
					'recordsTotal'    => $this->model->get_data_penetapan_rkp()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_penetapan_rkp($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_penetapan_rkp($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('pembangunan/rkpdes/penetapan_rkp', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	// START RKP DESA
	public function daftar_rkp()
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
					'recordsTotal'    => $this->model->get_data_rkp()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_rkp($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_rkp($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('pembangunan/rkpdes/daftar_rkp', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function dialog_rkpdes($aksi = '')
	{
		$data = [
			'aksi'        => $aksi,
			'form_action' => site_url('pembangunan/cetak_rkpdes/' . $aksi),
			'isi'         => 'pembangunan/ajax_dialog',
			'list_tahun'  => $this->model->list_filter_tahun(),
		];

		$this->load->view('global/dialog_cetak', $data);
	}

	public function cetak_rkpdes($aksi = '')
	{
		$tahun = $this->input->post('tahun');

		$data = [
			'aksi'           => $aksi,
			'config'         => $this->header['desa'],
			'tahun'          => $tahun,
			//'pamong' 		=> $this->pamong_model->list_data(),

			'pamong_ketahui' => $this->pamong_model->get_ttd(),
			'pamong_ttd'     => $this->pamong_model->get_ub(),
			'main'           => $this->model->get_data('', $tahun)->get()->result(),
			'tgl_cetak'      => $this->input->post('tgl_cetak'),
			'file'           => 'Daftar Rencana Kerja Pemerintah Desa',
			'isi'            => 'pembangunan/rkpdes/cetak_rkpdes',
			'letak_ttd'      => ['1', '1', '3'],
		];

		$this->load->view('global/format_cetak', $data);
	}

	// DU-RKPDesa
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

	public function dialog_durkpdes($aksi = '')
    {
        $data = [
            'aksi'        => $aksi,
            'form_action' => site_url('pembangunan/cetak_durkpdes/' . $aksi),
            'isi'         => 'pembangunan/ajax_dialog',
            'list_tahun'  => $this->model->list_filter_tahun(),
        ];

        $this->load->view('global/dialog_cetak', $data);
    }

    public function cetak_durkpdes($aksi = '')
    {
        $tahun = $this->input->post('tahun');

        $data = [
            'aksi'           => $aksi,
            'config'         => $this->header['desa'],
            'tahun'          => $tahun,
			//'pamong' 		=> $this->pamong_model->list_data(),

            'pamong_ketahui' => $this->pamong_model->get_ttd(),
            'pamong_ttd'     => $this->pamong_model->get_ub(),
            'main'           => $this->model->get_data('', $tahun)->get()->result(),
            'tgl_cetak'      => $this->input->post('tgl_cetak'),
            'file'           => 'Daftar Rencana Kerja Pemerintah Desa',
            'isi'            => 'pembangunan/rkpdes/cetak_durkpdes',
            'letak_ttd'      => ['1', '1', '3'],
        ];

        $this->load->view('global/format_cetak', $data);
    }

	// Modul Pelaksanaan Program/ Kegiatan Pembangunan --//
	public function pelaksanaan_rkp()
	{
		$this->tab_ini = 12;
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
					'recordsTotal'    => $this->model->get_data_pelaksanaan()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_pelaksanaan($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_pelaksanaan($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('pembangunan/pelaksanaan/pelaksanaan_rkp', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function pelaksanaan_durkp()
	{
		$this->tab_ini = 13;
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
					'recordsTotal'    => $this->model->get_data_pelaksanaan()->count_all_results(),
					'recordsFiltered' => $this->model->get_data_pelaksanaan($search, $tahun)->count_all_results(),
					'data'            => $this->model->get_data_pelaksanaan($search, $tahun)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('pembangunan/pelaksanaan/pelaksanaan_durkp', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	//---- Modul Status Aktiv Usulan Musdus ----//
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

	// Start Vote//
	public function vote($id)
	{
		$this->model->vote($id);
		$this->session->success = 1;
		redirect('pembangunan/penentuan_prioritas_tk_desa');
	}

	public function unvote($id)
	{
		$this->model->unvote($id);
		$this->session->success = 1;
		redirect('pembangunan/daftar_usulan_tk_desa');
	}
	//End Vote//

	// Start Usulan//
	public function ajukan($id)
	{
		$this->model->ajukan($id);
		$this->session->success = 1;
		redirect('pembangunan/daftar_usulan_tk_desa');
	}

	public function batalkan($id)
	{
		$this->model->batalkan($id);
		$this->session->success = 1;
		redirect('pembangunan');
	}
	//End Usulan//

	// Start Penetapan APBDes//
	public function apbdes_aktiv($id)
	{
		$this->model->apbdes_aktiv($id);
		$this->session->success = 1;
		redirect('pembangunan/penetapan_rkp');
	}

	// Start durkp//
	public function durkp_aktiv($id)
	{
		$this->model->durkp_aktiv($id);
		$this->session->success = 1;
		redirect('pembangunan/penetapan_rkp');
	}
	//End durkp//

	// Start durkp//
	public function batal_aktiv($id)
	{
		$this->model->batal_aktiv($id);
		$this->session->success = 1;
		redirect('pembangunan/penetapan_rkp');
	}
	//End durkp//


	// Start Pelaksanaan APBDes//
	public function pelaksanaan_aktiv($id)
	{
		$this->model->pelaksanaan_aktiv($id);
		$this->session->success = 1;
		redirect('pembangunan/pelaksanaan_rkp');
	}

	// Start Pelaksanaan Aktiv//
	public function pelaksanaan_non_aktiv($id)
	{
		$this->model->pelaksanaan_non_aktiv($id);
		$this->session->success = 1;
		redirect('pembangunan/daftar_rkp');
	}


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

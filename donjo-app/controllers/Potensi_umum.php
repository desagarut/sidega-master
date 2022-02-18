<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Potensi_umum extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();

		$this->modul_ini = 200;
		$this->set_minsidebar(1);
		
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->model('potensi_umum_model');
		$this->load->model('potensi_umum_dokumentasi_model');
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
		$this->sub_modul_ini = 600;
		$this->tab_ini == 1;
		if ($this->input->is_ajax_request())
		{
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->potensi_umum_model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');
			$tahun_laporan = $this->input->post('tahun_laporan');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->potensi_umum_model->get_data()->count_all_results(),
					'recordsFiltered' => $this->potensi_umum_model->get_data($search, $tahun_laporan)->count_all_results(),
					'data'            => $this->potensi_umum_model->get_data($search, $tahun_laporan)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('potensi/umum/index', [
			'list_tahun' => $this->potensi_umum_model->list_filter_tahun(),
		]);
	}

	public function form($id = '')
	{
		$this->sub_modul_ini = 600;
		$this->tab_ini == 1;
		if ($id)
		{
			$data['main'] = $this->potensi_umum_model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bulan_laporan'] = $this->referensi_model->list_ref(BULAN);
			$data['form_action'] = site_url("potensi_umum/update/$id");
		}
		else
		{
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bulan_laporan'] = $this->referensi_model->list_ref(BULAN);
			$data['form_action'] = site_url("potensi_umum/insert");
		}

		$this->render('potensi/umum/form', $data);
	}

	public function insert()
	{
		$this->potensi_umum_model->insert();
		redirect('potensi_umum');
	}

	public function update($id = '')
	{
		$this->potensi_umum_model->update($id);
		redirect("potensi_umum");
	}

	public function delete($id)
	{
		$this->potensi_umum_model->delete($id);

		if ($this->db->affected_rows())
		{
			$this->session->success = 4;
		}
		else
		{
			$this->session->success = -4;
		}

		redirect('potensi_umum');
	}

	public function lokasi_maps($id)
	{
		$this->set_minsidebar(0);

		$data = $this->potensi_umum_model->find($id);

		if (is_null($data)) show_404();

		// Update lokasi maps
		if ($request = $this->input->post())
		{
			$this->potensi_umum_model->update_lokasi_maps($id, $request);

			$this->session->success = 1;

			redirect('potensi_umum');
		}

		$this->render('potensi/umum/lokasi_maps', [
			'data'      => $data,
			'desa'      => $this->config_model->get_data(),
			'wil_atas'  => $this->config_model->get_data(),
			'dusun_gis' => $this->wilayah_model->list_dusun(),
			'rw_gis'    => $this->wilayah_model->list_rw(),
			'rt_gis'    => $this->wilayah_model->list_rt(),
			'all_lokasi' => $this->plan_lokasi_model->list_lokasi(),
			'all_garis' => $this->plan_garis_model->list_garis(),
			'all_area' => $this->plan_area_model->list_area(),
			'all_lokasi_kantor_desa' => $this->potensi_umum_model->list_lokasi_kantor_desa(),
		]);
	}

	public function dialog_daftar($id = 0, $aksi = '')
	{
		$this->load->view('global/ttd_pamong', [
			'aksi' => $aksi,
			'pamong' => $this->pamong_model->list_data(),
			'pamong_ttd' => $this->pamong_model->get_ub(),
			'pamong_ketahui' => $this->pamong_model->get_ttd(),
			'form_action' => site_url("potensi/umum/daftar/$id/$aksi"),
		]);
	}

	public function daftar($id = 0, $aksi = '')
	{
		$request = $this->input->post();

		$potensi_umum = $this->potensi_umum_model->find($id);
		$dokumentasi = $this->potensi_umum_dokumentasi_model->find_dokumentasi($potensi_umum->id);

		$data['potensi_umum']    = $potensi_umum;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];
		$data['pamong_ttd']     = $this->pamong_model->get_data($request['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($request['pamong_ketahui']);
		$data['aksi']           = $aksi;
		$data['file']           = "Data Potensi Umum";
		$data['isi']            = "potensi_umum/cetak";

		$this->load->view('global/format_cetak', $data);
	}

	public function info_potensi($id = 0)
	{
		$potensi_umum = $this->potensi_umum_model->find($id);
		$dokumentasi = $this->potensi_umum_dokumentasi_model->find_dokumentasi($potensi_umum->id);
		$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
		$data['bulan_laporan'] = $this->referensi_model->list_ref(BULAN);

		$data['potensi_umum']    = $potensi_umum;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];

		//$this->load->view('potensi/umum/informasi', $data);
		$this->render('potensi/umum/informasi', $data);
	}

	public function unlock($id)
	{
		$this->potensi_umum_model->unlock($id);

		$this->session->success = 1;

		redirect('potensi_umum');
	}

	public function lock($id)
	{
		$this->potensi_umum_model->lock($id);

		$this->session->success = 1;

		redirect('potensi_umum');
	}
}

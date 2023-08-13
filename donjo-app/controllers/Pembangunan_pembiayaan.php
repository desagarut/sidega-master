<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pembangunan_pembiayaan extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->modul_ini = 305;
		$this->set_minsidebar(1);

		$this->load->library('upload');
		//$this->load->model('pembangunan_model');
		$this->load->model('pembangunan_pembiayaan_model', 'model');
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
		$this->tab_ini = 3;
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

		$this->render('pembangunan/pembiayaan/index', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function form($id = '')
	{
		$this->tab_ini = 3;
		$this->sub_modul_ini = 700;

		if ($id) {
			$data['main'] = $this->model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_data('ref_bidang_desa');
			$data['dusun'] = $this->wilayah_model->list_dusun();
			$data['form_action'] = site_url("pembangunan_pembiayaan/update/$id");
		} else {
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['bidang_desa'] = $this->referensi_model->list_data('ref_bidang_desa');
			$data['dusun'] = $this->wilayah_model->list_dusun();
			$data['form_action'] = site_url("pembangunan_pembiayaan/insert");
		}

		$this->render('pembangunan/pembiayaan/form', $data);
	}

	public function insert()
	{
		$this->model->insert();
		redirect('pembangunan_pembiayaan');
	}

	public function update($id = '')
	{
		$this->model->update($id);
		redirect("pembangunan_pembiayaan");
	}

	public function delete($id)
	{
		$this->model->delete($id);

		if ($this->db->affected_rows()) {
			$this->session->success = 4;
		} else {
			$this->session->success = -4;
		}

		redirect('pembangunan_pembiayaan');
	}

	public function dialog_daftar($id = 0, $aksi = '')
	{
		$this->load->view('global/ttd_pamong', [
			'aksi' => $aksi,
			'pamong' => $this->pamong_model->list_data(),
			'pamong_ttd' => $this->pamong_model->get_ub(),
			'pamong_ketahui' => $this->pamong_model->get_ttd(),
			'form_action' => site_url("pembangunan_pembiayaan/daftar/$id/$aksi"),
		]);
	}

	public function daftar($id = 0, $aksi = '')
	{
		$request = $this->input->post();

		$musdus = $this->model->find($id);

		$data['musdus']    		= $musdus;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];
		$data['pamong_ttd']     = $this->pamong_model->get_data($request['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($request['pamong_ketahui']);
		$data['aksi']           = $aksi;
		$data['file']           = "Laporan Musyawarah Dusun";
		$data['isi']            = "pembangunan/pembiayaan/cetak";

		$this->load->view('global/format_cetak', $data);
	}

	public function detail_program($id = 0)
	{
		$this->tab_ini = 3;
		$this->sub_modul_ini = 700;

		$musdus = $this->model->find($id);

		$data['musdus']    = $musdus;
		$data['config']    = $this->header['desa'];

		$this->render('pembangunan/pembiayaan/detail_program', $data);
	}
}

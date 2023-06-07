<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->modul_ini = 305;
		$this->sub_modul_ini = 317;
		$this->set_minsidebar(0);

		$this->load->library('upload');
		$this->load->model('pembangunan_model', 'model');
		$this->load->model('pembangunan_dokumentasi_model');
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
		if ($this->input->is_ajax_request())
		{
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

		$this->render('pembangunan/index', [
			'list_tahun' => $this->model->list_filter_tahun(),
		]);
	}

	public function form($id = '')
	{
		if ($id)
		{
			$data['main'] = $this->model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/update/$id");
		}
		else
		{
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_DANA);
			$data['form_action'] = site_url("pembangunan/insert");
		}

		$this->render('pembangunan/form', $data);
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

		if ($this->db->affected_rows())
		{
			$this->session->success = 4;
		}
		else
		{
			$this->session->success = -4;
		}

		redirect('pembangunan');
	}

	public function lokasi_maps($id)
	{
		$this->set_minsidebar(0);

		$data = $this->model->find($id);

		if (is_null($data)) show_404();

		// Update lokasi maps
		if ($request = $this->input->post())
		{
			$this->model->update_lokasi_maps($id, $request);

			$this->session->success = 1;

			redirect('pembangunan');
		}

		$this->render('pembangunan/lokasi_maps', [
			'data'      => $data,
			'desa'      => $this->config_model->get_data(),
			'wil_atas'  => $this->config_model->get_data(),
			'dusun_gis' => $this->wilayah_model->list_dusun(),
			'rw_gis'    => $this->wilayah_model->list_rw(),
			'rt_gis'    => $this->wilayah_model->list_rt(),
			'all_lokasi' => $this->plan_lokasi_model->list_lokasi(),
			'all_garis' => $this->plan_garis_model->list_garis(),
			'all_area' => $this->plan_area_model->list_area(),
			'all_lokasi_pembangunan' => $this->model->list_lokasi_pembangunan(),
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
		$dokumentasi = $this->pembangunan_dokumentasi_model->find_dokumentasi($pembangunan->id);

		$data['pembangunan']    = $pembangunan;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];
		$data['pamong_ttd']     = $this->pamong_model->get_data($request['pamong_ttd']);
		$data['pamong_ketahui'] = $this->pamong_model->get_data($request['pamong_ketahui']);
		$data['aksi']           = $aksi;
		$data['file']           = "Laporan Pembangunan";
		$data['isi']            = "pembangunan/cetak";

		$this->load->view('global/format_cetak', $data);
	}

	public function info_pembangunan($id = 0)
	{
		$pembangunan = $this->model->find($id);
		$dokumentasi = $this->pembangunan_dokumentasi_model->find_dokumentasi($pembangunan->id);

		$data['pembangunan']    = $pembangunan;
		$data['dokumentasi']    = $dokumentasi;
		$data['config']         = $this->header['desa'];

		$this->load->view('pembangunan/informasi', $data);
	}

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
}

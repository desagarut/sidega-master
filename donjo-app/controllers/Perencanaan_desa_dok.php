<?php defined('BASEPATH') or exit('No direct script access allowed');

class Perencanaan_desa_dok extends Admin_Controller
{
	protected $table = 'tbl_perencanaan_desa_dok';

	public function __construct()
	{
		parent::__construct();

		$this->modul_ini = 700;
		$this->sub_modul_ini = 701;
		$this->set_minsidebar(1);


		$this->load->library('upload');
		$this->load->model('referensi_model');
		$this->load->model('perencanaan_desa_model');
		$this->load->model('perencanaan_desa_dok_model', 'model');
	}

	public function show($id = null)
	{
		$this->tab_ini = 1;

		$musdus_dok = $this->perencanaan_desa_model->find($id);
		$_SESSION['id_perencanaan_desa'] = $id;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->model->get_data($id)->count_all_results(),
					'recordsFiltered' => $this->model->get_data($id, $search)->count_all_results(),
					'data'            => $this->model->get_data($id, $search)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('perencanaan_desa/musdus/dokumentasi/index', [
			'musdus_dok' => $musdus_dok,
		]);
	}

	public function form($id = '')
	{

		$this->tab_ini = 1;

		if ($id) {
			$id_perencanaan_desa = $_SESSION['id_perencanaan_desa'];
			$data['id_perencanaan_desa'] = $_SESSION['id_perencanaan_desa'];
			$data['main'] = $this->model->find($id);
			$data['persentase'] = $this->referensi_model->list_ref(STATUS_PEMBANGUNAN);
			$data['form_action'] = site_url("perencanaan_desa_dok/update/$id/$id_perencanaan_desa");
		} else {
			$id_perencanaan_desa = $_SESSION['id_perencanaan_desa'];
			$data['id_perencanaan_desa'] = $_SESSION['id_perencanaan_desa'];
			$data['main'] = NULL;
			$data['persentase'] = $this->referensi_model->list_ref(STATUS_PEMBANGUNAN);
			$data['form_action'] = site_url("perencanaan_desa_dok/insert/$id_perencanaan_desa");
		}

		$this->render('perencanaan_desa/musdus/dokumentasi/form', $data);
	}

	public function insert($id_perencanaan_desa = '')
	{
		$this->model->insert($id_perencanaan_desa);
		redirect("perencanaan_desa_dok/show/$id_perencanaan_desa");
	}

	public function update($id = '', $id_perencanaan_desa = '')
	{
		$this->model->update($id, $id_perencanaan_desa);
		redirect("perencanaan_desa_dok/show/$id_perencanaan_desa");
	}

	public function delete($id_perencanaan_desa, $id)
	{
		$this->model->delete($id);

		if ($this->db->affected_rows()) {
			$this->session->success = 4;
		} else {
			$this->session->success = -4;
		}

		redirect("perencanaan_desa_dok/show/{$id_perencanaan_desa}");
	}
}

<?php defined('BASEPATH') or exit('No direct script access allowed');

class Perencanaan_desa_polling extends Admin_Controller
{
	protected $table = 'tbl_perencanaan_desa_polling';

	public function __construct()
	{
		parent::__construct();

		$this->modul_ini = 700;
		$this->set_minsidebar(1);

		$this->load->library('upload');
		$this->load->model('referensi_model');
		$this->load->model('pembangunan_model');
		$this->load->model('wilayah_model');
		$this->load->model('perencanaan_desa_polling_model', 'model');
	}

	public function daftar_polling($id = null)
	{
		$polling = $this->pembangunan_model->find($id);
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


		$this->tab_ini = 7;
		$this->sub_modul_ini = 702;


		$this->render('pembangunan/polling/daftar', [
			'polling' => $polling,
		]);
	}

	public function tanggapan_per_item($id = null)
	{
		$polling = $this->pembangunan_model->find($id);
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

		$this->tab_ini = 7;
		$this->sub_modul_ini = 702;


		$this->render('pembangunan/polling/tanggapan_per_item', [
			'polling' => $polling,
		]);
	}

	public function form($id = '')
	{
		if ($id) {
			$id_perencanaan_desa = $_SESSION['id_perencanaan_desa'];
			$data['id_perencanaan_desa'] = $_SESSION['id_perencanaan_desa'];
			$data['main'] = $this->model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['id_pilihan'] = $this->referensi_model->list_ref(PILIHAN_POLLING_1);
			$data['form_action'] = site_url("perencanaan_desa_polling/update/$id/$id_perencanaan_desa");
		} else {
			$id_perencanaan_desa = $_SESSION['id_perencanaan_desa'];
			$data['id_perencanaan_desa'] = $_SESSION['id_perencanaan_desa'];
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['id_pilihan'] = $this->referensi_model->list_ref(PILIHAN_POLLING_1);
			$data['form_action'] = site_url("perencanaan_desa_polling/insert/$id_perencanaan_desa");
		}
		$this->tab_ini = 7;
		$this->sub_modul_ini = 702;

		//$this->render('perencanaan_desa/polling/form', $data);
		$this->load->view('pembangunan/polling/form', $data);
	}

	public function insert($id_perencanaan_desa = '')
	{
		$this->model->insert($id_perencanaan_desa);
		redirect("perencanaan_desa_polling/tanggapan_per_item/$id_perencanaan_desa");
	}

	public function update($id = '', $id_perencanaan_desa = '')
	{
		$this->model->update($id, $id_perencanaan_desa);
		redirect("perencanaan_desa_polling/tanggapan_per_item/$id_perencanaan_desa");
	}

	public function delete($id_perencanaan_desa, $id)
	{
		$this->model->delete($id);

		if ($this->db->affected_rows()) {
			$this->session->success = 4;
		} else {
			$this->session->success = -4;
		}

		redirect("perencanaan_desa_polling/daftar_polling/{$id_perencanaan_desa}");
	}
}

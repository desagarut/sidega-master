<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pembangunan_polling extends Admin_Controller
{
	protected $table = 'tbl_pembangunan_polling';

	public function __construct()
	{
		parent::__construct();

		$this->modul_ini = 305;
		$this->set_minsidebar(1);

		$this->load->library('upload');
		$this->load->model('referensi_model');
		$this->load->model('pembangunan_model');
		$this->load->model('wilayah_model');
		$this->load->model('pembangunan_polling_model');
	}

	public function penentuan_prioritas($id = null)
	{
		$polling = $this->pembangunan_model->find($id);
		$_SESSION['id_pembangunan'] = $id;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->pembangunan_polling_model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->pembangunan_polling_model->get_data_prioritas($id)->count_all_results(),
					'recordsFiltered' => $this->pembangunan_polling_model->get_data_prioritas($id, $search)->count_all_results(),
					'data'            => $this->pembangunan_polling_model->get_data_prioritas($id, $search)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}


		$this->tab_ini = 7;
		$this->sub_modul_ini = 702;


		$this->render('pembangunan/prioritas/daftar', [
			'polling' => $polling,
		]);
	}

	public function tanggapan($id = null)
	{
		$polling = $this->pembangunan_model->find($id);
		$_SESSION['id_pembangunan'] = $id;

		if ($this->input->is_ajax_request()) {
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->pembangunan_polling_model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->pembangunan_polling_model->get_data_prioritas($id)->count_all_results(),
					'recordsFiltered' => $this->pembangunan_polling_model->get_data_prioritas($id, $search)->count_all_results(),
					'data'            => $this->pembangunan_polling_model->get_data_prioritas($id, $search)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->tab_ini = 7;
		$this->sub_modul_ini = 702;


		$this->render('pembangunan/prioritas/tanggapan', [
			'polling' => $polling,
		]);
	}

	public function form_tanggapan($id = '', $id_pembangunan = '')
	{
		if ($id) {
			$id_pembangunan = $_SESSION['id_pembangunan'];
			$data['id_pembangunan'] = $_SESSION['id_pembangunan'];
			$data['main'] = $this->pembangunan_polling_model->find($id);
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['pilihan_tanggapan'] = $this->pembangunan_polling_model->list_tanggapan();
			$data['form_action'] = site_url("pembangunan_polling/update_tanggapan/$id/$id_pembangunan");
		} else {
			$id_pembangunan = $_SESSION['id_pembangunan'];
			$data['id_pembangunan'] = $_SESSION['id_pembangunan'];
			$data['main'] = NULL;
			$data['list_lokasi'] = $this->wilayah_model->list_semua_wilayah();
			$data['pilihan_tanggapan'] = $this->pembangunan_polling_model->list_tanggapan();
			$data['form_action'] = site_url("pembangunan_polling/insert_tanggapan/$id_pembangunan");
		}
		$this->tab_ini = 7;
		$this->sub_modul_ini = 702;

		//$this->render('pembangunan/polling/form', $data);
		$this->load->view('pembangunan/prioritas/form_tanggapan', $data);
	}

	public function insert_tanggapan($id_pembangunan = '')
	{
		$this->pembangunan_polling_model->insert($id_pembangunan);
		redirect("pembangunan_polling/tanggapan/$id_pembangunan");
	}

	public function update_tanggapan($id = '', $id_pembangunan = '')
	{
		$this->pembangunan_polling_model->update($id, $id_pembangunan);
		redirect("pembangunan_polling/tanggapan/$id_pembangunan");
	}

	public function delete_tanggapan($id_pembangunan, $id)
	{
		$this->pembangunan_polling_model->delete($id);

		if ($this->db->affected_rows()) {
			$this->session->success = 4;
		} else {
			$this->session->success = -4;
		}

		redirect("pembangunan_polling/tanggapan/{$id_pembangunan}");
	}
}

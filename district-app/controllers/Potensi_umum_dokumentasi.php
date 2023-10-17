<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Potensi_umum_dokumentasi extends Admin_Controller
{
	protected $table = 'potensi_umum_dokumentasi';

	public function __construct()
	{
		parent::__construct();

		$this->modul_ini = 317;

		$this->load->library('upload');
		$this->load->model('referensi_model');
		$this->load->model('potensi_umum_model');
		$this->load->model('potensi_umum_dokumentasi_model', 'model');
	}

	public function show($id = null)
	{
		$potensi_umum = $this->potensi_umum_model->find($id);
		$_SESSION['id_potensi'] = $id;

		if ($this->input->is_ajax_request())
		{
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

		$this->render('potensi/umum/dokumentasi/index', [
			'potensi_umum' => $potensi_umum,
		]);
	}

	public function form($id = '')
	{
		if ($id)
		{
			$id_potensi = $_SESSION['id_potensi'];
			$data['id_potensi'] = $_SESSION['id_potensi'];
			$data['main'] = $this->model->find($id);
			$data['form_action'] = site_url("potensi_umum_dokumentasi/update/$id/$id_potensi");
		}
		else
		{
			$id_potensi = $_SESSION['id_potensi'];
			$data['id_potensi'] = $_SESSION['id_potensi'];
			$data['main'] = NULL;
			$data['form_action'] = site_url("potensi_umum_dokumentasi/insert/$id_potensi");
		}

		$this->render('potensi/umum/dokumentasi/form', $data);
	}

	public function insert($id_potensi = '')
	{
		$this->model->insert($id_potensi);
		redirect("potensi_umum_dokumentasi/show/$id_potensi");
	}

	public function update($id = '', $id_potensi = '')
	{
		$this->model->update($id, $id_potensi);
		redirect("potensi_umum_dokumentasi/show/$id_potensi");
	}

	public function delete($id_potensi, $id)
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

		redirect("potensi_umum_dokumentasi/show/{$id_potensi}");
	}

}

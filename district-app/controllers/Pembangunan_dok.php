<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan_dok extends Admin_Controller
{
	protected $table = 'tbl_pembangunan_dok';

	public function __construct()
	{
		parent::__construct();

		$this->modul_ini = 305;
		$this->sub_modul_ini = 317;
		$this->set_minsidebar(1);


		$this->load->library('upload');
		$this->load->model('referensi_model');
		$this->load->model('pembangunan_model');
		$this->load->model('pembangunan_dok_model');
	}

	public function show($id = null)
	{
		$this->tab_ini = 12;
		$this->sub_modul_ini = 317;


		$pembangunan = $this->pembangunan_model->find($id);
		$pembangunan_dok = $this->pembangunan_dok_model->find($id);

		$_SESSION['id_pembangunan'] = $id;

		if ($this->input->is_ajax_request())
		{
			$start = $this->input->post('start');
			$length = $this->input->post('length');
			$search = $this->input->post('search[value]');
			$order = $this->pembangunan_dok_model::ORDER_ABLE[$this->input->post('order[0][column]')];
			$dir = $this->input->post('order[0][dir]');

			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'draw'            => $this->input->post('draw'),
					'recordsTotal'    => $this->pembangunan_dok_model->get_data($id)->count_all_results(),
					'recordsFiltered' => $this->pembangunan_dok_model->get_data($id, $search)->count_all_results(),
					'data'            => $this->pembangunan_dok_model->get_data($id, $search)->order_by($order, $dir)->limit($length, $start)->get()->result(),
				]));
		}

		$this->render('pembangunan/pelaksanaan/dokumentasi/index', [
			'pembangunan' => $pembangunan,
			'pembangunan_dok' => $pembangunan_dok,
		]);
	}

	public function form($id = '', $id_pembangunan = '')
	{
		$this->tab_ini = 1;

		if ($id)
		{
			$id_pembangunan = $_SESSION['id_pembangunan'];
			$data['id_pembangunan'] = $_SESSION['id_pembangunan'];
			$data['main'] = $this->pembangunan_dok_model->find($id);
			$data['persentase'] = $this->referensi_model->list_ref(STATUS_PEMBANGUNAN);
			$data['form_action'] = site_url("pembangunan_dok/update/$id/$id_pembangunan");
		}
		else
		{
			$id_pembangunan = $_SESSION['id_pembangunan'];
			$data['id_pembangunan'] = $_SESSION['id_pembangunan'];
			$data['main'] = NULL;
			$data['persentase'] = $this->referensi_model->list_ref(STATUS_PEMBANGUNAN);
			$data['form_action'] = site_url("pembangunan_dok/insert/$id_pembangunan");
		}

		$this->render('pembangunan/pelaksanaan/dokumentasi/form', $data);
	}

	public function insert($id_pembangunan = '')
	{
		$this->pembangunan_dok_model->insert($id_pembangunan);
		redirect("pembangunan_dok/show/$id_pembangunan");
	}


	public function update($id = '', $id_pembangunan = '')
	{
		$this->pembangunan_dok_model->update($id, $id_pembangunan);
		redirect("pembangunan_dok/show/$id_pembangunan");
	}

	public function delete($id_pembangunan, $id)
	{
		$this->pembangunan_dok_model->delete($id);

		if ($this->db->affected_rows())
		{
			$this->session->success = 4;
		}
		else
		{
			$this->session->success = -4;
		}

		redirect("pembangunan_dok/show/{$id_pembangunan}");
	}

}

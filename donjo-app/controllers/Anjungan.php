<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Anjungan extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('anjungan_model');

		$this->modul_ini = 14;
		$this->sub_modul_ini = 312;
	}

	public function index()
	{
		$data['main'] = $this->anjungan_model->list_data();
		$this->render('anjungan/table', $data);
	}

	public function form($id = '')
	{
		if ($id)
		{
			$data['anjungan'] = $this->anjungan_model->get_anjungan($id);
			if (empty($data['anjungan']))
			{
				status_sukses(false, false, '--> Data itu tidak ditemukan');
				redirect('anjungan');
			}
			$data['form_action'] = site_url("anjungan/update/$id");
		}
		else
		{
			$data['suplemen'] = NULL;
			$data['form_action'] = site_url("anjungan/insert");
		}
		$this->render('anjungan/form', $data);
	}

	public function insert()
	{
		$this->anjungan_model->insert();
		redirect('anjungan');
	}

	public function update($id)
	{
		$this->anjungan_model->update($id);
		redirect('anjungan');
	}

	public function delete($id = '')
	{
		$this->redirect_hak_akses('h', 'anjungan');
		$this->anjungan_model->delete($id);
		redirect('anjungan');
	}

	public function lock($id = 0, $val = 1)
	{
		$this->anjungan_model->lock($id, $val);
		redirect('anjungan');
	}

}

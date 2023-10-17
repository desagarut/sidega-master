<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Data_dtks extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['data_dtks_model', 'pamong_model']);
		$this->modul_ini = 6;
		$this->sub_modul_ini = 812;
	}

	public function index()
	{
		$this->session->per_page = 50;

		$sasaran = $this->input->post('sasaran');

		$data['data_dtks'] = $this->data_dtks_model->list_data($sasaran);
		$data['list_sasaran'] = unserialize(SASARAN);
		$data['set_sasaran'] = $sasaran;

		$this->render('data_dtks/data_dtks', $data);
	}

	public function form($id = '')
	{
		if ($id)
		{
			$data['data_dtks'] = $this->data_dtks_model->get_data_dtks($id);
			$data['form_action'] = site_url("data_dtks/ubah/$id");
		}
		else
		{
			$data['data_dtks'] = NULL;
			$data['form_action'] = site_url("data_dtks/tambah");
		}

		$data['list_sasaran'] = unserialize(SASARAN);
		$this->set_minsidebar(0);

		$this->render('data_dtks/form', $data);
	}

	public function tambah()
	{
		$this->data_dtks_model->create();
		redirect('data_dtks');
	}

	public function ubah($id)
	{
		$this->data_dtks_model->update($id);
		redirect('data_dtks');
	}

	public function hapus($id)
	{
		$this->redirect_hak_akses('h');
		$this->data_dtks_model->hapus($id);
		redirect('data_dtks');
	}

	public function panduan()
	{
		$this->render('data_dtks/panduan');
	}

	public function filter($filter)
	{
		## untuk filter pada data rincian suplemen
		$value = $this->input->post($filter);
		$id_rincian = $this->session->id_rincian;
		if ($value != '')
			$this->session->$filter = $value;
		else
			$this->session->unset_userdata($filter);
		redirect("data_dtks/rincian/$id_rincian");
	}

	public function clear($id)
	{
		## untuk filter pada data rincian suplemen
		if ($id)
		{
			$this->session->id_rincian = $id;
			$this->session->unset_userdata('cari');
			redirect("data_dtks/rincian/$id");
		}
	}

	public function rincian($id = '', $p = 1)
	{
		$per_page = $this->input->post('per_page');
		if (isset($per_page))
			$this->session->per_page = $per_page;

		$data = $this->data_dtks_model->get_rincian($p, $id);
		$data['sasaran'] = unserialize(SASARAN);
		$data['func'] = "rincian/$id";
		$data['per_page'] = $this->session->per_page;
		$data['set_page'] = ['20', '50', '100'];
		$data['cari'] = $this->session->cari;
		$this->set_minsidebar(0);

		$this->render('data_dtks/data_dtks_detail', $data);
	}

	public function form_terdata($id)
	{
		$data['sasaran'] = unserialize(SASARAN);
		$data['data_dtks'] = $this->data_dtks_model->get_data_dtks($id);
		$sasaran = $data['data_dtks']['sasaran'];
		$data['list_sasaran'] = $this->data_dtks_model->list_sasaran($id, $sasaran);
		if (isset($_POST['terdata']))
		{
			$data['individu'] = $this->data_dtks_model->get_terdata($_POST['terdata'], $sasaran);
		}
		else
		{
			$data['individu'] = NULL;
		}

		$data['form_action'] = site_url("data_dtks/add_terdata");

		$this->render('data_dtks/form_terdata', $data);
	}

	public function terdata($sasaran = 0, $id = 0)
	{
		$data = $this->data_dtks_model->get_terdata_data_dtks($sasaran, $id);

		$this->render('data_dtks/terdata', $data);
	}

	public function data_terdata($id = 0)
	{
		$data['terdata'] = $this->data_dtks_model->get_data_dtks_terdata_by_id($id);
		$data['data_dtks'] = $this->data_dtks_model->get_data_dtks($data['terdata']['id_data_dtks']);
		$data['individu'] = $this->data_dtks_model->get_terdata($data['terdata']['id_terdata'], $data['data_dtks']['sasaran']);

		$this->render('data_dtks/data_terdata', $data);
	}

	public function edit_terdata_form($id = 0)
	{
		$data = $this->data_dtks_model->get_data_dtks_terdata_by_id($id);
		$data['form_action'] = site_url("data_dtks/edit_terdata/$id");

		$this->load->view('data_dtks/edit_terdata', $data);
	}

	public function add_terdata($id)
	{
		$this->data_dtks_model->add_terdata($_POST, $id);
		redirect("data_dtks/rincian/$id");
	}

	public function edit_terdata($id)
	{
		$this->data_dtks_model->edit_terdata($_POST, $id);
		$id_data_dtks = $_POST['id_data_dtks'];
		redirect("data_dtks/rincian/$id_data_dtks");
	}

	public function hapus_terdata($id_data_dtks, $id_terdata)
	{
		$this->redirect_hak_akses('h');
		$this->data_dtks_model->hapus_terdata($id_terdata);
		redirect("data_dtks/rincian/$id_data_dtks");
	}

	/*
	* $aksi = cetak/unduh
	*/
	public function dialog_daftar($id = 0, $aksi = '')
	{
		$data['aksi'] = $aksi;
		$data['pamong'] = $this->pamong_model->list_data();
		$data['form_action'] = site_url("data_dtks/daftar/$id/$aksi");

		$this->load->view('global/ttd_pamong', $data);
	}

	/*
	* $aksi = cetak/unduh
	*/
	public function daftar($id = 0, $aksi = '')
	{
		if ($id > 0)
		{
			$post = $this->input->post();
			$temp = $this->session->per_page;
			$this->session->per_page = 1000000000; // Angka besar supaya semua data terunduh
			$data = $this->data_dtks_model->get_rincian(1, $id);
			$data['sasaran'] = unserialize(SASARAN);
			$data['config'] = $this->header['desa'];
			$data['pamong_ttd'] = $this->pamong_model->get_data($post['pamong_ttd']);
			$data['pamong_ketahui'] = $this->pamong_model->get_data($post['pamong_ketahui']);
			$data['aksi'] = $aksi;
			$this->session->per_page = $temp;

			//pengaturan data untuk format cetak/ unduh
			$data['file'] = "Laporan Suplemen ".$data['data_dtks']['nama'];
			$data['isi'] = "data_dtks/cetak";
			$data['letak_ttd'] = ['2', '2', '3'];

			$this->load->view('global/format_cetak', $data);
		}
	}

}

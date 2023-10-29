<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Data_balita extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['data_balita_model', 'pamong_model']);
		$this->modul_ini = 340;
		$this->sub_modul_ini = 25;
	}

	public function index()
	{
		$data      = ['selected_nav' => 'data_balita'];

		$this->session->per_page = 50;

		$sasaran = $this->input->post('sasaran');

		$data['data_balita'] = $this->data_balita_model->list_data($sasaran);
		$data['list_sasaran'] = unserialize(SASARAN);
		$data['set_sasaran'] = $sasaran;
		$this->set_minsidebar(1);

		$this->render('kesehatan/data_balita/index', $data);
	}

	public function form($id = '')
	{
		$data      = ['selected_nav' => 'data_balita'];

		if ($id)
		{
			$data['data_balita'] = $this->data_balita_model->get_data_balita($id);
			$data['form_action'] = site_url("data_balita/ubah/$id");
		}
		else
		{
			$data['data_balita'] = NULL;
			$data['form_action'] = site_url("data_balita/tambah");
		}

		$data['list_sasaran'] = unserialize(SASARAN);
		$this->set_minsidebar(1);

		$this->render('kesehatan/data_balita/form', $data);
	}

	public function tambah()
	{
		$this->data_balita_model->create();
		redirect('data_balita');
	}

	public function ubah($id)
	{
		$this->data_balita_model->update($id);
		redirect('data_balita');
	}

	public function hapus($id)
	{
		$this->redirect_hak_akses('h');
		$this->data_balita_model->hapus($id);
		redirect('data_balita');
	}

	public function panduan()
	{
		$this->render('kesehatan/data_balita/panduan');
	}

	public function filter($filter)
	{
		## untuk filter pada data rincian data_balita
		$value = $this->input->post($filter);
		$id_rincian = $this->session->id_rincian;
		if ($value != '')
			$this->session->$filter = $value;
		else
			$this->session->unset_userdata($filter);
		redirect("data_balita/rincian/$id_rincian");
	}

	public function clear($id)
	{
		## untuk filter pada data rincian data_balita
		if ($id)
		{
			$this->session->id_rincian = $id;
			$this->session->unset_userdata('cari');
			redirect("data_balita/rincian/$id");
		}
	}

	public function rincian($id = '', $p = 1)
	{
		$data      = ['selected_nav' => 'data_balita'];

		$per_page = $this->input->post('per_page');

		if (isset($per_page))
			$this->session->per_page = $per_page;

		$data = $this->data_balita_model->get_rincian($p, $id);
		$data['sasaran'] = unserialize(SASARAN);
		$data['func'] = "rincian/$id";
		$data['per_page'] = $this->session->per_page;
		$data['set_page'] = ['20', '50', '100'];
		$data['cari'] = $this->session->cari;
		
		$this->set_minsidebar(1);

		$this->render('kesehatan/data_balita/index_anggota', $data);
	}

	public function form_terdata($id)
	{
		$data      = ['selected_nav' => 'data_balita'];

		$data['sasaran'] = unserialize(SASARAN);
		$data['data_balita'] = $this->data_balita_model->get_data_balita($id);
		$sasaran = $data['data_balita']['sasaran'];
		$data['list_sasaran'] = $this->data_balita_model->list_sasaran($id, $sasaran);
		if (isset($_POST['terdata']))
		{
			$data['individu'] = $this->data_balita_model->get_terdata($_POST['terdata'], $sasaran);
		}
		else
		{
			$data['individu'] = NULL;
		}

		$data['form_action'] = site_url("data_balita/add_terdata");

		$this->render('kesehatan/data_balita/form_terdata', $data);
	}

	public function terdata($sasaran = 0, $id = 0)
	{
		$data      = ['selected_nav' => 'data_balita'];

		$data = $this->data_balita_model->get_terdata_data_balita($sasaran, $id);
		$this->render('kesehatan/data_balita/terdata', $data);
	}

	public function data_terdata($id = 0)
	{
		$data      = ['selected_nav' => 'data_balita'];

		$data['terdata'] = $this->data_balita_model->get_data_balita_terdata_by_id($id);
		$data['data_balita'] = $this->data_balita_model->get_data_balita($data['terdata']['id_data_balita']);
		$data['individu'] = $this->data_balita_model->get_terdata($data['terdata']['id_terdata'], $data['data_balita']['sasaran']);

		$this->render('kesehatan/data_balita/data_terdata', $data);
	}

	public function edit_terdata_form($id = 0)
	{
		$data      = ['selected_nav' => 'data_balita'];

		$data = $this->data_balita_model->get_data_balita_terdata_by_id($id);
		$data['form_action'] = site_url("data_balita/edit_terdata/$id");

		$this->load->view('data_balita/edit_terdata', $data);
	}

	public function add_terdata($id)
	{
		$this->data_balita_model->add_terdata($_POST, $id);
		redirect("data_balita/rincian/$id");
	}

	public function edit_terdata($id)
	{
		$this->data_balita_model->edit_terdata($_POST, $id);
		$id_data_balita = $_POST['id_data_balita'];
		redirect("data_balita/rincian/$id_data_balita");
	}

	public function hapus_terdata($id_data_balita, $id_terdata)
	{
		$this->redirect_hak_akses('h');
		$this->data_balita_model->hapus_terdata($id_terdata);
		redirect("data_balita/rincian/$id_data_balita");
	}

	/*
	* $aksi = cetak/unduh
	*/
	public function dialog_daftar($id = 0, $aksi = '')
	{
		$data['aksi'] = $aksi;
		$data['pamong'] = $this->pamong_model->list_data();
		$data['form_action'] = site_url("data_balita/daftar/$id/$aksi");

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
			$data = $this->data_balita_model->get_rincian(1, $id);
			$data['sasaran'] = unserialize(SASARAN);
			$data['config'] = $this->header['desa'];
			$data['pamong_ttd'] = $this->pamong_model->get_data($post['pamong_ttd']);
			$data['pamong_ketahui'] = $this->pamong_model->get_data($post['pamong_ketahui']);
			$data['aksi'] = $aksi;
			$this->session->per_page = $temp;

			//pengaturan data untuk format cetak/ unduh
			$data['file'] = "Laporan Data Balita ".$data['data_balita']['nama'];
			$data['isi'] = "data_balita/cetak";
			$data['letak_ttd'] = ['2', '2', '3'];

			$this->load->view('global/format_cetak', $data);
		}
	}

}

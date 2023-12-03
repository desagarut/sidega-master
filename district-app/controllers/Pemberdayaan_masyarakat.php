<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pemberdayaan_masyarakat extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['pemberdayaan_masyarakat_model', 'pamong_model']);
		$this->modul_ini = 350;
		$this->sub_modul_ini = 25;
	}

	public function index()
	{
		$this->session->per_page = 50;

		$sasaran = $this->input->post('sasaran');

		$data['pemberdayaan_masyarakat'] = $this->pemberdayaan_masyarakat_model->list_data($sasaran);
		$data['list_sasaran'] = unserialize(SASARAN);
		$data['set_sasaran'] = $sasaran;
		$this->set_minsidebar(1);

		$this->render('pemberdayaan_masyarakat/daftar_kegiatan', $data);
	}

	public function form_kegiatan($id = '')
	{
		if ($id)
		{
			$data['pemberdayaan_masyarakat'] = $this->pemberdayaan_masyarakat_model->get_pemberdayaan_masyarakat($id);
			$data['form_action'] = site_url("pemberdayaan_masyarakat/ubah/$id");
		}
		else
		{
			$data['pemberdayaan_masyarakat'] = NULL;
			$data['form_action'] = site_url("pemberdayaan_masyarakat/tambah");
		}

		$data['list_sasaran'] = unserialize(SASARAN);
		$this->set_minsidebar(1);

		$this->render('pemberdayaan_masyarakat/form_kegiatan', $data);
	}

	public function tambah()
	{
		$this->pemberdayaan_masyarakat_model->create();
		redirect('pemberdayaan_masyarakat');
	}

	public function ubah($id)
	{
		$this->pemberdayaan_masyarakat_model->update($id);
		redirect('pemberdayaan_masyarakat');
	}

	public function hapus($id)
	{
		$this->redirect_hak_akses('h');
		$this->pemberdayaan_masyarakat_model->hapus($id);
		redirect('pemberdayaan_masyarakat');
	}

	public function panduan()
	{
		$this->render('pemberdayaan_masyarakat/panduan');
	}

	public function filter($filter)
	{
		## untuk filter pada data rincian pemberdayaan_masyarakat
		$value = $this->input->post($filter);
		$id_rincian = $this->session->id_rincian;
		if ($value != '')
			$this->session->$filter = $value;
		else
			$this->session->unset_userdata($filter);
		redirect("pemberdayaan_masyarakat/rincian/$id_rincian");
	}

	public function clear($id)
	{
		## untuk filter pada data rincian pemberdayaan_masyarakat
		if ($id)
		{
			$this->session->id_rincian = $id;
			$this->session->unset_userdata('cari');
			redirect("pemberdayaan_masyarakat/rincian/$id");
		}
	}

	public function rincian($id = '', $p = 1)
	{
		$per_page = $this->input->post('per_page');
		if (isset($per_page))
			$this->session->per_page = $per_page;

		$data = $this->pemberdayaan_masyarakat_model->get_rincian($p, $id);
		$data['sasaran'] = unserialize(SASARAN);
		$data['func'] = "rincian/$id";
		$data['per_page'] = $this->session->per_page;
		$data['set_page'] = ['20', '50', '100'];
		$data['cari'] = $this->session->cari;
		$this->set_minsidebar(1);

		$this->render('pemberdayaan_masyarakat/daftar_peserta', $data);
	}

	public function form_peserta($id)
	{
		$data['sasaran'] = unserialize(SASARAN);
		$data['pemberdayaan_masyarakat'] = $this->pemberdayaan_masyarakat_model->get_pemberdayaan_masyarakat($id);
		$sasaran = $data['pemberdayaan_masyarakat']['sasaran'];
		$data['list_sasaran'] = $this->pemberdayaan_masyarakat_model->list_sasaran($id, $sasaran);
		if (isset($_POST['peserta']))
		{
			$data['individu'] = $this->pemberdayaan_masyarakat_model->get_peserta($_POST['peserta'], $sasaran);
		}
		else
		{
			$data['individu'] = NULL;
		}

		$data['form_action'] = site_url("pemberdayaan_masyarakat/add_peserta");

		$this->render('pemberdayaan_masyarakat/form_peserta', $data);
	}

	public function peserta($sasaran = 0, $id = 0)
	{
		$data = $this->pemberdayaan_masyarakat_model->get_peserta_pemberdayaan_masyarakat($sasaran, $id);

		$this->render('pemberdayaan_masyarakat/peserta', $data);
	}

	public function data_peserta($id = 0)
	{
		$data['peserta'] = $this->pemberdayaan_masyarakat_model->get_pemberdayaan_masyarakat_peserta_by_id($id);
		$data['pemberdayaan_masyarakat'] = $this->pemberdayaan_masyarakat_model->get_pemberdayaan_masyarakat($data['peserta']['id_kegiatan']);
		$data['individu'] = $this->pemberdayaan_masyarakat_model->get_peserta($data['peserta']['id_peserta'], $data['pemberdayaan_masyarakat']['sasaran']);

		$this->render('pemberdayaan_masyarakat/data_peserta', $data);
	}

	public function edit_peserta_form($id = 0)
	{
		$data = $this->pemberdayaan_masyarakat_model->get_pemberdayaan_masyarakat_peserta_by_id($id);
		$data['form_action'] = site_url("pemberdayaan_masyarakat/edit_peserta/$id");

		$this->load->view('pemberdayaan_masyarakat/edit_peserta', $data);
	}

	public function add_peserta($id)
	{
		$this->pemberdayaan_masyarakat_model->add_peserta($_POST, $id);
		redirect("pemberdayaan_masyarakat/rincian/$id");
	}

	public function edit_peserta($id)
	{
		$this->pemberdayaan_masyarakat_model->edit_peserta($_POST, $id);
		$id_kegiatan = $_POST['id_kegiatan'];
		redirect("pemberdayaan_masyarakat/rincian/$id_kegiatan");
	}

	public function hapus_peserta($id_kegiatan, $id_peserta)
	{
		$this->redirect_hak_akses('h');
		$this->pemberdayaan_masyarakat_model->hapus_peserta($id_peserta);
		redirect("pemberdayaan_masyarakat/rincian/$id_kegiatan");
	}

	/*
	* $aksi = cetak/unduh
	*/
	public function dialog_daftar($id = 0, $aksi = '')
	{
		$data['aksi'] = $aksi;
		$data['pamong'] = $this->pamong_model->list_data();
		$data['form_action'] = site_url("pemberdayaan_masyarakat/daftar/$id/$aksi");

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
			$data = $this->pemberdayaan_masyarakat_model->get_rincian(1, $id);
			$data['sasaran'] = unserialize(SASARAN);
			$data['config'] = $this->header['desa'];
			$data['pamong_ttd'] = $this->pamong_model->get_data($post['pamong_ttd']);
			$data['pamong_ketahui'] = $this->pamong_model->get_data($post['pamong_ketahui']);
			$data['aksi'] = $aksi;
			$this->session->per_page = $temp;

			//pengaturan data untuk format cetak/ unduh
			$data['file'] = "Laporan Pemberdayaan Masyarakat ".$data['pemberdayaan_masyarakat']['nama'];
			$data['isi'] = "pemberdayaan_masyarakat/cetak";
			$data['letak_ttd'] = ['2', '2', '3'];

			$this->load->view('global/format_cetak', $data);
		}
	}

}

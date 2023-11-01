<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pemberdayaan_masyarakat extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['pemberdayaan_masyarakat_model', 'pamong_model']);
		$this->modul_ini = 350;
		$this->sub_modul_ini = 350;
	}

	public function index()
	{
		$this->session->per_page = 50;

		$sasaran = $this->input->post('sasaran');

		$data['pemas'] = $this->pemberdayaan_masyarakat_model->list_data($sasaran);
		$data['list_sasaran'] = unserialize(SASARAN);
		$data['set_sasaran'] = $sasaran;

		$this->render('pemberdayaan_masyarakat/daftar_kegiatan', $data);
	}

	public function form_kegiatan($id = '')
	{
		if ($id)
		{
			$data['pemas'] = $this->pemberdayaan_masyarakat_model->get_pemas($id);
			$data['form_action'] = site_url("pemberdayaan_masyarakat/ubah_kegiatan/$id");
		}
		else
		{
			$data['pemas'] = NULL;
			$data['form_action'] = site_url("pemberdayaan_masyarakat/tambah");
		}

		$data['list_sasaran'] = unserialize(SASARAN);
		$this->set_minsidebar(0);

		$this->render('pemberdayaan_masyarakat/form_kegiatan', $data);
	}

	public function tambah()
	{
		$this->pemberdayaan_masyarakat_model->create();
		redirect('pemberdayaan_masyarakat');
	}

	public function ubah_kegiatan($id)
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
		## untuk filter pada data daftar_peserta pemas
		$value = $this->input->post($filter);
		$id_peserta = $this->session->id_peserta;
		if ($value != '')
			$this->session->$filter = $value;
		else
			$this->session->unset_userdata($filter);
		redirect("pemberdayaan_masyarakat/daftar_peserta/$id_peserta");
	}

	public function clear($id)
	{
		## untuk filter pada data daftar_peserta pemas
		if ($id)
		{
			$this->session->id_daftar_peserta = $id;
			$this->session->unset_userdata('cari');
			redirect("pemberdayaan_masyarakat/daftar_peserta/$id");
		}
	}

	public function daftar_peserta($id = '', $p = 1)
	{
		$per_page = $this->input->post('per_page');
		if (isset($per_page))
			$this->session->per_page = $per_page;

		$data = $this->pemberdayaan_masyarakat_model->get_kegiatan($p, $id);
		$data['sasaran'] = unserialize(SASARAN);
		$data['func'] = "daftar_peserta/$id";
		$data['per_page'] = $this->session->per_page;
		$data['set_page'] = ['20', '50', '100'];
		$data['cari'] = $this->session->cari;
		$this->set_minsidebar(1);

		$this->render('pemberdayaan_masyarakat/daftar_peserta', $data);
	}

	public function form_peserta($id)
	{
		$data['sasaran'] = unserialize(SASARAN);
		$data['pemas'] = $this->pemberdayaan_masyarakat_model->get_peserta($id);
		$sasaran = $data['pemas']['sasaran'];
		$data['list_sasaran'] = $this->pemberdayaan_masyarakat_model->list_sasaran($id, $sasaran);
		if (isset($_POST['terdata']))
		{
			$data['individu'] = $this->pemberdayaan_masyarakat_model->get_terdata($_POST['terdata'], $sasaran);
		}
		else
		{
			$data['individu'] = NULL;
		}

		$data['form_action'] = site_url("pemberdayaan_masyarakat/add_terdata");

		$this->render('pemberdayaan_masyarakat/form_peserta', $data);
	}

	public function terdata($sasaran = 0, $id = 0)
	{
		$data = $this->pemberdayaan_masyarakat_model->get_terdata_suplemen($sasaran, $id);

		$this->render('pemberdayaan_masyarakat/terdata', $data);
	}

	public function data_terdata($id = 0)
	{
		$data['terdata'] = $this->pemberdayaan_masyarakat_model->get_peserta_terdata_by_id($id);
		$data['pemas'] = $this->pemberdayaan_masyarakat_model->get_pemas($data['terdata']['id_kegiatan']);
		$data['individu'] = $this->pemberdayaan_masyarakat_model->get_terdata($data['terdata']['id_terdata'], $data['pemas']['sasaran']);

		$this->render('pemberdayaan_masyarakat/data_terdata', $data);
	}

	public function edit_terdata_form($id = 0)
	{
		$data = $this->pemberdayaan_masyarakat_model->get_peserta_terdata_by_id($id);
		$data['form_action'] = site_url("pemas/edit_terdata/$id");

		$this->load->view('suplemen/edit_terdata', $data);
	}

	public function add_terdata($id)
	{
		$this->pemberdayaan_masyarakat_model->add_terdata($_POST, $id);
		redirect("pemberdayaan_masyarakat/daftar_peserta/$id");
	}

	public function edit_terdata($id)
	{
		$this->pemberdayaan_masyarakat_model->edit_terdata($_POST, $id);
		$id_kegiatan = $_POST['id_kegiatan'];
		redirect("pemberdayaan_masyarakat/daftar_peserta/$id_kegiatan");
	}

	public function hapus_terdata($id_kegiatan, $id_terdata)
	{
		$this->redirect_hak_akses('h');
		$this->pemberdayaan_masyarakat_model->hapus_terdata($id_terdata);
		redirect("pemberdayaan_masyarakat/daftar_peserta/$id_kegiatan");
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
			$data = $this->pemberdayaan_masyarakat_model->get_peserta(1, $id);
			$data['sasaran'] = unserialize(SASARAN);
			$data['config'] = $this->header['desa'];
			$data['pamong_ttd'] = $this->pamong_model->get_data($post['pamong_ttd']);
			$data['pamong_ketahui'] = $this->pamong_model->get_data($post['pamong_ketahui']);
			$data['aksi'] = $aksi;
			$this->session->per_page = $temp;

			//pengaturan data untuk format cetak/ unduh
			$data['file'] = "Laporan Kegiatan Pemberdayaan Masyarakat ".$data['pemas']['nama'];
			$data['isi'] = "pemberdayaan_masyarakat/cetak";
			$data['letak_ttd'] = ['2', '2', '3'];

			$this->load->view('global/format_cetak', $data);
		}
	}

}

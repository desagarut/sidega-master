<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Bidang_bencana_darurat_mendesak extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['bidang_bencana_darurat_mendesak_model', 'pamong_model']);
		$this->modul_ini = 370;
		$this->sub_modul_ini = 25;
	}

	public function index()
	{
		$this->session->per_page = 50;

		$kelompok_bencana = $this->input->post('kelompok_bencana');

		$data['kejadian_bencana'] = $this->bidang_bencana_darurat_mendesak_model->list_data($kelompok_bencana);
		$data['list_kelompok_bencana'] = unserialize(KELOMPOK_BENCANA);
		$data['set_kelompok_bencana'] = $kelompok_bencana;
		$this->set_minsidebar(0);

		$this->render('bidang_bencana_darurat_mendesak/kejadian_data_laporan', $data);
	}

	public function form_kejadian($id = '')
	{
		if ($id)
		{
			$data['laporan_kejadian_bencana'] = $this->bidang_bencana_darurat_mendesak_model->get_laporan_kejadian_bencana($id);
			$data['form_action'] = site_url("bidang_bencana_darurat_mendesak/ubah/$id");
		}
		else
		{
			$data['laporan_kejadian_bencana'] = NULL;
			$data['form_action'] = site_url("bidang_bencana_darurat_mendesak/tambah");
		}

		$data['list_kelompok_bencana'] = unserialize(KELOMPOK_BENCANA);
		$this->set_minsidebar(0);

		$this->render('bidang_bencana_darurat_mendesak/kejadian_form', $data);
	}

	public function detail_kejadian($id = '')
	{
		$data['laporan_kejadian_bencana'] = $this->bidang_bencana_darurat_mendesak_model->get_laporan_kejadian_bencana($id);
		$data['list_kelompok_bencana'] = unserialize(KELOMPOK_BENCANA);
		$this->set_minsidebar(0);

		$this->render('bidang_bencana_darurat_mendesak/kejadian_detail', $data);
	}

	public function tambah()
	{
		$this->bidang_bencana_darurat_mendesak_model->create();
		redirect('bidang_bencana_darurat_mendesak');
	}

	public function ubah($id)
	{
		$this->bidang_bencana_darurat_mendesak_model->update($id);
		redirect('bidang_bencana_darurat_mendesak');
	}

	public function hapus($id)
	{
		$this->redirect_hak_akses('h');
		$this->bidang_bencana_darurat_mendesak_model->hapus($id);
		redirect('bidang_bencana_darurat_mendesak');
	}

	public function panduan()
	{
		$this->render('bidang_bencana_darurat_mendesak/panduan');
	}

	public function filter($filter)
	{
		## untuk filter pada data rincian bidang_bencana_darurat_mendesak
		$value = $this->input->post($filter);
		$id_rincian = $this->session->id_rincian;
		if ($value != '')
			$this->session->$filter = $value;
		else
			$this->session->unset_userdata($filter);
		redirect("bidang_bencana_darurat_mendesak/rincian/$id_rincian");
	}

	public function clear($id)
	{
		## untuk filter pada data rincian pemberdayaan_masyarakat
		if ($id)
		{
			$this->session->id_rincian = $id;
			$this->session->unset_userdata('cari');
			redirect("bidang_bencana_darurat_mendesak/rincian/$id");
		}
	}

	public function warga_terdampak_daftar($id = '', $p = 1)
	{
		$per_page = $this->input->post('per_page');
		if (isset($per_page))
			$this->session->per_page = $per_page;

		$data = $this->bidang_bencana_darurat_mendesak_model->get_rincian($p, $id);
		$data['kelompok_bencana'] = unserialize(KELOMPOK_BENCANA);
		$data['func'] = "warga_terdampak/$id";
		$data['per_page'] = $this->session->per_page;
		$data['set_page'] = ['20', '50', '100'];
		$data['cari'] = $this->session->cari;
		$this->set_minsidebar(0);

		$this->render('bidang_bencana_darurat_mendesak/warga_terdampak_daftar', $data);
	}

	public function form_warga_terdampak($p = 1, $o = 0, $id = '')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data = $this->bidang_bencana_darurat_mendesak_model->get_rincian($p, $id);
			$data['form_action'] = site_url("kelompok/update/$p/$o/$id");
		}
		else
		{
			$data['kelompok'] = NULL;
			$data['form_action'] = site_url("kelompok/insert");
		}

		//$data['list_master'] = $this->kelompok_model->list_master();
		//$data['list_penduduk'] = $this->kelompok_model->list_penduduk();
		$data = $this->bidang_bencana_darurat_mendesak_model->get_rincian($p, $id);

		$this->set_minsidebar(1);
		$this->render('bidang_bencana_darurat_mendesak/warga_terdampak_form', $data);
	}

	public function peserta($kelompok_bencana = 0, $id = 0)
	{
		$data = $this->bidang_bencana_darurat_mendesak_model->get_peserta_pemberdayaan_masyarakat($kelompok_bencana, $id);

		$this->render('bidang_bencana_darurat_mendesak/peserta', $data);
	}

	public function data_peserta($id = 0)
	{
		$data['peserta'] = $this->bidang_bencana_darurat_mendesak_model->get_laporan_kejadian_bencana_peserta_by_id($id);
		$data['pemberdayaan_masyarakat'] = $this->bidang_bencana_darurat_mendesak_model->get_laporan_kejadian_bencana($data['peserta']['id_kegiatan']);
		$data['individu'] = $this->bidang_bencana_darurat_mendesak_model->get_peserta($data['peserta']['id_peserta'], $data['pemberdayaan_masyarakat']['kelompok_bencana']);

		$this->render('bidang_bencana_darurat_mendesak/data_peserta', $data);
	}

	public function edit_peserta_form($id = 0)
	{
		$data = $this->bidang_bencana_darurat_mendesak_model->get_laporan_kejadian_bencana_peserta_by_id($id);
		$data['form_action'] = site_url("bidang_bencana_darurat_mendesak/edit_peserta/$id");

		$this->load->view('bidang_bencana_darurat_mendesak/edit_peserta', $data);
	}

	public function add_peserta($id)
	{
		$this->bidang_bencana_darurat_mendesak_model->add_peserta($_POST, $id);
		redirect("bidang_bencana_darurat_mendesak/rincian/$id");
	}

	public function edit_peserta($id)
	{
		$this->bidang_bencana_darurat_mendesak_model->edit_peserta($_POST, $id);
		$id_kegiatan = $_POST['id_kegiatan'];
		redirect("bidang_bencana_darurat_mendesak/rincian/$id_kegiatan");
	}

	public function hapus_peserta($id_kegiatan, $id_peserta)
	{
		$this->redirect_hak_akses('h');
		$this->bidang_bencana_darurat_mendesak_model->hapus_peserta($id_peserta);
		redirect("bidang_bencana_darurat_mendesak/rincian/$id_kegiatan");
	}

	/*
	* $aksi = cetak/unduh
	*/
	public function dialog_daftar($id = 0, $aksi = '')
	{
		$data['aksi'] = $aksi;
		$data['pamong'] = $this->pamong_model->list_data();
		$data['form_action'] = site_url("bidang_bencana_darurat_mendesak/daftar/$id/$aksi");

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
			$data = $this->bidang_bencana_darurat_mendesak_model->get_rincian(1, $id);
			$data['kelompok_bencana'] = unserialize(KELOMPOK_BENCANA);
			$data['config'] = $this->header['desa'];
			$data['pamong_ttd'] = $this->pamong_model->get_data($post['pamong_ttd']);
			$data['pamong_ketahui'] = $this->pamong_model->get_data($post['pamong_ketahui']);
			$data['aksi'] = $aksi;
			$this->session->per_page = $temp;

			//pengaturan data untuk format cetak/ unduh
			$data['file'] = "Laporan Kejadian Bencana ".$data['bidang_bencana_darurat_mendesak']['nama'];
			$data['isi'] = "bidang_bencana_darurat_mendesak/cetak";
			$data['letak_ttd'] = ['2', '2', '3'];

			$this->load->view('global/format_cetak', $data);
		}
	}

}

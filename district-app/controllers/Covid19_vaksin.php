<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Covid19_vaksin extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');

		$this->load->model('covid19_vaksin_model');
		$this->load->model('referensi_model');
		$this->load->model('wilayah_model');
		$this->load->model('penduduk_model');

		$this->modul_ini = 306;
	}

	public function index()
	{
		$this->data_peserta_vaksin(1);
		//redirect("covid19_vaksin/data_peserta_vaksin, $data");
	}

	public function data_peserta_vaksin($page = 1)
	{
		$this->sub_modul_ini = 503;

		if (isset($_POST['per_page']))
			$this->session->set_userdata('per_page', $_POST['per_page']);
		else
			$this->session->set_userdata('per_page', 10);

		$data = $this->covid19_vaksin_model->get_list_peserta_vaksin($page);
		$data['per_page'] = $this->session->userdata('per_page');

		$this->render('covid19/vaksin/data_peserta_vaksin', $data);
	}

	public function form_peserta_vaksin()
	{
		$this->sub_modul_ini = 503;

		$d = new DateTime('NOW');
		$data['tanggal'] = $d->format('Y-m-d H:i:s');

		$data['list_penduduk'] = $this->covid19_vaksin_model->get_penduduk_not_in_peserta_vaksin();

		if (isset($_POST['terdata']))
		{
			$data['individu'] = $this->covid19_vaksin_model->get_penduduk_by_id($_POST['terdata']);
		}
		else
		{
			$data['individu'] = NULL;
		}

		$data['dusun'] = $this->wilayah_model->list_dusun();
		$data['rw'] = $this->wilayah_model->list_rw($data['penduduk']['dusun']);
		$data['rt'] = $this->wilayah_model->list_rt($data['penduduk']['dusun'], $data['penduduk']['rw']);
		$data['agama'] = $this->referensi_model->list_data("tweb_penduduk_agama");
		$data['golongan_darah'] = $this->referensi_model->list_data("tweb_golongan_darah");
		$data['jenis_kelamin'] = $this->referensi_model->list_data("tweb_penduduk_sex");
		$data['status_penduduk'] = $this->referensi_model->list_data("tweb_penduduk_status");

		$nav['act'] = 503;

		$data['form_action'] = site_url("covid19_vaksin/add_peserta_vaksin");
		$data['form_action_penduduk'] = site_url("covid19_vaksin/insert_penduduk");
		$this->render('covid19/vaksin/form_peserta_vaksin', $data);
	}

	public function insert_penduduk()
	{
		$callback_url = $_POST['callback_url'];
		unset($_POST['callback_url']);

		$id = $this->penduduk_model->insert();
		if ($_SESSION['success'] == -1)
			$_SESSION['dari_internal'] = true;
		redirect("covid19/vaksin/form_peserta_vaksin");
	}

	public function add_peserta_vaksin()
	{
		$this->covid19_vaksin_model->add_peserta_vaksin($_POST);
		redirect("covid19_vaksin");
	}

	public function hapus_peserta_vaksin($id_peserta_vaksin)
	{
		$this->redirect_hak_akses('h', "covid19_vaksin");
		$this->covid19_vaksin_model->delete_peserta_vaksin_by_id($id_peserta_vaksin);
		redirect("covid19_vaksin");
	}

	public function edit_peserta_vaksin_form($id = 0)
	{
		$data = $this->covid19_vaksin_model->get_peserta_vaksin_by_id($id);
		$data['form_action'] = site_url("covid19_vaksin/edit_peserta_vaksin/$id");
		$this->load->view('covid19/vaksin/edit_peserta_vaksin', $data);
	}

	public function edit_peserta_vaksin($id)
	{
		$this->covid19_vaksin_model->update_peserta_vaksin_by_id($_POST, $id);
		redirect("covid19_vaksin");
	}

	public function detil_peserta_vaksin($id)
	{
		$nav['act'] = 206;

		$data['terdata'] = $this->covid19_vaksin_model->get_peserta_vaksin_by_id($id);
		$data['individu'] = $this->covid19_vaksin_model->get_penduduk_by_id($data['terdata']['id_terdata']);

		$data['terdata']['judul_terdata_nama'] = 'NIK';
		$data['terdata']['judul_terdata_info'] = 'Nama Terdata';
		$data['terdata']['terdata_nama'] = $data['individu']['nik'];
		$data['terdata']['terdata_info'] = $data['individu']['nama'];

		$data['penduduk'] = $this->penduduk_model->get_penduduk($data['terdata']['id_terdata']);
		$this->session->set_userdata('nik_lama', $data['penduduk']['nik']);

		$data['dusun'] = $this->wilayah_model->list_dusun();
		$data['rw'] = $this->wilayah_model->list_rw($data['penduduk']['dusun']);
		$data['rt'] = $this->wilayah_model->list_rt($data['penduduk']['dusun'], $data['penduduk']['rw']);
		$data['agama'] = $this->referensi_model->list_data("tweb_penduduk_agama");
		$data['golongan_darah'] = $this->referensi_model->list_data("tweb_golongan_darah");
		$data['jenis_kelamin'] = $this->referensi_model->list_data("tweb_penduduk_sex");
		$data['status_penduduk'] = $this->referensi_model->list_data("tweb_penduduk_status");

		$data['form_action_penduduk'] = site_url("covid19/update_penduduk/".$data['terdata']['id_terdata']."/".$id);
		$this->render('covid19/vaksin/detil_peserta_vaksin', $data);
	}

	public function update_penduduk($id_pend, $id_peserta_vaksin)
	{
		$this->penduduk_model->update($id_pend);
		if ($_SESSION['success'] == -1)
			$_SESSION['dari_internal'] = true;
		redirect("covid19_vaksin/detil_peserta_vaksin/$id_peserta_vaksin");
	}

	public function pantau($page=1, $filter_tgl=null, $filter_nik=null)
	{
		$this->sub_modul_ini = 208;

		if (isset($_POST['per_page']))
			$this->session->set_userdata('per_page', $_POST['per_page']);
		else
			$this->session->set_userdata('per_page', 10);
		$data['per_page'] = $this->session->userdata('per_page');
		$data['page'] = $page;

		// get list peserta_vaksin
		$data['peserta_vaksin_array'] = $this->covid19_vaksin_model->get_list_peserta_vaksin_wajib_pantau(true);
		// get list peserta_vaksin end

		// get list pemantauan
		$pantau_peserta_vaksin = $this->covid19_vaksin_model->get_list_pantau_peserta_vaksin($page, $filter_tgl, $filter_nik);
		$data['unique_nik'] = $this->covid19_vaksin_model->get_unique_nik_pantau_peserta_vaksin();
		$data['unique_date'] = $this->covid19_vaksin_model->get_unique_date_pantau_peserta_vaksin();
		$data['filter_tgl'] = isset($filter_tgl) ? $filter_tgl : '0';
		$data['filter_nik'] = isset($filter_nik) ? $filter_nik : '0';

		$data['paging'] = $pantau_peserta_vaksin["paging"];
		$data['pantau_peserta_vaksin_array'] = $pantau_peserta_vaksin["query_array"];
		// get list pemantauan end

		// datetime now
		$d = new DateTime('NOW');
		$data['datetime_now'] = $d->format('Y-m-d H:i:s');

		$data['this_url'] = site_url("covid19/pantau");
		$data['form_action'] = site_url("covid19/add_pantau");

		$url_delete_front = "covid19/hapus_pantau";
		$url_delete_rare = "$page";
		$data['url_delete_front'] = $url_delete_front;
		$data['url_delete_rare'] = $url_delete_rare;

		$this->render('covid19/vaksin/pantau_peserta_vaksin', $data);
	}

	public function add_pantau()
	{
		$this->covid19_vaksin_model->add_pantau_pemudik($_POST);
		$url = "covid19/pantau/".$_POST["page"]."/".$_POST["data_h_plus"];
		redirect($url);
	}

	public function hapus_pantau($id_pantau_pemudik, $page=NULL, $h_plus=NULL)
	{
		$this->redirect_hak_akses('h', "covid19");
		$this->covid19_vaksin_model->delete_pantau_pemudik_by_id($id_pantau_pemudik);

		$url = "covid19/pantau";
		$url .= (isset($page) ? "/$page" : "");
		$url .= (isset($h_plus) ? "/$h_plus" : "");
		redirect($url);
	}

	/*
	* $aksi = cetak/unduh
	*/
	public function daftar($aksi = '', $filter_tgl = null, $filter_nik = null)
	{
		$this->session->set_userdata('per_page', 0); // Unduh semua data

		if (isset($filter_tgl) OR isset($filter_nik))
		{
			$data = $this->covid19_vaksin_model->get_list_pantau_peserta_vaksin(1, $filter_tgl, $filter_nik);
			$judul = 'pantauan';
		}
		else
		{
			$data = $this->covid19_vaksin_model->get_list_peserta_vaksin(1);
			$judul = 'pendataan';
		}

		if ($aksi === 'cetak') $aksi = $aksi.'_'.$judul;

		$data['config'] = $this->config_model->get_data();
		$data['aksi'] = $aksi;
		$data['judul'] = $judul;
		$this->session->set_userdata('per_page', 10); // Kembalikan ke paginasi default

		$this->load->view('covid19/vaksin/'.$data['aksi'], $data);
	}
}

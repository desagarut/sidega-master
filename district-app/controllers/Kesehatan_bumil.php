<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kesehatan_bumil extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');

		$this->load->model('kesehatan_bumil_model');
		$this->load->model('referensi_model');
		$this->load->model('wilayah_model');
		$this->load->model('penduduk_model');

		$this->modul_ini = 340;
		$this->sub_modul_ini = 342;
	}

	public function index($page = 1)
	{

		if (isset($_POST['per_page']))
			$this->session->set_userdata('per_page', $_POST['per_page']);
		else
			$this->session->set_userdata('per_page', 10);

		$data = $this->kesehatan_bumil_model->get_list_bumil($page);
		$data['per_page'] = $this->session->userdata('per_page');

		$this->set_minsidebar(1);

		$this->render('kesehatan/bumil/data_bumil', $data);
	}

	public function form_bumil()
	{
		$this->sub_modul_ini = 342;
		$data      			= ['selected_nav' => 'data'];
		$this->set_minsidebar(1);


		$d = new DateTime('NOW');
		$data['tanggal_terdaftar'] = $d->format('Y-m-d H:i:s');

		$data['list_penduduk'] = $this->kesehatan_bumil_model->get_penduduk_not_in_bumil();

		if (isset($_POST['terdata'])) {
			$data['individu'] = $this->kesehatan_bumil_model->get_penduduk_by_id($_POST['terdata']);
		} else {
			$data['individu'] = NULL;
		}

		$data['dusun'] = $this->wilayah_model->list_dusun();
		$data['rw'] = $this->wilayah_model->list_rw($data['penduduk']['dusun']);
		$data['rt'] = $this->wilayah_model->list_rt($data['penduduk']['dusun'], $data['penduduk']['rw']);
		$data['agama'] = $this->referensi_model->list_data("tweb_penduduk_agama");
		$data['golongan_darah'] = $this->referensi_model->list_data("tweb_golongan_darah");
		$data['jenis_kelamin'] = $this->referensi_model->list_data("tweb_penduduk_sex");
		$data['status_penduduk'] = $this->referensi_model->list_data("tweb_penduduk_status");

		//$nav['act'] = 342;

		$data['form_action'] = site_url("kesehatan_bumil/add_bumil");
		$data['form_action_penduduk'] = site_url("kesehatan_bumil/insert_penduduk");

		$this->render('kesehatan/bumil/form_bumil', $data);
	}

	public function insert_penduduk()
	{
		$callback_url = $_POST['callback_url'];
		unset($_POST['callback_url']);

		$id = $this->penduduk_model->insert();
		if ($_SESSION['success'] == -1)
			$_SESSION['dari_internal'] = true;
		redirect("kesehatan_bumil/form_bumil");
	}

	public function add_bumil()
	{
		$this->kesehatan_bumil_model->add_bumil($_POST);
		redirect("kesehatan_bumil");
	}

	public function hapus_bumil($id_bumil)
	{
		$this->redirect_hak_akses('h', "kesehatan_bumil");
		$this->kesehatan_bumil_model->delete_bumil_by_id($id_bumil);
		redirect("kesehatan_bumil");
	}

	public function edit_bumil_form($id = 0)
	{
		$data = $this->kesehatan_bumil_model->get_bumil_by_id($id);

		$data['form_action'] = site_url("kesehatan_bumil/edit_bumil/$id");
		$this->load->view('kesehatan/bumil/edit_bumil', $data);
	}

	public function edit_bumil($id)
	{
		$this->kesehatan_bumil_model->update_bumil_by_id($_POST, $id);
		redirect("kesehatan_bumil");
	}

	public function detil_bumil($id)
	{
		$data      			= ['selected_nav' => 'data'];

		$data['terdata'] = $this->kesehatan_bumil_model->get_bumil_by_id($id);
		$data['individu'] = $this->kesehatan_bumil_model->get_penduduk_by_id($data['terdata']['id_terdata']);

		$data['terdata']['judul_terdata_nama'] = 'Nama Terdata';
		$data['terdata']['judul_terdata_nik'] = 'NIK';
		$data['terdata']['terdata_nama'] = $data['individu']['nama'];
		$data['terdata']['terdata_nik'] = $data['individu']['nik'];

		$data['penduduk'] = $this->penduduk_model->get_penduduk($data['terdata']['id_terdata']);
		$this->session->set_userdata('nik_lama', $data['penduduk']['nik']);

		$data['dusun'] = $this->wilayah_model->list_dusun();
		$data['rw'] = $this->wilayah_model->list_rw($data['penduduk']['dusun']);
		$data['rt'] = $this->wilayah_model->list_rt($data['penduduk']['dusun'], $data['penduduk']['rw']);
		$data['agama'] = $this->referensi_model->list_data("tweb_penduduk_agama");
		$data['golongan_darah'] = $this->referensi_model->list_data("tweb_golongan_darah");
		$data['jenis_kelamin'] = $this->referensi_model->list_data("tweb_penduduk_sex");
		$data['status_penduduk'] = $this->referensi_model->list_data("tweb_penduduk_status");

		$data['form_action_penduduk'] = site_url("kesehatan/bumil/update_penduduk/" . $data['terdata']['id_terdata'] . "/" . $id);
		$this->render('kesehatan/bumil/detil_bumil', $data);
	}

	public function update_penduduk($id_pend, $id_bumil)
	{
		$this->penduduk_model->update($id_pend);
		if ($_SESSION['success'] == -1)
			$_SESSION['dari_internal'] = true;
		redirect("kesehatan/bumil/detil_bumil/$id_bumil");
	}

	public function pantau($page = 1, $filter_tgl = null, $filter_nik = null)
	{
		$this->sub_modul_ini = 342;
		$data      			= ['selected_nav' => 'pantau'];

		if (isset($_POST['per_page']))
			$this->session->set_userdata('per_page', $_POST['per_page']);
		else
			$this->session->set_userdata('per_page', 10);
		$data['per_page'] = $this->session->userdata('per_page');
		$data['page'] = $page;

		// get list bumil
		$data['bumil_array'] = $this->kesehatan_bumil_model->get_list_bumil_wajib_pantau(true);
		// get list bumil end

		// get list pemantauan
		$pantau_bumil = $this->kesehatan_bumil_model->get_list_pantau_bumil($page, $filter_tgl, $filter_nik);
		$data['unique_nik'] = $this->kesehatan_bumil_model->get_unique_nik_pantau_bumil();
		$data['unique_date'] = $this->kesehatan_bumil_model->get_unique_date_pantau_bumil();
		$data['filter_tgl'] = isset($filter_tgl) ? $filter_tgl : '0';
		$data['filter_nik'] = isset($filter_nik) ? $filter_nik : '0';

		$data['paging'] = $pantau_bumil["paging"];
		$data['pantau_bumil_array'] = $pantau_bumil["query_array"];
		// get list pemantauan end

		// datetime now
		$d = new DateTime('NOW');
		$data['datetime_now'] = $d->format('Y-m-d H:i:s');

		$data['this_url'] = site_url("kesehatan_bumil/pantau");
		$data['form_action'] = site_url("kesehatan_bumil/add_pantau");

		$url_delete_front = "kesehatan_bumil/hapus_pantau";
		$url_delete_rare = "$page";
		$data['url_delete_front'] = $url_delete_front;
		$data['url_delete_rare'] = $url_delete_rare;
		$this->set_minsidebar(1);

		$this->render('kesehatan/bumil/pantau_bumil', $data);
	}

	public function add_pantau()
	{
		$this->kesehatan_bumil_model->add_pantau_bumil($_POST);
		$url = "kesehatan_bumil/pantau/" . $_POST["page"] . "/" . $_POST["data_h_plus"];
		redirect($url);
	}

	public function hapus_pantau($id_pantau_bumil, $page = NULL, $h_plus = NULL)
	{
		$this->redirect_hak_akses('h', "kesehatan_bumil");
		$this->kesehatan_bumil_model->delete_pantau_bumil_by_id($id_pantau_bumil);

		$url = "kesehatan_bumil/pantau";
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

		if (isset($filter_tgl) or isset($filter_nik)) {
			$data = $this->kesehatan_bumil_model->get_list_pantau_bumil(1, $filter_tgl, $filter_nik);
			$judul = 'pantauan';
		} else {
			$data = $this->kesehatan_bumil_model->get_list_bumil(1);
			$judul = 'pendataan';
		}

		if ($aksi === 'cetak') $aksi = $aksi . '_' . $judul;

		$data['config'] = $this->config_model->get_data();
		$data['aksi'] = $aksi;
		$data['judul'] = $judul;
		$this->session->set_userdata('per_page', 10); // Kembalikan ke paginasi default

		$this->load->view('kesehatan/bumil/' . $data['aksi'], $data);
	}
}

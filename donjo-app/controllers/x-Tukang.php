<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tukang extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');

		$this->load->model('Tukang_model');
		$this->load->model('referensi_model');
		$this->load->model('wilayah_model');
		$this->load->model('penduduk_model');

		$this->modul_ini = 400;
	}

	public function index()
	{
		$this->data_tukang(1);
	}

	public function data_tukang($page = 1)
	{
		$this->sub_modul_ini = 403;

		if (isset($_POST['per_page']))
			$this->session->set_userdata('per_page', $_POST['per_page']);
		else
			$this->session->set_userdata('per_page', 10);

		$data = $this->Tukang_model->get_list_tukang($page);
		$data['per_page'] = $this->session->userdata('per_page');

		$this->render('tukang/data_tukang', $data);
	}

	public function form_tukang()
	{
		$this->sub_modul_ini = 401;

		$d = new DateTime('NOW');
		$data['tanggal_datang'] = $d->format('Y-m-d H:i:s');

		$data['list_penduduk'] = $this->Tukang_model->get_penduduk_not_in_tukang();

		if (isset($_POST['terdata']))
		{
			$data['individu'] = $this->Tukang_model->get_penduduk_by_id($_POST['terdata']);
		}
		else
		{
			$data['individu'] = NULL;
		}

		$data['select_jenis_tukang'] = $this->Tukang_model->list_jenis_tukang();
		$data['select_status_tukang'] = $this->Tukang_model->list_status_tukang();
		$data['select_kepemilikan_bangunan_tukang'] = $this->Tukang_model->list_kepemilikan_bangunan_tukang();

		$data['dusun'] = $this->wilayah_model->list_dusun();
		$data['rw'] = $this->wilayah_model->list_rw($data['penduduk']['dusun']);
		$data['rt'] = $this->wilayah_model->list_rt($data['penduduk']['dusun'], $data['penduduk']['rw']);
		$data['agama'] = $this->referensi_model->list_data("tweb_penduduk_agama");
		$data['golongan_darah'] = $this->referensi_model->list_data("tweb_golongan_darah");
		$data['jenis_kelamin'] = $this->referensi_model->list_data("tweb_penduduk_sex");
		$data['status_penduduk'] = $this->referensi_model->list_data("tweb_penduduk_status");

		$nav['act'] = 206;

		$data['form_action'] = site_url("tukang/add_tukang");
		$data['form_action_penduduk'] = site_url("tukang/insert_penduduk");
		$this->render('tukang/form_tukang', $data);
	}

	public function insert_penduduk()
	{
		$callback_url = $_POST['callback_url'];
		unset($_POST['callback_url']);

		$id = $this->penduduk_model->insert();
		if ($_SESSION['success'] == -1)
			$_SESSION['dari_internal'] = true;
		redirect("tukang/form_tukang");
	}

	public function add_tukang()
	{
		$this->Tukang_model->add_tukang($_POST);
		redirect("tukang");
	}

	public function hapus_tukang($id_tukang)
	{
		$this->redirect_hak_akses('h', "tukang");
		$this->Tukang_model->delete_tukang_by_id($id_tukang);
		redirect("tukang");
	}

	public function edit_tukang_form($id = 0)
	{
		$data = $this->Tukang_model->get_tukang_by_id($id);
		
		$data['select_jenis_tukang'] = $this->Tukang_model->list_jenis_tukang();
		$data['select_status_tukang'] = $this->Tukang_model->list_status_tukang();
		$data['select_kepemilikan_bangunan_tukang'] = $this->Tukang_model->list_kepemilikan_bangunan_tukang();

		$data['form_action'] = site_url("tukang/edit_tukang/$id");
		$this->load->view('tukang/edit_tukang', $data);
	}

	public function edit_tukang($id)
	{
		$this->Tukang_model->update_tukang_by_id($_POST, $id);
		redirect("tukang");
	}

	public function detil_tukang($id)
	{
		$this->sub_modul_ini = 401;
		
		$nav['act'] = 401;

		$data['terdata'] = $this->Tukang_model->get_tukang_by_id($id);
		$data['individu'] = $this->Tukang_model->get_penduduk_by_id($data['terdata']['id_terdata']);

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

		$data['form_action_penduduk'] = site_url("tukang/update_penduduk/".$data['terdata']['id_terdata']."/".$id);
		$this->render('tukang/detil_tukang', $data);
	}

	public function update_penduduk($id_pend, $id_tukang)
	{
		$this->penduduk_model->update($id_pend);
		if ($_SESSION['success'] == -1)
			$_SESSION['dari_internal'] = true;
		redirect("tukang/detil_tukang/$id_tukang");
	}

	public function survei($page=1, $filter_tgl=null, $filter_nik=null)
	{
		$this->sub_modul_ini = 401;

		if (isset($_POST['per_page']))
			$this->session->set_userdata('per_page', $_POST['per_page']);
		else
			$this->session->set_userdata('per_page', 10);
		$data['per_page'] = $this->session->userdata('per_page');
		$data['page'] = $page;

		// get list tukang
		$data['tukang_array'] = $this->Tukang_model->get_list_tukang_wajib_survei(true);
		// get list tukang end

		// get list pemantauan
		$survei_tukang = $this->Tukang_model->get_list_survei_tukang($page, $filter_tgl, $filter_nik);
		$data['unique_nik'] = $this->Tukang_model->get_unique_nik_survei_tukang();
		$data['unique_date'] = $this->Tukang_model->get_unique_date_survei_tukang();
		$data['filter_tgl'] = isset($filter_tgl) ? $filter_tgl : '0';
		$data['filter_nik'] = isset($filter_nik) ? $filter_nik : '0';

		$data['paging'] = $survei_tukang["paging"];
		$data['survei_tukang_array'] = $survei_tukang["query_array"];
		// get list pemantauan end

		// datetime now
		$d = new DateTime('NOW');
		$data['datetime_now'] = $d->format('Y-m-d H:i:s');

		$data['this_url'] = site_url("tukang/survei");
		$data['form_action'] = site_url("tukang/add_survei");

		$url_delete_front = "tukang/hapus_survei";
		$url_delete_rare = "$page";
		$data['url_delete_front'] = $url_delete_front;
		$data['url_delete_rare'] = $url_delete_rare;

		$this->render('tukang/survei_tukang', $data);
	}

	public function add_survei()
	{
		$this->Tukang_model->add_survei_tukang($_POST);
		$url = "tukang/survei/".$_POST["page"]."/".$_POST["data_h_plus"];
		redirect($url);
	}

	public function hapus_survei($id_survei_tukang, $page=NULL, $h_plus=NULL)
	{
		$this->redirect_hak_akses('h', "tukang");
		$this->Tukang_model->delete_survei_tukang_by_id($id_survei_tukang);

		$url = "tukang/survei";
		$url .= (isset($page) ? "/$page" : "");
		$url .= (isset($h_plus) ? "/$h_plus" : "");
		redirect($url);
	}

	/*
	* $aksi = cetak/unduh
	*/
	public function daftar($aksi = '', $filter_tgl = null, $filter_nik = null)
	{
		
		$this->sub_modul_ini = 401;
 
 		$this->session->set_userdata('per_page', 0); // Unduh semua data

		if (isset($filter_tgl) OR isset($filter_nik))
		{
			$data = $this->Tukang_model->get_list_survei_tukang(1, $filter_tgl, $filter_nik);
			$judul = 'survei';
		}
		else
		{
			$data = $this->Tukang_model->get_list_tukang(1);
			$judul = 'pendataan';
		}

		if ($aksi === 'cetak') $aksi = $aksi.'_'.$judul;

		$data['config'] = $this->config_model->get_data();
		$data['aksi'] = $aksi;
		$data['judul'] = $judul;
		$this->session->set_userdata('per_page', 10); // Kembalikan ke paginasi default

		$this->load->view('tukang/'.$data['aksi'], $data);
	}
}

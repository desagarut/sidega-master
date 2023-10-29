<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kesehatan_balita extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');

		$this->load->model('kesehatan_balita_model');
		$this->load->model('referensi_model');
		$this->load->model('wilayah_model');
		$this->load->model('penduduk_model');

		$this->modul_ini = 340;
		$this->sub_modul_ini = 341;

	}

	public function index()
	{
		$this->data_balita(1);
	}

	public function data_balita($page = 1)
	{

		if (isset($_POST['per_page']))
			$this->session->set_userdata('per_page', $_POST['per_page']);
		else
			$this->session->set_userdata('per_page', 10);

		$data = $this->kesehatan_balita_model->get_list_balita($page);
		$data['per_page'] = $this->session->userdata('per_page');
		$this->set_minsidebar(1);

		$this->render('kesehatan/balita/data_balita', $data);

	}

	public function form_balita()
	{
		$this->sub_modul_ini = 341;
	//	$data      			= ['selected_nav' => 'data_balita'];
		$this->set_minsidebar(1);


		$d = new DateTime('NOW');
		$data['tanggal_terdaftar'] = $d->format('Y-m-d H:i:s');

		$data['list_penduduk'] = $this->kesehatan_balita_model->get_penduduk_not_in_balita();

		if (isset($_POST['terdata']))
		{
			$data['individu'] = $this->kesehatan_balita_model->get_penduduk_by_id($_POST['terdata']);
		}
		else
		{
			$data['individu'] = NULL;
		}

		//$data['select_tujuan_mudik'] = $this->kesehatan_balita_model->list_tujuan_mudik();
		//$data['select_status_covid'] = $this->kesehatan_balita_model->list_status_covid();

		$data['dusun'] = $this->wilayah_model->list_dusun();
		$data['rw'] = $this->wilayah_model->list_rw($data['penduduk']['dusun']);
		$data['rt'] = $this->wilayah_model->list_rt($data['penduduk']['dusun'], $data['penduduk']['rw']);
		$data['agama'] = $this->referensi_model->list_data("tweb_penduduk_agama");
		$data['golongan_darah'] = $this->referensi_model->list_data("tweb_golongan_darah");
		$data['jenis_kelamin'] = $this->referensi_model->list_data("tweb_penduduk_sex");
		$data['status_penduduk'] = $this->referensi_model->list_data("tweb_penduduk_status");

		//$nav['act'] = 341;

		$data['form_action'] = site_url("kesehatan_balita/add_balita");
		$data['form_action_penduduk'] = site_url("kesehatan_balita/insert_penduduk");

		$this->render('kesehatan/balita/form_balita', $data);
	}

	public function insert_penduduk()
	{
		$callback_url = $_POST['callback_url'];
		unset($_POST['callback_url']);

		$id = $this->penduduk_model->insert();
		if ($_SESSION['success'] == -1)
			$_SESSION['dari_internal'] = true;
		redirect("kesehatan_balita/form_balita");
	}

	public function add_balita()
	{
		$this->kesehatan_balita_model->add_balita($_POST);
		redirect("kesehatan_balita");
	}

	public function hapus_balita($id_balita)
	{
		$this->redirect_hak_akses('h', "kesehatan_balita");
		$this->kesehatan_balita_model->delete_balita_by_id($id_balita);
		redirect("kesehatan_balita");
	}

	public function edit_balita_form($id = 0)
	{
		$data = $this->kesehatan_balita_model->get_balita_by_id($id);

		$data['form_action'] = site_url("kesehatan_balita/edit_balita/$id");
		$this->load->view('kesehatan/balita/edit_balita', $data);
	}

	public function edit_balita($id)
	{
		$this->kesehatan_balita_model->update_balita_by_id($_POST, $id);
		redirect("kesehatan_balita");
	}

	public function detil_balita($id)
	{
		$nav['act'] = 501;

		$data['terdata'] = $this->kesehatan_balita_model->get_balita_by_id($id);
		$data['individu'] = $this->kesehatan_balita_model->get_penduduk_by_id($data['terdata']['id_terdata']);

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

		$data['form_action_penduduk'] = site_url("kesehatan/balita/update_penduduk/".$data['terdata']['id_terdata']."/".$id);
		$this->render('kesehatan/balita/detil_balita', $data);
	}

	public function update_penduduk($id_pend, $id_balita)
	{
		$this->penduduk_model->update($id_pend);
		if ($_SESSION['success'] == -1)
			$_SESSION['dari_internal'] = true;
		redirect("kesehatan/balita/detil_balita/$id_balita");
	}

	public function pantau($page=1, $filter_tgl=null, $filter_nik=null)
	{
		$this->sub_modul_ini = 341;

		if (isset($_POST['per_page']))
			$this->session->set_userdata('per_page', $_POST['per_page']);
		else
			$this->session->set_userdata('per_page', 10);
		$data['per_page'] = $this->session->userdata('per_page');
		$data['page'] = $page;

		// get list balita
		$data['balita_array'] = $this->kesehatan_balita_model->get_list_balita_wajib_pantau(true);
		// get list balita end

		// get list pemantauan
		$pantau_balita = $this->kesehatan_balita_model->get_list_pantau_balita($page, $filter_tgl, $filter_nik);
		$data['unique_nik'] = $this->kesehatan_balita_model->get_unique_nik_pantau_balita();
		$data['unique_date'] = $this->kesehatan_balita_model->get_unique_date_pantau_balita();
		$data['filter_tgl'] = isset($filter_tgl) ? $filter_tgl : '0';
		$data['filter_nik'] = isset($filter_nik) ? $filter_nik : '0';

		$data['paging'] = $pantau_balita["paging"];
		$data['pantau_balita_array'] = $pantau_balita["query_array"];
		// get list pemantauan end

		// datetime now
		$d = new DateTime('NOW');
		$data['datetime_now'] = $d->format('Y-m-d H:i:s');

		$data['this_url'] = site_url("kesehatan_balita/pantau");
		$data['form_action'] = site_url("kesehatan_balita/add_pantau");

		$url_delete_front = "kesehatan_balita/hapus_pantau";
		$url_delete_rare = "$page";
		$data['url_delete_front'] = $url_delete_front;
		$data['url_delete_rare'] = $url_delete_rare;
		$this->set_minsidebar(1);

		$this->render('kesehatan/balita/pantau_balita', $data);
	}

	public function add_pantau()
	{
		$this->kesehatan_balita_model->add_pantau_balita($_POST);
		$url = "kesehatan_balita/pantau/".$_POST["page"]."/".$_POST["data_h_plus"];
		redirect($url);
	}

	public function hapus_pantau($id_pantau_balita, $page=NULL, $h_plus=NULL)
	{
		$this->redirect_hak_akses('h', "kesehatan_balita");
		$this->kesehatan_balita_model->delete_pantau_balita_by_id($id_pantau_balita);

		$url = "kesehatan_balita/pantau";
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
			$data = $this->kesehatan_balita_model->get_list_pantau_balita(1, $filter_tgl, $filter_nik);
			$judul = 'pantauan';
		}
		else
		{
			$data = $this->kesehatan_balita_model->get_list_balita(1);
			$judul = 'pendataan';
		}

		if ($aksi === 'cetak') $aksi = $aksi.'_'.$judul;

		$data['config'] = $this->config_model->get_data();
		$data['aksi'] = $aksi;
		$data['judul'] = $judul;
		$this->session->set_userdata('per_page', 10); // Kembalikan ke paginasi default

		$this->load->view('kesehatan/balita/'.$data['aksi'], $data);
	}
}

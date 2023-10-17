<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('web_komentar_model');
		$this->load->model('mandiri_model');
		$this->load->model('mailbox_model');
		$this->load->model('config_model');
		$this->modul_ini = 14;
		$this->sub_modul_ini = 55;
	}

	public function clear($kat = 1, $p = 1, $o = 0)
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter_status']);
		unset($_SESSION['filter_nik']);
		unset($_SESSION['filter_archived']);
		redirect("mailbox/index/$kat/$p/$o");
	}

	public function index($kat = 1, $p = 1, $o = 0)
	{
		$data['p'] = $p;
		$data['o'] = $o;
		$data['kat'] = $kat;

		$list_session = array('cari', 'filter_status', 'filter_nik', 'filter_archived');

		foreach ($list_session as $session) {
			$data[$session] = $this->session->userdata($session) ?: '';
		}

		if ($nik = $this->session->userdata('filter_nik')) {
			$data['individu'] = $this->mandiri_model->get_pendaftar_mandiri($nik);
		}

		if ($per_page = $this->input->post('per_page')) {
			$this->session->set_userdata('per_page', $per_page);
		}

		$data['per_page'] = $_SESSION['per_page'];
		$data['paging'] = $this->web_komentar_model->paging($p, $o, $kat);
		$data['main'] = $this->web_komentar_model->list_data($o, $data['paging']->offset, $data['paging']->per_page, $kat);
		$data['owner'] = $kat == 1 ? 'Pengirim' : 'Penerima';
		$data['keyword'] = $this->web_komentar_model->autocomplete();
		$data['submenu'] = $this->mailbox_model->list_menu();
		$_SESSION['submenu'] = $kat;

		$this->set_minsidebar(1);
		$this->render('mailbox/table', $data);
	}

	public function form()
	{
		if (!empty($nik = $this->input->post('nik'))) {
			$data['individu'] = $this->mandiri_model->get_pendaftar_mandiri($nik);
		}
		if (!empty($subjek = $this->input->post('subjek'))) {
			$data['subjek'] = $subjek;
		}
		$data['form_action'] = site_url("mailbox/kirim_pesan");

		$this->render('mailbox/form', $data);
	}

	public function kirim_pesan()
	{
		$post = $this->input->post();
		$post['tipe'] = 2;
		$post['status'] = 2;
		$this->mailbox_model->insert($post);
		redirect('mailbox');
	}

	public function baca_pesan($kat = 1, $id)
	{
		if ($kat == 1) {
			$this->web_komentar_model->komentar_lock($id, 1);
			unset($_SESSION['success']);
		}

		$data['kat'] = $kat;
		$data['owner'] = $kat == 1 ? 'Pengirim' : 'Penerima';
		$data['pesan'] = $this->web_komentar_model->get_komentar($id);
		$data['tipe_mailbox'] = $this->mailbox_model->get_kat_nama($kat);

		$this->render('mailbox/detail', $data);
	}

	public function search($kat = 1)
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		redirect("mailbox/index/{$kat}");
	}

	public function filter_status($kat = 1)
	{
		$status = $this->input->post('status');
		if ($status != 0){
			if ($status == 3) {
				$_SESSION['filter_archived'] = true;
				unset($_SESSION['filter_status']);
			} else {
				$_SESSION['filter_status'] = $status;
				unset($_SESSION['filter_archived']);
			}
		}
		else {
			unset($_SESSION['filter_status']);
			unset($_SESSION['filter_archived']);
		}
		redirect("mailbox/index/{$kat}");
	}

	public function filter_nik($kat = 1)
	{
		$nik = $this->input->post('nik');
		if (!empty($nik) AND $nik != 0)
			$_SESSION['filter_nik'] = $nik;
		else unset($_SESSION['filter_nik']);
		redirect("mailbox/index/{$kat}");
	}

	public function list_pendaftar_mandiri_ajax()
	{
		$cari = $this->input->get('q');
		$page = $this->input->get('page');
		$list_pendaftar_mandiri = $this->mandiri_model->list_data_ajax($cari, $page);
		echo json_encode($list_pendaftar_mandiri);
	}

	public function archive($kat = 1, $p = 1, $o = 0, $id = '')
	{
		$this->redirect_hak_akses('h', "mailbox/index/$p/$o");
		$this->web_komentar_model->archive($id);
		redirect("mailbox/index/$kat/$p/$o");
	}

	public function archive_all($kat = 1, $p = 1, $o = 0)
	{
		$this->redirect_hak_akses('h', "mailbox/index/$p/$o");
		$this->web_komentar_model->archive_all();
		redirect("mailbox/index/$kat/$p/$o");
	}

	public function pesan_read($id = '')
	{
		$this->web_komentar_model->komentar_lock($id, 1);
		redirect("mailbox");
	}

	public function pesan_unread($id = '')
	{
		$this->web_komentar_model->komentar_lock($id, 2);
		redirect("mailbox");
	}
}

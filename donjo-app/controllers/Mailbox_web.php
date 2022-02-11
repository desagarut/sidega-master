<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox_web extends Web_Controller {

	private $cek_anjungan;

	public function __construct()
	{
		parent::__construct();
		if ( ! isset($_SESSION['mandiri'])) {
			redirect('first');
		}
		else
		{
			$this->load->model(['config_model', 'mailbox_model', 'mandiri_model', 'anjungan_model']);
			$this->cek_anjungan = $this->anjungan_model->cek_anjungan();
		}
	}

	public function index()
	{
		redirect('mandiri_web/mandiri/1/3');
	}

	public function form()
	{
		if ( ! empty($subjek = $this->input->post('subjek'))) {
			$data['subjek'] = $subjek;
		}
		$data['deskel'] = $this->config_model->get_data();
		$data['individu'] = $this->mandiri_model->get_mandiri($this->session->nik, true);
		$data['form_action'] = site_url("mailbox_web/kirim_pesan");
		$data['views_partial_layout'] = "web/mandiri/mailbox_form";
		$data['cek_anjungan'] = $this->cek_anjungan;

		$this->load->view('web/mandiri/layout.mandiri.php', $data);
	}

	// TODO: pisahkan mailbox dari komentar
	public function kirim_pesan()
	{
		$post = $this->input->post();
		$individu = $this->mandiri_model->get_mandiri($this->session->nik, true);
		$post['email'] = $individu['nik']; // kolom email diisi nik untuk pesan
		$post['owner'] = $individu['nama'];
		$post['tipe'] = 1;
		$post['status'] = 2;
		$this->mailbox_model->insert($post);
		redirect('mandiri_web/mandiri/1/3/2');
	}

	public function baca_pesan($kat = 1, $id)
	{
		$nik = $this->session->userdata('nik');
		if ($kat == 1) {
			$this->mailbox_model->ubah_status_pesan($nik, $id, 1);
		}

		$data['kat'] = $kat;
		$data['owner'] = $kat == 1 ? 'Penerima' : 'Pengirim';
		$data['pesan'] = $this->mailbox_model->get_pesan($nik, $id);
		$data['tipe_mailbox'] = $this->mailbox_model->get_kat_nama($kat);
		$data['views_partial_layout'] = "web/mandiri/mailbox_detail";
		$data['cek_anjungan'] = $this->cek_anjungan;

		$this->load->view('web/mandiri/layout.mandiri.php', $data);
	}

	public function pesan_read($id = '')
	{
		$nik = $this->session->userdata('nik');
		$this->mailbox_model->ubah_status_pesan($nik, $id, 1);
		redirect("mandiri_web/mandiri/1/3");
	}

	public function pesan_unread($id = '')
	{
		$nik = $this->session->userdata('nik');
		$this->mailbox_model->ubah_status_pesan($nik, $id, 2);
		redirect("mandiri_web/mandiri/1/3");
	}
}

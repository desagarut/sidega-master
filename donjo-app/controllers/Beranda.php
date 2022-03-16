<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('release');

		$this->load->model('header_model');
		$this->load->model('program_bantuan_model');
		$this->load->model('surat_model');
		$this->load->model('web_pengunjung_model');
		$this->load->model('notif_model');
	    $this->load->model('first_m');
	    $this->load->model('user_model');
		$this->load->model('header_model');
		$this->load->library('data_publik');
        $this->load->model("data_sppt_model");
		
		$this->load->model('referensi_model');
		$this->load->model('wilayah_model');
		$this->load->model('laporan_penduduk_model');
		$this->load->model('pamong_model');
		$this->load->model('program_bantuan_model');
		$this->load->model('config_model');
		$this->load->model('dpt_model');

		
		
		$this->modul_ini = 1;
	}

	public function index()
	{
	//	if ($this->release->has_internet_connection())
	//	{
		/*	$this->release->set_api_url('https://api.github.com/repos/sidega/sidega/releases/latest')
				->set_interval(7)
				->set_cache_folder(FCPATH.'desa');

			$data['update_available'] = $this->release->is_available();
			$data['current_version'] = $this->release->get_current_version();
			$data['latest_version'] = $this->release->get_latest_version();
			$data['release_name'] = $this->release->get_release_name();
			$data['release_body'] = $this->release->get_release_body();
			*/
	//	}
		$data['setting_desa'] = $this->config_model->get_data();
		// Pengambilan data penduduk untuk ditampilkan widget Halaman Dashboard (modul Home SID)
		$data['penduduk'] = $this->header_model->penduduk_total();
		$data['keluarga'] = $this->header_model->keluarga_total();
		$data['bantuan'] = $this->header_model->bantuan_total();
		$data['kelompok'] = $this->header_model->kelompok_total();
		$data['rtm'] = $this->header_model->rtm_total();
		$data['dusun'] = $this->header_model->dusun_total();
		$data['jumlah_surat'] = $this->surat_model->surat_total();

		//Tampil Pengunjung
		$data['hari_ini'] = $this->web_pengunjung_model->get_count('1');
		$data['kemarin'] = $this->web_pengunjung_model->get_count('2');
		$data['minggu_ini'] = $this->web_pengunjung_model->get_count('3');
		$data['bulan_ini'] = $this->web_pengunjung_model->get_count('4');
		$data['tahun_ini'] = $this->web_pengunjung_model->get_count('5');
		$data['jumlah'] = $this->web_pengunjung_model->get_count('');
		$data['main'] = $this->web_pengunjung_model->get_pengunjung($_SESSION['id']);	

		//Notif Model
		$data['permohonan_surat'] = $this->notif_model->permohonan_surat_baru();
		$data['status'] = $this->notif_model->inbox_baru();
		$data['komentar'] = $this->notif_model->komentar_baru();

		//last login
	    $data['last_login'] = $this->first_m->last_login();
	    $data['last_login_operator'] = $this->user_model->list_data(7, 0, 5);
		$header = $this->header_model->get_data();

		//Rekapitulasi SPPT PBB
		$data['pbb_terhutang'] = $this->data_sppt_model->rekapitulasi('');
        $data['data'] = $this->data_sppt_model->rekapitulasi();
        $data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };
		
		
		
		$this->set_minsidebar(1);
		$this->render('home/desa', $data);

	}
	
	public function dialog_pengaturan()
	{
		$data['list_program_bantuan'] = $this->program_bantuan_model->list_program();
		$data['sasaran'] = unserialize(SASARAN);
		$data['form_action'] = site_url("beranda/ubah_program_bantuan");
		$this->load->view('home/pengaturan_form', $data);
	}

	public function ubah_program_bantuan()
	{
		$this->db->where('key','dashboard_program_bantuan')->update('setting_aplikasi', array('value'=>$this->input->post('program_bantuan')));
		redirect('beranda');
	}
}

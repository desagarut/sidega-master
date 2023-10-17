<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Insidega extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		insidega_timeout();
		$this->load->model('config_model');
		$this->load->model('user_model');
	}

	public function index()
	{
		
		$data_desa = $this->config_model->get_data();
		$data['desa'] = $this->config_model->get_data();
		$data['wil_ini'] = $data_desa;
		$data['wilayah'] = ucwords($this->setting->sebutan_desa . " " . $data_desa['nama_desa']);
		$data['nama_wilayah'] = ucwords($this->setting->sebutan_desa . " " . $data_desa['nama_desa']);

		if (isset($_SESSION['insidega']) and 1 == $_SESSION['insidega'])
		{
			redirect('main');
		}
		unset($_SESSION['balik_ke']);
		$data['header'] = $this->config_model->get_data();
		//Initialize Session ------------
		if (!isset($_SESSION['insidega']))
		{
			// Belum ada session variable
			$this->session->set_userdata('insidega', 0);
			$this->session->set_userdata('insidega_try', 4);
			$this->session->set_userdata('insidega_wait', 0);
		}
		$_SESSION['success'] = 0;
		$_SESSION['per_page'] = 10;
		$_SESSION['cari'] = '';
		$_SESSION['pengumuman'] = 0;
		$_SESSION['sesi'] = "kosong";
		//-------------------------------

		$this->load->view('insidega', $data);
	}

	public function auth()
	{
		$method = $this->input->method(TRUE);
				$allow_method = ['POST'];
		if(!in_array($method,$allow_method))
		{
			redirect('insidega/login');
		}
		$this->user_model->insidega();

		if ($_SESSION['insidega'] != 1)
		{
			// Gagal otentifikasi
			redirect('insidega');
		}

		if (!$this->user_model->syarat_sandi() and !($this->session->user == 1 && $this->setting->demo_mode))
		{
			// Password tidak memenuhi syarat kecuali di website demo
			redirect('user_setting/change_pwd');
		}

		$_SESSION['dari_login'] = '1';
		// Notif bisa dipanggil sewaktu-waktu dan tidak digunakan untuk redirect
		if (isset($_SESSION['request_uri']) and strpos($_SESSION['request_uri'], 'notif/') === FALSE)
		{
			// Lengkapi url supaya tidak diubah oleh redirect
			$request_awal = $_SERVER['HTTP_ORIGIN'] . $_SESSION['request_uri'];
			unset($_SESSION['request_uri']);
			redirect($request_awal);
		}
		else
		{
			unset($_SESSION['request_uri']);
			unset($this->session->fm_key);
			$this->user_model->get_fm_key();
			redirect('main');
		}
	}

	public function login()
	{
		$this->user_model->login();
		$data['header'] = $this->config_model->get_data();
		$this->load->view('insidega', $data);
	}

	public function logout()
	{
		$this->user_model->logout();
		$this->index();
	}

}

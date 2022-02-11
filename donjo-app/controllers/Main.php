<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('config_model');
		$this->load->model('pamong_model');
		$this->load->model('track_model');
	}

	public function maintenance_mode()
	{
		if (isset($_SESSION['insidega']) AND $_SESSION['insidega'] == 1)
			redirect('main');
		$data['main'] = $this->config_model->get_data();
		$data['pamong_kades'] = $this->pamong_model->get_ttd();
		if (file_exists(FCPATH.'desa/offline_mode.php'))
			$this->load->view('../../desa/offline_mode', $data);
		else
			$this->load->view('offline_mode', $data);
	}

	public function index()
	{
		if (isset($_SESSION['insidega']) AND $_SESSION['insidega'] == 1)
		{
			$this->track_model->track_desa('main');
			$this->load->model('user_model');
			$grup = $this->user_model->sesi_grup($_SESSION['sesi']);
			switch ($grup)
			{
				case 1 : redirect('beranda'); break;
				case 2 : redirect('beranda'); break;
				case 3 : redirect('beranda'); break;
				case 4 : redirect('beranda'); break;
				case 5 : redirect('beranda'); break;
				case 6 : redirect('beranda'); break;
				case 7 : redirect('beranda'); break;
				case 8 : redirect('beranda'); break;
				case 9 : redirect('beranda'); break;
				case 10 : redirect('beranda'); break;
				case 11 : redirect('beranda'); break;
				case 12 : redirect('covid19'); break;
				case 13 : redirect('covid19'); break;
				case 14 : redirect('covid19'); break;
				case 15 : redirect('covid19'); break;
				case 16 : redirect('web'); break;
				case 17 : redirect('web'); break;
				default : redirect('insidega');
			}
		}
		else if ($this->setting->offline_mode > 0)
		{
			// Jika website hanya bisa diakses user, maka harus login dulu
			redirect('insidega');
		}
		else
		{
			redirect();
		}
	}
}

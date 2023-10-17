<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Statistik_web extends Web_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan_penduduk_model');
		$this->load->model('pamong_model');
		$this->load->model('program_bantuan_model');
		
		$_SESSION['per_page'] = 500;
	}

	private function get_cluster_session()
	{
		$list_session = ['dusun', 'rw', 'rt'];
		foreach ($this->list_session as $list)
		{
			$$list = $this->session->$list;
		}

		if (isset($dusun))
		{
			$data['dusun'] = $dusun;
			$data['list_rw'] = $this->wilayah_model->list_rw($dusun);

			if (isset($rw))
			{
				$data['rw'] = $rw;
				$data['list_rt'] = $this->wilayah_model->list_rt($dusun, $rw);

				if (isset($rt))
					$data['rt'] = $rt;
				else $data['rt'] = '';
			}
			else $data['rw'] = '';
		}
		else
		{
			$data['dusun'] = $data['rw'] = $data['rt'] = '';
		}

		return $data;
	}

	private function get_data_stat(&$data, $lap)
	{
		$data['stat'] = $this->laporan_penduduk_model->judul_statistik($lap);
		$data['list_bantuan'] = $this->program_bantuan_model->list_program(0);
		if ($lap > 50)
		{
			// Untuk program bantuan, $lap berbentuk '50<program_id>'
			$program_id = preg_replace('/^50/', '', $lap);
			$data['program'] = $this->program_bantuan_model->get_sasaran($program_id);
			$data['judul_kelompok'] = $data['program']['judul_sasaran'];
			$data['kategori'] = 'bantuan';
		}
		elseif (in_array($lap, array('bantuan_penduduk', 'bantuan_keluarga')))
		{
			$data['kategori'] = 'bantuan';
		}
		elseif ($lap > 20 OR "$lap" == 'kelas_sosial')
		{
			$data['kategori'] = 'keluarga';
		}
		else
		{
			$data['kategori'] = 'penduduk';
		}
	}

	public function dusun($tipe = 0, $lap = 0)
	{
		$tipe_stat = $this->get_tipe_statistik($tipe);
		$this->session->unset_userdata('rw');
		$this->session->unset_userdata('rt');
		$dusun = $this->input->post('dusun');
		if ($dusun)
			$this->session->set_userdata('dusun', $dusun);
		else
			$this->session->unset_userdata('dusun');
		redirect("statistik_web/$tipe_stat/$lap");
	}

	public function rw($tipe = 0, $lap = 0)
	{
		$tipe_stat = $this->get_tipe_statistik($tipe);
		$this->session->unset_userdata('rt');
		$rw = $this->input->post('rw');
		if ($rw)
			$this->session->set_userdata('rw', $rw);
		else
			$this->session->unset_userdata('rw');
		redirect("statistik_web/$tipe_stat/$lap");
	}

	public function rt($tipe = 0, $lap = 0)
	{
		$tipe_stat = $this->get_tipe_statistik($tipe);
		$rt = $this->input->post('rt');
		if ($rt)
			$this->session->set_userdata('rt', $rt);
		else
			$this->session->unset_userdata('rt');
		redirect("statistik_web/$tipe_stat/$lap");
	}

	public function chart_gis_desa($lap = 0, $desa = '' )
	{
		($desa) ? $this->session->set_userdata('desa', ununderscore($desa)) : $this->session->unset_userdata('desa');
		$this->session->unset_userdata('dusun');
		$this->session->unset_userdata('rw');
		$this->session->unset_userdata('rt');

		redirect("statistik_web/load_chart_gis/$lap");
	}

	public function load_chart_gis($lap = 0)
	{
		$data = $this->get_cluster_session();
		$data['main'] = $this->laporan_penduduk_model->list_data($lap);
		$data['lap'] = $lap;
		$data['untuk_web'] = true; // Untuk me-nonaktfikan tautan di tabel statistik kependudukan
		$this->get_data_stat($data, $lap);
		$this->load->view('gis/penduduk_gis', $data);
	}

	public function chart_gis_dusun($lap = 0, $dusun = '' )
	{
		($dusun) ? $this->session->set_userdata('dusun', ununderscore($dusun)) : $this->session->unset_userdata('dusun');
		$this->session->unset_userdata('rw');
		$this->session->unset_userdata('rt');

		redirect("statistik_web/load_chart_gis/$lap");
	}

	public function chart_gis_rw($lap = 0, $dusun = '', $rw = '' )
	{
		($dusun) ? $this->session->set_userdata('dusun', ununderscore($dusun)) : $this->session->unset_userdata('dusun');
		($rw) ? $this->session->set_userdata('rw', ununderscore($rw)) : $this->session->unset_userdata('rw');
		$this->session->unset_userdata('rt');

		redirect("statistik_web/load_chart_gis/$lap");
	}

	public function chart_gis_rt($lap = 0, $dusun = '', $rw = '', $rt = '' )
	{
		($dusun) ? $this->session->set_userdata('dusun', ununderscore($dusun)) : $this->session->unset_userdata('dusun');
		($rw) ? $this->session->set_userdata('rw', ununderscore($rw)) : $this->session->unset_userdata('rw');
		($rt) ? $this->session->set_userdata('rt', ununderscore($rt)) : $this->session->unset_userdata('rt');

		redirect("statistik_web/load_chart_gis/$lap");
	}

	public function chart_gis_kadus($id_kepala = '' )
	{
		($dusun) ? $this->session->set_userdata('dusun', $dusun) : $this->session->unset_userdata('dusun');
		$this->session->unset_userdata('rw');
		$this->session->unset_userdata('rt');

		redirect("statistik_web/load_kadus/$id_kepala");
	}

	public function load_kadus($id_kepala = '')
	{
		$data['individu'] = $this->wilayah_model->get_penduduk($dusun['id_kepala']);

		$this->_get_common_data($data);
		$this->load->view('gis/kadus/', $data);
	}
}

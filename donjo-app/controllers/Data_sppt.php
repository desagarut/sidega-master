<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Data_sppt extends Admin_Controller {

	private $set_page;
	private $list_session;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('config_model');
		$this->load->model('pamong_model');
		$this->load->model('data_sppt_model');
		$this->load->model('penduduk_model');
		$this->load->model('referensi_model');
		$this->modul_ini = 7;
		$this->sub_modul_ini = 316;
		$this->set_page = ['20', '50', '100'];
		$this->list_session = ['cari'];
	}

	public function clear()
	{
		$this->session->unset_userdata($this->list_session);
		$this->session->per_page = $this->set_page[0];
		redirect('data_sppt');
	}
	

	// TODO: fix
	public function autocomplete()
	{
		$data = $this->data_sppt_model->autocomplete($this->input->post('cari'));
		echo json_encode($data);
	}
	

	public function search(){
		$this->session->cari = $this->input->post('cari') ?: NULL;
		redirect('data_sppt');
	}
	
	public function index($page=1, $o=0)
	{
		$this->tab_ini = 20;
		$this->set_minsidebar(1);

		$data['cari'] = isset($_SESSION['cari']) ? $_SESSION['cari'] : '';
		$_SESSION['per_page'] = $_POST['per_page'] ?: null;
		$data['per_page'] = $_SESSION['per_page'];
		
		$data['func'] = 'index';
		$data['set_page'] = $this->set_page;
		$data['paging']  = $this->data_sppt_model->paging_data_sppt($page);
//		$data["deskel"] = $this->config_model->get_data();
		$data["data_sppt"] = $this->data_sppt_model->list_data_sppt($data['paging']->offset, $data['paging']->per_page);
		
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };
		$this->render('data_sppt/sppt_daftar', $data);
	}

	
    public function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }

	public function sppt_detail($id)
	{
		$this->tab_ini = 20;
		$this->set_minsidebar(1);
		$data = array();
		$data['data_sppt'] = $this->data_sppt_model->get_data_sppt($id);
		$data['wajib_pajak'] = $this->data_sppt_model->get_wajib_pajak($id);
		if ($id){
			$data['lokasi_op'] = $this->data_sppt_model->get_lokasi($id);
		}else{
			$data['lokasi_op'] = NULL;
		}

		$this->render('data_sppt/sppt_detail', $data);
	}


	public function sppt_form($mode=0, $id=0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Tanah', 'required');

		$this->set_minsidebar(1);		
		$this->tab_ini = empty($mode) ? 20 : 20;

		$post = $this->input->post();
		$data = array();
		$data["mode"] = $mode;
		$data["penduduk"] = $this->data_sppt_model->list_penduduk();
		if ($mode === 'edit')
		{
			$data['sppt'] = $this->data_sppt_model->get_data_sppt($id);
			$this->ubah_wajib_pajak($id, $data, $post);
		}
		else
		{
			switch ($post['jenis_wp'])
			{
				case '1':
					# Pemilik deskel
					if (!empty($post['nik']))
					{
						$data['wajib_pajak'] = $this->data_sppt_model->get_penduduk($post['nik'], $nik=true);
					}
					break;
				case '2':
					# Pemilik luar deskel
					$data['sppt']['jenis_wp'] = 2;
					break;
			}
		}

		$this->render('data_sppt/sppt_form', $data);
	}


	private function ubah_wajib_pajak($id, &$data, $post)
	{
		$jenis_wp_baru = $post['jenis_wp'] ?: 0;

		switch ($jenis_wp_baru)
		{
			case '0':
				// Buka form ubah pertama kali
				if ($data['sppt']['jenis_wp'] == 1)
				{
					$data['wajib_pajak'] = $this->data_sppt_model->get_wajib_pajak($id);
				}
				break;
			case '1':
				// Ubah atau ambil wajib_pajak deskel
				$data['wajib_pajak'] = $this->data_sppt_model->get_wajib_pajak($id);
				if ($post['nik'] and $$data['wajib_pajak']['nik'] != $post['nik'])
				{
					$data['wajib_pajak'] = $this->data_sppt_model->get_penduduk($post['nik'], $nik=true);
				}
				$data['sppt']['jenis_wp'] = $jenis_wp_baru;
				break;
			case '2':
				// Ubah wajib_pajak luar
				$data['sppt']['jenis_wp'] = $jenis_wp_baru;
				break;
		}
	}

	public function simpan_sppt($page=1)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('data_sppt','Nomor Objek Pajak','required|trim|numeric');
		$this->form_validation->set_rules('data_sppt', 'Username', 'callback_cek_nomor');

		if ($this->form_validation->run() != false)
		{
			$id_sppt = $this->data_sppt_model->simpan_sppt();
			$this->input->post('id');
			redirect("data_sppt");
		}
		else
		{
			$_SESSION["success"] = -1;
			$_SESSION["error_msg"] = trim(strip_tags(validation_errors()));
			$jenis_wp = $this->input->post('jenis_wp');
			$id	= $this->input->post('id');
			if ($jenis_wp == 1)
			{
				if ($id)
					redirect("data_sppt/sppt_form/edit/".$id);
				else
					redirect("data_sppt/sppt_form");
			}
			else
			{
				if ($id)
					redirect("data_sppt/sppt_form/edit/".$id);
				else
					redirect("data_sppt/sppt_form");
			}
		}
	}

// Controller Tagihan
	public function clear_tagih()
	{
		$this->session->unset_userdata($this->list_session);
		$this->session->per_page = $this->set_page[0];
		redirect('data_sppt/tagihan_daftar');
	}
	
		public function autocomplete_tagih()
	{
		$data = $this->data_sppt_model->autocomplete_tagih($this->input->post('cari_tagih'));
		echo json_encode($data);
	}

	public function search_tagih(){
		$this->session->cari_tagih = $this->input->post('cari_tagih') ?: NULL;
		redirect('data_sppt/tagihan_daftar');
	}
	

	public function tagihan_daftar($page=1, $o=0)
	{
		$this->tab_ini = 21;
		$this->set_minsidebar(1);

		$data['cari_tagih'] = isset($_SESSION['cari_tagih']) ? $_SESSION['cari_tagih'] : '';
		$_SESSION['per_page'] = $_POST['per_page'] ?: null;
		$data['per_page'] = $_SESSION['per_page'];

		$data['func'] = 'tagihan_daftar';
		$data['set_page'] = $this->set_page;
		$data['paging']  = $this->data_sppt_model->paging_data_tagihan($page);
		$data["list_tagihan"] = $this->data_sppt_model->list_tagihan($data['paging']->offset, $data['paging']->per_page);
		
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('data_sppt/tagihan_daftar', $data);
	}
	
	public function tagihan_tambah($mode=0, $id=0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'required');

//		$this->tab_ini = empty($mode) ? 21 : 21;

		$post = $this->input->post();
		$data = array();
		$data["mode"] = $mode;
		//$data["penduduk"] = $this->data_sppt_model->list_penduduk();
		if ($mode === 'edit')
		{
			$data['sppt'] = $this->data_sppt_model->get_data_sppt($id);
			$this->ubah_wajib_pajak($id_tagih, $data, $post);
		}
		else
		{
			switch ($post['jenis_wp'])
			{
				case '1':
					# Pemilik deskel
					if (!empty($post['nik']))
					{
						$data['wajib_pajak'] = $this->data_sppt_model->get_penduduk($post['nik'], $nik=true);
					}
					break;
				case '2':
					# Pemilik luar deskel
					$data['sppt']['jenis_wp'] = 2;
					break;
			}
		}
		$this->load->view('data_sppt/tagihan_tambah', $data);
		//$this->render('data_sppt/tagihan_tambah', $data);
	}
	
	public function simpan_tagihan($page=1)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('data_sppt','Nomor Objek Pajak','required|trim|numeric');
		$this->form_validation->set_rules('data_sppt', 'Username', 'callback_cek_nomor');

//		if ($this->form_validation->run() != false)
//		{
//			status_sukses($outp); //Tampilkan Pesan
//			$id_sppt = $this->data_sppt_model->simpan_tagihan();
//			$this->input->post('id_tagih');
//			redirect("data_sppt/tagihan_daftar");
//		}
//		
		if ($this->form_validation->run() != false)
		{
			$id_sppt = $this->data_sppt_model->simpan_tagihan();
			$this->input->post('id_tagih');
			redirect("data_sppt/tagihan_daftar");
		}
		else
		{
			$_SESSION["success"] = -1;
			$_SESSION["error_msg"] = trim(strip_tags(validation_errors()));
			$jenis_wp = $this->input->post('jenis_wp');
			$id	= $this->input->post('id');
			if ($jenis_wp == 1)
			{
				if ($data)
					redirect('data_sppt/tagihan_tambah', $data);
				else
					redirect('data_sppt/tagihan_daftar');
			}
			else
			{
				if ($data)
					redirect('data_sppt/tagihan_tambah', $data);
				else
					redirect("data_sppt/tagihan_daftar");
			}
		}
	}
	
	public function tagihan_ubah($id)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$validation=$this->form_validation;

		$data['ubah_tagih'] = $this->data_sppt_model->get_data_tagih($id);

		$this->load->view('data_sppt/tagihan_ubah', $data);
		//		status_sukses($outp); //Tampilkan Pesan

	}

	public function update_tagihan_save()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tahun_tagih','Tahun Tagih','required|trim|numeric');
		$this->form_validation->set_rules('data_sppt', 'Username', 'callback_cek_nomor');

		if ($this->form_validation->run() != false)
		{
			$id_sppt = $this->data_sppt_model->update_tagihan();
			$this->input->post('id_tagih');
			//				status_sukses($outp); //Tampilkan Pesan

			redirect("data_sppt/tagihan_daftar");
		}

	}
	
	public function tagihan_ubah_bayar($id)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		//$validation=$this->form_validation;

		$data['ubah_tagih'] = $this->data_sppt_model->get_data_tagih($id);

		$this->load->view('data_sppt/tagihan_bayar', $data);
	}
	
	public function update_tagihan_save_bayar()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tahun_tagih','Tahun Tagih','required|trim|numeric');
		$this->form_validation->set_rules('data_sppt', 'Username', 'callback_cek_nomor');

		if ($this->form_validation->run() != false)
		{
			$id_sppt = $this->data_sppt_model->update_tagihan_bayar();
			$this->input->post('id_tagih');
			redirect("data_sppt/tagihan_daftar");
		}
	}
	
	public function hapus_tagih($id)
	{
		//$this->redirect_hak_akses('h', "data_tagih");
		$this->data_sppt_model->hapus_tagih($id);
		redirect("data_sppt/tagihan_daftar");
	}


// TODO: gunakan pada waktu validasi SPPT
	public function cek_nomor($nomor)
	{
		$id_sppt = $this->input->post('id');
		if ($id_sppt) $this->db->where('id <>', $id_sppt);
		$ada = $this->db
			->where('nomor', $nomor)
			->get('tbl_data_sppt')->num_rows();

		if ($ada)
		{
			$this->form_validation->set_message('cek_nomor', 'Nomor PBB SPPT ada');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	// TODO: perbaiki
	public function panduan()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->set_minsidebar(1);
		$this->tab_ini = 29;
		$nav['act'] = 7;
		$this->render('data_sppt/panduan');
	}

	public function hapus($id)
	{
		$this->redirect_hak_akses('h', "data_sppt");
		$this->data_sppt_model->hapus_sppt($id);
		redirect("data_sppt");
	}

	public function import()
	{
		$data['form_action'] = site_url("data_sppt/import_proses");
		$this->load->view('data_sppt/import', $data);
	}

	public function cetak($o=0)
	{
		$data['data_sppt'] = $this->data_sppt_model->list_data_sppt();
		$this->load->view('data_sppt/sppt_cetak', $data);
	}

	public function unduh($o=0)
	{
		$data['data_sppt'] = $this->data_sppt_model->list_data_sppt();
		$this->load->view('data_sppt/sppt_unduh', $data);		
	}

	public function form_data_sppt($id=0)
	{
		$data['deskel'] = $this->config_model->get_data();
		$data['sppt'] = $this->data_sppt_model->get_data_sppt($id);
		//$data['basah'] = $this->data_sppt_model->get_cetak_mutasi($id, 'BASAH');
		//$data['kering'] = $this->data_sppt_model->get_cetak_mutasi($id, 'KERING');
		$this->load->view('data_sppt/sppt_form_print', $data);
	}

	public function ajax_lokasi_maps($id=0)
	{
		if ($id){
			$data['lokasi_op'] = $this->data_sppt_model->get_lokasi($id);
		}else{
			$data['lokasi_op'] = NULL;
		}

		$data['deskel'] = $this->config_model->get_data();;
		$sebutan_deskel = ucwords($this->setting->sebutan_deskel);
		$data['wil_atas'] = $this->config_model->get_data();
		$data['dusun_gis'] = $this->wilayah_model->list_dusun();
		$data['rw_gis'] = $this->wilayah_model->list_rw_gis();
		$data['rt_gis'] = $this->wilayah_model->list_rt_gis();
//		$data['all_lokasi'] = $this->plan_lokasi_model->list_data();
//		$data['all_garis'] = $this->plan_garis_model->list_data();
//		$data['all_area'] = $this->plan_area_model->list_data();
		$data['form_action'] = site_url("data_sppt/update_maps/$id");
		
		$this->render("data_sppt/maps", $data);
	}
	
		public function update_maps($id=0)
	{
		$this->data_sppt_model->update_position($id);
		redirect("data_sppt");
	}	

	public function rekap($page=1, $o=0)
	{
		$this->tab_ini = 19;
		$this->set_minsidebar(1);
		$data['func'] = 'rekap';

        $data['data'] = $this->data_sppt_model->rekapitulasi();
        $data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('data_sppt/sppt_rekap', $data);
    }
	
	public function laporan($page=1, $o=0)
	{
		$this->tab_ini = 23;
		$this->set_minsidebar(1);
		$data['func'] = 'rekap';

        $data['data'] = $this->data_sppt_model->laporan();
        $data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('data_sppt/laporan', $data);
    }
	
	public function tagihan_cetak($o=0)
	{
		$data['data_sppt'] = $this->data_sppt_model->list_tagihan();
		$this->load->view('data_sppt/tagihan_cetak', $data);
	}

	public function tagihan_unduh($o=0)
	{
		$data['data_sppt'] = $this->data_sppt_model->list_tagihan();
		$this->load->view('data_sppt/tagihan_unduh', $data);		
	}

}

?>

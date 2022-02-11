<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tukang extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('referensi_model');
		$this->load->model('tukang_model');
		$this->load->model('config_model');
		$this->load->model('wilayah_model');
		$this->load->model('pamong_model');
		$this->load->model('plan_lokasi_model');
		$this->load->model('plan_area_model');
		$this->load->model('plan_garis_model');
		$this->modul_ini = 400;
		$this->sub_modul_ini = 403;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('tukang');
	}

	public function index($p=1, $o=0)
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['filter']))
			$data['filter'] = $_SESSION['filter'];
		else $data['filter'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page'] = $_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['paging'] = $this->tukang_model->paging($p,$o);
		$data['main'] = $this->tukang_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };
		$data['keyword'] = $this->tukang_model->autocomplete();

		$this->render('tukang/table', $data);
	}

	public function form($p=1, $o=0, $id='')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['tukang'] = $this->tukang_model->get_tukang($id);
			$data['sumber_modal'] = $this->referensi_model->list_ref(SUMBER_MODAL);
			$data['area'] = $this->referensi_model->list_ref(AREA_LAYANAN);
			$data['jenis_layanan'] = $this->referensi_model->list_ref(JENIS_LAYANAN);
			$data['jenis_pekerjaan'] = $this->referensi_model->list_ref(JENIS_PEKERJAAN);
			$data['kategori_pekerjaan'] = $this->referensi_model->list_ref(KATEGORI_PEKERJAAN);
			$data['spesifikasi_pekerjaan'] = $this->referensi_model->list_ref(PEKERJAAN_JASA);
			$data['status'] = $this->referensi_model->list_ref(STATUS_AKTIF);
			$data['kepemilikan_tempat_usaha'] = $this->referensi_model->list_ref(KEPEMILIKAN_TEMPAT_USAHA);
			$data['form_action'] = site_url("tukang/update/$id/$p/$o");
		}
		else
		{
			$data['tukang'] = null;
			$data['sumber_modal'] = $this->referensi_model->list_ref(SUMBER_MODAL);
			$data['area'] = $this->referensi_model->list_ref(AREA_LAYANAN);
			$data['jenis_layanan'] = $this->referensi_model->list_ref(JENIS_LAYANAN);
			$data['jenis_pekerjaan'] = $this->referensi_model->list_ref(JENIS_PEKERJAAN);
			$data['kategori_pekerjaan'] = $this->referensi_model->list_ref(KATEGORI_PEKERJAAN);
			$data['spesifikasi_pekerjaan'] = $this->referensi_model->list_ref(PEKERJAAN_JASA);
			$data['status'] = $this->referensi_model->list_ref(STATUS_AKTIF);
			$data['kepemilikan_tempat_usaha'] = $this->referensi_model->list_ref(KEPEMILIKAN_TEMPAT_USAHA);
			$data['form_action'] = site_url("tukang/insert");
		}
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('tukang/form', $data);
	}

	public function search($gallery='')
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		if ($gallery != '')
		{
			redirect("tukang/layanan/$gallery");
		}
		else
		{
			redirect('tukang');
		}
	}

	public function filter($gallery='')
	{
		$filter = $this->input->post('filter');
		if ($filter != 0)
			$_SESSION['filter'] = $filter;
		else unset($_SESSION['filter']);
		if ($gallery != '')
		{
			redirect("tukang/layanan/$gallery");
		}
		else
		{
			redirect('tukang');
		}
	}

	public function insert()
	{
		$this->tukang_model->insert();
		redirect('tukang');
	}

	public function update($id='', $p=1, $o=0)
	{
		$this->tukang_model->update($id);
		redirect("tukang/index/$p/$o");
	}

	public function delete($p=1, $o=0, $id='')
	{
		$this->redirect_hak_akses('h', "tukang/index/$p/$o");
		$this->tukang_model->delete_gallery($id);
		redirect("tukang/index/$p/$o");
	}

	public function delete_all($p=1, $o=0)
	{
		$this->redirect_hak_akses('h', "tukang/index/$p/$o");
		$_SESSION['success'] = 1;
		$this->tukang_model->delete_all_gallery();
		redirect("tukang/index/$p/$o");
	}

	public function tukang_lock($id='', $gallery='')
	{
		$this->tukang_model->tukang_lock($id, 1);
		if ($gallery != '')
			redirect("tukang/layanan/$gallery/$p");
		else
			redirect("tukang/index/$p/$o");
	}

	public function tukang_unlock($id='', $gallery='')
	{
		$this->tukang_model->tukang_lock($id, 2);
		if ($gallery != '')
			redirect("tukang/layanan/$gallery/$p");
		else
			redirect("tukang/index/$p/$o");
	}

	public function slider_on($id='', $gallery='')
	{
		$this->tukang_model->tukang_slider($id, 1);
		if ($gallery != '')
			redirect("tukang/layanan/$gallery/$p");
		else
			redirect("tukang/index/$p/$o");
	}

	public function slider_off($id='', $gallery='')
	{
		$this->tukang_model->gallery_slider($id,0);
		if ($gallery != '')
			redirect("tukang/layanan/$gallery/$p");
		else
			redirect("tukang/index/$p/$o");
	}
	
	public function layanan($gal=0, $p=1, $o=0)
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if (isset($_SESSION['cari']))
			$data['cari'] = $_SESSION['cari'];
		else $data['cari'] = '';

		if (isset($_SESSION['filter']))
			$data['filter'] = $_SESSION['filter'];
		else $data['filter'] = '';

		if (isset($_POST['per_page']))
			$_SESSION['per_page'] = $_POST['per_page'];
		$data['per_page'] = $_SESSION['per_page'];

		$data['paging'] = $this->tukang_model->paging2($gal, $p);
		$data['layanan_data'] = $this->tukang_model->list_layanan($gal, $o, $data['paging']->offset, $data['paging']->per_page);
		$data['gallery'] = $gal;
		$data['sub'] = $this->tukang_model->get_tukang($gal);
		$data['keyword'] = $this->tukang_model->autocomplete();

		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('tukang/table_layanan', $data);
	}

	public function form_layanan($gallery=0, $id=0)
	{
		if ($id)
		{
			$data['tukang'] = $this->tukang_model->get_tukang($id);
			$data['sebutan_biaya'] = $this->referensi_model->list_ref(SEBUTAN_BIAYA);
			$data['sebutan_ukuran'] = $this->referensi_model->list_ref(SEBUTAN_UKURAN);
			$data['form_action'] = site_url("tukang/update_layanan/$gallery/$id");
		}
		else
		{
			$data['tukang'] = null;
			$data['sebutan_biaya'] = $this->referensi_model->list_ref(SEBUTAN_BIAYA);
			$data['sebutan_ukuran'] = $this->referensi_model->list_ref(SEBUTAN_UKURAN);
			$data['form_action'] = site_url("tukang/insert_layanan/$gallery");
		}
		
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };
		$data['album']=$gallery;

		$this->render('tukang/form_layanan', $data);
	}

	public function insert_layanan($gallery='')
	{
		$this->tukang_model->insert_layanan($gallery);
		redirect("tukang/layanan/$gallery");
	}

	public function update_layanan($gallery='', $id='')
	{
		$this->tukang_model->update_layanan($id);
		redirect("tukang/layanan/$gallery");
	}

	public function delete_layanan($gallery='', $id='')
	{
		$this->redirect_hak_akses('h', "tukang/layanan/$gallery");
		$this->tukang_model->delete($id);
		redirect("tukang/layanan/$gallery");
	}

	public function delete_all_layanan($gallery='')
	{
		$this->redirect_hak_akses('h', "tukang/layanan/$gallery");
		$_SESSION['success']=1;
		$this->tukang_model->delete_all();
		redirect("tukang/layanan/$gallery");
	}

	public function tukang_lock_layanan($gallery='', $id='')
	{
		$this->tukang_model->tukang_lock($id, 1);
		redirect("tukang/layanan/$gallery");
	}

	public function tukang_unlock_layanan($gallery='', $id='')
	{
		$this->tukang_model->tukang_lock($id, 2);
		redirect("tukang/layanan/$gallery");
	}

	public function urut($id, $arah = 0, $gallery='')
	{
		$this->tukang_model->urut($id, $arah, $gallery);
		if ($gallery != '')
			redirect("tukang/layanan/$gallery");
		else
			redirect("tukang/index");
	}
	
	public function lokasi_maps($id)
	{

		$data = $this->tukang_model->list_data($id);

		if (is_null($data)) show_404();

		// Update lokasi maps
		if ($request = $this->input->post())
		{
			$this->tukang_model->update_map($id, $request);

			$this->session->success = 1;

			redirect('tukang');
		}
		$data['tukang'] = $this->tukang_model->get_tukang($id);
		$data['desa'] = $this->config_model->get_data($id);

		$this->render('tukang/peta',$data);
	}
	
	public function update_map($id = '')
	{
		$this->tukang_model->update_map($id);
		redirect("tukang");
	}
}

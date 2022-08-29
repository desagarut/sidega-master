<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tawa extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('referensi_model');
		$this->load->model('tawa_model');
		$this->load->model('config_model');
		$this->load->model('wilayah_model');
		$this->load->model('pamong_model');
		$this->load->model('plan_lokasi_model');
		$this->load->model('plan_area_model');
		$this->load->model('plan_garis_model');
		$this->modul_ini = 400;
		$this->sub_modul_ini = 402;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('tawa');
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

		$data['paging'] = $this->tawa_model->paging($p,$o);
		$data['main'] = $this->tawa_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };
		$data['keyword'] = $this->tawa_model->autocomplete();

		$this->render('tawa/table', $data);
	}

	public function form($p=1, $o=0, $id='')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['usaha'] = $this->tawa_model->get_usaha($id);
			$data['sumber_modal'] = $this->referensi_model->list_ref(SUMBER_MODAL);
			$data['area'] = $this->referensi_model->list_ref(AREA_LAYANAN);
			$data['jenis_usaha'] = $this->referensi_model->list_ref(JENIS_USAHA);
			$data['kelompok_usaha'] = $this->referensi_model->list_ref(KELOMPOK_USAHA);
			$data['kepemilikan_tempat_usaha'] = $this->referensi_model->list_ref(KEPEMILIKAN_TEMPAT_USAHA);
			$data['status'] = $this->referensi_model->list_ref(STATUS_AKTIF);
			$data['kepemilikan_kendaraan'] = $this->referensi_model->list_ref(KEPEMILIKAN_KENDARAAN);
			$data['kategori_jasa_transportasi'] = $this->referensi_model->list_ref(KATEGORI_JASA_TRANSPORTASI);
			$data['form_action'] = site_url("tawa/update/$id/$p/$o");
		}
		else
		{
			$data['usaha'] = null;
			$data['sumber_modal'] = $this->referensi_model->list_ref(SUMBER_MODAL);
			$data['area'] = $this->referensi_model->list_ref(AREA_LAYANAN);
			$data['jenis_usaha'] = $this->referensi_model->list_ref(JENIS_USAHA);
			$data['kelompok_usaha'] = $this->referensi_model->list_ref(KELOMPOK_USAHA);
			$data['kepemilikan_tempat_usaha'] = $this->referensi_model->list_ref(KEPEMILIKAN_TEMPAT_USAHA);
			$data['status'] = $this->referensi_model->list_ref(STATUS_AKTIF);
			$data['kepemilikan_kendaraan'] = $this->referensi_model->list_ref(KEPEMILIKAN_KENDARAAN);
			$data['kategori_jasa_transportasi'] = $this->referensi_model->list_ref(KATEGORI_JASA_TRANSPORTASI);
			$data['form_action'] = site_url("tawa/insert");
		}
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('tawa/form', $data);
	}

	public function search($gallery='')
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		if ($gallery != '')
		{
			redirect("tawa/layanan/$gallery");
		}
		else
		{
			redirect('tawa');
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
			redirect("tawa/layanan/$gallery");
		}
		else
		{
			redirect('tawa');
		}
	}

	public function insert()
	{
		$this->tawa_model->insert();
		redirect('tawa');
	}

	public function update($id='', $p=1, $o=0)
	{
		$this->tawa_model->update($id);
		redirect("tawa/index/$p/$o");
	}

	public function delete($p=1, $o=0, $id='')
	{
		$this->redirect_hak_akses('h', "tawa/index/$p/$o");
		$this->tawa_model->delete_gallery($id);
		redirect("tawa/index/$p/$o");
	}

	public function delete_all($p=1, $o=0)
	{
		$this->redirect_hak_akses('h', "tawa/index/$p/$o");
		$_SESSION['success'] = 1;
		$this->tawa_model->delete_all_gallery();
		redirect("tawa/index/$p/$o");
	}

	public function toko_lock($id='', $gallery='')
	{
		$this->tawa_model->toko_lock($id, 1);
		if ($gallery != '')
			redirect("tawa/layanan/$gallery/$p");
		else
			redirect("tawa/index/$p/$o");
	}

	public function toko_unlock($id='', $gallery='')
	{
		$this->tawa_model->toko_lock($id, 2);
		if ($gallery != '')
			redirect("tawa/layanan/$gallery/$p");
		else
			redirect("tawa/index/$p/$o");
	}

	public function slider_on($id='', $gallery='')
	{
		$this->tawa_model->toko_slider($id, 1);
		if ($gallery != '')
			redirect("tawa/layanan/$gallery/$p");
		else
			redirect("tawa/index/$p/$o");
	}

	public function slider_off($id='', $gallery='')
	{
		$this->tawa_model->gallery_slider($id,0);
		if ($gallery != '')
			redirect("tawa/layanan/$gallery/$p");
		else
			redirect("tawa/index/$p/$o");
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

		$data['paging'] = $this->tawa_model->paging2($gal, $p);
		$data['layanan_data'] = $this->tawa_model->list_layanan($gal, $o, $data['paging']->offset, $data['paging']->per_page);
		$data['gallery'] = $gal;
		$data['sub'] = $this->tawa_model->get_usaha($gal);
		$data['keyword'] = $this->tawa_model->autocomplete();

		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('tawa/table_layanan', $data);
	}

	public function form_layanan($gallery=0, $id=0)
	{
		if ($id)
		{
			$data['gallery'] = $this->tawa_model->get_usaha($id);
			$data['sebutan_biaya'] = $this->referensi_model->list_ref(SEBUTAN_BIAYA);
			$data['sebutan_ukuran'] = $this->referensi_model->list_ref(SEBUTAN_UKURAN);
			$data['jenis_kendaraan'] = $this->referensi_model->list_ref(JENIS_KENDARAAN);
			$data['bahan_bakar'] = $this->referensi_model->list_ref(BAHAN_BAKAR);
			$data['area'] = $this->referensi_model->list_ref(AREA_LAYANAN);
			$data['form_action'] = site_url("tawa/update_layanan/$gallery/$id");
		}
		else
		{
			$data['gallery'] = null;
			$data['sebutan_biaya'] = $this->referensi_model->list_ref(SEBUTAN_BIAYA);
			$data['sebutan_ukuran'] = $this->referensi_model->list_ref(SEBUTAN_UKURAN);
			$data['jenis_kendaraan'] = $this->referensi_model->list_ref(JENIS_KENDARAAN);
			$data['bahan_bakar'] = $this->referensi_model->list_ref(BAHAN_BAKAR);
			$data['area'] = $this->referensi_model->list_ref(AREA_LAYANAN);
			$data['form_action'] = site_url("tawa/insert_layanan/$gallery");
		}
		
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };
		$data['album']=$gallery;

		$this->render('tawa/form_layanan', $data);
	}

	public function insert_layanan($gallery='')
	{
		$this->tawa_model->insert_layanan($gallery);
		redirect("tawa/layanan/$gallery");
	}

	public function update_layanan($gallery='', $id='')
	{
		$this->tawa_model->update_layanan($id);
		redirect("tawa/layanan/$gallery");
	}

	public function delete_layanan($gallery='', $id='')
	{
		$this->redirect_hak_akses('h', "tawa/layanan/$gallery");
		$this->tawa_model->delete($id);
		redirect("tawa/layanan/$gallery");
	}

	public function delete_all_layanan($gallery='')
	{
		$this->redirect_hak_akses('h', "tawa/layanan/$gallery");
		$_SESSION['success']=1;
		$this->tawa_model->delete_all();
		redirect("tawa/layanan/$gallery");
	}

	public function toko_lock_layanan($gallery='', $id='')
	{
		$this->tawa_model->toko_lock($id, 1);
		redirect("tawa/layanan/$gallery");
	}

	public function toko_unlock_layanan($gallery='', $id='')
	{
		$this->tawa_model->toko_lock($id, 2);
		redirect("tawa/layanan/$gallery");
	}

	public function urut($id, $arah = 0, $gallery='')
	{
		$this->tawa_model->urut($id, $arah, $gallery);
		if ($gallery != '')
			redirect("tawa/layanan/$gallery");
		else
			redirect("tawa/index");
	}
	
	public function lokasi_maps($id)
	{

		$data = $this->tawa_model->list_data($id);

		if (is_null($data)) show_404();

		// Update lokasi maps
		if ($request = $this->input->post())
		{
			$this->tawa_model->update_map($id, $request);

			$this->session->success = 1;

			redirect('tawa');
		}
		$data['toko'] = $this->tawa_model->get_usaha($id);
		$data['desa'] = $this->config_model->get_data($id);

		$this->render('tawa/peta',$data);
	}
	
	public function update_map($id = '')
	{
		$this->tawa_model->update_map($id);
		redirect("tawa");
	}
}

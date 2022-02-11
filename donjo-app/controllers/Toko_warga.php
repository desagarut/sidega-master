<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Toko_warga extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('referensi_model');
		$this->load->model('toko_warga_model');
		$this->load->model('config_model');
		$this->load->model('wilayah_model');
		$this->load->model('pamong_model');
		$this->load->model('plan_lokasi_model');
		$this->load->model('plan_area_model');
		$this->load->model('plan_garis_model');
		$this->modul_ini = 400;
		$this->sub_modul_ini = 401;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('toko_warga');
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

		$data['paging'] = $this->toko_warga_model->paging($p,$o);
		$data['main'] = $this->toko_warga_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };
		$data['keyword'] = $this->toko_warga_model->autocomplete();

		$this->render('toko_warga/table', $data);
	}

	public function form($p=1, $o=0, $id='')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['toko'] = $this->toko_warga_model->get_toko($id);
			$data['sumber_modal'] = $this->referensi_model->list_ref(SUMBER_MODAL);
			$data['area_usaha'] = $this->referensi_model->list_ref(AREA_USAHA);
			$data['kelompok_usaha_perdagangan'] = $this->referensi_model->list_ref(KELOMPOK_USAHA_PERDAGANGAN);
			$data['sarana_berdagang'] = $this->referensi_model->list_ref(SARANA_BERDAGANG);
			$data['kategori_toko'] = $this->referensi_model->list_ref(KATEGORI_TOKO);
			$data['status_toko'] = $this->referensi_model->list_ref(STATUS_TOKO);
			$data['kepemilikan_tempat_usaha'] = $this->referensi_model->list_ref(KEPEMILIKAN_TEMPAT_USAHA);
			$data['form_action'] = site_url("toko_warga/update/$id/$p/$o");
		}
		else
		{
			$data['toko'] = null;
			$data['sumber_modal'] = $this->referensi_model->list_ref(SUMBER_MODAL);
			$data['area_usaha'] = $this->referensi_model->list_ref(AREA_USAHA);
			$data['kelompok_usaha_perdagangan'] = $this->referensi_model->list_ref(KELOMPOK_USAHA_PERDAGANGAN);
			$data['sarana_berdagang'] = $this->referensi_model->list_ref(SARANA_BERDAGANG);
			$data['kategori_toko'] = $this->referensi_model->list_ref(KATEGORI_TOKO);
			$data['status_toko'] = $this->referensi_model->list_ref(STATUS_TOKO);
			$data['kepemilikan_tempat_usaha'] = $this->referensi_model->list_ref(KEPEMILIKAN_TEMPAT_USAHA);
			$data['form_action'] = site_url("toko_warga/insert");
		}
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('toko_warga/form', $data);
	}

	public function search($gallery='')
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		if ($gallery != '')
		{
			redirect("toko_warga/produk/$gallery");
		}
		else
		{
			redirect('toko_warga');
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
			redirect("toko_warga/produk/$gallery");
		}
		else
		{
			redirect('toko_warga');
		}
	}

	public function insert()
	{
		$this->toko_warga_model->insert();
		redirect('toko_warga');
	}

	public function update($id='', $p=1, $o=0)
	{
		$this->toko_warga_model->update($id);
		redirect("toko_warga/index/$p/$o");
	}

	public function delete($p=1, $o=0, $id='')
	{
		$this->redirect_hak_akses('h', "toko_warga/index/$p/$o");
		$this->toko_warga_model->delete_gallery($id);
		redirect("toko_warga/index/$p/$o");
	}

	public function delete_all($p=1, $o=0)
	{
		$this->redirect_hak_akses('h', "toko_warga/index/$p/$o");
		$_SESSION['success'] = 1;
		$this->toko_warga_model->delete_all_gallery();
		redirect("toko_warga/index/$p/$o");
	}

	public function toko_lock($id='', $gallery='')
	{
		$this->toko_warga_model->toko_lock($id, 1);
		if ($gallery != '')
			redirect("toko_warga/produk/$gallery/$p");
		else
			redirect("toko_warga/index/$p/$o");
	}

	public function toko_unlock($id='', $gallery='')
	{
		$this->toko_warga_model->toko_lock($id, 2);
		if ($gallery != '')
			redirect("toko_warga/produk/$gallery/$p");
		else
			redirect("toko_warga/index/$p/$o");
	}

	public function slider_on($id='', $gallery='')
	{
		$this->toko_warga_model->toko_slider($id, 1);
		if ($gallery != '')
			redirect("toko_warga/produk/$gallery/$p");
		else
			redirect("toko_warga/index/$p/$o");
	}

	public function slider_off($id='', $gallery='')
	{
		$this->toko_warga_model->gallery_slider($id,0);
		if ($gallery != '')
			redirect("toko_warga/produk/$gallery/$p");
		else
			redirect("toko_warga/index/$p/$o");
	}
	
	public function produk($gal=0, $p=1, $o=0)
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

		$data['paging'] = $this->toko_warga_model->paging2($gal, $p);
		$data['produk_data'] = $this->toko_warga_model->list_produk($gal, $o, $data['paging']->offset, $data['paging']->per_page);
		$data['gallery'] = $gal;
		$data['sub'] = $this->toko_warga_model->get_toko($gal);
		$data['keyword'] = $this->toko_warga_model->autocomplete();

		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('toko_warga/table_produk', $data);
	}

	public function form_produk($gallery=0, $id=0)
	{
		if ($id)
		{
			$data['gallery'] = $this->toko_warga_model->get_toko($id);
			$data['sebutan_biaya'] = $this->referensi_model->list_ref(SEBUTAN_BIAYA);
			$data['sebutan_ukuran'] = $this->referensi_model->list_ref(SEBUTAN_UKURAN);
			$data['form_action'] = site_url("toko_warga/update_produk/$gallery/$id");
		}
		else
		{
			$data['gallery'] = null;
			$data['sebutan_biaya'] = $this->referensi_model->list_ref(SEBUTAN_BIAYA);
			$data['sebutan_ukuran'] = $this->referensi_model->list_ref(SEBUTAN_UKURAN);
			$data['form_action'] = site_url("toko_warga/insert_produk/$gallery");
		}
		
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };
		$data['album']=$gallery;

		$this->render('toko_warga/form_produk', $data);
	}

	public function insert_produk($gallery='')
	{
		$this->toko_warga_model->insert_produk($gallery);
		redirect("toko_warga/produk/$gallery");
	}

	public function update_produk($gallery='', $id='')
	{
		$this->toko_warga_model->update_produk($id);
		redirect("toko_warga/produk/$gallery");
	}

	public function delete_produk($gallery='', $id='')
	{
		$this->redirect_hak_akses('h', "toko_warga/produk/$gallery");
		$this->toko_warga_model->delete($id);
		redirect("toko_warga/produk/$gallery");
	}

	public function delete_all_produk($gallery='')
	{
		$this->redirect_hak_akses('h', "toko_warga/produk/$gallery");
		$_SESSION['success']=1;
		$this->toko_warga_model->delete_all();
		redirect("toko_warga/produk/$gallery");
	}

	public function toko_lock_produk($gallery='', $id='')
	{
		$this->toko_warga_model->toko_lock($id, 1);
		redirect("toko_warga/produk/$gallery");
	}

	public function toko_unlock_produk($gallery='', $id='')
	{
		$this->toko_warga_model->toko_lock($id, 2);
		redirect("toko_warga/produk/$gallery");
	}

	public function urut($id, $arah = 0, $gallery='')
	{
		$this->toko_warga_model->urut($id, $arah, $gallery);
		if ($gallery != '')
			redirect("toko_warga/produk/$gallery");
		else
			redirect("toko_warga/index");
	}
	
	public function lokasi_maps($id)
	{

		$data = $this->toko_warga_model->list_data($id);

		if (is_null($data)) show_404();

		// Update lokasi maps
		if ($request = $this->input->post())
		{
			$this->toko_warga_model->update_map($id, $request);

			$this->session->success = 1;

			redirect('toko_warga');
		}
		$data['toko'] = $this->toko_warga_model->get_toko($id);
		$data['desa'] = $this->config_model->get_data($id);

		$this->render('toko_warga/peta',$data);
	}
	
	public function update_map($id = '')
	{
		$this->toko_warga_model->update_map($id);
		redirect("toko_warga");
	}
}

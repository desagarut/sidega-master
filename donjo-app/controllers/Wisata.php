<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Wisata extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('referensi_model');
		$this->load->model('wisata_model');
		$this->load->model('config_model');
		$this->load->model('wilayah_model');
		$this->load->model('pamong_model');
		$this->load->model('plan_lokasi_model');
		$this->load->model('plan_area_model');
		$this->load->model('plan_garis_model');
		$this->modul_ini = 400;
		$this->sub_modul_ini = 404;
	}

	public function clear()
	{
		unset($_SESSION['cari']);
		unset($_SESSION['filter']);
		redirect('wisata');
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

		$data['paging'] = $this->wisata_model->paging($p,$o);
		$data['main'] = $this->wisata_model->list_data($o, $data['paging']->offset, $data['paging']->per_page);
		
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };
		$data['keyword'] = $this->wisata_model->autocomplete();

		$this->render('wisata/table', $data);
	}

	public function form($p=1, $o=0, $id='')
	{
		$data['p'] = $p;
		$data['o'] = $o;

		if ($id)
		{
			$data['wisata'] = $this->wisata_model->get_wisata($id);
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_MODAL_WISATA);
			$data['jenis_wisata'] = $this->referensi_model->list_ref(JENIS_WISATA);
			$data['status'] = $this->referensi_model->list_ref(STATUS_AKTIF);
			$data['kepemilikan_tempat_wisata'] = $this->referensi_model->list_ref(KEPEMILIKAN_TEMPAT_WISATA);
			$data['form_action'] = site_url("wisata/update/$id/$p/$o");
		}
		else
		{
			$data['wisata'] = null;
			$data['sumber_dana'] = $this->referensi_model->list_ref(SUMBER_MODAL_WISATA);
			$data['jenis_wisata'] = $this->referensi_model->list_ref(JENIS_WISATA);
			$data['status'] = $this->referensi_model->list_ref(STATUS_AKTIF);
			$data['kepemilikan_tempat_wisata'] = $this->referensi_model->list_ref(KEPEMILIKAN_TEMPAT_WISATA);
			$data['form_action'] = site_url("wisata/insert");
		}
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('wisata/form', $data);
	}

	public function search($gallery='')
	{
		$cari = $this->input->post('cari');
		if ($cari != '')
			$_SESSION['cari'] = $cari;
		else unset($_SESSION['cari']);
		if ($gallery != '')
		{
			redirect("wisata/fasilitas/$gallery");
		}
		else
		{
			redirect('wisata');
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
			redirect("wisata/fasilitas/$gallery");
		}
		else
		{
			redirect('wisata');
		}
	}

	public function insert()
	{
		$this->wisata_model->insert();
		redirect('wisata');
	}

	public function update($id='', $p=1, $o=0)
	{
		$this->wisata_model->update($id);
		redirect("wisata/index/$p/$o");
	}

	public function delete($p=1, $o=0, $id='')
	{
		$this->redirect_hak_akses('h', "wisata/index/$p/$o");
		$this->wisata_model->delete_gallery($id);
		redirect("wisata/index/$p/$o");
	}

	public function delete_all($p=1, $o=0)
	{
		$this->redirect_hak_akses('h', "wisata/index/$p/$o");
		$_SESSION['success'] = 1;
		$this->wisata_model->delete_all_gallery();
		redirect("wisata/index/$p/$o");
	}

	public function wisata_lock($id='', $gallery='')
	{
		$this->wisata_model->wisata_lock($id, 1);
		if ($gallery != '')
			redirect("wisata/fasilitas/$gallery/$p");
		else
			redirect("wisata/index/$p/$o");
	}

	public function wisata_unlock($id='', $gallery='')
	{
		$this->wisata_model->wisata_lock($id, 2);
		if ($gallery != '')
			redirect("wisata/fasilitas/$gallery/$p");
		else
			redirect("wisata/index/$p/$o");
	}

	public function slider_on($id='', $gallery='')
	{
		$this->wisata_model->wisata_slider($id, 1);
		if ($gallery != '')
			redirect("wisata/fasilitas/$gallery/$p");
		else
			redirect("wisata/index/$p/$o");
	}

	public function slider_off($id='', $gallery='')
	{
		$this->wisata_model->gallery_slider($id,0);
		if ($gallery != '')
			redirect("wisata/fasilitas/$gallery/$p");
		else
			redirect("wisata/index/$p/$o");
	}
	
	public function fasilitas($gal=0, $p=1, $o=0)
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

		$data['paging'] = $this->wisata_model->paging2($gal, $p);
		$data['fasilitas_data'] = $this->wisata_model->list_fasilitas($gal, $o, $data['paging']->offset, $data['paging']->per_page);
		$data['gallery'] = $gal;
		$data['sub'] = $this->wisata_model->get_wisata($gal);
		$data['keyword'] = $this->wisata_model->autocomplete();

		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('wisata/table_fasilitas', $data);
	}

	public function form_fasilitas($gallery=0, $id=0)
	{
		if ($id)
		{
			$data['wisata'] = $this->wisata_model->get_wisata($id);
			$data['sebutan_biaya'] = $this->referensi_model->list_ref(SEBUTAN_BIAYA);
			$data['sebutan_ukuran'] = $this->referensi_model->list_ref(SEBUTAN_UKURAN);
			$data['form_action'] = site_url("wisata/update_fasilitas/$gallery/$id");
		}
		else
		{
			$data['wisata'] = null;
			$data['sebutan_biaya'] = $this->referensi_model->list_ref(SEBUTAN_BIAYA);
			$data['sebutan_ukuran'] = $this->referensi_model->list_ref(SEBUTAN_UKURAN);
			$data['form_action'] = site_url("wisata/insert_fasilitas/$gallery");
		}
		
		$data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };
		$data['album']=$gallery;

		$this->render('wisata/form_fasilitas', $data);
	}

	public function insert_fasilitas($gallery='')
	{
		$this->wisata_model->insert_fasilitas($gallery);
		redirect("wisata/fasilitas/$gallery");
	}

	public function update_fasilitas($gallery='', $id='')
	{
		$this->wisata_model->update_fasilitas($id);
		redirect("wisata/fasilitas/$gallery");
	}

	public function delete_fasilitas($gallery='', $id='')
	{
		$this->redirect_hak_akses('h', "wisata/fasilitas/$gallery");
		$this->wisata_model->delete($id);
		redirect("wisata/fasilitas/$gallery");
	}

	public function delete_all_fasilitas($gallery='')
	{
		$this->redirect_hak_akses('h', "wisata/fasilitas/$gallery");
		$_SESSION['success']=1;
		$this->wisata_model->delete_all();
		redirect("wisata/fasilitas/$gallery");
	}

	public function wisata_lock_fasilitas($gallery='', $id='')
	{
		$this->wisata_model->wisata_lock($id, 1);
		redirect("wisata/fasilitas/$gallery");
	}

	public function wisata_unlock_fasilitas($gallery='', $id='')
	{
		$this->wisata_model->wisata_lock($id, 2);
		redirect("wisata/fasilitas/$gallery");
	}

	public function urut($id, $arah = 0, $gallery='')
	{
		$this->wisata_model->urut($id, $arah, $gallery);
		if ($gallery != '')
			redirect("wisata/fasilitas/$gallery");
		else
			redirect("wisata/index");
	}
	
	public function lokasi_maps($id)
	{

		$data = $this->wisata_model->list_data($id);

		if (is_null($data)) show_404();

		// Update lokasi maps
		if ($request = $this->input->post())
		{
			$this->wisata_model->update_map($id, $request);

			$this->session->success = 1;

			redirect('wisata');
		}
		$data['wisata'] = $this->wisata_model->get_wisata($id);
		$data['desa'] = $this->config_model->get_data($id);

		$this->render('wisata/peta',$data);
	}
	
	public function update_map($id = '')
	{
		$this->wisata_model->update_map($id);
		redirect("wisata");
	}
}

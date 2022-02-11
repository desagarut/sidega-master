<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Sppt_pbb extends Admin_Controller {

	private $set_page;
	private $list_session;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('config_model');
		$this->load->model('data_persil_model');
		$this->load->model('sppt_pbb_model');
		$this->load->model('penduduk_model');
		$this->load->model('referensi_model');
		$this->modul_ini = 316;
		$this->set_page = ['20', '50', '100'];
		$this->list_session = ['cari'];
	}

	public function clear()
	{
		$this->session->unset_userdata($this->list_session);
		$this->session->per_page = $this->set_page[0];
		redirect('sppt_pbb');
	}

	// TODO: fix
	public function autocomplete()
	{
		$data = $this->sppt_pbb_model->autocomplete($this->input->post('cari'));
		echo json_encode($data);
	}

	public function search(){
		$this->session->cari = $this->input->post('cari') ?: NULL;
		redirect('sppt_pbb/pbb_data');
	}

	public function index($page=1, $o=0)
	{
		$this->tab_ini = 1;
		$this->set_minsidebar(1);

		$data['func'] = 'index';
        $this->load->model("sppt_pbb_model");
        $data['data'] = $this->sppt_pbb_model->fetchData();
        $data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('sppt_pbb/rekapitulasi', $data);
	}
	
	public function data_tagihan()
	{
		$this->tab_ini = 3;
		$this->set_minsidebar(1);

		$data['func'] = 'data_tagihan';
        $this->load->model("sppt_pbb_model");
        $data['data'] = $this->sppt_pbb_model->fetchData();
        $data['rupiah'] = function($angka){
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        };

		$this->render('sppt_pbb/data_tagihan', $data);
	}
	
	public function pbb_data($page=1, $o=0)
	{
		$this->tab_ini = 2;
		$this->set_minsidebar(1);

		$data['cari'] = isset($_SESSION['cari']) ? $_SESSION['cari'] : '';
		$_SESSION['per_page'] = $_POST['per_page'] ?: null;
		$data['per_page'] = $_SESSION['per_page'];

		$data['func'] = 'index';
		$data['set_page'] = $this->set_page;
		$data['paging']  = $this->sppt_pbb_model->paging_pbb($page);
		$data['keyword'] = $this->data_persil_model->autocomplete();
		$data["desa"] = $this->config_model->get_data();
		$data["pbb_data"] = $this->sppt_pbb_model->list_pbb($data['paging']->offset, $data['paging']->per_page);
		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas();

		$this->render('sppt_pbb/pbb_data', $data);
	}


	public function mutasi($id_pbb, $id_persil)
	{

		$data = array();
		$data['pbb_data'] = $this->sppt_pbb_model->get_pbb($id_pbb);
		$data['pemilik'] = $this->sppt_pbb_model->get_pemilik($id_pbb);
		$data['mutasi'] = $this->sppt_pbb_model->get_list_mutasi($id_pbb, $id_persil);
		$data['persil'] = $this->data_persil_model->get_persil($id_persil);
		if (empty($data['pbb_data'])) show_404();

		$this->render('sppt_pbb/mutasi_persil', $data);
	}

	public function create($mode=0, $id=0)
	{	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Tanah', 'required');

		$this->set_minsidebar(1);		$this->tab_ini = empty($mode) ? 10 : 12;

		$post = $this->input->post();
		$data = array();
		$data["mode"] = $mode;
		$data["penduduk"] = $this->sppt_pbb_model->list_penduduk();
		if ($mode === 'edit')
		{
			$data['pbb_data'] = $this->sppt_pbb_model->get_pbb($id);
			$this->ubah_pemilik($id, $data, $post);
		}
		else
		{
			switch ($post['kategori_warga'])
			{
				case '1':
					# Pemilik desa
					if (!empty($post['nik']))
					{
						$data['pemilik'] = $this->sppt_pbb_model->get_penduduk($post['nik'], $nik=true);
					}
					break;
				case '2':
					# Pemilik luar desa
					$data['pbb_data']['kategori_warga'] = 2;
					break;
			}
		}
		//$this->load->view('sppt_pbb/create', $data);
		$this->render('sppt_pbb/create', $data);
	}

	public function pbb_daftar_alamat_tagih($page=1, $o=0)
	{
		$this->tab_ini = 2;
		$this->set_minsidebar(1);

		$data['cari'] = isset($_SESSION['cari']) ? $_SESSION['cari'] : '';
		$_SESSION['per_page'] = $_POST['per_page'] ?: null;
		$data['per_page'] = $_SESSION['per_page'];

		$data['func'] = 'index';
		$data['set_page'] = $this->set_page;
		$data['paging']  = $this->sppt_pbb_model->paging_pbb($page);
		$data['keyword'] = $this->data_persil_model->autocomplete();
		$data["desa"] = $this->config_model->get_data();
		$data["pbb_data_tagih"] = $this->sppt_pbb_model->list_pbb_tagih($data['paging']->offset, $data['paging']->per_page);
		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas();

		$this->render('sppt_pbb/pbb_daftar_alamat_tagih', $data);
	}


	public function pbb_daftar_alamat_tagih_tambah($mode=0, $id=0)
	{	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Tanah', 'required');

		$this->tab_ini = 2;
		$this->set_minsidebar(1);		

		$post = $this->input->post();
		$data = array();
		$data["mode"] = $mode;
		$data["penduduk"] = $this->sppt_pbb_model->list_penduduk();
		if ($mode === 'edit')
		{
			$data['pbb_data_tagih'] = $this->sppt_pbb_model->get_pbb_data_tagih($id);
			$this->ubah_kategori_warga($id, $data, $post);
		}
		else
		{
			switch ($post['kategori_warga'])
			{
				case '1':
					# Pemilik desa
					if (!empty($post['nik']))
					{
						$data['tertagih'] = $this->sppt_pbb_model->get_penduduk($post['nik'], $nik=true);
					}
					break;
				case '2':
					# Pemilik luar desa
					$data['pbb_data_tagih']['kategori_warga'] = 2;
					break;
			}
		}
		//$this->load->view('sppt_pbb/create', $data);
		$this->render('sppt_pbb/pbb_daftar_alamat_tagih_tambah', $data);
	}

	public function pbb_daftar_alamat_tagih_simpan($page=1)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pbb_data_tagih','Nomor Handphone','required|trim|numeric');
		$this->form_validation->set_rules('pbb_data_tagih', 'Username', 'callback_cek_no_hp');

		if ($this->form_validation->run() != false)
		{
			$id_pbb = $this->sppt_pbb_model->pbb_daftar_alamat_tagih_simpan();
			if ($this->input->post('id')) redirect("pbb_daftar_alamat_tagih");
			else redirect("sppt_pbb/pbb_daftar_alamat_tagih_rinci_tambah/$id_pbb");
		}
		else
		{
			$_SESSION["success"] = -1;
			$_SESSION["error_msg"] = trim(strip_tags(validation_errors()));
			$kategori_warga = $this->input->post('kategori_warga');
			$id	= $this->input->post('id');
			if ($kategori_warga == 1)
			{
				if ($id)
					redirect("sppt_pbb/pbb_daftar_alamat_tagih_tambah/edit/".$id);
				else
					redirect("sppt_pbb/pbb_daftar_alamat_tagih_tambah");
			}
			else
			{
				if ($id)
					redirect("sppt_pbb/pbb_daftar_alamat_tagih_tambah/edit/".$id);
				else
					redirect("sppt_pbb/pbb_daftar_alamat_tagih_tambah");
			}
		}
	}
	
	public function pbb_daftar_alamat_tagih_rinci($id)
	{
		$this->tab_ini = 2;
		$this->set_minsidebar(1);
		
		$data = array();
		$data['pbb_data_tagih'] = $this->sppt_pbb_model->get_pbb($id);
		$data['pemilik'] = $this->sppt_pbb_model->get_pemilik($id);
		$data['persil'] = $this->sppt_pbb_model->get_list_persil($id);
		$this->render('sppt_pbb/pbb_daftar_alamat_tagih_rinci', $data);
	}

	public function create_tagihan($mode=0, $id=0)
	{	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Tanah', 'required');

		$this->set_minsidebar(1);		$this->tab_ini = empty($mode) ? 10 : 12;

		$post = $this->input->post();
		$data = array();
		$data["mode"] = $mode;
		$data["penduduk"] = $this->sppt_pbb_model->list_penduduk();
		if ($mode === 'edit')
		{
			$data['pbb_data'] = $this->sppt_pbb_model->get_pbb($id);
			$this->ubah_pemilik($id, $data, $post);
		}
		else
		{
			switch ($post['kategori_warga'])
			{
				case '1':
					# Pemilik desa
					if (!empty($post['nik']))
					{
						$data['pemilik'] = $this->sppt_pbb_model->get_penduduk($post['nik'], $nik=true);
					}
					break;
				case '2':
					# Pemilik luar desa
					$data['pbb_data']['kategori_warga'] = 2;
					break;
			}
		}
		//$this->load->view('sppt_pbb/create', $data);
		$this->render('sppt_pbb/create_tagihan', $data);
	}
	
	

	private function ubah_pemilik($id, &$data, $post)
	{
		$kategori_warga_baru = $post['kategori_warga'] ?: 0;

		switch ($kategori_warga_baru)
		{
			case '0':
				// Buka form ubah pertama kali
				if ($data['pbb_data_tagih']['kategori_warga'] == 1)
				{
					$data['pemilik'] = $this->sppt_pbb_model->get_pemilik($id);
				}
				break;
			case '1':
				// Ubah atau ambil pemilik desa
				$data['pemilik'] = $this->sppt_pbb_model->get_pemilik($id);
				if ($post['nik'] and $$data['pemilik']['nik'] != $post['nik'])
				{
					$data['pemilik'] = $this->sppt_pbb_model->get_penduduk($post['nik'], $nik=true);
				}
				$data['pbb_data']['kategori_warga'] = $kategori_warga_baru;
				break;
			case '2':
				// Ubah pemilik luar
				$data['pbb_data']['kategori_warga'] = $kategori_warga_baru;
				break;
		}
	}

	public function simpan_pbb($page=1)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pbb_data','Nomor SPPT PBB','required|trim|numeric');
		$this->form_validation->set_rules('pbb_data', 'Username', 'callback_cek_nomor');

		if ($this->form_validation->run() != false)
		{
			$id_pbb = $this->sppt_pbb_model->simpan_pbb();
			if ($this->input->post('id')) redirect("sppt_pbb");
			else redirect("sppt_pbb/create_mutasi/$id_pbb");
		}
		else
		{
			$_SESSION["success"] = -1;
			$_SESSION["error_msg"] = trim(strip_tags(validation_errors()));
			$kategori_warga = $this->input->post('kategori_warga');
			$id	= $this->input->post('id');
			if ($kategori_warga == 1)
			{
				if ($id)
					redirect("sppt_pbb/create/edit/".$id);
				else
					redirect("sppt_pbb/create");
			}
			else
			{
				if ($id)
					redirect("sppt_pbb/create/edit/".$id);
				else
					redirect("sppt_pbb/create");
			}
		}
	}

	public function pbb_daftar_alamat_tagih_rinci_tambah($id_pbb, $id_persil='', $id_mutasi='')
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Tanah', 'required');

		$this->set_minsidebar(1);
		$this->tab_ini = 2;
		
		if (empty($id_persil)) $id_persil = $this->input->post('id_persil');

		if ($id_persil)
		{
			$data['persil'] = $this->data_persil_model->get_persil($id_persil);
		}
		else
		{
			$data['persil'] = NULL;
		}

		if ($id_mutasi)
		{
			$data['persil'] = $this->sppt_pbb_model->get_persil($id_mutasi);
			$data["mutasi"] = $this->sppt_pbb_model->get_mutasi($id_mutasi);
		}
		$data['pbb_data'] = $this->sppt_pbb_model->get_pbb($id_pbb);
		$data['list_pbb'] = $this->sppt_pbb_model->list_pbb(0, 0, [$id_pbb]);
		$data['pemilik'] = $this->sppt_pbb_model->get_pemilik($id_pbb);

		$data['list_persil'] = $this->data_persil_model->list_persil();
		$data["persil_lokasi"] = $this->data_persil_model->list_dusunrwrt();
		$data["persil_kelas"] = $this->referensi_model->list_by_id('ref_persil_kelas');
		$data["persil_sebab_mutasi"] = $this->referensi_model->list_by_id('ref_persil_mutasi');

		$this->render('sppt_pbb/pbb_daftar_alamat_tagih_rinci', $data);
	}

	public function pbb_simpan_tagih_op($id_pbb, $id_mutasi='')
	{
		$data = $this->sppt_pbb_model->simpan_mutasi($id_pbb, $id_mutasi, $this->input->post());
		if ($data['id_persil'])
			redirect("sppt_pbb/mutasi/$id_pbb/$data[id_persil]");
		else
			redirect("sppt_pbb/rincian/$id_pbb");
	}

	public function pbb_hapus_tagih_op($pbb_data, $id_mutasi)
	{
		$id_persil = $this->db->select('id_persil')
			->where('id', $id_mutasi)
			->get('mutasi_pbb')
			->row()->id_persil;
		$this->db->where('id', $id_mutasi)
			->delete('mutasi_pbb');
		redirect("sppt_pbb/mutasi/$pbb/$id_persil");
	}

	// TODO: gunakan pada waktu validasi C-Desa
	public function cek_nomor($no_hp)
	{
		$id_pbb = $this->input->post('id');
		if ($id_pbb) $this->db->where('id <>', $id_pbb);
		$ada = $this->db
			->where('no_hp', $no_hp)
			->get('pbb_data')->num_rows();

		if ($ada)
		{
			$this->form_validation->set_message('cek_nomor', 'Nomor Objek Pajak SPPT PBB sudah ada');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function cek_no_hp($no_hp)
	{
		$id_pbb = $this->input->post('id');
		if ($id_pbb) $this->db->where('id <>', $id_pbb);
		$ada = $this->db
			->where('no_hp', $no_hp)
			->get('pbb_data_tagih')->num_rows();

		if ($ada)
		{
			$this->form_validation->set_message('cek_no_hp', 'Nomor HP Sudah terdaftar, Gunakan nomor Lain');
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
		$this->tab_ini = 15;
		$nav['act'] = 7;
		$this->render('sppt_pbb/panduan');
	}

	public function hapus($id)
	{
		$this->redirect_hak_akses('h', "pbb_data");
		$this->sppt_pbb_model->hapus_pbb($id);
		redirect("sppt_pbb");
	}

	public function import()
	{
		$data['form_action'] = site_url("sppt_pbb/import_proses");
		$this->load->view('sppt_pbb/import', $data);
	}

	public function import_proses()
	{
		$this->data_persil_model->impor_persil();
		redirect("sppt_pbb");
	}

	public function cetak($o=0)
	{
		$data['data_pbb'] = $this->sppt_pbb_model->list_pbb();
		$this->load->view('sppt_pbb/pbb_cetak', $data);
	}

	public function unduh($o=0)
	{
		$data['data_pbb'] = $this->sppt_pbb_model->list_pbb();
		$this->load->view('sppt_pbb/pbb_unduh', $data);
	}

	public function form_pbb($id=0)
	{
		$data['desa'] = $this->config_model->get_data();
		$data['pbb_data'] = $this->sppt_pbb_model->get_pbb($id);
		$data['basah'] = $this->sppt_pbb_model->get_cetak_mutasi($id, 'BASAH');
		$data['kering'] = $this->sppt_pbb_model->get_cetak_mutasi($id, 'KERING');
		$this->load->view('sppt_pbb/pbb_form_print', $data);
	}

	public function awal_persil($id_pbb, $id_persil, $hapus=false)
	{
		$this->data_persil_model->awal_persil($id_pbb, $id_persil, $hapus);
		redirect("sppt_pbb/mutasi/$id_pbb/$id_persil");
	}
		
}

?>

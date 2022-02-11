<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Letterc extends Admin_Controller {

	private $set_page;
	private $list_session;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('config_model');
		$this->load->model('data_persil_model');
		$this->load->model('letterc_model');
		$this->load->model('penduduk_model');
		$this->load->model('referensi_model');
		$this->modul_ini = 7;
		$this->set_page = ['20', '50', '100'];
		$this->list_session = ['cari'];
	}

	public function clear()
	{
		$this->session->unset_userdata($this->list_session);
		$this->session->per_page = $this->set_page[0];
		redirect($this->controller);
	}

	// TODO: fix
	public function autocomplete()
	{
		$data = $this->letterc_model->autocomplete($this->input->post('cari'));
		echo json_encode($data);
	}

	public function search(){
		$this->session->cari = $this->input->post('cari') ?: NULL;
		redirect('letterc');
	}

	public function index($page=1, $o=0)
	{
		$this->sub_modul_ini = 12;
		$this->tab_ini = 12;
		$this->set_minsidebar(1);

		$data['cari'] = isset($_SESSION['cari']) ? $_SESSION['cari'] : '';
		$_SESSION['per_page'] = $_POST['per_page'] ?: null;
		$data['per_page'] = $_SESSION['per_page'];

		$data['func'] = 'index';
		$data['set_page'] = $this->set_page;
		$data['paging']  = $this->letterc_model->pagging_letterc($page);
		$data['keyword'] = $this->data_persil_model->autocomplete();
		$data["desa"] = $this->config_model->get_data();
		$data["letterc"] = $this->letterc_model->list_letterc($data['paging']->offset, $data['paging']->per_page);
		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas();

		$this->render('data_persil/letterc', $data);
	}

	public function rincian($id)
	{
		$this->tab_ini = 13;
		$data = array();
		$data['letterc'] = $this->letterc_model->get_letterc($id);
		$data['pemilik'] = $this->letterc_model->get_pemilik($id);
		$data['persil'] = $this->letterc_model->get_list_persil($id);
		$this->render('data_persil/rincian', $data);
	}

	public function mutasi($id_letterc, $id_persil)
	{

		$data = array();
		$data['letterc'] = $this->letterc_model->get_letterc($id_letterc);
		$data['pemilik'] = $this->letterc_model->get_pemilik($id_letterc);
		$data['mutasi'] = $this->letterc_model->get_list_mutasi($id_letterc, $id_persil);
		$data['persil'] = $this->data_persil_model->get_persil($id_persil);
		if (empty($data['letterc'])) show_404();

		$this->render('data_persil/mutasi_persil', $data);
	}

	public function create($mode=0, $id=0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Tanah', 'required');

		$this->set_minsidebar(1);		
		$this->tab_ini = empty($mode) ? 10 : 12;

		$post = $this->input->post();
		$data = array();
		$data["mode"] = $mode;
		$data["penduduk"] = $this->letterc_model->list_penduduk();
		if ($mode === 'edit')
		{
			$data['letterc'] = $this->letterc_model->get_letterc($id);
			$this->ubah_pemilik($id, $data, $post);
		}
		else
		{
			switch ($post['jenis_pemilik'])
			{
				case '1':
					# Pemilik desa
					if (!empty($post['nik']))
					{
						$data['pemilik'] = $this->letterc_model->get_penduduk($post['nik'], $nik=true);
					}
					break;
				case '2':
					# Pemilik luar desa
					$data['letterc']['jenis_pemilik'] = 2;
					break;
			}
		}

		$this->render('data_persil/create', $data);
	}

	private function ubah_pemilik($id, &$data, $post)
	{
		$jenis_pemilik_baru = $post['jenis_pemilik'] ?: 0;

		switch ($jenis_pemilik_baru)
		{
			case '0':
				// Buka form ubah pertama kali
				if ($data['letterc']['jenis_pemilik'] == 1)
				{
					$data['pemilik'] = $this->letterc_model->get_pemilik($id);
				}
				break;
			case '1':
				// Ubah atau ambil pemilik desa
				$data['pemilik'] = $this->letterc_model->get_pemilik($id);
				if ($post['nik'] and $$data['pemilik']['nik'] != $post['nik'])
				{
					$data['pemilik'] = $this->letterc_model->get_penduduk($post['nik'], $nik=true);
				}
				$data['letterc']['jenis_pemilik'] = $jenis_pemilik_baru;
				break;
			case '2':
				// Ubah pemilik luar
				$data['letterc']['jenis_pemilik'] = $jenis_pemilik_baru;
				break;
		}
	}

	public function simpan_letterc($page=1)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('letterc','Nomor Surat LETTER-C','required|trim|numeric');
		$this->form_validation->set_rules('letterc', 'Username', 'callback_cek_nomor');

		if ($this->form_validation->run() != false)
		{
			$id_letterc = $this->letterc_model->simpan_letterc();
			if ($this->input->post('id')) redirect("letterc");
			else redirect("letterc/create_mutasi/$id_letterc");
		}
		else
		{
			$_SESSION["success"] = -1;
			$_SESSION["error_msg"] = trim(strip_tags(validation_errors()));
			$jenis_pemilik = $this->input->post('jenis_pemilik');
			$id	= $this->input->post('id');
			if ($jenis_pemilik == 1)
			{
				if ($id)
					redirect("letterc/create/edit/".$id);
				else
					redirect("letterc/create");
			}
			else
			{
				if ($id)
					redirect("letterc/create/edit/".$id);
				else
					redirect("letterc/create");
			}
		}
	}

	public function create_mutasi($id_letterc, $id_persil='', $id_mutasi='')
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Jenis Tanah', 'required');

		$this->set_minsidebar(1);
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
			$data['persil'] = $this->letterc_model->get_persil($id_mutasi);
			$data["mutasi"] = $this->letterc_model->get_mutasi($id_mutasi);
		}
		$data['letterc'] = $this->letterc_model->get_letterc($id_letterc);
		$data['list_letterc'] = $this->letterc_model->list_letterc(0, 0, [$id_letterc]);
		$data['pemilik'] = $this->letterc_model->get_pemilik($id_letterc);

		$data['list_persil'] = $this->data_persil_model->list_persil();
		$data["persil_lokasi"] = $this->data_persil_model->list_dusunrwrt();
		$data["persil_kelas"] = $this->referensi_model->list_by_id('ref_persil_kelas');
		$data["persil_sebab_mutasi"] = $this->referensi_model->list_by_id('ref_persil_mutasi');

		$this->render('data_persil/create_mutasi', $data);
	}

	public function simpan_mutasi($id_letterc, $id_mutasi='')
	{
		$data = $this->letterc_model->simpan_mutasi($id_letterc, $id_mutasi, $this->input->post());
		if ($data['id_persil'])
			redirect("letterc/mutasi/$id_letterc/$data[id_persil]");
		else
			redirect("letterc/rincian/$id_letterc");
	}

	public function hapus_mutasi($letterc, $id_mutasi)
	{
		$id_persil = $this->db->select('id_persil')
			->where('id', $id_mutasi)
			->get('mutasi_letterc')
			->row()->id_persil;
		$this->db->where('id', $id_mutasi)
			->delete('mutasi_letterc');
		redirect("letterc/mutasi/$letterc/$id_persil");
	}

	// TODO: gunakan pada waktu validasi letterc
	public function cek_nomor($nomor)
	{
		$id_letterc = $this->input->post('id');
		if ($id_letterc) $this->db->where('id <>', $id_letterc);
		$ada = $this->db
			->where('nomor', $nomor)
			->get('letterc')->num_rows();

		if ($ada)
		{
			$this->form_validation->set_message('cek_nomor', 'Nomor Letter-C sudah ada');
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
		$this->render('data_persil/panduan');
	}

	public function hapus($id)
	{
		$this->redirect_hak_akses('h', "letterc");
		$this->letterc_model->hapus_letterc($id);
		redirect("letterc");
	}

	public function import()
	{
		$data['form_action'] = site_url("data_persil/import_proses");
		$this->load->view('data_persil/import', $data);
	}

	public function import_proses()
	{
		$this->data_persil_model->impor_persil();
		redirect("data_persil");
	}

	public function cetak($o=0)
	{
		$data['data_letterc'] = $this->letterc_model->list_letterc();
		$this->load->view('data_persil/letterc_cetak', $data);
	}

	public function unduh($o=0)
	{
		$data['data_letterc'] = $this->letterc_model->list_letterc();
		$this->load->view('data_persil/letterc_unduh', $data);
	}

	public function form_letterc($id=0)
	{
		$data['desa'] = $this->config_model->get_data();
		$data['letterc'] = $this->letterc_model->get_letterc($id);
		$data['basah'] = $this->letterc_model->get_cetak_mutasi($id, 'BASAH');
		$data['kering'] = $this->letterc_model->get_cetak_mutasi($id, 'KERING');
		$this->load->view('data_persil/letterc_form_print', $data);
	}

	public function awal_persil($id_letterc, $id_persil, $hapus=false)
	{
		$this->data_persil_model->awal_persil($id_letterc, $id_persil, $hapus);
		redirect("letterc/mutasi/$id_letterc/$id_persil");
	}
}

?>

<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Data_persil extends Admin_Controller {

	private $set_page;
	private $list_session;

	public function __construct()

	{

		parent::__construct();
		$this->load->model(['config_model', 'data_persil_model', 'letterc_model', 'penduduk_model', 'pamong_model']);
		$this->controller = 'data_persil';
		$this->modul_ini = 7;
		$this->sub_modul_ini = 213;
		$this->set_page = ['20', '50', '100'];
		$this->list_session = ['lokasi', 'tipe', 'kelas', 'dusun', 'rw', 'rt', 'cari'];

	}



	public function clear()

	{

		$this->session->unset_userdata($this->list_session);

		$this->session->per_page = $this->set_page[0];

		redirect('data_persil');

	}



	// TODO: fix

	public function autocomplete()

	{

		$data = $this->data_persil_model->autocomplete($this->input->post('cari'));

		echo json_encode($data);

	}



	public function search(){

		$this->session->cari = $this->input->post('cari') ?: NULL;

		redirect('data_persil');

	}



	public function index($page=1, $o=0)

	{

		$this->set_minsidebar(0);

		$this->tab_ini = 13;



		foreach ($this->list_session as $list)

		{

			if (in_array($list, ['dusun', 'rw', 'rt']))

				$$list = $this->session->$list;

			else

				$data[$list] = $this->session->$list ?: '';

		}



		if (isset($dusun))

		{

			$data['dusun'] = $dusun;

			$data['list_rw'] = $this->data_persil_model->list_rw($dusun);



			if (isset($rw))

			{

				$data['rw'] = $rw;

				$data['list_rt'] = $this->data_persil_model->list_rt($dusun, $rw);



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



		if (isset($data['tipe']))

		{

			$data['list_kelas'] = $this->data_persil_model->list_kelas($data['tipe']);

		}

		else

		{

			$data['list_kelas'] = '';

		}



		$per_page = $this->input->post('per_page');

		if (isset($per_page))

			$this->session->per_page = $per_page;



		$data['func'] = 'index';

		$data['set_page'] = $this->set_page;

		$data["desa"] = $this->config_model->get_data();

		$data['paging']  = $this->data_persil_model->paging($page);

		$data["persil"] = $this->data_persil_model->list_data($data['paging']->offset, $data['paging']->per_page);

		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas();

		$data['keyword'] = $this->data_persil_model->autocomplete();

		$data['list_dusun'] = $this->data_persil_model->list_dusun();



		$this->render('data_persil/persil', $data);

	}



	public function rincian($id=0)

	{

		$this->tab_ini = 13;

		$data = [];

		$data['persil'] = $this->data_persil_model->get_persil($id);

		$data['mutasi'] = $this->data_persil_model->get_list_mutasi($id);

		$this->render('data_persil/rincian_persil', $data);

	}



	public function form($id='', $id_letterc='')

	{

		$this->set_minsidebar(0);

		$this->tab_ini = 13;



		if ($id) $data["persil"] = $this->data_persil_model->get_persil($id);

		if ($id_letterc) $data["id_letterc"] = $id_letterc;

		$data['list_letterc'] = $this->letterc_model->list_letterc();

		$data["persil_lokasi"] = $this->data_persil_model->list_dusunrwrt();

		$data["persil_kelas"] = $this->data_persil_model->list_persil_kelas();

		$this->render('data_persil/form_persil', $data);

	}



	public function simpan_persil($page=1)

	{

		$this->load->helper('form');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('no_persil','Nomor Surat Persil','required|trim|numeric');

		$this->form_validation->set_rules('nomor_urut_bidang','Nomor Urut Bidang','required|trim|numeric');

		$this->form_validation->set_rules('kelas','Kelas Tanah','required|trim|numeric');



		if ($this->form_validation->run() != false)

		{

			$id_persil = $this->data_persil_model->simpan_persil($this->input->post());

			$letterc_awal = $this->input->post('letterc_awal');

			if (!$this->input->post('id_persil') and $letterc_awal)

				redirect("letterc/mutasi/$letterc_awal/$id_persil");

			else

				redirect("data_persil");

		}



		$this->session->success = -1;

		$this->session->error_msg = trim(strip_tags(validation_errors()));

		$id	= $this->input->post('id_persil');

		redirect("data_persil/form/".$id);

	}



	public function hapus($id)

	{

		$this->redirect_hak_akses('h', "data_persil");

		$this->data_persil_model->hapus($id);

		redirect("data_persil/clear");

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



	public function kelasid()

	{

		$data =[];

		$id = $this->input->post('id');

		$kelas = $this->data_persil_model->list_persil_kelas($id);

		foreach ($kelas as $key => $item)

		{

			$data[] = array('id' => $key, 'kode' => $item['kode'], 'ndesc' => $item['ndesc']);

		}

		echo json_encode($data);

	}



	public function filter($filter)

	{

		if ($filter == "dusun") $this->session->unset_userdata(['rw', 'rt']);

		if ($filter == "rw") $this->session->unset_userdata("rt");

		if ($filter == "tipe") $this->session->unset_userdata("kelas");

		if ($filter == "lokasi") $this->session->unset_userdata(["dusun", "rw", "rt"]);



		$value = $this->input->post($filter);

		if ($value != "")

			$this->session->$filter = $value;

		else $this->session->unset_userdata($filter);

		redirect('data_persil');

	}



	public function dialog_cetak($aksi = '')

	{

		$data['aksi'] = $aksi;

		$data['pamong'] = $this->pamong_model->list_data();

		$data['form_action'] = site_url("data_persil/cetak/$aksi");

		$this->load->view('global/ttd_pamong', $data);

	}



	public function cetak($aksi = '')

	{

		$post = $this->input->post();

		$data['aksi'] = $aksi;

		$data['config'] = $this->header['desa'];

		$data['pamong_ttd'] = $this->pamong_model->get_data($post['pamong_ttd']);

		$data['pamong_ketahui'] = $this->pamong_model->get_data($post['pamong_ketahui']);

		$data['desa'] = $this->config_model->get_data();

		$data['persil'] = $this->data_persil_model->list_data();

    	$data['persil_kelas'] = $this->data_persil_model->list_persil_kelas();



		//pengaturan data untuk format cetak/ unduh

		$data['file'] = "Persil";

		$data['isi'] = "data_persil/persil_cetak";

		//colspan tepi, colspan ttd pertama, colspan jarak ke ttd kedua

		$data['letak_ttd'] = ['1', '2', '2'];



		$this->load->view('global/format_cetak', $data);

	}

}



?>


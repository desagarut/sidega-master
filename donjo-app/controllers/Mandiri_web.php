<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mandiri_web extends Mandiri_Controller
{
	private $cek_anjungan;

	public function __construct()
	{
		parent::__construct();
		mandiri_timeout();
		$this->load->model(['web_dokumen_model', 'surat_model', 'penduduk_model', 'keluar_model', 'permohonan_surat_model', 'mailbox_model', 'penduduk_model', 'lapor_model', 'keluarga_model', 'mandiri_model', 'anjungan_model','wilayah_model', 'referensi_model','web_rumah_model']);
		$this->load->helper('download');

		$this->cek_anjungan = $this->anjungan_model->cek_anjungan();
	}

	public function index()
	{
		if (isset($_SESSION['mandiri']) and 1 == $_SESSION['mandiri'])
		{
			redirect('mandiri_web/mandiri/1/1');
		}
		unset($_SESSION['balik_ke']);
		$data['header'] = $this->header;
		//Initialize Session ------------
		if (!isset($_SESSION['mandiri']))
		{
			// Belum ada session variable
			$this->session->set_userdata('mandiri', 0);
			$this->session->set_userdata('mandiri_try', 4);
			$this->session->set_userdata('mandiri_wait', 0);
		}
		$_SESSION['success'] = 0;
		//-------------------------------

		$data['cek_anjungan'] = $this->cek_anjungan;

		$this->load->view('mandiri_login', $data);
	}
	
	public function auth()
	{
		if ($this->session->mandiri_wait != 1)
		{
			$this->mandiri_model->insidega();
		}

		if ($this->session->lg == 1)
		{
			redirect('mandiri_web/ganti_pin');
		}

		if ($this->session->mandiri == 1)
		{
			redirect('mandiri_web/mandiri/1/1');
		}
		else
		{
			redirect('mandiri_web');
		}

	}

	public function logout()
	{
		$this->mandiri_model->logout();
		redirect('mandiri_web');
	}

	public function update_pin($nik = '')
	{
		$this->mandiri_model->update_pin($nik);
		if ($this->session->success == -1)
		{
			redirect($_SERVER['HTTP_REFERER']);
		}
		else redirect('mandiri_web/logout');
	}

	public function ganti_pin()
	{
		if ($this->session->nik)
		{
			$nik = $this->session->nik;
			$data['main'] = $this->mandiri_model->get_penduduk($nik, TRUE);
			$data['header'] = $this->header;
			$data['cek_anjungan'] = $this->cek_anjungan;

			$this->load->view('mandiri_pin', $data);
		}
		else redirect('mandiri_web');
	}

	public function balik_first()
	{
		$this->mandiri_model->logout();
		redirect('first');
	}

	public function mandiri($p=1, $m=0, $kat=1)
	{
		$data = $this->includes;
		$data['p'] = $p;
		$data['menu_surat_mandiri'] = $this->surat_model->list_surat_mandiri();
		$data['m'] = $m;
		$data['kat'] = $kat;

		/* nilai $m
			1 untuk menu profilku/MANDIRI
			2 untuk menu layanan
			3 untuk menu lapor
			4 untuk menu bantuan
			5 untuk menu surat mandiri
			6 untuk menu Profil
			7 untuk menu Dokumen

		*/
		switch ($m)
		{
			case 1:
				$data['list_kelompok'] = $this->penduduk_model->list_kelompok($_SESSION['id']);
				$data['list_dokumen'] = $this->penduduk_model->list_dokumen($_SESSION['id']);
				$data['list_rumah'] = $this->penduduk_model->list_rumah($_SESSION['id']);
				$data['penduduk'] = $this->penduduk_model->get_penduduk($_SESSION['id']);
				$data['program'] = $this->program_bantuan_model->get_peserta_program(1, $data['penduduk']['nik']);
				$data['bantuan_keluarga'] = $this->program_bantuan_model->daftar_bantuan_yang_diterima($_SESSION['kk']);
				$data['bantuan_penduduk'] = $this->program_bantuan_model->daftar_bantuan_yang_diterima($_SESSION['nik']);
				$data['penduduk_map'] = $this->penduduk_model->get_penduduk_map($_SESSION['id']);
				
				$data['main'] = $this->keluarga_model->list_anggota($_SESSION['id']);
				$data['kepala_kk'] = $this->keluarga_model->get_kepala_kk($_SESSION['id']);
				$data['program'] = $this->program_bantuan_model->get_peserta_program(2, $data['kepala_kk']['no_kk']);
				
				$data['desa'] = $this->header['desa'];
				
				break;
			case 21:
				$data['tab'] = 2;
				$data['m'] = 2;
			case 2:
				$data['surat_keluar'] = $this->keluar_model->list_data_perorangan($_SESSION['id']);
				$data['permohonan'] = $this->permohonan_surat_model->list_permohonan_perorangan($_SESSION['id']);
				break;
			case 3:
				$inbox = $this->mailbox_model->get_inbox_user($_SESSION['nik']);
				$outbox = $this->mailbox_model->get_outbox_user($_SESSION['nik']);
				$data['main_list'] = $kat == 1 ? $inbox : $outbox;
				$data['submenu'] = $this->mailbox_model->list_menu();
				$_SESSION['mailbox'] = $kat;
				break;
			case 4:
				$data['bantuan_penduduk'] = $this->program_bantuan_model->daftar_bantuan_yang_diterima($_SESSION['nik']);
				$data['bantuan_keluarga'] = $this->program_bantuan_model->daftar_bantuan_yang_diterima($_SESSION['kk']);
				break;
			case 5:
				$data['list_dokumen'] = $this->penduduk_model->list_dokumen($_SESSION['id']);
				break;
			case 6:
				$data['list_kelompok'] = $this->penduduk_model->list_kelompok($_SESSION['id']);
				$data['list_dokumen'] = $this->penduduk_model->list_dokumen($_SESSION['id']);
				$data['list_rumah'] = $this->penduduk_model->list_rumah($_SESSION['id']);
				$data['penduduk'] = $this->penduduk_model->get_penduduk($_SESSION['id']);
				$data['program'] = $this->program_bantuan_model->get_peserta_program(1, $data['penduduk']['nik']);
				$data['bantuan_keluarga'] = $this->program_bantuan_model->daftar_bantuan_yang_diterima($_SESSION['kk']);
				$data['bantuan_penduduk'] = $this->program_bantuan_model->daftar_bantuan_yang_diterima($_SESSION['nik']);
				$data['penduduk_map'] = $this->penduduk_model->get_penduduk_map($_SESSION['id']);
				
				$data['main'] = $this->keluarga_model->list_anggota($_SESSION['id']);
				$data['kepala_kk'] = $this->keluarga_model->get_kepala_kk($_SESSION['id']);
				$data['program'] = $this->program_bantuan_model->get_peserta_program(2, $data['kepala_kk']['no_kk']);
				$data['menu_dokumen_mandiri'] = $this->lapor_model->get_surat_ref_all();

				
				$data['desa'] = $this->header['desa'];
				
				break;
				
			default:
				break;
		}

		$data['desa'] = $this->header;
		$data['penduduk'] = $this->penduduk_model->get_penduduk($_SESSION['id']);
		$this->load->view('web/mandiri/layout.mandiri.php', $data);
	}

	public function mandiri_surat($id_permohonan='')
	{
		$data = $this->includes;
		$data['menu_surat_mandiri'] = $this->surat_model->list_surat_mandiri();
		$data['menu_dokumen_mandiri'] = $this->lapor_model->get_surat_ref_all();
		$data['m'] = 5;
		$data['permohonan'] = $this->permohonan_surat_model->get_permohonan($id_permohonan);
		$data['list_dokumen'] = $this->penduduk_model->list_dokumen($_SESSION['id']);
		$data['penduduk'] = $this->penduduk_model->get_penduduk($_SESSION['id']);

		// Ambil data anggota KK
		if ($data['penduduk']['kk_level'] === '1') // Jika Kepala Keluarga
		{
			$data['kk'] = $this->keluarga_model->list_anggota($data['penduduk']['id_kk']);
		}

		$data['desa'] = $this->header;
		$data['cek_anjungan'] = $this->cek_anjungan;

		$this->load->view('web/mandiri/layout.mandiri.php', $data);
	}

	public function cetak_biodata($id = '')
	{
		$data['desa'] = $this->header;
		$data['penduduk'] = $this->penduduk_model->get_penduduk($this->session->id);

		$this->load->view('sid/kependudukan/cetak_biodata', $data);
	}

	public function cetak_kk($id='')
	{
		$id_kk = $this->penduduk_model->get_id_kk($this->session->id);
		$data = $this->keluarga_model->get_data_cetak_kk($id_kk);

		$this->load->view("sid/kependudukan/cetak_kk_all", $data);
	}

	public function kartu_peserta($aksi = 'tampil', $id = 0)
	{
		$data = $this->program_bantuan_model->get_program_peserta_by_id($id);
		// Hanya boleh menampilkan data pengguna yang login
		// ** Bagi program sasaran pendududk **
		// TO DO : Ganti parameter nik menjadi id
		if ($data['peserta'] == $_SESSION['nik'])
		{
			if ($aksi == 'tampil')
			{
				$this->load->view('web/mandiri/data_peserta', $data);
			}
			else
			{
				$this->load->helper('download');
				if ($data['kartu_peserta']) force_download(LOKASI_DOKUMEN . $data['kartu_peserta'], NULL);

				redirect('mandiri_web/mandiri/1/4');
			}
		}
	}

	public function cek_syarat()
	{
		$id_permohonan = $this->input->post('id_permohonan');
		$permohonan = $this->db->where('id', $id_permohonan)
			->get('permohonan_surat')
			->row_array();
		$syarat_permohonan = json_decode($permohonan['syarat'], true);
		$dokumen = $this->penduduk_model->list_dokumen($_SESSION['id']);
		$id = $this->input->post('id_surat');
		$syarat_surat = $this->surat_master_model->get_syarat_surat($id);
		$data = array();
		$no = $_POST['start'];

		foreach ($syarat_surat as $no_syarat => $baris)
		{
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $baris['ref_syarat_nama'];
			// Gunakan view sebagai string untuk mempermudah pembuatan pilihan
			$pilihan_dokumen = $this->load->view('web/mandiri/pilihan_syarat.php', array('dokumen' => $dokumen, 'syarat_permohonan' => $syarat_permohonan, 'syarat_id' => $baris['ref_syarat_id']), TRUE);
			$row[] = $pilihan_dokumen;
			$data[] = $row;
		}

		$output = array(
			"recordsTotal" => 10,
			"recordsFiltered" => 10,
			'data' => $data
		);
		echo json_encode($output);
	}

	public function ajax_table_surat_permohonan()
	{
		$data = $this->penduduk_model->list_dokumen($_SESSION['id']);
		$jenis_syarat_surat = $this->referensi_model->list_by_id('ref_syarat_surat', 'ref_syarat_id');
		for ($i=0; $i < count($data); $i++)
		{
			$berkas = $data[$i]['satuan'];
			$list_dokumen[$i][] = $data[$i]['no'];
			$list_dokumen[$i][] = $data[$i]['id'];
			$list_dokumen[$i][] = "<a href='".site_url("mandiri_web/unduh_berkas/".$data[$i][id])."/{$data[$i][id_pend]}"."'>".$data[$i]["nama"].'</a>';
			$list_dokumen[$i][] = $jenis_syarat_surat[$data[$i]['id_syarat']]['ref_syarat_nama'];
			$list_dokumen[$i][] = tgl_indo2($data[$i]['tgl_upload']);
			$list_dokumen[$i][] = $data[$i]['nama'];
			$list_dokumen[$i][] = $data[$i]['dok_warga'];
		}
		$list['data'] = count($list_dokumen) > 0 ? $list_dokumen : array();
		echo json_encode($list);
	}

	public function ajax_upload_dokumen_pendukung()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama Dokumen', 'required');

		if ($this->form_validation->run() !== true)
		{
			$data['success'] = -1;
			$data['message'] = validation_errors();
			echo json_encode($data);
			return;
		}

		$this->session->unset_userdata('success');
		$this->session->unset_userdata('error_msg');
		$success_msg = 'Berhasil menyimpan data';

		if ($_SESSION['id'])
		{
			$_POST['id_pend'] = $this->session->id;
			$id_dokumen = $this->input->post('id');
			unset($_POST['id']);

			if ($id_dokumen)
			{
				$hasil = $this->web_dokumen_model->update($id_dokumen, $this->session->id, $mandiri = true);
				if (!$hasil)
				{
					$data['success'] = -1;
					$data['message'] = 'Gagal update';
				}
			}
			else
			{
				$_POST['dok_warga'] = 1; // Boleh diubah di layanan mandiri
				$this->web_dokumen_model->insert($mandiri = true);
			}
			$data['success'] = $this->session->success;
			$data['message'] = $data['success'] == -1 ? $this->session->error_msg : $success_msg;
		}
		else
		{
			$data['success'] = -1;
			$data['message'] = 'Anda tidak mempunyai hak akses itu';
		}

		echo json_encode($data);
	}

	public function ajax_get_dokumen_pendukung()
	{
		$id_dokumen = $this->input->post('id_dokumen');
		$data = $this->web_dokumen_model->get_dokumen($id_dokumen, $this->session->id);

		$data['anggota'] = $this->web_dokumen_model->get_dokumen_di_anggota_lain($id_dokumen);

		if (empty($data))
		{
			$data['success'] = -1;
			$data['message'] = 'Tidak ditemukan';
		}
		elseif ($this->session->id != $data['id_pend'])
		{
			$data = ['message' => 'Anda tidak mempunyai hak akses itu'];
		}
		echo json_encode($data);
	}

	public function ajax_hapus_dokumen_pendukung()
	{
		$id_dokumen = $this->input->post('id_dokumen');
		$data = $this->web_dokumen_model->get_dokumen($id_dokumen);
		if (empty($data))
		{
			$data['success'] = -1;
			$data['message'] = 'Tidak ditemukan';
		}
		elseif ($_SESSION['id'] != $data['id_pend'])
		{
			$data['success'] = -1;
			$data['message'] = 'Anda tidak mempunyai hak akses itu';
		}
		else
		{
			$this->web_dokumen_model->delete($id_dokumen);
			$data['success'] = $this->session->userdata('success') ? : '1';
		}
		echo json_encode($data);
	}

  /**
	 * Unduh berkas berdasarkan kolom dokumen.id
	 * @param   integer  $id_dokumen  Id berkas pada koloam dokumen.id
	 * @return  void
	 */
	public function unduh_berkas($id_dokumen, $id_pend)
	{
		// Ambil nama berkas dari database
		$berkas = $this->web_dokumen_model->get_nama_berkas($id_dokumen, $id_pend);
		if ($berkas)
			ambilBerkas($berkas, NULL, NULL, LOKASI_DOKUMEN);
		else
			$this->output->set_status_header('404');
	}
	
	public function penduduk_maps($p = 1, $o = 0, $id = '')
	{
		$data['p'] = $p;
		$data['o'] = $o;
		$data['id'] = $id;

		$data['penduduk_map'] = $this->penduduk_model->get_penduduk_map($data);
		$data['desa'] = $this->config_model->get_data();
		$sebutan_desa = ucwords($this->setting->sebutan_desa);
		$data['wil_atas'] = $this->config_model->get_data();
		$data['dusun_gis'] = $this->wilayah_model->list_dusun();
		$data['rw_gis'] = $this->wilayah_model->list_rw_gis();
		$data['rt_gis'] = $this->wilayah_model->list_rt_gis();

		$this->load->view('sid/kependudukan/ajax_penduduk_maps', $data);
		//$this->view("web/mandiri/penduduk_map.php", $data);

	}
	
// Rumah
	
	public function rumah($id = '')
	{
		$data['list_rumah'] = $this->penduduk_model->list_rumah($id);
		$data['penduduk'] = $this->penduduk_model->get_penduduk($id);
		//$data['jenis_syarat_surat'] = $this->referensi_model->list_by_id('ref_syarat_surat', 'ref_syarat_id');
		$this->render('sid/kependudukan/penduduk_rumah', $data);
	}

	public function rumah_form($id = 0, $id_rumah = 0)
	{
		$data['penduduk'] = $this->penduduk_model->get_penduduk($id);

		if ($data['penduduk']['kk_level'] === '1') //Jika Kepala Keluarga
		{
			$data['kk'] = $this->keluarga_model->list_anggota($data['penduduk']['id_kk']);
		}

		if ($id_rumah)
		{
			$data['rumah'] = $this->web_rumah_model->get_rumah($id_rumah);

			// Ambil data anggota KK
			if ($data['penduduk']['kk_level'] === '1') //Jika Kepala Keluarga
			{
				$data['rumah_anggota'] = $this->web_rumah_model->get_rumah_di_anggota_lain($id_rumah);

				if (count($data['rumah_anggota'])>0)
				{
					$id_pend_anggota = array();
					foreach ($data['rumah_anggota'] as $item_rumah)
						$id_pend_anggota[] = $item_rumah['id_pend'];
					foreach ($data['kk'] as $key => $value)
					{
						if (in_array($value['id'], $id_pend_anggota))
							$data['kk'][$key]['checked'] = 'checked';
					}
				}
			}

			$data['form_action'] = site_url("penduduk/rumah_update/$id_rumah");
		}
		else
		{
			$data['rumah'] = NULL;
			$data['form_action'] = site_url("penduduk/rumah_insert");
		}

		$this->load->view('sid/kependudukan/rumah_form', $data);
	}

	public function rumah_list($id = 0)
	{
		$data['list_rumah'] = $this->penduduk_model->list_rumah($id);
		$data['penduduk'] = $this->penduduk_model->get_penduduk($id);

		$this->load->view('sid/kependudukan/rumah_ajax', $data);
	}

	public function rumah_insert()
	{
		$this->web_rumah_model->insert();
		$id = $_POST['id_pend'];

		redirect("penduduk/detail/1/0/$id");
	}

	public function rumah_update($id = '')
	{
		$this->web_rumah_model->update($id);
		$id = $_POST['id_pend'];

		redirect("penduduk/detail/1/0/$id");
	}

	public function delete_rumah($id_pend = 0, $id = '')
	{
		$this->redirect_hak_akses('h', "penduduk/rumah/$id_pend");
		$this->web_rumah_model->delete($id);
		redirect("penduduk/detail/1/0/$id");
	}

	public function delete_all_rumah($id_pend = 0)
	{
		$this->redirect_hak_akses('h', "penduduk/rumah/$id_pend");
		$this->web_rumah_model->delete_all();

		redirect("penduduk/detail/1/0/$id");
	}
	
	public function mandiri_dokumen($id_permohonan='')
	{
		$data = $this->includes;
		$data['menu_surat_mandiri'] = $this->surat_model->list_surat_mandiri();
		$data['menu_dokumen_mandiri'] = $this->lapor_model->get_surat_ref_all();
		$data['m'] = 5;
		$data['permohonan'] = $this->permohonan_surat_model->get_permohonan($id_permohonan);
		$data['list_dokumen'] = $this->penduduk_model->list_dokumen($_SESSION['id']);
		$data['penduduk'] = $this->penduduk_model->get_penduduk($_SESSION['id']);

		// Ambil data anggota KK
		if ($data['penduduk']['kk_level'] === '1') // Jika Kepala Keluarga
		{
			$data['kk'] = $this->keluarga_model->list_anggota($data['penduduk']['id_kk']);
		}

		$data['desa'] = $this->header;
		$data['cek_anjungan'] = $this->cek_anjungan;

		$this->load->view('web/mandiri/dokumen', $data);
	}
	
}

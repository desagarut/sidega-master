<?php defined('BASEPATH') or exit('No direct script access allowed');

//require_once 'vendor/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Common\Entity\Row;

class Bpd_buku_aspirasi extends Admin_Controller
{

	private $_set_page;

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['bpd_buku_aspirasi_model', 'config_model', 'penduduk_model', 'keluarga_model']);
		$this->modul_ini = 900;
		$this->sub_modul_ini = 903;
		$this->set_minsidebar(0);
		$this->_set_page = ['20', '50', '100'];
	}

	public function clear()
	{
		$this->session->per_page = $this->_set_page[0];
		$this->session->unset_userdata('sasaran');
		redirect('bpd_buku_aspirasi');
	}

	public function filter($filter)
	{
		$value = $this->input->post($filter);
		if ($value != '')
			$this->session->$filter = $value;
		else $this->session->unset_userdata($filter);
		redirect('bpd_buku_aspirasi');
	}

	public function index($p = 1)
	{
		$per_page = $this->input->post('per_page');
		if (isset($per_page))
			$this->session->per_page = $per_page;

		$data = $this->bpd_buku_aspirasi_model->get_buku_aspirasi($p, FALSE);
		$data['list_sasaran'] = unserialize(SASARAN);
		$data['func'] = 'index';
		$data['per_page'] = $this->session->per_page;
		$data['set_page'] = $this->_set_page;
		$data['set_sasaran'] = $this->session->sasaran;

		$this->render('bpd/aspirasi/aspirasi_index', $data);
	}

	public function aspirasi_create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('cid', 'Sasaran', 'required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'required');
		$this->form_validation->set_rules('nama', 'Nama buku_aspirasi', 'required');
		$this->form_validation->set_rules('sdate', 'Tanggal awal', 'required');
		$this->form_validation->set_rules('edate', 'Tanggal akhir', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->render('bpd/aspirasi/aspirasi_create', $data);
		} else {
			$this->bpd_buku_aspirasi_model->set_program();
			redirect("bpd_buku_aspirasi");
		}
	}

	// $id = buku_aspirasi.id
	public function aspirasi_edit($id = 0)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('sasaran', 'Sasaran', 'required');
		$this->form_validation->set_rules('tahun', 'Tahun', 'required');
		$this->form_validation->set_rules('nama', 'Nama buku aspirasi', 'required');
		$this->form_validation->set_rules('sdate', 'Tanggal awal', 'required');
		$this->form_validation->set_rules('edate', 'Tanggal akhir', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		$data['buku_aspirasi'] = $this->bpd_buku_aspirasi_model->get_buku_aspirasi(1, $id);
		$data['jml'] = $this->bpd_buku_aspirasi_model->jml_peserta_program($id);

		if ($this->form_validation->run() === FALSE) {
			$this->render('bpd/aspirasi/aspirasi_edit', $data);
		} else {
			$this->bpd_buku_aspirasi_model->update_buku_aspirasi($id);
			redirect("bpd_buku_aspirasi");
		}
	}

	public function panduan()
	{
		$this->render('bpd/aspirasi/panduan');
	}

	public function aspirasi_detail($program_id = 0, $p = 1)
	{
		$per_page = $this->input->post('per_page');
		if (isset($per_page))
			$this->session->per_page = $per_page;

		$data['cari'] = $this->session->cari ?: '';
		$data['buku_aspirasi'] = $this->bpd_buku_aspirasi_model->get_buku_aspirasi($p, $program_id);

		$data['keyword'] = $this->bpd_buku_aspirasi_model->autocomplete($program_id, $this->input->post('cari'));
		$data['paging'] = $data['buku_aspirasi'][0]['paging'];
		$data['p'] = $p;
		$data['func'] = "aspirasi_detail/$program_id";
		$data['per_page'] = $this->session->per_page;
		$data['set_page'] = $this->_set_page;
		$this->set_minsidebar(0);

		$this->render('bpd/aspirasi/aspirasi_detail', $data);
	}

	public function aspirasi_detail_form($program_id = 0)
	{
		$data['buku_aspirasi'] = $this->bpd_buku_aspirasi_model->get_buku_aspirasi(1, $program_id);

		$sasaran = $data['buku_aspirasi'][0]['sasaran'];
		$nik = $this->input->post('nik');

		if (isset($nik)) {
			$data['individu'] = $this->bpd_buku_aspirasi_model->get_peserta($nik, $sasaran);
			$data['individu']['buku_aspirasi'] = $this->bpd_buku_aspirasi_model->get_peserta_program($sasaran, $data['individu']['id_peserta']);
		} else {
			$data['individu'] = NULL;
		}

		$data['form_action'] = site_url("bpd_buku_aspirasi/aspirasi_detail_add/" . $program_id);

		$this->render('bpd/aspirasi/aspirasi_detail_form', $data);
	}

	// $id = program_peserta.id
	public function aspirasi_detail_edit($id = 0)
	{
		$this->bpd_buku_aspirasi_model->aspirasi_detail_edit($id);
		$program_id = $this->input->post('program_id');
		redirect("bpd_buku_aspirasi/aspirasi_detail/$program_id");
	}

	// $id = program_peserta.id
	public function aspirasi_detail_edit_form($id = 0)
	{
		$data = $this->bpd_buku_aspirasi_model->get_buku_pemberi_aspirasi_detail_by_id($id);
		$data['form_action'] = site_url("bpd_buku_aspirasi/aspirasi_detail_edit/$id");
		$this->load->view('bpd/aspirasi/aspirasi_detail_edit', $data);
	}

	public function aspirasi_detail_add($program_id = 0)
	{
		$this->bpd_buku_aspirasi_model->aspirasi_detail_add($program_id);

		$redirect = ($this->session->userdata('aksi') != 1) ? $_SERVER['HTTP_REFERER'] : "bpd_buku_aspirasi/aspirasi_detail/$program_id";

		$this->session->unset_userdata('aksi');

		redirect($redirect);
	}

	// $id = program_peserta.id
	public function peserta($cat = 0, $id = 0)
	{
		$data = $this->bpd_buku_aspirasi_model->get_peserta_program($cat, $id);

		$this->render('bpd/aspirasi/peserta', $data);
	}

	// $id = program_peserta.id
	public function data_peserta($id = 0)
	{
		$data['peserta'] = $this->bpd_buku_aspirasi_model->get_buku_pemberi_aspirasi_detail_by_id($id);

		switch ($data['peserta']['sasaran']) {
			case '1':
			case '2':
				$peserta_id = $data['peserta']['kartu_id_pend'];
				break;
			case '3':
			case '4':
				$peserta_id = $data['peserta']['peserta'];
				break;
		}
		$data['individu'] = $this->bpd_buku_aspirasi_model->get_peserta($peserta_id, $data['peserta']['sasaran']);
		$data['individu']['buku_aspirasi'] = $this->bpd_buku_aspirasi_model->get_peserta_program($data['peserta']['sasaran'], $data['peserta']['peserta']);
		$data['detail'] = $this->bpd_buku_aspirasi_model->get_data_program($data['peserta']['program_id']);
		$this->set_minsidebar(1);

		$this->render('bpd/aspirasi/data_peserta', $data);
	}

	public function aksi($aksi = '', $program_id = 0)
	{
		$this->session->set_userdata('aksi', $aksi);

		redirect("bpd_buku_aspirasi/aspirasi_detail_form/$program_id");
	}

	public function hapus_peserta($program_id = 0, $peserta_id = '')
	{
		$this->redirect_hak_akses('h', "bpd_buku_aspirasi/aspirasi_detail/$program_id");
		$this->bpd_buku_aspirasi_model->hapus_peserta($peserta_id);
		redirect("bpd_buku_aspirasi/aspirasi_detail/$program_id");
	}

	public function delete_all($program_id = 0)
	{
		$this->redirect_hak_akses('h', "bpd_buku_aspirasi/aspirasi_detail/$program_id");
		$this->bpd_buku_aspirasi_model->delete_all();
		redirect("bpd_buku_aspirasi/aspirasi_detail/$program_id");
	}

	// $id = buku_aspirasi.id
	public function update($id)
	{
		$this->bpd_buku_aspirasi_model->update_buku_aspirasi($id);
		redirect("bpd_buku_aspirasi/aspirasi_detail/$id");
	}

	// $id = buku_aspirasi.id
	public function hapus($id)
	{
		$this->redirect_hak_akses('h', "bpd_buku_aspirasi");
		$this->bpd_buku_aspirasi_model->hapus_program($id);
		redirect("bpd_buku_aspirasi");
	}

	/*
	 * $aksi = cetak/unduh
	 */
	public function daftar($program_id = 0, $aksi = '')
	{
		if ($program_id > 0) {
			$temp = $this->session->per_page;
			$this->session->per_page = 1000000000; // Angka besar supaya semua data terunduh
			$data["sasaran"] = unserialize(SASARAN);

			$data['config'] = $this->config_model->get_data();
			$data['peserta'] = $this->bpd_buku_aspirasi_model->get_buku_aspirasi(1, $program_id);
			$data['aksi'] = $aksi;
			$this->session->per_page = $temp;

			$this->load->view("bpd/aspirasi/$aksi", $data);
		}
	}

	public function search($program_id = 0)
	{
		$cari = $this->input->post('cari');

		if ($cari != '')
			$this->session->cari = $cari;
		else $this->session->unset_userdata('cari');

		redirect("bpd_buku_aspirasi/aspirasi_detail/$program_id");
	}

	// TODO: function ini terlalu panjang dan sebaiknya dipecah menjadi beberapa method
	public function impor()
	{
		$this->load->library('upload');

		$config['upload_path']		= LOKASI_DOKUMEN;
		$config['allowed_types']	= 'xls|xlsx|xlsm';
		//$config['max_size']				= max_upload() * 1024;
		$config['file_name']			= namafile('Impor Peserta buku_aspirasi Bantuan');

		$this->upload->initialize($config);

		if ($this->upload->do_upload('userfile')) {
			$program_id = '';
			// Data buku_aspirasi Bantuan
			$temp = $this->session->per_page;
			$this->session->per_page = 1000000000;
			$ganti_program = $this->input->post('ganti_program');
			$kosongkan_peserta = $this->input->post('kosongkan_peserta');
			$ganti_peserta = $this->input->post('ganti_peserta');
			$rand_dokumen = $this->input->post('rand_dokumen');

			$upload = $this->upload->data();
			$file = LOKASI_DOKUMEN . $upload['file_name'];

			$reader = ReaderEntityFactory::createXLSXReader();
			$reader->open($file);

			$data_program = [];
			$data_peserta = [];
			$data_diubah = '';

			foreach ($reader->getSheetIterator() as $sheet) {
				$no_baris = 0;
				$no_gagal = 0;
				$no_sukses = 0;
				$pesan = '';

				// Sheet buku_aspirasi
				if ($sheet->getName() == 'buku_aspirasi') {
					$ambil_program = $this->bpd_buku_aspirasi_model->get_buku_aspirasi(1, FALSE);
					$daftar_program = str_replace("'", "", explode(", ", sql_in_list(array_column($ambil_program['buku_aspirasi'], 'id'))));

					$field = ['id', 'nama', 'sasaran', 'ndesc', 'asaldana', 'sdate', 'edate'];

					foreach ($sheet->getRowIterator() as $row) {
						$cells = $row->getCells();
						$title = (string) $cells[0];
						$value = (string) $cells[1];

						// Data terakhir
						if ($title == '###') break;

						switch (true) {
							/**
							 * baris 1 == id
							 * id bernilai NULL/Kosong( )/Strip(-)/tdk valid, buat buku_aspirasi baru dan tampilkan notifkasi tambah buku_aspirasi
							 * id bernilai id dan valid, update data buku_aspirasi dan tampilkan notifkasi update buku_aspirasi
							 */
							case ($no_baris == 0 && in_array($value, $daftar_program) && $ganti_program == 1):
								$program_id = $value;
								$pesan .= "- Data buku_aspirasi dengan <b> id = " . ($value) . "</b> ditemukan, data lama diganti dengan data baru <br>";
								break;

							case ($no_baris == 0 && in_array($value, $daftar_program) && $ganti_program != 1):
								$program_id = $value;
								$pesan .= "- Data buku_aspirasi dengan <b> id = " . ($value) . "</b> ditemukan, data lama tetap digunakan <br>";
								break;

							case ($no_baris == 0 && ! in_array($value, $daftar_program)):
								$program_id = NULL;
								$pesan .= "- Data buku_aspirasi dengan <b> id = " . ($value) . "</b> tidak ditemukan, buku_aspirasi baru ditambahkan secara otomatis) <br>";
								break;

							default:
								$data_program = array_merge($data_program, [$field[$no_baris] => $value]);
								break;
						}
						$no_baris++;
					}

					// Proses impor buku_aspirasi
					$program_id = $this->bpd_buku_aspirasi_model->impor_program($program_id, $data_program, $ganti_program);
				}

				// Sheet Peserta
				else {
					$ambil_peserta = $this->bpd_buku_aspirasi_model->get_buku_aspirasi(1, $program_id);
					$sasaran = $ambil_peserta[0]['sasaran'];
					$terdaftar_peserta = str_replace("'", "", explode(", ", sql_in_list(array_column($ambil_peserta[1], 'peserta'))));

					if ($kosongkan_peserta == 1) {
						$pesan .= "- Data peserta " . ($ambil_peserta[0]['nama']) . " sukses dikosongkan<br>";
						$terdaftar_peserta = NULL;
					}

					foreach ($sheet->getRowIterator() as $row) {
						$no_baris++;
						$cells = $row->getCells();
						$peserta = (string) $cells[0];
						$nik = (string) $cells[2];

						// Data terakhir
						if ($peserta == '###') break;

						// Abaikan baris pertama / judul
						if ($no_baris <= 1) continue;

						// Cek valid data peserta sesuai sasaran
						$cek_peserta = $this->bpd_buku_aspirasi_model->cek_peserta($peserta, $sasaran);
						if (! in_array($nik, $cek_peserta['valid'])) {
							$no_gagal++;
							$pesan .= "- Data peserta baris <b> Ke-" . ($no_baris) . " / " . $cek_peserta['sasaran_peserta'] . " = " . $peserta . "</b> tidak ditemukan <br>";
							continue;
						}

						// Cek valid data penduduk sesuai nik
						$cek_penduduk = $this->penduduk_model->get_penduduk_by_nik($nik);
						if (! $cek_penduduk['id']) {
							$no_gagal++;
							$pesan .= "- Data peserta baris <b> Ke-" . ($no_baris) . " / NIK = " . $nik . "</b> yang terdaftar tidak ditemukan <br>";
							continue;
						}

						// Cek data peserta yg akan dimpor dan yg sudah ada
						if (in_array($peserta, $terdaftar_peserta) && $ganti_peserta != 1) {
							$no_gagal++;
							$pesan .= "- Data peserta baris <b> Ke-" . ($no_baris) . "</b> sudah ada <br>";
							continue;
						}

						if (in_array($peserta, $terdaftar_peserta) && $ganti_peserta == 1) {
							$data_diubah .= ", " . $peserta;
							$pesan .= "- Data peserta baris <b> Ke-" . ($no_baris) . "</b> ditambahkan menggantikan data lama <br>";
						}

						// Random no. kartu peserta
						if ($rand_kartu == 1) $no_id_kartu = 'acak_' . random_int(1, 1000);

						// Ubaha data peserta menjadi id (untuk saat ini masih data kelompok yg menggunakan id)
						// Berkaitan dgn issue #3417
						if ($sasaran == 4) $peserta = $cek_peserta['id'];

						// Simpan data peserta yg diimpor dalam bentuk array
						$simpan = [
							'peserta' => $peserta,
							'program_id' => $program_id,
							'no_id_kartu' => ((string) $cells[1]) ? $cells[1] : $no_id_kartu,
							'kartu_nik' => $nik,
							'kartu_nama' => ((string) $cells[3]) ? $cells[3] : $cek_penduduk['nama'],
							'kartu_tempat_lahir' => ((string) $cells[4]) ? $cells[4] : $cek_penduduk['tempatlahir'],
							'kartu_tanggal_lahir' => ((string) $cells[5]) ? $cells[5] : $cek_penduduk['tanggallahir'],
							'kartu_alamat' => ((string) $cells[6]) ? $cells[6] : $cek_penduduk['alamat_wilayah'],
							'kartu_id_pend' => $cek_penduduk['id'],
						];

						array_push($data_peserta, $simpan);
						$no_sukses++;
					}

					// Proses impor peserta
					if ($no_baris <= 0) {
						$pesan .= "- Data peserta tidak tersedia<br>";
					} else {
						$this->bpd_buku_aspirasi_model->impor_peserta($program_id, $data_peserta, $kosongkan_peserta, $data_diubah);
					}
				}
			}
			$reader->close();
			unlink($file);

			$notif = [
				'gagal' => $no_gagal,
				'sukses' => $no_sukses,
				'pesan' => $pesan,
				'total' => $total,
			];

			$this->session->set_flashdata('notif', $notif);
			$this->session->per_page = $temp;

			redirect("bpd_buku_aspirasi/aspirasi_detail/$program_id");
		} else {
			$this->session->error_msg = $this->upload->display_errors();
			$this->session->success = -1;
		}
	}

	// TODO: function ini terlalu panjang dan sebaiknya dipecah menjadi beberapa method
	public function expor($program_id = '')
	{
		// Data buku_aspirasi Bantuan
		$temp = $this->session->per_page;
		$this->session->per_page = 1000000000;
		$data = $this->bpd_buku_aspirasi_model->get_buku_aspirasi(1, $program_id);
		$tbl_program = $data[0];
		$tbl_peserta = $data[1];

		//Nama File
		$writer = WriterEntityFactory::createXLSXWriter();
		$fileName = namafile('Buku_aspirasi_masyarakat' . $tbl_program['nama']) . '.xlsx';
		$writer->openToBrowser($fileName);

		// Sheet buku_aspirasi
		$writer->getCurrentSheet()->setName('buku_aspirasi');
		$data_program = [
			['id', $tbl_program['id']],
			['Nama buku_aspirasi', $tbl_program['nama']],
			['Tahun Buku', $tbl_program['tahun']],
			['Kelompok Pemberi Aspirasi', $tbl_program['sasaran']],
			['Keterangan', $tbl_program['ndesc']],
			['Rentang Waktu (Awal)', $tbl_program['sdate']],
			['Rentang Waktu (Akhir)', $tbl_program['edate']],
		];

		foreach ($data_program as $row) {
			$expor_program = [$row[0], $row[1]];
			$rowFromValues = WriterEntityFactory::createRowFromArray($expor_program);
			$writer->addRow($rowFromValues);
		}

		// Sheet Peserta
		$writer->addNewSheetAndMakeItCurrent()->setName('Peserta');
		$judul_peserta = ['Nama Pemberi Aspirasi', 'No. Peserta', 'NIK', 'Nama', 'Tempat Lahir', 'Tanggal Lahir', 'Alamat'];
		$style = (new StyleBuilder())
			->setFontBold()
			->setFontSize(12)
			->setBackgroundColor(Color::YELLOW)
			->build();
		$header = WriterEntityFactory::createRowFromArray($judul_peserta, $style);
		$writer->addRow($header);

		//Isi Tabel
		foreach ($tbl_peserta as $row) {
			$peserta = $row['peserta'];
			// Ubah id menjadi kode untuk data kelompok
			// Berkaitan dgn issue #3417
			// Cari data kelompok berdasarkan id
			if ($tbl_program['sasaran'] == 4) {
				$this->load->model('kelompok_model');
				$kelompok = $this->kelompok_model->get_kelompok($peserta);
				$peserta = $kelompok['kode'];
			}

			$data_peserta = [
				$peserta,
				$row['no_id_kartu'],
				$row['kartu_nik'],
				$row['kartu_nama'],
				$row['kartu_tempat_lahir'],
				$row['kartu_tanggal_lahir'],
				$row['kartu_alamat'],
			];
			$rowFromValues = WriterEntityFactory::createRowFromArray($data_peserta);
			$writer->addRow($rowFromValues);
		}
		$writer->close();

		$this->session->per_page = $temp;
	}
}

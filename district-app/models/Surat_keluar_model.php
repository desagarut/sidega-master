<?php class Surat_keluar_model extends MY_Model {
  // Konfigurasi untuk library 'upload'
  protected $uploadConfig = array();

	public function __construct()
	{
		parent::__construct();
		// Untuk dapat menggunakan library upload
		$this->load->library('upload');
		// Untuk dapat menggunakan fungsi generator()
		$this->load->helper('donjolib');
    // Helper upload file
		$this->load->helper('pict_helper');
		$this->uploadConfig = array(
			'upload_path' => LOKASI_ARSIP,
			'allowed_types' => 'gif|jpg|jpeg|png|pdf',
			'max_size' => max_upload()*1024,
		);
	}

	public function autocomplete()
	{
		// TODO: tambahkan kata2 dari isi_singkat
		return $this->autocomplete_str('tujuan', 'surat_keluar');
	}

	private function search_sql()
	{
		if ($cari = $this->session->cari)
		{
			$cari = $this->db->escape_like_str($cari);
			$this->db
				->group_start()
					->like('u.tujuan', $cari)
					->or_like('u.isi_singkat', $cari)
				->group_end();
		}
	}

	private function filter_sql()
	{
		if ($filter = $this->session->filter)
		{
			$this->db->where('YEAR(u.tanggal_surat)', $filter);
		}
	}

	// Digunakan untuk paging dan query utama supaya jumlah data selalu sama
	private function list_data_sql()
	{
		$this->db->from('surat_keluar u');
		$this->search_sql();
		$this->filter_sql();
	}

	public function paging($p=1, $o=0)
	{
		$this->list_data_sql();
		$jml_data = $this->db
			->select('COUNT(id) AS jml')
			->get()
			->row()->jml;

		$this->load->library('paging');
		$cfg['page'] = $p;
		$cfg['per_page'] = $this->session->per_page;
		$cfg['num_rows'] = $jml_data;
		$this->paging->init($cfg);

		return $this->paging;
	}

	public function list_data($o=0, $offset=0, $limit=500)
	{
		$this->list_data_sql();
		//Ordering
		switch ($o)
		{
			case 1: $order = ' YEAR(u.tanggal_surat) ASC, u.nomor_urut ASC'; break;
			case 2: $order = ' YEAR(u.tanggal_surat) DESC, u.nomor_urut DESC'; break;
			case 3: $order = ' u.tanggal_surat'; break;
			case 4: $order = ' u.tanggal_surat DESC'; break;
			case 5: $order = ' u.tujuan'; break;
			case 6: $order = ' u.tujuan DESC'; break;
			case 7: $order = ' u.tanggal_pengiriman'; break;
			case 8: $order = ' u.tanggal_pengiriman DESC'; break;
			default:$order = ' u.id';
		}
		$data = $this->db
			->select('u.*')
			->order_by($order)
			->limit($limit, $offset)
			->get()
			->result_array();
		return $data;
	}

	public function list_tahun_surat()
	{
		$query = $this->db->distinct()->
			select('YEAR(tanggal_surat) AS tahun')->
			order_by('YEAR(tanggal_surat)','DESC')->
			get('surat_keluar')->result_array();
		return $query;
	}

	/**
	 * Insert data baru ke tabel surat_keluar
	 * @return  void
	 */
	public function insert()
	{
		// Ambil semua data dari var. global $_POST
		$data = $this->input->post(NULL);
		unset($data['url_remote']);
		unset($data['nomor_urut_lama']);
		$this->validasi($data);
		$data['created_by'] = $data['updated_by'] = $this->session->user;

		// Adakah lampiran yang disertakan?
		$adaLampiran = !empty($_FILES['satuan']['name']);

		// Cek nama berkas user boleh lebih dari 80 karakter (+20 untuk unique id) karena -
		// karakter maksimal yang bisa ditampung kolom surat_keluar.berkas_scan hanya 100 karakter
		if ($adaLampiran && ((strlen($_FILES['satuan']['name']) + 20 ) >= 100))
		{
			$_SESSION['success'] = -1;
			$_SESSION['error_msg'] = ' -> Nama berkas yang coba Anda unggah terlalu panjang, '.
				'batas maksimal yang diijinkan adalah 80 karakter';
			redirect('surat_keluar');
		}

		$uploadData = NULL;
		$uploadError = NULL;
		// Ada lampiran file
		if ($adaLampiran === TRUE)
		{
			// Tes tidak berisi script PHP
			if(isPHP($_FILES['foto']['tmp_name'], $_FILES['foto']['name'])){
				$_SESSION['error_msg'] .= " -> Jenis file ini tidak diperbolehkan ";
				$_SESSION['success'] = -1;
				redirect('man_user');
			}
			// Inisialisasi library 'upload'
			$this->upload->initialize($this->uploadConfig);
			// Upload sukses
			if ($this->upload->do_upload('satuan'))
			{
				$uploadData = $this->upload->data();
				// Buat nama file unik agar url file susah ditebak dari browser
				$namaFileUnik = tambahSuffixUniqueKeNamaFile($uploadData['file_name']);
				// Ganti nama file asli dengan nama unik untuk mencegah akses langsung dari browser
				$fileRenamed = rename(
					$this->uploadConfig['upload_path'].$uploadData['file_name'],
					$this->uploadConfig['upload_path'].$namaFileUnik
				);
				// Ganti nama di array upload jika file berhasil di-rename --
				// jika rename gagal, fallback ke nama asli
				$uploadData['file_name'] = $fileRenamed ? $namaFileUnik : $uploadData['file_name'];
			}
			// Upload gagal
			else
			{
				$uploadError = $this->upload->display_errors(NULL, NULL);
			}
		}
		// Berkas lampiran
		$data['berkas_scan'] = $adaLampiran && !is_null($uploadData)
			? $uploadData['file_name'] : NULL;
		$data['created_by'] = $this->session->user;
		$data['updated_by'] = $this->session->user;
		// penerapan transcation karena insert ke 2 tabel
		$this->db->trans_start();

		$indikatorSukses = is_null($uploadError) && $this->db->insert('surat_keluar', $data);

		$insert_id = $this->db->insert_id();

		// transaction selesai
		$this->db->trans_complete();

		// Set session berdasarkan hasil operasi
		status_sukses($indikatorSukses); //Tampilkan Pesan
		$_SESSION['error_msg'] = $_SESSION['success'] === 1 ? NULL : ' -> '.$uploadError;
	}

	private function validasi(&$data)
	{
		// Normalkan tanggal
		$data['tanggal_surat'] = tgl_indo_in($data['tanggal_surat']);
		// Bersihkan data
		$data['nomor_surat'] = nomor_surat_keputusan(strip_tags($data['nomor_surat']));
		$data['tujuan'] = strip_tags($data['tujuan']);
		$data['isi_singkat'] = strip_tags($data['isi_singkat']);
	}

	/**
	 * Update data di tabel surat_keluar
	 * @param   integer  $idSuratMasuk  Id berkas untuk query ke database
	 * @return  void
	 */
	public function update($idSuratMasuk)
	{
		// Ambil semua data dari var. global $_POST
		$data = $this->input->post(NULL);
		unset($data['url_remote']);
		unset($data['nomor_urut_lama']);
		$this->validasi($data);
		$data['updated_by'] = $this->session->user;

		$_SESSION['error_msg'] = NULL;

		// Ambil nama berkas scan lama dari database
		$berkasLama = $this->getNamaBerkasScan($idSuratMasuk);

		// Lokasi berkas scan lama (absolut)
		$lokasiBerkasLama = $this->uploadConfig['upload_path'].$berkasLama;
		$lokasiBerkasLama = str_replace('/', DIRECTORY_SEPARATOR, FCPATH.$lokasiBerkasLama);

		$indikatorSukses = FALSE;

		// Hapus lampiran lama?
		$hapusLampiranLama = $data['gambar_hapus'];
		unset($data['gambar_hapus']);

		$uploadData = NULL;
		$uploadError = NULL;

		// Adakah file baru yang akan diupload?
		$adaLampiran = !empty($_FILES['satuan']['name']);

		// penerapan transcation karena insert ke 2 tabel
		$this->db->trans_start();

		// Ada lampiran file
		if ($adaLampiran === TRUE)
		{
			// Tes tidak berisi script PHP
			if(isPHP($_FILES['foto']['tmp_name'], $_FILES['satuan']['name'])){
				$_SESSION['error_msg'].= " -> Jenis file ini tidak diperbolehkan ";
				$_SESSION['success']=-1;
				redirect('surat_keluar');
			}
			// Cek nama berkas tidak boleh lebih dari 80 karakter (+20 untuk unique id) karena -
			// karakter maksimal yang bisa ditampung kolom surat_keluar.berkas_scan hanya 100 karakter
			if ((strlen($_FILES['satuan']['name']) + 20 ) >= 100)
			{
				$_SESSION['success'] = -1;
				$_SESSION['error_msg'] = ' -> Nama berkas yang coba Anda unggah terlalu panjang, '.
				'batas maksimal yang diijinkan adalah 80 karakter';
				redirect('surat_keluar');
			}
			// Inisialisasi library 'upload'
			$this->upload->initialize($this->uploadConfig);
			// Upload sukses
			if ($this->upload->do_upload('satuan'))
			{
				$uploadData = $this->upload->data();
				// Hapus berkas dari disk
				$oldFileRemoved = unlink($lokasiBerkasLama) && !file_exists($lokasiBerkasLama);
				$_SESSION['error_msg'] = ($oldFileRemoved === TRUE)
					? NULL : ' -> Gagal menghapus berkas lama';
				// Buat nama file unik untuk nama file upload
				$namaFileUnik = tambahSuffixUniqueKeNamaFile($uploadData['file_name']);
				// Ganti nama file asli dengan nama unik untuk mencegah akses langsung dari browser
				$uploadedFileRenamed = rename(
					$this->uploadConfig['upload_path'].$uploadData['file_name'],
					$this->uploadConfig['upload_path'].$namaFileUnik
				);

				$uploadData['file_name'] = ($uploadedFileRenamed === FALSE) ?: $namaFileUnik;

				$data['berkas_scan'] = $uploadData['file_name'];
				$data['updated_by'] = $this->session->user;
				$data['updated_at'] = date('Y-m-d H:i:s');
				// Update database dengan `berkas_scan` berisi nama unik
				$this->db->where('id', $idSuratMasuk);
				$databaseUpdated = $this->db->update('surat_keluar', $data);

				$_SESSION['error_msg'] = ($databaseUpdated === TRUE)
					? NULL : 'Gagal memperbarui data di database';
			}
			// Upload gagal
			else
			{
				$_SESSION['error_msg'] = $this->upload->display_errors(NULL, NULL);
			}
		}
		// Tidak ada file upload
		else
		{
			unset($data['berkas_scan']);
			if ($hapusLampiranLama)
			{
				$data['berkas_scan'] = NULL;
				$adaBerkasLamaDiDisk = file_exists($lokasiBerkasLama);
				$oldFileRemoved = $adaBerkasLamaDiDisk && unlink($lokasiBerkasLama);
				$_SESSION['error_msg'] = ($oldFileRemoved === TRUE)
					? NULL : ' -> Gagal menghapus berkas lama';
			}
			$this->db->where('id', $idSuratMasuk);
			$databaseUpdated = $this->db->update('surat_keluar', $data);
			$_SESSION['error_msg'] = ($databaseUpdated === TRUE)
				? NULL : 'Gagal memperbarui data di database';
			$adaBerkasLamaDiDB = !is_null($berkasLama);
		}

		$this->db->trans_complete();

		$_SESSION['success'] = is_null($_SESSION['error_msg']) ? 1 : -1;
	}

	public function get_surat_keluar($id)
	{
		$surat_keluar = $this->db->where('id', $id)->get('surat_keluar')->row_array();
		return $surat_keluar;
	}

	/**
	 * Hapus record surat masuk beserta file lampirannya (jika ada)
	 * @param   string  $idSuratMasuk  Id surat masuk
	 * @return  void
	 */
	public function delete($idSuratMasuk, $semua=false)
	{
		if (!$semua)
		{
			$this->session->success = 1;
			$this->session->error_msg = '';
		}
		// Type check
		$idSuratMasuk = is_string($idSuratMasuk) ? $idSuratMasuk : strval($idSuratMasuk);
		// Redirect ke halaman surat masuk jika Id kosong
		if (empty($idSuratMasuk))
		{
			$_SESSION['success'] = -1;
			$_SESSION['error_msg'] = ' -> Data yang anda minta tidak ditemukan';
			redirect('surat_keluar');
		}

		$_SESSION['error_msg'] = NULL;

		$namaBerkas = $this->getNamaBerkasScan($idSuratMasuk);

		if (!is_null($namaBerkas))
		{
			$lokasiBerkasLama = $this->uploadConfig['upload_path'].$namaBerkas;
			$lokasiBerkasLama = str_replace('/', DIRECTORY_SEPARATOR, FCPATH.$lokasiBerkasLama);

			if (file_exists($lokasiBerkasLama))
			{
				$hapusLampiranLama = unlink($lokasiBerkasLama);
				$hapusLampiranLama = !file_exists($lokasiBerkasLama);
				$_SESSION['error_msg'] = $hapusLampiranLama === TRUE
					? NULL :' -> Gagal menghapus berkas dari disk';
			}

			if (is_null($_SESSION['error_msg']))
			{
				$hapusRecordDb = $this->db->where('id', $idSuratMasuk)->delete('surat_keluar');
				$_SESSION['error_msg'] = $hapusRecordDb === TRUE
					? NULL : ' -> Gagal menghapus record dari database';
			}
		}
		else
		{
			$hapusRecordDb = $this->db->where('id', $idSuratMasuk)->delete('surat_keluar');
			$_SESSION['error_msg'] = $hapusRecordDb === TRUE
				? NULL : ' -> Gagal menghapus record dari database';
		}

		$_SESSION['success'] = is_null($_SESSION['error_msg']) ? 1 : -1;
	}

	public function delete_all()
	{
		$this->session->success = 1;
		$this->session->error_msg = '';

		$id_cb = $_POST['id_cb'];
		foreach ($id_cb as $id)
		{
			$this->delete($id, $semua=true);
		}
	}

	//! ==============================================================
	//! Helper Methods
	//! ==============================================================
	/**
	 * Ambil nama berkas scan dari database berdasarkan Id surat masuk
	 * @param  string       $idSuratMasuk  Id pada tabel surat_keluar
	 * @param  string       $kolom         Kolom yang akan diambil datanya
	 * @return  string|NULL
	 */
	public function getNamaBerkasScan($idSuratMasuk)
	{
		// Ambil nama berkas dari database
		$sql = "SELECT berkas_scan FROM surat_keluar WHERE id = ? LIMIT 1;";
		$query = $this->db->query($sql, array($idSuratMasuk));
		$namaBerkas = $query->row();
		$namaBerkas = is_object($namaBerkas) ? $namaBerkas->berkas_scan : NULL;
		return $namaBerkas;
	}

	public function untuk_ekspedisi($id, $masuk = 0)
	{
		$this->db
			->where('id', $id)
			->set('ekspedisi', $masuk)
			->update('surat_keluar');
	}

}

?>

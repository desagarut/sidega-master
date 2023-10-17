<?php

class Bip2016_luwutimur_model extends Import_model {

	public function __construct()
	{
		parent::__construct();
		ini_set('memory_limit', '512M');
		set_time_limit(3600);
	}

	/* 	======================================================
			IMPORT BUKU INDUK PENDUDUK 2016 (LUWU TIMUR)
			======================================================
	*/

	/**
	 * Cari baris pertama mulainya blok keluarga
	 *
	 * @access	private
	 * @param		sheet			data excel berisi bip
	 * @param 	integer		jumlah baris di sheet
	 * @param 	integer		cari dari baris ini
	 * @return	integer 	baris pertama blok keluarga
	 */
	private function cari_bip_kk($data_sheet, $baris, $dari=1)
	{
		if ($baris <= 1 )
			return 0;

		$baris_kk = 0;
		for ($i=$dari; $i<=$baris; $i++)
		{
			// Baris dengan kolom[2] yang mulai dengan "BUKU INDUK KEPENDUDUKAN" menunjukkan mulainya data keluarga dan anggotanya
			if (strpos($data_sheet[$i][2], 'BUKU INDUK KEPENDUDUKAN') === 0)
			{
				$baris_kk = $i;
				break;
			}
		}
		return $baris_kk;
	}

	/**
	 * Ambil data keluarga berikutnya
	 *
	 * @access	private
	 * @param		sheet		data excel berisi bip
	 * @param 	integer	cari dari baris ini
	 * @return	array 	data keluarga
	 */
	private function get_bip_keluarga($data_sheet, $i)
	{
		/* $i = baris berisi data keluarga.
		 * Contoh:
		BUKU INDUK KEPENDUDUKAN KABUPATEN LUWU TIMUR (DAFTAR  KELUARGA)

			PROVINSI :	SULAWESI SELATAN				NO. KK :	7324090803110001
			KABUPATEN :	LUWU TIMUR							NAMA. KK :	KURNIATI NURDIN
			KECAMATAN :	KALAENA									ALAMAT :	DSN. TAMBAK YOSO,Kodepos :92974,Telp :,-
			DESA :	KALAENA KIRI								NO.RT/RW :	001/001
		 */
		$data_keluarga = array();
		$baris = $i + 2;
		$data_keluarga['no_kk'] = trim($data_sheet[$baris][12]);
		// abaikan nama KK, karena ada di daftar anggota keluarga

		$alamat = $data_sheet[$baris + 2][12];
		$dusun = trim(substr($alamat, 0, strpos($alamat, ',', 0)));
		$data_keluarga['dusun'] = trim(preg_replace('/DSN.|DUSUN/', '', $dusun));
		$pos_telp = strpos($alamat, 'Telp :');
		if ($pos_telp !== false)
		{
			$telepon = trim(substr($alamat, $pos_telp));
			$data_keluarga['telepon'] = trim(preg_replace('/Telp :|,/', '', $telepon));
		}

		$rt_rw = trim($data_sheet[$baris + 3][12]);
		list($data_keluarga['rt'],$data_keluarga['rw']) = explode('/',$rt_rw);
		return $data_keluarga;
	}

	/**
	 * Ambil data anggota keluarga berikutnya
	 *
	 * @access	private
	 * @param		sheet		data excel berisi bip
	 * @param 	integer	cari dari baris ini
	 * @param 	array		data keluarga untuk anggota yg dicari
	 * @return	array 	data anggota keluarga
	 */
	private function get_bip_anggota_keluarga($data_sheet, $i, $data_keluarga)
	{
		/* $i = baris data anggota keluarga
		 * Contoh:
2		3									4								5		6					7						8			9			10					11
NO	NIK								NAMA						JK	TMPT LHR	TGL LHR			G.DRH	AGAMA	STATUS			HUB.KEL
1		7324097003830001	KURNIATI NURDIN	P		PARE-PARE	30-03-1983	O			Islam	Belum Kawin	Kepala Keluarga

12													13										14							15
PENDIDIKAN									PEKERJAAN							NAMA IBU				NAMA AYAH	KET
Akademi/Diploma III/S. Muda	Pegawai Negeri Sipil	HALIMAH					NURDIN
		*/
		$data_anggota = $data_keluarga;
		$data_anggota['nik'] = preg_replace('/[^0-9]/', '', trim($data_sheet[$i][3]));
		$data_anggota['nama'] = trim($data_sheet[$i][4]);
		$data_anggota['sex'] = $this->get_kode($this->kode_sex, trim($data_sheet[$i][5]));
		$data_anggota['tempatlahir'] = trim($data_sheet[$i][6]);
		$tanggallahir = trim($data_sheet[$i][7]);
		$data_anggota['tanggallahir'] = $this->format_tanggal($tanggallahir);
		$data_anggota['golongan_darah_id'] = $this->get_kode($this->kode_golongan_darah, strtolower(trim($data_sheet[$i][8])));
		if (empty($data_anggota['golongan_darah_id']) OR $data_anggota['golongan_darah_id'] == '-')
			$data_anggota['golongan_darah_id'] = 13;
		$data_anggota['agama_id'] = $this->get_kode($this->kode_agama, strtolower(trim($data_sheet[$i][9])));
		$data_anggota['status_kawin'] = $this->get_kode($this->kode_status, strtolower(trim($data_sheet[$i][10])));
		$data_anggota['kk_level'] = $this->get_kode($this->kode_hubungan, strtolower(trim($data_sheet[$i][11])));
		$data_anggota['pendidikan_kk_id'] = $this->get_kode($this->kode_pendidikan, strtolower(trim($data_sheet[$i][12])));
		$data_anggota['pekerjaan_id'] = $this->get_kode($this->kode_pekerjaan, strtolower(trim($data_sheet[$i][13])));
		$nama_ibu = trim($data_sheet[$i][14]);
		if ($nama_ibu == "")
		{
			$nama_ibu = "-";
		}
		$data_anggota['nama_ibu'] = $nama_ibu;
		$nama_ayah = trim($data_sheet[$i][15]);
		if ($nama_ayah == "")
		{
			$nama_ayah = "-";
		}
		$data_anggota['nama_ayah'] = $nama_ayah;

		// Isi kolom default
		$data_anggota['akta_lahir'] = "";
		$data_anggota['warganegara_id'] = "1";
		$data_anggota['pendidikan_sedang_id'] = "";

		return $data_anggota;
	}

	/**
	 * Proses impor data bip
	 *
	 * @access	public
	 * @param		sheet		data excel berisi bip
	 * @return	setting $_SESSION untuk info hasil impor
			$_SESSION['gagal']=						jumlah baris yang gagal
			$_SESSION['total_keluarga']=	jumlah keluarga yang diimpor
			$_SESSION['total_penduduk']=	jumlah penduduk yang diimpor
			$_SESSION['baris']=						daftar baris yang gagal
	 */
	function impor_data_bip($data)
	{
		$gagal_penduduk = 0;
		$baris_gagal = "";
		$total_keluarga = 0;
		$total_penduduk = 0;

		// BIP bisa terdiri dari beberapa worksheet
		// Proses sheet satu-per-satu
		for ($sheet_index=0; $sheet_index<count($data->boundsheets); $sheet_index++)
		{
			// membaca jumlah baris di sheet ini
			$baris = $data->rowcount($sheet_index);
			$data_sheet = $data->sheets[$sheet_index]['cells'];
			if ($this->cari_bip_kk($data_sheet, $baris, 1) < 1)
			{
				// Tidak ada data keluarga
				continue;
			}
			// Import data sheet ini mulai baris pertama
			for ($i=1; $i<=$baris; $i++)
			{
				// Cari keluarga berikutnya
				if (strpos($data_sheet[$i][2], 'BUKU INDUK KEPENDUDUKAN') !== 0) continue;
				// Proses keluarga
				$data_keluarga = $this->get_bip_keluarga($data_sheet, $i);
				$this->tulis_tweb_wil_clusterdesa($data_keluarga);
				$this->tulis_tweb_keluarga($data_keluarga);
				$total_keluarga++;
				// Pergi ke data anggota keluarga
				$i = $i + 8;
				// Proses setiap anggota keluarga
				while (trim($data_sheet[$i][2]) != '' AND $i <= $baris)
				{
					if (!is_numeric(trim($data_sheet[$i][2]))) break;
					$data_anggota = $this->get_bip_anggota_keluarga($data_sheet, $i, $data_keluarga);
					$error_validasi = $this->data_import_valid($data_anggota);
					if (empty($error_validasi))
					{
						$this->tulis_tweb_penduduk($data_anggota);
						$total_penduduk++;
					}
					else
					{
						$gagal_penduduk++;
						$baris_gagal .= $i." (".$error_validasi.")<br>";
					}
					$i++;
				}
				$i = $i - 1;
			}
		}

		if ($gagal_penduduk == 0)
			$baris_gagal = "tidak ada data yang gagal di import.";
		else $_SESSION['success'] = -1;

		$_SESSION['gagal'] = $gagal_penduduk;
		$_SESSION['total_keluarga'] = $total_keluarga;
		$_SESSION['total_penduduk'] = $total_penduduk;
		$_SESSION['baris'] = $baris_gagal;
	}

}
?>

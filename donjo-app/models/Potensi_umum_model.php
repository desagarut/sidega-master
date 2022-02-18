<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Potensi_umum_model extends CI_Model {
	
	protected $table = 'potensi_umum';

	const ENABLE = 1;
	const DISABLE = 0;

	const ORDER_ABLE = [
		2  => 'p.bulan_laporan',
		3  => 'p.tahun_laporan',
		4  => 'p.tahun_pembentukan',
		5  => 'p.luas_desa',
		6  => 'p.nama_kepala',
		7  => 'p.batas_desa_utara',
		8  => 'p.batas_desa_selatan',
		9  => 'p.batas_desa_timur',
		10  => 'p.batas_desa_barat',
		12  => 'p.penetapan_batas',
		13  => 'p.no_perdes',
		14  => 'p.no_perda',
	];

	public function get_data(string $search = '', $tahun_laporan = '')
	{
		$builder = $this->db->select([
			'p.*',
			"(CASE WHEN p.id_lokasi IS NOT NULL THEN CONCAT(
				(CASE WHEN w.rt != '0' THEN CONCAT('RT ', w.rt, ' / ') ELSE '' END),
				(CASE WHEN w.rw != '0' THEN CONCAT('RW ', w.rw, ' - ') ELSE '' END),
				w.dusun
			) ELSE p.lokasi END) AS alamat",
			'(CASE WHEN MAX(CAST(d.judul as UNSIGNED INTEGER)) IS NOT NULL THEN CONCAT(MAX(CAST(d.judul as UNSIGNED INTEGER)), "%") ELSE CONCAT("belum ada progres") END) AS max_persentase',
		])
		->from("{$this->table} p")
		->join('potensi_umum_dokumentasi d', 'd.id_potensi = p.id', 'left')
		->join('tweb_wil_clusterdesa w', 'p.id_lokasi = w.id', 'left')
		->group_by('p.id');

		if (empty($search))
		{
			$search = $builder;
		}
		else
		{
			$search = $builder->group_start()
				->like('p.bulan_laporan', $search)
				->or_like('p.tahun_laporan', $search)
				->or_like('p.tahun_pembentukan', $search)
				->or_like('p.nama_kepala', $search)
				->or_like('p.luas_desa', $search)
				->or_like('p.nama_kepala', $search)
				->group_end();
		}

		$condition = $tahun_laporan === 'semua'
			? $search
			: $search->where('p.tahun_laporan', $tahun_laporan);

		return $condition;
	}

	public function list_lokasi_kantor_desa()
	{
		$data = $this->db->select([
			'p.*',
			"(CASE WHEN p.id_lokasi IS NOT NULL THEN CONCAT(
				(CASE WHEN w.rt != '0' THEN CONCAT('RT ', w.rt, ' / ') ELSE '' END),
				(CASE WHEN w.rw != '0' THEN CONCAT('RW ', w.rw, ' - ') ELSE '' END),
				w.dusun
			) ELSE p.lokasi END) AS alamat",
		])
		->from('potensi_umum p')
		->where('p.status = 1')
		->join('tweb_wil_clusterdesa w', 'p.id_lokasi = w.id', 'left')
		->get()
		->result();

		return $data;
	}

	public function insert()
	{
		$post = $this->input->post();

		$data['tahun_laporan']     	= $post['tahun_laporan'];
		$data['luas_desa']        	= $post['luas_desa'];
		$data['bulan_laporan']      = $post['bulan_laporan'];
		$data['tahun_pembentukan']             = $post['tahun_pembentukan'];
		$data['nama_kepala']		= $post['nama_kepala'];
		$data['nama_pengisi']     			= $post['nama_pengisi'];
		$data['pekerjaan_pengisi']     			= $post['pekerjaan_pengisi'];
		$data['jabatan_pengisi']     			= $post['jabatan_pengisi'];
		$data['luas_desa']         = $post['luas_desa'];
		$data['batas_desa_utara']         = $post['batas_desa_utara'];
		$data['batas_desa_selatan']         = $post['batas_desa_selatan'];
		$data['batas_desa_timur']         = $post['batas_desa_timur'];
		$data['batas_desa_barat']         = $post['batas_desa_barat'];
		$data['batas_kec_utara']         = $post['batas_kec_utara'];
		$data['batas_kec_selatan']         = $post['batas_kec_selatan'];
		$data['batas_kec_timur']         = $post['batas_kec_timur'];
		$data['batas_kec_barat']         = $post['batas_kec_barat'];
		$data['penetapan_batas']         = $post['penetapan_batas'];
		$data['no_perdes']         = $post['no_perdes'];
		$data['no_perda']         = $post['no_perda'];
		$data['peta_wilayah']         = $post['peta_wilayah'];
		$data['ref1']         = $post['ref1'];
		$data['ref2']         = $post['ref2'];
		$data['ref3']         = $post['ref3'];
		$data['ref4']         = $post['ref4'];
		$data['lat']         = $post['lat'];
		$data['lng']         = $post['lng'];
		$data['keterangan']         = $post['keterangan'];
		$data['id_lokasi']          = $post['id_lokasi'] ?: null;
		$data['lokasi']             = $post['lokasi'] ?: null;
		
		$data['created_at']         = date('Y-m-d H:i:s');
		$data['created_by']         = $post['created_by'];
		$data['updated_at']         = date('Y-m-d H:i:s');
		$data['updated_by']         = $post['updated_by'];
		$data['foto'] 						  = $this->upload_gambar('foto');
		
		

		if (empty($data['foto'])) unset($data['foto']);

		unset($data['file_foto']);
		unset($data['old_foto']);

		$outp = $this->db->insert('potensi_umum', $data);

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}

	public function update($id=0)
	{
		$post = $this->input->post();

		$data['tahun_laporan']     	= $post['tahun_laporan'];
		$data['luas_desa']        	= $post['luas_desa'];
		$data['bulan_laporan']      = $post['bulan_laporan'];
		$data['tahun_pembentukan']             = $post['tahun_pembentukan'];
		$data['nama_kepala']		= $post['nama_kepala'];
		$data['nama_pengisi']     			= $post['nama_pengisi'];
		$data['pekerjaan_pengisi']     			= $post['pekerjaan_pengisi'];
		$data['jabatan_pengisi']     			= $post['jabatan_pengisi'];
		$data['luas_desa']         = $post['luas_desa'];
		$data['batas_desa_utara']         = $post['batas_desa_utara'];
		$data['batas_desa_selatan']         = $post['batas_desa_selatan'];
		$data['batas_desa_timur']         = $post['batas_desa_timur'];
		$data['batas_desa_barat']         = $post['batas_desa_barat'];
		$data['batas_kec_utara']         = $post['batas_kec_utara'];
		$data['batas_kec_selatan']         = $post['batas_kec_selatan'];
		$data['batas_kec_timur']         = $post['batas_kec_timur'];
		$data['batas_kec_barat']         = $post['batas_kec_barat'];
		$data['penetapan_batas']         = $post['penetapan_batas'];
		$data['no_perdes']         = $post['no_perdes'];
		$data['no_perda']         = $post['no_perda'];
		$data['peta_wilayah']         = $post['peta_wilayah'];
		$data['ref1']         = $post['ref1'];
		$data['ref2']         = $post['ref2'];
		$data['ref3']         = $post['ref3'];
		$data['ref4']         = $post['ref4'];
		$data['lat']         = $post['lat'];
		$data['lng']         = $post['lng'];
		$data['keterangan']         = $post['keterangan'];
		$data['id_lokasi']          = $post['id_lokasi'] ?: null;
		$data['lokasi']             = $post['lokasi'] ?: null;
		
		$data['created_at']         = date('Y-m-d H:i:s');
		$data['created_by']         = $post['created_by'];
		$data['updated_at']         = date('Y-m-d H:i:s');
		$data['updated_by']         = $post['updated_by'];
		$data['foto'] 						  = $this->upload_gambar('foto');
		

		if (empty($data['foto'])) unset($data['foto']);

		unset($data['file_foto']);
		unset($data['old_foto']);

		$this->db->where('id', $id);
		$outp = $this->db->update('potensi_umum', $data);

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}

	private function upload_gambar($jenis)
	{
		$this->load->library('upload');
		$this->uploadConfig = array(
			'upload_path' => LOKASI_GALERI,
			'allowed_types' => 'gif|jpg|jpeg|png',
			'max_size' => max_upload() * 1024,
		);
		// Adakah berkas yang disertakan?
		$adaBerkas = !empty($_FILES[$jenis]['name']);
		if ($adaBerkas !== TRUE)
		{
			return NULL;
		}
		// Tes tidak berisi script PHP
		if (isPHP($_FILES['logo']['tmp_name'], $_FILES[$jenis]['name']))

		{
			$_SESSION['error_msg'] .= " -> Jenis file ini tidak diperbolehkan ";
			$_SESSION['success'] = -1;
			redirect('potensi_umum');
		}

		$uploadData = NULL;
		// Inisialisasi library 'upload'
		$this->upload->initialize($this->uploadConfig);
		// Upload sukses
		if ($this->upload->do_upload($jenis))
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
			$_SESSION['success'] = -1;
			$_SESSION['error_msg'] = $this->upload->display_errors(NULL, NULL);
		}
		return (!empty($uploadData)) ? $uploadData['file_name'] : NULL;
	}

	public function update_lokasi_maps($id, array $request)
	{
		return $this->db->where('id', $id)->update($this->table, [
			'lat'        => $request['lat'],
			'lng'        => $request['lng'],
			'updated_at' => date('Y-m-d H:i:s'),
		]);
	}

	public function delete($id)
	{
		return $this->db->where('id', $id)->delete($this->table);
	}

	public function find($id)
	{
		return $this->db->select([
			'p.*',
			"(CASE WHEN p.id_lokasi IS NOT NULL THEN CONCAT(
				(CASE WHEN w.rt != '0' THEN CONCAT('RT ', w.rt, ' / ') ELSE '' END),
				(CASE WHEN w.rw != '0' THEN CONCAT('RW ', w.rw, ' - ') ELSE '' END),
				w.dusun
			) ELSE p.lokasi END) AS alamat",
		])
		->from("{$this->table} p")
		->join('tweb_wil_clusterdesa w', 'p.id_lokasi = w.id', 'left')
		->where('p.id', $id)
		->get()
		->row();
	}

	public function list_filter_tahun()
	{
		return $this->db->select('tahun_laporan')
			->distinct()
			->order_by('tahun_laporan', 'desc')
			->get($this->table)
			->result();
	}

	public function unlock($id)
	{
		return $this->db->set('status', static::ENABLE)
			->where('id', $id)
			->update($this->table);
	}

	public function lock($id)
	{
		return $this->db->set('status', static::DISABLE)
			->where('id', $id)
			->update($this->table);
	}
}

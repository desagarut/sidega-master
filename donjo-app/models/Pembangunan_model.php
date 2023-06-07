<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan_model extends CI_Model
{
	protected $table = 'pembangunan';

	const ENABLE = 1;
	const DISABLE = 0;

	const ORDER_ABLE = [
		2  => 'p.judul',
		3  => 'p.sumber_dana',
		4  => 'p.anggaran',
		5  => 'max_persentase',
		6  => 'p.volume',
		7  => 'p.tahun_anggaran',
		8  => 'p.pelaksana_kegiatan',
		9  => 'alamat',
		10 => 'p.keterangan',
	];

	public function get_data(string $search = '', $tahun = '')
	{
		$builder = $this->db->select([
			'p.*',
			"(CASE WHEN p.id_lokasi IS NOT NULL THEN CONCAT(
				(CASE WHEN w.rt != '0' THEN CONCAT('RT ', w.rt, ' / ') ELSE '' END),
				(CASE WHEN w.rw != '0' THEN CONCAT('RW ', w.rw, ' - ') ELSE '' END),
				w.dusun
			) ELSE p.lokasi END) AS alamat",
			'(CASE WHEN MAX(CAST(d.persentase as UNSIGNED INTEGER)) IS NOT NULL THEN CONCAT(MAX(CAST(d.persentase as UNSIGNED INTEGER)), "%") ELSE CONCAT("belum ada progres") END) AS max_persentase',
		])
		->from("{$this->table} p")
		->join('pembangunan_ref_dokumentasi d', 'd.id_pembangunan = p.id', 'left')
		->join('tweb_wil_clusterdesa w', 'p.id_lokasi = w.id', 'left')
		->group_by('p.id');

		if (empty($search))
		{
			$search = $builder;
		}
		else
		{
			$search = $builder->group_start()
				->like('p.sumber_dana', $search)
				->or_like('p.judul', $search)
				->or_like('p.keterangan', $search)
				->or_like('p.volume', $search)
				->or_like('p.tahun_anggaran', $search)
				->or_like('p.pelaksana_kegiatan', $search)
				->or_like('p.lokasi', $search)
				->or_like('p.anggaran', $search)
				->group_end();
		}

		$condition = $tahun === 'semua'
			? $search
			: $search->where('p.tahun_anggaran', $tahun);

		return $condition;
	}

	public function list_lokasi_pembangunan()
	{
		$data = $this->db->select([
			'p.*',
			"(CASE WHEN p.id_lokasi IS NOT NULL THEN CONCAT(
				(CASE WHEN w.rt != '0' THEN CONCAT('RT ', w.rt, ' / ') ELSE '' END),
				(CASE WHEN w.rw != '0' THEN CONCAT('RW ', w.rw, ' - ') ELSE '' END),
				w.dusun
			) ELSE p.lokasi END) AS alamat",
		])
		->from('pembangunan p')
		->where('p.status = 1')
		->join('tweb_wil_clusterdesa w', 'p.id_lokasi = w.id', 'left')
		->get()
		->result();

		return $data;
	}

	public function insert()
	{
		$post = $this->input->post();

		$data['sumber_dana']        = $post['sumber_dana'];
		$data['judul']              = $post['judul'];
		$data['volume']             = $post['volume'];
		$data['tahun_anggaran']     = $post['tahun_anggaran'];
		$data['pelaksana_kegiatan'] = $post['pelaksana_kegiatan'];
		$data['id_lokasi']          = $post['id_lokasi'] ?: null;
		$data['lokasi']             = $post['lokasi'] ?: null;
		$data['keterangan']         = $post['keterangan'];
		$data['created_at']         = date('Y-m-d H:i:s');
		$data['updated_at']         = date('Y-m-d H:i:s');
		$data['foto'] 						  = $this->upload_gambar_pembangunan('foto');
		$data['anggaran']     			= $post['anggaran'];

		if (empty($data['foto'])) unset($data['foto']);

		unset($data['file_foto']);
		unset($data['old_foto']);

		$outp = $this->db->insert('pembangunan', $data);

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}

	public function update($id=0)
	{
		$post = $this->input->post();

		$data['sumber_dana']        = $post['sumber_dana'];
		$data['judul']              = $post['judul'];
		$data['volume']             = $post['volume'];
		$data['tahun_anggaran']     = $post['tahun_anggaran'];
		$data['pelaksana_kegiatan'] = $post['pelaksana_kegiatan'];
		$data['id_lokasi']          = $post['id_lokasi'] ?: null;
		$data['lokasi']             = $post['lokasi'] ?: null;
		$data['keterangan']         = $post['keterangan'];
		$data['created_at']         = date('Y-m-d H:i:s');
		$data['updated_at']         = date('Y-m-d H:i:s');
		$data['foto'] 						  = $this->upload_gambar_pembangunan('foto');
		$data['anggaran']     			= $post['anggaran'];

		if (empty($data['foto'])) unset($data['foto']);

		unset($data['file_foto']);
		unset($data['old_foto']);

		$this->db->where('id', $id);
		$outp = $this->db->update('pembangunan', $data);

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}

	private function upload_gambar_pembangunan($jenis)
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
			redirect('identitas_desa');
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
		return $this->db->select('tahun_anggaran')
			->distinct()
			->order_by('tahun_anggaran', 'desc')
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

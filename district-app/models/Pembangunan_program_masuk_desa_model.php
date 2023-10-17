<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pembangunan_program_masuk_desa_model extends CI_Model
{
	protected $table = 'tbl_pembangunan_program_masuk_desa';

	const ENABLE = 1;
	const DISABLE = 0;

	const ORDER_ABLE = [
		1  => 'p.status',
		2  => 'p.tahun',
		3  => 'p.dusun',
		4  => 'p.bidang_desa',
		5  => 'p.tahun_pelaksanaan',
		6  => 'p.nama_program_kegiatan',
		7  => 'p.sdgs_ke',
		8  => 'p.lokasi',
		9  => 'p.sumber_dana',
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
		])
			->from("{$this->table} p")
			->join('tweb_wil_clusterdesa w', 'p.id_lokasi = w.id', 'left')
			->group_by('p.id');

		if (empty($search)) {
			$search = $builder;
		} else {
			$search = $builder->group_start()
				->like('p.tahun', $search)
				->or_like('p.dusun', $search)
				->or_like('p.bidang_desa', $search)
				->or_like('p.tahun_pelaksanaan', $search)
				->or_like('p.nama_program_kegiatan', $search)
				->or_like('p.sdgs_ke', $search)
				->or_like('p.lokasi', $search)
				->or_like('p.sumber_dana', $search)
				->group_end();
		}

		$condition = $tahun === 'semua'
			? $search
			: $search->where('p.tahun', $tahun);

		return $condition;
	}


	public function get_data_usulan(string $search = '', $tahun = '')
	{
		$builder = $this->db->select([
			'p.*',
			"(CASE WHEN p.id_lokasi IS NOT NULL THEN CONCAT(
				(CASE WHEN w.rt != '0' THEN CONCAT('RT ', w.rt, ' / ') ELSE '' END),
				(CASE WHEN w.rw != '0' THEN CONCAT('RW ', w.rw, ' - ') ELSE '' END),
				w.dusun
			) ELSE p.lokasi END) AS alamat",
		])
			->from("{$this->table} p")
			->where('p.status_usulan = 1')
			->join('tweb_wil_clusterdesa w', 'p.id_lokasi = w.id', 'left')
			->group_by('p.id');

		if (empty($search)) {
			$search = $builder;
		} else {
			$search = $builder->group_start()
				->like('p.tahun', $search)
				->or_like('p.dusun', $search)
				->or_like('p.bidang_desa', $search)
				->or_like('p.tahun_pelaksanaan', $search)
				->or_like('p.nama_program_kegiatan', $search)
				->or_like('p.sdgs_ke', $search)
				->or_like('p.lokasi', $search)
				->or_like('p.sumber_dana', $search)
				->group_end();
		}

		$condition = $tahun === 'semua'
			? $search
			: $search->where('p.tahun', $tahun);

		return $condition;
	}


	public function list_lokasi_program()
	{
		$data = $this->db->select([
			'p.*',
			"(CASE WHEN p.id_lokasi IS NOT NULL THEN CONCAT(
				(CASE WHEN w.rt != '0' THEN CONCAT('RT ', w.rt, ' / ') ELSE '' END),
				(CASE WHEN w.rw != '0' THEN CONCAT('RW ', w.rw, ' - ') ELSE '' END),
				(CASE WHEN w.dusun != '0' THEN CONCAT('Dusun ', w.rw, ' - ') ELSE '' END),
				w.dusun
			) ELSE p.lokasi END) AS alamat",
		])
			->from('tbl_pembangunan_program_masuk_desa p')
			->where('p.status = 1')
			->join('tweb_wil_clusterdesa w', 'p.id_lokasi = w.id', 'left')
			->get()
			->result();

		return $data;
	}

	public function insert()
	{
		$post = $this->input->post();

		$data['tahun']       					= $post['tahun'];
		$data['dusun']              			= $post['dusun'];
		$data['bidang_desa']             		= $post['bidang_desa'];
		$data['nama_program_kegiatan'] 			= $post['nama_program_kegiatan'];
		$data['sumber_dana']             		= $post['sumber_dana'] ?: null;
		$data['sdgs_ke']          				= $post['sdgs_ke'];
		$data['tahun_pelaksanaan']             	= $post['tahun_pelaksanaan'];
		$data['lokasi']             			= $post['lokasi'] ?: null;
		$data['volume']             			= $post['volume'];
		$data['satuan']             			= $post['satuan'];
		$data['anggaran']     					= $post['anggaran'];
		$data['status']             			= $post['status'] ?: null;

		$data['created_at']         = date('Y-m-d H:i:s');
		$data['updated_at']         = date('Y-m-d H:i:s');

		$outp = $this->db->insert('tbl_pembangunan_program_masuk_desa', $data);

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}

	public function update($id = 0)
	{
		$post = $this->input->post();

		$data['tahun']       					= $post['tahun'];
		$data['dusun']              				= $post['dusun'];
		$data['bidang_desa']             		= $post['bidang_desa'];
		$data['nama_program_kegiatan'] 			= $post['nama_program_kegiatan'];
		$data['sumber_dana']             		= $post['sumber_dana'] ?: null;
		$data['sdgs_ke']          				= $post['sdgs_ke'];
		$data['tahun_pelaksanaan']             	= $post['tahun_pelaksanaan'];
		$data['lokasi']             			= $post['lokasi'] ?: null;
		$data['volume']             			= $post['volume'];
		$data['satuan']             			= $post['satuan'];
		$data['anggaran']     					= $post['anggaran'];
		$data['status']             			= $post['status'] ?: null;

		$data['id_lokasi']         				= $post['id_lokasi'];
		$data['created_at']         = date('Y-m-d H:i:s');
		$data['updated_at']         = date('Y-m-d H:i:s');

		if (empty($data['foto'])) unset($data['foto']);

		$this->db->where('id', $id);
		$outp = $this->db->update('tbl_pembangunan_program_masuk_desa', $data);

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
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
		return $this->db->select('tahun')
			->distinct()
			->order_by('tahun', 'desc')
			->get($this->table)
			->result();
	}
}

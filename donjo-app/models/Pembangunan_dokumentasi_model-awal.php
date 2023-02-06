<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pembangunan_dokumentasi_model extends CI_Model
{
	protected $table = 'pembangunan_ref_dokumentasi';

	const ORDER_ABLE = [
		3 => 'CAST(d.persentase as UNSIGNED INTEGER)',
		4 => 'd.keterangan',
		5 => 'd.created_at',
	];

	public function get_data($id, string $search = '')
	{
		$builder = $this->db->select([
			'd.*',
		])
		->from("{$this->table} d")
		->join('pembangunan p', 'd.id_pembangunan = p.id')
		->where('d.id_pembangunan', $id);

		if (empty($search))
		{
			$condition = $builder;
		}
		else
		{
			$condition = $builder->group_start()
				->like('d.keterangan', $search)
				->or_like('keterangan', $search)
				->group_end();
		}

		return $condition;
	}

	public function insert($id_pembangunan = 0)
	{
		$post = $this->input->post();

		$data['id_pembangunan'] = $id_pembangunan;
		$data['gambar']         = $this->upload_gambar_pembangunan('gambar');
		$data['persentase']     = $post['persentase'] ? $post['persentase'] : $post['id_persentase'];
		$data['keterangan']     = $post['keterangan'];
		$data['created_at']     = date('Y-m-d H:i:s');
		$data['updated_at']     = date('Y-m-d H:i:s');

		if (empty($data['gambar'])) unset($data['gambar']);

		unset($data['file_gambar']);
		unset($data['old_gambar']);

		$outp = $this->db->insert('pembangunan_ref_dokumentasi', $data);

		if ($outp) $_SESSION['success'] = 1;
		else $_SESSION['success'] = -1;
	}

	public function update($id = 0, $id_pembangunan = 0)
	{
		$post = $this->input->post();

		$data['id_pembangunan'] = $id_pembangunan;
		$data['gambar']         = $this->upload_gambar_pembangunan('gambar');
		$data['persentase']     = $post['persentase'] ? $post['persentase'] : $post['id_persentase'];
		$data['keterangan']     = $post['keterangan'];
		$data['created_at']     = date('Y-m-d H:i:s');
		$data['updated_at']     = date('Y-m-d H:i:s');

		if (empty($data['gambar'])) unset($data['gambar']);

		unset($data['file_gambar']);
		unset($data['old_gambar']);

		$this->db->where('id', $id);
		$outp = $this->db->update('pembangunan_ref_dokumentasi', $data);

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

	public function delete($id)
	{
		return $this->db->where('id', $id)->delete($this->table);
	}

	public function find($id)
	{
		return $this->db->where('id', $id)
			->get($this->table)
			->row();
	}

	public function find_dokumentasi($id_pembangunan)
	{
		return $this->db->where('id_pembangunan', $id_pembangunan)
			->order_by('CAST(persentase as UNSIGNED INTEGER)')
			->get($this->table)
			->result();
	}
}

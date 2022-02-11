<?php
class Web_rumah_model extends MY_Model {

	// Untuk datatables informasi publik
	var $table = 'rumah';
	var $column_order = array(null, 'nama','tahun', 'kategori_info_publik', 'tgl_upload'); //set column field database for datatable orderable
	var $column_search = array('nama'); //set column field database for datatable searchable
	var $order = array('id' => 'asc'); // default order


	public function __construct()
	{
		parent::__construct();
		$this->load->model('referensi_model');
	}

	public function autocomplete()
	{
		return $this->autocomplete_str('nama', 'rumah');
	}


	// Lists Tahun rumah untuk web first
	public function tahun_rumah()
	{
		$this->db->select('tahun');
		$this->db->group_by('tahun');
		$res = $this->db->from($this->table)->get()->result_array();
		return $res;
	}


	public function paging($kat, $p=1, $o=0)
	{
		$this->list_data_sql($kat);
		$jml_data = $this->db
			->select('COUNT(*) as jml')
			->get()->row()->jml;

		$this->load->library('paging');
		$cfg['page'] = $p;
		$cfg['per_page'] = $_SESSION['per_page'];
		$cfg['num_rows'] = $jml_data;
		$this->paging->init($cfg);

		return $this->paging;
	}

	function list_data($kat, $o=0, $offset=0, $limit=500)
	{
		$this->list_data_sql($kat);
		switch ($o)
		{
			case 1: $order = ' nama'; break;
			case 2: $order = ' nama DESC'; break;
			case 3: $order = ' enabled'; break;
			case 4: $order = ' enabled DESC'; break;
			case 5: $order = ' tgl_upload'; break;
			case 6: $order = ' tgl_upload DESC'; break;
			default:$order = ' id';
		}
		$data = $this->db
			->select('*')
			->order_by($order)
			->limit($limit, $offset)
			->get()
			->result_array();

		$j = $offset;
		for ($i=0; $i<count($data); $i++)
		{
			$data[$i]['no'] = $j + 1;
			$data[$i]['attr'] = json_decode($data[$i]['attr'], true);
		}
		return $data;
	}

	private function semua_mime_type()
	{
		$semua_mime_type = array_merge(unserialize(MIME_TYPE_RUMAH), unserialize(MIME_TYPE_GAMBAR), unserialize(MIME_TYPE_ARSIP));
		$semua_mime_type = array_diff($semua_mime_type, array('application/octet-stream'));
		return $semua_mime_type;
	}

	private function semua_ext()
	{
		$semua_ext = array_merge(unserialize(EXT_RUMAH), unserialize(EXT_GAMBAR), unserialize(EXT_ARSIP));
		return $semua_ext;
	}

	private function upload_rumah($data, $file_lama="")
	{
		$_SESSION['error_msg'] = "";
		$_SESSION['success'] = 1;
		unset($data['old_file']);
		if (empty($_FILES['satuan']['tmp_name']) or (int)$_FILES['satuan']['size'] > convertToBytes(max_upload().'MB'))
		{
			$_SESSION['success'] = -1;
			$_SESSION['error_msg'] .= ' -> Error upload file. Periksa apakah melebihi ukuran maksimum';
			return null;
		}

		$lokasi_file = $_FILES['satuan']['tmp_name'];
		if (empty($lokasi_file))
		{
			$_SESSION['success'] = -1;
			return null;
		}
		if (function_exists('finfo_open'))
		{
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$tipe_file = finfo_file($finfo, $lokasi_file);
		}
		else
			$tipe_file = $_FILES['satuan']['type'];
		$nama_file = $_FILES['satuan']['name'];
		$nama_file = str_replace(' ', '-', $nama_file); 	 // normalkan nama file
		$ext = get_extension($nama_file);

		if (!in_array($tipe_file, $this->semua_mime_type()) OR !in_array($ext, $this->semua_ext()))
		{
			$_SESSION['error_msg'] .= " -> Jenis file salah: " . $tipe_file . " " . $ext;
			$_SESSION['success'] = -1;
			return null;
		}
		elseif (isPHP($lokasi_file, $nama_file))
		{
			$_SESSION['error_msg'].= " -> File berisi script ";
			$_SESSION['success']=-1;
			return null;
		}

		$nama = $data['nama'];
		if (!empty($data['id_pend']))
			$nama_file = $data['id_pend']."_".$nama."_".generator(6)."_".$nama_file;
		else
			$nama_file = $nama."_".generator(6)."_".$nama_file;
		$nama_file = bersihkan_namafile($nama_file);
		UploadDocument($nama_file, $file_lama);
		return $nama_file;
	}

	public function insert($mandiri=false)
	{
		$retval = true;
		$post = $this->input->post();
		$data = $this->validasi($post);
		if (!empty($post['satuan'])) $data['satuan'] = $this->upload_rumah($post);
		$data['attr'] = json_encode($data['attr']);
		$data['rumah_penduduk'] = isset($post['rumah_penduduk']);
		// Dari layanan mandiri gunakan NIK penduduk
		$data['created_by'] = $mandiri ? $this->session->nik : $this->session->user;

		unset($data['anggota_kk']);
		$retval &= $this->db->insert('rumah', $data);
		$insert_id = $this->db->insert_id();

		if ($retval)
		{
			$data['id_parent'] = $insert_id;
			foreach ($post['anggota_kk'] as $key => $value)
			{
				$data['id_pend'] = $value;
				$retval &= $this->db->insert('rumah', $data);
			}
		}
		return $retval;
	}

	private function validasi($post)
	{
		$data = array();
		$data['nama'] = $post['nama'];
		$data['kategori'] = $post['kategori'] ?: 1;
		$data['kategori_info_publik'] = $post['kategori_info_publik'] ?: null;
		$data['id_pend'] = $post['id_pend'] ?: 0;
		return $data;
	}

	// $mandiri = true kalau dipanggil dari layanan mandiri
	public function update($id=0, $id_pend=null, $mandiri=false)
	{
		$retval = true;

		$post = $this->input->post();
		$data = $this->validasi($post);
		// Jangan simpan rumah_penduduk kalau dari Layanan Mandiri
		if (!$mandiri) !$data['rumah_penduduk'] = isset($post['rumah_penduduk']);
		$old_file = $this->db->select('satuan')
				->where('id', $id)
				->get('rumah')->row()->satuan;
		$data['satuan'] = $old_file;
		if (!empty($post['satuan']))
		{
			$data['satuan'] = $this->upload_rumah($post, $old_file);
			$retval &= !(empty($data['satuan']));
			if (!$retval) return $retval;
		}
		$data['attr'] = json_encode($data['attr']);
		$data['updated_at'] = date('Y-m-d H:i:s');
		// Dari layanan mandiri gunakan NIK penduduk
		$data['updated_by'] = $mandiri ? $this->session->nik : $this->session->user;

		unset($data['anggota_kk']);

		if ($id_pend) $this->db->where('id_pend', $id_pend);
		$retval &= $this->db->where('id',$id)->update('rumah', $data);

		$retval &= $this->update_dok_anggota($id, $post, $data);

		status_sukses($retval);
		return $retval;
	}

	private function update_dok_anggota($id, $post, $data)
	{
		$retval = true;

		// cek jika rumah ini juga ada di anggota yang lain
		$anggota_kk = $post['anggota_kk'];
		$anggota_lain = array_column($this->get_rumah_di_anggota_lain($id), 'id_pend');

		// cari intersect anggota
		unset($data['id_pend']);
		$intersect_id_pend = array_intersect($anggota_kk, $anggota_lain);
		foreach ($intersect_id_pend as $key => $value)
		{
			$this->db->where('id_pend',$value);
			$this->db->where('id_parent',$id);
			$retval &= $this->db->update('rumah', $data);
		}

		// cari diff anggota (jika ada anggota yang diuncheck - delete)
		if (isset($anggota_kk))
		{
			$diff_id_pend = array_diff($anggota_lain, $anggota_kk);
			foreach ($diff_id_pend as $key => $value)
				$retval &= $this->db->delete('rumah', array('id_pend' => $value, 'id_parent' => $id));  // hard delete
		}
		else
		{
			foreach ($anggota_lain as $key => $value)
				$retval &= $this->db->delete('rumah', array('id_pend' => $value, 'id_parent' => $id));  // hard delete
		}

		// cari diff anggota (jika ada anggota tambahan yang dicheck -> insert)
		$diff_id_pend = array_diff($anggota_kk, $anggota_lain);
		if (isset($diff_id_pend))
		{
			unset($data['updated_at']);

			foreach ($diff_id_pend as $key => $value)
			{
				$data["id_pend"] = $value;
				$data["id_parent"] = $id;
				$retval &= $this->db->insert('rumah', $data);	// insert new data
			}
		}
		return $retval;
	}

	// Soft delete, tapi hapus berkas rumah
	public function delete($id='', $semua=false)
	{
		if (!$semua) $this->session->success = 1;

		$old_rumah = $this->db->select('satuan')->
			where('id',$id)->
			get('rumah')->row()->satuan;
		$data = array(
			'updated_at' => date('Y-m-d H:i:s'),
			'deleted' => 1
		);
		$outp = $this->db->where('id', $id)->update('rumah', $data);
		if ($outp)
			unlink(LOKASI_RUMAH . $old_rumah);
		else $_SESSION['success'] = -1;

		// cek jika rumah ini juga ada di anggota yang lain
		$anggota_lain = $this->get_rumah_di_anggota_lain($id);
		// soft delete rumah anggota lain jika ada
		foreach ($anggota_lain as $item)
			$this->db->where('id', $item['id'])->update('rumah', $data);
	}

	public function hard_delete_rumah_bersama($id_pend)
	{
		$this->db->delete('rumah', array('id_pend' => $id_pend, 'id_parent >' => '0'));
	}

	public function delete_all()
	{
		$this->session->success = 1;

		$id_cb = $_POST['id_cb'];
		foreach ($id_cb as $id)
		{
			$this->delete($id, $semua=true);
		}
	}

	public function get_rumah($id=0, $id_pend=null)
	{
		if ($id_pend) $this->db->where('id_pend', $id_pend);
		$data = $this->db->from($this->table)
			->where('id', $id)
			->get()->row_array();
		$data['attr'] = json_decode($data['attr'], true);
		$data = array_filter($data);

		return $data;
	}

	public function get_rumah_di_anggota_lain($id_rumah=0)
	{
		$data = $this->db->from($this->table)
			->where('id_parent', $id_rumah)
			->get()->result_array();

		foreach ($data as $key => $value) {
			$data[$key]['attr'] = json_decode($data[$key]['attr'], true);
			$data[$key] = array_filter($data[$key]);
		}

		return $data;
	}


	/**
	 * Ambil nama berkas dari database berdasarkan id rumah
	 * @param  string       $id  			Id pada tabel rumah
	 * @return  string|NULL
	 */
	public function get_nama_berkas($id, $id_pend=0)
	{
		// Ambil nama berkas dari database untuk rumah yg aktif
		if ($id_pend) $this->db->where('id_pend', $id_pend);
		$nama_berkas = $this->db->select('satuan')
			->where('id', $id)
			->where('enabled', 1)
			->get('rumah')->row()->satuan;
		return $nama_berkas;
	}


	// Semua informasi publik diekspor termasuk yg tidak aktif dan yg telah dihapus
	private function ekspor_semua_data()
	{
		// Hanya data yg 'hidup'
		$data = $this->db->select("'0' as aksi")
			->from($this->table)
			->where('id_pend', '0')
			->order_by('id')
			->get()->result_array();
		return $data;
	}

	/*
		aksi:
		1 - tambah baru
		2 - berubah
		3 - dihapus
	*/
	private function ekspor_perubahan_data($tgl_dari)
	{
		$this->db->select("
			(CASE when deleted = 1
				then '3'
				else
					case when DATE(tgl_upload) > STR_TO_DATE('{$tgl_dari}', '%d-%m-%Y')
						then '1'
						else '2'
					end
				end) as aksi
		");
		// Termasuk data yg sudah dihapus
		$data = $this->db->from('rumah')
			->where('id_pend', '0')
			->where("DATE(updated_at) > STR_TO_DATE('{$tgl_dari}', '%d-%m-%Y')")
			->order_by('id')
			->get()->result_array();
		return $data;
	}

}
?>

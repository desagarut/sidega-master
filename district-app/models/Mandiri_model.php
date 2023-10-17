<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mandiri_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function autocomplete()
	{
		$data = $this->db
			->select('p.nama')
			->from('tweb_penduduk_mandiri pm')
			->join('penduduk_hidup p', 'p.id = pm.id_pend', 'left')
			->get()
			->result_array();

		return autocomplete_data_ke_str($data);
	}

	private function search_sql()
	{
		$cari = $this->session->cari;
		if ($cari) {
			$cari = $this->db->escape_like_str($cari);
			$this->db
				->group_start()
				->like('p.nik', $cari)
				->or_like('p.nama', $cari)
				->group_end();
		}
	}

	public function paging($p)
	{
		$this->db->select('COUNT(pm.id_pend) AS jml');
		$this->list_data_sql();

		$row = $this->db->get()->row_array();

		$this->load->library('paging');
		$cfg['page'] = $p;
		$cfg['per_page'] = $this->session->per_page;
		$cfg['num_rows'] = $row['jml'];
		$this->paging->init($cfg);

		return $this->paging;
	}

	private function list_data_sql()
	{
		$this->db
			->from('tweb_penduduk_mandiri pm')
			->join('penduduk_hidup p', 'pm.id_pend = p.id', 'LEFT');

		$this->search_sql();
	}

	public function list_data($o = 0, $offset = 0, $limit = 500)
	{
		$this->db->select('pm.*, p.nama, p.nik, p.telepon');

		$this->list_data_sql();

		switch ($o) {
			case 1:
				$this->db->order_by('p.nik');
				break;
			case 2:
				$this->db->order_by('p.nik', DESC);
				break;
			case 3:
				$this->db->order_by('p.nama');
				break;
			case 4:
				$this->db->order_by('p.nama', DESC);
				break;
			case 5:
				$this->db->order_by('pm.tanggal_buat');
				break;
			case 6:
				$this->db->order_by('pm.tanggal_buat', DESC);
				break;
			case 7:
				$this->db->order_by('pm.last_login');
				break;
			case 8:
				$this->db->order_by('pm.last_login', DESC);
				break;
			default:
				'';
		}

		$this->db->limit($limit, $offset);

		$data = $this->db->get()->result_array();

		return $data;
	}

	private function generate_pin($pin = '')
	{
		$pin = rand(100000, 999999);
		$pin = strrev($pin);

		return $pin;
	}

	public function insert()
	{
		$post = $this->input->post();
		$pin = bilangan($post['pin'] ?: $this->generate_pin($post['pin']));

		$data['pin'] = hash_pin($pin); // Hash PIN
		$data['tanggal_buat'] = date("Y-m-d H:i:s");
		$data['id_pend'] = $this->input->post('id_pend');
		$outp = $this->db->insert('tweb_penduduk_mandiri', $data);

		status_sukses($data); //Tampilkan Pesan

		// Ambil data sementara untuk ditampilkan
		$flash = $this->get_mandiri($data['id_pend']);
		$flash['pin'] = $pin; // Normal PIN
		$this->session->set_flashdata('info', $flash);
	}

	public function update($id_pend = NULL)
	{
		$post = $this->input->post();
		$pin = bilangan($post['pin'] ?: $this->generate_pin($post['pin']));

		$data['pin'] = hash_pin($pin); // Hash PIN
		$data['tanggal_buat'] = date("Y-m-d H:i:s");
		$outp = $this->db->where('id_pend', $id_pend)->update('tweb_penduduk_mandiri', $data);

		status_sukses($data); //Tampilkan Pesan

		// Ambil data sementara untuk ditampilkan
		$flash = $this->get_mandiri($id_pend);
		$flash['pin'] = $pin; // Normal PIN
		$this->session->set_flashdata('info', $flash);
	}

	public function delete($id_pend = '', $semua = FALSE)
	{
		if (!$semua) $this->session->success = 1;

		$outp = $this->db->where('id_pend', $id_pend)->delete('tweb_penduduk_mandiri');

		status_sukses($outp, $gagal_saja = TRUE); //Tampilkan Pesan
	}

	// TODO : Belum digunakan
	public function delete_all()
	{
		$this->session->success = 1;

		$id_cb = $_POST['id_cb'];
		foreach ($id_cb as $id) {
			$this->delete($id, $semua = TRUE);
		}
	}

	// TODO : Digunakan dimana ?
	private function list_data_ajax_sql($cari = '')
	{
		$this->db
			->from('tweb_penduduk_mandiri u')
			->join('penduduk_hidup n', 'u.id_pend = n.id', 'left')
			->join('tweb_wil_clusterdesa w', 'n.id_cluster = w.id', 'left');

		if ($cari) {
			$this->db->where("(nik like '%{$cari}%' or nama like '%{$cari}%')");
		}
	}


	// TODO : Digunakan dimana ?
	public function list_data_ajax($cari, $page)
	{
		$this->list_data_ajax_sql($cari);
		$jml = $this->db
			->select('count(u.id_pend) as jml')
			->get()
			->row()
			->jml;

		$result_count = 25;
		$offset       = ($page - 1) * $result_count;

		$this->list_data_ajax_sql($cari);
		$this->db
			->distinct()
			->select('u.id_pend, nik, nama, w.dusun, w.rw, w.rt')
			->limit($result_count, $offset);
		$data = $this->db->get()->result_array();

		foreach ($data as $row) {
			$nama                = addslashes($row['nama']);
			$alamat              = addslashes("Alamat: RT-{$row['rt']}, RW-{$row['rw']} {$row['dusun']}");
			$outp                = "{$row['nik']} - {$nama} \n {$alamat}";
			$pendaftar_mandiri[] = [
				'id'   => $row['nik'],
				'text' => $outp,
			];
		}

		$end_count  = $offset + $result_count;
		$more_pages = $end_count < $jml;

		return [
			'results'    => $pendaftar_mandiri,
			'pagination' => [
				'more' => $more_pages,
			],
		];
	}

	public function get_pendaftar_mandiri($nik)
	{
		return $this->db
			->select('id, nik, nama')
			->from('tweb_penduduk')
			->where('status', 1)
			->where('nik', $nik)
			->get()
			->row_array();
	}

	public function list_penduduk()
	{
		return $this->db
			->select('id, nik, nama')
			->where('nik <>', '')
			->where('nik <>', 0)
			->where('id NOT IN (SELECT id_pend FROM tweb_penduduk_mandiri)')
			->get('penduduk_hidup')
			->result_array();
	}

	public function get_penduduk($id_pend, $id_nik = false)
	{
		($id_nik === true) ? $this->db->where('nik', $id_pend) : $this->db->where('id', $id_pend);

		return $this->db
			->select('id, nik, nama, telepon')
			->get('penduduk_hidup')
			->row_array();
	}

	public function get_mandiri($id_pend, $id_nik = false)
	{
		($id_nik === true) ? $this->db->where('p.nik', $id_pend) : $this->db->where('pm.id_pend', $id_pend);

		return $this->db
			->select('pm.*, p.nama, p.nik, p.email, p.telepon')
			->from('tweb_penduduk_mandiri pm')
			->join('penduduk_hidup p', 'pm.id_pend = p.id', 'LEFT')
			->get()
			->row_array();
	}

	#Login Layanan Mandiri

	public function insidega()
	{
		$_SESSION['mandiri'] = -1;
		$nik = $this->input->post('nik');
		$pin = $this->input->post('pin');
		$hash_pin = hash_pin($pin);

		$row = $this->db->select('pin, last_login')
			->where('p.nik', $nik)
			->from('tweb_penduduk_mandiri m')
			->join('tweb_penduduk p', 'm.id_pend = p.id', 'left')
			->get()
			->row();
		$lg = $row->last_login;

		if ($hash_pin == $row->pin) {
			$sql = "SELECT nama,nik,p.id,k.no_kk
			FROM tweb_penduduk p
			LEFT JOIN tweb_keluarga k ON p.id_kk = k.id
			WHERE nik = ?";
			$query = $this->db->query($sql, array($nik));
			$row = $query->row();
			// Kosong jika NIK penduduk ybs telah berubah
			if (!empty($row)) {
				// Kalau pertama kali login, pengguna perlu mengganti PIN ($_SESSION['lg'] == 1)
				$this->session->lg = ($lg == NULL or $lg == "0000-00-00 00:00:00") ? 1 : 2;

				$_SESSION['nama'] = $row->nama;
				$_SESSION['nik'] = $row->nik;
				$_SESSION['id'] = $row->id;
				$_SESSION['no_kk'] = $row->no_kk;
				$_SESSION['mandiri'] = 1;
			}
			return;
		}
		if ($_SESSION['mandiri_try'] > 2) {
			$_SESSION['mandiri_try'] = $_SESSION['mandiri_try'] - 1;
		} else {
			$_SESSION['mandiri_wait'] = 1;
		}
	}

	public function logout()
	{
		if (isset($_SESSION['nik'])) {
			$nik = $_SESSION['nik'];
			$sql = "UPDATE tweb_penduduk_mandiri SET last_login = NOW()
			WHERE id_pend = (SELECT id FROM tweb_penduduk WHERE strcmp(nik, ?) = 0)";
			$this->db->query($sql, $nik);
		}
		unset($_SESSION['mandiri']);
		unset($_SESSION['id']);
		unset($_SESSION['nik']);
		unset($_SESSION['nama']);
	}

	public function update_pin($nik = 0)
	{
		$this->session->success = 1;
		$this->session->error_msg = '';

		$nik = $this->session->nik;
		$pin_lama = hash_pin($this->input->post('pin_lama'));
		$pin1 = hash_pin($this->input->post('pin1'));
		$pin2 = hash_pin($this->input->post('pin2'));

		// Ganti password
		if ($pin_lama != ''	|| $pin1 != '' || $pin2 != '') {
			$row = $this->db->select('pin, last_login')
				->where('p.nik', $nik)
				->from('tweb_penduduk_mandiri m')
				->join('tweb_penduduk p', 'm.id_pend = p.id', 'left')
				->get()->row();

			if ($pin_lama != $row->pin) {
				$this->session->error_msg .= 'PIN lama salah<br />';
			}
			if (empty($pin1)) {
				$this->session->error_msg .= 'PIN baru tidak boleh kosong<br />';
			}
			if ($pin1 != $pin2) {
				$this->session->error_msg .= 'Ulang PIN baru tidak cocok<br />';
			}
			if (!empty($this->session->error_msg)) {
				$this->session->success = -1;
			} else {
				$hash_pin = $pin1;
				$data['pin'] = $hash_pin;
				$this->db->where("id_pend = (SELECT id FROM tweb_penduduk WHERE strcmp(nik, {$_SESSION['nik']}) = 0)");
				$outp = $this->db->update('tweb_penduduk_mandiri', $data);
				$this->session->lg = 2;
			}
		}
	}
}

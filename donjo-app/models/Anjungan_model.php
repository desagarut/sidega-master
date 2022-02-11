<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Anjungan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function cek_anjungan()
	{
		$ip = $this->input->ip_address();

		$data = $this->db
			->where('ip_address', $ip)
			->where('status', 1)
			->get('anjungan')
			->result_array();

		return $data;
	}

	public function list_data()
	{
		$data = $this->db->order_by('ip_address')
			->get('anjungan')
			->result_array();
		return $data;
	}

	public function insert()
	{
		$data = $this->validasi($this->input->post());
		$data['created_by'] = $this->session->user;
		$outp = $this->db->insert('anjungan', $data);
		status_sukses($outp);
	}

	private function validasi($post)
	{
		$data['ip_address'] = bilangan_titik($post['ip_address']);
		$data['keterangan'] = htmlentities($post['keterangan']);
		$data['status'] = $post['status'];
		$data['updated_by'] = $this->session->user;
		return $data;
	}

	public function delete($id)
	{
		$outp = $this->db->where('id', $id)->delete('anjungan');
		status_sukses($outp);
	}

	public function update($id)
	{
		$data = $this->validasi($this->input->post());
		$data['updated_at'] = date('Y-m-d H:i:s');
		$outp = $this->db->where('id', $id)
			->update('anjungan', $data);
		status_sukses($outp);
	}

	public function get_anjungan($id)
	{
		$data = $this->db->where('id', $id)
			->get('anjungan')->row_array();
		return $data;
	}

	/**
	 * @param $id id
	 * @param $val status : 1 = Unlock, 2 = Lock
	 */
	public function lock($id, $val)
	{
		$outp = $this->db
			->where('id', $id)
			->update('anjungan', ['status' => $val]);
		status_sukses($outp);
	}
}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

	public function index()
	{
		$query = $this->db
			->select('a.*, YEAR(tgl_upload) AS thn, MONTH(tgl_upload) AS bln, DAY(tgl_upload) AS hri')
			->from("artikel a")
			->get();

		$data['artikel'] = $query->result_array();

		$this->output->set_content_type('text/xml', 'UTF-8');
		$this->load->view('sitemap', $data);
	}
}

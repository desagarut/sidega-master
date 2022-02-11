<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('feed_model');
		$this->load->model('config_model');
	}

	public function index()
	{
		$data["data_config"] = $this->config_model->get_data();
		$data["feeds"] = $this->feed_model->list_feeds();

		$this->output->set_content_type('text/xml', 'UTF-8');
		$this->load->view("feed", $data);
	}
}
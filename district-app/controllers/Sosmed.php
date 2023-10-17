<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sosmed extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('web_sosmed_model');
		$this->modul_ini = 13;
		$this->sub_modul_ini = 53;
	}

	public function index()
	{
		$sosmed = $this->session->userdata('sosmed');

		if(!$sosmed) $sosmed = 'facebook';

		$data['media'] = $sosmed;
		$data['main'] = $this->web_sosmed_model->get_sosmed($sosmed);
		$data['list_sosmed'] = $this->web_sosmed_model->list_sosmed();
		$data['form_action'] = site_url("sosmed/update/$sosmed");

		$this->session->unset_userdata('sosmed');

		$this->render('sosmed/sosmed', $data);
	}

	public function tab($sosmed)
	{
		$this->session->set_userdata('sosmed', $sosmed);

		redirect('sosmed');
	}

	public function update($sosmed)
	{
		$this->web_sosmed_model->update($sosmed);
		$redirect = (!empty($sosmed)) ? "sosmed/tab/$sosmed" : "sosmed";
		redirect($redirect);
	}
}

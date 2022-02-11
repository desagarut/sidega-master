<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Notif_web extends Web_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('notif_model');
	}

	public function inbox()
	{
		$j = $this->notif_model->inbox_baru($tipe=2, $_SESSION['nik']);
		if ($j > 0)
		{
			echo $j;
		}
	}
}
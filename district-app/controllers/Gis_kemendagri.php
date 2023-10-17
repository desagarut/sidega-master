<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gis_kemendagri extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->modul_ini = 820;
		$this->sub_modul_ini = 821;
	}

	public function index()
	{
		
		$this->set_minsidebar(1);
		$this->render('gis/maps-kemendagri', $data);
	}

}

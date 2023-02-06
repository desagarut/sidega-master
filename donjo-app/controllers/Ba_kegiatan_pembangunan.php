<?php defined('BASEPATH') || exit('No direct script access allowed');

require_once APPPATH . 'controllers/Ba_rencana_pembangunan.php';

class Ba_kegiatan_pembangunan extends Ba_rencana_pembangunan
{
    protected $tipe = 'kegiatan';

    public function __construct()
    {
        parent::__construct();
        $this->modul_ini     = 300;
        $this->sub_modul_ini = 330;
    }
}

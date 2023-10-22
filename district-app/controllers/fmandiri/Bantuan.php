<?php defined('BASEPATH') || exit('No direct script access allowed');

class Bantuan extends Mandiri_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('program_bantuan_model');
    }

    public function index()
    {
        $data['bantuan_penduduk'] = $this->program_bantuan_model->daftar_bantuan_yang_diterima($this->is_login->nik);

        $this->render('bantuan', $data);
    }

    public function kartu_peserta($aksi = 'tampil', $id_peserta = '')
    {
        $data = $this->program_bantuan_model->get_program_peserta_by_id($id_peserta);
        // Hanya boleh menampilkan data pengguna yang login
        // ** Bagi program sasaran pendududk **
        // TO DO : Ganti parameter nik menjadi id
        if ($aksi == 'tampil') {
            $this->load->view(MANDIRI . '/peserta_bantuan', $data);
        } else {
            ambilBerkas($data['kartu_peserta'], MANDIRI . '/bantuan', null, LOKASI_DOKUMEN);
        }
    }
}

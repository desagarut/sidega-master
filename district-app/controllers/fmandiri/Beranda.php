<?php defined('BASEPATH') || exit('No direct script access allowed');

class Beranda extends Mandiri_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['mandiri_model', 'penduduk_model', 'kelompok_model', 'web_dokumen_model', 'pendapat_model', 'mailbox_model']);
        $this->load->helper('download');
    }

    public function index()
    {
        $inbox = $this->mailbox_model->count_inbox_pesan($this->is_login->nik);
        if ($inbox) {
            redirect('layanan-mandiri/pesan-masuk');
        } else {
            redirect('layanan-mandiri/permohonan-surat');
        }
    }

    public function profil()
    {
        $data = [
            'penduduk' => $this->penduduk_model->get_penduduk($this->is_login->id_pend),
            'kelompok' => $this->penduduk_model->list_kelompok($this->is_login->id_pend),
            'dokumen'  => $this->penduduk_model->list_dokumen($this->is_login->id_pend),
        ];

        $this->render('profil', $data);
    }

    public function cetak_biodata()
    {
        $data = [
            'desa'     => $this->header,
            'penduduk' => $this->penduduk_model->get_penduduk($this->is_login->id_pend),
        ];

        $this->load->view('sid/kependudukan/cetak_biodata', $data);
    }

    public function cetak_kk()
    {
        if ($this->is_login->id_kk == 0) {
            // Jika diakses melalui URL
            $respon = [
                'status' => 1,
                'pesan'  => 'Anda tidak terdaftar dalam sebuah keluarga',
            ];
            $this->session->set_flashdata('notif', $respon);

            redirect('layanan-mandiri');
        }

        $data = $this->keluarga_model->get_data_cetak_kk($this->is_login->id_kk);

        $this->load->view('sid/kependudukan/cetak_kk_all', $data);
    }

    public function ganti_pin()
    {
        $data = [
            'tgl_verifikasi_telegram' => $this->otp_library->driver('telegram')->cek_verifikasi_otp($this->is_login->id_pend),
            'tgl_verifikasi_email'    => $this->otp_library->driver('email')->cek_verifikasi_otp($this->is_login->id_pend),
            'cek_anjungan'            => $this->cek_anjungan,
            'form_action'             => site_url('layanan-mandiri/proses-ganti-pin'),
        ];

        $this->render('ganti_pin', $data);
    }

    public function proses_ganti_pin()
    {
        $data = $this->mandiri_model->ganti_pin();
        redirect('layanan-mandiri/ganti-pin');
    }

    public function keluar()
    {
        $this->mandiri_model->logout();
        redirect('layanan-mandiri');
    }

    /**
     * Unduh berkas berdasarkan kolom dokumen.id
     *
     * @param int $id_dokumen Id berkas pada koloam dokumen.id
     *
     * @return void
     */
    public function unduh_berkas($id_dokumen = '')
    {
        // Ambil nama berkas dari database
        $berkas = $this->web_dokumen_model->get_nama_berkas($id_dokumen, $this->is_login->id_pend);
        ambilBerkas($berkas, null, null, LOKASI_DOKUMEN);
    }

    public function pendapat(int $pilihan = 1)
    {
        $data = [
            'pengguna' => $this->is_login->id_pend,
            'pilihan'  => $pilihan,
        ];

        $this->pendapat_model->insert($data);
        redirect('layanan-mandiri/keluar');
    }
}

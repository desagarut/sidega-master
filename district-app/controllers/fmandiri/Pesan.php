<?php defined('BASEPATH') || exit('No direct script access allowed');

class Pesan extends Mandiri_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['mailbox_model', 'permohonan_surat_model']);
    }

    public function index($kat = 1)
    {
        $data = [
            'kat'   => $kat,
            'judul' => ($kat == 1) ? 'Keluar' : 'Masuk',
            'pesan' => $this->mailbox_model->get_all_pesan($this->is_login->nik, $kat),
        ];

        $this->render('pesan', $data);
    }

    // TODO: Pisahkan mailbox dari komentar
    // TODO: Ganti nik jadi id_pend
    public function kirim($kat = 2)
    {
        $this->load->library('Telegram/telegram');

        $data             = $this->input->post();
        $post['email']    = $this->is_login->nik; // kolom email diisi nik untuk pesan
        $post['owner']    = $this->is_login->nama;
        $post['subjek']   = $data['subjek'];
        $post['komentar'] = $data['pesan'];
        $post['tipe']     = 1;
        $post['status']   = 2;
        $this->mailbox_model->insert($post);

        if (! empty($this->setting->telegram_token) && cek_koneksi_internet()) {
            try {
                $this->telegram->sendMessage([
                    'text'       => sprintf('Warga RT. %s atas nama %s telah mengirim pesan melalui Layanan Mandiri pada tanggal %s', $this->is_login->rt, $this->is_login->nama, tgl_indo2(date('Y-m-d H:i:s'))),
                    'parse_mode' => 'Markdown',
                    'chat_id'    => $this->setting->telegram_user_id,
                ]);
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
            }
        }

        if ($kat == 1) {
            redirect('layanan-mandiri/pesan-keluar');
        }

        redirect('layanan-mandiri/pesan-masuk');
    }

    public function baca($kat = 2, $id = '')
    {
        $nik = $this->is_login->nik;
        if ($kat == 2) {
            $this->mailbox_model->ubah_status_pesan($nik, $id, 1);
        }

        $pesan = $this->mailbox_model->get_pesan($nik, $id);
        $data  = [
            'kat'        => $kat,
            'owner'      => ($kat == 2) ? 'Penerima' : 'Pengirim',
            'tujuan'     => ($kat == 2) ? 'pesan-masuk' : 'pesan-keluar',
            'pesan'      => $pesan,
            'permohonan' => $this->permohonan_surat_model->get_permohonan(['id' => $pesan['permohonan']]),
        ];

        $this->render('baca_pesan', $data);
    }

    public function tulis($kat = 2)
    {
        $data = [
            'tujuan' => ($kat == 2) ? 'pesan-masuk' : 'pesan-keluar',
            'kat'    => $kat,
            'subjek' => $this->input->post('subjek'),
        ];

        $this->render('tulis_pesan', $data);
    }
}

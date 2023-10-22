<?php defined('BASEPATH') || exit('No direct script access allowed');

class Daftar_verifikasi extends Web_Controller
{
    public function __construct()
    {
        parent::__construct();
        mandiri_timeout();
        $this->session->daftar_verifikasi = true;
        $this->load->model(['mandiri_model', 'theme_model']);
        $this->load->library('OTP/OTP_manager', null, 'otp_library');
        if (! $this->setting->tampilkan_pendaftaran) {
            redirect('layanan-mandiri/masuk');
        }
    }

    public function index()
    {
        if ($this->session->mandiri == 1) {
            redirect('layanan-mandiri');
        }

        //Initialize Session ------------
        $this->session->unset_userdata('balik_ke');
        if (! isset($this->session->mandiri)) {
            // Belum ada session variable
            $this->session->mandiri           = 0;
            $this->session->mandiri_try       = 4;
            $this->session->mandiri_wait      = 0;
            $this->session->daftar_verifikasi = true;
        }

        $data = [
            'header'                  => $this->header,
            'latar_login_mandiri'     => $this->theme_model->latar_login_mandiri(),
            'tgl_verifikasi_telegram' => $this->otp_library->driver('telegram')->cek_verifikasi_otp($this->session->is_verifikasi['id']),
            'tgl_verifikasi_email'    => $this->otp_library->driver('email')->cek_verifikasi_otp($this->session->is_verifikasi['id']),
            'form_kirim_userid'       => site_url('layanan-mandiri/daftar/verifikasi/telegram/kirim-userid'),
            'form_kirim_email'        => site_url('layanan-mandiri/daftar/verifikasi/email/kirim-email'),
        ];

        if ($data['tgl_verifikasi_telegram']) {
            $this->session->set_flashdata('sudah-diverifikasi', '#langkah-4');
        }

        if ($data['tgl_verifikasi_email']) {
            $this->session->set_flashdata('sudah-diverifikasi-email', '#langkah-4');
        }

        if ($data['tgl_verifikasi_telegram'] && $data['tgl_verifikasi_email']) {
            $this->session->set_flashdata('sudah-verifikasi-semua', 1);
        }

        $this->session->set_flashdata('tab-aktif', [
            'status' => 0,
        ]);

        $this->load->view(MANDIRI . '/masuk', $data);
    }

    /**
     * Verifikasi Telegram
     */
    public function telegram()
    {
        $data = [
            'header'                  => $this->header,
            'latar_login_mandiri'     => $this->theme_model->latar_login_mandiri(),
            'tgl_verifikasi_telegram' => $this->otp_library->driver('telegram')->cek_verifikasi_otp($this->session->is_verifikasi['id']),
            'tgl_verifikasi_email'    => $this->otp_library->driver('email')->cek_verifikasi_otp($this->session->is_verifikasi['id']),
            'form_kirim_userid'       => site_url('layanan-mandiri/daftar/verifikasi/telegram/kirim-userid'),
            'form_kirim_otp'          => site_url('layanan-mandiri/daftar/verifikasi/telegram/kirim-otp'),
        ];

        if ($data['tgl_verifikasi_telegram']) {
            $this->session->set_flashdata('sudah-diverifikasi', '#langkah4');
        }

        if ($data['tgl_verifikasi_email']) {
            $this->session->set_flashdata('sudah-diverifikasi-email', '#langkah4');
        }

        $this->session->set_flashdata('tab-aktif', [
            'status' => 0,
        ]);

        $this->load->view(MANDIRI . '/masuk', $data);
    }

    /**
     * Langkah 2 Verifikasi Telegram
     */
    public function kirim_otp_telegram()
    {
        $post    = $this->input->post();
        $userID  = $post['telegram_userID'];
        $token   = hash('sha256', $raw_token = mt_rand(100000, 999999));
        $id_pend = $this->session->is_verifikasi['id'];

        $this->db->trans_begin();

        if ($this->otp_library->driver('telegram')->cek_akun_terdaftar(['telegram' => $userID, 'id' => $id_pend])) {
            try {
                $this->db->where('id', $id_pend)->update('tweb_penduduk', [
                    'telegram'                => $userID,
                    'telegram_token'          => $token,
                    'telegram_tgl_kadaluarsa' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 minutes')),
                ]);

                $this->otp_library->driver('telegram')->kirim_otp($userID, $raw_token);

                $this->db->trans_commit();
            } catch (\Exception $e) {
                log_message('error', $e);

                $this->session->set_flashdata('daftar_notif_telegram', [
                    'status' => -1,
                    'pesan'  => 'Tidak berhasil mengirim OTP, silahkan mencoba kembali.',
                ]);

                $this->db->trans_rollback();

                redirect('layanan-mandiri/daftar/verifikasi/telegram/#langkah-2');
            }

            $this->session->set_flashdata('daftar_notif_telegram', [
                'status' => 1,
                'pesan'  => 'OTP telegram anda berhasil terkirim, silahkan cek telegram anda!',
            ]);

            $this->session->set_flashdata('kirim-otp-telegram', '#langkah3');

            redirect('layanan-mandiri/daftar/verifikasi/telegram/#langkah-3');
        } else {
            $this->session->set_flashdata('daftar_notif_telegram', [
                'status' => -1,
                'pesan'  => 'Akun Telegram yang Anda Masukkan tidak valid, <br/> Silahkan menggunakan akun lainnya',
            ]);
            redirect('layanan-mandiri/daftar/verifikasi/telegram/#langkah-2');
        }
    }

    /**
     * Langkah 3 Verifikasi Telegram
     */
    public function verifikasi_telegram()
    {
        $post       = $this->input->post();
        $otp        = $post['token_telegram'];
        $user       = $this->session->is_verifikasi['id'];
        $nama       = $this->session->is_verifikasi['nama'];
        $telegramID = $this->db->where('id', $user)->get('tweb_penduduk')->row()->telegram;

        if ($this->otp_library->driver('telegram')->verifikasi_otp($otp, $user)) {
            $this->session->set_flashdata('daftar_notif_telegram', [
                'status' => 1,
                'pesan'  => 'Selamat, akun telegram anda berhasil terverifikasi.',
            ]);

            try {
                $this->otp_library->driver('telegram')->verifikasi_berhasil($telegramID, $nama);
            } catch (\Exception $e) {
                log_message('error', $e);
            }

            redirect('layanan-mandiri/daftar/verifikasi/telegram/#langkah-4');
        }

        $this->session->set_flashdata('daftar_notif_telegram', [
            'status' => -1,
            'pesan'  => 'Tidak berhasil memverifikasi, Token tidak sesuai atau waktu Anda habis, silahkan mencoba kembali.',
        ]);

        redirect('layanan-mandiri/daftar/verifikasi/telegram/#langkah-2');
    }

    /**
     * Verifikasi Email
     */
    public function email()
    {
        $data = [
            'header'                  => $this->header,
            'latar_login_mandiri'     => $this->theme_model->latar_login_mandiri(),
            'tgl_verifikasi_telegram' => $this->otp_library->driver('telegram')->cek_verifikasi_otp($this->session->is_verifikasi['id']),
            'tgl_verifikasi_email'    => $this->otp_library->driver('email')->cek_verifikasi_otp($this->session->is_verifikasi['id']),
            'form_kirim_email'        => site_url('layanan-mandiri/daftar/verifikasi/email/kirim-email'),
            'form_kirim_otp_email'    => site_url('layanan-mandiri/daftar/verifikasi/email/kirim-otp'),
        ];

        if ($data['tgl_verifikasi_telegram']) {
            $this->session->set_flashdata('sudah-diverifikasi', '#langkah4');
        }

        if ($data['tgl_verifikasi_email']) {
            $this->session->set_flashdata('sudah-diverifikasi-email', '#langkah4');
        }

        $this->session->set_flashdata('tab-aktif', [
            'status' => 1,
        ]);

        $this->load->view(MANDIRI . '/masuk', $data);
    }

    /**
     * Langkah 2 Verifikasi Email
     */
    public function kirim_otp_email()
    {
        $post    = $this->input->post();
        $email   = $post['alamat_email'];
        $token   = hash('sha256', $raw_token = mt_rand(100000, 999999));
        $id_pend = $this->session->is_verifikasi['id'];

        $this->db->trans_begin();

        if ($this->otp_library->driver('email')->cek_akun_terdaftar(['email' => $email, 'id' => $id_pend])) {
            try {
                $this->db->where('id', $id_pend)->update('tweb_penduduk', [
                    'email'                => $email,
                    'email_token'          => $token,
                    'email_tgl_kadaluarsa' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +1 minutes')),
                ]);

                $this->otp_library->driver('email')->kirim_otp($email, $raw_token);

                $this->db->trans_commit();
            } catch (\Exception $e) {
                log_message('error', $e);

                $this->session->set_flashdata('daftar_notif_telegram', [
                    'status' => -1,
                    'pesan'  => 'Tidak berhasil mengirim OTP, silahkan mencoba kembali.',
                ]);

                $this->db->trans_rollback();

                redirect('layanan-mandiri/daftar/verifikasi/email/#langkah-2');
            }

            $this->session->set_flashdata('daftar_notif_telegram', [
                'status' => 1,
                'pesan'  => 'OTP email anda berhasil terkirim, silahkan cek email anda!',
            ]);

            $this->session->set_flashdata('kirim-otp-email', '#langkah3');

            redirect('layanan-mandiri/daftar/verifikasi/email/#langkah-3');
        } else {
            $this->session->set_flashdata('daftar_notif_telegram', [
                'status' => -1,
                'pesan'  => 'Akun Email yang Anda Masukkan tidak valid, <br/> Silahkan menggunakan akun lainnya',
            ]);
            redirect('layanan-mandiri/daftar/verifikasi/email/#langkah-2');
        }
    }

    /**
     * Langkah 3 Verifikasi Email
     */
    public function verifikasi_email()
    {
        $post  = $this->input->post();
        $otp   = $post['token_email'];
        $user  = $this->session->is_verifikasi['id'];
        $nama  = $this->session->is_verifikasi['nama'];
        $email = $this->db->where('id', $user)->get('tweb_penduduk')->row()->email;

        if ($this->otp_library->driver('email')->verifikasi_otp($otp, $user)) {
            $this->session->set_flashdata('daftar_notif_telegram', [
                'status' => 1,
                'pesan'  => 'Selamat, alamat email anda berhasil terverifikasi.',
            ]);

            try {
                $this->otp_library->driver('email')->verifikasi_berhasil($email, $nama);
            } catch (\Exception $e) {
                log_message('error', $e);
            }

            redirect('layanan-mandiri/daftar/verifikasi/email/#langkah-4');
        }

        $this->session->set_flashdata('daftar_notif_telegram', [
            'status' => -1,
            'pesan'  => 'Tidak berhasil memverifikasi, Token tidak sesuai atau waktu Anda habis, silahkan mencoba kembali.',
        ]);

        redirect('layanan-mandiri/daftar/verifikasi/email/#langkah-2');
    }
}

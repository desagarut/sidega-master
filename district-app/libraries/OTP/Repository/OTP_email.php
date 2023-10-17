<?php 

require_once 'district-app/libraries/OTP/Interface/OTP_interface.php';

class OTP_email implements OTP_interface
{
    /**
     * Intance class codeigniter.
     *
     * @var CI_Controller
     */
    protected $ci;

    /**
     * @var Email
     */
    protected $email;

    public function __construct()
    {
        $this->ci = get_instance();
        $this->ci->load->library('email', config_item('email'));
    }

    /**
     * {@inheritDoc}
     */
    public function kirim_otp($user, $otp)
    {
        if ($this->cek_verifikasi_otp($user)) {
            return true;
        }

        $this->ci->email->from($this->ci->email->smtp_user, 'OpenSID')
            ->to($user)
            ->subject('Verifikasi Akun Email')
            ->set_mailtype('html')
            ->message($this->ci->load->view('fmandiri/email/verifikasi', ['token' => $otp], true));

        if ($this->ci->email->send()) {
            return true;
        }

        throw new \Exception($this->ci->email->print_debugger());
    }

    /**
     * {@inheritDoc}
     */
    public function verifikasi_otp($otp, $user = null)
    {
        if ($this->cek_verifikasi_otp($user)) {
            return true;
        }

        $token = $this->ci->db->from('tweb_penduduk')
            ->where('email_token', $raw_token = hash('sha256', $otp))
            ->get()
            ->row();

        if (null === $token) {
            return false;
        }

        if (date('Y-m-d H:i:s') > $token->email_tgl_kadaluarsa) {
            return false;
        }

        if (hash_equals($token->email_token, $raw_token)) {
            $this->ci->db
                ->where('id', $user)
                ->update('tweb_penduduk', [
                    'email_tgl_verifikasi' => date('Y-m-d H:i:s'),
                ]);

            return true;
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function cek_verifikasi_otp($user)
    {
        $token = $this->ci->db->from('tweb_penduduk')
            ->select('email_tgl_verifikasi')
            ->where('id', $user)
            ->get()
            ->row();

        return (bool) ($token->email_tgl_verifikasi != null);
    }

    /**
     * {@inheritDoc}
     */
    public function verifikasi_berhasil($email, $nama)
    {
        $this->ci->email->from($this->ci->email->smtp_user, 'OpenSID')
            ->to($email)
            ->subject('Berhasil Verifikasi Email')
            ->set_mailtype('html')
            ->message($this->ci->load->view('fmandiri/email/verifikasi-berhasil', ['nama' => $nama], true));

        if ($this->ci->email->send()) {
            return true;
        }

        throw new \Exception($this->ci->email->print_debugger());
    }

    /**
     * {@inheritDoc}
     */
    public function kirim_pin_baru($user, $pin, $nama)
    {
        $this->ci->email->from($this->ci->email->smtp_user, 'OpenSID')
            ->to($user)
            ->subject('PIN Baru')
            ->set_mailtype('html')
            ->message($this->ci->load->view('fmandiri/email/kirim-pin', ['pin' => $pin, 'nama' => $nama], true));

        if ($this->ci->email->send()) {
            return true;
        }

        throw new \Exception($this->ci->email->print_debugger());
    }

    /**
     * {@inheritDoc}
     */
    public function cek_akun_terdaftar($user)
    {
        return isset($this->ci->db)
            ? ($this->ci->db->where('email', $user['email'])->where_not_in('id', $user['id'])->get('tweb_penduduk')->num_rows() === 0)
            : false;
    }
}

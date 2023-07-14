<?php

interface OTP_interface
{
    /**
     * Kirim otp ke user.
     *
     * @param mixed $user
     * @param mixed $otp
     *
     * @throws \Exception
     *
     * @return void
     */
    public function kirim_otp($user, $otp);

    /**
     * Verifikasi otp user.
     *
     * @param mixed $otp
     * @param mixed $user
     *
     * @return bool
     */
    public function verifikasi_otp($otp, $user = null);

    /**
     * Kirim pesan ke user telegram.
     *
     * @param mixed $user
     * @param mixed $nama
     *
     * @throws \Exception
     *
     * @return void
     */
    public function verifikasi_berhasil($user, $nama);

    /**
     * Cek verifikasi otp user.
     *
     * @param mixed $user
     *
     * @return bool
     */
    public function cek_verifikasi_otp($user);

    /**
     * Kirim pesan permintaan pin baru ke user telegram.
     *
     * @param mixed $user = chatID
     * @param mixed $pin
     * @param mixed $nama
     *
     * @throws \Exception
     *
     * @return void
     */
    public function kirim_pin_baru($user, $pin, $nama);

    /**
     * Cek akun sudah terdaftar.
     *
     * @param mixed $user
     * @param mixed $chat_id
     *
     * @return bool
     */
    public function cek_akun_terdaftar($chat_id);
}

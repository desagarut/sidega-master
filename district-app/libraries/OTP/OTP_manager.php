<?php

require_once 'district-app/libraries/OTP/Abstract_manager.php';
require_once 'district-app/libraries/OTP/Repository/OTP_telegram.php';
require_once 'district-app/libraries/OTP/Repository/OTP_email.php';

class OTP_manager extends Abstract_manager
{
    public function getDefaultDriver()
    {
        throw new Exception('Not supported defauld driver.');
    }

    public function createTelegramDriver()
    {
        return new OTP_telegram();
    }

    public function createEmailDriver()
    {
        return new OTP_email();
    }
}

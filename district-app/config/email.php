<?php defined('BASEPATH') || exit('No direct script access allowed');

$config['useragent']      = 'CodeIgniter';        // None	The “user agent”.
$config['protocol']       = 'smtp';               // mail	mail, sendmail, or smtp	The mail sending protocol.
$config['mailpath']       = '';                   // /usr/sbin/sendmail	None	The server path to Sendmail.
$config['smtp_host']      = '';                   // SMTP Server Address.
$config['smtp_user']      = '';                   // SMTP Username.
$config['smtp_pass']      = '';                   // SMTP Password.
$config['smtp_port']      = 2525;                 // SMTP Port.
$config['smtp_timeout']   = 5;                    // SMTP Timeout (in seconds).
$config['smtp_keepalive'] = false;                // TRUE or FALSE (boolean)	Enable persistent SMTP connections.
$config['smtp_crypto']    = '';                   // tls or ssl	SMTP Encryption
$config['wordwrap']       = true;                 // TRUE or FALSE (boolean)	Enable word-wrap.
$config['wrapchars']      = 76;                   // Character count to wrap at.
$config['mailtype']       = 'text';               // text or html	Type of mail. If you send HTML email you must send it as a complete web page. Make sure you don’t have any relative links or relative image paths otherwise they will not work.
$config['charset']        = 'utf-8';              // Character set (utf-8, iso-8859-1, etc.).
$config['validate']       = false;                // TRUE or FALSE (boolean)	Whether to validate the email address.
$config['priority']       = 3;                    // 1, 2, 3, 4, 5	Email Priority. 1 = highest. 5 = lowest. 3 = normal.
$config['crlf']           = "\r\n";               // \n	“\r\n” or “\n” or “\r”	Newline character. (Use “\r\n” to comply with RFC 822).
$config['newline']        = "\r\n";               // \n	“\r\n” or “\n” or “\r”	Newline character. (Use “\r\n” to comply with RFC 822).
$config['bcc_batch_mode'] = false;                // TRUE or FALSE (boolean)	Enable BCC Batch Mode.
$config['bcc_batch_size'] = 200;                  // None	Number of emails in each BCC batch.
$config['dsn']            = false;                // TRUE or FALSE (boolean)	Enable notify message from server

// Ganti pegaturan basisdata sesuai yg ada pada file desa/config/config.php
include LOKASI_CONFIG_DESA . 'config.php';

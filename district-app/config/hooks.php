<?php defined('BASEPATH') || exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
| https://codeigniter.com/user_guide/general/hooks.html
|
*/

if (ENVIRONMENT === 'development') {
    $hook['display_override'][] = [
        'class'    => 'Develbar',
        'function' => 'debug',
        'filename' => 'Develbar.php',
        'filepath' => 'third_party/DevelBar/hooks',
    ];
}

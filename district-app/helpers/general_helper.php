<?php 

if (! function_exists('asset')) {
    function asset($uri = '')
    {
        return base_url('assets/' . $uri);
    }
}

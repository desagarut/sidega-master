<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php
  header("Content-type: application/octet-stream");
  header("Content-Disposition: attachment; filename=KTP_KK_".date('Y-m-d').".xls");
  header("Pragma: no-cache");
  header("Expires: 0");

  include("district-app/views/ba/penduduk/ktpkk/content_ktpkk_cetak.php");
?>

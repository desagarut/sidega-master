<?php
  header("Content-type: application/octet-stream");
  header("Content-Disposition: attachment; filename=Penduduk_".date('Y-m-d').".xls");
  header("Pragma: no-cache");
  header("Expires: 0");

  include("district-app/views/sid/kependudukan/penduduk_cetak.php");
?>

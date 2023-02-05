<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php
  header("Content-type: application/octet-stream");
  header("Content-Disposition: attachment; filename=Sementara_".date('Y-m-d').".xls");
  header("Pragma: no-cache");
  header("Expires: 0");

  include("donjo-app/views/bumindes/penduduk/sementara/content_sementara_cetak.php");
?>

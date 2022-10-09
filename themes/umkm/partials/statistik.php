<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$penduduk = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1')->result_array()[0]['jumlah'];
$penduduk_laki = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1 and sex = 1')->result_array()[0]['jumlah'];
$penduduk_perempuan = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1 and sex = 2')->result_array()[0]['jumlah'];
$keluarga = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_keluarga')->result_array()[0]['jumlah'];
$keluarga_laki = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1 and sex = 1 and kk_level = 1')->result_array()[0]['jumlah'];
$keluarga_perempuan = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_penduduk WHERE status_dasar = 1 and sex = 2 and kk_level = 1')->result_array()[0]['jumlah'];
$rtm = $this->db->query('SELECT COUNT(id) AS jumlah FROM tweb_rtm')->result_array()[0]['jumlah'];
$id = $this->db->query('SELECT COUNT(id) AS jumlah FROM log_surat')->result_array()[0]['jumlah'];
?>

<section class="shipping-info">
  <div class="container">
    <ul style="background-color: #c8daf7;">

      <li ><a href="#first/statistik/4">
        <div class="media-icon" >
        <h3 style="color: blue;"><?= number_format($penduduk, 0, '', '.') ?></h3>
        </div>
        <div class="media-body">
          <span>Jumlah Penduduk</span>
          <h5>L : <?= number_format($penduduk_laki, 0, '', '.') ?> ( <?= number_format($penduduk_laki / $penduduk * 100, 0, '', '.') ?>% )</h5>
          <h5>P : <?= number_format($penduduk_perempuan, 0, '', '.') ?> ( <?= number_format($penduduk_perempuan / $penduduk * 100, 0, '', '.') ?>%)</h5>
        </div></a>
      </li>

      <li><a href="#">
      <div class="media-icon">
        <h3 style="color: blue;"><?= number_format($keluarga, 0, '', '.') ?></h3>
        </div>
        <div class="media-body">
          <span>Jumlah Kepala Keluarga</span>
          <h5>L : <?= number_format($keluarga_laki, 0, '', '.') ?> ( <?= number_format($keluarga_laki / $keluarga * 100, 0, '', '.') ?>% )</h5>
          <h5>P : <?= number_format($keluarga_perempuan, 0, '', '.') ?> ( <?= number_format($keluarga_perempuan / $keluarga * 100, 0, '', '.') ?>%)</h5>
        </div></a>
      </li>

      <li><a href="#">
      <div class="media-icon">
        <h3 style="color: blue;"><?= number_format($rtm, 0, '', '.') ?></h3>
        </div>
        <div class="media-body">
          <span>Bangunan Rumah Tangga</span>
          <h5>Layak : <?= number_format($rtm, 0, '', '.') ?> ( <?= number_format($rtm / $rtm * 100, 0, '', '.') ?>% )</h5>
          <h5>Tidak Layak : <?= number_format($rtm_no, 0, '', '.') ?> ( <?= number_format($rtm_no / $rtm * 100, 0, '', '.') ?>%)</h5>
        </div></a>
      </li>

      <li><a href="#">
      <div class="media-icon">
        <h3 style="color: blue;"><?= number_format($id, 0, '', '.') ?></h3>
        </div>
        <div class="media-body">
          <span>Pelayanan Surat Menyurat</span>
          <h5>Warga : <?= number_format($id, 0, '', '.') ?> ( <?= number_format($id / $id * 100, 0, '', '.') ?>% )</h5>
          <h5>Non Warga : <?= number_format($id_no, 0, '', '.') ?> ( <?= number_format($id_no / $id * 100, 0, '', '.') ?>%)</h5>
        </div></a>
      </li>
    </ul>
  </div>
</section>
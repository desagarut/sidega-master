<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Start Banner Area -->

<section class="banner section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-12">
        <div class="single-banner" style="background-image:url('<?php $this->load->view($folder_themes .'/widgets/map_tentang') ?>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-12">
      <div class="single-banner custom-responsive-margin">
        <div class="content">
          <h2>Mengenal
            <?= ucfirst($this->setting->sebutan_kecamatan).' '.ucwords($desa['nama_kecamatan']) ?>
          </h2>
          <p>
            <?= ucfirst($this->setting->sebutan_kecamatan).' '.ucwords($desa['nama_kecamatan']) ?>
            adalah salah satu
            <?= ucfirst($this->setting->sebutan_kecamatan);?>
            yang terletak di
            <?= ucwords($this->setting->sebutan_kabupaten." ".$desa['nama_kabupaten'])?>
            Provinsi
            <?= ucwords($this->setting->sebutan_propinsi." ".$desa['nama_propinsi'])?>, Dengan Batas Wilayah: <br>
          <ul>
            <li>Di Utara berbatasan dengan <?= ucwords($desa['batas_utara']) ?> </li>
            <li>Di Selatan berbatasan dengan <?= ucwords($desa['batas_selatan']) ?> </li>
            <li>Di Timur berbatasan dengan <?= ucwords($desa['batas_timur']) ?> </li>
            <li>Di Barat berbatasan dengan <?= ucwords($desa['batas_barat']) ?> </li>
          </ul>
          <?= ucwords($this->setting->profil_singkat." ".$desa['profil_singkat'])?>
          </p>
          <div class="button"> <a href="#" class="btn">Selengkapnya</a> </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

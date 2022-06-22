<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="item-details section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Tentang
            <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
          </h2>
        </div>
      </div>
    </div>
    <div class="product-details-info">
      <div class="single-block">
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="info-body custom-responsive-margin">
              <?php $this->load->view($folder_themes .'/widgets/map_tentang') ?>
            </div>
          </div>
          <div class="col-lg-6 col-12">
            <div class="info-body custom-responsive-margin">
              <p>
                <?= ucfirst($this->setting->sebutan_kecamatan).' '.ucwords($desa['nama_kecamatan']) ?>
                adalah salah satu
                <?= ucfirst($this->setting->sebutan_kecamatan);?>
                yang terletak di
                <?= ucwords($this->setting->sebutan_kabupaten." ".$desa['nama_kabupaten'])?>
                Provinsi
                <?= ucwords($this->setting->sebutan_propinsi." ".$desa['nama_propinsi'])?>
                , Dengan Batas Wilayah: <br>
              <ul class="features">
                <li>Di Utara berbatasan dengan
                  <?= ucwords($desa['batas_utara']) ?>
                </li>
                <li>Di Selatan berbatasan dengan
                  <?= ucwords($desa['batas_selatan']) ?>
                </li>
                <li>Di Timur berbatasan dengan
                  <?= ucwords($desa['batas_timur']) ?>
                </li>
                <li>Di Barat berbatasan dengan
                  <?= ucwords($desa['batas_barat']) ?>
                </li>
              </ul>
              <br/>
              <?= ucwords($this->setting->profil_singkat." ".$desa['profil_singkat'])?>
              <br/>
              <a class="button btn btn-warning" href="<?= $url ?>"> <i class="lni lni-pen"></i> Selengkapnya</a> </div>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

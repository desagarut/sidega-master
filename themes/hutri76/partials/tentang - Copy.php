<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Tentang <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></strong></h2>
          <p><i>kenali kami lebih dekat</i></p>
        </div>

        <div class="row">
          <div class="col-lg-6">
<?php $this->load->view($folder_themes .'/widgets/map') ?>

          </div>
          <div class="col-lg-6" data-aos="fade-left">
            <p>
              <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?> adalah salah satu desa yang terletak di <?= ucwords($this->setting->sebutan_kecamatan." ".$desa['nama_kecamatan'])?> <?= ucwords($this->setting->sebutan_kabupaten." ".$desa['nama_kabupaten'])?> Provinsi <?= ucwords($this->setting->sebutan_propinsi." ".$desa['nama_propinsi'])?>, Dengan Batas Wilayah:
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Di Utara berbatasan dengan <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['batas_utara']) ?></li>
              <li><i class="ri-check-double-line"></i> Di Selatan berbatasan dengan <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['batas_selatan']) ?></li>
              <li><i class="ri-check-double-line"></i> Di Timur berbatasan dengan <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['batas_timur']) ?></li>
              <li><i class="ri-check-double-line"></i> Di Barat berbatasan dengan <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['batas_barat']) ?></li>
            </ul>
            <p class="font-italic">
              <?= ucwords($this->setting->profil_singkat." ".$desa['profil_singkat'])?>
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

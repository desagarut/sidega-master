<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- Team Start -->
<div id="trending-product" class="trending-product section-bg">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2 style="padding-top:20px">Aparatur <?= ucfirst($this->setting->sebutan_desa) ?></h2>
    </div>
    <div class="brands-logo-wrapper">
      <div class="brands-logo-carousel d-flex align-items-center justify-content-between">

        <?php foreach ($aparatur_desa['daftar_perangkat'] as $data) : ?>
          <div class="row" style="padding:10px 10px 10px 10px">
            <div class="single-product product-image">
              <div class="text-center " style="height:250px;">
                <img src="<?= $data['foto'] ?>" alt="<?= $data['nama'] ?>">
              </div>
              <div class="text-center p-0">
                <h6 class="mb-0"><?= $data['nama'] ?></h6>
                <small><?= strtoupper($data['jabatan']) ?></small>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Team End -->
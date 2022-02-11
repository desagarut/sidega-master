<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-lg-8">
  <div class="row portfolio-container" data-aos="fade-up">
    <?php foreach ($w_gal As $data): ?>
    <div class="col-lg-4 col-md-6 portfolio-item">
      <?php if (is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])): ?>
      <a href="<?= site_url("first/sub_gallery/$data[id]"); ?>"><img src="<?= AmbilGaleri($data['gambar'],'kecil')?>" class="img-fluid" alt="<?= $album['nama'] ?>"></a>
      <div class="portfolio-info">
        <h5>
          <?= "Album : $data[nama]" ?>
        </h5>
        <a href="<?= AmbilGaleri($data['gambar'],'kecil')?>" data-gall="portfolioGallery" class="venobox preview-link" title="Lihat"><i class="bx bx-plus"></i></a> <a href="<?= site_url("first/sub_gallery/$data[id]"); ?>" class="details-link" title="<?= "Album : $data[nama]" ?>"><i class="bx bx-link"></i></a> </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
</div>

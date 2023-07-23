<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="owl-carousel header-carousel position-relative">
  <?php if ($gallery) : ?>
    <?php foreach ($gallery as $album) : ?>
      <?php if (is_file(LOKASI_GALERI . "sedang_" . $album['gambar'])) : ?>
        <?php $link = AmbilGaleri($album['gambar'], 'sedang') ?>
        <div class="col-md-12 text-center wow fadeInUp testimonial-item" data-wow-delay="0.1s">
          <div class="team-item bg-light">
            <div class="overflow-hidden" style="padding: 10px 10px 10px 10px">
              <img src="<?= AmbilGaleri($album['gambar'], 'sedang') ?>" class="img-fluid" alt="<?= $album['nama'] ?>" style="width:100%; max-height: 400px; object-fit: cover">
            </div>
            <div class="position-relative d-flex justify-content-center" style="margin-top: -70px;">
              <h5><a class="bg-light mx-1"><?= strtoupper($album['nama']) ?></a></h5>
            </div>
          </div>
        </div>
      <?php endif ?>
    <?php endforeach ?>
  <?php else : ?>
    <div class="error-area">
      <div class="d-table">
        <div class="d-table-cell">
          <div class="container">
            <div class="error-content">
              <h1 style="color:brown">404</h1>
              <h2>Oops! Foto Tidak Ada!</h2>
              <p>Halaman yang dituju tidak ada, mungkin sudah dihapus atau dialihkan</p>
              <div class="button">
                <a class="btn btn-warning py-3 px-5 mt-2" style="border-radius: 30px 0 0 30px;" href="<?= site_url('') ?>">Back to Home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
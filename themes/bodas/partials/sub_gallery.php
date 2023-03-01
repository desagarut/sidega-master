<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container-fluid p-0 mb-5">
  <div class="owl-carousel header-carousel position-relative">

    <?php if ($gallery) : ?>
      <?php foreach ($gallery as $album) : ?>
        <?php if (is_file(LOKASI_GALERI . "sedang_" . $album['gambar'])) : ?>
          <?php $link = AmbilGaleri($album['gambar'], 'sedang') ?>
          <div class="portfolio-description shadow" style="padding:10px 10px 10px 10px">
            <img src="<?= AmbilGaleri($album['gambar'], 'sedang') ?>" class="img-fluid" alt="<?= $album['nama'] ?>" style="width:100%; height:100%">
            <div class="portfolio-info container">
              <h3>
                <small>Judul:</small> <?= $album['nama'] ?>
              </h3>
              <br /><br />
              <ul>
                <li><strong>Keterangan</strong>:
                  <?= $album['nama'] ?>
                </li>
                <li><strong>Upload</strong>: </li>
                <li><strong>Oleh</strong>: </li>
              </ul>
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
                <h1>404</h1>
                <h2>Oops! Tidak Ada Data!</h2>
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
</div>
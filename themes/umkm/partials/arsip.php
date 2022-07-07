<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Start Single Product -->
<?php if (count($farsip) > 0) : ?>
  <?php foreach ($farsip as $data) : ?>
      <div class="single-product">
        <div class="product-image"> <img src="<?= AmbilFotoArtikel($data['gambar' . $i], 'sedang') ?>" alt="#">
        </div>
        <div class="product-info">
          <h4 class="title"> <a href="<?= site_url('artikel/' . buat_slug($data)) ?>" alt="<?= $data['judul'] ?>">
              <?= $data['judul'] ?>
            </a> </h4>
          <time>
            <?= tgl_indo($data['tgl_upload']) ?>
          </time>
          | <span>
            <?= $data['owner'] ?>
          </span><br />
          <a class="button btn btn-warning" href="<?= site_url('artikel/' . buat_slug($data)) ?>"> Baca</a>
        </div>
      </div>
  <?php endforeach; ?>
<?php endif; ?>
<!-- Start Single Product -->
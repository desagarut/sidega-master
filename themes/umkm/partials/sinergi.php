

<div class="brands lazy">
  <div class="container">
    <?php foreach ($sinergi_program as $key => $program) : ?>
      <?php $baris[$program['baris']][$program['kolom']] = $program; ?>
    <?php endforeach; ?>
    <div class="brands-logo-wrapper">

      <div class="brands-logo-carousel d-flex align-items-center justify-content-between">

        <?php foreach ($baris as $baris_program) : ?>
          <?php $width = 100 / count($baris_program) - count($baris_program) ?>
          <?php foreach ($baris_program as $key => $program) : ?>
            <div class="brand-logo">
              <a href="<?= $program['tautan'] ?>" target="_blank">
                <img src="<?= base_url() . LOKASI_GAMBAR_WIDGET . $program['gambar'] ?>" alt="<?= $program['judul'] ?>">
              </a>
            </div>
            <?php endforeach; ?>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</div>

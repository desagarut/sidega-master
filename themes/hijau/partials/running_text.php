<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="runningtext container">
  <?php foreach ($teks_berjalan AS $teks): ?>
  <div class="row">
    <div class="col-md-12">
        <h6><a href="<?= $teks['tautan'] ?>" title="Baca Selengkapnya">
          <marquee onmouseover="this.stop()" onmouseout="this.start()">
          <?= $teks['teks']?>
          <?php if ($teks['tautan']): ?>
              <?= $teks['judul_tautan']?>
          <?php endif; ?>
          <!--</span> -->
          </marquee></a>
        </h6>
    </div>
  </div>
  <?php endforeach; ?>
</div>

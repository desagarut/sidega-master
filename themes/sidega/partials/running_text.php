<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="portfolio-details" data-aos="fade-left">
  <?php foreach ($teks_berjalan AS $teks): ?>
  <div class="row">
    <div class="col-md-12">
      <div class="member" data-aos="fade-up">
        <h6><a href="<?= $teks['tautan'] ?>" rel="noopener noreferrer" title="Baca Selengkapnya">
          <marquee onmouseover="this.stop()" onmouseout="this.start()">
          <!--<span class="teks" style="padding-right: 50px;">-->
          <?= $teks['teks']?>
          <?php if ($teks['tautan']): ?>
              <?= $teks['judul_tautan']?>
          <?php endif; ?>
          <!--</span> -->
          </marquee></a>
        </h6>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

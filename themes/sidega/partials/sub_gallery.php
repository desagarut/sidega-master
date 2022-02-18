<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <!-- ======= Portfolio Details Section ======= -->

<section id="portfolio-details" class="portfolio-details">
  <div class="container" data-aos="fade-up">
    <div class="portfolio-details-container">
      <div class="owl-carousel portfolio-details-carousel">
        <?php if($gallery) : ?>
        <?php foreach($gallery as $album) : ?>
        <?php if(is_file(LOKASI_GALERI . "kecil_" . $album['gambar'])) : ?>
        <?php $link = AmbilGaleri($album['gambar'],'sedang') ?>
        <div class="portfolio-description"> 
        	<img src="<?= AmbilGaleri($album['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $album['nama'] ?>" style="width:100%; height:600px">
            <div class="portfolio-info" style="background:rgba(10, 4, 4, 0.6)">
                <h3>
                  <small>Kategori:</small> <?= $album['nama'] ?> 
                </h3>
                <br/><br/>
               <!-- <ul>
                  <li><strong>Album</strong>:
                    <?= $album['nama'] ?>
                  </li>
                  <li><strong>Client</strong>: ASU Company</li>
                  <li><strong>Project date</strong>: 01 March, 2020</li>
                  <li><strong>Project URL</strong>: <a href="#">www.example.com</a></li>
                </ul>-->
          </div>
        </div>
        <?php endif ?>
        <?php endforeach ?>
        <?php endif ?>
      </div>
    </div>
  </div>
</section>
<!-- End Portfolio Details Section -->

<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- ======= Portfolio Slider ======= -->

<div class="container">
  <section id="portfolio-details" class="portfolio-details">
    <div class="row">
      <div class="col-md-12" style="padding-top:50px">
        <?php $this->load->view($folder_themes .'/partials/running_text') ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="portfolio-details-container" data-aos="fade-right" data-aos-delay="300">
          <div class="owl-carousel portfolio-details-carousel">
            <?php $active = true; ?>
            <?php foreach ($slider_gambar['gambar'] as $gambar) : ?>
            <?php $file_gambar = $slider_gambar['lokasi'] . 'sedang_' . $gambar['gambar']; ?>
            <?php if(is_file($file_gambar)) : ?>
            <div class="portfolio-description"> <a class="archive__link" href="<?='artikel/'.buat_slug($gambar); ?>"> <img src="<?php echo base_url().$slider_gambar['lokasi'].'sedang_'.$gambar['gambar']?>" class="img-fluid" alt="<?= $gambar['judul'] ?>"> </a>
              <div class="portfolio-info">
                <h3> <a class="archive__link" href="<?='artikel/'.buat_slug($gambar); ?>">
                  <?= $gambar['judul'] ?>
                  </a></h3>
              </div>
            </div>
            <?php $active = false; ?>
            <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <?php $this->load->view($folder_themes .'/partials/portal-atas') ?>
      </div>
    </div>
  </section>
</div>
<!-- End Portfolio Details Section --> 

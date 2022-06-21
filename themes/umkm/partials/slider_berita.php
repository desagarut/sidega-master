<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="hero-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-12 custom-padding-right">
        <div class="slider-head"> 
          <!-- Start Hero Slider -->
          <div class="hero-slider">
            <?php $active = true; ?>
            <?php foreach ($slider_gambar['gambar'] as $gambar) : ?>
            <?php $file_gambar = $slider_gambar['lokasi'] . 'sedang_' . $gambar['gambar']; ?>
            <?php if(is_file($file_gambar)) : ?>
            <div class="single-slider"
                                style="background-image: url(<?php echo base_url().$slider_gambar['lokasi'].'sedang_'.$gambar['gambar']?>" class="entry-image" alt="<?= $gambar['judul'] ?>);">
            <div class="content">
              <h4 style="color:#FFF; text-shadow: 4px 4px 4px #081828; -webkit-text-stroke: 0.25px #081828;">
                <?= $gambar['kategori_toko'] ?>
              </h4>
              <h2 style="color:#FFF; text-shadow: 5px 5px 5px #081828; -webkit-text-stroke: 0.25px #081828;">
                <?= $gambar['judul'] ?>
              </h2>
              <div class="row"> <a class="" href="<?='artikel/'.buat_slug($gambar); ?>">
                <button class="button btn btn-warning"><i class="ri-store-2-fill" style="color:#fff;"></i>
                <?= $gambar['judul'] ?>
                </button>
                </a> <a href="<?='artikel/'.buat_slug($gambar); ?>"title="Selengkapnya">
                <button class="button btn btn-success"><i class="icofont-whatsapp"></i> Baca</button>
                </a> </div>
            </div>
          </div>
          <?php endif; ?>
          <?php endforeach; ?>
          <?php $active = false; ?>
        </div>
        <!-- End Hero Slider --> 
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="row">
        <div class="col-lg-12 col-md-6 col-12 md-custom-padding"> 
          <!-- Start Small Banner -->
          <div class="hero-small-banner"
                                style="background-image: url('<?php echo base_url('desa/logo/umkm_juara.jpg')?>');">
            <div class="content" style="padding-top:180px">
              <h2 style="color:#FC0; text-shadow: 4px 4px 4px #081828; -webkit-text-stroke: 0.25px #081828;"> "Tinggal di desa, Rezeki kota, Bisnis mendunia" </h2>
              <h3 style="text-shadow: 4px 4px 4px #FFF;">~ Ridwan Kamil ~</h3>
            </div>
          </div>
          <!-- End Small Banner --> 
        </div>
        <div class="col-lg-12 col-md-6 col-12"> 
          <!-- Start Small Banner -->
          <div class="hero-small-banner style2">
            <div class="content">
                
                  <marquee behavior="alternate" scrollamount="1">
                  <a href="<?= site_url('first/toko_show') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/toko.png" ) ?>" width="70px" /> </a> <a href="<?= site_url('first/tukang') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/tukang.png" ) ?>" width="70px" /> </a> <a href="<?= site_url('first/tawa') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/transport.png" ) ?>" width="70px" /> </a> <a href="<?= site_url('first/wisata') ?>"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/wisata.png" ) ?>" width="70px" /> </a>
                  </marquee>
            </div>
          </div>
          <!-- Start Small Banner --> 
        </div>
      </div>
    </div>
  </div>
</section>

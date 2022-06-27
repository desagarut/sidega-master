<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="hero-area">
  <div class="container">
    <div class="row">
      <?php if($produk_data) : ?>
      <div class="col-lg-8 col-12 custom-padding-right">
        <div class="slider-head"> 
          <div class="hero-slider">
            <?php foreach($produk_data as $album) : ?>
            <?php if(is_file(LOKASI_GALERI . "sedang_" . $album['gambar'])) : ?>
            <?php $link = site_url('first/tawa_layanan/'.$album['id']) ?>
            <div class="single-slider"
                                style="background-image: url(<?= AmbilGaleri($album['gambar'],'sedang') ?>);">
              <div class="content">
                <h2 style="color:#FFF; text-shadow: 5px 5px 5px #081828; -webkit-text-stroke: 0.25px #081828;"><span></span> Nama usaha :
                  <?= $sub['nama'] ?>
                </h2>
                <div class="button"> <a class="" href="<?= site_url('first/tawa_layanan/'.$album['id']) ?>">
                  <button class="btn btn-warning"><i class="ri-store-2-fill" style="color:#fff;"></i> Pengelola:
                  <?= $sub['nama_pengelola'] ?>
                  </button>
                  </a> <a href="https://wa.me/+62<?= $album['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20layanan%20anda%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $album['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/tawa_layanan/'.$album['id']) ?>" target="_blank" title="pesan">
                  <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
                  </a> </div>
              </div>
            </div>
            <?php endif ?>
            <?php endforeach ?>
          </div>
        </div>
      </div>
      <?php endif ?>
      <div class="col-lg-4 col-12">
        <div class="row">
          <div class="col-lg-12 col-md-6 col-12 md-custom-padding"> 
            <!-- Start Small Banner -->
            <div class="hero-small-banner text-center" style="background-image: url('<?php $this->load->view($folder_themes . "/partials/tawa/peta_view.php") ?>
                  <div class="content"> </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


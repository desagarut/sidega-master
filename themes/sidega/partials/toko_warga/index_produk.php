<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- ======= Portfolio Details Section ======= -->

<div class="section-title" data-aos="fade-up">
<section id="portfolio-details" class="portfolio-details">
  <div class="row">
  <div class="col-md-8">
    <div class="portfolio-details-container" data-aos="fade-right" data-aos-delay="300">
      <div class="owl-carousel portfolio-details-carousel">
        <?php if($produk_data) : ?>
        <?php foreach($produk_data as $album) : ?>
        <?php if(is_file(LOKASI_GALERI . "kecil_" . $album['gambar'])) : ?>
        <?php $link = site_url('first/produk_show/'.$album['id']) ?>
        <div class="portfolio-description"> <a class="archive__link" href="#"> <img src="<?= AmbilGaleri($album['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $album['nama'] ?>"> </a>
          <div class="portfolio-info">
            <h3 style="color:#FFF">
              <?= $album['nama'] ?>
              | <small style="color:#FFC; font-size:12px"><?= $album['sebutan_biaya'] ?>:</small>
              <?= $rupiah($album['harga']) ?>
        <a href="https://wa.me/+62<?= $sub['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20ingin%20membeli%20produk%20<?= $album['nama'] ?>%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>.%20Apakah%20<?= $album['nama'] ?>%20masih%20tersedia%3F%20" target="_blank" title="Beli Sekarang">
              <button class="btn btn-danger"><i class="icofont-whatsapp"></i> Beli</button>
              </a></h3>
          </div>
          </div>
          <?php endif ?>
          <?php endforeach ?>
          <?php endif ?>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <?php $this->load->view($folder_themes .'/partials/toko_warga/info_towa.php') ?>
    </div>
  </div>
</section>
<h2><i class="ri-store-2-fill" style="color:#e80368;"></i> Daftar Produk <strong class="color:#e80368">
  <?= $sub['nama'] ?>
  </strong></h2>
<div class="row">
  <div class="col-lg-3 col-md-6 align-items-stretch">
    <div class="member" data-aos="fade-right">
      <div class="member-img"> <img src="<?= AmbilGaleri($sub['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $sub['nama'] ?>" style="width:100%; height:225px">
        <div class="member-info" style="background-color:#FFD7EB">
          <h5><i class="ri-store-2-fill" style="color: #e80368;"></i>
            <?= $sub['nama'] ?>
          </h5>
          <span style="color:#03F"><i class="ri-store-2-fill"></i> Kategori
          <?= $sub['kategori_toko'] ?>
          </span> <span style="color:#0C0"><i class="icofont-gift" ></i> Unggulan :
          <?= $sub['produk_utama']?>
          </span> <span style="color:#F60"><i class="icofont-user"></i>
          <?= $sub['nama_pengelola']?>
          </span> <span style="color:#F09"><i class="icofont-location-pin"></i>
          <?= $sub['lokasi'] ?>
          </span> <br/>
            <a href="<?= site_url('first/toko_show') ?>" ><button class="btn btn-danger"><i class="icofont-reply-all"></i></button></a>
        <a href="https://wa.me/+62<?= $sub['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20produk%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>.%20Apakah%20<?= $sub['nama'] ?>%20masih%20buka%3F" target="_blank" title="pesan">
          <button class="btn btn-primary"><i class="icofont-whatsapp"></i> Hubungi</button>
          </a>
          <div class="social"> <a href="https://youtube.com/channel/<?= $sub['youtube'] ?>" target="_blank"><i class="icofont-youtube"></i></a> <a href="<?= $sub['website'] ?>" target="_blank"><i class="icofont-globe"></i></a> <a href="https://facebook.com/<?= $sub['fb'] ?>" target="_blank"><i class="icofont-facebook"></i></a> <a href="https://instagram.com/<?= $sub['ig'] ?>" target="_blank"><i class="icofont-instagram"></i></a> <a href="phone:<?= $sub['no_hp_toko'] ?>" target="_blank"><i class="icofont-phone"></i></a> </div>
        </div>
      </div>
    </div>
  </div>
  <?php if($produk_data) : ?>
  <?php foreach($produk_data as $album) : ?>
  <?php if(is_file(LOKASI_GALERI . "kecil_" . $album['gambar'])) : ?>
  <?php $link = site_url('first/produk_show/'.$album['id']) ?>
  <div class="col-lg-3 col-md-6 align-items-stretch owl-carousel portfolio-details-carousel">
    <div class="member" data-aos="fade-up">
      <div class="member-img"> <img src="<?= AmbilGaleri($album['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $album['nama'] ?>" style="width:100%; height:225px">
        <div class="social"> <a href="https://youtube.com/channel/<?= $sub['youtube'] ?>" target="_blank"><i class="icofont-youtube"></i></a> <a href="<?= $sub['website'] ?>"><i class="icofont-globe" target="_blank"></i></a> <a href="https://facebook.com/<?= $sub['fb'] ?>" target="_blank"><i class="icofont-facebook"></i></a> <a href="https://instagram.com/<?= $sub['ig'] ?>" target="_blank"><i class="icofont-instagram"></i></a> <a href="phone:<?= $sub['no_hp_toko'] ?>" target="_blank"><i class="icofont-phone"></i></a> </div>
      </div>
      <div class="member-info">
        <h4 style="color:#C00">
          <?= $album['nama'] ?>
        </h4>
        <p class="text-justify member-info-detail">
          <?= $album['deskripsi'] ?>
        <h5 style="color:#C00">
          <small style="color:#03F; font-size:12px"><?= $album['sebutan_biaya'] ?></small> <?= $rupiah($album['harga']) ?><i><small style="color:#666; font-size:10px"> / <?= $album['sebutan_ukuran'] ?></small></i>
        </h5>
        </p>
        <br/>
        <a href="https://wa.me/+62<?= $sub['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20ingin%20membeli%20produk%20<?= $album['nama'] ?>%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>.%20Apakah%20<?= $album['nama'] ?>%20masih%20tersedia%3F%20" target="_blank" title="Beli Sekarang">
        <button class="btn btn-danger"><i class="icofont-whatsapp"></i> Beli</button>
        </a> </div>
    </div>
  </div>
  <?php endif ?>
  <?php endforeach ?>
  <?php endif ?>
</div>
<!-- End Our Team Section --> 

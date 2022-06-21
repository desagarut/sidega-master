<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- ======= Portfolio Details Section ======= -->

<div class="section-title" data-aos="fade-up">
  <section id="portfolio-details" class="portfolio-details">
    <div class="row">
      <?php if($main) : ?>
      <div class="col-md-8">
        <div class="portfolio-details-container" data-aos="fade-right" data-aos-delay="300">
          <div class="owl-carousel portfolio-details-carousel">
            <?php foreach($main as $data) : ?>
            <?php if(is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])) : ?>
            <?php $link = site_url('first/produk_show/'.$data['id']) ?>
            <div class="portfolio-description"> <a class="archive__link" href="<?= site_url('first/produk_show/'.$data['id']) ?>"> <img src="<?= AmbilGaleri($data['gambar'],'sedang') ?>" class="img-fluid" alt="<?= $data['nama'] ?>"> </a>
              <div class="portfolio-info">
                <h3> <a class="" href="<?= site_url('first/produk_show/'.$data['id']) ?>">
                  <button class="btn btn-warning"><i class="ri-store-2-fill" style="color:#fff;"></i> UMKM:
                  <?= $data['nama'] ?>
                  </button>
                  <a href="https://wa.me/+62<?= $data['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20produk%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $data['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/produk_show/'.$data['id']) ?>" target="_blank" title="pesan">
                  <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
                  </a> </h3>
              </div>
            </div>
            <?php endif ?>
            <?php endforeach ?>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <?php $this->load->view($folder_themes .'/partials/toko_warga/qr-code.php') ?>
      </div>
      <?php endif ?>
    </div>
  </section>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="member" data-aos="fade-up">
      <h4><i class="ri-store-2-fill" style="color:#e80368;"></i> Daftar Toko Warga <strong style="color:#C00">
        <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
        </strong></h4>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3 align-items-stretch owl-carousel portfolio-details-carousel">
    <div class="member">
      <div class="member-img"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/toko.png" ) ?>" class="img-fluid" alt="" style="width:100%; height:225px"> </div>
      <div class="member-info" style="background-color:#FFD7EB">
        <h4> <strong style="color:#C00">TOWA</strong>: TOKO WARGA </h4>
        <p class="text-center"><strong>adalah </strong> wadah bagi <strong>UMKM</strong> (Usaha Masyarakat Kecil Menengah) di wilayah <strong>
          <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
          </strong>, yang dikembangkan untuk membantu meningkatkan pertumbuhan ekonomi masyarakat desa.</p>
      </div>
    </div>
  </div>
  <div class="col-md-9 align-items-stretch">
    <div class="row">
      <?php if($main) : ?>
      <?php foreach($main as $data) : ?>
      <?php if(is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
      <?php $link = site_url('first/produk_show/'.$data['id']) ?>
      <div class="col-md-4 align-items-stretch owl-carousel portfolio-details-carousel">
        <div class="member">
          <div class="member-img"><a class="archive__link" href="<?= site_url('first/produk_show/'.$data['id']) ?>"> <img src="<?= AmbilGaleri($data['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $data['nama'] ?>" style="width:100%; height:225px"></a>
            <div class="social"> <a href="https://youtube.com/channel/<?= $data['youtube'] ?>" target="_blank"><i class="icofont-youtube"></i></a> <a href="<?= $data['website'] ?>" target="_blank"><i class="icofont-globe"></i></a> <a href="https://facebook.com/<?= $data['fb'] ?>" target="_blank"><i class="icofont-facebook"></i></a> <a href="https://instagram.com/<?= $data['ig'] ?>" target="_blank"><i class="icofont-instagram"></i></a> <a href="phone:<?= $data['no_hp_toko'] ?>" target="_blank"><i class="icofont-phone"></i></a> </div>
          </div>
          <div class="member-info">
            <h4 style="color:#C00"> <a class="archive__link" href="<?= site_url('first/produk_show/'.$data['id']) ?>">
              <?= $data['nama'] ?>
              </a> </h4>
            <span style="color:#03F"><i class="ri-store-2-fill"></i> Toko
            <?= $data['kategori_toko'] ?>
            </span> <span style="color:#0C0"><i class="icofont-gift" ></i> Produk unggulan :
            <?= $data['produk_utama']?>
            </span> <span style="color:#F60"><i class="icofont-user"></i>
            <?= $data['nama_pengelola']?>
            </span> <span style="color:#F09"><i class="icofont-location-pin"></i>
            <?= $data['lokasi'] ?>
            </span> <br/>
            <a href="https://wa.me/+62<?= $data['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20produk%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20*<?= $data['nama'] ?>*%20masih%20buka%3F%20%20<?= site_url('first/produk_show/'.$data['id']) ?>" target="_blank" title="pesan">
            <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
            </a> <a href="<?= site_url('first/produk_show/'.$data['id']) ?>"  title="Produk">
            <button class="btn btn-danger"><i class="icofont-info"></i> Produk</button>
            </a> </div>
        </div>
      </div>
      <?php endif ?>
      <?php endforeach ?>
      <?php endif ?>
    </div>
  </div>
</div>
<!-- End Our Team Section --> 

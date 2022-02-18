<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- ======= Portfolio Details Section ======= -->

<div class="section-title" data-aos="fade-up">
<section id="portfolio-details" class="portfolio-details">
  <div class="row">
  <div class="col-md-8">
    <div class="portfolio-details-container" data-aos="fade-right" data-aos-delay="300">
      <div class="owl-carousel portfolio-details-carousel">
        <?php if($layanan_data) : ?>
        <?php foreach($layanan_data as $album) : ?>
        <?php if(is_file(LOKASI_GALERI . "kecil_" . $album['gambar'])) : ?>
        <?php $link = site_url('first/tukang_layanan/'.$album['id']) ?>
        <div class="portfolio-description"> <a class="archive__link" href="#"> <img src="<?= AmbilGaleri($album['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $album['nama'] ?>"> </a>
          <div class="portfolio-info">
            <h3 style="color:#FFF">
              <?= $album['nama'] ?>
              | <small style="color:#FFC; font-size:12px"><?= $album['sebutan_biaya'] ?>:</small>
              <?= $rupiah($album['harga']) ?>
        <a href="https://wa.me/+62<?= $data['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20keahlian%20anda%20tentang%20<?= $album['nama'] ?>%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>.%20Saya%20ada%20pekerjaan%20yang%20mungkin%20cocok%20dengan%20keahlian%20anda.%20Apakah%20kita%20dapat%20membicarakannya%20lebih%20lanjut%3F" target="_blank" title="pesan">
              <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
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
      <?php $this->load->view($folder_themes .'/partials/tukang/info_tukang.php') ?>
    </div>
  </div>
</section>
</div>
<div class="row">
  <div class="col-md-12" data-aos="fade-left">
    <h5 align="center"><i class="ri-map-2-fill" style="color:#F90;"></i> SPESIALISASI <strong class="color:#60C">
      <?= $sub['nama'] ?>
      </strong></h5>
  </div>
</div>
<div class="row">
  <div class="col-lg-3 col-md-6 align-items-stretch">
    <div class="member" data-aos="fade-right">
      <div class="member-img"> <img src="<?= AmbilGaleri($sub['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $sub['nama'] ?>" style="width:100%; height:225px">
        <div class="member-info"  style="background-color:#FFC">
        <h4> <strong style="color:#F60"><?= $sub['nama'] ?></strong></h4>
          <span style="color:#666" class="text-justify member-info-detail">
          <strong>Pengelola</strong> : <?= $sub['nama_pengelola']?>
          </span> <span style="color:#666" class="text-justify member-info-detail">
          <strong>Layanan</strong> : <?= $sub['jenis_layanan'] ?>
          </span><span style="color:#666" class="text-justify member-info-detail">
          <strong>Pekerjaan</strong> : <?= $sub['jenis_pekerjaan'] ?>
          </span> <span style="color:#666" class="text-justify member-info-detail">
          <strong>Bidang</strong> : <?= $sub['kategori_pekerjaan']?>
          </span> <span style="color:#666" class="text-justify member-info-detail">
          <strong>Area</strong> : <?= $sub['area']?>
          </span> <span style="color:#666" class="text-justify member-info-detail">
          <strong>Alamat</strong> : <br/><i><?= $sub['lokasi'] ?></i><br/>
          </span> <br/>
            <a href="<?= site_url('first/tukang') ?>" ><button class="btn btn-danger"><i class="icofont-reply-all"></i></button></a>
        <a href="https://wa.me/+62<?= $data['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20keahlian%20anda%20tentang%20<?= $sub['jenis_layanan'] ?>%20<?= $sub['kategori_pekerjaan'] ?>%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>.%20Saya%20ada%20pekerjaan%20yang%20mungkin%20cocok%20dengan%20keahlian%20anda.%20Apakah%20kita%20dapat%20membicarakannya%20lebih%20lanjut%3F" target="_blank" title="pesan">
          <button class="btn btn-primary"><i class="icofont-whatsapp"></i> Hubungi</button>
          </a>
          <div class="social"> <a href="https://youtube.com/channel/<?= $sub['youtube'] ?>" target="_blank"><i class="icofont-youtube"></i></a> <a href="<?= $sub['website'] ?>" target="_blank"><i class="icofont-globe"></i></a> <a href="https://facebook.com/<?= $sub['fb'] ?>" target="_blank"><i class="icofont-facebook"></i></a> <a href="https://instagram.com/<?= $sub['ig'] ?>" target="_blank"><i class="icofont-instagram"></i></a> <a href="phone:<?= $sub['no_hp_pengelola'] ?>" target="_blank"><i class="icofont-phone"></i></a> </div>
        </div>
      </div>
    </div>
  </div>
  <?php if($layanan_data) : ?>
  <?php foreach($layanan_data as $album) : ?>
  <?php if(is_file(LOKASI_GALERI . "kecil_" . $album['gambar'])) : ?>
  <?php $link = site_url('first/produk_show/'.$album['id']) ?>
  <div class="col-lg-3 col-md-6 align-items-stretch owl-carousel portfolio-details-carousel">
    <div class="member" data-aos="fade-up">
      <div class="member-img"> <img src="<?= AmbilGaleri($album['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $album['nama'] ?>" style="width:100%; height:225px">
        <div class="social"> <a href="https://youtube.com/channel/<?= $sub['youtube'] ?>" target="_blank"><i class="icofont-youtube"></i></a> <a href="<?= $sub['website'] ?>"><i class="icofont-globe" target="_blank"></i></a> <a href="https://facebook.com/<?= $sub['fb'] ?>" target="_blank"><i class="icofont-facebook"></i></a> <a href="https://instagram.com/<?= $sub['ig'] ?>" target="_blank"><i class="icofont-instagram"></i></a> <a href="phone:<?= $sub['no_hp_pengelola'] ?>" target="_blank"><i class="icofont-phone"></i></a> </div>
      </div>
      <div class="member-info ">
        <h4 style="color:#F60">
          <?= $album['nama'] ?>
        </h4>
        <p class="text-justify member-info-detail" align="justify">
		  <span style="color:#666" class="text-justify member-info-detail">
          <strong>Bidang</strong> : <?= $sub['kategori_pekerjaan']?>
          </span>
		  <span style="color:#666" class="text-justify member-info-detail">
          <strong>Deskripsi Pekerjaan</strong> : <br/><?= $album['deskripsi'] ?>
          </span>
        <h5 style="color:#C00">
          <small style="color:#03F; font-size:12px"><?= $album['sebutan_biaya'] ?></small> <?= $rupiah($album['harga']) ?><i><small style="color:#666; font-size:10px"> / <?= $album['sebutan_ukuran'] ?></small></i>
        </h5>
        </p>
        <br/>
        <a href="https://wa.me/+62<?= $data['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20keahlian%20anda%20tentang%20<?= $album['nama'] ?>%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>.%20Saya%20ada%20pekerjaan%20yang%20mungkin%20cocok%20dengan%20keahlian%20anda.%20Apakah%20kita%20dapat%20membicarakannya%20lebih%20lanjut%3F" target="_blank" title="pesan">
        <button class="btn btn-warning"><i class="icofont-whatsapp"></i> Hubungi</button>
        </a> </div>
    </div>
  </div>
  <?php endif ?>
  <?php endforeach ?>
  <?php endif ?>
</div>
<!-- End Our Team Section --> 

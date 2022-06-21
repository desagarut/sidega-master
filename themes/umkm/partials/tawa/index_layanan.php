<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- ======= Portfolio Details Section ======= -->


<div class="section-title">
<section id="portfolio-details" class="portfolio-details">
  <div class="row">
    <div class="col-md-8">
      <div class="portfolio-details-container">
        <div class="owl-carousel portfolio-details-carousel">
          <?php if($produk_data) : ?>
          <?php foreach($produk_data as $album) : ?>
          <?php if(is_file(LOKASI_GALERI . "sedang_" . $album['gambar'])) : ?>
          <?php $link = site_url('first/tawa_layanan/'.$album['id']) ?>
          <div class="portfolio-description"> <a class="archive__link" href="#"> <img src="<?= AmbilGaleri($album['gambar'],'sedang') ?>" class="img-fluid" alt="<?= $album['nama'] ?>"> </a>
            <div class="portfolio-info">
              <h3 style="color:#FFF">
                <?= $album['nama'] ?>
                | <small style="color:#FFC; font-size:12px">
                <?= $album['sebutan_biaya'] ?>
                :</small>
                <?= $rupiah($album['harga']) ?>
                <a href="https://wa.me/+62<?= $sub['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20layanan%20yang%20anda%20tawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20layanannya%20masih%20tersedia%3F%20<?= site_url('first/tawa_layanan/'.$sub['id']) ?>" target="_blank" title="pesan">
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
    <div class="col-md-4" style="padding-top:10px;">
      <?php $this->load->view($folder_themes .'/partials/tawa/info_transportasi.php') ?>
    </div>
  </div>
</section>
<div class="row">
  <div class="col-md-12">
    <div class="member" data-aos="fade-up">
      <h4><i class="ri-store-2-fill" style="color:#e80368;"></i> Daftar Layanan <strong style="color:#060">
        <?= $sub['nama'] ?>
        </strong></h4>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3 align-items-stretch owl-carousel portfolio-details-carousel">
    <div class="member">
      <div class="member-img"> <img src="<?= AmbilGaleri($sub['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $sub['nama'] ?>" style="width:100%; height:225px">
        <div class="member-info" style="background-color:#AEFFAE">
          <h5><i class="ri-store-2-fill" style="color: #e80368;"></i>
            <?= $sub['nama'] ?>
          </h5>
          <span style="color:darkslateblue" class="text-left"><i class="icofont-user" style="color:darkorange"></i><strong> Nama :</strong>
          <?= $sub['nama_pengelola']?>
          </span> <span style="color:darkslateblue" class="text-left"><i class="icofont-long-drive" style="color:#03F"></i><strong> Kategori :</strong>
          <?= $sub['jenis_usaha'] ?>
          </span> <span style="color:darkslateblue" class="text-left"><i class="icofont-gift" style="color:#066"></i><strong> Usaha :</strong>
          <?= $sub['kelompok_usaha']?>
          </span> <span style="color:darkslateblue" class="text-left"><i class="icofont-map-pins" style="color:#63F"></i><strong> Layanan :</strong>
          <?= $sub['area']?>
          </span> <span style="color:darkslateblue" class="text-left"><i class="icofont-map-pins" style="color:#63F"></i><strong> Tayek :</strong>
          <?= $sub['trayek']?>
          </span> <span style="color:darkslateblue" class="text-left"><i class="icofont-location-pin" style="color:#F09"></i><strong> Lokasi : </strong>
          <?= $sub['lokasi'] ?>
          </span> <br/>
          <a href="<?= site_url('first/tawa') ?>" >
          <button class="btn btn-danger"><i class="icofont-reply-all"></i></button>
          </a> <a href="https://wa.me/+62<?= $sub['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20layanan%20anda%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>.%20Apakah%20layanannya%20masih%20tersedia%3F" target="_blank" title="pesan">
          <button class="btn btn-primary"><i class="icofont-whatsapp"></i> Hubungi</button>
          </a>
          <div class="social"> <a href="https://youtube.com/channel/<?= $sub['youtube'] ?>" target="_blank"><i class="icofont-youtube"></i></a> <a href="<?= $sub['website'] ?>" target="_blank"><i class="icofont-globe"></i></a> <a href="https://facebook.com/<?= $sub['fb'] ?>" target="_blank"><i class="icofont-facebook"></i></a> <a href="https://instagram.com/<?= $sub['ig'] ?>" target="_blank"><i class="icofont-instagram"></i></a> <a href="phone:<?= $sub['no_hp_pengelola'] ?>" target="_blank"><i class="icofont-phone"></i></a> </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-9 align-items-stretch">
    <div class="row">
      <?php if($produk_data) : ?>
      <?php foreach($produk_data as $album) : ?>
      <?php if(is_file(LOKASI_GALERI . "kecil_" . $album['gambar'])) : ?>
      <?php $link = site_url('first/produk_show/'.$album['id']) ?>
      <div class="col-md-4 align-items-stretch owl-carousel portfolio-details-carousel">
        <div class="member">
          <div class="member-img"> <img src="<?= AmbilGaleri($album['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $album['nama'] ?>" style="width:100%; height:225px">
            <div class="social"> <a href="https://youtube.com/channel/<?= $sub['youtube'] ?>" target="_blank"><i class="icofont-youtube"></i></a> <a href="<?= $sub['website'] ?>"><i class="icofont-globe" target="_blank"></i></a> <a href="https://facebook.com/<?= $sub['fb'] ?>" target="_blank"><i class="icofont-facebook"></i></a> <a href="https://instagram.com/<?= $sub['ig'] ?>" target="_blank"><i class="icofont-instagram"></i></a> <a href="phone:<?= $sub['no_hp_pengelola'] ?>" target="_blank"><i class="icofont-phone"></i></a> </div>
          </div>
          <div class="member-info">
            <h4 style="color:#C00">
              <?= $album['nama'] ?>
            </h4>
            <p class="text-justify member-info-detail"> <span><strong style="color:darkslateblue"> Jenis :</strong><a style="color: #03F;">
              <?= $album['jenis_kendaraan']?>
              </a></span> <span><strong style="color:darkslateblue"> Merek : </strong><a style="color: #03F;">
              <?= $album['merek']?>
              </a></span> <span><strong style="color:darkslateblue"> Kapasitas Muat : </strong><a style="color: #03F;">
              <?= $album['kapasitas']?>
              </a></span> <span><strong style="color:darkslateblue"> Warna Kendaraan : </strong><a style="color: #03F;">
              <?= $album['warna_kendaraan']?>
              </a></span> <span><strong style="color:darkslateblue"> Bahan Bakar : </strong><a style="color: #03F;">
              <?= $album['bahan_bakar']?>
              </a></span> <span><strong style="color:darkslateblue"> Deskripsi:</strong><br/>
              <a style="color: #03F;">
              <?= $album['deskripsi'] ?>
              </a></span>
            <h5 style="color:#C00"> <small style="color:#03F; font-size:12px">
              <?= $album['sebutan_biaya'] ?>
              </small>
              <?= $rupiah($album['harga']) ?>
              <i><small style="color:#666; font-size:10px"> /
              <?= $album['sebutan_ukuran'] ?>
              </small></i> </h5>
            </p>
            <br/>
            <a href="https://wa.me/+62<?= $sub['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20layanan%20*<?= $album['nama'] ?>*%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20layanannya%20masih%20tersedia%3F%20<?= site_url('first/tawa_layanan/'.$sub['id']) ?>" target="_blank" title="pesan">
            <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
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

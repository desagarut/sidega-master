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
            <?php $link = site_url('first/tukang_layanan/'.$data['id']) ?>
            <div class="portfolio-description"> <a class="archive__link" href="<?= site_url('first/tukang_layanan/'.$data['id']) ?>"> <img src="<?= AmbilGaleri($data['gambar'],'sedang') ?>" class="img-fluid" alt="<?= $data['nama'] ?>"> </a>
              <div class="portfolio-info">
                <h3> <a class="" href="<?= site_url('first/tukang_layanan/'.$data['id']) ?>">
                  <button class="btn btn-warning"><i class="ri-store-2-fill" style="color:#fff;"></i> UMKM:
                  <?= $data['nama'] ?>
                  </button>
                  </a> <a href="https://wa.me/+62<?= $data['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20keahlian%20anda%20yang%20ditawarkan%20di%20website%20desa.%20Apakah%20produknya%20masih%20tersedia%3F%20<?= site_url('first/tukang_layanan/'.$data['id']) ?>" target="_blank" title="pesan">
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
        <?php $this->load->view($folder_themes .'/partials/tukang/qr-code.php') ?>
      </div>
      <?php endif ?>
    </div>
  </section>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="member" data-aos="fade-up">
      <h4><i class="ri-store-2-fill" style="color:#e80368;"></i> Daftar Tukang Warga <strong style="color:#C30">
        <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
        </strong></h4>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3 align-items-stretch owl-carousel portfolio-details-carousel">
    <div class="member">
      <div class="member-img"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/tukang.png" ) ?>" class="img-fluid" alt="" style="width:100%; height:225px"> </div>
      <div class="member-info" style="background-color:#FFC">
        <h4> <strong style="color:#C00">TUKANG</strong> WARGA</h4>
        <p class="text-center"><strong>adalah </strong> wadah bagi masyarakat <strong>
          <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
          </strong> yang <strong>memiliki keahlian dibidang jasa</strong>.<br/>
          <strong>Melalui aplikasi Tukang</strong> diharapkan setiap individu warga dapat mempromosikan keahliannya kepada publik, sehingga dapat mempermudah para Tukang dalam memperoleh pekerjaan, serta membuka peluang kerja bagi angkatan kerja baru. <br/>
          Melalui aplikasi ini, <strong>Para Pemberi Kerja</strong> dapat dengan <strong>mudah memilih tenaga kerja</strong> sesuai dengan kebutuhkan pekerjaan, <strong>dengan cara menghubungi langsung kepada Para Tukang</strong> yang ada di wilayah desa kami.<br/>
          Dengan adanya aplikasi ini diharapkan dapat membantu meningkatkan pertumbuhan ekonomi masyarakat desa.</p>
      </div>
    </div>
  </div>
  <div class="col-md-9 align-items-stretch">
    <div class="row">
      <?php if($main) : ?>
      <?php foreach($main as $data) : ?>
      <?php if(is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
      <?php $link = site_url('first/tukang_layanan/'.$data['id']) ?>
      <div class="col-md-4 align-items-stretch owl-carousel portfolio-details-carousel">
        <div class="member">
          <div class="member-img"><a class="" href="<?= site_url('first/tukang_layanan/'.$data['id']) ?>"> <img src="<?= AmbilGaleri($data['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $data['nama'] ?>" style="width:100%; height:225px"></a>
            <div class="social"> <a href="https://youtube.com/channel/<?= $data['youtube'] ?>" target="_blank"><i class="icofont-youtube"></i></a> <a href="<?= $data['website'] ?>" target="_blank"><i class="icofont-globe"></i></a> <a href="https://facebook.com/<?= $data['fb'] ?>" target="_blank"><i class="icofont-facebook"></i></a> <a href="https://instagram.com/<?= $data['ig'] ?>" target="_blank"><i class="icofont-instagram"></i></a> <a href="phone:<?= $data['no_hp_pengelola'] ?>" target="_blank"><i class="icofont-phone"></i></a> </div>
          </div>
          <div class="member-info">
            <h4 style="color:#C00"> <a class="" href="<?= site_url('first/tukang_layanan/'.$data['id']) ?>">
              <?= $data['nama'] ?>
              </a> </h4>
            <span style="color:#F60"><i class="icofont-user"></i> <strong>
            <?= $data['nama_pengelola']?>
            </strong></span> <span style="color:#03F"><i class="icofont-long-drive"></i>
            <?= $data['jenis_layanan'] ?>
            </span> <span style="color:#63F"><i class="icofont-map-pins"></i> Area
            <?= $data['area']?>
            </span> <span style="color:#066"><i class="icofont-gift" ></i>
            <?= $data['kelompok_usaha']?>
            </span> <span style="color:#F09"><i class="icofont-location-pin"></i>
            <?= $data['lokasi'] ?>
            </span> <br/>
            <a href="https://wa.me/+62<?= $data['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20keahlian%20anda%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Saya%20ada%20pekerjaan%20yang%20mungkin%20cocok%20dengan%20keahlian%20anda.%20Apakah%20kita%20dapat%20membicarakannya%20lebih%20lanjut%3F%20<?= site_url('first/tukang_layanan/'.$data['id']) ?>" target="_blank" title="pesan">
            <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
            </a> <a href="<?= site_url('first/tukang_layanan/'.$data['id']) ?>"  title="Produk">
            <button class="btn btn-warning"><i class="icofont-info"></i> Layanan</button>
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

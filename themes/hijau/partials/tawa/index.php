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
            <?php $link = site_url('first/tawa_layanan/'.$data['id']) ?>
            <div class="portfolio-description"> <a class="archive__link" href="<?= site_url('first/tawa_layanan/'.$data['id']) ?>"> <img src="<?= AmbilGaleri($data['gambar'],'sedang') ?>" class="img-fluid" alt="<?= $data['nama'] ?>"> </a>
              <div class="portfolio-info">
                <h3> <a class="" href="<?= site_url('first/tawa_layanan/'.$data['id']) ?>">
                  <button class="btn btn-warning"><i class="ri-store-2-fill" style="color:#fff;"></i> UMKM:
                  <?= $data['nama'] ?>
                  </button>
                  </a> <a href="https://wa.me/+62<?= $data['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20layanan%20anda%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $data['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/tawa_layanan/'.$data['id']) ?>" target="_blank" title="pesan">
                  <button class="btn btn-success"><i class="icofont-whatsapp"></i> Pesan</button>
                  </a> </h3>
              </div>
            </div>
            <?php endif ?>
            <?php endforeach ?>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <?php $this->load->view($folder_themes .'/partials/tawa/qr-code.php') ?>
      </div>
      <?php endif ?>
    </div>
  </section>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="member" data-aos="fade-up">
      <h4><i class="ri-store-2-fill" style="color:#e80368;"></i> Daftar Layanan <strong style="color:#060"> Transportasi Warga
        <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
        </strong></h4>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3 align-items-stretch owl-carousel portfolio-details-carousel">
    <div class="member">
      <div class="member-img"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/transport.png" ) ?>" class="img-fluid" alt="" style="width:100%; height:225px"> </div>
      <div class="member-info" style="background-color:#B7FFDB">
        <h4> <strong style="color:#C00">TAWA</strong>: TRANSPORTASI WARGA </h4>
        <p class="text-center"><strong>adalah </strong> wadah bagi masyarakat <strong>
          <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
          </strong>, yang bertujuan untuk fasilitasi seluruh aktivitas warga, baik warga desa atau pendatang yang ingin melakukan perjalanan, <br/>
          selain itu melalui aplikasi ini dapat memberikan peluang bagi masyarakat untuk meningkatkan penghasilan keluarga serta sebagai salah satu upaya dalam mengurangi angka pengangguran di desa, dengan demikian diharapkan dapat membantu meningkatkan pertumbuhan ekonomi masyarakat <strong>
          <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
          </strong>.</p>
      </div>
    </div>
  </div>
  <div class="col-md-9 align-items-stretch">
    <div class="row">
      <?php if($main) : ?>
      <?php foreach($main as $data) : ?>
      <?php if(is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
      <?php $link = site_url('first/tawa_layanan/'.$data['id']) ?>
      <div class="col-md-4 align-items-stretch owl-carousel portfolio-details-carousel">
        <div class="member">
          <div class="member-img"><a href="<?= site_url('first/tawa_layanan/'.$data['id']) ?>"  title="Layanan"> <img src="<?= AmbilGaleri($data['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $data['nama'] ?>" style="width:100%; height:225px"></a>
            <div class="social"> <a href="https://youtube.com/channel/<?= $data['youtube'] ?>" target="_blank"><i class="icofont-youtube"></i></a> <a href="<?= $data['website'] ?>" target="_blank"><i class="icofont-globe"></i></a> <a href="https://facebook.com/<?= $data['fb'] ?>" target="_blank"><i class="icofont-facebook"></i></a> <a href="https://instagram.com/<?= $data['ig'] ?>" target="_blank"><i class="icofont-instagram"></i></a> <a href="phone:<?= $data['no_hp_pengelola'] ?>" target="_blank"><i class="icofont-phone"></i></a> </div>
          </div>
          <div class="member-info">
            <h4 style="color:#C00"> <a href="<?= site_url('first/tawa_layanan/'.$data['id']) ?>"  title="Detail Layanan <?= $data['nama'] ?>">
              <?= $data['nama'] ?>
              </a> </h4>
            <p class="text-left member-info-detail"> <span style="color:darkslateblue"><i class="icofont-user" style="color:darkorange"></i><strong> Nama :</strong>
              <?= $data['nama_pengelola']?>
              </span> <span style="color:darkslateblue"><i class="icofont-long-drive" style="color:#03F"></i><strong> Kategori :</strong>
              <?= $data['jenis_usaha'] ?>
              </span> <span style="color:darkslateblue"><i class="icofont-gift" style="color:#066"></i><strong> Usaha :</strong>
              <?= $data['kelompok_usaha']?>
              </span> <span style="color:darkslateblue"><i class="icofont-map-pins" style="color:#63F"></i><strong> Layanan :</strong>
              <?= $data['area']?>
              </span> <span style="color:darkslateblue"><i class="icofont-map-pins" style="color:#63F"></i><strong> Tujuan :</strong>
              <?= $data['trayek']?>
              </span> <span style="color:darkslateblue"><i class="icofont-location-pin" style="color:#F09"></i><strong> Lokasi : </strong>
              <?= $data['lokasi'] ?>
              </span> <br/>
            </p>
            <a href="https://wa.me/+62<?= $data['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20layanan%20anda%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20*<?= $data['nama'] ?>*%20masih%20buka%3F%%20<?= site_url('first/tawa_layanan/'.$data['id']) ?>" target="_blank" title="pesan">
            <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
            </a> <a href="<?= site_url('first/tawa_layanan/'.$data['id']) ?>"  title="Layanan">
            <button class="btn btn-primary"><i class="icofont-info"></i> Layanan</button>
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

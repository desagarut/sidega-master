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
            <?php if(is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
            <?php $link = site_url('first/wisata_fasilitas/'.$data['id']) ?>
            <div class="portfolio-description"> <a class="" href="<?= site_url('first/wisata_fasilitas/'.$data['id']) ?>"> <img src="<?= AmbilGaleri($data['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $data['nama'] ?>"> </a>
              <div class="portfolio-info">
                <h3> <a class="" href="<?= site_url('first/wisata_fasilitas/'.$data['id']) ?>">
                  <button class="btn btn-warning"><i class="ri-store-2-fill" style="color:#fff;"></i> WISATA:
                  <strong><?= $data['nama'] ?></strong>
                  </button>
                  </a> <a href="https://wa.me/+62<?= $data['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20<?= $data['nama'] ?>%20yang%20ada%20di%20website%20<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>.%20Dapatkah%20saya%20memperoleh%20informasi%20lebih%20banyak%20tentang%20<?= $data['nama'] ?>%3F" target="_blank" title="pesan">
                  <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi	</button>
                  </a> </h3>
              </div>
            </div>
            <?php endif ?>
            <?php endforeach ?>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <?php $this->load->view($folder_themes .'/partials/wisata/qr-code.php') ?>
      </div>
      <?php endif ?>
    </div>
  </section>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="member" data-aos="fade-up">
      <h4><i class="ri-store-2-fill" style="color:#e80368;"></i> Daftar Wisata <strong style="color:#606"> <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>
        </strong></h4>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-3 col-md-6 align-items-stretch owl-carousel portfolio-details-carousel">
    <div class="member" data-aos="fade-up">
      <div class="member-img"> <img src="<?= base_url("$this->theme_folder/$this->theme/assets/img/wisata.png" ) ?>" class="img-fluid" alt="" style="width:100%; height:225px"> </div>
      <div class="member-info" style="background-color:#EFDFFF">
        <h4> <strong style="color:#C00">WISATA</strong> DESA</h4>
        <p class="text-center"><strong>adalah </strong> fasilitas publik di wilayah <strong><?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></strong> yang dapat dikunjungi oleh wisatawan, baik domestik maupun manca negara. <strong>Wisata Desa</strong> dikembangkan untuk memperkenalkan potensi alam, budaya dan potensi wisata lainnya yang dapat dinikmati atau dipelajari, dengan harapan dapat membantu meningkatkan pertumbuhan ekonomi masyarakat serta menambah wawasan ilmu pengetahuan bagi wisatawan. 
      </div>
    </div>
  </div>
  <?php if($main) : ?>
  <?php foreach($main as $data) : ?>
  <?php if(is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
  <?php $link = site_url('first/wisata_fasilitas/'.$data['id']) ?>
  <div class="col-lg-3 col-md-6 align-items-stretch owl-carousel portfolio-details-carousel">
    <div class="member" data-aos="fade-up">
<a href="<?= site_url('first/wisata_fasilitas/'.$data['id']) ?>"  title="Fasilitas">
      <div class="member-img"><a class="" href="<?= site_url('first/wisata_fasilitas/'.$data['id']) ?>"> <img src="<?= AmbilGaleri($data['gambar'],'kecil') ?>" class="img-fluid" alt="<?= $data['nama'] ?>" style="width:100%; height:225px"></a>
          <div class="social"> <a href="https://youtube.com/channel/<?= $data['youtube'] ?>" target="_blank"><i class="icofont-youtube"></i></a> <a href="<?= $data['website'] ?>" target="_blank"><i class="icofont-globe"></i></a> <a href="https://facebook.com/<?= $data['fb'] ?>" target="_blank"><i class="icofont-facebook"></i></a> <a href="https://instagram.com/<?= $data['ig'] ?>" target="_blank"><i class="icofont-instagram"></i></a> <a href="phone:<?= $data['no_hp'] ?>" target="_blank"><i class="icofont-phone"></i></a> </div>
      </div>
      </a>
      <div class="member-info">
        <h4> <strong style="color:#60C"><a class="" href="<?= site_url('first/wisata_fasilitas/'.$data['id']) ?>"><?= $data['nama'] ?></a></strong></h4>
          <span style="color:#666" class="text-justify member-info-detail">
          <strong>Kategori</strong> : <?= $data['jenis_wisata'] ?>
          </span> <span style="color:#666" class="text-justify member-info-detail">
          <strong>Unik</strong> : <?= $data['daya_tarik_utama']?>
          </span> <span style="color:#666" class="text-justify member-info-detail">
          <strong>Pengelola</strong> : <?= $data['nama_pengelola']?>
          </span> <span style="color:#666" class="text-justify member-info-detail">
          <strong>Lokasi</strong> : <br/><i><?= $data['lokasi'] ?></i><br/><strong>Dari kantor <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></strong> :<br/> berjarak <?= $sub['jarak_tempuh']?> km, waktu <?= $data['waktu_tempuh']?> menit          
          </span> <br/>
        <a href="https://wa.me/+62<?= $data['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20<?= $data['nama'] ?>%20yang%20ada%20di%20<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>.%20Dapatkah%20saya%20memperoleh%20informasi%20lebih%20banyak%20tentang%20<?= $data['nama'] ?>%3F%20<?= site_url('first/wisata/'.$data['id']) ?>" target="_blank" title="pesan">
        <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
        </a> <a href="<?= site_url('first/wisata_fasilitas/'.$data['id']) ?>"  title="Fasilitas">
        <button class="btn btn-primary"><i class="icofont-info"></i> Detail</button>
        </a> </div>
    </div>
  </div>
  <?php endif ?>
  <?php endforeach ?>
  <?php endif ?>
</div>
<!-- End Our Team Section --> 

<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="hero-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-12 custom-padding-right">
        <div class="slider-head">
          <div class="hero-slider">
          <?php if($layanan_data) : ?>
            <?php foreach($layanan_data as $album) : ?>
            <?php if(is_file(LOKASI_GALERI . "sedang_" . $album['gambar'])) : ?>
            <?php $link = site_url('first/tukang_layanan/'.$album['id']) ?>
                  <div class="single-slider" style="background-image: url('<?= AmbilGaleri($album['gambar'], 'sedang') ?>')">
                    <div class="content">
                      <h2 style="color:#FFF; text-shadow: 5px 5px 5px #081828; -webkit-text-stroke: 0.25px #081828;"><span></span>
                        <?= $album['nama'] ?>
                      </h2>
                      <h3 style="color:#FFF"> <small style="color:#FFC; font-size:12px">
                          <?= $album['sebutan_biaya'] ?>
                          :</small>
                        <?= $rupiah($album['harga']) ?>
                        <a href="https://wa.me/+62<?= $sub['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20keahlian%20anda%20tentang%20*<?= $album['nama'] ?>*%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Saya%20ada%20pekerjaan%20yang%20mungkin%20cocok%20dengan%20keahlian%20anda.%20Apakah%20kita%20dapat%20membicarakannya%20lebih%20lanjut%3F%20<?= site_url('first/tukang_layanan/'.$sub['id']) ?>" target="_blank" title="pesan">
                  <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
                  </a>
                      </h3>
                      <div class="button"> <a class="" href="<?= site_url('first/tukang_layanan/' . $data['id']) ?>">
                          <button class="btn btn-warning"><i class="ri-store-2-fill" style="color:#fff;"></i> Produk:
                            <?= $album['nama'] ?>
                            <?= $data['nama'] ?>
                          </button>
                        </a> <a href="https://wa.me/+62<?= $sub['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20keahlian%20anda%20tentang%20<?= $sub['jenis_layanan'] ?>%20<?= $sub['kategori_pekerjaan'] ?>%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>.%20Saya%20ada%20pekerjaan%20yang%20mungkin%20cocok%20dengan%20keahlian%20anda.%20Apakah%20kita%20dapat%20membicarakannya%20lebih%20lanjut%3F" target="_blank" title="pesan">
                          <button class="btn btn-primary"><i class="icofont-whatsapp"></i> Hubungi</button>
                        </a></div>
                    </div>
                  </div>
                <?php endif ?>
              <?php endforeach ?>
            <?php endif ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-12">
        <div class="row">
          <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
            <!-- Start Small Banner -->
            <div class="hero-small-banner text-center" style="background-image: url('<?php $this->load->view($folder_themes . "/partials/tukang/peta_view.php") ?>
                  <div class=" content"> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
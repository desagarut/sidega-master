<section class="hero-area">
  <div class="container">
    <div class="row">
      <?php if ($main) : ?>
        <div class="col-lg-8 col-12 custom-padding-right">
          <div class="slider-head">
            <div class="hero-slider">
              <?php foreach ($main as $data) : ?>
                <?php if (is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])) : ?>
                  <?php $link = site_url('first/tukang_layanan/' . $data['id']) ?>
                  <div class="single-slider" style="background-image: url(<?= AmbilGaleri($data['gambar'], 'sedang') ?>);">
                    <div class="content">
                      <h2 style="color:#FFF; text-shadow: 5px 5px 5px #081828; -webkit-text-stroke: 0.25px #081828;"><span></span> Nama Usaha :
                        <?= $data['nama'] ?>
                      </h2>
                      <div class="button">
                        <a class="" href="<?= site_url('first/tukang_layanan/' . $data['id']) ?>">
                          <button class="btn btn-warning"><i class="ri-store-2-fill" style="color:#fff;"></i> Pengelola : <?= $data['nama_pengelola'] ?></button>
                        </a>
                        <a href="https://wa.me/+62<?= $data['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20keahlian%20anda%20yang%20ditawarkan%20di%20website%20desa.%20Apakah%20produknya%20masih%20tersedia%3F%20<?= site_url('first/tukang_layanan/' . $data['id']) ?>" target="_blank" title="pesan">
                          <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
                        </a>
                      </div>
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
            <div class="hero-small-banner" style="background-image: url('<?php echo base_url("$this->theme_folder/$this->theme/assets/img/umkm_juara.jpg") ?>');">
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
                <h2>Tukang Warga</h2>
                <p><strong>adalah </strong> wadah bagi <strong>UMKM</strong> (Usaha Masyarakat Kecil Menengah) di wilayah <strong>
                    <?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?></strong>, yang dikembangkan untuk membantu meningkatkan pertumbuhan ekonomi masyarakat desa.</p>
                <div class="button"> <a class="btn" href="<?= site_url('first/toko_show/') ?>">Belanja Sekarang</a> </div>
              </div>
            </div>
            <!-- Start Small Banner -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="hero-area">
  <div class="container">
    <div class="row">
      <?php if($main) : ?>
      <div class="col-lg-12 col-12 custom-padding-right">
        <div class="slider-head"> 
          <div class="hero-slider">
            <?php foreach($main as $data) : ?>
            <?php if(is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])) : ?>
            <?php $link = site_url('first/produk_show/'.$data['id']) ?>
            <div class="single-slider"
                                style="background-image: url(<?= AmbilGaleri($data['gambar'],'sedang') ?>);">
              <div class="content">
                <h2 style="color:#FFF; text-shadow: 5px 5px 5px #081828;
    -webkit-text-stroke: 0.25px #081828;"><span></span> UMKM :
                  <?= $data['nama'] ?>
                </h2>
                <div class="button"> <a class="" href="<?= site_url('first/produk_show/'.$data['id']) ?>">
                  <button class="btn btn-warning"><i class="ri-store-2-fill" style="color:#fff;"></i> UMKM:
                  <?= $data['nama'] ?>
                  </button>
                  </a> <a href="https://wa.me/+62<?= $data['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20produk%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $data['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/produk_show/'.$data['id']) ?>" target="_blank" title="pesan">
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
    </div>
  </div>
</section>

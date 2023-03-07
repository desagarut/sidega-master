<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="trending-product section" style="margin-top: 12px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Informasi Jasa Tukang Warga
          </h2>
          <p>Berbagai usaha jasa berdasakan keahlian masyarakat di wilayah <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></p>
        </div>
      </div>
    </div>
    
    <div class="row">
      <?php if($main) : ?>
      <?php foreach($main as $data) : ?>
      <?php if(is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
      <?php $link = site_url('first/produk_show/'.$data['id']) ?>
      <div class="col-lg-3 col-md-6 col-12"> 
        <!-- Start Single Product -->
        <div class="single-product">
          <div class="product-image"> <img src="<?= AmbilGaleri($data['gambar'],'kecil') ?>" alt="#">
            <div class="button"> 
                <a class="button btn btn-success" href="https://wa.me/+62<?= $data['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20produk%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $data['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/produk_show/'.$data['id']) ?>" target="_blank" title="Hubungi via whatsapp">
                  <i class="lni lni-whatsapp"></i> Hubungi</a>            
			</div>
          </div>
          <div class="product-info"> 
            <h4 class="title"> <a href="<?= site_url('first/produk_show/'.$data['id']) ?>">
              <?= $data['nama'] ?>
              </a> </h4>
            <ul class="review">
              <li><i class="lni lni-star-filled"></i></li>
              <li><i class="lni lni-star-filled"></i></li>
              <li><i class="lni lni-star-filled"></i></li>
              <li><i class="lni lni-star-filled"></i></li>
              <li><i class="lni lni-star"></i></li>
              <li><span>4.0 Review(s)</span></li>
            </ul>
            <span class="category">Pengelola : <?= $data['nama_pengelola']?></span>
            <span class="category">Layanan : <?= $data['jenis_layanan'] ?></span>
            <span class="category">Area : <?= $data['area']?></span>
            <span class="category">Kelompok : <?= $data['kelompok_usaha']?></span>
            <span class="category">Lokasi : <?= $data['lokasi'] ?></span> <br/>
            <a href="https://wa.me/+62<?= $data['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20keahlian%20anda%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Saya%20ada%20pekerjaan%20yang%20mungkin%20cocok%20dengan%20keahlian%20anda.%20Apakah%20kita%20dapat%20membicarakannya%20lebih%20lanjut%3F%20<?= site_url('first/tukang_layanan/'.$data['id']) ?>" target="_blank" title="pesan">
            <button class="btn btn-success"><i class="icofont-whatsapp"></i> Hubungi</button>
            </a> <a href="<?= site_url('first/tukang_layanan/'.$data['id']) ?>"  title="Produk">
            <button class="btn btn-warning"><i class="icofont-info"></i> Detail</button>
            </a> 
          </div>
        </div>
        <!-- End Single Product --> 
      </div>
      <?php endif ?>
      <?php endforeach ?>
      <?php endif ?>
    </div>
  </div>
</section>
<!-- End Trending Product Area --> 

<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="trending-product section" style="margin-top: 12px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Produk
            <?= $sub['nama'] ?>
          </h2>
          <p>Informasi Usaha Kecil Menengah masyarakat yang tersebar seluruh desa</p>
        </div>
      </div>
    </div>
    <div class="row">
      <?php if($produk_data) : ?>
      <?php foreach($produk_data as $album) : ?>
      <?php if(is_file(LOKASI_GALERI . "kecil_" . $album['gambar'])) : ?>
      <?php $link = site_url('first/produk_show/'.$album['id']) ?>
      <div class="col-lg-3 col-md-6 col-12"> 
        <!-- Start Single Product -->
        <div class="single-product">
          <div class="product-image"> <img src="<?= AmbilGaleri($album['gambar'],'kecil') ?>" alt="<?= $album['nama'] ?>">
            <div class="button"> <a class="button btn btn-success" href="https://wa.me/+62<?= $sub['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20produk%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $data['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/produk_show/'.$data['id']) ?>" target="_blank" title="Hubungi via whatsapp"> <i class="lni lni-whatsapp"></i> Hubungi </a> </div>
          </div>
          <div class="product-info">
            <h4 class="title"> <a href="<?= site_url('first/produk_show/'.$data['id']) ?>">
              <?= $album['nama'] ?>
              </a> </h4>
            <span>
            <?= $album['deskripsi'] ?>
            </span>
            <ul class="review">
              <li><i class="lni lni-star-filled"></i></li>
              <li><i class="lni lni-star-filled"></i></li>
              <li><i class="lni lni-star-filled"></i></li>
              <li><i class="lni lni-star-filled"></i></li>
              <li><i class="lni lni-star"></i></li>
              <li><span>4.0 Review(s)</span></li>
            </ul>
            <span class="category">
            <?= $album['kategori_toko'] ?>
            </span> <span>
            <?= $data['produk_utama']?>
            </span>
            <div class="price">
              <?= $album['sebutan_biaya'] ?>
              <span>
              <?= $rupiah($album['harga']) ?>
              </span>
              <?= $album['sebutan_ukuran'] ?>
            </div>
            <span class="category">
            <?= $album['lokasi'] ?>
            </span> <a href="https://wa.me/+62<?= $sub['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20ingin%20membeli%20produk%20*<?= $album['nama'] ?>*%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $album['nama'] ?>%20masih%20tersedia%3F%20<?= site_url('first/produk_show/'.$sub['id']) ?>" target="_blank" title="Beli Sekarang">
            <button class="btn btn-danger"><i class="icofont-whatsapp"></i> Beli Sekarang</button>
            </a> </div>
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

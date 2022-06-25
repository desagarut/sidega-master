<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="trending-product section" style="margin-top: 12px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Informasi Usaha Bidang Transportasi
          </h2>
          <p>Informasi usaha jasa transportasi, ojeg, rental mobil, angkutan barang, odong-odong dll di <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></p>
        </div>
      </div>
    </div>
    
    <div class="row">
      <?php if($main) : ?>
      <?php foreach($main as $data) : ?>
      <?php if(is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
      <?php $link = site_url('first/tawa_layanan/'.$data['id']) ?>
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
            <h4 class="title"> <a href="<?= site_url('first/tawa_layanan/'.$data['id']) ?>">
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
            <span style="color:darkslateblue"><i class="icofont-user" style="color:darkorange"></i><strong> Nama :</strong>
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
            
                <a class="button btn btn-warning" href="<?= site_url('first/tawa_layanan/'.$data['id']) ?>">
                <i class="lni lni-cart"></i> Kunjungi</a> 
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

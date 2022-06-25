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
      <?php if($produk_data) : ?>
      <?php foreach($produk_data as $album) : ?>
      <?php if(is_file(LOKASI_GALERI . "kecil_" . $album['gambar'])) : ?>
      <?php $link = site_url('first/tawa_layanan/'.$album['id']) ?>
      <div class="col-lg-3 col-md-6 col-12"> 
        <!-- Start Single Product -->
        <div class="single-product">
          <div class="product-image"> <img src="<?= AmbilGaleri($sub['gambar'],'kecil') ?>" alt="#">
            <div class="button"> 
                <a class="button btn btn-success" href="https://wa.me/+62<?= $sub['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20produk%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>.%20Apakah%20<?= $sub['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/produk_show/'.$sub['id']) ?>" target="_blank" title="Hubungi via whatsapp">
                  <i class="lni lni-whatsapp"></i> Hubungi</a>            
			</div>
          </div>
          <div class="product-info"> 
            <h4 class="title"> <a href="<?= site_url('first/tawa_layanan/'.$sub['id']) ?>">
              <?= $sub['nama'] ?>
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
              <?= $sub['nama_pengelola']?>
              </span> <span style="color:darkslateblue"><i class="icofont-long-drive" style="color:#03F"></i><strong> Kategori :</strong>
              <?= $sub['jenis_usaha'] ?>
              </span> <span style="color:darkslateblue"><i class="icofont-gift" style="color:#066"></i><strong> Usaha :</strong>
              <?= $sub['kelompok_usaha']?>
              </span> <span style="color:darkslateblue"><i class="icofont-map-pins" style="color:#63F"></i><strong> Layanan :</strong>
              <?= $sub['area']?>
              </span> <span style="color:darkslateblue"><i class="icofont-map-pins" style="color:#63F"></i><strong> Tujuan :</strong>
              <?= $sub['trayek']?>
              </span> <span style="color:darkslateblue"><i class="icofont-location-pin" style="color:#F09"></i><strong> Lokasi : </strong>
              <?= $sub['lokasi'] ?>
              </span> <br/>
            <div class="button"> 
                <a class="button btn btn-success" href="https://wa.me/+62<?= $sub['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20layanan%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>.%20Apakah%20<?= $sub['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/produk_show/'.$sub['id']) ?>" target="_blank" title="Hubungi via whatsapp">
                  <i class="lni lni-whatsapp"></i> Hubungi</a>            
			</div>
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

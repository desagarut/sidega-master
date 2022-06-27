<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section class="trending-product section" style="margin-top: 12px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>LAYANAN <?= $sub['nama'] ?></h2>
        </div>
      </div>
    </div>
    <div class="row">
      <?php if ($layanan_data) : ?>
        <?php foreach ($layanan_data as $album) : ?>
          <?php if (is_file(LOKASI_GALERI . "kecil_" . $album['gambar'])) : ?>
            <?php $link = site_url('first/tukang_layanan/' . $album['id']) ?>
            <div class="col-lg-3 col-md-6 col-12">
              <!-- Start Single Product -->
              <div class="single-product">
                <div class="product-image"> <img src="<?= AmbilGaleri($album['gambar'], 'kecil') ?>" alt="<?= $album['nama'] ?>">
                  <div class="button"> <a class="button btn btn-success" href="https://wa.me/+62<?= $sub['no_hp_toko'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20produk%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $data['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/tukang_layanan/' . $data['id']) ?>" target="_blank" title="Hubungi via whatsapp"> <i class="lni lni-whatsapp"></i> Hubungi </a> </div>
                </div>
                <div class="product-info">
                  <h4 class="title"> <a href="#"><span>Melayani :</span> <?= $album['nama'] ?></a></h4>
                  <ul class="review">
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star-filled"></i></li>
                    <li><i class="lni lni-star"></i></li>
                    <li><span>4.0 Review(s)</span></li>
                  </ul>
                  <p class="text-justify member-info-detail" align="justify"> <span style="color:#666" class="text-justify member-info-detail"> <strong>Bidang</strong> :
                      <?= $sub['kategori_pekerjaan'] ?>
                    </span> <span style="color:#666" class="text-justify member-info-detail"> <strong>Deskripsi Pekerjaan</strong> : <br />
                      <?= $album['deskripsi'] ?>
                    </span>
                  <h5 style="color:#C00"> <small style="color:#03F; font-size:12px">
                      <?= $album['sebutan_biaya'] ?>
                    </small>
                    <?= $rupiah($album['harga']) ?>
                    <i><small style="color:#666; font-size:10px"> /
                        <?= $album['sebutan_ukuran'] ?>
                      </small></i>
                  </h5>
                  </p>
<br />
                  <a href="https://wa.me/+62<?= $sub['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20halo%20saya%20tertarik%20dengan%20keahlian%20anda%20tentang%20<?= $sub['jenis_layanan'] ?>%20<?= $sub['kategori_pekerjaan'] ?>%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>.%20Saya%20ada%20pekerjaan%20yang%20mungkin%20cocok%20dengan%20keahlian%20anda.%20Apakah%20kita%20dapat%20membicarakannya%20lebih%20lanjut%3F" target="_blank" title="pesan">
                    <button class="btn btn-primary"><i class="icofont-whatsapp"></i> Hubungi</button>
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
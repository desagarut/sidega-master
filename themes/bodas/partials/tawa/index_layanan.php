<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Start -->
<div class="container-xxl py-5">
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      <h6 class="section-title bg-white text-center text-primary px-3">UMKM</h6>
      <h1 class="mb-5">Transportasi</h1>
    </div>
    <div class="text-end wow fadeInUp" data-wow-delay="0.1s">
      <h3 class="mb-5"><a href="<?= site_url('first/tawa') ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 30px 30px 30px 30px;">
          <i class="fa fa-backward"></i> Kembali</a></h3>
    </div>
    <div class="row shadow">
      <div class="col-md-3 wow fadeInUp" data-wow-delay="0.1s">
        <div class="course-item bg-light">
          <div class="position-relative overflow-hidden">
            <img src="<?= AmbilGaleri($sub['gambar'], 'kecil') ?>" alt="<?= $sub['nama'] ?>" style="width:100%; height:200px">
            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
              <a href="https://wa.me/+62<?= $sub['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20layanan%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>.%20Apakah%20<?= $sub['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/produk_show/' . $sub['id']) ?>" target="_blank" title="Hubungi via whatsapp" class="flex-shrink-0 btn btn-sm btn-warning px-3" style="border-radius: 30px 30px 30px 30px;">
                Hubungi <i class="fab fa-whatsapp text-primary me-2"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 wow fadeInUp" data-wow-delay="0.3s">
        <div class="product-info">
          <h4 class="title"> <a href="<?= site_url('first/tawa_layanan/' . $sub['id']) ?>">
              <?= $sub['nama'] ?>
            </a> </h4>
          <!--<ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star"></i></li>
            <li><span>4.0 Review(s)</span></li>
          </ul>-->
          <span style="color:darkslateblue"><i class="icofont-user" style="color:darkorange"></i><strong> Nama Pengelola:</strong>
            <?= $sub['nama_pengelola'] ?>
          </span></br>
          <span style="color:darkslateblue"><i class="icofont-long-drive" style="color:#03F"></i><strong>Kategori :</strong>
            <?= $sub['jenis_usaha'] ?>
          </span></br>
          <span style="color:darkslateblue"><i class="icofont-gift" style="color:#066"></i><strong>Kelompok Usaha :</strong>
            <?= $sub['kelompok_usaha'] ?>
          </span></br>
          <span style="color:darkslateblue"><i class="icofont-map-pins" style="color:#63F"></i><strong>Area Layanan :</strong>
            <?= $sub['area'] ?>
          </span></br>
          <span style="color:darkslateblue"><i class="icofont-map-pins" style="color:#63F"></i><strong> Tujuan :</strong>
            <?= $sub['trayek'] ?>
          </span></br>
          <span style="color:darkslateblue"><i class="icofont-location-pin" style="color:#F09"></i><strong> Lokasi : </strong>
            <?= $sub['lokasi'] ?>
          </span> <br />

          <div class="d-flex border">
            <small class="flex-fill text-center border-end py-2"><a href="<?= $sub['email'] ?>"><i class="fa fa-envelope text-primary me-2"></i> </a></small>
            <small class="flex-fill text-center border-end py-2"><a href="<?= $sub['website'] ?>"><i class="fa fa-globe text-primary me-2"></i></a></small>
            <small class="flex-fill text-center border-end py-2"><a href="<?= $sub['fb'] ?>"><i class="fab fa-facebook-f text-primary me-2"></i></a></small>
            <small class="flex-fill text-center border-end py-2"><a href="<?= $sub['ig'] ?>"><i class="fab fa-instagram text-primary me-2"></i></small>
            <small class="flex-fill text-center border-end py-2"><a href="<?= $sub['youtube'] ?>"><i class="fab fa-youtube text-primary me-2"></i></a></small>
            <small class="flex-fill text-center border-end py-2"><a href="https://wa.me/+62<?= $sub['no_hp_pengelola'] ?>?text=Assalamu'alaikum%2C%20Saya%20tertarik%20dengan%20layanan%20yang%20ditawarkan%20di%20website%20<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>.%20Apakah%20<?= $sub['nama'] ?>%20masih%20buka%3F%20<?= site_url('first/produk_show/' . $sub['id']) ?>" target="_blank" title="Hubungi via whatsapp"><i class="fab fa-whatsapp text-primary me-2"></i></a></small>
          </div>
        </div>
      </div>
      <div class="col-md-3 wow fadeInUp" data-wow-delay="0.5s">
        <?php $this->load->view($folder_themes . "/partials/tawa/peta.php") ?>
      </div>
    </div>

    <div class="row py-5">
      <div class="row g-4 justify-content-center">
        <?php if ($produk_data) : ?>

          <?php foreach ($produk_data as $album) : ?>
            <?php if (is_file(LOKASI_GALERI . "sedang_" . $album['gambar'])) : ?>
              <?php $link = site_url('first/produk_data/' . $album['id']) ?>
              <div class="col-lg-3 col-md-3 col-sm-2 wow fadeInUp shadow" data-wow-delay="0.1s">
                <div class="course-item bg-light">
                  <div class="position-relative overflow-hidden">
                    <img class="img-fluid" src="<?= AmbilGaleri($album['gambar'], 'sedang') ?>" alt="<?= $album['nama'] ?>">
                    <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                      <a href="https://wa.me/+62<?= $sub['no_hp_pengelola'] ?>?text=Assalamu'alaikum%20<?= $album['nama_pengendara'] ?>%2C%20Saya%20tertarik%20dengan%20layanan%20yang%20ditawarkan%20di%20website%20*<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>*.%20Apakah%20<?= $data['nama'] ?>%20dapat%20membantu%20saya%3F%20" target="_blank" title="Hubungi via whatsapp" class="flex-shrink-0 btn btn-sm btn-warning px-3" style="border-radius: 30px 30px 30px 30px;">
                        Hubungi <i class="fab fa-whatsapp text-primary me-2"></i></a>
                    </div>
                  </div>
                  <div class="text-center p-4 pb-0">
                    <h3 class="mb-0"><?= $album['nama_pengendara'] ?></h3>
                    <div class="mb-3">
                      <small>Lokasi : <?= $sub['lokasi'] ?></small>
                    </div>
                    <!--
                    <div class="mb-3">
                      <small class="fa fa-star text-primary"></small>
                      <small class="fa fa-star text-primary"></small>
                      <small class="fa fa-star text-primary"></small>
                      <small class="fa fa-star text-primary"></small>
                      <small class="fa fa-star text-primary"></small>
                      <small>(123)</small>
                    </div>
            -->
                    <h6 class="mb-2">Tarif: <?= $rupiah($album["harga"]) ?> / <small><?= $album['sebutan_ukuran'] ?></small></h6>
                    <!--<h5 class="mb-4"><i class="fa fa-map-marker-alt text-danger"></i> <?= $sub['lokasi'] ?></h5>-->
                    <small>
                      <i>Kendaraan : <?= $album['jenis_kendaraan'] ?></i></br>
                      <i>Merek : <?= $album['merek'] ?></i></br>
                      <i>Warna : <?= $album['warna_kendaraan'] ?></i></br>
                      <i>Deskripsi : <?= $album['deskripsi'] ?></i></br>
                    </small>
                  </div>
                  <div class="d-flex border-top">
                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>Driver: <?= $album['nama_pengendara'] ?></small>
                  </div>
                </div>
              </div>
            <?php endif ?>
          <?php endforeach ?>

        <?php endif ?>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view($folder_themes . '/partials/service_umkm.php') ?>
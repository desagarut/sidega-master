<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container-fluid p-0 mb-5">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" style="height: 650px;" src="<?= gambar_desa($desa['kantor_desa']) ?>" alt="<?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?>">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(2, 117, 34, 0.7);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-md-8">
                            <h1 class="display-7 text-white animated slideInDown">
                                Selamat datang di <br>
                                <?= ucfirst($this->setting->sebutan_desa) . ' ' . ucwords($desa['nama_desa']) ?> <br />
                                <?= ucfirst($this->setting->sebutan_kecamatan) . ' ' . ucwords($desa['nama_kecamatan']) ?><br />
                                <?= ucfirst($this->setting->sebutan_kabupaten) . ' ' . ucwords($desa['nama_kabupaten']) ?><br />
                                Provinsi Jawa Barat
                            </h1>
                            <a href="<?= site_url('arsip') ?>" target="_blank" class="btn btn-info py-md-3 px-md-5 me-3 animated slideInLeft">Berita</a>
                            <a href="<?= site_url('first/wilayah') ?>" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Statistik</a>
                        </div>
                        <div class="col-md-4">
                            <div class="team-item shadow animated slideInRight" style="padding:10px 15px 0px 15px">
                                <div class="overflow-hidden">
                                    <img class="img-fluid" style="object-fit: cover; height:350px; " src="<?= base_url() ?>instansi/upload/user_pict/<?= $pamong_kades['foto'] ?>" alt="<?= $pamong_kades['pamong_nama'] ?>">
                                </div>
                                <div class="text-center bg-light p-4">
                                    <h4 class="mb-0"><?= $pamong_kades['pamong_nama'] ?></h4>
                                    <h6><?= strtoupper($pamong_kades['jabatan']) . ' ' . strtoupper($desa['nama_desa']) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($slider_gambar['gambar'] as $gambar) : ?>
            <?php $file_gambar = $slider_gambar['lokasi'] . 'sedang_' . $gambar['gambar']; ?>
            <?php if (is_file($file_gambar)) : ?>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" style="height: 650px;" src="<?php echo base_url() . $slider_gambar['lokasi'] . 'sedang_' . $gambar['gambar'] ?>" alt="<?= $gambar['judul'] ?>">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-sm-10 col-lg-8">
                                    <h1 class="display-5 text-white animated slideInDown"><?= $gambar['judul'] ?></h1>
                                    <a href="<?= 'artikel/' . buat_slug($gambar); ?>" target="_blank" class="btn btn-info py-md-3 px-md-5 me-3 animated slideInLeft">Baca</a>
                                    <a href="<?= site_url('mandiri_web') ?>" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $active = false; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
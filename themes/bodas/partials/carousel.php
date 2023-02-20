<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <!--
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/carousel-1.jpg")?>" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown"></h5>
                                <h1 class="display-3 text-white animated slideInDown">Lembaga Pendidikan Kesehatan Terbaik</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus eirmod elitr.</p>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->

            <?php foreach ($slider_gambar['gambar'] as $gambar) : ?>
            <?php $file_gambar = $slider_gambar['lokasi'] . 'sedang_' . $gambar['gambar']; ?>
            <?php if(is_file($file_gambar)) : ?>

            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" style="height: 650px;" src="<?php echo base_url().$slider_gambar['lokasi'].'sedang_'.$gambar['gambar']?>" alt="<?= $gambar['judul'] ?>">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown"><?= $gambar['hri'] ?>/<?= $gambar['bln'] ?>/<?= $gambar['thn'] ?></h5>
                                <h1 class="display-3 text-white animated slideInDown"><?= $gambar['judul'] ?></h1>
                                <p class="fs-5 text-white mb-4 pb-2"><?= $gambar['id_kategori'] ?></p>
                                <a href="<?='artikel/'.buat_slug($gambar); ?>" target="_blank" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                <a href="http://portal.sthgarut.ac.id:8060/index.php/pendaftaran_pmb" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join Now</a>
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
    <!-- Carousel End -->

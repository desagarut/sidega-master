<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- =======  Slider ======= -->


    <!-- Carousel Start -->
<!--    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                    <img class="img-fluid" src="<?= base_url("$this->theme_folder/$this->theme/img/gedung1.jpg")?>" alt="Image">
                </button>
                <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="1" aria-label="Slide 2">
                    <img class="img-fluid" src="<?= base_url("$this->theme_folder/$this->theme/img/musyawarah1.jpg")?>" alt="Image">
                </button>
                <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="2" aria-label="Slide 3">
                    <img class="img-fluid" src="<?= base_url("$this->theme_folder/$this->theme/img/psdm1.jpg")?>" alt="Image">
                </button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="<?= base_url("$this->theme_folder/$this->theme/img/gedung1.jpg")?>" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-4 animated zoomIn">Selamat datang di <?= $this->setting->website_title ?></h4>
                            <h4 class="display-1 text-white mb-0 animated zoomIn">Sistem Informasi Perencanaan Prioritas Pembangunan Partisipatif</h4>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="<?= base_url("$this->theme_folder/$this->theme/img/musyawarah1.jpg")?>" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-4 animated zoomIn">Perencanaan Pembangunan Wilayah</h4>
                            <h1 class="display-1 text-white mb-0 animated zoomIn"><?= ucfirst($this->setting->sebutan_kecamatan) . ' ' . ucwords($desa['nama_kecamatan']) ?> Kabupaten Garut </h1>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="<?= base_url("$this->theme_folder/$this->theme/img/psdm1.jpg")?>" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-4 animated zoomIn">Fasilitasi aspirasi</h4>
                            <h1 class="display-1 text-white mb-0 animated zoomIn">Partisipasi anda menentukan arah pembangunan</h1>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>-->
    <!-- Carousel End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                            <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                    <img class="img-fluid" src="<?= base_url("$this->theme_folder/$this->theme/img/gedung1.jpg")?>" alt="Image">
                </button>

			<?php $active = true; ?>
            <?php foreach ($slider_gambar['gambar'] as $gambar) : ?>
            <?php $file_gambar = $slider_gambar['lokasi'] . 'sedang_' . $gambar['gambar']; ?>
            <?php if(is_file($file_gambar)) : ?>

                <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                    <img class="img-fluid" src="<?php echo base_url().$slider_gambar['lokasi'].'sedang_'.$gambar['gambar']?>" alt="Image">
                </button>
			<?php $active = false; ?>
            <?php endif; ?>
            <?php endforeach; ?>                
            </div>

           <div class="carousel-inner">            
            <div class="carousel-item active">
                <img class="w-100" src="<?= base_url("$this->theme_folder/$this->theme/img/gedung1.jpg")?>" alt="Image">
                <div class="carousel-caption">
                    <div class="p-3" style="max-width: 900px;">
                        <h6 class="text-white text-uppercase mb-4 animated zoomIn">Selamat datang di <?= $this->setting->website_title ?></h6>
                        <h6 class="display-1 text-white mb-0 animated zoomIn">Sistem Informasi Perencanaan Prioritas Pembangunan Partisipatif</h6>
                    </div>
                </div>
            </div>
           
            <?php foreach ($slider_gambar['gambar'] as $gambar) : ?>
            <?php $file_gambar = $slider_gambar['lokasi'] . 'sedang_' . $gambar['gambar']; ?>
            <?php if(is_file($file_gambar)) : ?>
            
                <div class="carousel-item">
                <a class="archive__link" href="<?='artikel/'.buat_slug($gambar); ?>">
                    <img class="w-100" src="<?php echo base_url().$slider_gambar['lokasi'].'sedang_'.$gambar['gambar']?>" alt="Image">
                    </a>
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h6 class="display-1 text-white mb-0 animated zoomIn"><?= $gambar['judul'] ?></h6>
                        </div>
                    </div>
                </div>
			<?php $active = false; ?>
            <?php endif; ?>
            <?php endforeach; ?>
            </div>

            
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->
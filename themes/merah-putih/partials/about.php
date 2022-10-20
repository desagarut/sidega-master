<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $abstract = potong_teks($headline['isi'], 250); ?>
<?php $url = site_url('artikel/'.buat_slug($headline)); ?>
<?php $image = ($headline['gambar'] && is_file(LOKASI_FOTO_ARTIKEL.'kecil_'.$headline['gambar'])) ? 
	AmbilFotoArtikel($headline['gambar'],'kecil') :
	base_url($this->theme_folder.'/'.$this->theme .'/assets/images/placeholder.png') ?>

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="img-border">
                        <img class="img-fluid" src="<?= $image ?>" class="img-fluid" alt="<?= $headline['judul'] ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h6 class="section-title bg-white text-start text-danger pe-3">Sorotan</h6>
                        <h1 class="display-6 mb-4"><span class="text-danger">#1</span> <?= $headline['judul'] ?></h1>
                        <p><?= $abstract ?></p>
                        <div class="d-flex align-items-center mb-4 pb-2">
                            <img class="flex-shrink-0 rounded-circle" src="<?= base_url("$this->theme_folder/$this->theme/img/team-1.jpg")?>" alt="" style="width: 50px; height: 50px;">
                            <div class="ps-4">
                                <h6><?= $owner ?></h6>
                                <small><?= tgl_indo($article['tgl_upload']) ?></small>
                            </div>
                        </div>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="<?= $url ?>">Baca</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

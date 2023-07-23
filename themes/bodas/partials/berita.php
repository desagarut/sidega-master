<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $abstract = potong_teks($headline['isi'], 250); ?>
<?php $url = site_url('artikel/' . buat_slug($headline)); ?>
<?php $image = ($headline['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $headline['gambar'])) ?
    AmbilFotoArtikel($headline['gambar'], 'sedang') :
    base_url($this->theme_folder . '/' . $this->theme . '/assets/images/placeholder.png') ?>

<!-- Berita Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Berita</h6>
            <h1 class="mb-5">Terkini</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp bg-light" data-wow-delay="0.1s" style="padding: 10px 10px 10px 10px">
                <div class="course-item ">
                    <div class="position-relative overflow-hidden text-center">
                        <?php if ($headline['gambar']) : ?>
                            <img class="img-fluid" src="<?= $image ?>" alt="<?= $headline['judul'] ?>">
                        <?php else : ?>
                            <img class="img-fluid" src="<?= base_url() ?>themes/bodas/assets/img/noimage.png" alt="Belum Ada Gambar">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s" style="padding: 10px 10px 10px 10px">
                <h6 class="section-title bg-white text-start text-primary pe-3">Sorotan</h6>
                <h1 class="mb-4"><?= $headline['judul'] ?></h1>
                <p class="mb-4"><?= $abstract ?></p>
                <small class="flex-fill py-2"><i class="fa fa-user-tie text-primary me-2"></i><?= tgl_indo($headline['tgl_upload']) ?></small>&nbsp;&nbsp;
                <small class="flex-fill py-2"><i class="fa fa-clock text-primary me-2"></i> <?= $headline['owner'] ?></small><br />
                <small class="flex-fill py-2"><a class="btn btn-sm btn-warning py-3 px-5 mt-2" href="<?= $url ?>">Baca</a></small>
                <small class="flex-fill py-2"><a class="btn btn-sm btn-primary py-3 px-5 mt-2" href="<?= site_url('arsip') ?>">Semua Berita</a></small>
            </div>
        </div>
        <div class="row py-2">
            <?php $this->load->view($folder_themes . '/partials/artikel_single') ?>
        </div>
    </div>
</div>
<!-- Berita End -->
<!-- ======= Gallery Foto ======= -->
<div class="container-xxl py-5">
  <div class="container">
    <div class="row g-4 justify-content-center">
      <?php foreach ($w_gal as $data) : ?>
        <?php if (is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])) : ?>
          <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="course-item bg-light">
              <div class="position-relative overflow-hidden text-center">
                <img src="<?= AmbilGaleri($data['gambar'], 'sedang') ?>" alt="<?= $article['judul'] ?>" style="width:100%; height:250px;">
                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                  <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-warning px-3 border-end" style="border-radius: 30px 0 0 30px;"> <?= $data[nama] ?> </a>
                  <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;"><i class="fa fa-eye"></i></a>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
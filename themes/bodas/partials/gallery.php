<!-- ======= Gallery Foto ======= -->
<div class="container-xxl py-0">
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      <h4 class="mb-5 text-start">Gallery
        <a href="<?= site_url("first/gallery_youtube/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-light px-3" style="border-radius: 8px 8px 8px 8px;">YOUTUBE</a> |
        <a href="<?= site_url("first/cctv/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-light px-3" style="border-radius: 8px 8px 8px 8px;">CCTV</a> |
        <a href="<?= site_url("first/gallery/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 8px 8px 8px 8px;">FOTO</a>
      </h4>
    </div>
    <div class="row g-4 justify-content-center">
      <?php foreach ($gallery as $data) : ?>
        <?php if (is_file(LOKASI_GALERI . "sedang_" . $data['gambar'])) : ?>
          <div class="col-md-4 text-center wow fadeInUp testimonial-item text-center" data-wow-delay="0.1s" style="width:100%%; padding:0px 40px 0px 40px">
            <div class="team-item bg-light">
              <div class="overflow-hidden">
                <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>">
                  <img src="<?= AmbilGaleri($data['gambar'], 'sedang') ?>" alt="<?= $article['judul'] ?>" style="object-fit: cover; width:100%; height:250px;">
                </a>
              </div>
              <div class="text-center p-4">
                <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>">
                  <h6 class="mb-0"> <?= strtoupper($data[nama]) ?></h6>
                </a>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
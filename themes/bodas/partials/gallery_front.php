<!-- ======= Gallery Foto ======= -->
<div class="container-xxl py-5">
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      <h6 class="section-title bg-white text-center text-primary px-3">Gallery</h6>
      <h1 class="mb-5">Foto <a href="<?= site_url("first/gallery/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 8px 8px 8px 8px;"><i class="fa fa-camera"></i></a></h1>
    </div>
    <div class="row g-4 owl-carousel testimonial-carousel">
      <?php foreach ($w_gal as $data) : ?>
        <?php if (is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])) : ?>
          <div class="col-md-12 wow fadeInUp testimonial-item text-center" data-wow-delay="0.1s">
            <div class="team-item bg-light">
              <div class="overflow-hidden" style="padding:10px 10px 10px 10px">
                <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>">
                  <img class="img-fluid" style="object-fit: cover; height:200px" src="<?= AmbilGaleri($data['gambar'], 'kecil') ?>" alt="<?= $data['nama'] ?>">
                </a>
              </div>
              <div class="text-center p-4">
                <h6 class="mb-0"><a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>"><?= strtoupper($data['nama']) ?></a></h6>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
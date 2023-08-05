<!-- ======= Gallery Youtube ======= -->

<div class="container-xxl py-0">
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      <h4 class="mb-5 text-start">Gallery <a href="<?= site_url("first/gallery_youtube/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-light px-3" style="border-radius: 8px 8px 8px 8px;">YOUTUBE</a> | <a href="<?= site_url("first/gallery_cctv/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-warning px-3" style="border-radius: 8px 8px 8px 8px;">CCTV</a> | <a href="<?= site_url("first/gallery/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-light px-3" style="border-radius: 8px 8px 8px 8px;">FOTO</a></h4>
    </div>
    <div class="row g-4">
      <?php if ($gallery_cctv) : ?>
        <?php foreach ($gallery_cctv as $data) : ?>
          <?php if ($data['link']) : ?>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
              <div class="team-item bg-light">
                <div class="overflow-hidden" style="padding:10px 10px 0px 10px">
                  <iframe width="100%" height="180" src="<?= $data["link"]; ?>" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="text-center p-3">
                  <h6 class="mb-0"><a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>"><?= strtoupper($data['nama']) ?></a></h6>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="error-area">
          <div class="d-table">
            <div class="d-table-cell">
              <div class="container">
                <div class="error-content">
                  <h1 style="color:brown">404</h1>
                  <h2>Oops! Foto Tidak Ada!</h2>
                  <p>Halaman yang dituju tidak ada, mungkin sudah dihapus atau dialihkan</p>
                  <div class="button">
                    <a class="btn btn-warning py-3 px-5 mt-2" style="border-radius: 30px 0 0 30px;" href="<?= site_url('') ?>">Back to Home</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<!-- ======= Gallery Youtube ======= -->

  <div class="container">
    <div class="text-start">
      <h6 class="mb-3"><a href="<?= site_url("first/gallery_youtube/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-danger px-3" style="border-radius: 8px 8px 8px 8px;">YOUTUBE</a> | <a href="<?= site_url("first/cctv/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-warning px-3" style="border-radius: 8px 8px 8px 8px;">CCTV</a> | <a href="<?= site_url("first/gallery/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-light px-3" style="border-radius: 8px 8px 8px 8px;">FOTO</a></h6>
    </div>
    <div class="row g-4">
      <?php if ($cctv) : ?>
        <?php foreach ($cctv as $data) : ?>
          <?php if ($data['link']) : ?>
            <div class="col-md-4">
              <div class="team-item bg-light">
                <iframe width="100%" height="200" src="<?= $data["link"]; ?>" frameborder="0" allowfullscreen></iframe>
                <div class="text-center p-3">
                  <h6 class="mb-0"><a href="<?= site_url("first/cctv_sub/{$data['id']}") ?>"><?= strtoupper($data['nama']) ?></a></h6>
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
                  <h2>Oops! CCTV Tidak Ada!</h2>
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

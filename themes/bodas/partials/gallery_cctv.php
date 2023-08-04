<!-- ======= Gallery Youtube ======= -->

<div class="container-xxl py-0">
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      <h4 class="mb-5 text-start">Gallery <a href="<?= site_url("first/gallery_youtube/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-light px-3" style="border-radius: 8px 8px 8px 8px;">YOUTUBE</a> | <a href="<?= site_url("first/gallery_cctv/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-warning px-3" style="border-radius: 8px 8px 8px 8px;">CCTV</a> | <a href="<?= site_url("first/gallery/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-light px-3" style="border-radius: 8px 8px 8px 8px;">FOTO</a></h4>
    </div>
    <div class="row g-4">
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
<!--
      <div class="col-lg-3 col-md-6">
        <h4 class="text-white mb-3"><a class="btn btn-link" href="<?= site_url('first/gallery') ?>">Gallery Foto</a></h4>
        <div class="row g-2 pt-2">
          <div class="col-4">
            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-1.jpg") ?>" alt="">
          </div>
          <div class="col-4">
            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-2.jpg") ?>" alt="">
          </div>
          <div class="col-4">
            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-3.jpg") ?>" alt="">
          </div>
          <div class="col-4">
            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-2.jpg") ?>" alt="">
          </div>
          <div class="col-4">
            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-3.jpg") ?>" alt="">
          </div>
          <div class="col-4">
            <img class="img-fluid bg-light p-1" src="<?= base_url("$this->theme_folder/$this->theme/assets/img/course-1.jpg") ?>" alt="">
          </div>
        </div>
      </div>
        -->
    </div>
  </div>
</div>
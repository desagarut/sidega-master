<!-- ======= Gallery Youtube ======= -->

<div class="container-xxl py-5">
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.2s">
      <h1 class="mb-5">CCTV <a href="<?= site_url("first/cctv/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-warning px-3" style="border-radius: 8px 8px 8px 8px;"><i class="fa fa-eye"></i></a></h1>
    </div>
    <div class="row g-4 owl-carousel testimonial-carousel">
      <?php foreach ($cctv as $data) : ?>
        <?php if ($data['link']) : ?>
          <div class="col-md-12 wow fadeInUp testimonial-item text-center" data-wow-delay="0.1s">
            <div class="team-item bg-light">
              <div class="overflow-hidden" style="padding:10px 10px 10px 10px">
                <iframe width="100%" height="200" src="<?= $data["link"]; ?>" frameborder="0" allowfullscreen></iframe>
              </div>
              <div class="text-center p-4">
                <h6 class="mb-0"><a href="<?= site_url("first/cctv_sub/{$data['id']}") ?>"><?= strtoupper($data['nama']) ?></a></h6>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<!-- ======= Gallery Youtube ======= -->

<div class="container-xxl py-5">
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      <h1 class="mb-5">Video <a href="<?= site_url("first/gallery_youtube/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-danger px-3" style="border-radius: 8px 8px 8px 8px;"><i class="fa fa-play"></i></a></h1>
    </div>
    <div class="row g-4 owl-carousel testimonial-carousel">
      <?php foreach ($gallery as $data) : ?>
        <?php if ($data['link']) : ?>
          <div class="col-md-12 wow fadeInUp testimonial-item text-center" data-wow-delay="0.1s">
            <div class="team-item bg-light">
              <div class="overflow-hidden" style="padding:10px 10px 10px 10px">
                <iframe height="200px" width="100%" class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $data["link"]; ?>" title="<?= $data['nama'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                  <a href="<?= site_url("first/sub_gallery_youtube/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-warning px-3 border-end" style="border-radius: 30px 0 0 30px;"> Playlist </i></a>
                  <a href="<?= site_url("first/sub_gallery_youtube/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;"><i class="fa fa-eye"></i></a>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
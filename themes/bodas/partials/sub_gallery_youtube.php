<!-- ======= Gallery Youtube ======= -->
<section class="trending-product lazy">
  <div class="row">
    <?php foreach ($gallery as $data) : ?>
      <?php if ($data['link']) : ?>
        <div class="col-lg-4 col-md-6 col-12" style="padding: 0px 10px 20px 10px;">
          <!-- Start Single Product -->
          <div class="single-product">
            <div class="product-image">
              <iframe height="170px" width="100%" class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $data["link"]; ?>" title="<?= $data['nama'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="product-info">
              <h4 class="title"> <a href="<?= site_url("first/sub_gallery_youtube/{$data['id']}") ?>" alt="<?= $article['nama'] ?>">
              <small><?= "$data[nama]" ?></small>
                </a> </h4>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</section>

<!-- ======= Portfolio Section ======= -->
<section class="trending-product lazy" style="padding-top: 20px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2><a href="<?= site_url("first/gallery_youtube") ?>" alt="Gallery Video">Gallery Video</a>
          </h2>
        </div>
      </div>
    </div>
    <div class="row">
		<?php foreach ($gallery As $data): ?>
        <?php if ($data['link']): ?>
      <div class="col-lg-4 col-md-6 col-12"> 
        <!-- Start Single Product -->
        <div class="single-product">
          <div class="product-image"> 
          <iframe height="250px" width="100%" class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $data["link"]; ?>" title="<?= $data['nama'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="button">
                <a href="<?= site_url("first/sub_gallery_youtube/{$data['id']}") ?>" class="btn"><i class="lni lni-eye"></i> Lihat</a>
            </div>
          </div>
          <div class="product-info">
            <h4 class="title"> <a href="<?= site_url("first/sub_gallery_youtube/{$data['id']}") ?>" alt="<?= $article['nama'] ?>">
              <?= "Video : $data[nama]" ?>
              </a> </h4>
            </div>
        </div>
        <!-- End Single Product --> 
      </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
  </div>
</section>

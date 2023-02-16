<!-- ======= Portfolio Section ======= -->
<section class="trending-product lazy" style="padding-top: 20px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2><a href="<?= site_url("first/gallery") ?>" alt="Gallery Video">Gallery Foto</a>
          </h2>
        </div>
      </div>
    </div>
    <div class="row">
		<?php foreach ($w_gal As $data): ?>
        <?php if (is_file(LOKASI_GALERI . "kecil_" . $data['gambar'])): ?>
      <div class="col-lg-3 col-md-6 col-12"> 
        <!-- Start Single Product -->
        <div class="single-product">
          <div class="product-image"> 
          	<img src="<?= AmbilGaleri($data['gambar'],'kecil')?>" alt="<?= $article['judul'] ?>"> 
            <div class="button">
                <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>" class="btn"><i class="lni lni-eye"></i> Lihat</a>
            </div>
          </div>
          <div class="product-info">
            <h4 class="title"> <a href="<?= site_url("first/sub_gallery/{$data['id']}") ?>" alt="<?= $article['judul'] ?>">
              <?= "Album : $data[nama]" ?>
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

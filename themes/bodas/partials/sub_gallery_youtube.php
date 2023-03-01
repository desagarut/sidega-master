<!-- ======= Gallery Youtube ======= -->
        <?php if ($gallery) : ?>

          <?php foreach ($gallery as $data) : ?>
            <?php if ($data['link']) : ?>
              <div class="col-md-12 shadow" style="padding: 10px 10px 10px 10px;">
                <!-- Start Single Product -->
                <div class="single-product">
                  <div class="product-image">
                    <iframe height="500px" width="100%" class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $data["link"]; ?>" title="<?= $data['nama'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

        <?php else : ?>
          <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>404</h1>
                    <h2>Oops! Tidak Ada Data!</h2>
                    <p>Halaman yang dituju tidak ada, mungkin sudah dihapus atau dialihkan</p>
                    <div class="button text-end">
                      <a class="btn btn-warning py-3 px-5 mt-2" style="border-radius: 30px 0 0 30px;" href="<?= site_url('') ?>">Back to Home</a>
                    </div>
                </div>
            </div>
          </div>

        <?php endif; ?>

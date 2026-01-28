<!-- ======= Media Sosial ======= -->
<div class="container">

<div class="row g-4">
    <div class="col-md-12 text-center">
      <h1 class="mb-5">Media Sosial </h1>
    </div>
  </div>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="course-item bg-light">
        <div class="position-relative overflow-hidden text-center" style="padding: 10px 10px 10px 10px">
          <h5>Youtube</h5>
          <iframe width="100%" height="500" src="<?= $main['youtube'] ?>" title="<?= $main['youtube'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="course-item bg-light">
        <div class="position-relative overflow-hidden text-center" style="padding: 10px 10px 10px 10px">
          <h5>Facebook</h5>
          <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2F<?= $main['facebook'] ?>&tabs=timeline&width=500&height=500&small_header=false&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=3387344541434538" width="500px" height="500px" style="border:0;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="course-item bg-light">
        <div class="position-relative overflow-hidden text-center" style="padding: 10px 10px 10px 10px">
          <h5>Instagram</h5>
          <?= $main['instagram'] ?>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="course-item bg-light">
        <div class="position-relative overflow-hidden text-center" style="padding: 10px 10px 10px 10px">
          <h5>Tiktok</h5>
          <blockquote class="tiktok-embed" cite="https://www.tiktok.com/<?= $main['tiktok'] ?>" data-unique-id="<?= $main['tiktok'] ?>" data-embed-type="creator" style="max-hight: 700px; max-width: 100%; min-width: 288px;">
            <section> <a target="_blank" href="https://www.tiktok.com/<?= $main['tiktok'] ?>?refer=creator_embed"><?= $main['tiktok'] ?></a> </section>
          </blockquote>
          <script async src="https://www.tiktok.com/embed.js"></script>
        </div>
      </div>
    </div>
  </div>
</div>
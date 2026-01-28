<!-- ======= TIKTOK ======= -->
<div class="container">
  <div class="text-center">
    <h6 class="mb-3 text-start">
      <a href="<?= site_url("first/whatsapp") ?>" class="flex-shrink-0 btn btn-sm btn-danger px-3" style="border-radius: 8px 8px 8px 8px;">Whatsapp</a> |
      <a href="<?= site_url("first/youtube") ?>" class="flex-shrink-0 btn btn-sm btn-danger px-3" style="border-radius: 8px 8px 8px 8px;">Youtube</a> |
      <a href="<?= site_url("first/facebook") ?>" class="flex-shrink-0 btn btn-sm btn-danger px-3" style="border-radius: 8px 8px 8px 8px;">Facebook</a> |
      <a href="<?= site_url("first/instagram") ?>" class="flex-shrink-0 btn btn-sm btn-danger px-3" style="border-radius: 8px 8px 8px 8px;">Instagram</a> |
      <a href="<?= site_url("first/twitter") ?>" class="flex-shrink-0 btn btn-sm btn-warning px-3" style="border-radius: 8px 8px 8px 8px;">Twitter</a> |
      <a href="<?= site_url("first/telegram") ?>" class="flex-shrink-0 btn btn-sm btn-danger px-3" style="border-radius: 8px 8px 8px 8px;">telegram</a> |
      <a href="<?= site_url("first/tiktok") ?>" class="flex-shrink-0 btn btn-sm btn-light px-3" style="border-radius: 8px 8px 8px 8px;">Tiktok</a>
    </h6>
  </div>
  <div class="row g-4">

    <div class="col-md-12">
      <div class="course-item bg-light">
        <div class="position-relative overflow-hidden text-center">
          <h5>Profil <?= $main['tiktok'] ?></h5>
          <blockquote class="tiktok-embed" cite="https://www.tiktok.com/<?= $main['tiktok'] ?>" data-unique-id="<?= $main['tiktok'] ?>" data-embed-type="creator" style="max-width: 780px; min-width: 288px;">
            <section> <a target="_blank" href="https://www.tiktok.com/<?= $main['tiktok'] ?>?refer=creator_embed"><?= $main['tiktok'] ?></a> </section>
          </blockquote>
          <script async src="https://www.tiktok.com/embed.js"></script>
        </div>
      </div>
    </div>
  </div>
</div>
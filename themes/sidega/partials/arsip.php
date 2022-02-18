<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!--
<div class="col-lg-8 entries">

<section class="content__article">
  <div class="table">
    <?php if(count($farsip)>0): ?>
    <table class="archive__table">
      <thead>
        <tr>
          <td width="3%"><b>No.</b></td>
          <td width="20%"><b>Tanggal Artikel</b></td>
          <td><b>Gambar</b></td>
          <td><b>Judul Artikel</b></td>
          <td width="20%"><b>Penulis</b></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach($farsip AS $data): ?>
        <tr>
          <td><?= $data["no"]?></td>
          <td><?= mdate($data["tgl_upload"])?></td>
          <td><img src="<?= AmbilFotoArtikel($article['gambar'.$i],'sedang') ?>" alt="<?= $article['nama'] ?>" title="<?= $article['nama'] ?>" class="content__image"></td>
          <td><a class="archive__link" href="<?= site_url('artikel/'.buat_slug($data))?>">
            <?= $data["judul"]?>
            </a></td>
          <td><?= $data["owner"]?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
    Belum ada arsip konten web.
    <?php endif; ?>
  </div>
</section>
</div>-->


<div class="col-lg-8 entries">
<?php if(count($farsip)>0): ?>
<?php foreach($farsip AS $data): ?>
<article class="entry" data-aos="fade-up">

  <div class="entry-img">
    <img src="<?= AmbilFotoArtikel($data['gambar'.$i],'sedang') ?>" title="<?= $data['nama'] ?>" alt="<?= $data['nama'] ?>" class="img-fluid">
  </div>

  <h2 class="entry-title">
    <a href="<?= site_url('artikel/'.buat_slug($data))?>"><?= $data["judul"]?></a>
  </h2>

  <div class="entry-meta">
    <ul>
      <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="#"><?= $data["owner"]?></a></li>
      <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="#"><time datetime="2020-01-01"><?= mdate($data["tgl_upload"])?></time></a></li>
      <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="#">12 Comments</a></li>
    </ul>
  </div>

  <div class="entry-content">
    <p>
      <?= $data['isi'] ?>
    </p>
    <div class="read-more">
      <a href="<?= site_url('artikel/'.buat_slug($data))?>">Baca</a>
    </div>
  </div>

</article><!-- End blog entry -->
<?php endforeach; ?>

<?php else: ?>
Belum ada arsip konten web.
<?php endif; ?>
</div>
            
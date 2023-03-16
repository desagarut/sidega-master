<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $article = $single_artikel ?>
<div class="row">
	<div class="product-images">
		<main id="gallery">
			<div class="main-img text-center shadow" style="padding: 10px 10px 10px 10px;">
				<?php if ($article['gambar']) : ?>
					<img class="img-fluid" src="<?= AmbilFotoArtikel($article['gambar' . $i], 'sedang') ?>" alt="<?= $article['judul'] ?>">
				<?php else : ?>
					<img class="img-fluid" src="<?= base_url() ?>themes/bodas/assets/img/noimage.png" alt="Belum Ada Gambar">
				<?php endif; ?>
			</div>
		</main>
		<div class=" py-3 wow fadeInUp" data-wow-delay="0.3s">
			<h2 class="text-start"><?= $article['judul'] ?></h2>
			<p>
				<i class="fa fa-user-tie text-primary me-2"></i> <?= $article['owner'] ?> &nbsp;
				<i class="fa fa-clock text-primary me-2"></i> <?= tgl_indo($article['tgl_upload']) ?>&nbsp;
					<?php if ($article['kategori']) : ?>
					<a href="<?= site_url('first/kategori/' . $article['kat_slug']) ?>">
						<i class="fa fa-folder text-primary me-2"></i> <?= $article['kategori'] ?>
					</a>
					<?php endif ?>&nbsp;

				<i class="fa fa-eye text-primary me-2"></i> <?= hit($article['hit']) ?>&nbsp;
			</p>

		</div>
		<div class=" py-3 wow fadeInUp" data-wow-delay="0.7s">
			<?= $article['isi'] ?>
			<?php for ($i = 1; $i <= 3; $i++) : ?>
			<?php endfor ?>
			<?php if ($article['dokumen']) : ?>
				<div> <strong>Dokumen Lampiran</strong> <a href="<?= base_url(LOKASI_DOKUMEN . $article['dokumen']) ?>" class="content__attachment__link"> <i class="fa fa-cloud-download content__attachment__icon"></i> <span>
							<?= $article['link_dokumen'] ?>
						</span> </a>
				</div>
			<?php endif ?>
		</div>
		<div class="d-flex">
		<?php $this->load->view($folder_themes . '/commons/share') ?>
		</div>


	</div>

	<div class="entry-footer clearfix">
		<div class="float-left"> <i class="icofont-folder"></i>
			<ul class="cats">
				<li><a href="<?= site_url('first/kategori/' . $article['kat_slug']) ?>">
						<?= $article['kategori'] ?>
					</a></li>
			</ul>
		</div>
		<div class="float-right share"> <a href="http://twitter.com/share?url=<?= site_url('artikel/' . buat_slug($article)) ?>" title="Share on Twitter"><i class="icofont-twitter"></i></a> <a href="http://www.facebook.com/sharer.php?u=<?= site_url('artikel/' . buat_slug($article)) ?>" title="Share on Facebook"><i class="icofont-facebook"></i></a> <a href="https://telegram.me/share/url?url=<?= site_url('artikel/' . buat_slug($article)) ?>&text=<?= $article["judul"]; ?>" title="Share on Telegram"><i class="icofont-telegram"></i></a> <a href="https://api.whatsapp.com/send?text=<?= site_url('artikel/' . buat_slug($article)) ?>" title="Share on Whatsapp"><i class="icofont-whatsapp"></i></a> </div>
	</div>
</div>
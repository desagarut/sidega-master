<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Daftar Artikel Start -->
<div class="row g-4 justify-content-center">
	<?php if ($artikel) : ?>
		<?php foreach ($artikel as $article) : ?>
			<?php $data['article'] = $article ?>
			<?php $url = site_url('artikel/' . buat_slug($article)) ?>
			<?php $abstract = potong_teks(strip_tags($article['isi']), 200) ?>
			<?php $image = ($article['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $article['gambar'])) ?
				AmbilFotoArtikel($article['gambar'], 'sedang') :
				base_url($this->theme_folder . '/' . $this->theme . '/assets/img/placeholder.png');
			?>

			<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
				<div class="course-item bg-light">
					<div class="position-relative overflow-hidden text-center" style="padding: 10px 10px 10px 10px">
						<?php if ($article['gambar']) : ?>
							<a href="<?= site_url('artikel/' . buat_slug($article)) ?>">
								<img class="img-fluid" src="<?= AmbilFotoArtikel($article['gambar' . $i], 'sedang') ?>" alt="<?= $article['judul'] ?>">
							</a>
						<?php else : ?>
							<a href="<?= site_url('artikel/' . buat_slug($article)) ?>">
								<img class="img-fluid" src="<?= base_url() ?>themes/bodas/assets/img/noimage.png" alt="Belum Ada Gambar">
							</a>
						<?php endif; ?>
					</div>
					<div class="text-center p-4 pb-0">
						<h5 class="mb-4"><a href="<?= site_url('artikel/' . buat_slug($article)) ?>"><?= $article['judul'] ?></a></h5>
					</div>
					<div class="text-justify" style="padding-left: 15px; padding-right:15px;">
						<p><?= potong_teks($article['isi'], 100) ?></p>
					</div>
					<div class="d-flex border-top">
						<small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i><?= $article['owner'] ?></small>
						<small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i><?= tgl_indo($article['tgl_upload']) ?></small>
						<small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i><?= $article['hit'] ?></small>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
<?php $this->load->view($folder_themes . '/commons/paging') ?>
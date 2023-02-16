<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $article = $single_artikel ?>

<div class="single-inner">
	<div class="post-details">
		<div class="main-content-head">
			<div class="post-thumbnils">
				<?php if ($article['gambar'] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $article['gambar'])) : ?>
					<img src="<?= AmbilFotoArtikel($article['gambar'], 'sedang') ?>" alt="<?= $article['judul'] ?>" id="current">
				<?php endif ?>
			</div>
			<div class="meta-information">
				<h2 class="post-title">
					<a href="#"><?= $article['judul'] ?></a>
				</h2>

				<ul class="meta-info">
					<li>
						<a href="javascript:void(0)"> <i class="lni lni-user"></i> <?= $article['owner'] ?></a>
					</li>
					<li>
						<a href="javascript:void(0)"><i class="lni lni-calendar"></i> <?= tgl_indo($article['tgl_upload']) ?>
						</a>
					</li>
					<li><?php if ($article['kategori']) : ?>
							<a href="<?= site_url('first/kategori/' . $article['kat_slug']) ?>"><i class="lni lni-tag"></i> <?= $article['kategori'] ?></a>
						<?php endif ?>
					</li>
					<li>
						<a href="javascript:void(0)"><i class="lni lni-timer"></i> <?= hit($article['hit']) ?></a>
					</li>
				</ul>
			</div>
			<div class="detail-inner">
				<?= $article['isi'] ?>
				<div class="images" style="height:150px;width:150px; padding-top:30px">
					<?php if ($article['gambar' . $i] && is_file(LOKASI_FOTO_ARTIKEL . 'sedang_' . $article['gambar' . $i])) : ?>
						<img src="<?= AmbilFotoArtikel($article['gambar' . $i], 'sedang') ?>" alt="<?= $article['nama'] ?>" title="<?= $article['nama'] ?>" class="img">
					<?php endif ?>
				</div>

				<!-- Start Ads -->
				<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1823410826720847" crossorigin="anonymous"></script>
				<ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="ca-pub-1823410826720847" data-ad-slot="4336226139"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
				<!-- End Ads -->
				<?php for ($i = 1; $i <= 3; $i++) : ?>
				<?php endfor ?>
				<?php if ($article['dokumen']) : ?>
					<div class="content__attachment --mt-4"> <strong>Dokumen Lampiran</strong> <a href="<?= base_url(LOKASI_DOKUMEN . $article['dokumen']) ?>" class="content__attachment__link"> <i class="fa fa-cloud-download content__attachment__icon"></i> <span>
								<?= $article['link_dokumen'] ?>
							</span> </a> </div>
				<?php endif ?>
			</div>

			<div class="post-bottom-area">
				<div class="post-tag">
					<ul>
						<li><a href="<?= site_url('first/kategori/' . $article['kat_slug']) ?>">#<?= $article['kategori'] ?>,</a></li>
					</ul>
				</div>


				<div class="post-social-media">
					<h5 class="share-title">Share post :</h5>
					<ul>
						<li>
							<a href="http://www.facebook.com/sharer.php?u=<?= site_url('artikel/' . buat_slug($article)) ?>">
								<i class="lni lni-facebook-filled"></i>
								<span>facebook</span>
							</a>
						</li>
						<li>
							<a href="http://twitter.com/share?url=<?= site_url('artikel/' . buat_slug($article)) ?>">
								<i class="lni lni-twitter-original"></i>
								<span>twitter</span>
							</a>
						</li>
						<li>
							<a href="https://telegram.me/share/url?url=<?= site_url('artikel/' . buat_slug($article)) ?>&text=<?= $article["judul"]; ?>">
								<i class="lni lni-telegram"></i>
								<span>Telegram</span>
							</a>
						</li>
						<li>
							<a href="https://api.whatsapp.com/send?text=<?= site_url('artikel/' . buat_slug($article)) ?>">
								<i class="lni lni-whatsapp"></i>
								<span>Whatsapp</span>
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<i class="lni lni-pinterest"></i>
								<span>pinterest</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- Komentar -->

	<div class="post-comments">
		<h3 class="comment-title"><span>Komentar</span></h3>
		<ul class="comments-list">
			<?php foreach ($komentar as $comment) : ?>
				<li>
					<div class="comment-img">
						<img src="#" alt="img">
					</div>
					<div class="comment-desc">
						<div class="desc-top">
							<h6><?= $comment['owner'] ?></h6>
							<span class="date"><?= $comment['tgl_upload'] ?></span>
							<a href="javascript:void(0)" class="reply-link"><i class="lni lni-reply"></i>Reply</a>
						</div>
						<p>
							<?= $comment['komentar'] ?>
						</p>
					</div>
				</li>
			<?php endforeach ?>
			<!--<li class="children">
				<div class="comment-img">
					<img src="#" alt="img">
				</div>
				<div class="comment-desc">
					<div class="desc-top">
						<h6>Rosalina Kelian</h6>
						<span class="date">15th May 2023</span>
						<a href="javascript:void(0)" class="reply-link"><i class="lni lni-reply"></i>Reply</a>
					</div>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim.
					</p>
				</div>
			</li>-->
		</ul>
	</div>
	<div class="comment-form">
		<h3 class="comment-reply-title">Berikan komentar</h3>
		<form id="form-komentar" name="form" action="<?= site_url('first/add_comment/' . $single_artikel['id']) ?>" method="POST" onSubmit="return validasi(this);">
			<div class="row">
				<div class="col-lg-6 col-12">
					<div class="form-box form-group">
						<input type="text" name="owner" class="form-control form-control-custom" placeholder="Nama lengkap" required value="<?= !empty($_SESSION['post']['owner']) ? $_SESSION['post']['owner'] : $_SESSION['nama'] ?>" />
					</div>
				</div>
				<div class="col-lg-6 col-12">
					<div class="form-box form-group">
						<input class="form-control form-control-custom" type="email" placeholder="Email" name="email" maxlength="30" value="<?= $_SESSION['post']['email']; ?>">
					</div>
				</div>
				<div class="col-lg-6 col-12">
					<div class="form-box form-group">
						<input class="form-control form-control-custom" type="text" required placeholder="Nomor HP" name="no_hp" maxlength="30" value="<?= $_SESSION['post']['no_hp']; ?>">
					</div>
				</div>
				<div class="col-12">
					<div class="form-box form-group">
						<textarea class="form-control form-control-custom" placeholder="Tulis komentar anda di sini" required name="komentar"><?= $_SESSION['post']['komentar'] ?></textarea>
					</div>
				</div>

				<div class="row">
					<div class="offset-lg-3 col-lg-9">
						<img id="captcha" src="<?= base_url('securimage/securimage_show.php') ?>" alt="CAPTCHA Image" / class="img-fluid border border-black">
					</div>
				</div>
				<div class="row mb-2">
					<div class="offset-lg-3 col-lg-9">
						<a href="#!" onclick="document.getElementById('captcha').src = '<?= base_url("securimage/securimage_show.php?") ?>'+Math.random(); return false"><small>[ Ganti Gambar ]</small></a>
					</div>
				</div>
				<div class="row">
					<div class="offset-lg-3 col-lg-9">
						<input class="form-control input-sm" type="text" required name="captcha_code" maxlength="6" value="<?= $_SESSION['post']['captcha_code'] ?>" />
						<span class="d-block">
							Isikan kode di gambar
						</span>
					</div>
				</div>


				<div class="col-12" style="text-align:right ;">
					<div class="button">
						<button type="submit" class="btn">Post Comment</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<!--

	<?php if (is_array($komentar)) : ?>
		<?php
		$k = array();
		foreach ($komentar as $data) {
			if ($data['is_archived'] != 1) {
				array_push($k, $data);
			}
		}
		?>
		<?php if (count($k) > 0) : ?>
			<div class="py-2 pl-4 bg-light align-middle d-flex align-items-center" style="border-left: 3px solid orange">
				<h4 class="h5 font-weight-bold m-0"><?= count($k) ?> Komentar atas artikel <?= $single_artikel["judul"] ?></h4>
			</div>
			<ul class="comment-section">
				<?php foreach ($k as $data) : ?>
					<li class="comment user-comment">
						<div class="info">
							<a href="#!" title="<?= $data['owner'] ?>"><?= $data['owner'] ?></a>
							<span><?= tgl_indo($data['tgl_upload']); ?></span>
						</div>
						<span class="avatar">
							<i class="fa fa-user fa-lg p-2 rounded-circle bg-light"></i>
						</span>
						<p><?= $data['komentar'] ?></p>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	<?php endif ?>-->
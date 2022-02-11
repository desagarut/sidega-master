<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if($transparansi) $this->load->view($folder_themes .'/partials/apbdesa', $transparansi) ?>

<!-- MOHON TIDAK MEMODIFIKASI TAUTAN PENGEMBANG DI BAWAH INI SEBAGAI BENTUK PENGHARGAAN HAK CIPTA. -->
<footer class="footer">
	<div class="footer__content">
		<div class="footer__copyright">
			<span>Copyright &copy; <?= date('Y') ?> - <a href="#" target="_blank"><strong>tema cosmo <?= THEME_VERSION ?></strong></a>
		</div>
		<ul class="social-media">
			<?php foreach($sosmed as $data) : ?>
				<?php if(!empty($data['link'])) : ?>
					<?php $brand = strtolower(str_replace(' ', '-', $data['nama'])) ?>
					<li class="social-media__item social-media--<?= $brand ?>">
						<a href="<?= $data['link'] ?>" class="social-media__link"><i class="fa fa-<?= $brand == 'youtube' ? 'youtube-play' : $brand ?>"></i></a>
					</li>
				<?php endif ?>
			<?php endforeach ?>
		</ul>
	</div>
</footer>

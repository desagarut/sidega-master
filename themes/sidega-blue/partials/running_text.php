<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="section-title" data-aos="fade-left">
<?php foreach ($teks_berjalan AS $teks): ?>
<marquee onmouseover="this.stop()" onmouseout="this.start()">
	<span class="teks" style="padding-right: 50px;">
		<?= $teks['teks']?>
		<?php if ($teks['tautan']): ?>
			<a href="<?= $teks['tautan'] ?>" rel="noopener noreferrer" title="Baca Selengkapnya"><?= $teks['judul_tautan']?></a>
		<?php endif; ?>
	</span>
    </marquee>
<?php endforeach; ?>
</div>

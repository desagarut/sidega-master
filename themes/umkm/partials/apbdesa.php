<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!--
<section id="portfolio-details" class="portfolio-details">
	<div class="container" data-aos="fade-up">
		<div class="portfolio-details-container">
			<div class="owl-carousel portfolio-details-carousel">
				<?php foreach ($data_widget as $subdata_name => $subdatas) : ?>
					<div class="col-md-4">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title"><?= ($subdatas['laporan']) ?></h3>
							</div>
							<div class="box-body">
								<?php foreach ($subdatas as $key => $subdata) : ?>
									<?php if ($subdata['judul'] != NULL and $key != 'laporan' and $subdata['realisasi'] != 0 or $subdata['anggaran'] != 0) : ?>
										<div class="progress">
											<label class="progress__title"><?= ucwords(strtolower($subdata['judul'])) ?></label>
											<div class="--flex --justify-between">
												<span class="progress__subtitle">Rp<?= number_format($subdata['realisasi']) ?></span>
												<span class="progress__subtitle">Rp<?= number_format($subdata['anggaran']) ?></span>
											</div>
											<div class="progress-bar">
												<div class="progress-bar__item" style="width:<?= $subdata['persen'] ?>%">
													<span class="progress-bar__caption"><?= $subdata['persen'] ?>%</span>
												</div>
											</div>
										</div>
									<?php endif ?>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</section>-->

<section class="featured-categories section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>Keuangan Desa</h2>
					<p>Publikasi Keuangan Desa</p>
				</div>
			</div>
		</div>
		<div class="row">
		<?php foreach ($data_widget as $subdata_name => $subdatas) : ?>
			<div class="col-lg-4 col-md-6 col-12">
			
				<div class="single-category">
					
					<h3 class="heading"><?= ($subdatas['laporan']) ?></h3>
					<?php foreach ($subdatas as $key => $subdata) : ?>
						<?php if ($subdata['judul'] != NULL and $key != 'laporan' and $subdata['realisasi'] != 0 or $subdata['anggaran'] != 0) : ?>
					<ul>
						<li><a href="#">Anggaran : <?= ucwords(strtolower($subdata['judul'])) ?></a></li>
						<li><a href="#">Rp. <?= number_format($subdata['realisasi']) ?></a></li>
						<li><a href="#">Rp. <?= number_format($subdata['anggaran']) ?></a></li>
						<li><a href="#">Persentase : <?= $subdata['persen'] ?>%</a></li>
					</ul>
					<div class="images item-right">
					<?= $subdata['persen'] ?>%
					</div>
					<?php endif ?>
				<?php endforeach ?>
				</div>
				
			</div>
		<?php endforeach ?>	
		</div>
	</div>
</section>